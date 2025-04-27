<div class="navbar-custom">
    <div class="topbar tophead">
        <div class="topbar-menu d-flex align-items-center gap-1">

            <div class="logo-box">
                <a href="#" class="logo-light">
                    <img src="/images/logo/home-logo2.png" alt="logo" class="logo-lg">
                    <img src="/images/logo/home-logo2.png" alt="small logo" class="logo-sm">
                </a>
                <a href="#" class="logo-dark">
                    <img src="/images/logo/home-logo2.png" alt="dark logo" class="logo-lg">
                    <img src="/images/logo/home-logo2.png" alt="small logo" class="logo-sm">
                </a>
            </div>

            <button class="button-toggle-menu w-50">
                <i class="mdi mdi-menu"></i>
            </button>
           
           
            <li class=" d-none d-md-inline-block">
                <span style = "white-space: nowrap;overflow: hidden;  text-overflow: ellipsis; font-size: 1rem;color:black; font-weight: 500;" height="100"> {{ Auth()->user()->name }} </span>
            </li>
        </div>
 
        <ul class="topbar-menu d-flex align-items-center">

            <li class="d-none d-md-inline-block">
                <a class="nav-link waves-effect waves-light" href="" data-toggle="fullscreen">
                    <i class="fe-maximize font-22 textcolor"></i>
                </a>
             </li>
            {{-- <li class="d-none d-sm-inline-block">
                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                    <i class="ri-moon-line font-22 textcolor"></i>
                </div>
            </li> --}}
            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if (auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="user-image"
                            class="rounded-circle">
                    @else
                        <img src="/images/user-profile.jpg" alt="user-image" class="rounded-circle">
                    @endif
                    <span class="ms-1 d-none d-md-inline-block textcolor" id="user-name">{{ auth()->user()->contact_person }} <i
                            class="mdi mdi-chevron-down"></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown">

                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <a href="#" class="dropdown-item notify-item" data-bs-toggle="modal"
                        data-bs-target="#accountModal">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="javascript:void(0);" class="dropdown-item notify-item"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </div>
            </li>

            {{-- <li>
                <a href="#theme-settings-offcanvas" class="nav-link waves-effect waves-light"
                    data-bs-toggle="offcanvas">
                    <i class="fe-settings font-22"></i>
                </a>
            </li> --}}
        </ul>
    </div>
</div>


<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center align-items-center"
                style="background-color: #296243; color: white; width: 100%;">
                <h5 class="modal-title" id="accountModalLabel" style="font-weight: bold; color: white;">
                    Reset Your Password
                </h5>
            </div>

            <div class="modal-body">
                @if (auth()->user()->password_changed == 1)
                <form method="POST" action="{{ Auth::guard('admin')->check() ? route('admin.new_admin.bank.updateAccount') : route('user.updateAccount') }}"  id="updateAccountForm" onsubmit="return confirmUpdate();" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="generated_otp" name="generated_otp" value="">
                    <div class="text-center mb-4">
                        <h3 class="font-weight-bold" style="color: #0d0d6e;"> {{ auth()->user()->contact_person }}
                        </h3>
                        <p style="font-size: 1rem; color: #666;">Make sure all information is correct before submitting.
                        </p>
                    </div>
                
 


                    <div class="mb-4">
                        <label for="name" class="form-label font-weight-bold" style="color: #333;">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ auth()->user()->name }}" readonly
                            style="border-radius: 8px; border: 1px solid #ddd;">
                    </div>


                    <div class="mb-4">
                        <label for="email" class="form-label font-weight-bold" style="color: #333;">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ auth()->user()->email }}" style="border-radius: 8px; border: 1px solid #ddd;">
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label font-weight-bold" style="color: #333;">Upload Profile
                            Image</label>
                        <br />
                        <input type="file" name="image" id="image" accept="image/*">
                        <br />
                        <small style="color: green; font-size: 0.9em;">Only JPG, PNG, and JPEG are allowed (Max:
                            2MB)</small>
                    </div>
 
 

                    <div class="mb-4">
                        <input type="checkbox" id="reset_password" name="reset_password"
                            onclick="togglePasswordFields()">
                            
                        <label for="reset_password" class="form-label font-weight-bold" style="color: #333;">Reset
                            Password</label>
                    </div>
                   

                    <div id="password_section" style="display: none;">
                        <div class="mb-4">
                     <label for="new_password" class="form-label font-weight-bold" style="color: #333;">New Password</label>
                        <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="validatePasswords()">
                                <span class="input-group-text" style="cursor: pointer;" onclick="togglePasswordVisibility('new_password', this)">
                                    <i class="fas fa-eye"></i>
                        </span>
                         </div>
                    </div>

                        <div class="mb-4">
                        <label for="confirm_password" class="form-label font-weight-bold" style="color: #333;">Confirm Password</label>
                        <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="validatePasswords()">
                                <span class="input-group-text" style="cursor: pointer;" onclick="togglePasswordVisibility('confirm_password', this)">
                                    <i class="fas fa-eye"></i>
                            </span>
                         </div>
                     </div>

                        <div id="password_validation_message" class="mb-3" style="color: red; display: none; font-size: 0.875rem;"></div>

                        <div class="mb-4">
                            <button type="button" id="sendOtpBtn" class="btn btn-primary" onclick="handleOTPSend();" style="background-color: #296243; border-color: #296243; display: none;">
                            Send OTP
                        </button>
                    </div>

                    <div id="otp_field" class="mb-4" style="display: none;">
                            <label for="otp" class="form-label font-weight-bold" style="color: #333;">Enter OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" style="border-radius: 8px; border: 1px solid #ddd;">
                            <small class="text-muted">OTP has been sent to your email address</small>
                        </div>
                    </div>
 
                        <div class="d-flex justify-content-between align-items-center">

                        <button type="submit" class="btn btn-primary"
                            style="background-color: #296243; color: white; border-radius: 25px; padding: 10px 30px; font-weight: bold; transition: background-color 0.3s ease;">
                            Update
                        </button>

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"
                            style="border-radius: 25px; padding: 10px 30px; border: 1px solid #296243; font-weight: bold; transition: border 0.3s ease;">
                            Close
                        </button>
                    </div>
                </form>
               

                @elseif (auth()->user()->password_changed == 0)
               <form method="POST" action="{{ Auth::guard('admin')->check() ? route('admin.new_admin.bank.updateAccount') : route('user.updateAccount') }}"  id="updateAccountForm" onsubmit="return confirmUpdate();" enctype="multipart/form-data">  
                    @csrf

                    <div class="mb-4" style = "display:none;">
                     <input type="checkbox" id="reset_password" name="reset_password" onclick="togglePasswordFields()" checked>
                    <label for="reset_password" class="form-label font-weight-bold" style="color: #333;">Reset Password</label>
                    </div>

                    <div id="password_section" style="display: none;">
                        <div id="new_password_field" class="mb-4">
                     <label for="new_password" class="form-label font-weight-bold" style="color: #333;">New Password</label>
                        <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="validatePasswords()">
                        <span class="input-group-text" id="toggle-password" onclick="togglePasswordVisibility('new_password', 'toggle-password')">
                          <i class="fas fa-eye" id="password-icon"></i>
                        </span>
                         </div>
                    </div>

                        <div id="confirm_password_field" class="mb-4">
                        <label for="confirm_password" class="form-label font-weight-bold" style="color: #333;">Confirm Password</label>
                        <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="validatePasswords()">
                            <span class="input-group-text" id="toggle-confirm-password" onclick="togglePasswordVisibility('confirm_password', 'toggle-confirm-password')">
                             <i class="fas fa-eye" id="confirm-password-icon"></i>
                            </span>
                         </div>
                     </div>
                    </div>
                    <div id="password_validation_message" style="color: red; margin-top: 10px; display: none;"></div>

                    <div class="mb-4">
                        <button type="button" class="btn btn-primary" id="sendOtpBtn" onclick="handleOTPSend();" style="display: none; background-color: #296243; border-color: #296243;">
                            Send OTP
                        </button>
                    </div>

                    <div id="otp_field" class="mb-4" style="display: none;">
                        <label for="otp" class="form-label font-weight-bold" style="color: #333;">Enter OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" style="border-radius: 8px; border: 1px solid #ddd;">
                        <small class="text-muted">OTP has been sent to your email address</small>
                    </div>
 
 
                    

                    <div class="d-flex justify-content-between align-items-center">

                        <button type="submit" class="btn btn-primary"
                            style="background-color: #296243;border-color:#296243; color: white; border-radius: 25px; padding: 10px 30px; font-weight: bold; transition: background-color 0.3s ease;">
                            Update
                        </button>

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"
                            style="border-radius: 25px; padding: 10px 30px; border: 1px solid #296243; font-weight: bold; transition: border 0.3s ease;">
                            Close
                        </button>
                    </div>
                </form>
                @endif
                  
             


                <!-- <style>

    .form-control {
        background-color: #f9f9f9;
        font-size: 1rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 10px;
        transition: box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #0d0d6e;
        box-shadow: 0 0 8px rgba(13, 13, 110, 0.3);
    }

    .btn-primary:hover {
        background-color: #4b4d99;
    }

    .btn-light:hover {
        border-color: #4b4d99;
    }

    .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
    }
</style> -->



            </div>
        </div>
    </div>
</div>

<script>
 function togglePasswordVisibility(fieldId, iconElement) {
    var passwordField = document.getElementById(fieldId);
    var icon = iconElement.querySelector('i');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function handleOTPSend() {
    var sendOtpBtn = document.getElementById('sendOtpBtn');
    var originalText = sendOtpBtn.innerHTML;
    sendOtpBtn.disabled = true;
    sendOtpBtn.innerHTML = 'Sending...';

    // Generate OTP
    var otp = Math.floor(100000 + Math.random() * 900000).toString();
    
    // Send OTP via AJAX
    $.ajax({
        url: '{{ route("send.otp") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            otp: otp,
            email: '{{ auth()->user()->email }}'
        },
        success: function(response) {
            if (response.success) {
                // Store OTP in hidden field
                $('#generated_otp').val(otp);
                
                // Show OTP field and enable button
                document.getElementById('otp_field').style.display = 'block';
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerHTML = originalText;
                alert('OTP has been sent to your email address');
            } else {
                alert('Failed to send OTP. Please try again.');
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerHTML = originalText;
            }
        },
        error: function() {
            alert('An error occurred while sending OTP. Please try again.');
            sendOtpBtn.disabled = false;
            sendOtpBtn.innerHTML = originalText;
        }
    });
}

function validatePasswords() {
    var newPassword = document.getElementById('new_password').value;
    var confirmPassword = document.getElementById('confirm_password').value;
    var sendOtpBtn = document.getElementById('sendOtpBtn');
    var validationMessage = document.getElementById('password_validation_message');

    // Reset validation state
    validationMessage.style.display = 'none';
    validationMessage.textContent = '';
    sendOtpBtn.disabled = true;
    sendOtpBtn.style.opacity = '0.6';
    sendOtpBtn.style.cursor = 'not-allowed';

    // Skip validation if both fields are empty
    if (!newPassword && !confirmPassword) {
        return;
    }

    // Check if both fields have values
    if (!newPassword || !confirmPassword) {
        validationMessage.textContent = 'Please fill both password fields';
        validationMessage.style.display = 'block';
        return;
    }

    // Check if passwords match
    if (newPassword !== confirmPassword) {
        validationMessage.textContent = 'Passwords do not match';
        validationMessage.style.display = 'block';
        return;
    }

    // All validations passed
    sendOtpBtn.disabled = false;
    sendOtpBtn.style.opacity = '1';
    sendOtpBtn.style.cursor = 'pointer';
    sendOtpBtn.style.display = 'inline-block';
}
   
    function togglePasswordFields() {
        var resetPasswordChecked = document.getElementById('reset_password').checked;
    var passwordSection = document.getElementById('password_section');
    var sendOtpBtn = document.getElementById('sendOtpBtn');
    var newPassword = document.getElementById('new_password');
    var confirmPassword = document.getElementById('confirm_password');
    var validationMessage = document.getElementById('password_validation_message');
        var otpField = document.getElementById('otp_field');

    if (resetPasswordChecked) {
        passwordSection.style.display = 'block';
        sendOtpBtn.style.display = 'inline-block';
        sendOtpBtn.disabled = true;
        sendOtpBtn.style.opacity = '0.6';
        sendOtpBtn.style.cursor = 'not-allowed';
        validationMessage.style.display = 'none';
        otpField.style.display = 'none';
            } else {
        passwordSection.style.display = 'none';
        newPassword.value = '';
        confirmPassword.value = '';
        validationMessage.style.display = 'none';
        otpField.style.display = 'none';
        }
    }

    function confirmUpdate() {
        var resetPasswordChecked = document.getElementById('reset_password').checked;

    if (resetPasswordChecked) {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var otp = document.getElementById('otp').value;
        var generatedOtp = document.getElementById('generated_otp').value;

        if (!newPassword || !confirmPassword) {
            alert("Please fill both password fields!");
            return false;
        }
            
        if (newPassword !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }

        if (!otp) {
            alert("Please enter the OTP!");
            return false;
        }

        // Check against both static and generated OTP
        var staticOtp = '987654';
        if (otp !== staticOtp && otp !== generatedOtp) {
            alert("Invalid OTP!");
            return false;
        }

        return confirm("Are you sure you want to update the password?");
    }

    return confirm("Are you sure you want to update the changes?");
}
</script>
 
<style>
.input-group-text {
    cursor: pointer;
    user-select: none;
}

.input-group-text:hover {
    background-color: #e9ecef;
}

#password_validation_message {
    margin-top: 0.5rem;
    font-size: 0.875rem;
}

#sendOtpBtn {
    transition: all 0.3s ease;
}

#sendOtpBtn:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}

.text-muted {
    color: #6c757d;
    font-size: 0.875rem;
}
</style>

@php
use Illuminate\Support\Facades\Mail;

function sendOTPEmail($email, $otp) {
    try {
        $data = [
            'otp' => $otp,
            'email' => $email
        ];
        
        Mail::send([], $data, function($message) use ($email, $otp) {
            $message->to($email)
                ->subject('Password Reset OTP - ESG Portal')
                ->html("
                    <div style='font-family: Arial, sans-serif;'>
                        <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                            <div style='background-color: #296243; color: white; padding: 20px; text-align: center;'>
                                <h2 style='margin: 0;'>Password Reset OTP</h2>
                            </div>
                            <div style='padding: 20px; border: 1px solid #ddd;'>
                                <p>Dear User,</p>
                                <p>You have requested to reset your password. Please use the following OTP to proceed:</p>
                                <div style='background-color: #f8f9fa; padding: 15px; text-align: center; margin: 20px 0;'>
                                    <h1 style='margin: 0; color: #296243; letter-spacing: 5px;'>" . $otp . "</h1>
                                </div>
                                <p>This OTP will expire in 10 minutes.</p>
                                <p>If you did not request this password reset, please ignore this email.</p>
                                <p style='margin-top: 30px;'>Best regards,<br>ESG Portal Team</p>
                            </div>
                        </div>
                    </div>
                ");
        });
        
        return true;
    } catch (\Exception $e) {
        \Log::error('OTP Email Error: ' . $e->getMessage());
        return false;
    }
}
@endphp

@if(request()->isMethod('post') && request('action') == 'send_otp')
    @php
    $success = sendOTPEmail(request('email'), request('otp'));
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
    @endphp
@endif
 