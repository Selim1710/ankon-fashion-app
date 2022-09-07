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
        @php
        $total = 0;
        @endphp
        <div class="page-content">
            <div class="container">
                @if($carts)
                <table class="table table-wishlist table-mobile">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('clear.cart') }}" class="btn btn-outline-danger">Clear</a>
                        <a href="{{ route('user.checkout') }}" class="btn btn-outline-success">Checkout</a>
                    </div>
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
                        @foreach ($carts as $key=>$cart)
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
                            <td class="price-col">{{ $cart['offer'] }} %</td>
                            <td class="price-col">{{ $cart['quantity'] }}</td>
                            <td class="price-col"><span class="in-stock">{{ $cart['new_price'] *  $cart['quantity'] }} ৳</span></td>
                            @php
                            $total += $cart['new_price'] * $cart['quantity'];
                            @endphp
                            <td class="remove-col"><a href="{{ route('user.remove.cart',$key) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="w-100 d-flex align-items-center justify-content-center" style="font-size: 4.3rem;">
                    <h5 class="p-4 border rounded">Total Price: &nbsp; {{ $total }} </h5>
                </div>
                @else
                <p class="text-danger text-center p-4 rounded border">No Product into the cart</p>
                @endif
            </div>
        </div>
    </main>
    @endsection