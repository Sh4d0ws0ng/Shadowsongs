@extends('layouts.master')

@section('pageTitle', __('admin.user_mngm'))

@section('content')


<div class="card std center-align">
  <h4>{{ __('admin.user_mngm') }}</h4>

  <table class="user_table">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>E-Mail</th>
      <th>Image</th>
      <th>Actions</th>
    </tr>

    @foreach($users as $user)

      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->img }}</td>
        <td><a href="/users/{{ $user->id }}/edit" class="btn left margin-right"><i class="material-icons">remove_red_eye</i></a>
        @if($user->banned)
          <form action="/users/{{ $user->id }}/unban" method="POST" name="unban_form">
  					{{ csrf_field() }}
  					<input type="hidden" name="user_id" value="{{ $user->id }}" />
  	      	<button type="submit" class="btn green tooltipped left" data-tooltip="{{ __('admin.unban_user') }}" data-position="bottom"><i class="material-icons">check</i></button>
  				</form>
        </td>
        @else
          <form action="/users/{{ $user->id }}/ban" method="POST" name="ban_form">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}" />
            <button type="submit" class="btn red tooltipped left" data-tooltip="{{ __('admin.ban_user') }}" data-position="bottom"><i class="material-icons">cancel</i></button>
          </form>
        </td>
        @endif
      </tr>

    @endforeach

  </table>
</div>

@endsection
