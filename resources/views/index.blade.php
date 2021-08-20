<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ config('app.name', 'PersianBit') }}</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <meta name="msapplication-TileImage" content="/index/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="/index/assets/css/theme.css" rel="stylesheet" />

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

      <!-- ============================================-->


      <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img src="/index/assets/img/gallery/logo-n.png" height="45" alt="Presian Bit" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
              <li class="nav-item px-2"><a href="{{ route('padcasts.index') }}" class="nav-link active" aria-current="page" href="index.html">Padcasts</a></li>
              <li class="nav-item px-2"><a href="{{ route('jobs.index') }}" class="nav-link active" aria-current="page" href="index.html">Jobs</a></li>
              <li class="nav-item px-2"><a href="{{ route('articles.index') }}" class="nav-link" aria-current="page" href="pricing.html">Articles</a></li>
              <li class="nav-item px-2"><a href="{{ route('lessons.index') }}" class="nav-link" aria-current="page" href="web-development.html">Lessons</a></li>
              <li class="nav-item px-2"><a href="{{ route('questions.index') }}" class="nav-link" aria-current="page" href="user-research.html">Community </a></li>
            </ul>
                @auth()
                    <a class="btn btn-outline-secondary" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="btn btn-primary order-1 order-lg-0" href="{{ route('register') }}">Join</a>
                    &nbsp;
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}">Sign In</a>
                @endif
          </div>
        </div>
      </nav>
      <section class="pt-6 bg-600" id="home">
        <div class="container">
          <h4 class="fw-bold font-sans-serif">Every <p style="color: greenyellow;display: inline-block;">developer</p> has a tab open to PersianBit</h4>
          <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end">
              <img class="pt-7 pt-md-0 w-100" src="/index/assets/img/gallery/hero-header.png" width="470" alt="hero-header" />
            </div>
            <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
              <h4 class="fw-bold font-sans-serif">Persian bit the programers future</h4>
              <h1 class="fs-6 fs-xl-7 mb-5">Persian Bit is a question and answer and <p style="color: greenyellow;display: inline-block;">FREE</p> academic platform for
the programmers. It only takes a minute to sign up.</h1>
        <p class="fw-bold font-sans-serif">Find the best answer to your technical question, help others answer theirs</p>
              
              @auth()
                    <a class="btn btn-outline-secondary" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="btn btn-primary me-2" href="{{ route('register') }}">Join</a>
                    &nbsp;
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}">Sign In</a>
                @endif
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->

      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-0">

        <div class="container">
          <div class="row h-100 align-items-center">
            <div class="col-md-12 col-lg-6 h-100">
              <div class="card card-span text-white h-100"><img class="w-100" src="/index/assets/img/gallery/student-feedback.png" alt="..." />
                
              </div>
            </div>
            <div class="col-md-12 col-lg-6 h-100">
              <h1 class="my-4">Become Master With PERSIAN BIT<br /><span class="text-primary">Learn New Skills Online Find Best Courses</span></h1>
              <p>Take courses from the world’s best instructors and universities. Courses include recorded auto-graded and peer-reviewed assignments, video lectures, and community discussion forums. When you complete a course, you’ll be eligible to receive a shareable electronic Course Certificate for a small fee.</p>
            </div>
          </div>
        </div>
        <!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section>
        <div class="bg-holder" style="background-image:url(/index/assets/img/gallery/funfacts-2-bg.png);background-position:center;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="/index/assets/img/gallery/published.png" height="100" alt="..." />
              <h1 class="my-2">768</h1>
              <p class="text-info fw-bold">COURSES PUBLISHED</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="/index/assets/img/gallery/instructors.png" height="100" alt="..." />
              <h1 class="my-2">120</h1>
              <p class="text-info fw-bold">EXPERT INSTRUCTORS</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="/index/assets/img/gallery/learners.png" height="100" alt="..." />
              <h1 class="my-2">8300</h1>
              <p class="text-info fw-bold">HAPPY LEARNERS</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="/index/assets/img/gallery/awards.png" height="100" alt="..." />
              <h1 class="my-2">32</h1>
              <p class="text-info fw-bold">AWARDS ACHIEVED</p>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section>

        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 col-lg-4 mb-5"><img src="/index/assets/img/gallery/cta.png" width="280" alt="cta" /></div>
            <div class="col-md-6 col-lg-5">
              <h5 class="text-primary font-sans-serif fw-bold">Subscrible now</h5>
              <h1 class="mb-5">Get every single<br />update you will get</h1>
              <form class="row g-0 align-items-center">
                <div class="col">
                  <div class="input-group-icon">
                    <input class="form-control form-little-squirrel-control" type="email" placeholder="Enter email " aria-label="email" /><i class="fas fa-envelope input-box-icon"></i>
                  </div>
                </div>
                <div class="col-auto">
                  <button class="btn btn-primary rounded-0" type="submit">Subscribe now</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      @extends('layouts.footer')
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="/index/vendors/@popperjs/popper.min.js"></script>
    <script src="/index/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/index/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="/index/vendors/fontawesome/all.min.js"></script>
    <script src="/index/assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&amp;family=Rubik:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
  </body>

</html>