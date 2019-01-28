<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Genre;
use App\Review;
use Carbon\Carbon;

class GenreController extends Controller {

  public function index() {
    $genres = DB::table('genres')->orderBy('name', 'asc')->get();

    return view('genres.index', compact('genres'));
  }

  public function filterGenre(Genre $genre) {
    $reviews = $genre->reviews()->latest();

    if($month = request('month')) {
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

    return view('reviews.index', compact('reviews', 'genre', 'archives'));
  }

  public function create() {
    $genres = Genre::orderBy('id', 'asc')->paginate(50);

    return view('genres.create', compact('genres'));
  }

  public function store() {
    $this->validate(request(), ['genre_name' => 'required']);
    try {
      Genre::create(['name' => request('genre_name')]);
    } catch(\Illuminate\Database\QueryException $e) {
      dd($e->errorInfo[2]);
    }

    session()->flash('message', 'Genre erfolgreich hinzugefügt!');

    return back();
  }

  public function update(Genre $genre) {

  }

  public function delete(Genre $genre) {
    Genre::destroy($genre->id);

    return redirect('/genres');
  }
}
