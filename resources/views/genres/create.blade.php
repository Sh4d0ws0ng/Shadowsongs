@extends('layouts.master')

@section('pageTitle', __('admin.genre_mngm'))

@section('content')

  <div class="card std form">
    <h4 class="center-align">{{ __('admin.genre_mngm') }}</h4>

    <table class="genre_table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
      </tr>

      @foreach($genres as $genre)

        <tr>
          <td>{{ $genre->id }}</td>
          <td>{{ $genre->name }}</td>
          <td>
            <form action="/genres/{{ $genre->id }}" method="POST" name="genre_form">
    					{{ csrf_field() }}
              {{ method_field('DELETE') }}
    					<input type="hidden" name="genre_id" value="{{ $genre->id }}" />
    	      	<button type="submit" class="btn red tooltipped left" data-tooltip="{{ __('admin.delete_genre') }}" data-position="bottom"><i class="material-icons">cancel</i></button>
    				</form>
          </td>
        </tr>

      @endforeach

    </table>
    <div class="divider"></div>
    <h5 class="center-align margin-top">{{ __('admin.add_genre') }}</h5>
    <form id="genre_form" action="/genres" method="POST" name="genre_form" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="input-field col s12">
          <label for="genre_name">{{ __('admin.genre_name') }}</label>
          <input id="genre_name" type="text" name="genre_name" required>
        </div>
        <input class="btn ownbtn col s6 offset-s3" type="submit" value="{{ __('admin.add') }}" />
      </div>
      @include('layouts.errors')
    </form>
  </div>

@endsection
