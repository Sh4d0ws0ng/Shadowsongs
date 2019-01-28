@extends('layouts.master')

@section('pageTitle', __('user.profile'))

@section('breadcrumbs', Breadcrumbs::render('profile', $user))

@section('content')

@if(auth()->user()->id == $user->id || auth()->user()->admin)
  <div class="card std center-align">
    <h4 class="center-align">{{ __('user.profile') }}</h4>

    <div class="row">
      <div class="margin-bottom col s4">
        <img src="/storage/user/{{ $user->img }}" onerror="this.src='/storage/user/user_icon_default.png'" alt="profile_picture" width="200px" height="200px">
      </div>
      <div class="col s8">
        <div class="user_data">
          <h6>Benutzername: {{ $user->name }}</h6>
          <h6>E-Mail: {{ $user->email }}</h6>
        </div>
      </div>
      <a href="{{ route('password.request') }}" class="btn">Passwort zurücksetzen</a>

      @include('layouts.errors')
    </div>
  </div>
  <div class="card std">
    <h5>Reviews</h5>
    <ul class="collection">
    @foreach($reviews as $review)
      <li class="collection-item avatar">
        <a href="/reviews/{{ $review->id }}"><img src="/storage/cover/{{ $review->img }}" alt="" class="circle"></a>
        <div>{{ $review->artist }} - {{ $review->title }}<br>
        {!! \Illuminate\Support\Str::limit($review->content, $limit = 100, $end = '...')  !!}
        <a href="/reviews/{{ $review->id }}" class="secondary-content"><i class="material-icons">send</i></a></div>
      </li>
    @endforeach
    </ul>
  </div>
  {{ $reviews->links('layouts.pagination') }}
@endif



@endsection
