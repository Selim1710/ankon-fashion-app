@extends('website.master')
@section('contents')
<div class="page-wrapper">
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About us</li>
                </ol>
            </div>
        </nav>
        <div class="container">
            <div class="page-header page-header-big text-center" style="background-image: url('/website/images/about-header-bg.jpg')">
                <h1 class="page-title text-white">About us<span class="text-white">Who we are</span></h1>
            </div>
        </div>

        <div class="page-content pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h2 class="title">Our Vision</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. </p>
                    </div>

                    <div class="col-lg-6">
                        <h2 class="title">Our Mission</h2>
                        <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. <br>Praesent elementum hendrerit tortor. Sed semper lorem at felis. </p>
                    </div>
                </div>

                <div class="mb-5"></div>
            </div>

            <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 mb-3 mb-lg-0">
                            <h2 class="title">Who We Are</h2>
                            <p class="lead text-primary mb-3">Pellentesque odio nisi, euismod pharetra a ultricies <br>in diam. Sed arcu. Cras consequat</p><!-- End .lead text-primary -->
                            <p class="mb-2">Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, uctus metus libero eu augue. </p>

                            <a href="blog.html" class="btn btn-sm btn-minwidth btn-outline-primary-2">
                                <span>VIEW OUR NEWS</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div>

                        <div class="col-lg-6 offset-lg-1">
                            <div class="about-images">
                                <img src="{{ asset('/website/images/about1.jpg') }}" alt="" class="about-img-front">
                                <img src="{{ asset('/website/images/about2.jpg') }}" alt="" class="about-img-back">
                            </div><!-- End .about-images -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2"></div>
        </div>
    </main>
</div>
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

@endsection