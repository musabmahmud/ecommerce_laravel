@extends('backend.master')
@section('brand')
active show-sub
@endsection
@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @endif
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('brand.update',['brand' => $brand->id,])}}" method="POST">
                {{method_field('PUT')}}
                @csrf
                <input type="hidden" name="id" value="{{$brand->id}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="brand_name">Category Name</label>
                    <input type="text" class="form-control @error('brand_name') is invalid @enderror" id="brand_name" name="brand_name" value="{{$brand->brand_name}}" placeholder="Enter Your Brand Name">
                    @error('category_name')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
                    
                    <input type="hidden" value="{{$brand->slug}}"  class="form-control @error('slug') is invalid @enderror" id="slug" name="slug" value="{{old('slug')}}">
                    
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary btn-lg" name="update">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
@section('footer_js')
<script>
  $('#brand_name').keyup(function(){
    $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s+/g, '-'));
  });
</script>
@endsection