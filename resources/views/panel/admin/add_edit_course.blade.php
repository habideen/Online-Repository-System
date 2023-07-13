@extends('layouts.admin')

@php
$titleTxt = Request::segment(2) == 'add_course' ? 'Add Course' : 'Edit Course';
@endphp

@section('title') Course @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $titleTxt }}</a></li>
      </ol>
    </div>
    <!-- row -->
    <!-- Row starts -->
    <div class="card">
      <div class="card-header d-block d-flex">
        <h4 class="card-title">{{ $titleTxt }}</h4>
        @if ($course && $course->course_code)
        <div class="ms-auto">
          <a href="/admin/list/courses" class="btn btn-light">Go Back</a>
        </div>
        @endif
      </div>
      <div class="card-body">

        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif

        <div class="row justify-content-between">

          <form action="/admin/create_or_update_course" method="post" class="">
            @csrf

            <input type="text" name="edit_course_code" value="{{$course->course_code ?? ''}}" class="d-none" readonly>

            <div class="row">
              <div class="col-sm-6 col-md-5 form-group mb-4">
                <label for="course_code">Course Code</label>
                <input type="text" class="form-control" name="course_code" id="course_code" placeholder="e.g. CSC 123"
                  value="{{ old('course_code') ?? $course->course_code ?? '' }}" required='true'
                  pattern="^[ ]*[A-Za-z]{3,3}[ ]*[0-9]{3,3}[ ]*$">
                @error('course_code')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-sm-6 col-md-5 form-group mb-4">
                <label for="course_unit">Course Unit</label>
                <input type="number" class="form-control" name="course_unit" id="course_unit" placeholder="e.g. 2"
                  value="{{ old('course_unit') ?? $course->course_unit ?? '' }}" required='true' min="0" max="99">
                @error('course_unit')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-sm-12 form-group mb-4">
                <label for="course_title">Course Title</label>
                <input type="text" class="form-control" name="course_title" id="course_title" placeholder=""
                  value="{{ old('course_title') ?? $course->course_title ?? '' }}" required='true'
                  pattern="^[A-Za-z0-9 \(\)\-]{2,100}$">
                @error('course_title')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="form-group mt-5">
              <button class="btn btn-primary form-control" type="submit">{{ $titleTxt }}</button>
            </div>

          </form>

        </div>
      </div>
      <!--card-body-->
    </div>
    <!-- Row ends -->
  </div>
  <!-- container ends -->
</div>
@endsection


@section('script')
<script>
  $(document).ready(function() {
    //
  })
</script>
@endsection