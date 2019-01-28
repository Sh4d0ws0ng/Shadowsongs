@extends('layouts.master')

@section('pageTitle', __('user.profile').' - '.$user->name)

@section('breadcrumbs', Breadcrumbs::render('profile', $user))

@section('content')

  <div class="card std row">
    <div class="profile_img col s2">
      <img src="/storage/user/{{ $user->img }}" onerror="this.src='/storage/user/user_icon_default.png'" alt="profile_picture">
    </div>
    <div class="col s5 user_info">
      @if(Auth::check())
        @if(Auth::user()->id == $user->id || Auth::user()->admin)
          <a href="/users/{{ $user->id }}/edit" class="edit_profile btn"><i class="material-icons">settings</i></a>
        @endif
      @endif
      <h4 class="center-align">{{ $user->name }}</h4>
      <table class="song_ratings">
        <tr><td class="detail_content">{{ __('user.firstname') }}:</td><td> {{ $user->firstname }}</td></tr>
        <tr><td class="detail_content">{{ __('user.lastname') }}: </td><td>{{ $user->lastname }}</td></tr>
        <tr><td class="detail_content">{{ __('user.website') }}: </td><td><a href="{{ $user->website }}" target="_blank" alt="website">{{ $user->website }}<a></td></tr>
        <tr><td class="detail_content">{{ __('user.social_media') }}: </td><td>
          <ul class="social_media">
            @if($user->facebook !== '')
              <li><a href="{{ $user->facebook }}" alt="facebook" target="_blank"><img src="/storage/facebook.png" width="30px"></a></li>
            @endif
            @if($user->twitter !== '')
              <li><a href="{{ $user->twitter }}" alt="twitter" target="_blank"><img src="/storage/twitter.png" width="30px"></a></li>
            @endif
            @if($user->instagram !== '')
              <li><a href="{{ $user->instagram }}" alt="instagram" target="_blank"><img src="/storage/instagram.png" width="30px"></a></li>
            @endif
          </ul>
        </td></tr>
      </table>
    </div>
    <div class="col s5">
      <h6>{{ __('user.about_me') }}</h6>
      <div class="about_me">{{ $user->about_me }}</div>
    </div>
  </div>

  <div class="card std row">
    <div class="col s6">
      <h5>Reviews</h5>
      <ul class="collection">
      @foreach($reviews as $review)
        <li class="collection-item avatar">
          <a href="/reviews/{{ $review->id }}" class="black_link"><img src="/storage/cover/{{ $review->img }}" alt="" class="circle">
          <div>{{ $review->artist }} - {{ $review->title }}<br>
          {!! \Illuminate\Support\Str::limit($review->content, $limit = 60, $end = '...')  !!}</a>
          <a href="/reviews/{{ $review->id }}" class="secondary-content"><i class="material-icons">send</i></a></div>
        </li>
      @endforeach
      </ul>
    </div>

    <div class="col s6">
      <h5>Blogs</h5>
      <ul class="collection">
      @foreach($blogs as $blog)
        <a href="/blog/{{ $blog->id }}" class="black_link">
          <li class="collection-item">
            <div>{{ $blog->title }}<br>
            {!! \Illuminate\Support\Str::limit($blog->content, $limit = 70, $end = '...')  !!}
            <a href="/blog/{{ $blog->id }}" class="secondary-content"><i class="material-icons">send</i></a></div>
          </li>
        </a>
      @endforeach
      </ul>
    </div>
  </div>
  {{ $reviews->links('layouts.pagination') }}


@endsection
