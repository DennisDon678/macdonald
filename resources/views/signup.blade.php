@extends('layouts.authLayout')

@section('main')
    <h4>Get Started!</h4>
    <h6 class="font-weight-light">It's free to signup and only takes a minute.</h6>
    <script language="javascript">
        function checkform() {
            if (document.regform.fullname.value == '') {
                alert("Please enter your full name!");
                document.regform.fullname.focus();
                return false;
            }

            if (document.regform.username.value == '') {
                alert("Please enter your username!");
                document.regform.username.focus();
                return false;
            }
            if (!document.regform.username.value.match(/^[A-Za-z0-9_\-]+$/)) {
                alert("For username you should use English letters and digits only!");
                document.regform.username.focus();
                return false;
            }
            if (document.regform.password.value == '') {
                alert("Please enter your password!");
                document.regform.password.focus();
                return false;
            }
            if (document.regform.password.value != document.regform.password2.value) {
                alert("Please check your password!");
                document.regform.password2.focus();
                return false;
            }


            if (document.regform.email.value == '') {
                alert("Please enter your e-mail address!");
                document.regform.email.focus();
                return false;
            }
            if (document.regform.email.value != document.regform.email1.value) {
                alert("Please retype your e-mail!");
                document.regform.email.focus();
                return false;
            }

            for (i in document.regform.elements) {
                f = document.regform.elements[i];
                if (f.name && f.name.match(/^pay_account/)) {
                    if (f.value == '') continue;
                    var notice = f.getAttribute('data-validate-notice');
                    var invalid = 0;
                    if (f.getAttribute('data-validate') == 'regexp') {
                        var re = new RegExp(f.getAttribute('data-validate-regexp'));
                        if (!f.value.match(re)) {
                            invalid = 1;
                        }
                    } else if (f.getAttribute('data-validate') == 'email') {
                        var re = /^[^\@]+\@[^\@]+\.\w{2,4}$/;
                        if (!f.value.match(re)) {
                            invalid = 1;
                        }
                    }
                    if (invalid) {
                        alert('Invalid account format. Expected ' + notice);
                        f.focus();
                        return false;
                    }
                }
            }

            if (document.regform.agree.checked == false) {
                alert("You have to agree with the Terms and Conditions!");
                return false;
            }

            return true;
        }

        function IsNumeric(sText) {
            var ValidChars = "0123456789";
            var IsNumber = true;
            var Char;
            if (sText == '') return false;
            for (i = 0; i < sText.length && IsNumber == true; i++) {
                Char = sText.charAt(i);
                if (ValidChars.indexOf(Char) == -1) {
                    IsNumber = false;
                }
            }
            return IsNumber;
        }
    </script>

    <form method="post" onsubmit="return checkform()" name="regform" class="pt-3">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="Enter your Fullname">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input class="form-control" placeholder="Enter your username" type="text" name="username" value="{{old('username')}}">
            @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Enter your Password" type="password" name="password" value="">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Retype Password" type="password" name="password_confirmation" value="">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Enter your E-mail" type="text" name="email" value="{{old('email')}}">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input class="form-control" placeholder="Retype E-mail" type="text" name="email1" value="{{old('email1')}}">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" size="30" name="btc" value="{{old('btc')}}"
                placeholder="Bitcoin Wallet Address">

            @error('btc')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="text" size="30" name="eth" value="{{old('eth')}}"
                placeholder="Ethereum Wallet Address">

            @error('eth')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="text" size="30" name="usdt" value="{{old('usdt')}}"
                placeholder="Usdt Trc20(Tether) wallet">
            @error('usdt')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <div class="custom-checkbox" style='padding: 5px 28px;'>
                <input class="custom-control-input" type="checkbox" name="agree" value="1" id="customCheck1">
                <label class="custom-control-label text-color--400" for="customCheck1">I agree to the <a
                        href="index-14.htm?a=rules">terms and conditions</a></label>

            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit"
                name="create">Create Account</button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Already have an account? <a href="/auth/login" class="text-primary">Login</a>
        </div>
    </form>
@endsection
