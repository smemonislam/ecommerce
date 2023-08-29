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
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">OnPage SEO</li>
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
            <h3 class="card-title">Your SEO Setting</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('seo.store', $data->id) }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="metatitle">Meta Title</label>
                <input type="text" class="form-control" id="metatitle" name="meta_title" value="{{ $data->meta_title }}">
              </div>
              <div class="form-group">
                <label for="metaauthor">Meta Author</label>
                <input type="text" class="form-control" id="metaauthor" name="meta_author" value="{{ $data->meta_author }}">
              </div>
              <div class="form-group">
                <label for="metatag">Meta Tag</label>
                <input type="text" class="form-control" id="metatag" name="meta_tag" value="{{ $data->meta_tag }}">
              </div>
              <div class="form-group">
                <label for="metadec">Meta Description</label>
                <textarea class="form-control" name="meta_description" id="metadec" cols="30" rows="4">{{ $data->meta_tag }}</textarea>
              </div>
              <div class="form-group">
                <label for="metakey">Meta Keyword</label>
                <input type="text" class="form-control" id="metakey" name="meta_keyword" value="{{ $data->meta_keyword }}">
                <small>Example: ecommerce, online shop, online market</small>
              </div>
              <strong class="text-center text-success">--- Other Option ---</strong>
              <div class="form-group">
                <label for="metaverification">Google Verification</label>
                <input type="text" class="form-control" id="metaverification" name="google_verification" value="{{ $data->google_verification }}">
              </div>
              <div class="form-group">
                <label for="metaanaly">Meta Analytics</label>
                <input type="text" class="form-control" id="metaanaly" name="meta_analytics" value="{{ $data->meta_analytics }}">
              </div>
              <div class="form-group">
                <label for="metaalexa">Alexa Verification</label>
                <input type="text" class="form-control" id="metaalexa" name="alexa_verification" value="{{ $data->alexa_verification }}">
              </div>
              <div class="form-group">
                <label for="metaadsen">Google Adsense</label>
                <input type="text" class="form-control" id="metaadsen" name="google_adsense" value="{{ $data->google_adsense }}">
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