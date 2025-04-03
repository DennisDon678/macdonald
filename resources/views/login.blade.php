@extends('layouts.authLayout')

@section('main')

@section('body-class','full-page-wrapper')
    <h4>Hello!</h4>
    <h6 class="font-weight-light">Forgot password</h6>

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

    <form method="post" name="forgotform" onsubmit="return checkform();"><input type="hidden" name="form_id"
            value="17435588577006"><input type="hidden" name="form_token" value="928905d1dcec633594de702e18895b00">
        <input type="hidden" name="a" value="forgot_password">
        <input type="hidden" name="action" value="forgot_password">
        <div class="form-group">
            <input class="form-control" placeholder="Enter your E-mail*" type="text" name='email' value="">
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
