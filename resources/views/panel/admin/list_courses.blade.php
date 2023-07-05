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
      <div class="card-header d-block">
        <h4 class="card-title">List Courses</h4>
      </div>
      <div class="card-body">
        <table class="table table-responsive-md">
          <thead>
            <tr>
              <th class="width80"><strong>#</strong></th>
              <th><strong>COURSE CODE</strong></th>
              <th><strong>COURSE TITLE</strong></th>
              <th><strong>DATE CREATED</strong></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
            $count = 1;
            @endphp

            @foreach ($courses as $course)
            <tr>
              <td>{{ $count++ }}</td>
              <td>{{ $course->course_code }}</td>
              <td>
                <a href="/admin/edit_course/{{$course->course_code}}" class="link">{{
                  $course->course_title
                  }}</a>
              </td>
              <td>{{ date('d M, Y', strtotime($course->created_at)) }}</td>
              <td>
                <a href="/admin/edit_course/{{$course->course_code}}" class="btn btn-success light sharp">
                  @component('components.svg.hr-dot3', ['height'=>'20', 'width'=>'20'])
                  @endcomponent
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