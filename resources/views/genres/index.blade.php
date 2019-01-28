@extends('layouts.master')

@section('pageTitle', 'Genres')

@section('content')

  {{ Breadcrumbs::render('genres') }}

  <div class="card std center-align">
    <h3>Genres</h3>
    <ul class="genrelist">
    @foreach($genres as $genre)
      <li><a href="#" onclick="filterGenre('{{ $genre->name }}')">{{ $genre->name }}</a></li>
    @endforeach
    </ul>
  </div>

@endsection
