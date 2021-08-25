@extends('backend.master')
@section('coupon')
active show-sub
@endsection
@section('coupon-create')
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
                <h3 class="card-title">Add Coupon</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('coupon.store')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="coupon_name">Coupon Name</label>
                    <input type="text" class="form-control @error('coupon_name') is invalid @enderror" id="coupon_name" name="coupon_name" value="{{old('coupon_name')}}" placeholder="Enter Your Coupon Name">
                    @error('coupon_name')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="coupon_person">Coupon Person</label>
                    <input type="number" min="1" class="form-control @error('coupon_person') is invalid @enderror" id="coupon_person" name="coupon_person" value="{{old('coupon_person')}}" placeholder="Enter Your Coupon Person">
                    @error('coupon_person')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="coupon_percent">Coupon Percentage <span class="text-warning">(less than or equal 100 percentage)</span></label>
                    <input type="number" max="100" class="form-control @error('coupon_percent') is invalid @enderror" id="coupon_percent" name="coupon_percent" value="{{old('coupon_percent')}}" placeholder="Enter Your Coupon Percentage(Ex:100)">
                    @error('coupon_percent')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="validity_date">Coupon Validity</label>
                    <input type="date" class="form-control @error('validity_date') is invalid @enderror" id="coupon_validity" name="validity_date" value="{{old('validity_date')}}" placeholder="Enter Your Coupon Name">
                    @error('validity_date')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
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
  
</script>
@endsection