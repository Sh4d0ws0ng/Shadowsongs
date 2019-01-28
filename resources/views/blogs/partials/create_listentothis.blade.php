<h4 class="center-align">{{ __('admin.create_blog') }}</h4>
<form id="blog_form" action="/blog/listentothis" method="POST" name="blog_form" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="input-field col s12">
      <label for="blog_title">{{ __('admin.title') }}</label>
      <input id="blog_title" type="text" name="blog_title" required>
    </div>
    <div class="input-field col s12 margin-bottom">
      <textarea class="editor materialize-textarea"  id="blog_content" name="blog_content"></textarea>
    </div>
    <div class="input-field col s6">
      <label for="blog_url">{{ __('admin.youtube_link') }}</label>
      <input id="blog_url" type="text" name="blog_url">
    </div>
    <div class="input-field col s6">
      <select name="blog_tags[]" multiple>
        <option value="" disabled>{{ __('admin.select_tag') }}</option>
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}" <?php if($tag->id == 2) { echo "selected"; } ?>>{{ $tag->name }}</option>
        @endforeach
      </select>
    </div>
    <input class="btn col s6 offset-s3 margin-top" type="submit" value="{{ __('admin.create') }}" />
  </div>
  @include('layouts.errors')
</form>
