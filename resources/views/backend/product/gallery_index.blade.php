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
                      <th>Gallery</th>
                      <th>Create Date</th>
                      {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($galleries as $key => $gallery)
                          <tr>
                              <td>{{$galleries->firstItem() + $key}}</td>
                              <td><img src="{{asset('frontend/img/product/gallery/'.$gallery->image_name)}}" height="150"></td>
                              <td>{{ $gallery->created_at->format('d-M-Y h:i:s a')}} ({{$gallery->created_at->diffForHumans()}})</td>
                              <td><a href="{{ route('product.edit',$gallery ->id) }}" class="btn btn-primary">Edit</a>
                                  <a href="{{route('galleryDestroy',$gallery ->id)}}" class="btn btn-danger" type="submit">Trashed</a>
                              </td>
                          </tr>
                      @endforeach
                    <tr>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              {{ $galleries->links() }}
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection