@extends('layouts.public')

@section('title') Course Details: {{ $courseInfo->course_title }} @endsection


@section('content')
<div class="breadcumb-wrapper" data-bg-src="assets/img/breadcumb/breadcumb-bg.png">
  <div class="container z-index-common">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">Course Details</h1>
      <p class="breadcumb-text">{{ $courseInfo->course_title }}</p>
      <div class="breadcumb-menu-wrap">
        <ul class="breadcumb-menu">
          <li><a href="/">Home</a></li>
          <li>{{ $courseInfo->course_title }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="course-details space-top space-extra-bottom">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-4">
        <div class="course-meta-box">
          <table>
            <tbody>
              <tr>
                <th><i class="far fa-clock"></i>Weekly Study:</th>
                <td>11 Hours</td>
              </tr>
              <tr>
                <th><i class="far fa-user-alt"></i>Student:</th>
                <td>204 Students</td>
              </tr>
              <tr>
                <th><i class="far fa-suitcase"></i>Course Type:</th>
                <td>Online & Offline</td>
              </tr>
            </tbody>
          </table><a href="contact.html" class="vs-btn">Join Course</a>
        </div>
      </div>
      <div class="col-lg-8">
        <h2 class="course-title">{{ $courseInfo->course_title }}</h2>
        <h5 class="border-title2 mt-5">Introduction</h5>
        <div class="markdownView">{{ $courseInfo->introduction }}</div>

        <h5 class="border-title2 mt-5">Grading Information</h5>
        <div class="markdownView">{{ $courseInfo->grading_information }}</div>

        <div class="inner-video-box d-none"><img src="assets/img/course/course-details-2.jpg" alt="blog video"> <a
            href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn position-center popup-video"><i
              class="fas fa-play"></i></a></div>

        <div class="accordion accordion-style4" id="faqVersion2">
          @php
          $count = 1;
          @endphp
          @foreach ($materials as $material)
          <div class="accordion-item {{ $count == 1 ? 'active' : ''}}">
            <div class="accordion-header" id="headingOne"><button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne"><span class="button-label">Section {{ $count }}</span> {{
                $material->material_title
                }}</button></div>
            <div id="collapseOne" class="accordion-collapse collapse {{ $count++ == 1 ? 'show' : ''}}"
              aria-labelledby="headingOne" data-bs-parent="#faqVersion2">
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
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <h5 class="border-title2">Who will you learn with?</h5>
        <div class="row vs-carousel gx-40" data-slide-show="2" data-lg-slide-show="2" data-md-slide-show="2"
          data-sm-slide-show="2" data-center-mode="true">
          @php
          $count = 1;
          @endphp
          @foreach ($instructors as $instructor)
          <div class="col-sm-6 col-lg-4">
            <div class="team-style2">
              <div class="team-content">
                <h4 class="team-name"><a href="team-details.html"><small>{{ $count++ }})</small> {{ $instructor->title
                    }} {{
                    $instructor->first_name }}
                    {{ $instructor->middle_name }} {{ $instructor->last_name }}</a></h4>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
  $('.markdownView').each(function(i, obj) {
      $(this).html( marked.parse($(this).text()) )
  });
</script>
@endsection