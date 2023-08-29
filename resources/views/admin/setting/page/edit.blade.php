@extends('admin.layouts.app')

@section('title', 'Pages Edit')

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
                    <li class="breadcrumb-item active">Page Edit</li>
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
                        <h3 class="card-title">Edit Page</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('pages.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Page Position</label>
                                <select class="form-control" name="page_position">
                                    <option disabled>Select Option</option>
                                    <option value="1" @selected(1 == $data->page_position)>Line One</option>
                                    <option value="2" @selected(2 == $data->page_position)>Line Two</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pagename">Page Name</label>
                                <input type="text" class="form-control" id="pagename" name="page_name" value="{{ $data->page_name }}">
                            </div>
                            <div class="form-group">
                                <label for="pagetitle">Page Title</label>
                                <input type="text" class="form-control" id="pagetitle" name="page_title" value="{{ $data->page_title }}">
                            </div>
                            <div class="form-group">
                                <label>Page Description</label>
                                <textarea name="page_description" class="form-control textarea">{{ $data->page_description }}</textarea>
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