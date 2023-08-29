@extends('admin.layouts.app')

@section('title', 'Coupon')

@section('admin_content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Coupon</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCouponModal">+ Add New</button>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Coupon</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="ydatatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Coupon Code</th>
                    <th>Coupon Amount</th>
                    <th>Coupon Date</th>
                    <th>Coupon Status</th>
                    <th>Action</th>
                  </tr>
                </thead>                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

  @include('admin.offer.coupon.add_coupon')
  @include('admin.offer.coupon.edit_coupon')
  @include('admin.offer.coupon.coupon_js')
@endsection