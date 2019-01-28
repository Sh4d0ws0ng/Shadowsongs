<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Blog;
use Carbon\Carbon;

class TagController extends Controller {

  public function index(Tag $tag) {
    $blogs = $tag->blogs()->latest();

    if($month = request('month')) {
      $reviews->whereMonth('created_at', Carbon::parse($month)->month);
    }

    if($year = request('year')) {
      $reviews->whereYear('created_at', $year);
    }

    $blogs = $blogs->paginate(20);

    $archives = Blog::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
                        ->groupBy('year', 'month')
                        ->orderByRaw('min(created_at) desc')
                        ->get()
                        ->toArray();

    return view('blogs.index', compact('blogs', 'tag', 'archives'));
  }

  public function create() {
    $tags = Tag::orderBy('id', 'asc')->paginate(50);

    return view('tags.create', compact('tags'));
  }

  public function store() {
    $this->validate(request(), ['tag_name' => 'required']);
    try {
      Tag::create(['name' => request('tag_name')]);
    } catch(\Illuminate\Database\QueryException $e) {
      dd($e->errorInfo[2]);
    }

    session()->flash('message', 'Tag erfolgreich hinzugefügt!');

    return back();
  }

  public function update(Tag $tag) {

  }

  public function delete(Tag $tag) {
    Tag::destroy($tag->id);

    return redirect('/tags');
  }
}
