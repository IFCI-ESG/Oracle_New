<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Log In'])
    @include('layouts.shared/head-css')
    @vite(['resources/scss/icons.scss'])
</head>

<body class="loading auth-fluid-pages pb-0">

    <div class="auth-fluid">


        <!-- Auth fluid right content -->
        <div class="auth-fluid-right " style="background-color: rgb(1 1 1 / 0%);">
            <div class="auth-user-testimonial" style="margin: 10vh;">

                <h5 class="text-white">
                    <!-- -  ESG-PRAKRIT Admin User -->
                </h5>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->

        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-start">
                        <div class="auth-brand">
                            <a href="" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="/images/logo/home-logo2.png" alt="" height="60">
                                </span>
                            </a>

                            <a href="" class="logo logo-light text-center">
                                <span class="logo-lg">
                                    <img src="/images/logo/home-logo2.png" alt="" height="60">
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Bank Sign In</h4>
                    <p class="text-muted mb-4">Enter your Username and password to access account.</p>
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        <br>
                    @endif
                    @if (session('success'))
                        <div class=" alert alert-success">{{ session('success') }}
                        </div>
                        <br>
                    @endif

                    @if (sizeof($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- form -->
                    <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
                        @csrf
                        <input class="form-control" type="hidden" name="user_type" id="user_type" readonly
                            value="bank">
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Username</label>
                            <input id="identity" type="text"
                                class="form-control @if ($errors->has('unique_login_id')) {{ $errors->has('unique_login_id') ? ' is-invalid' : '' }} @elseif($errors->has('email')) {{ $errors->has('email') ? ' is-invalid' : '' }} @endif"
                                name="identity" value="{{ old('identity') }}" placeholder="" required autofocus>

                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="" required autocomplete="off">
                                <div class="input-group-text" data-password="true">
                                    <span class="password-eye" id="toggle-password"></span>
                                </div>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-muted float-end mt-1" style="color: #0f9ee6 !important;"><small>Forgot password?</small></a>
                        </div>
                    <input type="hidden" id="encryptedIdentity" name="encryptedIdentity">
                        <input type="hidden" id="encryptedPassword" name="encryptedPassword">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>

                                <span class="has-tip top" data-tooltip data-click-open="true" data-position="top"
                                    title='Important Instructions
              Password should be at least 8 characters long, including one lowercase letter, one uppercase letter, one number, and one special character from @$!%*?&
               DO NOT. provide your username and password anywhere other than in this page.
             Your username and password are highly confidential.
            NEVER part with them. IFCI will never ask for this information
             ALWAYS visit the portal directly instead of clicking on the links provided in emails or third party websites
            NEVER respond to any popup,email, SMS or phone call, no matter how appealing or official looking, seeking your personal information such as username, password(s), mobile number, etc. Such communications are sent or created by fraudsters to trick you into parting with your credentials'>

                                    
                                </span>
                            </div>

                        </div>


                        <div class="text-center d-grid">
                            <button class="btn btn-primary" type="submit">Log In </button>
                        </div>



                        <!-- social-->
                        <!--     <div class="text-center mt-4">
                            <p class="text-muted font-16">Sign in with</p>
                            <ul class="social-list list-inline mt-3">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div> -->
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Don't have an account? <a href="{{ route('signup') }}" class="text-muted ms-1"><b>Sign
                                    Up</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

    </div>
    <!-- end auth-fluid-->

    @vite('resources/js/pages/auth.js')

    <script src="{{ asset('asset/js/landing/crypto-js.min.js') }}"></script>
    <script src="{{ asset('asset/js/landing/aes.min.js') }}"></script>
    <script>
        $(document).foundation();
        var a = sessionStorage.getItem('my_session');
        var assignment = document.getElementById("user_type").value = a;
    </script>

    <script>
        // document.querySelector('#loginForm').addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     var id = document.getElementById("identity");
        //     var pwd = document.getElementById("password");

        //     var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
        //     var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");


        //     var encId = CryptoJS.AES.encrypt(id.value, key, {
        //         iv,
        //         padding: CryptoJS.pad.ZeroPadding,
        //     });
        //     var encPwd = CryptoJS.AES.encrypt(pwd.value, key, {
        //         iv,
        //         padding: CryptoJS.pad.ZeroPadding,
        //     });


        //     id.value = encId.toString();
        //     pwd.value = encPwd.toString();
        //     var loginForm = document.getElementById("loginForm");
        //     loginForm.submit();
        // });






document.querySelector('#loginForm').addEventListener('submit', (e) => {
    e.preventDefault();

    var id = document.getElementById("identity");
    var pwd = document.getElementById("password");
    var encIdField = document.getElementById("encryptedIdentity");
    var encPwdField = document.getElementById("encryptedPassword");

    var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");

    var encId = CryptoJS.AES.encrypt(id.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    }).toString();

    var encPwd = CryptoJS.AES.encrypt(pwd.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    }).toString();

    // Store encrypted values in hidden inputs
    encIdField.value = encId;
    encPwdField.value = encPwd;

    // Clear original inputs so plaintext values are not sent
   // id.value = "";
   // pwd.value = "";

    e.target.submit();
});


        document.addEventListener("DOMContentLoaded", function () {
            const togglePasswordButtons = document.querySelectorAll("#toggle-password");

            togglePasswordButtons.forEach(button => {
                button.addEventListener("click", function () {
                    // Find the closest input field to this button (use the parent div to get the input)
                    const inputGroup = this.closest('.input-group');
                    const passwordField = inputGroup.querySelector('input[type="password"], input[type="text"]'); // find the input field in the group

                    const isPassword = passwordField.getAttribute("type") === "password";

                    // Toggle input type
                    passwordField.setAttribute("type", isPassword ? "text" : "password");

                    // Toggle data attribute on the parent div
                    inputGroup.querySelector('.input-group-text').setAttribute("data-password", isPassword ? "false" : "true");

                });
            });
        });
    </script>
</body>

</html>
