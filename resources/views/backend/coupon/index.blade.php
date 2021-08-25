@extends('backend.master')
@section('coupon')
active show-sub
@endsection
@section('coupon-index')
  active
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>View Coupons</h1>
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
                      <th>Coupon Name</th>
                      <th>Coupon Persons</th>
                      <th>Coupon Percentage</th>
                      <th>Coupon Validity</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($coupons as $key => $coupon)
                          <tr>
                              <td>{{$coupons->firstItem() + $key}}</td>
                              <td>{{ $coupon->coupon_name}}</td>
                              <td>{{ $coupon->coupon_person}}</td>
                              <td>{{ $coupon->coupon_percent}}</td>
                              <td>{{ $coupon->validity_date}}</td>
                              <td>{{ $coupon->created_at->format('d-M-Y h:i:s a')}} ({{$coupon->created_at->diffForHumans()}})</td>
                              <td><a href="{{ route('coupon.edit',$coupon->id) }}" class="btn btn-primary">Edit</a>
                                
                                <form method="POST" action="{{route('coupon.destroy',['coupon' => $coupon->id,])}}">
                                  @method('DELETE')
                                  @csrf
                                  <input type="hidden" name="id" value="{{$coupon->id}}">
                                <button type="submit" name="submit" class="btn btn-danger">Trashed</button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
                    <tr>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              {{ $coupons->links() }}
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection