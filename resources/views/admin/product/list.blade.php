@extends('admin.layouts.app')
@section('headsection')

<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@endsection

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                @include('admin.includes.message')

                <a class='offset-md-5 btn btn-success float-right' href="{{ route('products.create') }}">Add Group</a>

            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)

                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><img src="{{ $product->image}}" style="width:100px;height:100px;"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><a href="{{ route('products.edit',$product->id) }}"><i class="fas fa-edit"></i></a>


                                <form id="delete-form-{{$product->id}}" action="{{ route('products.destroy',$product->id) }}" style="display:none" method="POST">

                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="" onclick="
if(confirm('Are you sure you want to delete this product'))
{
event.preventDefault();
document.getElementById('delete-form-{{$product->id}}').submit();
}
else{
event.preventDefault();
}">

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-trash-alt"></i></a>

                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S.no</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

                <span style="float: right">{{ $products->links() }}</span>
                <!-- </div> -->
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('footersection')

<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>

<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>



<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

    });
</script>
@endsection
