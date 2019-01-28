@extends('layouts.master')

@section('pageTitle', 'Home')

@section('breadcrumbs', Breadcrumbs::render('home'))

@section('content')

  <div class="card std center-align">
    <div class="slider">
      <ul class="slides">
        <li>
          <img src="/storage/blog/blog1.jpg">
          <div class="caption left-align">
            <h2>{{ __('home.welcome_message1') }}</h2>
            <h1>ShadowSongs!</h1>
          </div>
        </li>
        <li>
          <img src="/storage/blog/default-blog.png">
          <div class="caption right-align">
            <h2>{!! __('home.welcome_message2') !!}</h2>
          </div>
        </li>
      </ul>
    </div>
    <div class="divider"></div>

    <div class="row center-align">
      <div class="welcome_links">
        <a href="/reviews/{{ $latestReview->id }}">
          <img src="/storage/cover/{{ $latestReview->img }}" alt="cover" />
          <h6>{{ __('home.reviews') }}</h6>
        </a>
      </div>
      <div class="welcome_links">
        <a href="/blog">
          <img src="/storage/blog/blog_cover.png" alt="cover" />
          <h6>{{ __('home.blog') }}</h6>
        </a>
      </div>
      <div class="welcome_links">
        <div>
          <a href="/music">
            <img src="/storage/cover/default-cover.jpg" alt="cover" />
            <h6>{{ __('home.moremusic') }}</h6>
          </a>
        </div>
      </div>
    </div>
    <div class="divider"></div>
  </div>

@endsection
