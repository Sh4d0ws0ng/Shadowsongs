  <div class="blog_post">
    <div class='card-content row'>
      <div class="col s4">
        <div class="margin-bottom">
          <table class="details margin-top">
            <tr><td>{{ __('review.author') }}: </td><td>{{ $blog->user->name }}</td></tr>
            <tr><td>{{ __('review.date') }}: </td><td>{{ $blog->created_at->diffForHumans() }}</td></tr>
          </table>
        </div>
        <div class="left details center-align">
          <h5 class="margin-top margin-bottom">Latest Posts</h5>
          <a href="/blog/{{ $listentothis->id }}">
            <img src="/storage/blog/{{ $listentothis->img }}" alt="default-blog.png" width="95%" />
            <h6>{{ $listentothis->title }}</h6>
          </a>
        </div>
      </div>
      <div class="col s8 center-align">
        <h1>{{ $blog->title }}</h1>
        <p>{!! nl2br($blog->content) !!}</p>
      </div>
    </div>
  </div>
</div>
