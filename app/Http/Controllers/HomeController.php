<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Blog;

class HomeController extends Controller {
  public function index() {
    $latestReview = Review::latest()->where('blog_id', 0)->first();

    return view('home', compact('latestReview'));
  }
}
