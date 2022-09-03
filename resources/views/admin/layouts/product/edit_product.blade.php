@extends('admin.master')
@section('contents')
<div class="myform">
    <!-- Validation Error Message -->
    <div class="message">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <form action="{{ route('admin.update.product', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="pn1">Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="pn1" required>
        </div>
        <!-- price calculation -->
        <div class="form-group">
            <label for="Oldp">Old Price</label>
            <input type="number" name="old_price" value="{{ $product->old_price }}" class="form-control" id="Oldp" onchange="calculate();" required>
        </div>
        <div class="form-group">
            <label for="offer">Offer</label>
            <input type="number" name="offer" value="{{ $product->offer }}" class="form-control" id="offer" onchange="calculate();" required>
        </div>
        <div class="form-group">
            <label for="new_price">New Price</label>
            <input type="number" name="new_price" value="{{ $product->new_price }}" value="" class="form-control" id="new_price" readonly>
        </div>
        <div class="form-group">
            <label for="pd1">Product Description</label>
            <textarea name="description" class="form-control" id="pd1" rows="3" required>{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success w-100">Submit Now</button>
    </form>
</div>
@endsection
<script>
    function calculate() {
        var offer = document.getElementById('offer').value;
        var price = document.getElementById('Oldp').value;

        var new_price = (price) - ((offer * price) / 100);

        var showPrice = document.getElementById('new_price').value = Math.round(new_price);

    }
</script>