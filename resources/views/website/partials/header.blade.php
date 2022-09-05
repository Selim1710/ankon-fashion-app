<header class="header header-intro-clearance header-4">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a>
            </div>
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">USD</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">Eur</a></li>
                                            <li><a href="#">Usd</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">English</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">French</a></li>
                                            <li><a href="#">Spanish</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- middle part -->
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                <a href="{{ route('website.home') }}" class="logo">
                    <img src="/website/images/logo.png" alt="AN Logo" width="105" height="25">
                </a>
            </div>
            <!-- search -->
            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="{{ route('website.search') }}" method="POST">
                        @csrf
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            @if(empty($search))
                            <input type="search" name="search" class="form-control" id="q" placeholder="Search product ..." required>
                            @else
                            <input type="search" name="search" value="{{ $search }}" class="form-control" id="q" placeholder="Search product ..." required>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="header-right">
                <div class="dropdown compare-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                        <div class="icon">
                            <i class="icon-random"></i>
                        </div>
                        <p>Compare</p>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="compare-products">
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="">Blue Night Dress</a></h4>
                            </li>
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="">White Long Skirt</a></h4>
                            </li>
                        </ul>

                        <div class="compare-actions">
                            <a href="#" class="action-link">Clear All</a>
                            <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="wishlist">
                    <a href="#" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            <span class="wishlist-count badge">3</span>
                        </div>
                        <p>Wishlist</p>
                    </a>
                </div>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">2</span>
                        </div>
                        <p>Cart</p>
                    </a>
                    {{-- mobile sidebar --}}
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="#">Beige knitted elastic runner shoes</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $84.00
                                    </span>
                                </div>

                                <figure class="product-image-container">
                                    <a href="#" class="product-image">
                                        <img src="/website/assets/images/products/cart/product-1.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div>

                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="#">Blue utility pinafore denim dress</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $76.00
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="#" class="product-image">
                                        <img src="/website/assets/images/products/cart/product-2.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div><!-- End .product -->
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">$160.00</span>
                        </div>

                        <div class="dropdown-cart-action">
                            <a href="#" class="btn btn-primary">View Cart</a>
                            <a href="#" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                        Browse Categories <i class="icon-angle-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                @foreach ($categories as $category)
                                <li class="item-lead"><a href="{{ route('show.category.product',$category->id) }}">{{ $category->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active">
                            <!-- home -->
                            <a href="#" class="sf-with-ul">Home</a>
                            <div class="megamenu demo">
                                <div class="menu-col">
                                    <div class="menu-title">Choose your product</div>
                                    <div class="demo-list">
                                        @foreach ($products as $product)
                                        <div class="demo-item">
                                            @if ($product->productImage)
                                            @foreach ($product->productImage as $image)
                                            @if ($loop->first)
                                            <a href="">
                                                <img src="{{ asset('uploads/products/'.json_decode($image->images)) }}" class="img-fluid">
                                                <span class="demo-title">{{ $product->name }}</span>
                                            </a>
                                            @endif
                                            @endforeach
                                            @endif

                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="megamenu-action text-center">
                                        <a href="#" class="btn btn-outline-primary-2 view-all-demos">
                                            <span>
                                                view all product
                                            </span>
                                            <i class="icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- sub-category -->
                        <li>
                            <a href="#" class="sf-with-ul">Choose Product</a>

                            <ul>
                                @foreach ($categories as $category)
                                <li>
                                    <a href="" class="sf-with-ul">{{ $category->category_name }}</a>
                                    <ul>
                                        @if ( $category->subCategories )
                                        @foreach ($category->subCategories as $subCategory)
                                        <li><a href="{{ route('show.sub.category.product',$subCategory->id) }}">{{ $subCategory->sub_category_name }}</a></li>
                                        @endforeach
                                        @else
                                        <li><a href=""></a></li>
                                        @endif
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>

            <div class="header-right">
                <i class="la la-lightbulb-o"></i>
                <p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
            </div>
        </div>
    </div>
</header>