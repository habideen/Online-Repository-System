<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>{{env('APP_NAME')}}</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="manifest" href="site.webmanifest" />
  <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico" />

  @include('components.public.styles')
  @yield('style')
</head>

<body>
  <!-- ? Preloader Start -->
  <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
      <div class="preloader-inner position-relative">
        <div class="preloader-circle"></div>
        <div class="preloader-img pere-text">
          <img src="/assets/img/logo/logo.svg" alt="" />
          <span class="h6 d-block mt-2">Loading ...</span>
        </div>
      </div>
    </div>
  </div>
  <!-- Preloader Start -->
  <header>
    <!-- Header Start -->
    @include('components.public.menu')
    <!-- Header End -->
  </header>
  <!-- header end -->
  <main>
    @yield('content')
  </main>

  @include('components.public.footer')

  <!-- Scroll Up -->
  <div id="back-top">
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
  </div>

  <!-- JS here -->
  @include('components.public.scripts')
  @yield('script')
</body>

</html>