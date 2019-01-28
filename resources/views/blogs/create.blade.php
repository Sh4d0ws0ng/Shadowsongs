@extends('layouts.master')

@section('includes')
  <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
@endsection

@section('pageTitle', __('admin.create_blog'))

@section('content')

  <div class="card std form" id="blog_std">
    <ul class="tabs">
      <li class="tab"><a class="active" href="#blogstd">Default Blog-Post</a></li>
      <li class="tab"><a href="#review_catchup">Review Catchup</a></li>
      <li class="tab"><a href="#listentothis">Listen To This</a></li>
    </ul>

    <div id="blogstd" class="col s12 blog_create">
      @include('blogs.partials.create_blogstd')
    </div>
    <div id="review_catchup" class="col s12 blog_create">
      @include('blogs.partials.create_review_catchup')
    </div>
    <div id="listentothis" class="col s12 blog_create">
      @include('blogs.partials.create_listentothis')
    </div>
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
