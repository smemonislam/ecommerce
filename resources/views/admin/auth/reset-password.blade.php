@extends('admin.layouts.master')

@section('title', 'Login')

@section('admin_authentication')
<div class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <div class="h1"><b>Reset Password</b></div>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form action="{{ route('admin.password.store') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="input-group mb-3">
          <x-input-text type="email" name="email" :value="$request->email" readonly/>
          <x-append-icon class="fas fa-envelope"/>
        </div>
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
        <div class="row">
          <div class="col-12">
            <x-button type="submit" class="btn btn-primary btn-block" value="Change password"/>
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
