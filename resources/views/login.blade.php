@extends('layouts.authLayout')

@section('main')

@section('body-class','full-page-wrapper')
    <h4>Hello!</h4>
    <h6 class="font-weight-light">Welcome Back</h6>

    <script language="javascript">
        function checkform() {
            if (document.forgotform.email.value == '') {
                alert("Please type your username or email!");
                document.forgotform.email.focus();
                return false;
            }
            return true;
        }
    </script>

    <form method="post" name="forgotform" onsubmit="return checkform();">
        @csrf
        <div class="form-group">
            <input class="form-control" placeholder="Enter your E-mail*" type="text" name='email' value="{{old('email')}}">
            @error('email')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Enter your Password*" type="password" name='password' value="">
        </div>

        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit"
                name="login">SIGN IN</button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Create a new account <a href="/auth/signup" class="text-primary">Sign Up</a>
        </div>
    </form>
@endsection
