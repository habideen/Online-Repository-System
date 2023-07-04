<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title', 'Page') - Online Repository System</title>
  <meta name="author" content="Vecuro">
  <meta name="description" content="Online Repository System">
  <meta name="keywords"
    content="academic, artist, center, club, coach, college, drive, driving, education, entertainment, gambling, golf, jackpot, knowledge, money, multipurpose, music, song, student">
  <meta name="robots" content="INDEX,FOLLOW">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
  <div class="preloader"><button class="vs-btn preloaderCls">Cancel Preloader</button>
    <div class="preloader-inner">
      <div class="loader"></div>
    </div>
  </div>

  @include('components.public.menu')

  @yield('content')

  @include('components.public.footer')

  <script src="/assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="/assets/js/app.min.js"></script>
  <script src="/assets/js/main.js"></script>
</body>

</html>