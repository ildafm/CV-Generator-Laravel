<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $user->name }} | Portfolio Page</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{-- <link href="{{ asset('portfolio_page_template/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('portfolio_page_template/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

    <!-- Vendor CSS Files -->
    <link href="{{ asset('portfolio_page_template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('portfolio_page_template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('portfolio_page_template/vendor/glightbox/css/glightbox.Gmin.css') }}" rel="stylesheet">
    <link href="{{ asset('portfolio_page_template/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('portfolio_page_template/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: DevFolio
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/devfolio-bootstrap-portfolio-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="#" @disabled(true)>Hello There</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            {{-- <a href="index.html" class="logo"><img src="{{ asset('portfolio_page_template/img/logo.png') }}"
                    alt="" class="img-fluid"></a> --}}

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    @if (count($services) > 0)
                        <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    @endif
                    @if (count($projects) > 0)
                        <li><a class="nav-link scrollto " href="#work">Work</a></li>
                    @endif
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <div id="hero" class="hero route bg-image" {{-- style="background-image: url({{ asset('portfolio_page_template/img/hero-bg.jpg') }})" --}} style="background: black">
        <div class="overlay-itro"></div>
        <div class="hero-content display-table">
            <div class="table-cell">
                <div class="container">
                    <!--<p class="display-6 color-d">Hello, world!</p>-->
                    <h1 class="hero-title mb-4">I am {{ $user->name }}</h1>
                    <p class="hero-subtitle">
                        @php
                            $abilities_arr = explode('&&', $detail_user->abilities);
                            $abilities = "There's Problem";
                            if (count($abilities_arr) == 1) {
                                $abilities = $abilities_arr[0];
                            } elseif (count($abilities_arr) == 2) {
                                $abilities = "$abilities_arr[0], $abilities_arr[1]";
                            } elseif (count($abilities_arr) == 3) {
                                $abilities = "$abilities_arr[0], $abilities_arr[1], $abilities_arr[2]";
                            } else {
                                $abilities = "There's Problem";
                            }

                        @endphp
                        <span class="typed" data-typed-items="{{ $abilities }}"></span>
                    </p>
                    <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
                </div>
            </div>
        </div>
    </div><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about-mf sect-pt4 route">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box-shadow-full">
                            <div class="row">
                                {{-- profile and skill --}}
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-5">
                                            <div class="about-img">
                                                <img src="{{ asset('portfolio_page_template/img/testimonial-2.jpg') }}"
                                                    class="img-fluid rounded b-shadow-a" alt="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <div class="about-info">
                                                <p><span class="title-s">Name: </span> <span>{{ $user->name }}</span>
                                                </p>
                                                <p><span class="title-s">Profile: </span>
                                                    <span>{{ $detail_user->role }}</span>
                                                </p>
                                                <p><span class="title-s">Email: </span>
                                                    <span>{{ $user->email }}</span>
                                                </p>
                                                <p><span class="title-s">Phone: </span>
                                                    <span>{{ $detail_user->phone }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- skill menu --}}
                                    <div class="skill-mf">
                                        <p class="title-s">Skill</p>
                                        @if (count($skills) > 0)

                                            @foreach ($skills as $item)
                                                <span>{{ $item->skill_name }}</span>
                                                <span class="pull-right">{{ $item->skill_confident }}%</span>

                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $item->skill_confident }}%;"
                                                        aria-valuenow="{{ $item->skill_confident }}" aria-valuemin="1"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                {{-- about me --}}
                                <div class="col-md-6">

                                    <div class="about-me pt-4 pt-md-0">
                                        <div class="title-box-2">
                                            <h5 class="title-left">
                                                About me
                                            </h5>
                                        </div>

                                        <p class="lead">
                                            {{ $detail_user->about_me }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        @if (count($services) > 0)
            <section id="services" class="services-mf pt-5 route">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-box text-center">
                                <h3 class="title-a">
                                    My Services
                                </h3>
                                <p class="subtitle-a">
                                    Do you need any of the following?
                                </p>
                                <div class="line-mf"></div>
                            </div>
                        </div>
                    </div>

                    <div id="serviceContainer" class="row">
                        {{-- service list --}}
                        @foreach ($services as $item)
                            <div class="col-md-4">
                                <div class="service-box">
                                    <div class="service-ico">
                                        <span class="ico-circle"><i class="bi bi-briefcase"></i></span>
                                    </div>
                                    <div class="service-content">
                                        <h2 class="s-title">{{ $item->service_name }}</h2>
                                        <p class="s-description text-center">
                                            {{ $item->service_detail }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!-- End Services Section -->


        <!-- ======= Project Section ======= -->
        @if (count($projects) > 0)
            <section id="work" class="portfolio-mf sect-pt4 route">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-box text-center">
                                <h3 class="title-a">
                                    My Project
                                </h3>
                                <p class="subtitle-a">
                                    Here are just a few of the projects I've worked on
                                </p>
                                <div class="line-mf"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- project list box --}}
                        @foreach ($projects as $item)
                            <div class="col-md-4">
                                <div class="work-box">
                                    <a href="{{ asset('portfolio_page_template/img/work-1.jpg') }}"
                                        data-gallery="portfolioGallery">
                                        <div class="work-img">
                                            <img src="{{ asset('portfolio_page_template/img/work-1.jpg') }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    </a>
                                    <div class="work-content">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h2 class="w-title">{{ $item->project_name }}</h2>
                                                <div class="w-more">
                                                    <span class="w-ctegory">{{ $item->project_category }}</span> /
                                                    <span class="w-date">{{ $item->project_created_date }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="w-like">
                                                    <a href="#"> <span class="bi bi-link-45deg"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section><!-- End Project Section -->
        @endif

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="paralax-mf footer-paralax bg-image sect-mt4 route"
            style="background-image: url({{ asset('portfolio_page_template/img/overlay-bg.jpg') }}">
            <div class="overlay-mf"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="contact-mf">
                            <div id="contact" class="box-shadow-full">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="title-box-2">
                                            <h5 class="title-left">
                                                Send Me a Message
                                            </h5>
                                        </div>
                                        <div>
                                            {{-- <form action="#" method="post" role="form"
                                                onsubmit="alert('Work in progress');" class="php-email-form"> --}}
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control"
                                                            id="name" placeholder="Your Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email"
                                                            id="email" placeholder="Your Email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="subject"
                                                            id="subject" placeholder="Subject" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center my-3">
                                                    {{-- <div class="loading">Loading</div>
                                                    <div class="error-message"></div>
                                                    <div class="sent-message">Your message has been sent. Thank
                                                        you!</div> --}}
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button type="submit"
                                                        class="button button-a button-big button-rouded"
                                                        onclick="alert('Work in progress, sorry');">Send
                                                        Message</button>
                                                </div>
                                            </div>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="title-box-2 pt-4 pt-md-0">
                                            <h5 class="title-left">
                                                Get in Touch
                                            </h5>
                                        </div>
                                        <div class="more-info">
                                            {{-- <p class="lead">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis dolorum
                                                dolorem soluta quidem
                                                expedita aperiam aliquid at.
                                                Totam magni ipsum suscipit amet? Autem nemo esse laboriosam ratione
                                                nobis
                                                mollitia inventore?
                                            </p> --}}
                                            <ul class="list-ico">
                                                <li><span class="bi bi-geo-alt"></span>{{ $detail_user->address }}
                                                </li>
                                                <li><span class="bi bi-phone"></span>{{ $detail_user->phone }}</li>
                                                <li><span class="bi bi-envelope"></span>{{ $user->email }}</li>
                                            </ul>
                                        </div>
                                        {{-- list item sosial media --}}
                                        <div class="socials">
                                            <ul>
                                                {{-- instagram --}}
                                                @if (isset($detail_user->instagram_url))
                                                    <li>
                                                        <a target="_blank" href="{{ $detail_user->instagram_url }}">
                                                            <span class="ico-circle"
                                                                title="go to my instagram profile">
                                                                <i class="bi bi-instagram"
                                                                    style="display: flex; align-items: center; justify-content: center; height: 100%;"></i>
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endif

                                                {{-- facebook --}}
                                                @if (isset($detail_user->facebook_url))
                                                    <li>
                                                        <a target="_blank"
                                                            href="{{ $detail_user->facebook_url }}"><span
                                                                class="ico-circle" title="go to my facebook profile">
                                                                <i class="bi bi-facebook"
                                                                    style="display: flex; align-items: center; justify-content: center; height: 100%;"></i></span></a>
                                                    </li>
                                                @endif

                                                {{-- twitter --}}
                                                @if (isset($detail_user->twitter_url))
                                                    <li>
                                                        <a target="_blank"
                                                            href="{{ $detail_user->twitter_url }}"><span
                                                                class="ico-circle" title="go to my twitter profile">
                                                                <i class="bi bi-twitter"
                                                                    style="display: flex; align-items: center; justify-content: center; height: 100%;"></i></span></a>
                                                    </li>
                                                @endif

                                                {{-- linkedin --}}
                                                @if (isset($detail_user->linked_in_url))
                                                    <li>
                                                        <a target="_blank" href="{{ $detail_user->linked_in_url }}">
                                                            <span class="ico-circle"
                                                                title="go to my linkedin profile">
                                                                <i class="bi bi-linkedin"
                                                                    style="display: flex; align-items: center; justify-content: center; height: 100%;">
                                                                </i>
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="copyright-box">
                        {{-- <p class="copyright">&copy; Copyright <strong>DevFolio</strong>. All Rights Reserved</p>
                        <div class="credits"> --}}
                        <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=DevFolio
            -->
                        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}

                        <p class="copyright">&copy; Copyright <strong>BIO & CV Generator</strong>. All Rights Reserved
                        </p>

                        @if (!Auth::user())
                            <div class="credits">
                                Let's <a href="/register">Create your own BIO</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End  Footer -->

    {{-- <div id="preloader"></div> --}}
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('portfolio_page_template/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('portfolio_page_template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('portfolio_page_template/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('portfolio_page_template/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('portfolio_page_template/vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('portfolio_page_template/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('portfolio_page_template/js/main.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan elemen dengan ID "serviceContainer"
            let serviceContainer = document.getElementById("serviceContainer");

            // Dapatkan semua elemen dengan kelas "service-box"
            let serviceBoxes = serviceContainer.getElementsByClassName("service-box");

            // Temukan tinggi maksimum
            let maxHeight = 0;
            for (let i = 0; i < serviceBoxes.length; i++) {
                let height = serviceBoxes[i].offsetHeight;
                maxHeight = Math.max(maxHeight, height);
            }

            // Terapkan tinggi maksimum ke semua elemen
            for (let i = 0; i < serviceBoxes.length; i++) {
                serviceBoxes[i].style.height = maxHeight + "px";
            }
        });
    </script>


</body>

</html>
