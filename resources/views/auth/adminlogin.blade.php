<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Log In'])
    @include('layouts.shared/head-css')
    @vite(['resources/scss/icons.scss'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                   <h4 class="mt-0">Welcome to ESG-PRAKRIT Portal</h4> 
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
                        <input class="form-control" type="hidden" name="user_type" id="user_type" readonly value="bank">
                        <input type="hidden" name="encryptedIdentity" id="encryptedIdentity">
                        <input type="hidden" name="encryptedPassword" id="encryptedPassword">
                        
                        <!-- Add error message div -->
                        <div id="error-message" class="alert alert-danger" style="display: none; margin-bottom: 15px;"></div>
                        
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
                            <button class="btn btn-primary" type="submit">Log In</button>
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

    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content border-0 shadow" style="border-radius: 16px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="otpModalLabel">Enter OTP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <!-- Success/Error Messages -->
                    <div id="otpMessage" class="alert mb-3" style="display: none; border-radius: 8px;"></div>
                    
                    <!-- OTP Input - Initially Hidden -->
                    <div class="mb-4" id="otpInputContainer" style="display: none;">
                        <input type="password" 
                            class="form-control form-control-lg text-center fw-bold" 
                            id="otp" 
                            maxlength="6" 
                            placeholder="• • • • • •" 
                            pattern="[0-9]*" 
                            inputmode="numeric" 
                            style="letter-spacing: 15px; font-size: 24px; border-radius: 8px;">
                    </div>
                    
                    <!-- Timer - Initially Hidden -->
                    <div id="otpTimer" class="text-center mb-3" style="display: none;">
                        <span class="text-muted">Time remaining: </span>
                        <span id="timer" class="fw-bold">02:00</span>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <!-- Initial State Buttons -->
                        <button type="button" 
                            class="btn btn-primary btn-lg" 
                            id="sendInitialOtp"
                            style="border-radius: 8px; background-color: #6658dd; border: none;">
                            Send OTP
                        </button>
                        <button type="button" 
                            class="btn btn-light btn-lg" 
                            data-bs-dismiss="modal"
                            style="border-radius: 8px;">
                            Cancel
                        </button>

                        <!-- Post OTP Send Buttons - Initially Hidden -->
                        <button type="button" 
                            class="btn btn-success btn-lg" 
                            id="verifyOtp" 
                            style="display: none; border-radius: 8px;">
                            Verify OTP
                        </button>
                        <button type="button" 
                            class="btn btn-warning btn-lg" 
                            id="resendOtpBtn" 
                            style="display: none; border-radius: 8px; background-color: #f7b84b; border: none; color: white;">
                            Resend OTP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="mdi mdi-check-circle text-success" style="font-size: 48px;"></i>
                    <p id="successMessage" class="mt-3"></p>
                    <button type="button" class="btn btn-success mt-2" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="mdi mdi-alert-circle text-danger" style="font-size: 48px;"></i>
                    <p id="errorMessage" class="mt-3"></p>
                    <button type="button" class="btn btn-danger mt-2" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/pages/auth.js')

    <script src="{{ asset('asset/js/landing/crypto-js.min.js') }}"></script>
    <script src="{{ asset('asset/js/landing/aes.min.js') }}"></script>
    <script>
        $(document).foundation();
        var a = sessionStorage.getItem('my_session');
        var assignment = document.getElementById("user_type").value = a;
    </script>

    <script>
        document.querySelector('#loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear any existing error messages
            document.getElementById('error-message').style.display = 'none';
            
            // Reset OTP timer and states before new login attempt
            clearInterval(otpTimer);
            timeLeft = 120;
            const otpModal = document.getElementById('otpModal');
            if (otpModal) {
                const timerContainer = otpModal.querySelector('#otpTimer');
                if (timerContainer) timerContainer.style.display = 'none';
                const resendBtn = otpModal.querySelector('#resendOtpBtn');
                if (resendBtn) {
                    resendBtn.style.display = 'none';
                    resendBtn.disabled = false;
                    resendBtn.innerHTML = 'Resend OTP';
                }
                const otpMessage = otpModal.querySelector('#otpMessage');
                if (otpMessage) otpMessage.style.display = 'none';
                const otpInput = otpModal.querySelector('#otp');
                if (otpInput) {
                    otpInput.value = '';
                    otpInput.disabled = false;
                }
                const verifyBtn = otpModal.querySelector('#verifyOtp');
                if (verifyBtn) verifyBtn.style.display = 'none';
                const sendInitialOtp = otpModal.querySelector('#sendInitialOtp');
                if (sendInitialOtp) {
                    sendInitialOtp.style.display = 'block';
                    sendInitialOtp.disabled = false;
                }
            }

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

            // First validate credentials
            fetch('{{ route("admin.validate.credentials") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    encryptedIdentity: encId,
                    encryptedPassword: encPwd,
                    _token: document.querySelector('meta[name="csrf-token"]').content,
                    remember: document.getElementById('checkbox-signin').checked
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If credentials are valid, show OTP Modal
                    var otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
                    otpModal.show();
                } else {
                    // Show error message in red above username field
                    const errorDiv = document.getElementById('error-message');
                    errorDiv.textContent = data.message || 'Invalid credentials';
                    errorDiv.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error message in red above username field
                const errorDiv = document.getElementById('error-message');
                errorDiv.textContent = 'An error occurred. Please try again.';
                errorDiv.style.display = 'block';
            });
        });

        // Modified Send Initial OTP handler
        document.getElementById('sendInitialOtp').addEventListener('click', function() {
            this.disabled = true;
            const encIdField = document.getElementById("encryptedIdentity");
            const encPwdField = document.getElementById("encryptedPassword");
            
            fetch('{{ route("admin.resend.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    encryptedIdentity: encIdField.value,
                    encryptedPassword: encPwdField.value,
                    _token: document.querySelector('meta[name="csrf-token"]').content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const otpMessage = document.getElementById('otpMessage');
                    otpMessage.className = 'alert alert-success';
                    otpMessage.textContent = 'OTP sent successfully!';
                    otpMessage.style.display = 'block';
                    
                    // Show OTP input and enable it
                    const otpInputContainer = document.getElementById('otpInputContainer');
                    otpInputContainer.style.display = 'block';
                    const otpInput = document.getElementById('otp');
                    otpInput.disabled = false;
                    otpInput.value = '';
                    otpInput.focus();
                    
                    // Show timer and hide send button
                    document.getElementById('otpTimer').style.display = 'block';
                    this.style.display = 'none';
                    
                    // Start timer
                    timeLeft = 120;
                    startOtpTimer();
                } else {
                    // Show error message
                    const otpMessage = document.getElementById('otpMessage');
                    otpMessage.className = 'alert alert-danger';
                    otpMessage.textContent = data.message || 'Failed to send OTP';
                    otpMessage.style.display = 'block';
                    this.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const otpMessage = document.getElementById('otpMessage');
                otpMessage.className = 'alert alert-danger';
                otpMessage.textContent = 'An error occurred. Please try again.';
                otpMessage.style.display = 'block';
                this.disabled = false;
            });
        });

        // Modified Timer functionality
        function startOtpTimer() {
            const timerDisplay = document.getElementById('timer');
            const resendBtn = document.getElementById('resendOtpBtn');
            
            clearInterval(otpTimer);
            resendBtn.style.display = 'none';
            
            otpTimer = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                // Add warning class when timer reaches 30 seconds
                if (timeLeft <= 30) {
                    timerDisplay.classList.add('warning');
                } else {
                    timerDisplay.classList.remove('warning');
                }
                
                if (timeLeft <= 0) {
                    clearInterval(otpTimer);
                    resendBtn.style.display = 'block';
                    resendBtn.disabled = false;
                    resendBtn.innerHTML = 'Resend OTP'; // Reset button text
                    document.getElementById('otp').disabled = true;
                    document.getElementById('verifyOtp').style.display = 'none';
                }
                timeLeft--;
            }, 1000);
        }

        // Update OTP input handler
        document.getElementById('otp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            // Show/hide verify button based on length
            document.getElementById('verifyOtp').style.display = this.value.length === 6 ? 'block' : 'none';
        });

        // Reset modal state when closed
        document.getElementById('otpModal').addEventListener('hidden.bs.modal', function () {
            // Clear the timer
            clearInterval(otpTimer);
            timeLeft = 120;
            
            const otpInput = document.getElementById('otp');
            const otpMessage = document.getElementById('otpMessage');
            const resendBtn = document.getElementById('resendOtpBtn');
            const otpInputContainer = document.getElementById('otpInputContainer');
            const timerContainer = document.getElementById('otpTimer');
            const sendInitialOtp = document.getElementById('sendInitialOtp');
            
            // Reset all states
            if (otpInput) {
                otpInput.value = '';
                otpInput.disabled = true;
            }
            if (otpMessage) otpMessage.style.display = 'none';
            if (otpInputContainer) otpInputContainer.style.display = 'none';
            if (timerContainer) timerContainer.style.display = 'none';
            if (resendBtn) {
                resendBtn.style.display = 'none';
                resendBtn.disabled = false;
                resendBtn.innerHTML = 'Resend OTP';
            }
            if (sendInitialOtp) {
                sendInitialOtp.style.display = 'block';
                sendInitialOtp.disabled = false;
            }
            document.getElementById('verifyOtp').style.display = 'none';
        });

        // Add Verify OTP handler
        document.getElementById('verifyOtp').addEventListener('click', function() {
            const otpInput = document.getElementById('otp');
            const enteredOtp = otpInput.value.trim();
            const encIdField = document.getElementById("encryptedIdentity");
            const encPwdField = document.getElementById("encryptedPassword");

            // Disable verify button and show loading state
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Verifying...';

            fetch('{{ route("admin.verify.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    encryptedIdentity: encIdField.value,
                    encryptedPassword: encPwdField.value,
                    otp: enteredOtp,
                    _token: document.querySelector('meta[name="csrf-token"]').content,
                    remember: document.getElementById('checkbox-signin').checked
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Verify OTP Response:', data); // Debug log

                if (data.success) {
                    // Show success message
                    const otpMessage = document.getElementById('otpMessage');
                    otpMessage.className = 'alert alert-success';
                    otpMessage.textContent = 'OTP verified successfully!';
                    otpMessage.style.display = 'block';

                    // Redirect after a short delay
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    // Show error message
                    const otpMessage = document.getElementById('otpMessage');
                    otpMessage.className = 'alert alert-danger';
                    otpMessage.textContent = data.message || 'Invalid OTP';
                    otpMessage.style.display = 'block';

                    // Reset OTP input
                    otpInput.value = '';
                    otpInput.focus();

                    // Reset verify button
                    this.disabled = false;
                    this.innerHTML = 'Verify OTP';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const otpMessage = document.getElementById('otpMessage');
                otpMessage.className = 'alert alert-danger';
                otpMessage.textContent = 'An error occurred. Please try again.';
                otpMessage.style.display = 'block';

                // Reset verify button
                this.disabled = false;
                this.innerHTML = 'Verify OTP';
            });
        });

        // Add Resend OTP handler
        document.getElementById('resendOtpBtn').addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Resending...';
            
            const encIdField = document.getElementById("encryptedIdentity");
            const encPwdField = document.getElementById("encryptedPassword");
            
            fetch('{{ route("admin.resend.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    encryptedIdentity: encIdField.value,
                    encryptedPassword: encPwdField.value,
                    _token: document.querySelector('meta[name="csrf-token"]').content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const otpMessage = document.getElementById('otpMessage');
                    otpMessage.className = 'alert alert-success';
                    otpMessage.textContent = 'OTP resent successfully!';
                    otpMessage.style.display = 'block';
                    
                    // Reset and enable OTP input
                    const otpInput = document.getElementById('otp');
                    otpInput.value = '';
                    otpInput.disabled = false;
                    otpInput.focus();
                    
                    // Hide resend button and verify button
                    this.style.display = 'none';
                    document.getElementById('verifyOtp').style.display = 'none';
                    
                    // Reset and start timer
                    timeLeft = 120;
                    startOtpTimer();
                } else {
                    // Show error message
                    const otpMessage = document.getElementById('otpMessage');
                    otpMessage.className = 'alert alert-danger';
                    otpMessage.textContent = data.message || 'Failed to resend OTP';
                    otpMessage.style.display = 'block';
                    
                    // Reset button state
                    this.disabled = false;
                    this.innerHTML = 'Resend OTP';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const otpMessage = document.getElementById('otpMessage');
                otpMessage.className = 'alert alert-danger';
                otpMessage.textContent = 'An error occurred. Please try again.';
                otpMessage.style.display = 'block';
                
                // Reset button state
                this.disabled = false;
                this.innerHTML = 'Resend OTP';
            });
        });

        // Initialize variables for OTP timer
        let otpTimer;
        let timeLeft = 120; // 2 minutes

        document.addEventListener("DOMContentLoaded", function () {
            const togglePasswordButtons = document.querySelectorAll("#toggle-password");
            togglePasswordButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const inputGroup = this.closest('.input-group');
                    const passwordField = inputGroup.querySelector('input[type="password"], input[type="text"]');
                    const isPassword = passwordField.getAttribute("type") === "password";
                    passwordField.setAttribute("type", isPassword ? "text" : "password");
                    inputGroup.querySelector('.input-group-text').setAttribute("data-password", isPassword ? "false" : "true");
                });
            });
        });
    </script>

    <style>
        .modal-content {
            border-radius: 16px;
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        #otp {
            -webkit-text-security: disc;
            color: #6658dd;
            letter-spacing: 15px;
            font-size: 24px;
        }
        
        #otp::placeholder {
            color: #ccc;
            letter-spacing: 15px;
            font-size: 24px;
        }

        #otp:focus {
            border-color: #6658dd;
            box-shadow: 0 0 0 0.2rem rgba(102, 88, 221, 0.25);
        }

        .btn-primary:hover {
            background-color: #5546d9 !important;
        }

        .btn-warning:hover {
            background-color: #f6a933 !important;
        }

        /* Timer styles */
        #timer {
            color: #6658dd;
            transition: color 0.3s ease;
        }

        #timer.warning {
            color: #dc3545 !important;
            animation: pulse 1s infinite;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        #otpInputContainer {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

    </script>

</body>

</html>



