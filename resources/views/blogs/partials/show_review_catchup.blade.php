<!--img src='/storage/blog/{{ $blog->img }}' onerror='this.src="/storage/blog/default-blog.png"'/-->
<div class="center-align review_catchup blog_header row">
  <div class="col s4">
    <div class="margin-bottom details">
      <img src="/storage/blog/{{ $blog->img }}" />
    </div>
    <table class="details">
      <tr><td>{{ __('review.author') }}: </td><td>{{ $blog->user->name }}</td></tr>
      <tr><td>{{ __('review.date') }}: </td><td>{{ $blog->created_at->diffForHumans() }}</td></tr>
    </table>
  </div>
  <div class="col s8">
    <h1>{{ $blog->title }}</h1>
    <div class="divider"></div>
    <div class="card-content">
      <p>{{ $blog->content }}</p>
    </div>
  </div>
</div></div>

<?php $counter = 1; ?>
@foreach($reviews as $review)
  @if(($counter % 2) == 1)
  <div class='card std'>
    @if(Auth::check())
      @if(auth()->user()->admin)
      <div class="admin_actions">
        <a href="/reviews/{{ $review->id }}/edit" class="btn margin-right tooltipped" data-position="bottom" data-tooltip="Review bearbeiten"><i class="material-icons">edit</i></a>
        <a href="#delete_modal" class="btn margin-right red tooltipped modal-trigger" data-position="bottom" data-tooltip="Review löschen"><i class="material-icons">delete</i></a>
      </div>
      @endif
    @endif
    <div class="mreview">
      <div class="mreview_left">
        <img src="/storage/cover/{{ $review->img }}" onerror="this.src='/storage/cover/default-cover.jpg'" alt="cover" />
      </div>
      <div class="rating mreview_left">
        <div class="score-circle center-align">
          <span class="score">{{ $review->rating }}</span>
        </div>
        <div class='center-align'>
        <?php $style = " style='color: #FFD835;'";
              for($i = 1; $i <= 5; $i++) {
                echo "<label class='star_filled'";
                if(round($review->rating) >= $i) {
                  echo " style='color: #FFD835;'";
                }
                echo ">★</label>";
              } ?>
        </div>
      </div>
      <div class="center-align mreview_album">
        <h2>{{ $review->artist }}</h2>
        <h1>{{ $review->title }}</h1>
      </div>
      <div class="mreview_text card-content">
        <p>{!! nl2br($review->content) !!}</p>
      </div>
    </div>
    <div class="divider"></div>
  </div>
  @else
  <div class='card std'>
  @if(Auth::check())
    @if(auth()->user()->admin)
    <div class="admin_actions">
      <a href="/reviews/{{ $review->id }}/edit" class="btn margin-right tooltipped" data-position="bottom" data-tooltip="Review bearbeiten"><i class="material-icons">edit</i></a>
      <a href="#delete_modal" class="btn margin-right red tooltipped modal-trigger" data-position="bottom" data-tooltip="Review löschen"><i class="material-icons">delete</i></a>
    </div>
    @endif
  @endif
  <div class="mreview">
    <div class="mreview_right">
      <img src="/storage/cover/{{ $review->img }}" onerror="this.src='/storage/cover/default-cover.jpg'" alt="cover" />
    </div>
    <div class="rating mreview_right">
      <div class="score-circle center-align">
        <span class="score">{{ $review->rating }}</span>
      </div>
      <div class='center-align'>
      <?php $style = " style='color: #FFD835;'";
            for($i = 1; $i <= 5; $i++) {
              echo "<label class='star_filled'";
              if(round($review->rating) >= $i) {
                echo " style='color: #FFD835;'";
              }
              echo ">★</label>";
            } ?>
      </div>
    </div>
    <div class="center-align mreview_album_right">
      <h2>{{ $review->artist }}</h2>
      <h1>{{ $review->title }}</h1>
    </div>
    <div class="mreview_text card-content">
      <p>{!! nl2br($review->content) !!}</p>
    </div>
  </div>
  <div class="divider"></div>
  </div>
  @endif
<?php $counter++; ?>
@endforeach
