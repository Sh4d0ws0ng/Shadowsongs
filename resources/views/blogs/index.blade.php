@extends('layouts.master')

@section('pageTitle', 'Blog')

@if(empty($tag))
  @section('breadcrumbs', Breadcrumbs::render('blogs'))
@else
  @section('breadcrumbs', Breadcrumbs::render('tag'))
@endif

@section('content')

  <div class="blog_container">
    @foreach($blogs as $blog)
    <div class="blog-item">
      <div class='card blog'>
        <div class='card-image'>
          <a href='/blog/{{ $blog->id }}'><img src='/storage/blog/{{ $blog->img }}' onerror='this.src="/storage/blog/default-blog.png"'></a>
        </div>
        <div class='card-content blog-height'>
          <div class="blog_tags">
            @if(count($blog->tags))
              @foreach($blog->tags as $tag)
                <a href="#" onclick="filterTag('{{ $tag->name }}')">{{ $tag->name }}</a>
                <span class="tagSplit"> | </span>
              @endforeach
            @endif
          </div>
          <div class="blog_date">
            @if(App::isLocale('de'))
              <?php setlocale(LC_TIME, 'de_DE'); ?>
              {{ $blog->created_at->formatLocalized('%d. %B %Y') }}
              <span><i> von </i></span>
            @else
              {{ $blog->created_at->formatLocalized('%B %d %Y') }}
              <span><i> by </i></span>
            @endif
            {{ $blog->user->name }}
            </div>
          <h4>{{ $blog->title }}</h4>
          <p>{!! \Illuminate\Support\Str::words($blog->content, $limit = 32, $end = '...')  !!}</p>
        </div>
        <div class='card-action'><a href='/blog/{{ $blog->id }}'>Weiterlesen</a></div>
        <div class="card_line deep-purple"></div>
      </div>
    </div>
    @endforeach
  </div>

  {{ $blogs->links('layouts.pagination') }}

@endsection
