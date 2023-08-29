@extends('admin.layouts.app')

@section('title', 'Pages')

@section('admin_content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dynamic Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ route('pages.create') }}" class="btn btn-primary">+ Add New</a>
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
              <h3 class="card-title">All Pages List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Page Position</th>
                    <th>Page Name</th>                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach( $data as $row )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->page_position }}</td>
                    <td>{{ $row->page_name }}</td>                    
                    <td>       
                      <form action="{{ route('pages.destroy', $row->id) }}" method="POST" id="delete_confirm">
                        <a href="{{ route('pages.edit', $row->id) }}"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>    
                        @csrf
                        @method("DELETE")                    
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>  
                      </form>                  
                    </td>
                  </tr>
                  @endforeach
                </tbody>
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
  
@endsection