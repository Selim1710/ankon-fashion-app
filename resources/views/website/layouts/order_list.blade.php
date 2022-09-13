@extends('website.master')
@section('contents')
<div class="page-wrapper">
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order-List</li>
                </ol>
            </div>
        </nav>
        @php
        $total = 0;
        @endphp

        <!-- supplier order list -->
        @if(auth()->user()->role=="supplier")
        <div class="page-content">
            <div class="container">
                @if($supplierOrderList)
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>customer_name</th>
                            <th>phone</th>
                            <th>email</th>
                            <th>address</th>
                            <th>Product</th>
                            <th>size</th>
                            <th>price</th>
                            <th>quantity</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplierOrderList as $order)
                        <tr>
                            <td class="price-col">{{ $order['name'] }}</td>
                            <td class="price-col">{{ $order['phone'] }}</td>
                            <td class="price-col">{{ $order['email'] }}</td>
                            <td class="price-col">{{ $order['address'] }}</td>

                            <td class="product-col">
                                <div class="product">
                                    <figure class="product-media">
                                        <a href="#">
                                            <img src="{{ ('/uploads/products/'.json_decode(json_decode($order['image']))) }}" alt="Product image">
                                        </a>
                                    </figure>

                                    <h3 class="product-title">
                                        <a href="#">{{ $order['product_name'] }}</a>
                                    </h3>
                                </div>
                            </td>
                            <td class="price-col">{{ $order['size'] }}</td>
                            <td class="price-col">{{ $order['price'] }}</td>
                            <td class="price-col">{{ $order['quantity'] }}</td>
                            <td class="price-col"><span class="in-stock">{{ $order['total'] }} ৳</span></td>
                            <td class="remove-col"><a href="#" class="btn btn-success"><i class="fas fa-check"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                @else
                <p class="text-danger text-center p-4 rounded border">No order into the order</p>
                @endif
            </div>
        </div>
        @else
        <!-- customer/Admin order List -->
        <div class="page-content">
            <div class="container">
                @if($orders)
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>size</th>
                            <th>price</th>
                            <th>quantity</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="product-col">
                                <div class="product">
                                    <figure class="product-media">
                                        <a href="#">
                                            <img src="{{ ('/uploads/products/'.json_decode(json_decode($order['image']))) }}" alt="Product image">
                                        </a>
                                    </figure>

                                    <h3 class="product-title">
                                        <a href="#">{{ $order['product_name'] }}</a>
                                    </h3>
                                </div>
                            </td>
                            <td class="price-col">{{ $order['size'] }}</td>
                            <td class="price-col">{{ $order['price'] }}</td>
                            <td class="price-col">{{ $order['quantity'] }}</td>
                            <td class="price-col"><span class="in-stock">{{ $order['total'] }} ৳</span></td>
                            @if($order['order_status']=='delivered')
                            <td class="price-col">
                                <a href="{{ route('user.add.review',$order['id']) }}" class="btn btn-primary">
                                    Write a review
                                </a>
                            </td>
                            @else
                            <td class="remove-col"><a href="{{ route('user.cancel.order',$order['id']) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                            @endif
                            @php
                            $total += $order['price'] * $order['quantity'];
                            @endphp
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="w-100 d-flex align-items-center justify-content-center" style="font-size: 4.3rem;">
                    <h5 class="p-4 border rounded">Total Price: &nbsp; {{ $total }} </h5>
                </div>
                @else
                <p class="text-danger text-center p-4 rounded border">No Product into the order</p>
                @endif
            </div>
        </div>
        @endif
    </main>
</div>
@endsection