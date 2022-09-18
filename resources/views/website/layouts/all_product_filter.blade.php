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
                        <!-- price shorting -->
                        <div class="d-flex justify-content-end">
                            <p>Shorted by:</p><br><br>
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
                        <!-- products -->
                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @if($products)
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
                                            <!-- <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 20%;"></div>
                                                </div>
                                                <span class="ratings-text">( 2 Reviews )</span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h4 class="text-danger">No Product Found</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- filtering items -->
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                            </div>
                            <form action="{{ route('website.all.product.filter') }}" method="POST">
                                @csrf
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
                                                        <input type="checkbox" name="size[]" value="one-size" id="one-size" class="custom-control-input">
                                                        <label class="custom-control-label" for="one-size">one-size</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="size[]" value="s" id="s" class="custom-control-input">
                                                        <label class="custom-control-label" for="s">s</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="size[]" value="m" id="m" class="custom-control-input">
                                                        <label class="custom-control-label" for="m">m</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="size[]" value="l" id="l" class="custom-control-input">
                                                        <label class="custom-control-label" for="l">l</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="size[]" value="xl" id="xl" class="custom-control-input">
                                                        <label class="custom-control-label" for="xl">xl</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="size[]" value="xxl" id="xxl" class="custom-control-input">
                                                        <label class="custom-control-label" for="xxl">xxl</label>
                                                    </div> <br>
                                                    <button type="submit" class="btn btn-outline-info w-100 rounded">Filter Result &rarr;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</div>
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
@endsection