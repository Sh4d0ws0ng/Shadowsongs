<!DOCTYPE html>
<html lang="de">
  <head>
    <title>@yield('pageTitle') | ShadowSongs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="/css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Lobster|Raleway&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    @yield('includes')
  </head>
    @include('layouts.nav')
  <body>
    <main>
      @include('layouts.preloader')

      @yield('breadcrumbs')

      @if($flash = session('message'))
        <div class="flash-message">
          {{ $flash }}
        </div>
      @endif

      @include('layouts.admin')

      @yield('content')
    </main>
    @include('layouts.footer')
  </body>
</html>
