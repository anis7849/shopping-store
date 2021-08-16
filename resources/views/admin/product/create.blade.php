@extends('admin.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Product</h3>
                    </div>

                    @if($errors->any())

                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="card-body">
                            <div class="col-lg-12 ">

                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="col-lg-12 ">

                                <div class="form-group">
                                    <label for="name">Product Description</label>
                                    <textarea class="form-control" rows="5" name="description" placeholder="Product description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 ">

                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <select class="form-control" name="category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 ">

                                <div class="form-group">
                                    <label for="name">Image</label>
                                    <input type="file" class="form-control" name="image" placeholder="Image" />
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.card-body -->


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('categories.index')}}" class="btn btn-warning">Cancel</a>
                </div>
                </form>
            </div>

        </div>
        <!-- /.col-->
</div>
<!-- ./row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
