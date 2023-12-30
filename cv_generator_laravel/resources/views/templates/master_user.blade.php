<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Bio & CV generator | {{ $title_page }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('user_page_template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_page_template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('user_page_template/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_page_template/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('user_page_template/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('user_page_template/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('user_page_template/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('user_page_template/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Aug 30 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                {{-- <img src="{{ asset('user_page_template/img/logo.png') }}" alt=""> --}}
                <span class="d-none d-lg-block">Main Page</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->
                {{-- @php
                    use App\Http\Model\Project;
                    use App\Http\Model\Service;
                    use App\Http\Model\DetailUser;

                    $detail_user = DetailUser::where('user_id', Auth::user()->id);
                    $services = Service::where('detail_user_id', $detail_user->id);
                    $projects = Project::where('detail_user_id', $detail_user->id);
                    $num = 0;
                @endphp --}}

                {{-- Notification --}}
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a>
                    <!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li>
                <!-- End Notification Nav -->

                {{-- profile dropdown --}}
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('user_page_template/img/profile-img.jpg') }}" alt="Profile"
                            class="rounded-circle">
                        {{-- <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span> --}}
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>
                                @if (Auth::user()->package == 'F')
                                    Free Account
                                @elseif(Auth::user()->package == 'P')
                                    Premium Account
                                @else
                                    Errors in data collection
                                @endif
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('user_profile', ['user' => Auth::user()->id]) }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            {{-- logout form --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            {{-- profile pages heading --}}
            <li class="nav-heading">Profile Pages</li>

            <li class="nav-item">
                <a class="nav-link {{ $active_page == 'profile' ? '' : 'collapsed' }}"
                    href="{{ route('user_profile', ['user' => Auth::user()->id]) }}">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-heading">My Portfolio Page</li>
            @php
                use Illuminate\Support\Str;
                use App\Models\DetailUser;

                $thisUser = Auth::user();
                $portfolio = DetailUser::where('user_id', $thisUser->id)->first();

                // Generate a slug
                $slugThisUser = Str::slug($thisUser->name);
            @endphp

            @if (isset($portfolio))
                <li class="nav-item">
                    <a class="nav-link {{ $active_page == 'create_portfolio' ? '' : 'collapsed' }}"
                        href="{{ route('portfolio_show', ['id_detail_user' => $portfolio->id, 'name_user' => $slugThisUser]) }}"
                        target="_blank">
                        <i class="bi bi-arrow-right-circle"></i>
                        <span>Go to my Portfolio Page</span>
                    </a>
                </li><!-- End My Page Page Nav -->

                <li class="nav-item">
                    <a class="nav-link {{ $active_page == 'skills' ? '' : 'collapsed' }}" href="/skills">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>My Skill</span>
                    </a>
                </li><!-- End My skill Nav -->

                <li class="nav-item">
                    <a class="nav-link {{ $active_page == 'services' ? '' : 'collapsed' }}" href="/services">
                        <i class="bi bi-journals"></i>
                        <span>My Service</span>
                    </a>
                </li><!-- End My service Nav -->

                <li class="nav-item">
                    <a class="nav-link {{ $active_page == 'projects' ? '' : 'collapsed' }}" href="/projects">
                        <i class="bi bi-folder2"></i>
                        <span>My Project</span>
                    </a>
                </li><!-- End My Project Nav -->
            @else
                <li class="nav-item">
                    <a class="nav-link {{ $active_page == 'create_portfolio' ? '' : 'collapsed' }}"
                        href="{{ route('portfolios.create') }}">
                        <i class="bi bi-plus-circle"></i>
                        <span>Create Portfolio Page</span>
                    </a>
                </li><!-- End My create portfolio Nav -->
            @endif

            {{-- <li class="nav-item">
                <a class="nav-link {{ $active_page == 'contact' ? '' : 'collapsed' }}" href="pages-contact.html">
                    <i class="bi bi-envelope"></i>
                    <span>My Contact</span>
                </a>
            </li><!-- End Contact Page Nav --> --}}

            {{-- end profile pages heading --}}
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        {{-- main content --}}
        @yield('content')
        {{-- end main content --}}

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>BIO & CV Generator</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('user_page_template/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('user_page_template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user_page_template/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('user_page_template/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('user_page_template/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('user_page_template/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('user_page_template/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('user_page_template/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('user_page_template/js/main.js') }}"></script>

</body>

</html>
