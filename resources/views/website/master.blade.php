<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ankon Fashion - BD</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Ankon Fashion - BD">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/website/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/website/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/website/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/website/assets/images/icons/site.html">
    <link rel="mask-icon" href="/website/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="/website/assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="/website/assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('/website/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('/website/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/jquery.countdown.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('/website/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/website/assets/css/skins/skin-demo-4.css') }}">
    <link rel="stylesheet" href="{{ asset('/website/assets/css/demos/demo-4.css') }}">
    <!-- font awosome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>

<body>
    <div class="page-wrapper">
        @include('website.partials.header')

        @yield('contents')

        @include('website.partials.footer')
    </div>

    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!--------------------------- Mobile Menu --------------------------->

    <div class="mobile-menu-overlay"></div>

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            <!-- search -->
            <form action="{{ route('website.search') }}" method="POST" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">
                        Menu
                    </a>
                </li>
            </ul>
            <!-- mobile menu -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="{{ route('website.home') }}">Home</a>

                                <ul>
                                    <li><a href="{{ route('website.all.product') }}">all product</a></li>

                                </ul>
                            </li>
                            <li>
                                <a href="#">Categories</a>
                                <ul>
                                    @foreach ($categories as $category)
                                    <li><a href="{{ route('show.category.product',$category->id) }}">{{ $category->category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div>
        </div>
    </div>

    <!-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="/website/assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite
                                products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup
                                    again</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="/website/assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Plugins JS File -->
    <script src="{{ asset('/website/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/website/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('/website/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('/website/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('/website/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/website/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('/website/assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('/website/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/website/assets/js/jquery.countdown.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('/website/assets/js/main.js') }}"></script>
    <script src="{{ asset('/website/assets/js/demos/demo-4.js') }}"></script>
</body>

</html>