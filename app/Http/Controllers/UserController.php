<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {

  public function __construct() {
    $this->middleware('auth')->except('show');
  }

  public function index() {
    $users = User::orderBy('id', 'asc')->paginate(25);

    return view('users.index', compact('users'));
  }

  public function show(User $user) {
    $reviews = Review::latest()->where('user_id', $user->id)->where('blog_id', 0);
    $blogs = Blog::latest()->where('user_id', $user->id)->paginate(5);
    $reviews = $reviews->paginate(5);
    return view('users.show', compact('user', 'reviews', 'blogs'));
  }

  public function edit(User $user) {
    $reviews = Review::latest()->where('user_id', $user->id)->where('blog_id', 0);
    $reviews = $reviews->paginate(5);
    return view('users.edit', compact('user', 'reviews'));
  }

  public function update(User $user, Request $request) {
    $this->validate(request(), [
      'user_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if($request->hasFile('user_img')) {
      if($request->user_img->isValid()) {
        $extension = $request->user_img->extension();
        $rand = rand(1, 9999);
        $img = 'user_img'. $rand .$user->id. '.' .$extension;
        $filePath = $request->user_img->storeAs('public/user', $img);
      }
      if($user->img != '') {
        Storage::delete('/public/user/'.$user->img);
      }
      $user->img = $img;
    }

    $user->save();

    if($request->input('edit_oldpassword') !== null) {
      dd("Hi");
    }

    session()->flash('message', __('admin.user_update_success'));

    return redirect('/users/'.$user->id.'/edit');
  }

  public function ban(User $user, Request $request) {
    if(!$user->admin) {
      $user->banned = true;
      $user->save();
    } else {
      session()->flash('message', 'Keine Berechtigung Benutzer zu löschen!');
      return redirect('/users');
    }
    session()->flash('message', __('admin.ban_toast1').$user->name.__('admin.ban_toast2'));

    return redirect('/users');
  }

  public function unban(User $user, Request $request) {
    $user->banned = false;
    $user->save();

    session()->flash('message', __('admin.ban_toast1').$user->name.__('admin.unban_toast'));

    return redirect('/users');
  }
}
