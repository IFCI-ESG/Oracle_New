<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.shared/title-meta', ['title' => 'Reset Password'])
    @include('layouts.shared/head-css')
    @vite(['resources/scss/icons.scss'])
</head>

<body class="loading authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">

                    <div class="card-body">

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            <br>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            <br>
                        @endif

                        @if (sizeof($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {{-- <div class="text-center w-75 m-auto">
                            <div class="auth-brand">
                                <a href="#" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="/images/logo-dark.png" alt="" height="22">
                                        </span>
                                </a>

                                <a href="#" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="/images/logo-light.png" alt="" height="22">
                                        </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less
                                than a minute</p>
                        </div> --}}

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" required
                                       placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control"
                                           placeholder="Enter your password" onkeyup="checkPasswordStrength()">
                                    <div class="input-group-text toggle-password" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                                <small id="password-strength" class="text-muted"></small>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="form-control" placeholder="Enter your password confirmation">
                                    <div class="input-group-text toggle-password" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control"
                                           placeholder="Enter your password">
                                    <div class="input-group-text toggle-password" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="form-control" placeholder="Enter your password confirmation">
                                    <div class="input-group-text toggle-password" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="text-center d-grid">
                                <button class="btn btn-success" type="submit"> Reset Password</button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    2024 -
    <script>
        document.write(new Date().getFullYear())
    </script> &nbsp; <a href="" class="text-white-50">ESG Prakrit</a>
</footer>

@vite('resources/js/pages/auth.js')
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const togglePasswordButtons = document.querySelectorAll(".toggle-password");

        togglePasswordButtons.forEach(button => {
            button.addEventListener("click", function () {
                // Find the closest input field to this button
                const passwordField = this.previousElementSibling;
                const isPassword = passwordField.getAttribute("type") === "password";

                // Toggle input type
                passwordField.setAttribute("type", isPassword ? "text" : "password");

                // Toggle data attribute
                this.setAttribute("data-password", isPassword ? "true" : "false");

                // Optional: Change eye icon (if using font awesome or another icon library)
                // this.querySelector(".password-eye").textContent = isPassword ? "👁️‍🗨️" : "👁️";
            });
        });
    });

    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthText = document.getElementById('password-strength');
        let strength = 0;
        let feedback = [];

        if (password.length >= 8) {
            strength += 1;
        } else {
            feedback.push("Password should be at least 8 characters long.");
        }

        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
            strength += 1;
        } else {
            feedback.push("Include both uppercase and lowercase letters.");
        }

        if (password.match(/[0-9]/)) {
            strength += 1;
        } else {
            feedback.push("Include at least one number.");
        }

        if (password.match(/[$@#&!%^*?]/)) {
            strength += 1;
        } else {
            feedback.push("Include at least one special character ($@#&!%^*?).");
        }

        if (password.length < 6) {
            strengthText.innerHTML = "❌ Too short. " + feedback.join(" ");
            strengthText.style.color = "red";
        } else if (strength === 1) {
            strengthText.innerHTML = "😟 Weak. " + feedback.join(" ");
            strengthText.style.color = "orange";
        } else if (strength === 2) {
            strengthText.innerHTML = "🙂 Moderate. " + feedback.join(" ");
            strengthText.style.color = "blue";
        } else if (strength === 3) {
            strengthText.innerHTML = "💪 Strong! Try adding more unique characters for a better password.";
            strengthText.style.color = "green";
        } else if (strength === 4) {
            strengthText.innerHTML = "🔥 Best! Your password is very secure.";
            strengthText.style.color = "darkgreen";
        }
    }
    </script>
</html>
