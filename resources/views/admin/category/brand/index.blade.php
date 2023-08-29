@extends('admin.layouts.app')

@section('title', 'Brands')

@section('admin_content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Brands</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">+ Add New</button>
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
              <h3 class="card-title">All Brand List</h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="ydatatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Brand Name</th>
                    <th>Brand Slug</th>
                    <th>Brand Image</th>
                    <th>Show Page</th>
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


@include('admin.category.brand.add_brand')

<!-- Edit Category Modal -->
<div class="modal fade" id="EditBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editBrand">
      
    </div>
  </div>
</div>
@include('admin.category.brand.brand_js')
@endsection