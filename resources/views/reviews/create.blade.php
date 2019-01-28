@extends('layouts.master')

@section('includes')
  <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
@endsection

@section('pageTitle', __('admin.create_review'))

@section('content')

  <div class="card std form">
    <h4 class="center-align">{{ __('admin.create_review') }}</h4>
    <form id="review_form" action="/reviews" method="POST" name="review_form" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="input-field col s6">
          <label for="review_title">{{ __('admin.album_title') }}</label>
          <input id="review_title" type="text" name="review_title" required>
        </div>

        <div class="input-field col s6">
          <label for="review_artist">{{ __('admin.artist') }}</label>
          <input id="review_artist" type="text" name="review_artist" required>
        </div>

        <ul class="collapsible col s12">
          <li>
            <div class="collapsible-header"><i class="material-icons">edit</i>{{ __('admin.review_text')}} </div>
            <div class="collapsible-body row">
              <label class="text_label" for="review_content">{{ __('admin.review_text_de') }}</label>
              <div class="input-field col s12 margin-bottom">
                <textarea class="editor materialize-textarea" id="review_content" name="review_content" required></textarea>
              </div>
              <div>
                <label class="text_label" for="review_content_en">{{ __('admin.review_text_en') }}</label>
                <div class="input-field col s12 margin-bottom">
                  <textarea class="editor materialize-textarea" id="review_content_en" name="review_content_en" required></textarea>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">description</i>{{ __('admin.metadata')}} </div>
            <div class="collapsible-body row">
              <div class="input-field col s6">
                <label for="review_release_date">{{ __('admin.release_date') }}</label>
                <input type="text" class="datepicker" name="review_release_date" id="review_release_date">
              </div>

              <div class="input-field col s6">
                <label for="review_label">{{ __('admin.label') }}</label>
                <input id="review_label" type="text" name="review_label">
              </div>

              <div class="input-field col s6">
                <label for="review_homepage">{{ __('admin.homepage') }}</label>
                <input id="review_homepage" type="text" name="review_homepage">
              </div>

              <div class="input-field col s6">
                <label for="review_spotify">{{ __('admin.spotify') }}</label>
                <input id="review_spotify" type="text" name="review_spotify">
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
                <tr>
                  <td><input type="text" name="song_titles[]"/></td>
                  <td><input type="number" name="song_ratings[]" min="1" max="5" step="0.5" value="3.0"/></td>
                  <td><button type="button" name="add" id="add" class="btn-floating"><i class="material-icons">add</i></button></td>
                </tr>
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
            <option value="" disabled selected>{{ __('admin.select_genre') }}</option>
            @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
          </select>
        </div>

        <label class="rating_label">{{ __('admin.rating') }}</label>
        <div class="rating col s12">
          <p class="range-field">
            <input type="range" min="1" max="5" step="0.1" name="review_rating" required />
          </p>
        </div>
        <input class="btn col s6 offset-s3 margin-top" type="submit" value="{{ __('admin.create') }}" />
      </div>
      @include('layouts.errors')
    </form>
  </div>

  <script>
    CKEDITOR.replaceAll(function(textarea,config) {
      if(textarea.className === 'editor materialize-textarea') {
        config.height = 300;
        config.enterMode = CKEDITOR.ENTER_BR;
        config.toolbar = [
          { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
          { name: 'styles', items: [ 'Format' ] },
          { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike' ] },
          { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
          //{ name: 'links', items: [ 'Link', 'Unlink' ] },
          //{ name: 'insert', items: [ 'Image', 'EmbedSemantic', 'Table' ] },
          { name: 'tools', items: [ 'Maximize' ] }
        ];
        return true;
      } else {
        return false;
      }
    });
  </script>
@endsection
