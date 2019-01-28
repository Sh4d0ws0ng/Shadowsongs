@extends('layouts.master')

@section('pageTitle', 'Passwort zurücksetzen')

@section('content')

<div class="card std form row">
  <h4 class="center-align">{{ __('user.resetpw') }}</h4>
  <form action="{{ route('password.request') }}" method="POST">
    {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="input-field col s12">
      <label for="email">{{ __('user.email') }}</label>
      <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>
    </div>

    <div class="input-field col s6">
      <label for="password">{{ __('user.password') }}</label>
      <input id="password" type="password" name="password" required>
    </div>

    <div class="input-field col s6">
      <label for="password_confirm">{{ __('user.confirmpw') }}</label>
      <input id="password_confirm" type="password" name="password_confirmation" required>
    </div>

    <input class="btn col s6 offset-s3 margin-top margin-bottom" type="submit" value="{{ __('user.resetpw') }}" />
    @include('layouts.errors')
  </form>
</div>

@endsection
