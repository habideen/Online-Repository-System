@extends('layouts.admin')

@section('title') Courses @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <!-- Add Order -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Courses</a></li>
      </ol>
    </div>
    <!-- Card starts -->
    <div class="card">
      <div class="card-header d-block d-flex">
        <h4 class="card-title">List Courses</h4>
        <div class="ms-auto">
          <a href="/admin/update_session_courses" class="btn btn-dark">Refresh Session Courses</a>
        </div>
      </div>
      <div class="card-body">

        @include('components.alert')

        <h5 class="mb-4">Current Session: <b>{{ currentSession() }}</b></h5>

        <table class="table table-responsive-md mt-3">
          <thead>
            <tr>
              <th class="width80"><strong>#</strong></th>
              <th><strong>Code</strong></th>
              <th><strong>Title</strong></th>
              <th><strong>Unit</strong></th>
              <th><strong>Date Created</strong></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
            $count = 1;
            @endphp

            @foreach ($course_info as $course)
            <tr>
              <td>{{ $count++ }}</td>
              <td>{{ $course->course_code }}</td>
              <td>
                <a href="/admin/course_info?course_code={{urlencode($course->course_code)}}&session={{urlencode($course->session)}}"
                  class="link">{{
                  $course->course_title
                  }}</a>
              </td>
              <td>{{ $course->course_unit }}</td>
              <td>{{ date('d M, Y', strtotime($course->created_at)) }}</td>
              <td>
                <a href="/admin/course_info?course_code={{urlencode($course->course_code)}}&session={{urlencode($course->session)}}"
                  class="btn btn-light light sharp">
                  <i class="flaticon-381-user-9"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- End card-body -->
    </div>
    <!-- Card ends -->
  </div>
  <!-- container ends -->
</div>
@endsection