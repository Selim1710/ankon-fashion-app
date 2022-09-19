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
                    <li class="breadcrumb-item active" aria-current="page">Category-products</li>
                </ol>
            </div>
        </nav>
        <!-- all product -->
        @if($products)
        <div class="page-content">
            <div class="container">
                <div class="row bg-white">
                    @foreach ($products as $product)
                    <div class="col-4 col-lg-2 mt-2 mb-2">
                        <a href="{{ route('website.product.details',$product->id) }}">
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
                <div class="d-flex justify-content-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        @else
        <h4 class="text-center text-danger mt-4 mb-4">No Product Found</h4>
        @endif
    </main>
</div>
@endsection