@extends('layouts.master')

@section('pageTitle', 'Review bearbeiten')

@section('content')

  <div class="card std form">
    <h4 class="center-align">Review bearbeiten</h4>
    <form id="review_edit_form" action="/reviews/{{ $review->id }}" method="POST" name="review_form" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="row">
        <div class="input-field col s6">
          <label for="review_title" class="active">{{ __('admin.album_title') }}</label>
          <input id="review_title" type="text" name="review_title" value="{{ $review->title }}" required>
        </div>

        <div class="input-field col s6">
          <label for="review_artist" class="active">{{ __('admin.artist') }}</label>
          <input id="review_artist" type="text" name="review_artist" value="{{ $review->artist }}" required>
        </div>

        <ul class="collapsible col s12">
          <li>
            <div class="collapsible-header"><i class="material-icons">edit</i>{{ __('admin.review_text')}} </div>
            <div class="collapsible-body row">
              <div class="input-field col s12 margin-bottom">
                <label for="review_content" class="active">{{ __('admin.review_text_de') }}</label>
                <textarea class="materialize-textarea" id="review_content" name="review_content" required>{{ $review->content }}</textarea>
              </div>
              <div>
                <div class="input-field col s12 margin-bottom">
                  <label for="review_content_en" class="active">{{ __('admin.review_text_en') }}</label>
                  <textarea class="materialize-textarea" id="review_content_en" name="review_content_en">{{ $review->content_en }}</textarea>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">description</i>{{ __('admin.metadata')}} </div>
            <div class="collapsible-body row">
              <div class="input-field col s6">
                <label for="review_release_date">{{ __('admin.release_date') }}</label>
                <input type="text" class="datepicker" name="review_release_date" id="review_release_date" value="{{ $review->release_date }}">
              </div>

              <div class="input-field col s6">
                <label for="review_label">{{ __('admin.label') }}</label>
                <input id="review_label" type="text" name="review_label" value="{{ $review->label }}">
              </div>

              <div class="input-field col s6">
                <label for="review_homepage">{{ __('admin.homepage') }}</label>
                <input id="review_homepage" type="text" name="review_homepage" value="{{ $review->homepage }}">
              </div>

              <div class="input-field col s6">
                <label for="review_spotify">{{ __('admin.spotify') }}</label>
                <input id="review_spotify" type="text" name="review_spotify" value="{{ $review->spotify }}">
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">format_list_numbered</i>{{ __('admin.song_ratings')}} </div>
            <div class="collapsible-body row">
              <div>
                <table class="song_ratings" id="dynamic_field">
                  <tr>
                    <th>{{ __('admin.songname') }}</th>
                    <th>{{ __('admin.rating') }}</th>
                  </tr>

                  <input type="hidden" id="song_count" value="{{ count($review->songs) }}" />
                  @if(count($review->songs) == 0)
                  <tr>
                    <td><input type="text" name="song_titles[]" value="" /></td>
                    <td><input type="number" name="song_ratings[]" min="1" max="5" step="0.5" value="3.0" /></td>
                    <td><button type="button" name="add" id="add" class="btn-floating"><i class="material-icons">add</i></button></td>
                  </tr>
                  @endif

                  @for($i = 0; $i < count($review->songs); $i++)
                    @if($i == 0)
                    <tr>
                      <td><input type="text" name="song_titles[]" value="{{ $review->songs[$i]->title }}" /></td>
                      <td><input type="number" name="song_ratings[]" min="1" max="5" step="0.5" value="{{ $review->songs[$i]->rating }}" /></td>
                      <td><button type="button" name="add" id="add" class="btn-floating"><i class="material-icons">add</i></button></td>
                    </tr>
                    @else
                    <tr id="row{{ $i }}">
                      <td><input type="text" name="song_titles[]" value="{{ $review->songs[$i]->title }}" /></td>
                      <td><input type="number" name="song_ratings[]" min="1" max="5" step="0.5" value="{{ $review->songs[$i]->rating }}" /></td>
                      <td><button style="padding: 0 1rem;" type="button" name="remove" id="{{ $i }}" class="btn btn_remove red">X</button></td>
                    </tr>
                    @endif
                  @endfor

                </table>
              </div>
          </li>
        </ul>


        <div class="file-field input-field col s6">
          <div class="btn">
            <span>{{ __('admin.upload_img') }}</span>
            <input type="file" name="review_img" id="review_img">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>

        <div class="input-field col s6">
          <select name="review_genres[]" multiple>
            <option value="" disabled>{{ __('admin.select_genre') }}</option>
            @foreach($genres as $genre)
              @if($review->genres->find($genre->id))
                @if($genre->id == $review->genres->find($genre->id)->id)
                <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                @endif
              @else
              <option value="{{ $genre->id }}">{{ $genre->name }}</option>
              @endif
            @endforeach
          </select>
        </div>

        <label class="rating_label">{{ __('admin.rating') }}</label>
        <div class="rating col s12">
          <p class="range-field">
            <input type="range" min="1" max="5" step="0.1" name="review_rating" value="{{ $review->rating }}" required />
          </p>
        </div>
        <input class="btn margin-top col s6 offset-s3" type="submit" value="{{ __('admin.save_changes') }}" />
      </div>
      @include('layouts.errors')
    </form>
  </div>

@endsection
