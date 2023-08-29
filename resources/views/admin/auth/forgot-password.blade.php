@extends('admin.layouts.master')

@section('title', 'Login')

@section('admin_authentication')
<div class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <div class="h1"><b>Forgot Password</b></div>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        @if( session()->has('status'))
          <div class="alert alet-success">{{ session('status') }}</div>
        @endif
        <form action="{{ route('admin.password.email') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <x-input-text type="email" name="email" placeholder="Enter your Email"/>
            <x-append-icon class="fas fa-envelope"/>
          </div>
          <x-input-error :messages="$errors->get('email')"/>
          <div class="row">
            <div class="col-12">
              <x-button type="submit" class="btn btn-primary btn-block" value="Request new password"/>              
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="{{ route('admin.login') }}">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
<!-- /.login-box -->
</div>
@endsection
