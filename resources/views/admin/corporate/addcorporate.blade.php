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

    @if (session('success'))
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
            <form action="{{ route('admin.corp_admin.store') }}" id="bankDetails_create" role="form" method="post"
                onsubmit="return validateForm()" class='prevent_multiple_submit' files=true
                enctype='multipart/form-data' accept-charset="utf-8">
                @csrf
                <div class="card">
                    <div class="card card-success card-outline shadow p-1">
                        <b>Corporate Details</b>
                    </div>
                    {{-- <input type="hidden" value="{{ $appMast->id }}" name="app_id">
                    <input type="hidden" name="claim_id" value="{{ $claimMast->id }}"> --}}
                    <div class="card border-primary m-2">
                        <div class="card-body mt-4">
                            <table class="table table-sm table-striped  table-bordered table-hover">
                                <tbody>
                                    <tr class="table-success">
                                        <th class="text-center" style="width: 20%">Sr.No.</th>
                                        <th class="text-center" style="width: 30%">Particulars</th>
                                        <th class="text-center" style="width: 40%">Value</th>
                                    </tr>

                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 1. </th>
                                        <th style="font-size: 0.9rem">
                                            PAN <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="pan" name="pan"
                                                class="form-control form-control-sm text-right" style="width:80%"
                                                oninput="PanApi(this)" placeholder="ABCD0123456"  value="{{ old('pan') }}" required />
                                            <div id="ifsc-error-message"
                                                style="color: red; display: none; font-size: 0.9rem;"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 2. </th>
                                        <th style="font-size: 0.9rem">
                                            Name <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="corp_name" name="corp_name"
                                                class="form-control form-control-sm text-right"  value="{{ old('corp_name') }}" style="width:80%"
                                                readonly required />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 3. </th>
                                        <th style="font-size: 0.9rem">
                                            CIN <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="cin" name="cin"
                                                class="form-control form-control-sm text-right"  value="{{ old('cin') }}" style="width:80%"
                                                readonly required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 4. </th>
                                        <th style="font-size: 0.9rem"> Email <span style="color: red;">*</span></th>
                                        <td>
                                            {{-- <input type="email" id="email" name="email"
                                                class="form-control form-control-sm text-right" style="width:80%"
                                                oninput="restrictEmailInput(event)" onblur="validateEmail()"
                                                placeholder="example@domain.com"  value="{{ old('email') }}" required /> --}}
                                            <input type="email" id="corp_email" name="corp_email"
                                                class="form-control form-control-sm text-right" style="width:80%"
                                                placeholder="example@domain.com"  value="{{ old('corp_email') }}" required />
                                            <div id="email-error-message"
                                                style="color: red; display: none; font-size: 0.9rem;"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 5. </th>
                                        <th style="font-size: 0.9rem">
                                            Registered Address <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <textarea class="form-control form-control-sm" style="width:80%" name="reg_off_add" id="reg_off_add" rows="3" required>{{ old('reg_off_add') }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 7. </th>
                                        <th style="font-size: 0.9rem">
                                            State <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="reg_off_state" name="reg_off_state" readonly
                                                class="form-control form-control-sm text-right"  value="{{ old('reg_off_state') }}" style="width:80%"
                                                required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 8. </th>
                                        <th style="font-size: 0.9rem">
                                            City <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <select id="reg_off_city" name="reg_off_city" style="width:80%"
                                                class="form-control form-control-sm select-city">
                                                <option value="" selected="selected" disabled>Please choose..</option>
                                            </select>
                                            {{-- <input type="text" id="reg_off_city" name="reg_off_city"
                                                class="form-control form-control-sm text-right" value="{{ old('reg_off_city') }}" style="width:80%"
                                                required /> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">9.</th>
                                         <th style="font-size: 0.9rem">
                                           Type of Sector <span style="color: red;">*</span>
                                         </th>
                                        <td>
                                         <select id="sector_type" name="sector_type" class="form-control form-control-sm" style="width:80%" required>
                                             <option value="" disabled selected>Select Sector Type</option>
                                             @foreach ($sectors as $sector)
                                                 <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                             @endforeach
                                             {{-- <option value="public" {{ old('sector_type') == 'public' ? 'selected' : '' }}>Public</option>
                                             <option value="private" {{ old('sector_type') == 'private' ? 'selected' : '' }}>Private</option> --}}
                                        </select>
                                      </td>
                                    </tr>

                                    {{-- <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 9. </th>
                                        <th style="font-size: 0.9rem">
                                            PAN <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="pan" name="pan"
                                                class="form-control form-control-sm text-right" style="width:80%"
                                                oninput="restrictPANInput(event)" onblur="validatePAN()"
                                                placeholder="ABCDE1234F"  value="{{ old('pan') }}" required />
                                            <div id="pan-error-message"
                                                style="color: red; display: none; font-size: 0.9rem;"></div>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 10. </th>
                                        <th style="font-size: 0.9rem">
                                            License Key <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="license_key" name="license_key"
                                                class="form-control form-control-sm text-right"  value="{{ old('license_key') }}" style="width:80%"
                                                required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 11. </th>
                                        <th style="font-size: 0.9rem">
                                            Valid From <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="date" id="valid_from" name="valid_from"
                                                class="form-control form-control-sm text-right" style="width:80%"  value="{{ old('valid_from') }}"
                                                required onchange="setMinValidToDate(); enableValidToDate()" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 12. </th>
                                        <th style="font-size: 0.9rem">
                                            Valid To <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="date" id="valid_to" name="valid_to"
                                                class="form-control form-control-sm text-right"  value="{{ old('valid_to') }}"  style="width:80%"
                                                required disabled />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 13. </th>
                                        <th style="font-size: 0.9rem"> Contact Person <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="contact_person" name="contact_person"
                                                class="form-control form-control-sm text-right" style="width:80%"
                                                oninput="restrictContactPersonInput(event)"
                                                placeholder="Enter Contact Person"  value="{{ old('contact_person') }}" required />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">(Contact
                                                Person - Special Characters And Integers Are Not Allowed)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 14. </th>
                                        <th style="font-size: 0.9rem"> Designation <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <input type="text" id="designation" name="designation"
                                                class="form-control form-control-sm text-right"  value="{{ old('designation') }}" style="width:80%"
                                                oninput="restrictDesignationInput(event)"
                                                placeholder="Enter Designation" />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">(Designation
                                                - Special Characters And Integers Are Not Allowed)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 15. </th>
                                        <th style="font-size: 0.9rem"> Mobile No. <span style="color: red;">*</span>
                                        </th>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <span style="margin-right: 5px;">+91</span>
                                                <input type="tel" id="mobile" name="mobile"
                                                    class="form-control form-control-sm text-right" style="width:80%"  value="{{ old('mobile') }}"
                                                    oninput="restrictMobileInput(event)" maxlength="10"
                                                    placeholder="Enter 10 digit mobile number" required />
                                            </div>
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">
                                                (Please enter a valid 10-digit Mobile Number)
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 16. </th>
                                        <th style="font-size: 0.9rem"> Alternate Mobile No. </th>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <span style="margin-right: 5px;">+91</span>
                                                <input type="tel" id="altr_mobile" name="altr_mobile"
                                                    class="form-control form-control-sm text-right"  value="{{ old('altr_mobile') }}" style="width:80%"
                                                    oninput="restrictMobileInput(event)" maxlength="10"
                                                    placeholder="Enter Alternate Mobile" />
                                            </div>
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;">
                                                (Please enter a valid 10-digit Alternate Mobile Number)
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem"> 17. </th>
                                        <th style="font-size: 0.9rem"> Services <span style="color: red;">*</span>
                                        </th>
                                        <td colspan="2">
                                            <table>
                                                <tbody>
                                                    @foreach ($services as $key => $serve)
                                                    <tr>
                                                        <td style="width: 80%;">
                                                            <label for="environment"
                                                                style="font-size: 0.9rem">{{ $serve->services }}
                                                            </label>&nbsp;&nbsp;
                                                        </td>
                                                        <td class="text-center" style="width: 80%;">
                                                            <input type="checkbox" class="services margin-right"
                                                                id="service_{{ $serve->id }}" name="services[]"
                                                                value="{{ $serve->id }}"
                                                                @if(in_array($serve->id, old('services', []))) checked @endif>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <br> -->
                <div class="row">
                    <div class="col-md-1">
                        <a href="{{ route('admin.new_admin.index') }}"
                            class="btn btn-secondary btn-sm form-control form-control-sm">
                            <em class="fas fa-arrow-left"></em> Back
                        </a>
                    </div>
                    <div class="col-md-2 offset-md-4">
                        <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm"
                            >
                            <em class="fas fa-save"></em> Save As Draft
                        </button>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>

<script>
// function toggleSaveButton() {

//     var pan = document.getElementById("pan").value;
//     var corp_name = document.getElementById("corp_name").value;
//     var cin = document.getElementById("cin").value;
//     var email = document.getElementById("email").value;
//     var reg_off_add = document.getElementById("reg_off_add").value;
//     var reg_off_state = document.getElementById("reg_off_state").value;
//     var reg_off_pin = document.getElementById("reg_off_pin").value;
//     var sector_type = document.getElementById("sector_type").value;
//     var license_key = document.getElementById("license_key").value;
//     var valid_from = document.getElementById("valid_from").value;
//     var valid_to = document.getElementById("valid_to").value;
//     var email = document.getElementById("email").value;
//     var contactPerson = document.getElementById("contact_person").value;
//     var designation = document.getElementById("designation").value;
//     var mobile = document.getElementById("mobile").value;
//     var altr_mobile = document.getElementById("altr_mobile").value;

//     var isValid = true;

//     if (!/^[A-Za-z\s]+$/.test(pan)) {
//         isValid = false;
//     }
//     if (!/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(corp_name)) {
//         isValid = false;
//     }
//     if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
//         isValid = false;
//     }
//     if (!/^[A-Za-z\s]+$/.test(contactPerson)) {
//         isValid = false;
//     }
//     if (designation && !/^[A-Za-z\s]+$/.test(designation)) {
//         isValid = false;
//     }
//     if (!/^[0-9]{10}$/.test(mobile)) {
//         isValid = false;
//     }
//     if (!/^[0-9]{10}$/.test(cin)) {
//         isValid = false;
//     }
//     if (!license_key) {
//         isValid = false;
//     }
//     if (!valid_from) {
//         isValid = false;
//     }
//     if (!valid_to) {
//         isValid = false;
//     }

//     document.getElementById("submit").disabled = !isValid;
// }

// window.onload = function() {
//     document.getElementById("bank_name").addEventListener("input", toggleSaveButton);
//     document.getElementById("bank_code").addEventListener("input", toggleSaveButton);
//     document.getElementById("pan").addEventListener("input", toggleSaveButton);
//     document.getElementById("license_key").addEventListener("input", toggleSaveButton);
//     document.getElementById("valid_from").addEventListener("input", toggleSaveButton);
//     document.getElementById("valid_to").addEventListener("input", toggleSaveButton);
//     document.getElementById("email").addEventListener("input", toggleSaveButton);
//     document.getElementById("contact_person").addEventListener("input", toggleSaveButton);
//     document.getElementById("designation").addEventListener("input", toggleSaveButton);
//     document.getElementById("mobile").addEventListener("input", toggleSaveButton);
//     document.getElementById("altr_mobile").addEventListener("input", toggleSaveButton);
// };

// toggleSaveButton();
</script>
<script>
    function PanApi(e) {
        var regex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

        var pan = e.value;
        // if (!regex.test(pan)) {
        //     e.value = pan.replace(/[^A-Z0-9]/g, '');
        // }

        if (!regex.test(pan)) {
            showError("pan", "Please enter a valid PAN number (e.g., ABCDE1234F).");
        }

        if (!pan) {
            corp_name.value     = "";
            cin.value           = "";
            email.value         = "";
            reg_off_add.value   = "";
            reg_off_state.value = "";
            reg_off_city.value  = "";
            reg_off_pin.value   = "";
            return; // No need to continue with API call
        }

        if (pan) {
            $.ajax({
                url: "{{ url('admin/corp_admin/api') }}/" + pan,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // console.log('dd');
                    if (!response.status) {
                        alert(response.message); // You can replace with SweetAlert or toastr
                        return;
                    }

                    if (response && response.data) {
                        const company = response.data.company;

                        corp_name.value       = company.legal_name || "Name not available";
                        cin.value             = company.cin || "CIN not available";
                        corp_email.value      = company.email  || "Email not available";
                        reg_off_add.value     = company.registered_address?.full_address || "Address not available";
                        reg_off_state.value   = company.registered_address?.state         || "State not available";
                        // reg_off_city.value    = company.registered_address?.city          || "City not available";
                        reg_off_pin.value     = company.registered_address?.pincode       || "Pincode not available";
                        
                        const cityValue = company.registered_address?.city;
                        if (cityValue) {
                            let optionExists = false;
                            $('#reg_off_city option').each(function() {
                                if ($(this).val() === cityValue) {
                                    optionExists = true;
                                }
                            });

                            if (!optionExists) {
                                $('#reg_off_city').append(new Option(cityValue, cityValue));
                            }

                            $('#reg_off_city').val(cityValue).trigger('change');
                        } else {
                            $('#reg_off_city').val("").trigger('change'); // reset to default
                        }

                    }
                },

                error: function(xhr) {
                    let message = "Something went wrong.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    alert(message); // Or use SweetAlert/toastr
                }
            });
        }
    }

    function GetCityByPinCode(pincode) {
                var state = '#reg_off_state';
                var city = '#reg_off_city';
                // var district = '#AddDistrict';
                var pinmsg = '#pincodeMsg';
                        // alert(state);
                if (pincode.length != 6) {
                    $(pinmsg).text('Pincode Incorrect!');
                    $(pinmsg).show();
                    $(state).val('');
                    $(city).val('');
                    // $(district).val('');
                }
                if (pincode.length == 6 && $.isNumeric(pincode)) {
                    $.ajax({
                        url: "{{ url('pincodes') }}/" + pincode,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // console.log(data.state.length);
                            if (data.state.length == 0) {
                                // alert('g');
                                $("#pincodeMsg").text('Pincode Not Found');
                                $("#pincodeMsg").show();

                            } else {
                                $("#pincodeMsg").hide();
                                $.each(data.state, function(index, value) {
                                    $(state).val(value)
                                });
                                var selOpts = "<option  selected disabled>Please choose..</option>";
                                // var selOpts1 = "<option  selected disabled>Please choose..</option>";

                                $.each(data.city, function(index1, value1) {
                                    $(city).val(value1);
                                    selOpts += "<option value='" + value1 + "'>" +
                                        value1 +
                                        "</option>";
                                });
                                $(city)
                                    .empty()
                                    .append(selOpts);

                                // $.each(data.district, function(index2, value2) {
                                //     $(district + count).val(value2);
                                //     selOpts1 += "<option value='" + value2 + "'>" +
                                //         value2 +
                                //         "</option>";
                                // });
                                // $(district + count)
                                //     .empty()
                                //     .append(selOpts1);
                            }

                        }
                    });
                };
            }

function validateIFSC() {
    // alert('d');
    let ifscCode = document.getElementById("ifsc_code").value.trim();
    let ifscPattern = /^[A-Z]{4}0[A-Z0-9]{6}$/;
    let errorMessage = document.getElementById("ifsc-error-message");
    let bankNameField = document.getElementById("bank_name");
    let bankCodeField = document.getElementById("bank_code");
    let micrField = document.getElementById("micr_code");
    let stateField = document.getElementById("state");
    let districtField = document.getElementById("district");
    let cityField = document.getElementById("city");
    let fullAddressField = document.getElementById("full_address");

    if (!ifscPattern.test(ifscCode)) {
        errorMessage.innerText = "Invalid IFSC format.";
        errorMessage.style.display = "block";
        bankNameField.value = "";
        micrField.value = "";
        stateField.value = "";
        districtField.value = "";
        cityField.value = "";
        fullAddressField.value = "";
        return;
    } else {
        errorMessage.style.display = "none";
    }

    fetch(`https://ifsc.razorpay.com/${ifscCode}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Invalid IFSC Code");
            } else {

           
            return response.json();
            }
        })
        .then(data => {
            bankNameField.value = data.BANK || "Bank not found";
            bankCodeField.value = data.BANKCODE || "Bank Code not found";
            micrField.value = data.MICR || "MICR not available";
            stateField.value = data.STATE || "State not available";
            districtField.value = data.DISTRICT || "District not available";
            cityField.value = data.CITY || "City not available";
            fullAddressField.value = data.ADDRESS || "Address not available";
        })
        .catch(error => {
            errorMessage.innerText = "Invalid IFSC Code or not found.";
            errorMessage.style.display = "block";
            bankNameField.value = "";
            bankCodeField.value = "";
            micrField.value = "";
            stateField.value = "";
            districtField.value = "";
            cityField.value = "";
            fullAddressField.value = "";
        });
}


function showError(inputField, message) {
    var errorMessage = document.getElementById(inputField + "-error-message");
    errorMessage.style.display = "block";
    errorMessage.textContent = message;
}

function hideError(inputField) {
    var errorMessage = document.getElementById(inputField + "-error-message");
    errorMessage.style.display = "none";
}

// function validatePAN() {
//     var panNumber = document.getElementById("pan").value;
//     var regex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

//     if (!regex.test(panNumber)) {
//         showError("pan", "Please enter a valid PAN number (e.g., ABCDE1234F).");
//     } else {
//         hideError("pan");
//     }
// }

function validateEmail() {
    var email = document.getElementById("email").value;
    var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!regex.test(email)) {
        showError("email", "Please enter a valid email address (e.g., example@domain.com).");
    } else {
        hideError("email");
    }
}

function restrictEmailInput(e) {
    var regex = /^[a-zA-Z0-9._%+-@]*$/;
    var inputValue = e.target.value;
    if (!regex.test(inputValue)) {
        e.target.value = inputValue.replace(/[^a-zA-Z0-9._%+-@]/g, '');
    }
}

function restrictPANInput(e) {
    var regex = /^[A-Z0-9]*$/;
    var inputValue = e.target.value;
    if (!regex.test(inputValue)) {
        e.target.value = inputValue.replace(/[^A-Z0-9]/g, '');
    }
}

function restrictBankNameInput(e) {
    var regex = /^[A-Za-z\s]*$/;
    var inputValue = e.target.value;
    if (!regex.test(inputValue)) {
        e.target.value = inputValue.replace(/[^A-Za-z\s]/g, '');
    }
}

function restrictContactPersonInput(e) {
    var regex = /^[A-Za-z\s]*$/;
    var inputValue = e.target.value;
    if (!regex.test(inputValue)) {
        e.target.value = inputValue.replace(/[^A-Za-z\s]/g, '');
    }
}

function restrictDesignationInput(e) {
    var regex = /^[A-Za-z\s]*$/;
    var inputValue = e.target.value;
    if (!regex.test(inputValue)) {
        e.target.value = inputValue.replace(/[^A-Za-z\s]/g, '');
    }
}

function restrictMobileInput(event) {
    let inputField = event.target;
    let inputValue = inputField.value.replace(/\D/g, ''); // Remove non-numeric characters

    // Ensure input is exactly 10 digits
    if (inputValue.length > 10) {
        inputValue = inputValue.substring(0, 10);
    }

    inputField.value = inputValue;
}

function restrictAlternateMobileInput(e) {
    var regex = /^[0-9]*$/;
    var inputValue = e.target.value;
    if (!regex.test(inputValue)) {
        e.target.value = inputValue.replace(/[^0-9]/g, '');
    }
}

function setMinValidToDate() {
    var validFromDate = document.getElementById("valid_from").value;
    var validToDateInput = document.getElementById("valid_to");


    validToDateInput.min = validFromDate;
}
</script>
<script>
function setMinValidToDate() {
    var validFromDate = document.getElementById("valid_from").value;
    var validToDateInput = document.getElementById("valid_to");

    validToDateInput.min = validFromDate;
}

function enableValidToDate() {
    var validFromDate = document.getElementById('valid_from').value;
    var validToField = document.getElementById('valid_to');


    if (validFromDate) {
        validToField.disabled = false;
    } else {
        validToField.disabled = true;
        validToField.value = '';
    }
}
</script>
@section('script')
@include('partials.js.prevent_multiple_submit')
@vite(['resources/js/pages/sweet-alerts.init.js'])
@endsection
@endsection
