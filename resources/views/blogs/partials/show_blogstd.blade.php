<div class="blog_post">
  <div>
    <img src='/storage/blog/{{ $blog->img }}' onerror='this.src="/storage/blog/default-blog.png"' alt='blog_img' />
  </div>
  <div class="row card-content">
    <div class='center-align blog_header col s4'>
      <table class="details">
        <tr><td>{{ __('review.author') }}: </td><td>{{ $blog->user->name }}</td></tr>
        <tr><td>{{ __('review.date') }}: </td><td>{{ $blog->created_at->diffForHumans() }}</td></tr>
      </table>
    </div>

    <div class='col s8'>
      <div class="center-align">
        <h1>{{ $blog->title }}</h1>
        <p>{!! nl2br($blog->content) !!}</p>
      </div>
    </div>
  </div>
</div>
</div>
