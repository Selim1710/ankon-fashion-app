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
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->sub_category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="pn1">Name</label>
                <input type="text" name="name" class="form-control" id="pn1" required>
            </div>
            <div class="form-group">
                <label for="o1">Offer</label>
                <input type="number" name="offer" class="form-control" id="o1" required>
            </div>
            <div class="form-group">
                <label for="rp1">Price</label>
                <input type="number" name="price" class="form-control" id="rp1" required>
            </div>
            <div class="form-group">
                <label for="img1">Image</label>
                <input type="file" accept="image/*" multiple name="image" class="form-control" id="img1" required>
            </div>
            <div class="form-group mt-3">
                <h4>Size</h4>
                <label>
                    <input type="checkbox" name="one-size" value="one-size" required>
                    one-size
                </label>
                &nbsp;
                <label>
                    <input type="checkbox" name="s-size" value="s-size" required>
                    small
                </label>
                <label>
                    <input type="checkbox" name="m-size" value="m-size" required>
                    medium
                </label>
                <label>
                    <input type="checkbox" name="sl-size" value="sl-size" required>
                    large
                </label>
                <label>
                    <input type="checkbox" name="xl-size" value="xl-size" required>
                    extra large
                </label>
            </div>
            <div class="form-group">
                <label for="pd1">Product Description</label>
                <textarea name="description" class="form-control" id="pd1" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Now</button>
        </form>
    </div>
@endsection
