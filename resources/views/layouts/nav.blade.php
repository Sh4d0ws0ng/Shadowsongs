<header>
  <nav class="nav_std">
    <div class="nav-wrapper grey darken-4">
      <div class="nav-container">
        <a href="/" class="brand-logo brand-logo-small">
         <img src="/storage/shadowsongs.png" height="36px">
         <span>ShadowSongs</span>
        </a>

        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <ul class="hide-on-med-and-down right">
          <li><a href="/"><i class="material-icons left">home</i>Home</a></li>
          <li><a href="/reviews">Reviews</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/music">{{ __('home.music') }}</a></li>
          <li>|</li>
          @if(Auth::check())
          <li>
            <a class="dropdown-trigger" href="#" data-target="user_dropdown">
              <div class="chip">
                <img src="/storage/user/{{ auth()->user()->img }}" onerror="this.src='/storage/user/user_icon_default.png'">
                <span>{{ auth()->user()->name }}</span>
              </div>
            </a>
          </li>
          @else
          <li><a href="/login" class="btn">{{ __('user.signin') }}</a></li>
          <li><a href="/register" class="btn outline">{{ __('user.signup') }}</a></li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <ul class="sidenav" id="slide-out">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="/storage/blog/default-blog.png" height="190px">
        </div>
        @if(Auth::check())
        <div class="mobile_data">
          <a href="/users/{{ auth()->user()->id }}/edit"><img class="circle" src="/storage/user/{{ auth()->user()->img }}" onerror="this.src='/storage/user/user_icon_default.png'"></a>
          <a href="/users/{{ auth()->user()->id }}/edit"><span class="white-text name">{{ auth()->user()->name }}</span></a>
          <a href="/users/{{ auth()->user()->id }}/edit"><span class="white-text email">{{ auth()->user()->email }}</span></a>
        </div>
        @else
        <div class="mobile_buttons">
          <a href="/login" class="btn">{{ __('user.signin') }}</a>
          <a href="/register" class="btn outline">{{ __('user.signup') }}</a>
          </div>
        @endif
      </div>
    </li>
    <li><a href="/"><i class="material-icons left">home</i>Home</a></li>
    <li><a href="/reviews">Reviews</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/music">{{ __('home.music') }}</a></li>
    @if(Auth::check())
    <li><a href="/logout">Logout<i class="material-icons">power_settings_new</i></a></li>
    @endif
  </ul>

  @if(Auth::check())
  <ul class="dropdown-content" id="user_dropdown">
    <li><a href="/users/{{ auth()->user()->id }}">{{ __('home.profile') }}<i class="material-icons">account_circle</i></a></li>
    <li><a href="/logout">Logout<i class="material-icons">power_settings_new</i></a></li>
  </ul>
  @endif
</header>
