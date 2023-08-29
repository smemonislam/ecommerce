@extends('admin.layouts.app')

@section('title', 'Pages')

@section('admin_content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Page Create</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New Page</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('pages.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Page Position</label>
                                <select class="form-control" name="page_position">
                                    <option disabled>Select Option</option>
                                    <option value="1">Line One</option>
                                    <option value="2">Line Two</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pagename">Page Name</label>
                                <input type="text" class="form-control" id="pagename" name="page_name">
                            </div>
                            <div class="form-group">
                                <label for="pagetitle">Page Title</label>
                                <input type="text" class="form-control" id="pagetitle" name="page_title">
                            </div>
                            <div class="form-group">
                                <label>Page Description</label>
                                <textarea name="page_description" class="form-control textarea"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection