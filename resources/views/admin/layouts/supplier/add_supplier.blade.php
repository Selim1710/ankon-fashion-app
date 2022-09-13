@extends('admin.master')
@section('contents')
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
<div class="myform text-capitalize">
    <h4 class="text-center text-secondary">Add supplier From here</h4>
    <form action="{{ route('admin.store.supplier') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="c_n1"> Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" id="c_n1" required>
        </div>
        <div class="form-group">
            <label for="c_n2"> email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" id="c_n2" required>
        </div>
        <div class="form-group">
            <label for="c_n3"> phone</label>
            <input type="number" name="phone" class="form-control" placeholder="Enter phone" id="c_n3" required>
        </div>
        <div class="form-group">
            <label for="c_n4"> password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" id="c_n4" required>
        </div>
        <div class="form-group">
            <label for="c_n5"> address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address" id="c_n5" required>
        </div>
        <!-- hidden role -->
        <div class="form-group">
            <input type="hidden" name="role" value="supplier" class="form-control" placeholder="Enter role" id="c_n6" readonly>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Now</button>
    </form>
</div>
@endsection