@extends('layouts.public')

@section('title') Login @endsection


@section('content')
<div class="breadcumb-wrapper" data-bg-src="/assets/img/breadcumb/breadcumb-bg.png">
  <div class="container z-index-common">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">Login</h1>
      <p class="breadcumb-text">Access all your courses in one place.</p>
      <div class="breadcumb-menu-wrap">
        <ul class="breadcumb-menu">
          <li><a href="/">Home</a></li>
          <li>Login</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="space-top space-extra-bottom">
  <div class="container">
    <div class="row gx-60 justify-content-center">
      <div class="col-lg-6">
        <div class="form-style4 login" data-bg-src="/assets/img/bg/course-bg-pattern.jpg">
          <h2 class="form-title">LOG IN</h2>
          <form class="mt-4 pt-3" action="{{ url('/login') }}" method="post">
            @if(Session::has('fail'))
            <div class="alert alert-danger">{!! Session::get('fail') !!}</div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif

            @csrf

            <div class="form-group">
              <input type="text" autocomplete="off" name="email" id="email" placeholder="Username or email address">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="password" id="password" placeholder="Password">
            </div>
            <div class="row justify-content-between">
              <div class="col-auto form-group">
                <input type="checkbox" name="rememberlogin" id="rememberlogin"> <label for="rememberlogin">Remember
                  me</label>
              </div>
              <div class="col-auto form-group"><a class="forget-link" href="login-register.html#">FORGET A PASSWORD?</a>
              </div>
            </div>
            <button type="submit" class="vs-btn">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection