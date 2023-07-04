@extends('layouts.public')

@section('title') Sign Up @endsection


@section('content')
<div class="breadcumb-wrapper" data-bg-src="/assets/img/breadcumb/breadcumb-bg.png">
  <div class="container z-index-common">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">Sign Up</h1>
      <p class="breadcumb-text">Access all your courses in one place.</p>
      <div class="breadcumb-menu-wrap">
        <ul class="breadcumb-menu">
          <li><a href="/">Home</a></li>
          <li>Sign Up</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="space-top space-extra-bottom">
  <div class="container">
    <div class="row gx-60 justify-content-center">
      <div class="col-lg-6">
        <div class="form-style4 signup" data-bg-src="/assets/img/bg/course-bg-pattern.jpg">
          <form class="mt-4 pt-3" action="{{ url('/register') }}" method="post">
            <h2 class="form-title">SIGN UP</h2>
            @if(Session::has('fail'))
            <div class="alert alert-danger">{!! Session::get('fail') !!}</div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif

            @csrf

            <div class="form-group">
              <input type="text" autocomplete="off" name="signupname" id="signupname" placeholder="Complete Name">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="signupemail" id="signupemail" placeholder="Email address">
            </div>
            <div class="form-group">
              <input type="text" autocomplete="off" name="signupphone" id="signupphone" placeholder="Password">
            </div>
            <button type="button" class="vs-btn">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection