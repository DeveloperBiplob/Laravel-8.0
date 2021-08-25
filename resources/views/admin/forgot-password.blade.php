@extends('layouts.app')
@section('title', 'Forget Admin Password')
@section('app-content')
    <div class="register-page" style="min-height: 586.391px;">
    <div class="login-box">
        <div class="login-logo">
        <a href=""><b>Admin Forget Password</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Admin Forget Password</p>
    
            <form action="{{ route('admin.password.email') }}" method="post">
                @csrf
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                </div>
            </div>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            <p class="mb-0">
            <a style="float: right" href="{{ route('admin.login') }}" class="text-center">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
        </div>
    </div>
    </div>
@endsection