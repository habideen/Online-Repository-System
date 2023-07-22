@extends('layouts.public')

@section('title') Contact Us @endsection


@section('content')
<div class="breadcumb-wrapper" data-bg-src="assets/img/breadcumb/breadcumb-bg.png">
  <div class="container z-index-common">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">Contac Us</h1>
      <p class="breadcumb-text">Search over 200 individual encyclopedias and reference books.</p>
      <div class="breadcumb-menu-wrap">
        <ul class="breadcumb-menu">
          <li><a href="/">Home</a></li>
          <li>Contac Us</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="space-top space-extra-bottom">
  <div class="container">
    <div class="row gx-80">
      <div class="col-lg-6 col-xl-6 mb-30 mb-lg-0">
        <h2 class="h1 mt-n2">Get in Touch to Learn About Programmes</h2>
        <p class="fs-md mb-4 pb-2">become a partner school, or discover more about our work.</p>
        <h3 class="border-title2 h5">Regional Office</h3>
        <p class="contact-info"><i class="fas fa-clock"></i> Office hours are 9am - 4pm<br>Monday-Thursday and 9am –
          1pm on Friday.</p>
        <p class="contact-info"><i class="fas fa-map-marker-alt"></i> Obafemi Awolowo University, Ile-Ife, Osun State.
        </p>
        <p class="contact-info"><i class="fas fa-phone-alt"></i> <a class="text-inherit" href="tel:+11234562228">(234)
            123 456 789</a></p>
        <p class="contact-info"><i class="fas fa-envelope"></i> <a class="text-inherit"
            href="mailto:contact@oauife.edu.ng">contact@oauife.edu.ng</a></p>
        <div class="mega-hover rounded-20 mt-4 mt-lg-5 mb-4"><img src="assets/img/about/contact-1.jpg" alt="office"
            class="w-100"></div>
        <p class="font-title text-title fs-md fw-medium pt-xl-2 mb-2">Membership enquiries: <a href="tel:+04432907612"
            class="text-decoration-underline">+0443-290 7612</a></p>
        <p class="font-title text-title fs-md fw-medium mb-4">Principal Support: <a href="tel:+2256366989"
            class="text-decoration-underline">+225636-6989</a></p>
      </div>
      <div class="col-lg-6 col-xl-6">
        <form action="https://html.vecurosoft.com/educino/demo/mail.php" class="form-style5 ajax-contact">
          <div class="vs-circle"></div>
          <h3 class="form-title">Enquire Now</h3>
          <p class="form-text">Creating the right learning environment to get the most out of each learning session.
          </p>
          <div class="form-group">
            <input type="text" name="name" id="name" placeholder="Your name">
          </div>
          <div class="form-group">
            <input type="text" name="email" id="email" placeholder="Email Address">
          </div>
          <div class="form-group">
            <input type="text" name="number" id="number" placeholder="Phone No">
          </div>
          <div class="form-group"><select name="subject" id="subject">
              <option selected="selected" hidden disabled="disabled">Select Subject</option>
              <option value="Addmission Help">Addmission Help</option>
              <option value="Apply Scholarship">Apply Scholarship</option>
              <option value="Private Tutor">Private Tutor</option>
              <option value="Admission Session">Admission Session</option>
            </select></div>
          <div class="form-group">
            <textarea name="message" id="message" placeholder="Write your message"></textarea>
          </div>
          <button type="submit" class="vs-btn">Apply Today</button>
          <p class="form-messages"><span class="sr-only">For message will display here</span></p>
        </form>
      </div>
    </div>
  </div>
</section>
<div class="overflow-hidden rounded-20 space-bottom">
  <div class="container"><iframe class="bdrs20"
      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d50437.32487690385!2d144.96230200000002!3d-37.805673!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sbd!4v1677062621439!5m2!1sen!2sbd"
      width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe></div>
</div>
<section class="space-extra-bottom">
  <div class="container">
    <div class="title-area wow fadeInUp text-center" data-wow-delay="0.1s"><span class="sec-subtitle">FREQUENTLY ASKED
        QUESTIONS</span>
      <h2 class="sec-title h1">Academic Faq's</h2>
    </div>
    <div class="accordion-style1">
      <div class="accordion" id="faqVersion1">
        <div class="accordion-item">
          <div class="accordion-header" id="headingOne"><button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
              aria-controls="collapseOne">How lively are tutors?</button></div>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
            data-bs-parent="#faqVersion1">
            <div class="accordion-body">
              <p>At our institution, our tutors are known for their exceptional liveliness and energy in the classroom.
                We carefully select educators who not only possess excellent subject knowledge but also have a natural
                ability to engage and inspire students. Their passion for teaching is evident in their enthusiastic
                approach to every lesson, creating a dynamic and interactive learning atmosphere.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
              aria-controls="collapseTwo">How soon can I have lecture materials?</button></div>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
            data-bs-parent="#faqVersion1">
            <div class="accordion-body">
              <p>At our institution, the availability of lecture materials depends on the specific course format. For
                some courses, lecture materials are made available in advance, allowing you to access and review them
                before the lectures begin. In such cases, you can access the materials immediately upon enrollment,
                providing you with ample time to prepare and get familiar with the content.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection