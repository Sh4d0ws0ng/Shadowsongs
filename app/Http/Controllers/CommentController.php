<?php

namespace App\Http\Controllers;

use App\Review;
use App\Blog;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {

  public function store(Review $review) {
    $this->validate(request(), [
      'comment_content' => 'required'
    ]);

    Comment::create([
      'content' => strip_tags(request('comment_content')),
      'rating' => request('comment_rating'),
      'review_id' => $review->id,
      'user_id' => auth()->id()
    ]);

    return back();
  }

  public function storeBlog(Blog $blog) {
    $this->validate(request(), [
      'comment_content' => 'required'
    ]);

    Comment::create([
      'content' => strip_tags(request('comment_content')),
      'blog_id' => $blog->id,
      'user_id' => auth()->id()
    ]);

    return back();
  }

  public function delete(Review $review, Comment $comment) {
    Comment::destroy($comment->id);

    return redirect('/reviews/'.$review->id);
  }

  public function deleteBlog(Blog $blog, Comment $comment) {
    Comment::destroy($comment->id);

    return redirect('/blog/'.$blog->id);
  }
}
