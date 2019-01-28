<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller {

  public function __construct() {
		$this->middleware('guest')->except(['destroy']);
	}

  public function create() {
    return view('sessions.create');
  }

  public function store(Request $request) {
    $remember_me = $request->has('remember_me') ? true : false;

  	if(!auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
  		return back()->withErrors(['message' => 'Please check your credentials and try again.']);
  	}
    if(auth()->user()->banned) {
      auth()->logout();
      return back()->withErrors(['message' => 'Your account has been banned.']);
    }

    return redirect('/');
  }

  public function destroy() {
    auth()->logout();

    return redirect('/');
  }
}
