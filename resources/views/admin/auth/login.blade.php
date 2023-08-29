@extends('admin.layouts.master')

@section('title', 'Login')

@section('admin_authentication')
<div class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <div class="h1"><b>Admin Login</b></div>
        <div id="press">Click</div>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('admin.login') }}" method="post">
          @csrf

          <div class="input-group mb-3">
            <x-input-text type="email" name="email" placeholder="Enter your Email"/>
            <x-append-icon class="fas fa-envelope"/>
          </div>
          <x-input-error :messages="$errors->get('email')"/>

          <div class="input-group mb-3">
            <x-input-text type="password" name="password" placeholder="Enter your Password"/>
            <x-append-icon class="fas fa-lock"/>
          </div>
          <x-input-error :messages="$errors->get('password')"/>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <x-button type="submit" class="btn btn-primary btn-block" value="Sign In"/>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          <a href="{{ route('admin.password.request') }}">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="{{ route('admin.register') }}" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
</div>
@endsection


