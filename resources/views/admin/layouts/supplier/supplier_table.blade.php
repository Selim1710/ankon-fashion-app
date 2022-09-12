@extends('admin.master')
@section('contents')
<div class="table_button">
    <a href="{{ route('admin.add.supplier') }}" class="btn btn-primary">Add-Supplier</a>
</div>
<div class="manage_table">
    <table class="table table-borderless table-hover" id="mySuppliersTable">
        <thead class="table-primary">
            <tr class="text-center">
                <th scope="col">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Category id</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $key=>$supplier)
            <tr class="text-center">
                <td>{{ $key+1 }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->category_id }}</td>
                <td>
                    <a href="{{ route('admin.edit.supplier',$supplier->id) }}" class="btn btn-primary"><i class="fa fa-th-list"></i></a>
                    <a href="{{ route('admin.delete.supplier',$supplier->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#mySuppliersTable').DataTable();
    });
</script>