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

    <form action="{{ route('admin.store.product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="sc1">Sub-Category</label>
            <select class="form-control" id="sc1" name="subCategory_id">
                @foreach ($subCategories as $subCategory)
                <option value="{{ $subCategory->id }}">{{ $subCategory->sub_category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pn1">Name</label>
            <input type="text" name="name" class="form-control" id="pn1" required>
        </div>
        <!-- price calculation -->
        <div class="form-group">
            <label for="Oldp">Old Price</label>
            <input type="number" name="old_price" class="form-control" id="Oldp" onchange="calculate();" required>
        </div>
        <div class="form-group">
            <label for="offer">Offer</label>
            <input type="number" name="offer" class="form-control" id="offer" onchange="calculate();" required>
        </div>
        <div class="form-group">
            <label for="new_price">New Price</label>
            <input type="number" name="new_price" value="" class="form-control" id="new_price" readonly>
        </div>
        <!-- image -->
        <div class="form-group">
            <label for="img1">Image</label>
            <input type="file" multiple accept="image/*" name="images[]" class="form-control" id="img1" required>
        </div>
        <div class="form-group mt-3">
            <h4>Size</h4>
            <label>
                <input type="checkbox" name="size[]" value="one-size">
                one-size
            </label>
            &nbsp;
            <label>
                <input type="checkbox" name="size[]" value="s">
                S
            </label>
            <label>
                <input type="checkbox" name="size[]" value="m">
                M
            </label>
            <label>
                <input type="checkbox" name="size[]" value="l">
                L
            </label>
            <label>
                <input type="checkbox" name="size[]" value="xl">
                XL
            </label>
            <label>
                <input type="checkbox" name="size[]" value="xxl">
                XXL
            </label>
        </div>
        <div class="form-group">
            <label for="pd1">Product Description</label>
            <textarea name="description" class="form-control" id="pd1" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-success w-100">Submit Now</button>
    </form>
</div>
@endsection
<script>
    function calculate() {
        var offer = document.getElementById('offer').value;
        var price = document.getElementById('Oldp').value;

        var new_price = (price)-((offer * price)/100);

        var showPrice = document.getElementById('new_price').value = Math.round(new_price);

   }
</script>