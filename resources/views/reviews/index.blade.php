@extends('layouts.master')

@section('pageTitle', 'Reviews')

@if(empty($genre))
  @section('breadcrumbs', Breadcrumbs::render('reviews'))
@else
  @section('breadcrumbs', Breadcrumbs::render('genre'))
@endif

@section('content')

  <div class="card std center-align cardlist">
    <div class="filter">
      @if(!empty($genre))
      <div class="left">
        <span class="genre_label">Genre:</span>
        <div class="chip">{{ $genre->name }}<i class="close material-icons" onclick="closeGenre()">close</i></div>
      </div>
      @endif

      @if(isset($_GET['month']))
      <div class="left">
        <span class="date_label">{{ __('review.date') }}:</span>
        <div class="chip">{{ $_GET['month'] }} {{ $_GET['year'] }}<i class="close material-icons" onclick="closeDate()">close</i></div>
      </div>
      @endif

      <div class="right">
        <a class='dropdown-trigger btn margin-right' href='#' data-target='filter_date'><i class="material-icons right">arrow_drop_down</i>{{ __('review.filterdate') }}</a>
        <ul id='filter_date' class='dropdown-content'>
            @foreach($archives as $date)
              <li>
                <a href="?month={{ $date['month'] }}&year={{ $date['year'] }}">
                  {{ $date['month'] . ' ' . $date['year'] }}
                </a>
              </li>
            @endforeach
          </ul>
        <a class='dropdown-trigger btn' href='#' data-target='filter_genre'><i class="material-icons right">arrow_drop_down</i>Filter Genres</a>
        <ul id='filter_genre' class='dropdown-content'>
          @foreach($genres as $genre)
            <li>
              <a href="#" onclick="filterGenre('{{ $genre }}')">
                {{ $genre }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="divider"></div>
    <h3>Reviews</h3>
    <div class="card-header">
      @foreach ($reviews as $review)
      <div class='album_link'>
        <div>
          <a href='/reviews/{{ $review->id }}'><img src="/storage/cover/{{ $review->img }}" onerror="this.src='/storage/cover/default-cover.jpg'" alt='cover' />
            <h6> {{ $review->artist }} - {{ $review->title }}</h6>
            @if(App::isLocale('de'))
              <?php setlocale(LC_TIME, 'de_DE'); ?>
              {{ $review->created_at->formatLocalized('%d. %B %Y') }}
            @else
              {{ $review->created_at->formatLocalized('%B %d %Y') }}
            @endif
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  {{ $reviews->links('layouts.pagination') }}




@endsection
