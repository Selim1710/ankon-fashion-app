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
                    <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <form action="{{ route('add.to.cart',$product->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
                                        <!-- product-main-image -->
                                        @foreach($productImages as $image)
                                        @if($loop->first)
                                        <figure class="product-main-image">
                                            <img id="product-zoom" src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" data-zoom-image="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="product image">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure>
                                        @endif
                                        @endforeach
                                        <!-- more image -->
                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                            @foreach($productImages as $image)
                                            <a class="product-gallery-item active" href="#" data-image="{{ asset('/uploads/products/'.json_decode($image->images)) }}" data-zoom-image="{{ asset('/uploads/products/'.json_decode($image->images)) }}">
                                                <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="product side">
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="product-details">
                                    <h1 class="product-title"> {{ $product->name }} </h1>

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div>
                                        </div>
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                    </div>

                                    <div class="product-price">
                                        {{ $product->new_price }}৳
                                    </div>
                                    <div style="text-decoration:line-through;color:gray;font-weight:bold;">
                                        {{ $product->old_price }}৳
                                    </div>

                                    <div class="product-content">
                                        <p>{{ $product->description }} </p>
                                    </div>

                                    <div class="details-filter-row details-row-size">
                                        <!-- color -->
                                        <label>Color:</label>

                                        <div class="product-nav product-nav-thumbs">
                                            @foreach($productImages as $image)
                                            @if($loop->first)
                                            <a href="#" class="active">
                                                <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="product desc">
                                            </a>
                                            @else
                                            <a href="#">
                                                <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="product desc">
                                            </a>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- size -->
                                    <div class="details-filter-row details-row-size">
                                        <label for="size">Size:</label>
                                        <div class="select-custom">
                                            <select name="size" id="size" class="form-control">
                                                <option value="#" selected="selected">Select a size</option>
                                                @foreach(json_decode($product->size) as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                    </div>

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" name="quantity" value="1" id="qty" class="form-control" min="1" max="10" step="1" data-decimals="0" required>
                                        </div>
                                    </div>

                                    <div class="product-details-action">
                                        <button type="submit" class="btn-product btn-cart">
                                            <span>add to cart</span>
                                        </button>

                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                        </div>
                                    </div>

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a href="#">Women</a>,
                                            <a href="#">Dresses</a>,
                                            <a href="#">Yellow</a>
                                        </div>

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">
                                Description
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">
                                Shipping & Returns
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">
                                Reviews (2)
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                            <div class="product-desc-content">
                                <h3>Product Information</h3>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                            <div class="product-desc-content">
                                <h3>Delivery & returns</h3>
                                <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                    We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                            <div class="reviews">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                </div>
                                            </div>
                                            <span class="review-date">6 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                </div>
                                            </div>
                                            <span class="review-date">5 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Very good</h4>
                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- related product -->
                <h2 class="title text-center mb-4">You May Also Like</h2>
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
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
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                    @foreach ($subCatProduct as $product)
                    <div class="product product-7 text-center">
                        <figure class="product-media">
                            @if($product->productImage)
                            @foreach($product->productImage as $image)
                            @if($loop->first)
                            <a href="{{ route('website.product.details',$product->id) }}">
                                <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" alt="Product image" class="product-image">
                            </a>
                            @endif
                            @endforeach
                            @endif
                        </figure>

                        <div class="product-body">
                            <div class="product-cat">
                                {{ $product->name }}
                            </div>
                            <h3 class="product-title">{{ $product->new_price }} </h3><!-- End .product-title -->
                            <div class="product-price" style="text-decoration: line-through;">
                                {{ $product->old_price }}
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 20%;"></div>
                                </div>
                                <span class="ratings-text">( 2 Reviews )</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>

<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
@endsection