@extends('admin.layouts.app')

@section('title', 'Setting')

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
          <li class="breadcrumb-item active">Setting</li>
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
            <h3 class="card-title">Website Setting</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('setting.store', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Currency</label>
                <select name="currency" class="form-control">
                  <option value="৳" @selected( $data->currency == "৳")>Taka</option>
                  <option value="$" @selected( $data->currency == "$")>USD</option>
                </select>
              </div>
              <div class="form-group">
                <label for="phoneOne">Phone One</label>
                <input type="text" class="form-control" id="phoneOne" name="phone_one" value="{{ $data->phone_one }}">
              </div>
              <div class="form-group">
                <label for="phoneTwo">Phone Two</label>
                <input type="text" class="form-control" id="phoneTwo" name="phone_two" value="{{ $data->phone_two }}">
              </div>
              <div class="form-group">
                <label for="mainEamil">Main Email</label>
                <input type="email" class="form-control" id="mainEamil" name="main_email" value="{{ $data->main_email }}">
              </div>
              <div class="form-group">
                <label for="supportEmail">Support Email</label>
                <input type="email" class="form-control" id="supportEmail" name="support_email" value="{{ $data->support_email }}">
              </div>
              
              <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" id="address" cols="30" rows="4">{{ $data->address }}</textarea>
              </div>
              <strong class="text-info">Social Link</strong>
              <div class="form-group">
                <label for="facebook">Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $data->facebook }}">
              </div>
              <div class="form-group">
                <label for="twitter">Twitter</label>
                <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $data->twitter }}">
              </div>
              <div class="form-group">
                <label for="instagram">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $data->instagram }}">
              </div>
              <div class="form-group">
                <label for="linkedin">Linkedin</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $data->linkedin }}">
              </div>
              <div class="form-group">
                <label for="youtube">Youtube</label>
                <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $data->youtube }}">
              </div>

              <strong class="text-info">Logo & Favicon</strong>
              <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control dropify" id="logo" name="logo">
                <input type="hidden" class="form-control" name="old_logo" value="{{ $data->logo }}">
              </div>
              <div class="form-group">
                <label for="favicon">Favicon</label>
                <input type="file" class="form-control dropify" id="favicon" name="favicon">
                <input type="hidden" class="form-control" name="old_favicon" value="{{ $data->favicon }}">
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
<script>
  $(document).ready(function(){
      $('.dropify').dropify({
      messages: {
          'default': 'Drag and drop or click',
          'replace': 'Drag and drop or click to replace',
          'remove':  'Remove',
          'error':   'Ooops, something wrong happended.'
      }
    });
  });
</script>
@endsection