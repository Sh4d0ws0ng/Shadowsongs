@extends('layouts.master')

@section('pageTitle', __('user.signup'))

@section('breadcrumbs', Breadcrumbs::render('register'))

@section('content')

  <div class="card std form row">
    <h4 class="center-align">{{ __('user.signup') }}</h4>
    <form action="/register" method="POST" name="register_form">
      {{ csrf_field() }}
      <div class="input-field col s12">
        <label for="name">{{ __('user.username') }}</label>
        <input id="name" type="text" name="name" maxlength="15" required>
      </div>
      <div class="input-field col s12">
        <label for="email">{{ __('user.email') }}</label>
        <input id="email" type="email" name="email" required>
      </div>
      <div class="input-field col s12">
        <label for="password">{{ __('user.password') }}</label>
        <input id="password" type="password" name="password" min="4" required>
      </div>
      <div class="input-field col s12">
        <label for="password_confirmation">{{ __('user.confirmpw') }}</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
      </div>
      <input class="btn col s6 offset-s3 margin-bottom margin-top" type="submit" value="{{ __('user.signup') }}" />
      @include('layouts.errors')
    </form>
  </div>

@endsection
