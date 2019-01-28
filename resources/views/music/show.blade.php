@extends('layouts.master')

@section('pageTitle', 'Music')

@section('content')

<div class="card std review_catchup">
  <div class="divider"></div>
  <div class="center-align">
    <h2>Review CatchUp #1</h2>
  </div>
  <div class="divider"></div>
</div>

<div class='card std'>
  <div class="divider"></div>
  <div class="mreview">
    <div class="mreview_left">
      <img src="/storage/cover/brand_new_-_science_fiction.jpg" />
    </div>
    <div class="rating mreview_left">
      <div class="score-circle center-align">
        <span class="score">5.0</span>
      </div>
      <div class='center-align'>
      <?php $style = " style='color: #FFD835;'";
            for($i = 1; $i <= 5; $i++) {
              echo "<label class='star_filled'";
              if(round(5) >= $i) {
                echo " style='color: #FFD835;'";
              }
              echo ">★</label>";
            } ?>
      </div>
    </div>
    <div class="center-align mreview_album">
      <h2>Brand New</h2>
      <h1>Science Fiction</h1>
    </div>
    <div class="mreview_text">
      <h6>Überschrift</h6>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>
  <div class="divider"></div>
</div>

<div class='card std'>
  <div class="mreview">
    <div class="mreview_right">
      <img src="/storage/cover/brand_new_-_science_fiction.jpg" />
    </div>
    <div class="rating mreview_right">
      <div class="score-circle center-align">
        <span class="score">5.0</span>
      </div>
      <div class='center-align'>
      <?php $style = " style='color: #FFD835;'";
            for($i = 1; $i <= 5; $i++) {
              echo "<label class='star_filled'";
              if(round(5) >= $i) {
                echo " style='color: #FFD835;'";
              }
              echo ">★</label>";
            } ?>
      </div>
    </div>
    <div class="center-align mreview_album_right">
      <h2>Brand New</h2>
      <h1>Science Fiction</h1>
    </div>
    <div class="mreview_text_right">
      <h6>Überschrift</h6>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>
  <div class="divider"></div>
</div>

@endsection
