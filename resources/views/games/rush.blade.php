<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
          content="@yield('meta_keywords',config('app.name'))">
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="copyright"content="{{ env('APP_NAME') }}">
    <meta name="subject" content="{{ env('APP_NAME') }} {{ env('APP_VERSION') }}">
    <title>{{ __('Rush Game') }} | {{ env('APP_NAME') }}</title>
    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
  <link rel="stylesheet" href="{{ asset('games/rush/css/rush-game.css') }}">
</head>
<body>
  <header>
    <h1>@translate(Rush)</h1>
  </header>
  <div id='game'>
    <canvas id='game-canvas' width='480' height='320'></canvas>
    <div id='score'>0</div>
    <div id='menu' class='scene hidden'>
      <a id='start-btn' href='#'></a>
    </div>
    <div id='gameover' class='scene hidden'>
      <div id='your-game-score'>Your Score is 100</div>
      <div id='top-scores'></div>
      <a id='restart-btn' href='#'></a>
    </div>
  </div>

  <div class='row'>
    <div class='half'>
      <h2>@translate(How to Play?)</h2>
      <ul class='how-to-play'>
        <li>@translate(Press the screen to jump.)</li>
        <li>@translate(Avoid the obstacles.)</li>
        <li>@translate(Collect the game coins.)</li>
      </ul>
    </div>
    <div class='half'>
      <h2>@translate(Your Top Scores)</h2>
      <div id='top-scores-board'></div>
    </div>
  </div>

  <div class='row hr'>
    <hr>
  </div>

  <footer>
    <input type="hidden" value="{{ env('APP_URL') }}" id="root_url">
    <input type="hidden" value="{{ route('games.rush.score.store') }}" id="games_rush_store">
    <a href="{{route('homepage')}}">
        <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}"
                alt="{{getSystemSetting('type_name')->value}}" class="footer__logo img-fluid" width="200">
    </a>
    <p>© {{ Carbon\Carbon::now()->year }} {{ getSystemSetting('type_footer')->value }}</p>
  </footer>

  <script src="{{ asset('assets/js/jquery.js') }}"></script>
  <script src="{{ asset('js/notify.js') }}"></script>
  <!-- The scripts should be concatenate and minify before deploy to production -->
  <script type="text/javascript" src='{{ asset('games/rush/vendors/easeljs-0.7.1.min.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/game.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-preloader.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-common-shapes.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-gameobject.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-movable-gameobject.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-platform.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-obstacle.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-coin.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-hero.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-topscores.js') }}'></script>
  <script type="text/javascript" src='{{ asset('games/rush/js/rush-game.js') }}'></script>

</body>
</html>