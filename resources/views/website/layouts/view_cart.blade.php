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
                    <div class="d-flex justify-content-end"> <a href="#" class="btn btn-outline-success">Checkout all</a></div>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>size</th>
                            <th>price</th>
                            <th>offer</th>
                            <th>quantity</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                        <tr>
                            <td class="product-col">
                                <div class="product">
                                    <figure class="product-media">
                                        <a href="#">
                                            @foreach($cart['image'] as $image)
                                            <img src="{{ ('/uploads/products/'.json_decode($image['images'])) }}" alt="Product image">
                                            @endforeach
                                        </a>
                                    </figure>

                                    <h3 class="product-title">
                                        <a href="#">{{ $cart['name'] }}</a>
                                    </h3>
                                </div>
                            </td>
                            <td class="price-col">{{ $cart['size'] }}</td>
                            <td class="price-col">{{ $cart['old_price'] }}</td>
                            <td class="price-col">{{ $cart['offer'] }}</td>
                            <td class="price-col">{{ $cart['quantity'] }}</td>
                            <td class="price-col"><span class="in-stock">{{ $cart['new_price'] *  $cart['quantity'] }}</span></td>

                            <td class="action-col">
                                <button class="btn btn-outline-info"><i class="la la-check"></i></button>
                            </td>
                            <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="w-100 d-flex align-items-center justify-content-center" style="font-size: 4.3rem;">
                    <h5 class="p-4 border rounded">Total Price: 1000 tk </h5>
                </div>
            </div>
        </div>
    </main>
    @endsection