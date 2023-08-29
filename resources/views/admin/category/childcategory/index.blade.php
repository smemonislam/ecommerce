@extends('admin.layouts.app')

@section('title', 'Category')

@section('admin_content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Child Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">+ Add New</button>
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
              <h3 class="card-title">All Category List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="ydatatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Child Category Name</th>
                    <th>Child Category Slug</th>
                    <th>Sub Category Name</th>
                    <th>Category Name</th>
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


@include('admin.category.childcategory.add_childcategory')

<!-- Edit Category Modal -->
<div class="modal fade" id="EditCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editChildCategory">
      
    </div>
  </div>
</div>
@include('admin.category.childcategory.childcategory_js')
@endsection