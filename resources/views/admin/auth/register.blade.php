@extends('admin.layouts.master')

@section('title', 'Register')

@section('admin_authentication')
<div class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <div class="h1"><b>Admin Register</b></div>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="{{ route('admin.register') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <x-input-text type="text" name="name" placeholder="Enter your name"/>
            <x-append-icon class="fas fa-user"/>
          </div>
          <x-input-error :messages="$errors->get('name')"/>
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
          <div class="input-group mb-3">
            <x-input-text type="password" name="password_confirmation" placeholder="Retype Password"/>
            <x-append-icon class="fas fa-lock"/>
          </div>
          <x-input-error :messages="$errors->get('password')"/>
          <div class="input-group mb-3">
            <x-input-text type="text" name="phone" placeholder="Enter your phone number"/>
            <x-append-icon class="fas fa-phone"/>
          </div>
          <x-input-error :messages="$errors->get('phone')"/>

          <div class="row">
            <div class="col-8"></div>
            <!-- /.col -->
            <div class="col-4">
              <x-button type="submit" class="btn btn-primary btn-block" value="Register"/>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <a href="{{ route('admin.login') }}" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
</div>
@endsection
