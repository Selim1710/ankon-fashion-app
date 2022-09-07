@extends('website.master')
@section('contents')
<div class="page-wrapper">
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View-Cart</li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product-col">
                                <div class="product">
                                    <figure class="product-media">
                                        <a href="#">
                                            <img src="assets/images/products/table/product-2.jpg" alt="Product image">
                                        </a>
                                    </figure>

                                    <h3 class="product-title">
                                        <a href="#">Blue utility pinafore denim dress</a>
                                    </h3>
                                </div>
                            </td>
                            <td class="price-col">$76.00</td>
                            <td class="stock-col"><span class="in-stock">In stock</span></td>
                            <td class="action-col">
                                <button class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</button>
                            </td>
                            <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </main>

    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @endsection