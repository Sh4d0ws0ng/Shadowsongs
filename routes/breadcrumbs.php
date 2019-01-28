<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs) {
  $breadcrumbs->push('Home', route('home'));
});

// Home > Sign Up
Breadcrumbs::register('register', function($breadcrumbs) {
  $breadcrumbs->parent('home');
  $breadcrumbs->push(__('user.signup'), route('register'));
});

// Home > Sign In
Breadcrumbs::register('login', function($breadcrumbs) {
  $breadcrumbs->parent('home');
  $breadcrumbs->push(__('user.signin'), route('login'));
});

// Home > Profile
Breadcrumbs::register('profile', function($breadcrumbs, $user) {
  $breadcrumbs->parent('home');
  $breadcrumbs->push(__('user.profile'), route('profile', $user));
});

// Home > Blog
Breadcrumbs::register('blogs', function($breadcrumbs) {
  $breadcrumbs->parent('home');
  $breadcrumbs->push('Blog', route('blogs'));
});

// Home > Blog > Tag
Breadcrumbs::register('tag', function($breadcrumbs) {
  $urlSplit = explode('/', $_SERVER['REQUEST_URI']);
  $urlSplit = explode('?month', $urlSplit[3]);
  $tag = str_replace("%20", " ", $urlSplit[0]);
  $breadcrumbs->parent('blogs');
  $breadcrumbs->push($tag, route('tag', $tag));
});

// Home > Blog > Blogpost
Breadcrumbs::register('blog', function($breadcrumbs, $blog) {
  $breadcrumbs->parent('blogs');
  $breadcrumbs->push($blog->title, route('blog', $blog));
});

// Home > Reviews
Breadcrumbs::register('reviews', function($breadcrumbs) {
  $breadcrumbs->parent('home');
  $breadcrumbs->push('Reviews', route('reviews'));
});

// Home > Reviews > Review
Breadcrumbs::register('review', function($breadcrumbs, $review) {
  $breadcrumbs->parent('reviews');
  $breadcrumbs->push($review->artist.' - '.$review->title, route('review', $review));
});

// Home > Reviews > Genres
Breadcrumbs::register('genres', function($breadcrumbs) {
  $breadcrumbs->parent('reviews');
  $breadcrumbs->push('Genres', route('genres'));
});

// Home > Reviews > Genres > Genre
Breadcrumbs::register('genre', function($breadcrumbs) {
  $urlSplit = explode('/', $_SERVER['REQUEST_URI']);
  $urlSplit = explode('?month', $urlSplit[3]);
  $genre = str_replace("%20", " ", $urlSplit[0]);
  $breadcrumbs->parent('genres');
  $breadcrumbs->push($genre, route('genre', $genre));
});
