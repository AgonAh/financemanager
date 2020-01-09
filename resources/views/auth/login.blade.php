<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<script src="https://use.fontawesome.com/e21d36c79c.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="/resources/js/message.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<head>
</head>
<body>
    <link rel="stylesheet" href="/styling/loginstyle.css">
    <div class="hero">
        <div class="mainImage">
            <div>
{{--                <img src="/assets//ubtlogoLogin.png" class="voterImage d-none">--}}
            </div>
            <div>
                <img src="/assets//ubtlogoLogin.png" class="votoImage">
            </div>
        </div>
        <div class="login">
            <h1 class="kyquText">Kyçu</h1>
            <div class="itemContainer">
{{--                <button class="loginBtn loginBtn--google" type="button">--}}
{{--                    <img src="./assets/google.png" class="googleButton" height="25" width="25">--}}
{{--                    <h3 class="buttonText">User Google Account</h3>--}}
{{--                </button>--}}
                <div class="rule">
                    <div class="line">
                        <div></div>
                    </div>
{{--                    <div class="words"> ose </div>--}}
                    <div class="line">
                        <div></div>
                    </div>
                </div>
                <div class="inputForms">
                    <h1>Login</h1>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div id="emailError">
                            <label id="u" class="labelStyle">Email</label><br>
                            <input id="user" type="text" name="email" placeholder="Email" class="textInputFoo"><br>
                            <div id ="user">
                                <span id="username" class="text-danger font-weight-bold"></span>
                            </div>
                        </div>
{{--                        <label id="p" class="labelStyle2">Password</label><br>--}}
                        <div id="passError">
                            <input id="pass" type="password" name="password" placeholder="Password" class="textInputFoo"><br>
                            <div id="passw">
                                <span id="Password" class="text-danger font-weight-bold"></span>
                            </div>
                        </div>
                        <div id="loginn">
                            <input type="submit" name="submitted" value="Kyçu" class="kyquButton">
                        </div>
                    </form>
                </div>
                <h3 class="forgotPasswordText">Forgot password?</h3>
            </div>
            <!-- <h3 class="helpText">Keni nevojë për ndihmë?</h3> -->
        </div>
    </div>
    <script>
        function validimi() {

            var user = document.getElementById('user').value;
            var pass = document.getElementById('pass').value;

            if (user == "") {
                document.getElementById('username').innerHTML = "Plotëso username ose email";
                return false;
            }

            if (!isNaN(user)) {
                document.getElementById('username').innerHTML = "Nuk është email valid";
                return false;
            }

            if (pass == "") {
                document.getElementById('Password').innerHTML = "Plotëso password";
                return false;
            }
        }
    </script>

</body>








    {{--    --}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                <a href="/register" class="btn btn-primary">Register</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
