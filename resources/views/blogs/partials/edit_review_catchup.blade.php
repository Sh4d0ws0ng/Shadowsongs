<div class="card std form">
  <h4 class="center-align">Blog bearbeiten</h4>
  <form id="review_edit_form" action="/blog/{{ $blog->id }}" method="POST" name="review_form" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="hidden" name="type" value="review_catchup" />
    <div class="row">
      <div class="input-field col s12">
        <label for="blog_title" class="active">Titel</label>
        <input id="blog_title" type="text" name="blog_title" value="{{ $blog->title }}" required>
      </div>

      <div class="input-field col s12">
        <textarea class="materialize-textarea" id="blog_content" name="blog_content" required autofocus>{{ $blog->content }}</textarea>
      </div>
    </div>

    <div class="row">
      <div class="file-field input-field col s6">
        <div class="btn">
          <span>Bild hochladen</span>
          <input type="file" name="blog_img" id="blog_img">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
      <div class="input-field col s6">
        <select name="blog_tags[]" multiple>
          <option value="" disabled selected>Tags auswählen</option>
          @foreach($tags as $tag)
            @if($blog->tags->find($tag->id))
              @if($tag->id == $blog->tags->find($tag->id)->id)
              <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
              @endif
            @else
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endif
          @endforeach
        </select>
      </div>
      <input class="btn margin-top col s6 offset-s3" type="submit" value="Änderungen speichern" />
    </div>
    @include('layouts.errors')
  </form>
</div>
