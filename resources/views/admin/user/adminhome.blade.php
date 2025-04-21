@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])
@section('css')
    @vite('node_modules/dropify/dist/css/dropify.min.css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'
    ])
    <style>
        .profile-wrapper {
            padding: 15px 0;
            height: calc(100vh - 120px);
            display: flex;
            flex-direction: column;
        }
        .profile-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0,0,0,0.07);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .profile-banner {
            position: relative;
            background: linear-gradient(60deg, #2EC9B1 0%, #1A7D64 100%);
            height: 130px;
            overflow: hidden;
        }
        .banner-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .profile-main {
            position: relative;
            z-index: 10;
            display: flex;
            margin-top: -55px;
            padding: 0 30px;
        }
        .profile-image {
            flex-shrink: 0;
            margin-right: 20px;
        }
        .profile-photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background: white;
            object-fit: contain;
        }
        .profile-info {
            padding-top: 60px;
            flex-grow: 1;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .profile-identity h2 {
            margin: 0 0 5px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }
        .profile-identity p {
            color: #666;
            margin: 0;
            font-size: 15px;
        }
        .edit-button {
            background: #2EC9B1;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 3px 10px rgba(46, 201, 177, 0.2);
        }
        .edit-button:hover {
            transform: translateY(-2px);
            background: #1A7D64;
            box-shadow: 0 6px 15px rgba(46, 201, 177, 0.3);
        }
        .profile-content {
            flex-grow: 1;
            padding: 20px 30px 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            align-content: start;
        }
        .info-card {
            background: #f8f9fa;
            padding: 16px;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }
        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #2EC9B1;
        }
        .services-card {
            grid-column: span 3;
            background: linear-gradient(to right, #f8f9fa, #fff);
            padding: 20px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
            border-left: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }
        .services-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .services-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .services-icon {
            background: #2EC9B1;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            box-shadow: 0 4px 10px rgba(46, 201, 177, 0.3);
        }
        .services-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .services-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
            max-height: 180px;
            overflow-y: auto;
            padding-right: 5px;
        }
        .services-list::-webkit-scrollbar {
            width: 6px;
        }
        .services-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .services-list::-webkit-scrollbar-thumb {
            background: #2EC9B1;
            border-radius: 3px;
        }
        .services-list::-webkit-scrollbar-thumb:hover {
            background: #1A7D64;
        }
        .service-item {
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #444;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            transition: all 0.2s;
            border-left: 3px solid #2EC9B1;
            margin: 0;
        }
        .service-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background: #f8f9fa;
        }
        .service-item i {
            color: #2EC9B1;
            margin-right: 8px;
            font-size: 14px;
            flex-shrink: 0;
        }
        .service-item span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .services-count {
            background: #e8f7f4;
            color: #2EC9B1;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }
        .info-label {
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 6px;
        }
        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            word-break: break-word;
        }
        .alert {
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            animation: fadeInDown 0.5s ease-out;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }
        
        /* Validation styles */
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
            display: none;
        }
        
        .is-invalid {
            border-color: #dc3545 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .is-valid {
            border-color: #198754 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        /* Additional CSS to ensure error messages are visible */
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
            display: none;
        }
        
        /* Force error message visibility */
        .force-visible {
            display: block !important;
        }
    </style>
@endsection

@section('content')
 
@if (session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert" id="successAlert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
             {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert" id="failAlert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
 @endif
 
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Start Content-->
    <div class="container-fluid profile-wrapper">
        <div class="profile-container">
            <!-- Banner Section -->
            <div class="profile-banner">
                <div class="banner-pattern"></div>
            </div>
            
            <!-- Main Profile Section -->
            <div class="profile-main">
                <div class="profile-image">
                    @php
                        $imagePath = auth()->user()->image;
                    @endphp
                    
                    @if ($imagePath)
                        <img src="{{ asset('storage/' . $imagePath) }}" alt="User Profile" class="profile-photo">
                    @else
                        <img src="{{ asset('assets-v1/img/profile-pic/bank-profile-img.png') }}" alt="User Profile" class="profile-photo">
                    @endif
                </div>
                
                <div class="profile-info">
                    <div class="profile-identity">
                        <h2>{{ $users->name ?? auth()->user()->name }}</h2>
                        <p>{{ $users->designation ?? 'Senior Software Developer' }}</p>
                    </div>
                    
                    @if (isset($users))
                    <button class="edit-button" data-toggle="modal" data-target="#editProfileModal" onclick="setEditId({{ $users->id }})">
                        <i class="fa fa-edit me-1"></i> Edit Profile
                    </button>
                    @endif
                </div>
            </div>
            
            <!-- Profile Content -->
            <div class="profile-content">
                <div class="info-card">
                    <div class="info-label">IFSC Code</div>
                    <div class="info-value">{{ $users->ifsc_code ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">PAN</div>
                    <div class="info-value">{{ $users->pan ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Contact Person</div>
                    <div class="info-value">{{ $users->contact_person ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $users->email ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Mobile</div>
                    <div class="info-value">{{ $users->mobile ?? 'NA' }}</div>
                </div>
                
                @if (Auth::user()->hasRole('Admin'))
                <div class="services-card">
                    <div class="services-header">
                        <div class="services-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h4 class="services-title">
                            ESG Services
                            @php
                                $services = isset($servicesString) ? explode(', ', $servicesString) : [];
                                $serviceCount = count($services);
                            @endphp
                            <span class="services-count">{{ $serviceCount }} Service{{ $serviceCount != 1 ? 's' : '' }}</span>
                        </h4>
                    </div>
                    
                    <div class="services-list">
                        @if($serviceCount > 0)
                            @foreach($services as $service)
                                <div class="service-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $service }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="service-item">
                                <i class="fas fa-info-circle"></i>
                                <span>No services selected</span>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
   <!-- Modal for Editing Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModal">Update Profile</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ route('admin.user.dataupdate') }}" novalidate>
                        @csrf
                        <input type="hidden" name="id" id="editId" value="{{ isset($users) ? $users->id : '' }}">
                        
                        <!-- Existing fields for IFSC code and name -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="ifsc_code" style="color:black;">IFSC Code</label>
                                <div class="position-relative">
                                    <input type="text" name="ifsc_code" class="form-control" id="ifsc_code" 
                                        value="{{ isset($users) ? $users->ifsc_code : 'NA' }}" required readonly
                                        style="border-radius: 8px; border: 1px solid #ddd; padding-right: 2.5rem;">
                                    <i class="fas fa-lock position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); color: #888;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" style="color:black;">Name</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control" id="name" 
                                        value="{{ isset($users) ? $users->name : 'NA' }}" required readonly
                                        style="border-radius: 8px; border: 1px solid #ddd; padding-right: 2.5rem;">
                                    <i class="fas fa-lock position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); color: #888;"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email field with inline validation  -->
                        <div class="row">
                            <div class="col-md-12 mb-3" style="position: relative;">
                                <label for="email_field" style="color:black;">Email</label>
                                <input type="text" name="email" class="form-control" id="email_field" value="{{ isset($users) ? $users->email : 'NA'}}" required style="border-radius: 8px;" oninput="validateEmailField()" onblur="validateEmailField()">
                                <div id="emailErrorMsg" style="color: #dc3545; font-size: 12px; margin-top: 5px; font-weight: 500; display: none; width: 100%;">
                                    Please enter a valid email address
                                </div>
                            </div>
                        </div>

                        <!-- Place this script immediately after the email field -->
                        <script type="text/javascript">
                        // Simple email validation function that directly manipulates the DOM
                        function validateEmailField() {
                            // Get elements without using jQuery
                            var emailInput = document.getElementById('email_field');
                            var errorElement = document.getElementById('emailErrorMsg');
                            
                            if (!emailInput || !errorElement) return false;
                            
                            var email = emailInput.value;
                            
                            // Basic email validation
                            var isValid = email && email !== 'NA' && email.includes('@') && email.includes('.') && email.indexOf('@') < email.lastIndexOf('.');
                            
                            // Update UI directly
                            if (isValid) {
                                emailInput.style.borderColor = '#198754';
                                errorElement.style.display = 'none';
                            } else {
                                emailInput.style.borderColor = '#dc3545';
                                errorElement.style.display = 'block';
                            }
                            
                            return isValid;
                        }

                        // Clear NA value and validate immediately
                        (function() {
                            var emailField = document.getElementById('email_field');
                            if (emailField && emailField.value === 'NA') {
                                emailField.value = '';
                            }
                            setTimeout(validateEmailField, 100);
                        })();

                        // Attach to form submission
                        document.addEventListener('DOMContentLoaded', function() {
                            var form = document.getElementById('editForm');
                            if (form) {
                                form.addEventListener('submit', function(e) {
                                    if (!validateEmailField()) {
                                        e.preventDefault();
                                        return false;
                                    }
                                });
                            }
                            
                            // Also handle modal shown
                            if (typeof $ !== 'undefined') {
                                $('#editProfileModal').on('shown.bs.modal', function() {
                                    setTimeout(validateEmailField, 100);
                                });
                            }
                        });
                        </script>

                        <!-- Mobile and PAN fields with validation -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mobile" style="color:black;">Mobile</label>
                                <input type="text" name="mobile" class="form-control" id="mobile" value="{{ isset($users) ? $users->mobile : 'NA' }}" required>
                                <div class="error-message" id="mobile-error">Please enter a valid 10-digit mobile number</div>
                            </div>

                            @if (Auth::user()->hasRole('Admin'))
                            <div class="col-md-6 mb-3">
                                <label for="pan" style="color:black;">PAN</label>
                                <input type="text" name="pan" class="form-control" id="pan" value="{{ isset($users) ? $users->pan : 'NA' }}" required>
                                <div class="error-message" id="pan-error">Please enter a valid PAN number (e.g., ABCDE1234F)</div>
                            </div>
                            @else 
                            <div class="col-md-6 mb-3">
                                <label for="pan" style="color:black;">PAN</label>
                                <input type="text" name="pan" class="form-control" id="pan" value="{{ isset($users) ? $users->pan : 'NA' }}">
                                <div class="error-message" id="pan-error">Please enter a valid PAN number (e.g., ABCDE1234F)</div>
                            </div>
                            @endif
                        </div>
                             
                        <!-- Contact Person and Designation fields with validation -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_person" style="color:black;">Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ isset($users) ? $users->contact_person : 'NA' }}" required>
                                <div class="error-message" id="contact-person-error">Please enter a valid name (min 3 characters)</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="designation" style="color:black;">Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation" value="{{ isset($users) ? $users->designation : 'NA' }}" required>
                                <div class="error-message" id="designation-error">Please enter a valid designation (min 2 characters)</div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success" id="updateButton">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function setEditId(userId) {
        document.getElementById('editId').value = userId;
    }
    </script>

    <script>
        setTimeout(function() {
            var alert = document.getElementById('successAlert');
            if (alert) {
                var closeButton = alert.querySelector('.btn-close');
                closeButton.click();  
            }
        }, 2000);  
    </script>
    <script>
        setTimeout(function() {
            var alert = document.getElementById('failAlert');
            if (alert) {
                var closeButton = alert.querySelector('.btn-close');
                closeButton.click();  
            }
        }, 2000);  
    </script>
    
    <!-- Form Validation Script -->
    <script>
        $(document).ready(function() {
            // Initialize form validation
            let formValid = false;
            
            // Function to clear NA values from fields
            function clearNAValues() {
                if($('#email_field').val() === 'NA') {
                    $('#email_field').val('');
                }
                if($('#mobile').val() === 'NA') {
                    $('#mobile').val('');
                }
                if($('#pan').val() === 'NA') {
                    $('#pan').val('');
                }
                if($('#contact_person').val() === 'NA') {
                    $('#contact_person').val('');
                }
                if($('#designation').val() === 'NA') {
                    $('#designation').val('');
                }
            }
            
            // Call immediately to clear any NA values on page load
            clearNAValues();
            
            // Validation functions
            function validateEmail() {
                // Get elements without using jQuery
                var email = document.getElementById('email_field').value;
                var errorElement = document.getElementById('emailErrorMsg');
                
                // Basic email validation
                var isValid = email && email !== 'NA' && email.includes('@') && email.includes('.') && email.indexOf('@') < email.lastIndexOf('.');
                
                // Update UI directly
                if (isValid) {
                    document.getElementById('email_field').style.borderColor = '#198754';
                    errorElement.style.display = 'none';
                } else {
                    document.getElementById('email_field').style.borderColor = '#dc3545';
                    errorElement.style.display = 'block';
                }
                
                return isValid;
            }
            
            function validateMobile(mobile) {
                // Validate exactly 10-digit mobile number
                const mobileRegex = /^[0-9]{10}$/;
                return mobileRegex.test(mobile);
            }
            
            function validatePAN(pan) {
                // Validate PAN format (5 letters, 4 numbers, 1 letter)
                const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
                return panRegex.test(pan);
            }
            
            function validateContactPerson(name) {
                // Validate name (minimum 3 characters, letters and spaces only)
                const nameRegex = /^[A-Za-z\s]{3,}$/;
                return nameRegex.test(name);
            }
            
            function validateDesignation(designation) {
                // Validate designation (minimum 2 characters)
                return designation.trim().length >= 2;
            }
            
            // Update field validation status
            function updateFieldStatus(field, isValid, errorElement) {
                console.log('Updating field status:', field.id, 'isValid:', isValid);
                
                if (isValid) {
                    $(field).removeClass('is-invalid').addClass('is-valid');
                    $(errorElement).hide();
                } else {
                    $(field).removeClass('is-valid').addClass('is-invalid');
                    $(errorElement).show();
                    console.log('Showing error for', field.id);
                }
            }
            
            // Validate all fields and update form validity
            function validateForm() {
                // Force validation for email
                const emailField = $('#email_field');
                const emailValue = emailField.val();
                const emailValid = validateEmail();
                updateFieldStatus(emailField, emailValid, '#emailErrorMsg');
                
                const mobileValid = validateMobile($('#mobile').val());
                updateFieldStatus('#mobile', mobileValid, '#mobile-error');
                
                let panValid = true;
                if ($('#pan').prop('required')) {
                    panValid = validatePAN($('#pan').val());
                    updateFieldStatus('#pan', panValid, '#pan-error');
                }
                
                const contactPersonValid = validateContactPerson($('#contact_person').val());
                updateFieldStatus('#contact_person', contactPersonValid, '#contact-person-error');
                
                const designationValid = validateDesignation($('#designation').val());
                updateFieldStatus('#designation', designationValid, '#designation-error');
                
                // Update overall form validity
                formValid = emailValid && mobileValid && panValid && contactPersonValid && designationValid;
                
                return formValid;
            }
            
            // Immediately validate the form on page load
            validateForm();
            
            // Event listeners for real-time validation
            $('#email_field').on('input blur change keyup', function() {
                console.log('Email input event triggered with value:', $(this).val());
                const isValid = validateEmail();
                updateFieldStatus(this, isValid, '#emailErrorMsg');
            });
            
            $('#mobile').on('input', function() {
                const isValid = validateMobile($(this).val());
                updateFieldStatus(this, isValid, '#mobile-error');
            });
            
            $('#pan').on('input', function() {
                if ($(this).prop('required')) {
                    const isValid = validatePAN($(this).val());
                    updateFieldStatus(this, isValid, '#pan-error');
                }
            });
            
            $('#contact_person').on('input', function() {
                const isValid = validateContactPerson($(this).val());
                updateFieldStatus(this, isValid, '#contact-person-error');
            });
            
            $('#designation').on('input', function() {
                const isValid = validateDesignation($(this).val());
                updateFieldStatus(this, isValid, '#designation-error');
            });
            
            // Form submission handler
            $('#editForm').on('submit', function(e) {
                // Force validation before submission
                if (!validateForm()) {
                    e.preventDefault(); // Prevent form submission if validation fails
                }
            });
            
            // Additional validation when the modal is shown
            $('#editProfileModal').on('shown.bs.modal', function() {
                clearNAValues();
                validateForm();
            });
            
            // Function to force validation for a specific field
            function forceValidateField(fieldId, errorId) {
                const field = $(fieldId);
                const value = field.val();
                let isValid = false;
                
                switch(fieldId) {
                    case '#email_field':
                        isValid = validateEmail();
                        break;
                    case '#mobile':
                        isValid = validateMobile(value);
                        break;
                    case '#pan':
                        if (field.prop('required')) {
                            isValid = validatePAN(value);
                        } else {
                            isValid = true;
                        }
                        break;
                    case '#contact_person':
                        isValid = validateContactPerson(value);
                        break;
                    case '#designation':
                        isValid = validateDesignation(value);
                        break;
                }
                
                if (!isValid) {
                    field.removeClass('is-valid').addClass('is-invalid');
                    $(errorId).addClass('force-visible');
                } else {
                    field.removeClass('is-invalid').addClass('is-valid');
                    $(errorId).removeClass('force-visible');
                }
                
                return isValid;
            }
            
            // Run immediately and force validation for email
            setTimeout(function() {
                forceValidateField('#email_field', '#emailErrorMsg');
                
                // Explicitly set focus on the email field and then blur it to trigger validation
                $('#email_field').focus().blur();
            }, 500);
            
            // Add additional event for email validation on modal open
            $('#editProfileModal').on('shown.bs.modal', function() {
                setTimeout(function() {
                    forceValidateField('#email_field', '#emailErrorMsg');
                }, 300);
            });
        });
    </script>

    <!-- EMERGENCY EMAIL VALIDATION SCRIPT -->
    <script type="text/javascript">
    // Add this script to top of page to ensure it runs early
    window.addEventListener('load', function() {
        // EMERGENCY EMAIL VALIDATION
        
        // Get the elements
        var emailInput = document.getElementById('email_field');
        var errorDiv = document.getElementById('emailErrorMsg');
        var submitButton = document.querySelector('#editForm button[type="submit"]');
        
        // Function to check email format
        function isValidEmailFormat(email) {
            if (!email || email === '' || email === 'NA') return false;
            // Basic email validation pattern
            return /\S+@\S+\.\S+/.test(email);
        }
        
        // Function to check email and show/hide error
        function checkEmailValidation() {
            var emailValue = emailInput.value;
            if (!isValidEmailFormat(emailValue)) {
                // Invalid email - show error
                errorDiv.style.display = 'block';
                emailInput.style.borderColor = '#dc3545';
                return false;
            } else {
                // Valid email - hide error
                errorDiv.style.display = 'none';
                emailInput.style.borderColor = '#198754';
                return true;
            }
        }
        
        // Check immediately if there's a value
        if (emailInput.value === 'NA') {
            emailInput.value = '';
        }
        checkEmailValidation();
        
        // Add event listeners for real-time validation
        emailInput.addEventListener('input', checkEmailValidation);
        emailInput.addEventListener('blur', checkEmailValidation);
        
        // Prevent form submission if email is invalid
        document.getElementById('editForm').addEventListener('submit', function(event) {
            if (!checkEmailValidation()) {
                event.preventDefault();
                return false;
            }
        });
        
        // For Bootstrap modal
        var modalElement = document.getElementById('editProfileModal');
        if (modalElement) {
            modalElement.addEventListener('shown.bs.modal', function() {
                if (emailInput.value === 'NA') {
                    emailInput.value = '';
                }
                setTimeout(checkEmailValidation, 100);
            });
        }
    });
    </script>

    <!-- Put this at the very top of the page to catch the earliest possible load event -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Wait for a bit to make sure everything is loaded
        setTimeout(function() {
            var emailInput = document.getElementById('email_field');
            var errorDiv = document.getElementById('emailErrorMsg');
            
            if (emailInput && errorDiv) {
                // Force visibility if email is invalid
                var emailValue = emailInput.value;
                if (!emailValue || emailValue === 'NA' || !/\S+@\S+\.\S+/.test(emailValue)) {
                    errorDiv.style.display = 'block';
                    emailInput.style.borderColor = '#dc3545';
                }
            }
        }, 500);
    });
    </script>

    <script>
    // Global function for HTML attributes
    function validateEmailField() {
        var email = document.getElementById('email_field').value;
        var errorDiv = document.getElementById('emailErrorMsg');
        
        if (!email || email === 'NA' || !email.includes('@') || !email.includes('.')) {
            // Invalid email
            errorDiv.style.display = 'block';
            document.getElementById('email_field').style.borderColor = '#dc3545';
            return false;
        } else {
            // Valid email
            errorDiv.style.display = 'none';
            document.getElementById('email_field').style.borderColor = '#198754';
            return true;
        }
    }

    // Run validation immediately
    setTimeout(validateEmailField, 100);
    </script>

    <script>
    // Completely standalone validation function for email
    function directEmailValidation() {
        var emailInput = document.getElementById('email_field');
        var errorMessage = document.getElementById('emailErrorMsg');
        
        if (!emailInput || !errorMessage) return;
        
        var email = emailInput.value;
        var emailPattern = /\S+@\S+\.\S+/;
        var isValid = emailPattern.test(email) && email !== 'NA';
        
        if (isValid) {
            // Valid email
            errorMessage.style.display = 'none';
            emailInput.style.borderColor = '#198754';
        } else {
            // Invalid email
            errorMessage.style.display = 'block'; 
            emailInput.style.borderColor = '#dc3545';
        }
    }

    // Run immediately and also when modal shows
    window.addEventListener('load', function() {
        directEmailValidation();
        
        // Also handle when modal is shown
        var modal = document.getElementById('editProfileModal');
        if (modal) {
            modal.addEventListener('shown.bs.modal', function() {
                // Clear NA value if present
                var emailInput = document.getElementById('email_field');
                if (emailInput && emailInput.value === 'NA') {
                    emailInput.value = '';
                }
                
                // Run validation
                setTimeout(directEmailValidation, 100);
            });
        }
        
        // Prevent form submission if email invalid
        var form = document.getElementById('editForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                var emailInput = document.getElementById('email_field');
                var emailPattern = /\S+@\S+\.\S+/;
                
                if (!emailPattern.test(emailInput.value)) {
                    e.preventDefault();
                    directEmailValidation();
                    return false;
                }
            });
        }
    });

    // Force validation whenever email is in focus or loses focus
    document.addEventListener('DOMContentLoaded', function() {
        var emailInput = document.getElementById('email_field');
        if (emailInput) {
            emailInput.addEventListener('focus', directEmailValidation);
            emailInput.addEventListener('blur', directEmailValidation);
        }
    });
    </script>

@endsection


