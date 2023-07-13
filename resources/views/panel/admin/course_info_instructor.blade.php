@extends('layouts.admin')

@section('title') Instructors @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <!-- Add Order -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Instructors</a></li>
      </ol>
    </div>
    <!-- Card starts -->
    <div class="card">
      <div class="card-header d-block d-flex">
        <h4 class="card-title">Course Management</h4>
      </div>
      <div class="card-body">
        @if ($instructors->count() < 1) <!-- -->
          <div class="alert alert-danger">
            You have not added any instructor.
            <a href="javascript: void(0)" data-bs-toggle="modal" data-bs-target="#instructorModal">Add
              instructor</a>
          </div>
          @elseif ($instructors->count() > 0 && !$instructors->where('is_cordinator', '1')->first())
          <div class="alert alert-danger">Please set a cordinator from the instructors table below.</div>
          @endif
          @include('components.alert')

          <h6 class="mb-3">Course Title: {{ $courseInfo->course_title }}</h6>
          <h6 class="mb-3">Course Code: {{ $courseInfo->course_code }}</h6>
          <h6 class="mb-3">Course Unit: {{ $courseInfo->course_unit }}</h6>

          <div class="d-flex mt-5">
            <h3>Instructors</h3>
            <div class="ms-auto">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#instructorModal">Add
                Instructor</button>
            </div>
          </div>
          <table class="table table-responsive-md mt-3">
            <thead>
              <tr>
                <th class="width80"><strong>#</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Is Instructor</strong></th>
                <th><strong>Date Created</strong></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @php
              $count = 1;
              @endphp

              @foreach ($instructors as $instructor)
              <tr>
                <td>{{ $count++ }}</td>
                <td>{{
                  $instructor->title . ' ' . $instructor->first_name . ' ' . $instructor->middle_name . ' ' .
                  strtoupper($instructor->last_name)
                  }}</td>
                <td><span class="badge light badge-{{ $instructor->is_cordinator ? 'success' : 'danger' }}">{{
                    $instructor->is_cordinator ?
                    'Yes' : 'No' }}</span></td>
                <td>{{ date('d M, Y', strtotime($instructor->created_at)) }}</td>
                <td>
                  <a href="/admin/delete_course_instructor?course_info_id={{$courseInfo->course_info_id}}&user_id={{$instructor->user_id}}"
                    class="btn btn-danger danger">
                    <i class="flaticon-381-trash"></i>
                  </a>
                  @if (!$instructor->is_cordinator)
                  <a href="/admin/set_course_cordinator?course_info_id={{$courseInfo->course_info_id}}&user_id={{$instructor->user_id}}"
                    class="btn btn-danger light">Make Instructor</a>
                  @endif
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


<!-- Start Modal -->
<div class="modal fade" id="instructorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Instructor</h5>
        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/admin/add_lecturer_to_course">
          @csrf
          <input type="hidden" name="course_code" value="{{ $courseInfo->course_code }}">
          <input type="hidden" name="course_session" value="{{ $courseInfo->session }}">
          <div class="form-group">
            <label class="text-black font-w500">Lecturer</label>
            <select name="lecturer_id" id="lecturer_id" class="form-control mt-0" required>
              <option value=""></option>
              @foreach ($lecturers as $lecturer)
              @if ($instructors->where('user_id', $lecturer->user_id)->first())
              @continue
              @endif
              <option value="{{$lecturer->user_id}}">{{
                $lecturer->title . ' ' . $lecturer->first_name . ' ' . $lecturer->middle_name . ' ' .
                strtoupper($lecturer->last_name)
                }}</option>
              @endforeach
            </select>
            @error('lecturer_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group mt-5">
            <button type="submit" class="btn btn-primary">Add Instructor to Course</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
@endsection