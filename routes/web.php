<?php

Route::resource('reviews', 'ReviewController');
Route::resource('blog', 'BlogController');
Route::resource('sessions', 'SessionController');
Route::resource('genres', 'GenreController');
Route::resource('registration', 'RegistrationController');
Route::resource('comments', 'CommentController');
Route::resource('users', 'UserController');
Route::resource('tags', 'TagController');

Route::middleware(['language'])->group(function () {
  Route::get('/reviews', 'ReviewController@index')->name('reviews');
  Route::get('/reviews/{review}', 'ReviewController@show')->name('review');
  Route::get('/reviews/create', 'ReviewController@create');
  Route::post('/reviews', 'ReviewController@store');
  Route::get('/reviews/{review}/edit', 'ReviewController@edit');
  Route::put('/reviews/{review}', 'ReviewController@update');
  Route::delete('/reviews/{review}', 'ReviewController@delete');

  Route::post('/reviews/{review}/comments', 'CommentController@store');
  Route::delete('/reviews/{review}/comments/{comment}', 'CommentController@delete');

  Route::get('/reviews/genres/{genre}', 'GenreController@filterGenre')->name('genre');
  Route::get('/genres', 'GenreController@index')->name('genres');
  Route::get('/genres/create', 'GenreController@create');
  Route::post('/genres', 'GenreController@store');
  Route::delete('/genres/{genre}', 'GenreController@delete');

  Route::get('/blog', 'BlogController@index')->name('blogs');
  Route::get('/blog/{blog}', 'BlogController@show')->name('blog');
  Route::get('/blog/create', 'BlogController@create');
  Route::post('/blog/{type}', 'BlogController@store');
  Route::get('/blog/{blog}/edit', 'BlogController@edit');
  Route::put('/blog/{blog}', 'BlogController@update');
  Route::delete('/blog/{blog}', 'BlogController@delete');

  Route::post('/blog/{blog}/comments', 'CommentController@storeBlog');
  Route::delete('/blog/{blog}/comments/{comment}', 'CommentController@deleteBlog');

  Route::get('/blog/tags/{tag}', 'TagController@index')->name('tag');
  Route::get('/tags/create', 'TagController@create');
  Route::post('/tags', 'TagController@store');
  Route::delete('/tags/{tag}', 'TagController@delete');

  Route::get('/music', function() {
    return view('music.index');
  });

  Route::get('/register', 'RegistrationController@create')->name('register');
  Route::post('/register', 'RegistrationController@store');

  Route::get('/login', 'SessionController@create')->name('login');
  Route::post('/login', [ 'as' => 'login', 'uses' => 'SessionController@store']);
  Route::get('/logout', 'SessionController@destroy');

  Route::get('/users', 'UserController@index');
  Route::get('/users/{user}', 'UserController@show')->name('profile');
  Route::get('/users/{user}/edit', 'UserController@edit');
  Route::put('/users/{user}', 'UserController@update');
  Route::post('/users/{user}/ban', 'UserController@ban');
  Route::post('/users/{user}/unban', 'UserController@unban');

  Route::post('/passwords/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');;
  Route::get('/passwords/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::post('/passwords/reset', 'Auth\ResetPasswordController@reset');
  Route::get('/passwords/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');;


  Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
    return "This page requires that you be logged in and an Admin";
  }]);

  Route::get('/impressum', function() {
    return view('impressum.index');
  });

  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
});
