@extends('admin.layouts.app')

@section('title', 'Products')

@section('admin_content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Products</h1>
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
              <h3 class="card-title">All Products</h3>
            </div>
            <div class="row p-2">
              <div class="form-group col-lg-3">
                <label>Category</label>
                <select name="category_id" id="category_id" class="form-control submitable">
                  <option value="">All</option>
                  @foreach ($categoires as $category)                      
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-lg-3">
                <label>Brand</label>
                <select name="brand_id" id="brand_id" class="form-control submitable">
                  <option value="">All</option>
                  @foreach ($brands as $brand)                      
                  <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-lg-3">
                <label>Warehouse</label>
                <select name="warehouse_id" id="warehouse_id" class="form-control submitable">
                  <option value="">All</option>
                  @foreach ($warehouses as $warehouse)                      
                  <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-lg-3">
                <label>Status</label>
                <select name="status" id="status" class="form-control submitable">
                  <option value="">All</option>   
                  <option value="1">Active</option>
                  <option value="0">Deactive</option>
                </select>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="ydatatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Thumbnail</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Category Name</th>
                    <th>Subcategory Name</th>
                    <th>Brand</th>
                    <th>Featured</th>
                    <th>Today Deal</th>
                    <th>Product Slider</th>
                    <th>Trendy</th>
                    <th>Status</th>
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

  @include('admin.product.product_js')
@endsection