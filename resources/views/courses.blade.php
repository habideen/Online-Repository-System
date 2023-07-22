@extends('layouts.public')

@section('title') Contact Us @endsection


@section('content')
<div class="breadcumb-wrapper" data-bg-src="assets/img/breadcumb/breadcumb-bg.png">
  <div class="container z-index-common">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">Our Courses</h1>
      <p class="breadcumb-text">Search over 200 individual encyclopedias and reference books.</p>
      <div class="breadcumb-menu-wrap">
        <ul class="breadcumb-menu">
          <li><a href="/">Home</a></li>
          <li>Our Courses</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="space-top space-extra-bottom">
  <div class="container">
    <div class="row">
      @foreach ($courses as $course)
      <div class="col-md-6">
        <div class="course-style4 layout2" data-bg-src="assets/img/bg/course-list-bg.png">
          <div class="course-content">
            <h3 class="course-name"><a href="course-details.html">{{$course->course_title}}</a></h3>
            <div class="course-meta">
              <a href="course.html"><i class="fas fa-user-tie"></i><span class="total-student">{{$course->no_of_students
                  ?? 0}} Students</span></a>
              <a href="course.html"><i class="far fa-tv"></i><span class="course-hour">{{$course->no_of_lessons ?? 0}}
                  Leson</span></a>
            </div>
            <div class="course-middle">
              <a href="/course_details?course_info_id={{$course->course_info_id}}&course_title={{$course->course_title}}&course_code={{$course->course_code}}"
                class="vs-btn style5"><i class="fa fa-arrow-right"></i>View Course</a>
            </div>
            <div class="course-bottom">
              <div class="course-author">
                <a href="team-details.html" class="text-inherit"><small>Coordinator:</small> {{$course->title}}
                  {{$course->first_name}} {{$course->middle_name}} <b>{{strtoupper($course->last_name)}}</b></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{$courses->links('pagination::bootstrap-5')}}

  </div>
</section>
@endsection