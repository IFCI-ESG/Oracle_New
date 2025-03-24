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
            <li class="d-none d-sm-inline-block">
                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                    <i class="ri-moon-line font-22 textcolor"></i>
                </div>
            </li>
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

            <li>
                <a href="#theme-settings-offcanvas" class="nav-link waves-effect waves-light"
                    data-bs-toggle="offcanvas">
                    <i class="fe-settings font-22"></i>
                </a>
            </li>
        </ul>
    </div>
</div>


<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center align-items-center"
                style="background-color: #0d0d6e; color: white; width: 100%;">
                <h5 class="modal-title" id="accountModalLabel" style="font-weight: bold; color: white;">
                    My Account
                </h5>

            </div>


            <div class="modal-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            
                @if (auth()->user()->password_changed == 1)
               <form method="POST" action="{{ Auth::guard('admin')->check() ? route('admin.new_admin.bank.updateAccount') : route('user.updateAccount') }}"  id="updateAccountForm" onsubmit="return confirmUpdate();" enctype="multipart/form-data">  
                    @csrf
                  

             
                    <div class="text-center mb-4">
                        <h3 class="font-weight-bold" style="color: #0d0d6e;">Hi {{ auth()->user()->contact_person }}
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
                   

                   
                    <div id="new_password_field" class="mb-4" style="display: none;">
                        <label for="new_password" class="form-label font-weight-bold" style="color: #333;">New
                            Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password"
                            style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="checkPasswordMatch();">
                    </div>

                    <div id="confirm_password_field" class="mb-4" style="display: none;">
                        <label for="confirm_password" class="form-label font-weight-bold"
                            style="color: #333;">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="checkPasswordMatch();">
                    </div>
                   

                    <div id="password_error" class="mb-4" style="display: none;">
                        <span style="color: red;">Password does not match</span>
                    </div>

                    <div id="send_otp_button" class="mb-4" style="display: none;">
                        <button type="button" class="btn btn-primary" onclick="showOtpField();">
                            Send OTP
                        </button>
                    </div>

                    <div id="otp_field" class="mb-4" style="display: none;">
                        <label for="otp" class="form-label font-weight-bold" style="color: #333;">Enter
                            OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp"
                            style="border-radius: 8px; border: 1px solid #ddd;">
                    </div>
 
                        <div class="d-flex justify-content-between align-items-center">

                        <button type="submit" class="btn btn-primary"
                            style="background-color: #0d0d6e; color: white; border-radius: 25px; padding: 10px 30px; font-weight: bold; transition: background-color 0.3s ease;">
                            Update
                        </button>

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"
                            style="border-radius: 25px; padding: 10px 30px; border: 1px solid #0d0d6e; font-weight: bold; transition: border 0.3s ease;">
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

                   
                    <div id="new_password_field" class="mb-4" style="display: none;">
                        <label for="new_password" class="form-label font-weight-bold" style="color: #333;">New
                            Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password"
                            style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="checkPasswordMatch();">
                    </div>

                    <div id="confirm_password_field" class="mb-4" style="display: none;">
                        <label for="confirm_password" class="form-label font-weight-bold"
                            style="color: #333;">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            style="border-radius: 8px; border: 1px solid #ddd;" onkeyup="checkPasswordMatch();">
                    </div>
                   

                    <div id="password_error" class="mb-4" style="display: none;">
                        <span style="color: red;">Password does not match</span>
                    </div>

                    <div id="send_otp_button" class="mb-4" style="display: none;">
                        <button type="button" class="btn btn-primary" onclick="showOtpField();">
                            Send OTP
                        </button>
                    </div>

                    <div id="otp_field" class="mb-4" style="display: none;">
                        <label for="otp" class="form-label font-weight-bold" style="color: #333;">Enter
                            OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp"
                            style="border-radius: 8px; border: 1px solid #ddd;">
                    </div>
 
 
                    

                    <div class="d-flex justify-content-between align-items-center">

                        <button type="submit" class="btn btn-primary"
                            style="background-color: #0d0d6e; color: white; border-radius: 25px; padding: 10px 30px; font-weight: bold; transition: background-color 0.3s ease;">
                            Update
                        </button>

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"
                            style="border-radius: 25px; padding: 10px 30px; border: 1px solid #0d0d6e; font-weight: bold; transition: border 0.3s ease;">
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
    document.addEventListener("DOMContentLoaded", function() {
        @if (session('force_password_change'))
            var myModal = new bootstrap.Modal(document.getElementById('accountModal'), {
                backdrop: 'static',
                keyboard: false
            });

            myModal.show();


            document.getElementById('accountModal').addEventListener('hidden.bs.modal', function(event) {
                if (!window.passwordChanged) {
                    event.preventDefault();
                    myModal.show();
                }
            });


            @if (session('password_changed') == 1)
                window.passwordChanged = true;
                myModal.hide();
            @endif


            window.setPasswordChanged = function() {
                window.passwordChanged = true;
                myModal.hide();
            };
        @endif
    });
</script>



<script>

window.onload = function() {
    // Call the function on page load to handle the checkbox and field visibility
    togglePasswordFields();
};
   
    function togglePasswordFields() {
        var resetPasswordChecked = document.getElementById('reset_password').checked;
        var otpField = document.getElementById('otp_field');
        var sendOtpButton = document.getElementById('send_otp_button');

        document.getElementById('new_password_field').style.display = resetPasswordChecked ? 'block' : 'none';
        document.getElementById('confirm_password_field').style.display = resetPasswordChecked ? 'block' : 'none';
        document.getElementById('password_error').style.display = 'none';


        sendOtpButton.style.display = resetPasswordChecked ? 'block' : 'none';
    }
    


    function showOtpField() {
        var otpField = document.getElementById('otp_field');
        otpField.style.display = 'block';
    }


    function checkPasswordMatch() {
        var newPasswordField = document.getElementById('new_password_field').style.display;
        if (newPasswordField === 'block') {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var errorMessage = document.getElementById('password_error');

            if (newPassword !== confirmPassword) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        }
    }

    function confirmUpdate() {

        var resetPasswordChecked = document.getElementById('reset_password').checked;
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var otp = document.getElementById('otp').value;


        if (resetPasswordChecked) {

            if (newPassword !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }


            if (otp === '') {
                alert("Please enter the OTP!");
                return false;
            }


            var validOtp = '987654';
            if (otp !== validOtp) {
                alert("Invalid OTP!");
                return false;
            }
        }


        return confirm("Are you sure you want to update the changes?");
    }
</script>
 
