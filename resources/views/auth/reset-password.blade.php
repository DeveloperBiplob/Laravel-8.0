@extends('layouts.app')
@section('title', 'Resert Password')
@section('app-content')
    <div class="register-page" style="min-height: 586.391px;">
    <div class="login-box">
        <div class="login-logo">
        <a href=""><b>User Resert Password</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">User Forget Password</p>
    
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token')  }}">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" value="{{ old('email', request()->email) }}" name="email" readonly>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control"  name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Confirm</label>
                    <input type="password" class="form-control"  name="password_confirmation">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Change</button>
                </div>
            </form>
            <p class="mb-0">
            <a style="float: right" href="{{ route('login') }}" class="text-center">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
        </div>
    </div>
    </div>
@endsection