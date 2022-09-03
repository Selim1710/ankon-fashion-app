@extends('admin.master')
@section('contents')
<!-- Added, Edit, Delete Message -->
@if(session()->has('error'))
<p class="alert alert-danger">{{ session()->get('error') }}</p>
@endif
@if(session()->has('message'))
<p class="alert alert-success">{{ session()->get('message') }}</p>
@endif
<!-- end -->
<div class="table_button">
    <a href="{{ route('admin.add.product') }}" class="btn btn-primary">Add Product</a>
</div>
<div class="manage_table">
    <table class="table table-borderless table-hover">
        <thead class="table-primary">
            <tr class="text-center">
                <th>SL</th>
                <th>Name</th>
                <th>Image</th>
                <th>Old Price</th>
                <th>Offer</th>
                <th>New price</th>
                <th>size</th>
                <th>Description</th>

                <th>subCategory_id</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key=>$product)
            <tr class="text-center">
                <td>{{ $key+1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->productImage->count() }}</td>
                <td>{{ $product->old_price }}</td>
                <td>{{ $product->offer }} %</td>
                <td>{{ $product->new_price }} </td>
                <td>{{ $product->size }} </td>
                <td>{{ $product->description }}</td>

                <td>{{ $product->subCategory_id }}</td>
                <td>
                    <a href="{{ route('admin.view.product',$product->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.edit.product',$product->id) }}" class="btn btn-primary mt-1"><i class="fa fa-th-list"></i></a>
                    <a href="{{ route('admin.delete.product',$product->id) }}" class="btn btn-danger mt-1"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection