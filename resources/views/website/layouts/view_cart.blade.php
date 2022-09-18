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
                        <a href="{{ route('clear.cart') }}" class="btn btn-outline-danger">Clear All</a>
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
                                            <img src="{{ ('/uploads/products/'.json_decode($cart['image'])) }}" alt="Product image">
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
                <div class="d-flex flex-column justify-content-end">
                    <h5 class="p-2 rounded ml-auto"> Grand-Total: &nbsp; {{ $total }} </h5>
                    <a href="{{ route('user.checkout') }}" class="btn btn-outline-success w-25 ml-auto">
                        Checkout &rarr;
                    </a>
                </div>
                @else
                <p class="text-danger text-center p-4 rounded border">No Product into the cart</p>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection