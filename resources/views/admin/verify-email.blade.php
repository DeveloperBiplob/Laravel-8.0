@extends('layouts.app')
@section('title', 'Admin Email Verification')
@section('app-content')
<div class="register-page" style="min-height: 586.391px;">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>
        
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif
        
                    <div class="mt-4 flex items-center justify-between">
                        <form style="float:left" method="POST" action=""> <!-- route('verification.send') -->
                            @csrf
                            <div>
                                <button class="btn btn-info btn-sm">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form>
        
                        <form style="float:right" method="POST" action="{{ route('admin.logout') }}">
                            @csrf
        
                            <button class="btn btn-info btn-sm" type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection