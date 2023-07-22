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
          @include('components.alert')

          <form action="/register" method="POST" id="main_author_form">
            @csrf

            <div class="form-group">
              <div class="float-input-container">
                <input type="text" class="float-input-box form-control" name="last_name" value="{{old('last_name')}}"
                  id="last_name" placeholder=" " pattern="^[a-zA-Z\-]{2,30}$" required>
                <label class="float-input-placeholder">Last name *</label>
              </div>
              @error('last_name')
              <span class="text-danger d-block text-start mb-2">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group mt-4">
              <div class="float-input-container">
                <input type="text" class="float-input-box form-control" name="first_name" value="{{old('first_name')}}"
                  id="first_name" placeholder=" " pattern="^[a-zA-Z\-]{2,30}$" required>
                <label class="float-input-placeholder">First name *</label>
              </div>
              @error('first_name')
              <span class="text-danger d-block text-start mb-2">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group mt-4">
              <div class="float-input-container">
                <input type="text" class="float-input-box form-control" name="middle_name"
                  value="{{old('middle_name')}}" id="middle_name" placeholder=" " pattern="^[a-zA-Z\-]{2,30}$">
                <label class="float-input-placeholder">Middle name </label>
              </div>
              @error('middle_name')
              <span class="text-danger d-block text-start mb-2">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group mt-4 text-start">
              <select class="form-control" name="gender" id="gender" required>
                <option value="">Select gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
              </select>
              @error('gender')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group mt-5">
              <div class="float-input-container">
                <input type="text" class="float-input-box form-control" name="phone" value="{{old('phone')}}" id="phone"
                  placeholder=" " pattern="^[+]{0,1}[0-9]{6,20}$" required>
                <label class="float-input-placeholder">Mobile number *</label>
              </div>
              @error('phone')
              <span class="text-danger d-block text-start mb-2">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group mt-4">
              <div class="float-input-container">
                <input type="email" class="float-input-box form-control" name="email" value="{{old('email')}}"
                  id="email" placeholder=" " required>
                <label class="float-input-placeholder">Email *</label>
              </div>
              @error('email')
              <span class="text-danger d-block text-start mb-2">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <div class="float-input-container mt-5">
                <input type="password" class="float-input-box form-control" name="password" id="password"
                  placeholder=" " required>
                <label class="float-input-placeholder">Password *</label>
              </div>
              @error('password')
              <span class="text-danger d-block text-start mb-2">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group mt-4">
              <div class="float-input-container">
                <input type="password" class="float-input-box form-control" name="password_confirmation"
                  id="password_confirmation" placeholder=" " required>
                <label class="float-input-placeholder">Password Confirmation *</label>
              </div>
              @error('password_confirmation')
              <span class="text-danger d-block text-start mb-2">{{$message}}</span>
              @enderror
            </div>

            <div class="common_form_submit mt-4">
              <button type="submit" class="vs-btn">Register</button>
            </div>
            <div class="have_acount_area other_author_option mt-5">
              <p>Already have an account? <a href="/login">Log in now</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('css')
<link rel="stylesheet" href="/assets/css/custom.css">
@endsection


@section('script')
<script>
  $('#gender').val('{{ old('gender') ?? $user->gender ?? '' }}')
</script>
@endsection