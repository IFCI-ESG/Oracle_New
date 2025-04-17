@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
@vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
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
                                            placeholder="example@domain.com" required />
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
                                            placeholder="Enter Contact Person" required />
                                        <span
                                            style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">(Contact
                                            Person - Special Characters And Integers Are Not Allowed)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" style="font-size: 0.9rem">10.</th>
                                    <th style="font-size: 0.9rem">Designation <span style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" id="designation" name="designation" value="{{ $bank_details->designation}}"
                                            class="form-control form-control-sm text-right" style="width:50%"
                                            placeholder="Enter Designation" />
                                        <span
                                            style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">(Designation
                                            - Special Characters And Integers Are Not Allowed)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" style="font-size: 0.9rem">11.</th>
                                    <th style="font-size: 0.9rem">Mobile <span style="color: red;">*</span> </th>
                                    <td>
                                        <input type="tel" id="mobile" name="mobile" value="{{ $bank_details->mobile}}"
                                            class="form-control form-control-sm text-right" style="width:50%"
                                            placeholder="Enter 10 digit mobile number" required />
                                        <span
                                            style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">(Please
                                            enter a valid 10-digit Mobile Number)</span>
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


    // Consolidate input validation and form validation
    function toggleSaveButton() {
        var branchName = document.getElementById("branch_name").value;
        var email = document.getElementById("email").value;
        var contactPerson = document.getElementById("contact_person").value;
        var designation = document.getElementById("designation").value;
        var mobile = document.getElementById("mobile").value;
        var ifscCode = document.getElementById("ifsc_code").value;
        var pincode = document.getElementById("pincode").value;

        var isValid = true;

        // Validation for each field
        if (!/^[A-Za-z\s]+$/.test(branchName)) isValid = false;
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) isValid = false;
        if (!/^[A-Za-z\s]+$/.test(contactPerson)) isValid = false;
        if (!/^[A-Za-z\s]+$/.test(designation)) isValid = false;
        if (!/^\d{10}$/.test(mobile)) isValid = false;
        if (!/^[A-Za-z]{4}\d{7}$/.test(ifscCode)) isValid = false;
        if (!/^\d{6}$/.test(pincode)) isValid = false;

        // Enable or disable the submit button
        document.getElementById("submit").disabled = !isValid;
    }

    // Attach event listener to input fields
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', toggleSaveButton);
    });

    // Validate form submission
    function validateForm() {
        return !document.getElementById("submit").disabled;
    }
</script>
@endsection
