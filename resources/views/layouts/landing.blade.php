<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="author" content="Laralink">
    <!-- Favicon Icon -->
    <link rel="icon" href="{{asset('assets/img/favicon.png')}}">
    <!-- Site Title -->
    <title>Disease Prediction - The Prince Royal's College SMEP</title>
    <link rel="stylesheet" href="{{asset('assets/css/plugins/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery.timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animated-headline.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @stack('styles')
</head>

<body>
    <!-- Start Preloader -->
    <div class="cs_perloader">
        <div class="cs_perloader_in">
            <div class="cs_wave_first">
                <svg enable-background="new 0 0 300.08 300.08" viewBox="0 0 300.08 300.08"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m293.26 184.14h-82.877l-12.692-76.138c-.546-3.287-3.396-5.701-6.718-5.701-.034 0-.061 0-.089 0-3.369.027-6.199 2.523-6.677 5.845l-12.507 87.602-14.874-148.69c-.355-3.43-3.205-6.056-6.643-6.138-.048 0-.096 0-.143 0-3.39 0-6.274 2.489-6.752 5.852l-19.621 137.368h-9.405l-12.221-42.782c-.866-3.028-3.812-5.149-6.8-4.944-3.13.109-5.777 2.332-6.431 5.395l-8.941 42.332h-73.049c-3.771 0-6.82 3.049-6.82 6.82 0 3.778 3.049 6.82 6.82 6.82h78.566c3.219 0 6.002-2.251 6.67-5.408l4.406-20.856 6.09 21.313c.839 2.939 3.526 4.951 6.568 4.951h20.46c3.396 0 6.274-2.489 6.752-5.845l12.508-87.596 14.874 148.683c.355 3.437 3.205 6.056 6.643 6.138h.143c3.39 0 6.274-2.489 6.752-5.845l14.227-99.599 6.397 38.362c.546 3.287 3.396 5.702 6.725 5.702h88.66c3.771 0 6.82-3.049 6.82-6.82-.001-3.772-3.05-6.821-6.821-6.821z" />
                </svg>
            </div>
            <div class="cs_wave_second">
                <svg enable-background="new 0 0 300.08 300.08" viewBox="0 0 300.08 300.08"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m293.26 184.14h-82.877l-12.692-76.138c-.546-3.287-3.396-5.701-6.718-5.701-.034 0-.061 0-.089 0-3.369.027-6.199 2.523-6.677 5.845l-12.507 87.602-14.874-148.69c-.355-3.43-3.205-6.056-6.643-6.138-.048 0-.096 0-.143 0-3.39 0-6.274 2.489-6.752 5.852l-19.621 137.368h-9.405l-12.221-42.782c-.866-3.028-3.812-5.149-6.8-4.944-3.13.109-5.777 2.332-6.431 5.395l-8.941 42.332h-73.049c-3.771 0-6.82 3.049-6.82 6.82 0 3.778 3.049 6.82 6.82 6.82h78.566c3.219 0 6.002-2.251 6.67-5.408l4.406-20.856 6.09 21.313c.839 2.939 3.526 4.951 6.568 4.951h20.46c3.396 0 6.274-2.489 6.752-5.845l12.508-87.596 14.874 148.683c.355 3.437 3.205 6.056 6.643 6.138h.143c3.39 0 6.274-2.489 6.752-5.845l14.227-99.599 6.397 38.362c.546 3.287 3.396 5.702 6.725 5.702h88.66c3.771 0 6.82-3.049 6.82-6.82-.001-3.772-3.05-6.821-6.821-6.821z" />
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->
    <!-- Start Header Section -->
    <header class="cs_site_header cs_style1 cs_sticky_header cs_heading_color">
        <div class="cs_main_header">
            <div class="container">
                <div class="cs_main_header_in">
                    <div class="cs_main_header_left">
                        <a class="cs_site_branding" href="{{url('/')}}">
                            {{-- <img src="assets/img/logo1.svg" alt="Logo"> --}}
                            <span style="font-weight: 600">DISEASE PREDICTION</span>
                        </a>
                        <nav class="cs_nav">
                            <ul class="cs_nav_list">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Team</a></li>
                                <li>

                                    @if (!Auth::check())
                                    <a href="{{route('login')}}">Login</a>
                                    @else
                                    <a href="{{route('dashboard')}}">Dashboard</a>


                                    @endif

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <div class="cs_height_200 cs_height_xl_150 cs_height_lg_110"></div>
    <!-- End Brands -->
    <!-- Start Footer -->
    <footer class="cs_footer  cs_heading_color">
        <div class="cs_footer_bottom cs_accent_bg">
            <div class="container">
                <div class="cs_footer_bottom_in">
                    <div class="cs_social_links_wrap">
                        <h2 class="cs_white_color">Follow Us</h2>
                        <div class="cs_social_links">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        </div>
                    </div>
                    <div class="cs_copyright">Copyright © 2024 Disease Prediction - The Prince Royal's College SMEP. All
                        rights reserved.</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <span class="cs_scrollup"><i class="fa-solid fa-arrow-up"></i></span>

    <!-- Script -->

    <script src="{{asset('assets/js/plugins/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/odometer.js')}}"></script>
    <script src="{{asset('assets/js/plugins/isotope.pkg.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/lightgallery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/ripples.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/gsap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/animated-headline.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>

    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    @stack('scripts')
</body>

</html>