@extends('admin.layouts.app')

@section('title', 'SEO Setting')

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
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">SMTP Mail</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">SMTP Mail Setting</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('smtp.store', $data->id) }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="mailmiler">Mail Mailer</label>
                <input type="text" class="form-control" id="mailmiler" name="mailer" value="{{ $data->mailer }}">
              </div>
              <div class="form-group">
                <label for="mailhost">Mail Host</label>
                <input type="text" class="form-control" id="mailhost" name="host" value="{{ $data->host }}">
              </div>
              <div class="form-group">
                <label for="mailport">Mail Port</label>
                <input type="text" class="form-control" id="mailport" name="port" value="{{ $data->port }}">
              </div>
              <div class="form-group">
                <label for="mailusername">Mail Username</label>
                <input type="text" class="form-control" id="mailusername" name="username" value="{{ $data->username }}">
              </div>
              <div class="form-group">
                <label for="mailpass">Mail Password</label>
                <input type="text" class="form-control" id="mailpass" name="password" value="{{ $data->password }}">
              </div>
              
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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