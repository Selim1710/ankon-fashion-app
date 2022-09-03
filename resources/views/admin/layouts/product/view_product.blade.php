@extends('admin.master')
@section('contents')

<div class="container">
    <br><br><br>
    <div class="row">
        @foreach ($productImages as $image)
        <div style="width:20%;margin-left:2%;">
            <img src="{{ asset('/uploads/products/'.json_decode($image->images)) }}" style="height:200px;width:100%;">
            <a href="" class="btn btn-light" style="position:absolute;"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a>
        </div>
        @endforeach
    </div>
</div>
@endsection