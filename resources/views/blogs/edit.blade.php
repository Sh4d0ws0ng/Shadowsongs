@extends('layouts.master')

@section('includes')
  <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
@endsection

@section('pageTitle', 'Blog bearbeiten')

@section('content')

  @if(count($reviews) > 0)
    @include('blogs.partials.edit_review_catchup')
  @elseif($blog->link != "")
    @include('blogs.partials.edit_listentothis')
  @else
    @include('blogs.partials.edit_blogstd')
  @endif

  <!--div class="card std form">
    <h4 class="center-align">Blog bearbeiten</h4>
    <form id="review_edit_form" action="/blog/{{ $blog->id }}" method="POST" name="review_form" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="row">
        <div class="input-field col s12">
          <label for="blog_title" class="active">Titel</label>
          <input id="blog_title" type="text" name="blog_title" value="{{ $blog->title }}" required>
        </div>

        <div class="input-field col s12">
          <textarea class="materialize-textarea" id="blog_content" name="blog_content" required autofocus>{{ $blog->content }}</textarea>
        </div>

        <div class="file-field input-field col s12">
          <div class="btn">
            <span>Bild hochladen</span>
            <input type="file" name="blog_img" id="blog_img">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <input class="btn margin-top col s6 offset-s3" type="submit" value="Änderungen speichern" />
      @include('layouts.errors')
    </form>
  </div-->

@endsection
