@extends('website.master')
@section('contents')
<div class="page-wrapper">
    <main class="main">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Searching-products</li>
                </ol>
            </div>
        </nav>
        <!-- all product -->
        <div class="page-content">
            <div class="container">
                <h4 class="text-center text-danger">Total Searching result found: {{ $result }}</h4>
                <div class="row bg-white">
                    @foreach ($products as $product)
                    <div class="col-4 col-lg-2 mt-2 mb-2">
                        <a href="#">
                            <div class="card">
                                <div class="card-img">
                                    @foreach ($product->productImage as $image)
                                    @if($loop->first)
                                    <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="">
                                    @endif
                                    @endforeach
                                </div>
                                <div class="card-desc">
                                    <p>{{ $product->name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>
@endsection