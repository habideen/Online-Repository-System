@extends('layouts.public')

@section('title') About Us @endsection


@section('content')
<div class="breadcumb-wrapper" data-bg-src="assets/img/breadcumb/breadcumb-bg.png">
  <div class="container z-index-common">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">About Us</h1>
      <p class="breadcumb-text">Search our encyclopedias and reference books.</p>
      <div class="breadcumb-menu-wrap">
        <ul class="breadcumb-menu">
          <li><a href="/">Home</a></li>
          <li>About Us</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="space-top">
  <div class="container">
    <div class="row">
      <div class="col-xl-9">
        <div class="title-area mb-3 mb-xl-5"><span class="sec-subtitle">Welcome to a seamless education
            experience</span>
          <h2 class="sec-title">Connect with your students online</h2>
        </div>
      </div>
      <div class="col-md-6 col-xl-4 mb-30 mb-xl-0">
        <p class="fs-md mt-n1">Welcome to a seamless education experience, where knowledge meets innovation and learning
          knows no boundaries. Together, we embark on a journey of growth and discovery, empowering you to reach new
          heights of academic excellence. Let's unlock your potential and make every step of your educational path an
          inspiring one.</p>
        <div class="media-style1">
          <div class="media-img"><img src="assets/img/about/author-1-1.png" alt="About Author"></div>
          <div class="media-body"><span class="media-label">Prof. Afolabi Samuel</span>
            <p class="media-info">Director, ICT</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-4">
        <div class="list-style1 vs-list">
          <ul>
            <li>Empowering academic excellence</li>
            <li>Inspiring educational path</li>
            <li>Learning without boundaries</li>
            <li>Empowering academic excellence</li>
            <li>Seamless education experience</li>
          </ul>
        </div>
      </div>
      <div class="col-xl-4 mt-n5 pt-5 pt-xl-0">
        <div class="img-box3">
          <div class="img-1 mega-hover"><img class="w-100" src="assets/img/about/about-s-1.png" alt="About Img"></div>
          <div class="shape-dotted jump"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="space-top space-extra-bottom">
  <div class="container">
    <div class="row justify-content-center" data-slide-show="4" data-md-slide-show="3" data-sm-slide-show="2"
      data-xs-slide-show="2">
      <div class="col-sm-6 col-lg-3">
        <div class="media-style8">
          <div class="media-icon"><img src="assets/img/icon/about-icon-2.svg" alt=""></div>
          <h5 class="media-title">200 Courses</h5>
          <p class="media-text">Our unique training, based on practical activity.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="media-style8">
          <div class="media-icon"><img src="assets/img/icon/about-icon-3.svg" alt=""></div>
          @php
          $date1 = new DateTime("1963-03-24");
          $date2 = new DateTime(date('Y-m-d'));
          @endphp
          <h5 class="media-title">{{$date1->diff($date2)->y}} Years</h5>
          <p class="media-text">Our heritage and longevity as the leading.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="media-style8">
          <div class="media-icon"><img src="assets/img/icon/about-icon-4.svg" alt=""></div>
          <h5 class="media-title">65K Students</h5>
          <p class="media-text">Our heritage and longevity as the leading.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="space-top space-bottom">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-7 text-center text-xl-start">
        <div class="title-area"><span class="sec-subtitle">TRAINING AND LEADERSHIP PROGRAMME</span>
          <h2 class="sec-title h1">Training Programme</h2>
        </div>
        <div class="row gx-80 gy-xl-4 mb-4 mb-xl-0">
          <div class="col-md-6 col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="media-style4">
              <div class="media-icon"><img src="assets/img/icon/training-icon-1-1.svg" alt=""></div>
              <h5 class="media-title">Interactive Lessons</h5>
              <p>Welcome to OAU, where a world of knowledge and opportunities awaits you!</p>
            </div>
          </div>
          <div class="col-md-6 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="media-style4">
              <div class="media-icon"><img src="assets/img/icon/training-icon-1-2.svg" alt=""></div>
              <h5 class="media-title">Subscribed Lesson</h5>
              <p>OAU now offers subscribed lessons! Enroll today for an enhanced learning experience.</p>
            </div>
          </div>
          <div class="col-md-6 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="media-style4">
              <div class="media-icon"><img src="assets/img/icon/training-icon-1-3.svg" alt=""></div>
              <h5 class="media-title">Trained & Experienced</h5>
              <p>Highly trained and experienced professionals ready to deliver exceptional results.</p>
            </div>
          </div>
          <div class="col-md-6 col-xl-6 wow fadeInUp" data-wow-delay="0.4s">
            <div class="media-style4">
              <div class="media-icon"><img src="assets/img/icon/training-icon-1-4.svg" alt=""></div>
              <h5 class="media-title">Question, Quiz & Course</h5>
              <p>Explore a variety of questions, quizzes, and educational courses designed to enrich your learning
                journey.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-5 wow fadeInUp" data-wow-delay="0.4s">
        <div class="position-relative">
          <form action="about.html#" class="form-style2">
            <div class="form-inner">
              <h3 class="form-title h5">Join over <span class="text-theme">50,000 students</span> who've now
                registered for their courses. Don’t miss out.</h3>
              <div class="row">
                <div class="col-md-6 col-xl-12">
                  <div class="form-group"><input type="text" name="name" id="name" placeholder="Complate Name"></div>
                </div>
                <div class="col-md-6 col-xl-12">
                  <div class="form-group"><input type="text" name="email" id="email" placeholder="Email Address">
                  </div>
                </div>
                <div class="col-md-6 col-xl-12">
                  <div class="form-group"><select name="coursenames" id="coursenames">
                      <option selected="selected" disabled="disabled" hidden>Select Course</option>
                      <option>Development</option>
                      <option>Ui Development</option>
                      <option>CMS Learning</option>
                      <option>Jamstack Master</option>
                    </select></div>
                </div>
                <div class="col-md-6 col-xl-12">
                  <div class="form-group"><input type="text" name="email" id="phone" placeholder="Phone No"></div>
                </div>
                <div class="col-12 text-center"><button type="button" class="vs-btn">Apply Today</button> <a
                    class="form-link" href="about.html">Frequently Asked Questions</a></div>
              </div>
            </div>
            <div class="vs-circle color2"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection