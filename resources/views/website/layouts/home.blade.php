@extends('website.master')
@section('contents')
<main class="main">
    <div class="intro-slider-container mb-5">
        <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{
                "dots": true,
                "nav": false, 
                "responsive": {
                    "1200": {
                        "nav": true,
                        "dots": false
                    }
                }
            }'>
            @foreach($offers as $offer)
            <div class="intro-slide">
                <img src="{{ asset('/uploads/offer/'.$offer->image) }}">
            </div>
            @endforeach
        </div>
        <span class="slider-loader"></span>
    </div>
    <div class="container">
        <h2 class="title text-center mb-4">Explore Popular Categories</h2>
        <div class="cat-blocks-container">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="{{ route('show.category.product',$category->id) }}" class="cat-block">
                        <figure>
                            <span>
                                <img src="{{ asset('/uploads/category/'.$category->image) }}" alt="Category image">
                            </span>
                        </figure>

                        <h3 class="cat-block-title">{{ $category->category_name }}</h3>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-4"></div>
    <div class="container new-arrivals">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">New Arrivals</h2>
            </div>
        </div>
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                        "nav": true, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":5
                            }
                        }
                    }'>
            @foreach ($products as $product)

            <div class="product product-2">
                <figure class="product-media">
                    <!-- image -->
                    <a href="{{ route('website.product.details',$product->id) }}">
                        @if($product->productImage)
                        @foreach ($product->productImage as $image)
                        @if($loop->first)
                        <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="Product image" class="product-image">
                        @endif
                        @endforeach
                        @endif
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                    </div>

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart" title="Add to cart">
                            <span>
                                add to cart
                            </span>
                        </a>
                        <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                    </div>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">{{ $product->name }}</a>
                    </div>
                    <h3 class="product-title">{{ $product->new_price }} </h3>

                    <div class="product-price" style="text-decoration:line-through;">
                        {{ $product->old_price }}
                    </div>
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 100%;"></div>
                        </div>
                        <span class="ratings-text">( 4 Reviews )</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="mb-6"></div>

    <div class="bg-light pt-5 pb-6">
        <div class="container trending-products">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">Trending Products</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5col d-none d-xl-block">
                    <div class="banner">
                        @foreach ($offers as $offer)
                        @if($loop->first)
                        <a href="#">
                            <img src="{{ asset('/uploads/offer/'.$offer->image) }}" alt="banner">
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="col-xl-4-5col">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                    "nav": true, 
                                    "dots": false,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        }
                                    }
                                }'>
                        @foreach($products as $product)
                        <div class="product product-2">
                            <figure class="product-media">

                                <a href="{{ route('website.product.details',$product->id) }}">
                                    @if($product->productImage)
                                    @foreach ($product->productImage as $image)
                                    @if($loop->first)
                                    <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="Product image" class="product-image">
                                    @endif
                                    @endforeach
                                    @endif </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div>

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div>
                            </figure>

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $product->name }}</a>
                                </div>
                                <h3 class="product-title">{{ $product->new_price }}</h3>
                                <div class="product-price" style="text-decoration:line-through;">
                                    {{ $product->old_price }}
                                </div>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                    </div>
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div>

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>

    <div class="container for-you">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Recommendation For You</h2>
            </div>

            <div class="heading-right">
                <a href="#" class="title-link">View All Recommendadion <i class="icon-long-arrow-right"></i></a>
            </div>
        </div>

        <div class="products">
            <div class="row justify-content-center">
                @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">

                    <div class="product product-2">
                        <figure class="product-media">

                            <a href="{{ route('website.product.details',$product->id) }}">
                                @if($product->productImage)
                                @foreach ($product->productImage as $image)
                                @if($loop->first)
                                <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="Product image" class="product-image">
                                @endif
                                @endforeach
                                @endif </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                            </div>

                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                            </div>
                        </figure>

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $product->name }}</a>
                            </div>
                            <h3 class="product-title">{{ $product->new_price }}</h3>
                            <div class="product-price" style="text-decoration:line-through;">
                                {{ $product->old_price }}
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 100%;"></div>
                                </div>
                                <span class="ratings-text">( 4 Reviews )</span>
                            </div>

                            <div class="product-nav product-nav-dots">
                                <a href="#" style="background: #69b4ff;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #ff887f;"><span class="sr-only">Color name</span></a>
                                <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mb-4"></div>

    <div class="container">
        <hr class="mb-0">
    </div>

    <div class="icon-boxes-container bg-transparent">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-rocket"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Shipping</h3>
                            <p>Orders $50 or more</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-rotate-left"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Returns</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-info-circle"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Get 20% Off 1 Item</h3>
                            <p>when you sign up</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-life-ring"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">We Support</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection