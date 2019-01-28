<?php

namespace App\Http\Controllers;

use App\Review;
use App\Song;
use App\Genre;
use Carbon\Carbon;
use App\Http\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller {

  public function __construct() {
    $this->middleware('auth')->except(['index', 'show']);
  }

  public function index() {
    $reviews = Review::latest()->where('blog_id', 0);

    if($month = request('month')) {
      $month = translateToEnglish($month);
      $reviews->whereMonth('created_at', Carbon::parse($month)->month);
    }

    if($year = request('year')) {
      $reviews->whereYear('created_at', $year);
    }

    $reviews = $reviews->paginate(20);

    $archives = Review::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
                        ->groupBy('year', 'month')
                        ->orderByRaw('min(created_at) desc')
                        ->get()
                        ->toArray();

    $urlArchives = $archives;

    if(\App::isLocale('de')) {
      for($i = 0; $i < sizeof($archives); $i++) {
        $archives[$i]['month'] = translateToGerman($archives[$i]['month']);
      }
    }

    return view('reviews.index', compact('reviews', 'archives', 'urlArchives'));
  }

  public function create() {
    $genres = Genre::orderBy('name', 'asc')->get();
    return view('reviews.create', compact('genres'));
  }

  public function show(Review $review) {
    $reviews = Review::latest()->where('blog_id', 0)->get();
    return view('reviews.show', compact('review', 'reviews'));
  }

  public function store(Request $request) {


    $this->validate(request(), [
      'review_title' => 'required',
      'review_artist' => 'required',
      'review_content' => 'required',
      'review_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if($request->hasFile('review_img')) {
      if($request->review_img->isValid()) {
        $extension = $request->review_img->extension();
        $img = request('review_artist').' - ' . request('review_title'). '.' . $extension;
        $specialCharacters = array('<', '>', '?', '"', ':', '|', '\\', '/', '*', '#');
        $img = str_replace($specialCharacters, "_", $img);
        $filePath = $request->review_img->storeAs('public/cover', $img);
      }
    } else {
      $img = "";
    }

    $review = Review::create([
      'title' => request('review_title'),
      'artist' => request('review_artist'),
      'content' => request('review_content'),
      'content_en' => '',
      'label' => request('review_label'),
      'homepage' => request('review_homepage'),
      'spotify' => request('review_spotify'),
      'release_date' => request('review_release_date'),
      'img' => $img,
      'rating' => request('review_rating'),
      'user_id' => auth()->id(),
      'blog_id' => 0
    ]);

    if($request->has(['review_genres'])) {
      $genres = $request->input('review_genres.*');
      for($i = 0; $i < count($genres); $i++) {
        $review->genres()->attach($genres[$i]);
      }
    }

    $titles = $request->input('song_titles.*');
    $ratings = $request->input('song_ratings.*');
    if(!is_null($titles[0])) {
      for($i = 0; $i < count($titles); $i++) {
        Song::create([
          'number' => $i + 1,
          'title'  => $titles[$i],
          'rating' => $ratings[$i],
          'review_id' => $review->id
        ]);
      }
    }

    session()->flash('message', 'Review erfolgreich erstellt!');

    return redirect('/reviews');
  }

  public function edit(Review $review) {
    $genres = Genre::orderBy('name', 'asc')->get();

    return view('reviews.edit', compact('review', 'genres'));
  }

  public function update(Review $review, Request $request) {
    $this->validate(request(), [
      'review_title' => 'required',
      'review_artist' => 'required',
      'review_content' => 'required',
      'review_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if($request->hasFile('review_img')) {
      if($request->review_img->isValid()) {
        $extension = $request->review_img->extension();
        $img = request('review_artist').' - ' . request('review_title'). '.' . $extension;
        $specialCharacters = array('<', '>', '?', '"', ':', '|', '\\', '/', '*', '#');
        $img = str_replace($specialCharacters, "_", $img);
        $filePath = $request->review_img->storeAs('public/cover', $img);
      }
      $review->fill([
        'title' => request('review_title'),
        'artist' => request('review_artist'),
        'content' => request('review_content'),
        'content_en' => request('review_content_en'),
        'release_date' => Carbon::parse(request('review_release_date')),
        'label' => request('review_label'),
        'homepage' => request('review_homepage'),
        'spotify' => request('review_spotify'),
        'img' => $img,
        'rating' => request('review_rating'),
        'user_id' => auth()->id()
      ]);
    } else {
      $review->fill([
        'title' => request('review_title'),
        'artist' => request('review_artist'),
        'content' => request('review_content'),
        'content_en' => request('review_content_en'),
        'release_date' => Carbon::parse(request('review_release_date')),
        'label' => request('review_label'),
        'homepage' => request('review_homepage'),
        'spotify' => request('review_spotify'),
        'rating' => request('review_rating'),
        'user_id' => auth()->id()
      ]);
    }

    $review->save();

    if($request->has(['review_genres'])) {
      $review->genres()->detach();
      $genres = $request->input('review_genres.*');
      for($i = 0; $i < count($genres); $i++) {
        $review->genres()->attach($genres[$i]);
      }
    }

    $songs = Song::all();
    foreach($songs as $song) {
      if($song->review_id == $review->id) {
        $song->delete();
      }
    }
    $titles = $request->input('song_titles.*');
    $ratings = $request->input('song_ratings.*');
    if(!is_null($titles[0])) {
      for($i = 0; $i < count($titles); $i++) {
        Song::create([
          'number' => $i + 1,
          'title'  => $titles[$i],
          'rating' => $ratings[$i],
          'review_id' => $review->id
        ]);
      }
    }

    session()->flash('message', 'Review erfolgreich aktualisiert!');

    return redirect('/reviews/'.$review->id);
  }

  public function delete(Review $review) {
    $songs = Song::all();
    foreach($songs as $song) {
      if($song->review_id == $review->id) {
        Song::destroy($song->id);
      }
    }

    if($review->img != '') {
      Storage::delete('/public/cover/'.$review->img);
    }

    Review::destroy($review->id);

    return redirect('/reviews');
  }
}
