@extends('website.master')
@section('contents')
<div class="page-wrapper">
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">all-products</li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="d-flex justify-content-end">
                            <p>Shorted by:</p>
                            <div class="dropdown">
                                <button class="border-0" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                    Price
                                </button>
                                <div class="dropdown-menu text-capitalize" style="font-size: 1.3rem;" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('website.all.product') }}">all</a>
                                    <a class="dropdown-item" href="{{ route('website.shorting.low.price') }}">low(1k)</a>
                                    <a class="dropdown-item" href="{{ route('website.shorting.mid.price') }}">mid(2k)</a>
                                    <a class="dropdown-item" href="{{ route('website.shorting.high.price') }}">high(2k up)</a>
                                </div>
                            </div>
                        </div>
                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @foreach ($products as $product)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <a href="{{ route('website.product.details',$product->id) }}">
                                                @if($product->productImage)
                                                @foreach ($product->productImage as $image)
                                                @if($loop->first)
                                                <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="Product image" class="product-image">
                                                @endif
                                                @endforeach
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="#">{{ $product->name }}</a>
                                            </div>
                                            <h3 class="product-title">{{ $product->new_price }}</h3><!-- End .product-title -->
                                            <div class="product-price" style="text-decoration:line-through;">
                                                {{ $product->old_price }}
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                </div>
                                                <span class="ratings-text">( 2 Reviews )</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            <!-- foreach loop start -->
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cat-1">
                                                    <label class="custom-control-label" for="cat-1">Dresses</label>
                                                </div>
                                                <span class="item-count">3</span>
                                            </div>
                                            <!-- foreach loop end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- size -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        Size
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items">

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                                    <label class="custom-control-label" for="size-1">XS</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</div>
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
@endsection