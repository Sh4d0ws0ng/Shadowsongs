@extends('layouts.master')

@section('pageTitle', __('user.login'))

@section('breadcrumbs', Breadcrumbs::render('login'))

@section('content')

  <div class="card std form row">
    <h4 class="center-align">{{ __('user.login') }}</h4>
    <form action="/login" method="POST" name="login_form">
      {{ csrf_field() }}
      <div class="input-field col s12">
        <label for="email">{{ __('user.email') }}</label>
        <input id="email" type="email" name="email" required>
      </div>
      <div class="input-field col s12">
        <label for="password">{{ __('user.password') }}</label>
        <input id="password" type="password" name="password" required>
      </div>
      <div class="col s6 margin-bottom">
        <label>
          <input type="checkbox" class="filled-in" id="filled-in-box" name="remember_me" />
          <span>{{ __('user.rememberme') }}</span>
        </label>
      </div>
      <div class="margin-bottom right">
        <a href="{{ route('password.request') }}" class="btn forgot-password">{{ __('user.resetpw') }}</a>
      </div>
      <input class="btn col s6 offset-s3 margin-bottom margin-top" type="submit" value="{{ __('user.login') }}" />
      @include('layouts.errors')
    </form>
  </div>

@endsection
