@extends('admin.layouts.app')

@section('headsection')

<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

@endsection

@section('main-content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Text Editors</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Category</a></li>
                        <li class="breadcrumb-item active">edit</li>
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
                        <h3 class="card-title">Edit Category</h3>
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
                    <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="col-lg-12 ">


                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="{{$category->name}}">
                                </div>

                            </div>

                        </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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

@section('footersection')

@endsection
