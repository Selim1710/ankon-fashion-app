@extends('admin.master')
@section('contents')
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
    <form action="{{ route('admin.update.supplier',$supplier->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="c_n1"> Name</label>
            <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" id="c_n1" required>
        </div>
        <div class="form-group">
            <label for="c_n2"> email</label>
            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}" id="c_n2" required>
        </div>        
        <div class="form-group">
            <label for="c_n3"> phone</label>
            <input type="number" name="phone" class="form-control" value="{{ $supplier->phone }}" id="c_n3" required>
        </div>                
        <div class="form-group">
            <label for="c_n5"> address</label>
            <input type="text" name="address" class="form-control" value="{{ $supplier->address }}" id="c_n5" required>
        </div>    
                   
        <button type="submit" class="btn btn-primary w-100">Submit Now</button>
    </form>
</div>
@endsection