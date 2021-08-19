@extends('backend.master')
@section('product')
active show-sub
@endsection
@section('product-index')
  active
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>View Products</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table </h3>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('success') }}
                    </div>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST">
                @csrf
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Product Name</th>
                      <th>Category Name</th>
                      <th>Brand Name</th>
                      <th>Quantity</th>
                      <th>Weight</th>
                      <th>Price</th>
                      <th>Offer Price</th>
                      <th>Summary</th>
                      <th>Description</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $key => $product)
                          <tr>
                              <td>{{$products->firstItem() + $key}}</td>
                              <td>{{ $product->product_name}}</td>
                              <td>{{ $product->category->category_name}}</td>
                              <td>{{ $product->brand->brand_name}}</td>
                              <td>{{ $product->quantity}}</td>
                              <td>{{ $product->weight}}</td>
                              <td>{{ $product->price}}</td>
                              <td>{{ $product->offer_price}}</td>
                              <td>{{ Str::words($product->summary, 15)}}</td>
                              <td>{{ Str::words($product->description, 15)}}</td>
                              <td>{{ $product->created_at->format('d-M-Y h:i:s a')}} ({{$product->created_at->diffForHumans()}})</td>
                              <td><a href="{{ route('restoreProduct',$product ->id) }}" class="btn btn-primary">Restore</a>
                              <a href="{{url('product/delete/'.$product->id)}}" class="btn btn-danger" type="submit">Delete Forever</a>
                              </td>
                          </tr>
                      @endforeach
                    <tr>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              {{ $products->links() }}
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('footer_js')
    <script>
        function show() {
            document.getElementById('scritta').className = 'visiblediv';
            document.getElementById('p1').className = 'hiddendiv';
        }

        function hide() {
            document.getElementById('scritta').className = 'hiddendiv';
            document.getElementById('p1').className = 'visiblediv';
        }
    </script>
@endsection