<h4 class="center-align">{{ __('admin.create_blog') }}</h4>
<form id="blog_form" action="/blog/review_catchup" method="POST" name="blog_form" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="input-field col s12">
      <label for="blog_title">{{ __('admin.title') }}</label>
      <input id="blog_title" type="text" name="blog_title" required>
    </div>
    <div class="input-field col s12">
      <textarea class="editor materialize-textarea" id="blog_content" name="blog_content"></textarea>
    </div>
  </div>

  <div id="sReviews">
    <div class="small_review row">
      <div class="input-field col s6">
        <label for="review_title">{{ __('admin.album_title') }}</label>
        <input id="review_title" type="text" name="sReview_titles[]">
      </div>
      <div class="input-field col s6">
        <label for="review_artist">{{ __('admin.artist') }}</label>
        <input id="review_artist" type="text" name="sReview_artists[]">
      </div>
      <div class="input-field col s12">
        <label for="review_content">{{ __('admin.review_text') }}</label>
        <textarea class="materialize-textarea" id="review_content" name="sReview_contents[]"></textarea>
      </div>
      <div class="file-field input-field col s6">
        <div class="btn">
          <span>{{ __('admin.upload_cover') }}</span>
          <input type="file" name="sReview_imgs[]" id="review_img">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
      <label class="rating_label">{{ __('admin.rating') }}</label>
      <div class="rating col s6">
        <p class="range-field">
          <input type="range" min="1" max="5" step="0.1" name="sReview_ratings[]" />
        </p>
      </div>
    </div>
  </div>

  <a class="btn-floating btn-large green right" id="addReview"><i class="material-icons">add</i></a>

  <div class="row">
    <div class="input-field col s6">
      <select name="blog_tags[]" multiple>
        <option value="" disabled>{{ __('admin.select_tag') }}</option>
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}" <?php if($tag->id == 1) { echo "selected"; } ?>>{{ $tag->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="file-field input-field col s12">
      <div class="btn">
        <span>{{ __('admin.upload_img') }}</span>
        <input type="file" name="blog_img" id="blog_img">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>

    <input class="btn col s6 offset-s3 margin-top" type="submit" value="{{ __('admin.create') }}" />
  </div>
  @include('layouts.errors')
</form>
