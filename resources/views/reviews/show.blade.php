@extends('layouts.master')

@section('pageTitle', $review->artist.' - '.$review->title)

@section('content')

	{{ Breadcrumbs::render('review', $review) }}

	<div class="card std">
		<div id="delete_modal" class="modal">
	    <div class="modal-content">
				<h4>Wirklich löschen?</h4>
				<p>Durch die Bestätigung wird das Review und alle assoziierten Songs permanent entfernt.</p>
	    </div>
	    <div class="modal-footer">
				<form action="/reviews/{{ $review->id }}" method="POST" name="delete_form">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input type="hidden" name="review_id" value="{{ $review->id }}" />
	      	<input type="submit" class="btn red" value="Entfernen" />
				</form>
	    </div>
	  </div>

    <div class="card-head row valign-wrapper">
      <div class="cover col s3">
        <img src="/storage/cover/{{ $review->img }}" onerror="this.src='/storage/cover/default-cover.jpg'" alt="cover" />
      </div>
      <div class="title col s6 center-align">
        <div class="artist">
          <h1>{{ $review->artist }}</h1>
        </div>
        <div class="album">
          <h1>{{ $review->title }}</h1>
        </div>
        <div class="tags">
					@if(count($review->genres))
						@foreach($review->genres as $genre)
	          	<a href="#" onclick="filterGenre('{{ $genre->name }}')"><div class="chip">{{ $genre->name }}</div></a>
						@endforeach
					@endif
        </div>
      </div>
      <div class="rating col s3">
				@if(Auth::check())
					@if(auth()->user()->admin)
					<div class="admin_actions">
						<a href="/reviews/{{ $review->id }}/edit" class="btn tooltipped" data-position="bottom" data-tooltip="Review bearbeiten"><i class="material-icons">edit</i></a>
						<a href="#delete_modal" class="btn red tooltipped modal-trigger" data-position="bottom" data-tooltip="Review löschen"><i class="material-icons">delete</i></a>
					</div>
					@endif
				@endif
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
    </div>
    <div class="divider"></div>
    <div class="card-content row">
      <div class="left col s4">
        <div>
					@if($review->release_date !== null || $review->label !== '' || $review->homepage !== '' || $review->spotify !== '')
					<table class="details">
						@if($review->release_date !== null)
							<tr><td>{{ __('review.release_date') }}: </td><td class="detail_content">
								@if(App::isLocale('de'))
		              <?php setlocale(LC_TIME, 'de_DE'); ?>
		              {{ $review->release_date->formatLocalized('%d. %B %Y') }}
		            @else
		              {{ $review->release_date->formatLocalized('%B %d %Y') }}
		            @endif
							</td></tr>
						@endif
						@if($review->label !== '')
							<tr><td>{{ __('review.label') }}: </td><td class="detail_content">{{ $review->label }}</td></tr>
						@endif
						@if($review->homepage !== '')
          		<tr><td>{{ __('review.homepage') }}: </td><td class="detail_content"><a href="http://{{ $review->homepage }}" target="_blank">{{ $review->homepage }}</a></td></tr>
						@endif
						@if($review->spotify !== '')
							<tr><td>{{ __('review.listennow') }}: </td><td><a href="{{ $review->spotify }}" target="_blank" class="left"><img src="/storage/spotify.png" alt="spotify" width="80px"></a></td></tr>
						@endif
					</table>
					@endif
					<!--table class="details">
						{{-- @for($i = 0; $i < count($information); $i++)
							@if(is_array($information[$i][1]))
								<tr><td>{{ $information[$i][0] }}: </td><td><ul>
								@for($j = 0; $j < count($information[$i][1]); $j++)
									<li>{{ $information[$i][1][$j] }}</li>
								@endfor
								</ul></td></tr>
							@else
								<tr><td>{{ $information[$i][0] }}: </td><td>{{ $information[$i][1] }}</td></tr>
							@endif
						@endfor --}}
					</table-->
        </div>
        <div class="details">
					<div class="latestReviews">
						<h6 style="text-align: center;">{{ __('review.latestreviews') }}</h6>
						<ul>
							@for($i = 0; $i < 5; $i++)
								@if($reviews[$i]->id != $review->id)
								<a href="/reviews/{{ $reviews[$i]->id }}">
									<li style="margin-top: 1rem;">
										<span class="right">{{ $reviews[$i]->rating }}</span>
										<span class="latestShortenText">{{ $reviews[$i]->artist }} - {{ $reviews[$i]->title }}</span>
										<div class="score-outer">
		                	<div class="score-line" style="width: {{ $reviews[$i]->rating * 20 }}%;">
												<span></span>
											</div>
		                </div>
									</li>
								</a>
								@else
									<?php $five = true; ?>
								@endif
							@endfor
							@isset($five)
							<a href="/reviews/{{ $reviews[5]->id }}">
								<li style="margin-top: 1rem;">
									<span class="right">{{ $reviews[5]->rating }}</span>
									<span class="latestShortenText">{{ $reviews[5]->artist }} - {{ $reviews[5]->title }}</span>
									<div class="score-outer">
										<div class="score-line" style="width: {{ $reviews[5]->rating * 20 }}%;">
											<span></span>
										</div>
									</div>
								</li>
							</a>
							@endisset
						</ul>
					</div>
        </div>
      </div>
      <div class="col s8 text">
				@if(App::isLocale('en'))
        <p>{!! nl2br($review->content_en) !!}</p>
				@else
				<p>{!! nl2br($review->content) !!}</p>
				@endif
				<table>
					<col width="85%">
					<col width="15%">

					@foreach($review->songs as $song)
						@if($song->number < 10)
						<tr><td>0{{ $song->number }}. &nbsp;{{ $song->title }}</td><td>{{ $song->rating }}</td></tr>
						@else
						<tr><td>{{ $song->number }}. &nbsp;{{ $song->title }}</td><td>{{ $song->rating }}</td></tr>
						@endif
					@endforeach
				</table>
				<div class="author right">
					@if(App::isLocale('de'))
            <?php setlocale(LC_TIME, 'de_DE'); ?>
            {{ $review->created_at->formatLocalized('%d. %B %Y') }}
          @else
            {{ $review->created_at->formatLocalized('%B %d %Y') }}
          @endif
					<span>{{ __('review.by') }}</span>
					<a href="/users/{{ $review->user->id }}">
						<div class="chip">
							<img src="/storage/user/{{ $review->user->img }}">
							<span>{{ $review->user->name }}</span>
						</div>
					</a>
				</div>
      </div>
    </div>
	</div>

	<div class='row comment_container'>
    <div class='card std_half col s6 marg'>
      <h5>{{ __('review.comments') }}</h5>
      <div class='divider'></div>
			@foreach($review->comments as $comment)

			<div class='row'>
        <div class='col s8'>
					<a href="/users/{{ $review->user->id }}">
						<div class='chip'>
							<img src='/storage/user/{{ $comment->user->img }}' onerror="this.src='/storage/user_icon_default.png'">{{ $comment->user->name }}
	 					</div>
					</a>
					{{ $comment->created_at->diffForHumans() }}
				</div>
				<div class='starpadd'>
					<?php if($comment->rating != null) {
									$style = " style='color: #FFD835;'";
								 	for($i = 1; $i <= 5; $i++) {
									 	echo "<label class='star_filled_small'";
									 	if(round($comment->rating) >= $i) {
										 	echo " style='color: #FFD835;'";
									 	}
									 	echo ">★</label>";
									}
						 		} ?>
      	</div>
        <div class='col s12 comment'><p>{!! $comment->content !!}</p></div>

				@if(Auth::check())
					@if(auth()->user()->admin)
						<form action="/reviews/{{ $review->id }}/comments/{{ $comment->id }}" method="POST" name="delete_form">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input type="hidden" name="comment_id" value="{{ $comment->id }}" />
							<a href="#" class="btn red comment_delete tooltipped" onclick="$(this).closest('form').submit()" data-position="bottom" data-tooltip="Kommentar löschen"><i class="material-icons">delete</i></a>
						</form>
					@endif
				@endif
      </div>


			@endforeach
		</div>

		<div id="comment_delete_modal" class="modal">
	    <div class="modal-content">
				<h4>Wirklich löschen?</h4>
				<p>Durch die Bestätigung wird das Komme permanent entfernt.</p>
	    </div>
	    <div class="modal-footer">
				<form action="/reviews/{{ $review->id }}" method="POST" name="delete_form">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input type="hidden" name="review_id" value="{{ $review->id }}" />
	      	<input type="submit" class="btn red margin-left" value="Entfernen" />
				</form>
	    </div>
	  </div>

    <div class='card std_half col s6'>
      <h5>{{ __('review.addcomment') }}</h5>
			<div class="divider"></div>
      <form action='/reviews/{{ $review->id }}/comments' method='POST' name='comment_form' enctype='multipart/form-data'>
				{{ csrf_field() }}
        <div class="comment_textarea">
          <div class='input-field'>
						@if(Auth::check())
							<label for="comment_content">{{ __('review.comment') }}</label>
            	<textarea class='materialize-textarea' id='comment_content' name='comment_content' datalength='1200' data-length='1200'></textarea>
						@else
							<textarea class='materialize-textarea' id='comment_content' name='comment_content' datalength='1200' data-length='1200' placeholder="{{ __('review.textarea') }}" disabled></textarea>
						@endif
          </div>
          <div>
						<div class="rating_label">{{ __('review.rating') }}: </div>
						<input type="number" min="1" max="5" name="comment_rating" placeholder="1-5">
          </div>
          <div>
            <input type='hidden' value='{{ $review->id }}' name='review_id' />
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
