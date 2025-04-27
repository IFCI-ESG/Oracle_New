@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
    <style>
        /* Light placeholder color for all input fields */
        input::placeholder {
            color: #d3d3d3 !important;
        }
    </style>
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.bank_branch.store') }}" id="branchDetails_create" role="form"
                    method="post" onsubmit="return validateForm()" class='prevent_multiple_submit' files=true
                    enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card mt-4">
                        <div class="card card-success card-outline shadow textcolor p-2">
                            <b>Branch Details</b>
                        </div>
                        <div class="card border-primary">
                            <div class="card-body">
                                <table class="table table-sm table-striped table-bordered table-hover">
                                    <tbody>
                                        <thead class="tablebgcolor">
                                            <th class="text-center textcolor" style="width: 5%">Sr.No.</th>
                                            <th class="text-center textcolor" style="width: 60%">Particulars</th>
                                            <th class="text-center textcolor" style="width: 35%">Value</th>
                                        </thead>

                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem"> 1. </th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">
                                                IFSC Code <span style="color: red;">*</span>
                                            </th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="ifsc_code" name="ifsc_code"
                                                    class="form-control " 
                                                    oninput="validateIFSC()" placeholder="ABCD0123456"   value="{{ old('ifsc_code') }}"  required />
                                                <div id="ifsc-error-message"
                                                    style="color: red; display: none; font-size: 0.9rem;"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">2. </th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">Branch Name <span style="color: red;">*</span>
                                            </th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="branch_name" name="branch_name"
                                                    class="form-control "  value="{{ old('branch_name') }}"
                                                    readonly required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">3. </th>
                                            <th  class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">MICR <span style="color: red;">*</span></th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="micr_code" name="micr_code"
                                                    class="form-control "   value="{{ old('micr_code') }}"
                                                    readonly required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">4. </th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">Address <span style="color: red;">*</span></th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="full_address" name="full_address"
                                                    class="form-control "   value="{{ old('full_address') }}"
                                                    readonly required />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">5.</th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">Pincode <span style="color: red;">*</span></th>
                                            <td class="shadow-none textcolor">
                                                <input type="number" id="pincode" name="pincode"
                                                    class="form-control " 
                                                    oninput="fetchLocationDetails()" placeholder="Enter Pincode"  value="{{ old('pincode') }}" required
                                                    minlength="6" maxlength="6" />
                                                <span
                                                    style="color: #262626; font-size: 0.8rem; display: block; margin-top: 5px;">(Please
                                                    enter a valid 6-digit Pincode)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem"> 6. </th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">
                                                State <span style="color: red;">*</span>
                                            </th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="state" name="state"
                                                    class="form-control "   value="{{ old('state') }}"
                                                     readonly required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem"> 7. </th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">
                                                District <span style="color: red;">*</span>
                                            </th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="district" name="district"
                                                    class="form-control "   value="{{ old('district') }}"
                                                    readonly required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">8.</th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">Email <span style="color: red;">*</span></th>
                                            <td class="shadow-none textcolor">
                                                <input type="email" id="email" name="email"
                                                    class="form-control " 
                                                    placeholder="example@domain.com"   value="{{ old('email') }}" required />
                                                <div id="email-error-message"
                                                    style="color: red; display: none; font-size: 0.9rem;"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">9.</th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">Contact Person <span
                                                    style="color: red;">*</span>
                                            </th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="contact_person" name="contact_person"
                                                    class="form-control " 
                                                    placeholder="Enter Contact Person"  value="{{ old('contact_person') }}" required />
                                                <div id="contact_person-error-message" style="color: red; display: none; font-size: 0.9rem;"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">10.</th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">Designation <span style="color: red;">*</span>
                                            </th>
                                            <td class="shadow-none textcolor">
                                                <input type="text" id="designation" name="designation"
                                                    class="form-control "  value="{{ old('designation') }}"
                                                    placeholder="Enter Designation" />
                                                <div id="designation-error-message" style="color: red; display: none; font-size: 0.9rem;"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">11.</th>
                                            <th class="text-center align-middle shadow-none textcolor" style="font-size: 0.9rem">Mobile <span style="color: red;">*</span> </th>
                                            <td class="shadow-none textcolor">
                                                <div style="display: flex; align-items: center;">
                                                    <span style="margin-right: 5px;">+91</span>
                                                    <input type="tel" id="mobile" name="mobile"
                                                        class="form-control form-control-sm text-right" style="width:50%" 
                                                        oninput="restrictMobileInput(event)" onblur="validateMobileNumber('mobile')" maxlength="10"
                                                        placeholder="Enter 10 digit mobile number" value="{{ old('mobile') }}" required />
                                                </div>
                                                <span style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">
                                                    (Please enter a valid 10-digit Mobile Number)
                                                </span>
                                                <div id="mobile-error-message" style="color: red; display: none; font-size: 0.9rem;"></div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                                  <div class="row  mb-3" >
                        <div class="col-md-2 offset-md-0">
                            <a href="{{ route('admin.bank_branch.index') }}"
                                class="btn btn-secondary btn-sm form-control form-control-sm p-1 activebtnbg">
                                <em class="fas fa-arrow-left"></em> Back
                            </a>
                        </div>
                        <div class="col-md-2 offset-md-8">
                            <button type="submit" id="submit"
                                class="btn btn-primary btn-sm form-control form-control-sm p-1 activebtnbg"  >
                                <em class="fas fa-save"></em> Save As Draft
                            </button>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateIFSC() {
            let ifscCode = document.getElementById("ifsc_code").value.trim();
            
            let ifscPattern = /^[A-Z]{4}0[A-Z0-9]{6}$/;
            let errorMessage = document.getElementById("ifsc-error-message");
            let branchNameField = document.getElementById("branch_name");
            let micrField = document.getElementById("micr_code");
            let fullAddressField = document.getElementById("full_address");


            let userBankName = "{{ auth()->user()->name }}";
            let userBankCode = "{{ auth()->user()->bank_code }}";


            if (!ifscPattern.test(ifscCode)) {
                errorMessage.innerText = "Invalid IFSC format.";
                errorMessage.style.display = "block";
                branchNameField.value = "";
                micrField.value = "";
                fullAddressField.value = "";
                return;
            } else {
                errorMessage.style.display = "none";
            }

            fetch(`https://ifsc.razorpay.com/${ifscCode}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Invalid IFSC Code");
                    }
                    return response.json();
                })
                .then(data => {
                    
                    let branchName = data.BRANCH || "Branch not found";
                    let micr = data.MICR || "MICR not available";
                    let address = data.ADDRESS || "Address not available";
                    let bankName = data.BANK || "";
                    let bankCode = data.BANKCODE || "";

                     if(bankCode !== userBankCode) {
                         errorMessage.innerText = `IFSC Code does not belong to your bank (${userBankName}).`;
                         errorMessage.style.display = "block";
                         branchNameField.value = "";
                         micrField.value = "";
                         fullAddressField.value = "";
                         return;
                        }
                         
                        branchNameField.value = branchName;
                        micrField.value = micr;
                        fullAddressField.value = address;
                     })
                .catch(error => {
                    errorMessage.innerText = "Invalid IFSC Code or not found.";
                    errorMessage.style.display = "block";
                    branchNameField.value = "";
                    micrField.value = "";
                    fullAddressField.value = "";
                });
        }

        function fetchLocationDetails() {
            let pincode = document.getElementById("pincode").value.trim();
            let stateField = document.getElementById("state");
            let districtField = document.getElementById("district");

            if (!/^\d{6}$/.test(pincode)) {
                stateField.value = "";
                districtField.value = "";
                return;
            }
            
            if (pincode) {
                   $.ajax({
                       url: '{{ route('admin.bank_branch.getPincodeDetails') }}',  
                       method: 'GET',
                       data: { pincode: pincode },
                       success: function(response) {
                           if (response.state && response.district) {
                               $('#state').val(response.state);
                               $('#district').val(response.district);
                           } else {
                               alert('State and District details not found!');
                           }
                       },
                       error: function(xhr, status, error) {
                           console.log('AJAX Error:', status, error);
                           alert('Unable to fetch State and Distrcit details based on PIN Code.');
                       }
                   });
               }
        }

        function restrictMobileInput(event) {
            const input = event.target;
            input.value = input.value.replace(/[^0-9]/g, '').slice(0, 10);
        }

        function validateMobileNumber(fieldId) {
            const mobileNumber = document.getElementById(fieldId).value;
            const errorMessage = document.getElementById(fieldId + '-error-message');
            
            // Check if all digits are same
            const allSameDigits = /^(\d)\1{9}$/.test(mobileNumber);
            
            // Check if number is in ascending or descending sequence
            const isSequential = /^(0123456789|9876543210)$/.test(mobileNumber);
            
            // Check if number starts with 0
            const startsWithZero = mobileNumber.startsWith('0');
            
            // Check for repeated patterns
            const hasRepeatedPattern = /^(\d{5})\1$/.test(mobileNumber) || 
                                     /^(\d{4})\1\d{2}$/.test(mobileNumber) ||
                                     /^(\d{3})\1\d{4}$/.test(mobileNumber) ||
                                     /^(\d{2})\1\d{6}$/.test(mobileNumber);
            
            if (allSameDigits) {
                errorMessage.textContent = "Invalid mobile number: All digits cannot be the same";
                errorMessage.style.display = "block";
                return false;
            } else if (isSequential) {
                errorMessage.textContent = "Invalid mobile number: Cannot be a sequential number";
                errorMessage.style.display = "block";
                return false;
            } else if (startsWithZero) {
                errorMessage.textContent = "Invalid mobile number: Cannot start with 0";
                errorMessage.style.display = "block";
                return false;
            } else if (hasRepeatedPattern) {
                errorMessage.textContent = "Invalid mobile number: Cannot have repeated digit patterns";
                errorMessage.style.display = "block";
                return false;
            } else {
                errorMessage.style.display = "none";
                return true;
            }
        }

        function validateEmail() {
            const email = document.getElementById("email").value;
            const errorMessage = document.getElementById("email-error-message");
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            
            if (!emailRegex.test(email)) {
                errorMessage.textContent = "Please enter a valid email address (e.g., example@domain.com)";
                errorMessage.style.display = "block";
                return false;
            } else {
                errorMessage.style.display = "none";
                return true;
            }
        }

        function validateContactPerson() {
            const contactPerson = document.getElementById("contact_person").value;
            const errorMessage = document.getElementById("contact_person-error-message");
            const regex = /^[A-Za-z\s]+$/;
            
            if (!regex.test(contactPerson)) {
                errorMessage.textContent = "Special Characters And Integers Are Not Allowed";
                errorMessage.style.display = "block";
                return false;
            } else {
                errorMessage.style.display = "none";
                return true;
            }
        }

        function validateDesignation() {
            const designation = document.getElementById("designation").value;
            const errorMessage = document.getElementById("designation-error-message");
            const regex = /^[A-Za-z\s]+$/;
            
            if (!regex.test(designation)) {
                errorMessage.textContent = "Special Characters And Integers Are Not Allowed";
                errorMessage.style.display = "block";
                return false;
            } else {
                errorMessage.style.display = "none";
                return true;
            }
        }

        function toggleSaveButton() {
            const ifscCode = document.getElementById("ifsc_code").value;
            const branchName = document.getElementById("branch_name").value;
            const email = document.getElementById("email").value;
            const contactPerson = document.getElementById("contact_person").value;
            const designation = document.getElementById("designation").value;
            const mobile = document.getElementById("mobile").value;
            const pincode = document.getElementById("pincode").value;
            const state = document.getElementById("state").value;
            const district = document.getElementById("district").value;

            // Validate mobile number first
            const isMobileValid = mobile.trim() !== "" && validateMobileNumber('mobile');
            
            const isValid = 
                ifscCode.trim() !== "" &&
                branchName.trim() !== "" &&
                validateEmail() &&
                validateContactPerson() &&
                validateDesignation() &&
                isMobileValid &&
                pincode.trim() !== "" &&
                state.trim() !== "" &&
                district.trim() !== "";

            document.getElementById("submit").disabled = !isValid;
        }

        // Attach event listeners to all input fields
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', toggleSaveButton);
            if (input.id === 'mobile') {
                input.addEventListener('blur', function() {
                    validateMobileNumber('mobile');
                    toggleSaveButton();
                });
            }
        });

        // Initialize the save button state
        document.addEventListener('DOMContentLoaded', function() {
            toggleSaveButton();
        });
    </script>
@endsection
