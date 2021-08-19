@extends('backend.master')
@section('product')
active show-sub
@endsection
@section('product-create')
  active
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
                <h3 class="card-title">Add Brand</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('product.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_name">Product Name: <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control @error('product_name') is invalid @enderror" id="product_name" name="product_name" value="{{old('product_name')}}" placeholder="Enter Your Product Name">
                        @error('product_name')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_slug">Product Slug: <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control @error('product_slug') is invalid @enderror" id="product_slug" name="product_slug" value="{{old('product_slug')}}" placeholder="Auto Fill Product Slug">
                        @error('product_slug')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                        <select class="form-control select2 @error('category_id') is invalid @enderror" value="{{old('category_id')}}" name="category_id" data-placeholder="Choose country">
                          <option label="Choose Category"></option>
                          @forelse ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                          @empty
                            <option value="">Please Fill The Category Page</option>
                          @endforelse
                        </select>
                        @error('category_id')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                        <select class="form-control select2 @error('brand_id') is invalid @enderror" value="{{old('brand_id')}}" name="brand_id" data-placeholder="Choose brand">
                          <option label="Choose brand"></option>
                          @forelse ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                          @empty
                            <option value="">Please Fill The Brand Page</option>
                          @endforelse
                        </select>
                        @error('brand_id')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="quantity">Product Quantity: <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control @error('quantity') is invalid @enderror" id="quantity" name="quantity" value="{{old('quantity')}}" placeholder="Enter Your Product Quantity">
                        @error('quantity')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="weight">Product Weight (kg): <span class="tx-danger">*</span></label>
                        <input type="number" step="any" class="form-control @error('weight') is invalid @enderror" id="weight" name="weight" value="{{old('weight')}}" placeholder="Enter Your Product Weight">
                        @error('weight')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="thumbnail">Thumbnail(one image): <span class="tx-danger">*</span></label>
                        <input type="file" class="form-control @error('thumbnail') is invalid @enderror" value="{{old('quantity')}}" name="thumbnail"
                        id="thumbnail">
                        @error('thumbnail')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="image_name">Gallery(multiple image): <span class="tx-danger">*</span></label>
                        <input type="file" class="form-control @error('image_name') is invalid @enderror" multiple name="image_name[]" value="{{old('image_name')}}">
                        @error('image_name')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="price">Product Price: <span class="tx-danger">*</span></label>
                        <input  type="number" min="0" class="form-control @error('price') is invalid @enderror" id="price" name="price" value="{{old('price')}}" placeholder="Please Enter regular Price">
                        @error('price')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="offer_price">Product Offer Price:</label>
                        <input type="number" min="0" class="form-control @error('offer_price') is invalid @enderror" id="price" name="offer_price" value="{{old('offer_price')}}" placeholder="Please Enter Offer Price">
                        @error('offer_price')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="summary">Product Summary: <span class="tx-danger">*</span></label>
                        <textarea class="form-control @error('summary') is invalid @enderror" name="summary" id="summary" cols="30" rows="10" placeholder="Please Enter Summary">{{old('summary')}}</textarea>
                        @error('summary')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="description">Product Description: <span class="tx-danger">*</span></label>
                        <textarea class="form-control @error('description') is invalid @enderror" name="description" id="description" cols="30" rows="10" placeholder="Please Enter Description">{{old('description')}}</textarea>
                        @error('description')
                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                        @enderror
                      </div>
                    </div>
                  </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button>
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
  
  $('#product_name').keyup(function(){
    $('#product_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s+/g, '-'));
  });
</script>
@endsection