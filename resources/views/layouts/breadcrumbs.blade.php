@if(count($breadcrumbs))

  <div class="breadcrumbs std">
    <ol>
        @foreach($breadcrumbs as $breadcrumb)

            @if($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>
    <div class="language_icons">
      <a href="{{ route('lang.switch', 'de') }}"><img src="/storage/de.svg" /></a>
      <a href="{{ route('lang.switch', 'en') }}"><img src="/storage/gb.svg" /></a>
    </div>
    <span class="right">{{ __('home.language') }}: </span>
  </div>

@endif
