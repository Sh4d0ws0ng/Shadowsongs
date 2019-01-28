@extends('layouts.master')

@section('pageTitle', 'Passwort zurücksetzen')

@section('content')

<div class="card std form row">
  <h4 class="center-align">{{ __('user.resetpw') }}</h4>
  @if(session('status'))
    <div class="alert-success">
      {{ session('status') }}
    </div>
  @endif


  <form action="{{ route('password.email') }}" method="POST">
    {{ csrf_field() }}

    <div class="input-field col s12">
      <label for="email">{{ __('user.email') }}</label>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <input class="btn col s6 offset-s3 margin-top margin-bottom" type="submit" value="{{ __('user.sendresetlink') }}" />
    @include('layouts.errors')
  </form>
</div>

@endsection
