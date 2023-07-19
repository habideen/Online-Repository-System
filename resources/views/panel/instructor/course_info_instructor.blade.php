@extends('layouts.instructor')

@section('title') Course Management @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <!-- Add Order -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Course Management</a></li>
      </ol>
    </div>
    <!-- Card starts -->
    <div class="card">
      <div class="card-header d-block d-flex">
        <h4 class="card-title">Course Management</h4>
        <div class="ms-auto">
          @if ($courseInfo->session == currentSession())
          <a href="/instructor/current_session" class="btn btn-light">Go to course list</a>
          @else
          <a href="/instructor/all_session" class="btn btn-light">Go to course list</a>
          @endif
        </div>
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
          <h6 class="mb-3">Session: {{ $courseInfo->session }}</h6>

          <hr class="mt-5 mb-5">

          <div class="mt-5">
            <h4>Instructors</h4>
          </div>
          <table class="table table-responsive-md mt-3">
            <thead>
              <tr>
                <th class="width80"><strong>#</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Is Instructor</strong></th>
                <th><strong>Date Created</strong></th>
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
              </tr>
              @endforeach
            </tbody>
          </table>

          <hr class="mt-5 mb-5">

          <div class="d-flex">
            <div class="ms-auto">
              <a href="/instructor/add_material?course_info_id={{ 
                 $courseInfo->course_info_id . '&course_code=' . $courseInfo->course_code . '&session=' . $courseInfo->session}}"
                class="btn btn-info">Add Course</a>
            </div>
          </div>
          <div class="mb-3">
            <h4>Course Information</h4>
            <span class="text-muted">Expand the headings below to edit them</span>
          </div>
          <div class="accordion accordion-flush" id="courseInfoAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-introduction" aria-expanded="false" aria-controls="flush-collapseOne">
                  Introduction
                </button>
              </h2>
              <div id="flush-introduction" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#courseInfoAccordion">
                <div class="accordion-body">
                  <div class="markdownView">{{ $courseInfo->introduction }}</div>
                  <div class="mt-4">
                    <a href="javascript: void(0)" class="btn btn-primary light" data-bs-toggle="modal"
                      data-bs-target="#introductionModal">Update
                      Introduction</a>
                  </div>
                </div>
              </div>
            </div><!-- End accordion-item -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-gradingInfo" aria-expanded="false" aria-controls="flush-collapseOne">
                  Grading
                </button>
              </h2>
              <div id="flush-gradingInfo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#courseInfoAccordion">
                <div class="accordion-body">
                  <div class="markdownView">{{ $courseInfo->grading_information }}</div>
                  <div class="mt-4">
                    <a href="javascript: void(0)" class="btn btn-primary light" data-bs-toggle="modal"
                      data-bs-target="#gradingInfoModal">Update
                      Grading Information</a>
                  </div>
                </div>
              </div>
            </div><!-- End accordion-item -->

            @foreach ($materials as $material)
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-{{$material->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$material->material_title}}
                </button>
              </h2>
              <div id="flush-{{$material->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#courseInfoAccordion">
                <div class="accordion-body">
                  <div class="markdownView">{{ $material->material_information }}</div>
                  <div class="downloads mt-4">
                    @php
                    $filter = $downloads->where('course_upload_id', $material->id);
                    @endphp
                    @foreach ($filter as $download)
                    <p class="mb-3">
                      <a href="/instructor/download/material/{{$download->id}}/{{$download->link}}"><i
                          class="fa fa-download me-2"></i>{{$download->title}}</a>
                    </p>
                    @endforeach
                  </div>
                  <div class="mt-4">
                    <a href="/instructor/edit_material?course_info_id={{ 
                      $courseInfo->course_info_id . '&course_code=' . $courseInfo->course_code . '&session=' . $courseInfo->session
                      . '&material_id=' . $material->id}}" class="btn btn-primary light">Update</a>
                  </div>
                </div>
              </div>
            </div><!-- End accordion-item -->
            @endforeach

          </div><!-- End accordion accordion-flush -->
      </div>
      <!-- End card-body -->
    </div>
    <!-- Card ends -->
  </div>
  <!-- container ends -->
</div>



@if ($isInstructor)
@include('components.panel.course-introduction-grading')
@endif
@endsection


@section('script')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
  const easyMDE = new EasyMDE({element: document.getElementById('introductionInput')});
  $('#introductionModal').on('shown.bs.modal', function () {
    easyMDE.codemirror.refresh()
  });

  const easyMDEGrading = new EasyMDE({element: document.getElementById('gradingInfoInput')});
  $('#gradingInfoModal').on('shown.bs.modal', function () {
    easyMDEGrading.codemirror.refresh()
  });

  $('.markdownView').each(function(i, obj) {
      $(this).html( marked.parse($(this).text()) )
  });
</script>
@endsection