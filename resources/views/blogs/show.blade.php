@extends('layouts.master')

@section('pageTitle', $blog->title)

@section('content')

  {{ Breadcrumbs::render('blog', $blog) }}

  <div class="card std">
  @if(Auth::check())
    @if(auth()->user()->admin)
    <div class="admin_actions">
      <a href="/blog/{{ $blog->id }}/edit" class="btn tooltipped" data-position="bottom" data-tooltip="Blog bearbeiten"><i class="material-icons">edit</i></a>
      <a href="#delete_modal" class="btn red tooltipped modal-trigger" data-position="bottom" data-tooltip="Blog löschen"><i class="material-icons">delete</i></a>
    </div>
    @endif
  @endif

  <div id="delete_modal" class="modal">
    <div class="modal-content">
      <h4>Wirklich löschen?</h4>
      <p>Durch die Bestätigung wird der Blogeintrag permanent entfernt.</p>
    </div>
    <div class="modal-footer">
      <form action="/blog/{{ $blog->id }}" method="POST" name="delete_form">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
        <input type="submit" class="btn red" value="Entfernen" />
      </form>
    </div>
  </div>

  @if(count($reviews))
    @include('blogs.partials.show_review_catchup')
  @elseif($blog->link != "")
    @include('blogs.partials.show_listentothis')
  @else
    @include('blogs.partials.show_blogstd')
  @endif

  <div class='row comment_container'>
    <div class='card std_half col s6 marg'>
      <h5>{{ __('review.comments') }}</h5>
      <div class='divider'></div>

      @foreach($blog->comments as $comment)
        <div class='row'>
          <div class='col s8'>
            <div class='chip'>
              <img src='/storage/user/{{ $comment->user->img }}' onerror="this.src='/storage/user_icon_default.png'">{{ $comment->user->name }}
            </div>
            {{ $comment->created_at->diffForHumans() }}
          </div>
          <div class='col s12 comment'><p>{!! $comment->content !!}</p></div>
          @if(Auth::check())
            @if(auth()->user()->admin )
              <form action="/blog/{{ $blog->id }}/comments/{{ $comment->id }}" method="POST" name="delete_form">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                <a href="#" class="btn red comment_delete tooltipped" style="right: 10px;" onclick="$(this).closest('form').submit()" data-position="bottom" data-tooltip="Kommentar löschen"><i class="material-icons">delete</i></a>
              </form>
            @endif
          @endif
        </div>
      @endforeach
    </div>

    <div id="comment_delete_modal" class="modal">
      <div class="modal-content">
        <h4>Wirklich löschen?</h4>
        <p>Durch die Bestätigung wird das Kommentar permanent entfernt.</p>
      </div>
      <div class="modal-footer">
        <form action="/blog/{{ $blog->id }}" method="POST" name="delete_form">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
          <input type="submit" class="btn red margin-left" value="Entfernen" />
        </form>
      </div>
    </div>

    <div class='card std_half col s6'>
      <h5>{{ __('review.addcomment') }}</h5>
      <div class="divider"></div>
      <form action='/blog/{{ $blog->id }}/comments' method='POST' name='comment_form' enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="comment_textarea">
          <div class='input-field'>
            @if(Auth::check())
              <label for="comment_content">{{ __('review.comment') }}</label>
              <textarea class='materialize-textarea' id='comment_content' name='comment_content' maxlength='1200' data-length='1200'></textarea>
            @else
              <textarea class='materialize-textarea' id='comment_content' name='comment_content' maxlength='1200' data-length='1200' placeholder="{{ __('review.textarea') }}" disabled></textarea>
            @endif
          </div>
          <div>
            <input type='hidden' value='{{ $blog->id }}' name='blog_id' />
            @if(Auth::check())
              <input class='btn right margin-left' type='submit' value="{{ __('review.publish') }}" />
            @else
              <input class='btn right margin-left' type='submit' value="{{ __('review.publish') }}" disabled />
              <a href='/login' class='btn right margin-left'>{{ __('review.login') }}</a>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection
