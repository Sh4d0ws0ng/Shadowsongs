<h4 class="center-align">{{ __('admin.create_blog') }}</h4>
<form id="blog_form" action="/blog/blogstd" method="POST" name="blog_form" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="input-field col s12">
      <label for="blog_title">{{ __('admin.title') }}</label>
      <input id="blog_title" type="text" name="blog_title" required>
    </div>
    <div class="input-field col s12">
      <textarea class="editor materialize-textarea" id="blog_content" name="blog_content"></textarea>
    </div>
    <div class="file-field input-field col s6">
      <div class="btn">
        <span>{{ __('admin.upload_img') }}</span>
        <input type="file" name="blog_img" id="blog_img">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field col s6">
      <select name="blog_tags[]" multiple>
        <option value="" disabled>{{ __('admin.select_tag') }}</option>
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
      </select>
    </div>
    <input class="btn col s6 offset-s3 margin-top" type="submit" value="{{ __('admin.create') }}" />
  </div>
  @include('layouts.errors')
</form>
