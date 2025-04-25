@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
@vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
<style>
    input::placeholder {
        color: #ccc;
    }
</style>
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.bank_branch.update') }}" id="branchDetails_create" role="form" method="post"
                onsubmit="return validateForm()" class='prevent_multiple_submit' files=true
                enctype='multipart/form-data' accept-charset="utf-8">
                @csrf
                <input type="hidden" value="{{ $bank_details->id }}" name="user_id">
                <div class="card">
                    <div class="card card-success card-outline shadow p-1">
                        <b>Branch Details</b>
                    </div>
                    <div class="card border-primary m-2">
                        <div class="card-body">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <tbody>
                                    <tr class="table-success">
                                        <th class="text-center" style="width: 20%">Sr.No.</th>
                                        <th class="text-center" style="width: 30%">Particulars</th>
                                        <th class="text-center" style="width: 40%">Value</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 1. </th>
                                        <th style="font-size: 0.9rem">
                                            IFSC Code <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="ifsc_code" name="ifsc_code" value="{{ $bank_details->ifsc_code}}"
                                                class="form-control form-control-sm text-right" style="width:50%"
                                                oninput="validateIFSC()" placeholder="ABCD0123456"  required />
                                            <div id="ifsc-error-message"
                                                style="color: red; display: none; font-size: 0.9rem;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">2. </th>
                                        <th style="font-size: 0.9rem">Branch Name <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="branch_name" name="branch_name" value="{{ $bank_details->name}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">3. </th>
                                        <th style="font-size: 0.9rem">MICR <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="micr_code" name="micr_code" value="{{ $bank_details->micr_code}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">4. </th>
                                        <th style="font-size: 0.9rem">Address <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="full_address" name="full_address" value="{{ $bank_details->full_address}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly required />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">5.</th>
                                        <th style="font-size: 0.9rem">Pincode <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="number" id="pincode" name="pincode" value="{{ $bank_details->pincode}}"
                                                class="form-control form-control-sm text-right" style="width:50%" oninput="fetchLocationDetails()"
                                                placeholder="Enter Pincode" required minlength="6" maxlength="6" />
                                            <span style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">(Please enter a valid 6-digit Pincode)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 6. </th>
                                        <th style="font-size: 0.9rem">
                                            State <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="state" name="state" value="{{ $bank_details->state}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly
                                                 required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 7. </th>
                                        <th style="font-size: 0.9rem">
                                            District <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="district" name="district" value="{{ $bank_details->district}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly
                                                 required />
                                        </td>
                                    </tr>
                                <tr>
                                    <th class="text-center" style="font-size: 0.9rem">8.</th>
                                    <th style="font-size: 0.9rem">Email <span style="color: red;">*</span></th>
                                    <td>
                                        <input type="email" id="email" name="email" value="{{ $bank_details->email}}"
                                            class="form-control form-control-sm text-right" style="width:50%"
                                            placeholder="example@domain.com" required oninput="validateEmail()" />
                                        <div id="email-error-message"
                                            style="color: red; display: none; font-size: 0.9rem;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" style="font-size: 0.9rem">9.</th>
                                    <th style="font-size: 0.9rem">Contact Person <span style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" id="contact_person" name="contact_person" value="{{ $bank_details->contact_person}}"
                                            class="form-control form-control-sm text-right" style="width:50%"
                                            placeholder="Enter Contact Person" required oninput="validateContactPerson()" />
                                        <div id="contact-person-error-message"
                                            style="color: red; display: none; font-size: 0.9rem;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" style="font-size: 0.9rem">10.</th>
                                    <th style="font-size: 0.9rem">Designation <span style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" id="designation" name="designation" value="{{ $bank_details->designation}}"
                                            class="form-control form-control-sm text-right" style="width:50%"
                                            placeholder="Enter Designation" oninput="validateDesignation()" />
                                        <div id="designation-error-message"
                                            style="color: red; display: none; font-size: 0.9rem;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" style="font-size: 0.9rem">11.</th>
                                    <th style="font-size: 0.9rem">Mobile <span style="color: red;">*</span> </th>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">+91</span>
                                            <input type="tel" id="mobile" name="mobile" value="{{ $bank_details->mobile}}"
                                                class="form-control form-control-sm text-right" style="width:50%"
                                                oninput="restrictMobileInput(event)" onblur="validateMobileNumber('mobile')" maxlength="10"
                                                placeholder="Enter 10 digit mobile number" required />
                                        </div>
                                        <span style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">
                                            (Please enter a valid 10-digit Mobile Number)
                                        </span>
                                        <div id="mobile-error-message" style="color: red; display: none; font-size: 0.9rem;"></div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-1 ">
                        <a href="{{ route('admin.bank_branch.index') }}" class="btn btn-secondary btn-sm form-control form-control-sm">
                            <em class="fas fa-arrow-left"></em> Back
                        </a>
                    </div>
                    <div class="col-md-2 offset-md-3">
                        <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm">
                            <em class="fas fa-save"></em> Update
                        </button>
                    </div>
                </form>
                    <div class="col-md-2 offset-md-0">
                        <form action="{{ route('admin.bank_branch.submit') }}" id="final_submit" role="form"
                            method="post" class='fin_prevent_multiple_submit' files=true enctype='multipart/form-data'
                            accept-charset="utf-8">
                            @csrf
                            @if ($bank_details->status != 'S')
                                <button type="submit" id="finalsubmit"
                                    class="btn btn-primary btn-sm form-control form-control-sm">
                                    <em class="fas fa-save"></em> Submit
                                </button>
                            @endif
                            <input type="hidden" name="user_id" value="{{ $bank_details->id }}">
                        </form>
                    </div><br>
                </div>
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


        fetch(`https://api.postalpincode.in/pincode/${pincode}`)
            .then(response => response.json())
            .then(data => {
                if (data[0] && data[0].PostOffice) {
                    const location = data[0].PostOffice[0];
                    stateField.value = location.State || "State not available";
                    districtField.value = location.District || "District not available";
                } else {
                    stateField.value = "State not found";
                    districtField.value = "District not found";
                }
            })
            .catch(error => {

                stateField.value = "Error fetching state";
                districtField.value = "Error fetching district";
            });
    }

function validateEmail() {
    const email = document.getElementById('email').value;
    const errorMessage = document.getElementById('email-error-message');
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    if (!emailRegex.test(email)) {
        errorMessage.textContent = "Please enter a valid email address";
        errorMessage.style.display = "block";
        return false;
    } else {
        errorMessage.style.display = "none";
        return true;
    }
}

function validateContactPerson() {
    const contactPerson = document.getElementById('contact_person').value;
    const errorMessage = document.getElementById('contact-person-error-message');
    const regex = /^[A-Za-z\s]+$/;
    
    if (!regex.test(contactPerson)) {
        errorMessage.textContent = "Special characters and numbers are not allowed";
        errorMessage.style.display = "block";
        return false;
    } else {
        errorMessage.style.display = "none";
        return true;
    }
}

function validateDesignation() {
    const designation = document.getElementById('designation').value;
    const errorMessage = document.getElementById('designation-error-message');
    const regex = /^[A-Za-z\s]+$/;
    
    if (!designation) {
        errorMessage.textContent = "Designation is required";
        errorMessage.style.display = "block";
        return false;
    } else if (!regex.test(designation)) {
        errorMessage.textContent = "Special characters and numbers are not allowed";
        errorMessage.style.display = "block";
        return false;
    } else {
        errorMessage.style.display = "none";
        return true;
    }
}

function validatePincode(pincode) {
    return pincode && pincode.length === 6 && /^\d{6}$/.test(pincode);
}

function validateIFSCFormat(ifsc) {
    return /^[A-Z]{4}0[A-Z0-9]{6}$/.test(ifsc);
}

function validateMICR(micr) {
    return /^\d{9}$/.test(micr);
}

function validateAddress(address) {
    return address && address.trim().length > 0;
}

function restrictMobileInput(event) {
    const input = event.target;
    input.value = input.value.replace(/[^0-9]/g, '');
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

function toggleSaveButton() {
    // Get all mandatory field values
    const ifscCode = document.getElementById("ifsc_code").value.trim();
    const branchName = document.getElementById("branch_name").value.trim();
    const micrCode = document.getElementById("micr_code").value.trim();
    const fullAddress = document.getElementById("full_address").value.trim();
    const pincode = document.getElementById("pincode").value.trim();
    const state = document.getElementById("state").value.trim();
    const district = document.getElementById("district").value.trim();
    const email = document.getElementById("email").value.trim();
    const contactPerson = document.getElementById("contact_person").value.trim();
    const designation = document.getElementById("designation").value.trim();
    const mobile = document.getElementById("mobile").value.trim();

    // Validate all fields
    const ifscValid = validateIFSCFormat(ifscCode);
    const micrValid = validateMICR(micrCode);
    const addressValid = validateAddress(fullAddress);
    const pincodeValid = validatePincode(pincode);
    const emailValid = validateEmail();
    const contactPersonValid = validateContactPerson();
    const designationValid = validateDesignation();
    const mobileValid = validateMobileNumber('mobile');

    // Check if all mandatory fields are filled AND valid
    const isValid = ifscValid && 
                   branchName && 
                   micrValid && 
                   addressValid && 
                   pincodeValid && 
                   state && 
                   district && 
                   emailValid && 
                   contactPersonValid &&
                   designationValid && 
                   mobileValid;

    // Enable or disable the submit button
    document.getElementById("submit").disabled = !isValid;

    // Show validation state visually
    const inputs = ["ifsc_code", "branch_name", "micr_code", "full_address", "pincode", 
                   "state", "district", "email", "contact_person", "designation", "mobile"];
    
    inputs.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            if (!input.value.trim()) {
                input.style.borderColor = "#dc3545";
            } else {
                input.style.borderColor = "";
            }
        }
    });
}

// Add validation on blur for each field
document.addEventListener('DOMContentLoaded', function() {
    // Initially disable the submit button
    document.getElementById("submit").disabled = true;
    
    // Add event listeners to all input fields
    const inputs = ["ifsc_code", "branch_name", "micr_code", "full_address", "pincode", 
                   "state", "district", "email", "contact_person", "designation", "mobile"];
    
    inputs.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', toggleSaveButton);
            input.addEventListener('blur', toggleSaveButton);
        }
    });

    // Initial validation
    toggleSaveButton();
});

// Validate form submission
function validateForm() {
    toggleSaveButton(); // Revalidate everything before submission
    return !document.getElementById("submit").disabled;
}
</script>
@endsection
