@extends('layouts.authLayout')

@section('main')

@section('body-class','full-page-wrapper')
    <h4>Hello!</h4>
    <h6 class="font-weight-light">Welcome Back</h6>

    <form method="post" name="loginForm">
        @csrf
        <div class="form-group mb-4">
            <input class="form-control form-control-lg" placeholder="Enter your E-mail*" type="email" name='email' value="{{old('email')}}" required>
            @error('email')
                <div class="text-danger mt-1 small">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <input class="form-control form-control-lg" placeholder="Enter your Password*" type="password" name='password' required>
            @error('password')
                <div class="text-danger mt-1 small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
            <style>
                .auth-form-btn { transition: all 0.3s ease; }
                .auth-form-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
            </style>
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn rounded" type="submit"
                name="login">SIGN IN</button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Create a new account <a href="/auth/signup" class="text-primary font-weight-bold">Sign Up</a>
        </div>
    </form>
@endsection
