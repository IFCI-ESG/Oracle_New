@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.shared.page-title', ['title' => 'Exposure', 'subtitle' => ''])
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
            <div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
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

        <form action="{{ route('admin.user.apidata') }}" id="getdetails" role="form" method="get"
                    class='prevent_multiple_submit' >
                    @csrf
                    <div class="card border-primary m-2">
                        <div class="card-body mt-4">
                        <table class="table table-sm">
                <tbody>
                @if (Auth::user()->hasRole('Admin'))
                <tr>
                    
                                        <th class="company-head">Branch IFSC Code <span class="text-danger">*</span></th>
                                        <td>
                                            <select id="ifsc_code" name="ifsc_code" class="form-control" required oninput="fetchBranchDetails()">
                                                <option value="">Select IFSC Code</option>
                                               
                                                @foreach($ifsc_codes as $ifsc)
                                                    <option value="{{ $ifsc }}" {{$ifsc==$ifsc_code ? 'selected' : ''}}>{{ $ifsc }}</option>
                                                @endforeach
                                            </select>
                                            @error('ifsc_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                        <th class="company-head">Branch Name</th>
                                        <td>
                                            <input type="text" id="branch_name" name="branch_name" value="{{ $branch_name }}" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="company-head">Branch Address</th>
                                        <td>
                                            <input type="text" id="full_address" name="full_address"  value="{{ $full_address }}" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    @endif
                                 <tr>
                                    <th class="company-head">PAN of the Customer  <span class="text-danger">*</span></th>
                                 <td>
                                 <input type="text" id="pan" name="pan"  value="{{ $jdecode->data->company->pan }}" class="form-control">
                                     @error('pan')
                                        <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </td>
                         </tr>
                    <tr>
                        <td colspan="2" class="text-center"> 
                        <button type="submit" id="details" class="btn company-btn btn-primary btn-sm" style="width: auto;">
                             <em class="fa fa-search"></em>&nbsp;&nbsp; Get Details
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
                        </div>
                    </div>
                </form>

        <!-- @if (Auth::user()->hasRole('Admin') && Auth::user()->hasRole('SubAdmin'))
                        <div class="card border-primary m-2" id="result">
                            <div class="card card-success card-outline shadow p-1">
                                <b>
                                    Branch Details
                                    <small class="text-danger">(All <span class="text-danger">*</span> fields are
                                        mandatory)</small>
                                </b>
                            </div>

                            <div class="card border-primary m-2">
                                <div class="card-body mt-4">
                                    <table class="table table-sm table-striped table-hover">
                                        <tbody>
                                        <tr>
                                             <th>Branch IFSC Code <span class="text-danger">*</span></th>
                                                 <td colspan="2"> 
                                                    <input type="text" id="ifsc_code" name="ifsc_code"   value="{{ $ifsc_code }}" class="form-control form-control-sm" placeholder="ABCD0123456"  readonly required>
                                                 </td>
                                        </tr>

                                            <tr>
                                                <th>Branch Name <span class="text-danger">*</span></th>
                                                <td colspan="2">
                                                    <input type="text" id="branch_name" name="branch_name"
                                                        class="form-control form-control-sm"  value="{{ $branch_name }}"  placeholder="Branch Name"
                                                        required readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif -->

            <div class="col-md-12">
              

                <form action="{{ route('admin.user.store') }}" id="user_create" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <input type="hidden" id="ifsc_code_hidden" name="ifsc_code" value="{{ $ifsc_code }}">

                    <div id="result"></div>
                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Borrower's Details</b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Company Name</th>
                                            <td><input type="text" id="comp_name" name="comp_name" readonly
                                                    class="form-control form-control-sm"
                                                    value="{{ $jdecode->data->company->legal_name }}">
                                                @error('comp_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>CIN</th>
                                            <td><input type="text" id="cin" name="cin"
                                                    value="{{ $jdecode->data->company->cin }}" readonly
                                                    class="form-control form-control-sm">
                                                @error('cin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PAN</th>
                                            <td><input type="text" id="pan" name="pan"
                                                    value="{{ $jdecode->data->company->pan }}" readonly
                                                    class="form-control form-control-sm">
                                                @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="reg_off_add"
                                                            class="col-form-label col-form-label-sm">Registered Office
                                                        </label>
                                                        <textarea id="reg_off_add" name="reg_address" class="form-control form-control-sm" readonly
                                                            placeholder="Registered office address">{{ $jdecode->data->company->registered_address->full_address }}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                        <input type="number" min="0" id="reg_off_pin" readonly
                                                            name="pincode" class="form-control form-control-sm"
                                                            placeholder="Pin Code"
                                                            value="{{ $jdecode->data->company->registered_address->pincode }}">
                                                        <span id="pincodeMsg"
                                                            style="color:red;font-weight:bold;display: none"></span>

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_state"
                                                            class="col-form-label col-form-label-sm">State</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm select-state"
                                                            name="state" id="regAddState"
                                                            value="{{ $jdecode->data->company->registered_address->state }}"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_city"
                                                            class="col-form-label col-form-label-sm">City</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="city" id="regAddCity"
                                                            value="{{ $jdecode->data->company->registered_address->city }}"
                                                            readonly>
                                                        {{-- <select id="regAddCity" name="city"
                                                            class="form-control form-control-sm select-city">
                                                            <option value="" selected="selected">Please choose..</option>
                                                        </select> --}}
                                                    </div>
                                                    {{-- <div class="form-group col-md-3">
                                                        <label for="reg_off_dist"
                                                            class="col-form-label col-form-label-sm">District</label>
                                                        <select id="regAddDistrict" name="district"
                                                            class="form-control form-control-sm select-city">
                                                            <option value="" selected="selected">Please choose..</option>
                                                        </select>
                                                    </div> --}}
                                                </div>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="reg_off_add"
                                                            class="col-form-label col-form-label-sm">Business Office
                                                        </label>
                                                        <textarea id="" name="co_off_add" class="form-control form-control-sm" readonly
                                                            placeholder="Business office address">{{ $jdecode->data->company->business_address->address_line1 }} {{ $jdecode->data->company->business_address->address_line2 }}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                        <input type="number" min="0" id="reg_off_pin" readonly
                                                            name="co_off_pin" class="form-control form-control-sm"
                                                            placeholder="Pin Code"
                                                            value="{{ $jdecode->data->company->business_address->pincode }}">
                                                        <span id="pincodeMsg"
                                                            style="color:red;font-weight:bold;display: none"></span>

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_state"
                                                            class="col-form-label col-form-label-sm">State</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm select-state"
                                                            name="co_off_state" id="regAddState"
                                                            value="{{ $jdecode->data->company->business_address->state }}"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_city"
                                                            class="col-form-label col-form-label-sm">City</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="co_off_city" id="regAddCity"
                                                            value="{{ $jdecode->data->company->business_address->city }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- @if (Auth::user()->hasRole('Admin') && Auth::user()->hasRole('SubAdmin'))
                        <div class="card border-primary m-2" id="result">
                            <div class="card card-success card-outline shadow p-1">
                                <b>
                                    Branch Details
                                    <small class="text-danger">(All <span class="text-danger">*</span> fields are
                                        mandatory)</small>
                                </b>
                            </div>

                            <div class="card border-primary m-2">
                                <div class="card-body mt-4">
                                    <table class="table table-sm table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Branch IFSC Code <span class="text-danger">*</span></th>
                                                <td colspan="2">
                                                    <input type="text" id="ifsc_code" name="ifsc_code"
                                                        class="form-control form-control-sm" pattern="^[A-Za-z]{4}\d{7}$"
                                                        title="IFSC code must be 11 characters long: first 4 letters and last 7 digits"
                                                        oninput="validateIFSC()" placeholder="ABCD0123456" required>
                                                    <div id="ifsc-error-message"
                                                        style="color: red; display: none; font-size: 0.9rem;"></div>
                                                    @error('ifsc_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Branch Name <span class="text-danger">*</span></th>
                                                <td colspan="2">
                                                    <input type="text" id="branch_name" name="branch_name"
                                                        class="form-control form-control-sm" placeholder="Branch Name"
                                                        required readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif -->

                    <script>
                        function validateIFSC() {
                            let ifscCode = document.getElementById("ifsc_code").value.trim();
                            let ifscPattern = /^[A-Za-z]{4}\d{7}$/;
                            let errorMessage = document.getElementById("ifsc-error-message");
                            let branchNameInput = document.getElementById(
                                "branch_name"); // Assuming the input field for branch name has id "branch_name"

                            // Check if the IFSC code matches the pattern
                            if (!ifscPattern.test(ifscCode)) {
                                errorMessage.innerText = "Invalid IFSC format. It should be 4 letters followed by 7 digits.";
                                errorMessage.style.display = "block";
                                return;
                            } else {
                                errorMessage.style.display = "none";
                            }

                            // Fetching backend data
                            fetch(`/admin/user/check-ifsc-code/${ifscCode}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.exists !== undefined) {
                                        if (!data.exists) {
                                            errorMessage.innerText = "IFSC Code does not exist in our records.";
                                            errorMessage.style.display = "block";
                                            branchNameInput.value = ''; // Clear branch name if IFSC code is not found
                                        } else {
                                            errorMessage.style.display = "none"; // Hide error if the IFSC exists
                                            branchNameInput.value = data.branch_name; // Set the branch name from the backend response
                                        }
                                    } else if (data.error) {
                                        errorMessage.innerText = data.error; // Display error message from backend
                                        errorMessage.style.display = "block";
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    errorMessage.innerText = "An error occurred while validating the IFSC code.";
                                    errorMessage.style.display = "block";
                                });
                        }
                    </script>




                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>
                                Borrower's Details
                                {{-- <i class="fa fa-edit"></i> --}}
                                <small class="text-danger">(All <span class="text-danger">*</span> fields are
                                    mandatory)</small>
                            </b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        {{-- <tr> --}}

                                        <tr>
                                            <th>Email <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="email" name="email"
                                                    class="form-control form-control-sm"
                                                    value="{{ $jdecode->data->company->email }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="auth_name" name="auth_name"
                                                    class="form-control form-control-sm"  value="{{ old('auth_name') }}"  required>
                                                @error('auth_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Designation <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="designation" name="designation"
                                                    class="form-control form-control-sm"  value="{{ old('designation') }}"  required>
                                                @error('designation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mobile <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="number" id="mobile" name="mobile"
                                                    class="form-control form-control-sm"  value="{{ old('mobile') }}"  required>
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Type of Asset Class <span class="text-danger">*</span></th>
                                            <td style="width: 50%;">
                                                <select name="asset_class" id="asset_class"
                                                    class="form-control form-control-sm" required>
                                                    <option value="" disabled selected>Please Select Class</option>
                                                    
                                                    @foreach ($class_type as $ty)
                                                    <option value="{{ $ty->id }}" 
                                                      @if(old('asset_class') == $ty->id) selected @endif>
                                                     {{ $ty->name }}
                                                         </option>
                                                        
                                                    @endforeach
                                                    @error('asset_class')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Company Type <span class="text-danger">*</span></th>
                                            <td style="width: 50%;">
                                                <select name="comp_type" id="type"
                                                    class="form-control form-control-sm" required>
                                                    <option value="" disabled selected>Please Select Company Type
                                                    </option>
                                                    @foreach ($type as $ty)
                                                    <option value="{{ $ty->id }}" 
                                                     @if(old('comp_type') == $ty->id) selected @endif>
                                                      {{ $ty->name }}
                                                     </option>
                                                        
                                                    @endforeach
                                                    @error('type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sector <span class="text-danger">*</span></th>
                                            <td colspan="2">
                                                <select name="sector" id="sector"
                                                    class="form-control form-control-sm" required>
                                                    <option value="" disabled selected>Please Select Sector</option>
                                                    @foreach ($sector as $sec)
                                                    <option value="{{ $sec->id }}" 
                                                      @if(old('sector') == $sec->id) selected @endif>
                                                     {{ $sec->name }}
                                                    </option>
                                                       
                                                    @endforeach
                                                    @error('sector')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr>
                                            <tr id="sectorname-container" style="display: none;">
                                            <th>Sector Name <span class="text-danger">*</span></th>
                                             <td colspan="2"><input type="text" id="sectorname" name="sector_name"  class="form-control form-control-sm"  value="{{ old('sector_name') }}"  >
                                                @error('sector_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bank Zone <span class="text-danger">*</span></th>
                                            <td colspan="2">
                                                <select name="zone" id="zone"
                                                    class="form-control form-control-sm" required>
                                                    <option value="" disabled selected>Please Select Zone</option>
                                                    @foreach ($zone as $zo)
                                                    <option value="{{ $zo->zone }}" 
                                                         @if(old('zone') == $zo->zone) selected @endif>
                                                      {{ $zo->zone }}
                                                    </option>
                                                           
                                                    @endforeach
                                                    @error('zone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Purpose</th>
                                            <td colspan="2">
                                                <label for="environment" style="font-size: 0.9rem">Environment:</label>&nbsp;&nbsp;
                                                <input type="checkbox" id="environment" name="categories[]" value="E" >
                                                <br>
                                                <label for="social" style="font-size: 0.9rem">Social:</label>&nbsp;&nbsp;
                                                <input type="checkbox" id="social" name="categories[]" value="S">
                                                <br>
                                                <label for="governance" style="font-size: 0.9rem">Governance:</label>&nbsp;&nbsp;
                                                <input type="checkbox" id="governance" name="categories[]" value="G">
                                            </td>
                                        </tr> --}}
                                        {{-- <tr>
                                            <th>Password</th>
                                            <td colspan="2"><input type="text" id="password" name="password"
                                                    class="form-control form-control-sm">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr> --}}
                                        {{-- <tr>
                                            <th>Rating</th>
                                            <td colspan="2"><input type="text" id="rating" name="rating" min="0"
                                                    class="form-control form-control-sm" @if (isset($jdecode->data->credit_ratings[0]->rating)) value="{{$jdecode->data->credit_ratings[0]->rating}}" @endif>
                                                    @error('rating')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rating Date</th>
                                            <td colspan="2"><input type="date" id="rating_date" name="rating_date" min="0"
                                                    class="form-control form-control-sm" @if (isset($jdecode->data->credit_ratings[0]->rating_date)) value="{{$jdecode->data->credit_ratings[0]->rating_date}}" @endif>
                                                    @error('rating_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rating Agency</th>
                                            <td colspan="2"><input type="text" id="rating_agency" name="rating_agency" min="0"
                                                    class="form-control form-control-sm" @if (isset($jdecode->data->credit_ratings[0]->rating_agency)) value="{{$jdecode->data->credit_ratings[0]->rating_agency}}" @endif >
                                                    @error('rating_agency')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Financial Year Wise Details (In Crores) <i class="fa fa-edit"></i></b>
                        </div>

                        <div class="card border-primary m-2">
                            <div class="card-body">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                         @foreach ($fys as $key => $fy)
                                            @php
                                                $financials = $jdecode->data->financials;
                                                $year = $fy->end_date;
                                                $filtered_financials = [];

                                                // Filter financials manually
                                                foreach ($financials as $financial) {
                                                    if ($financial->year == $year) {
                                                        $filtered_financials[] = $financial;
                                                    }
                                                }

                                                $filtered_financials_standalone = [];

                                                foreach ($filtered_financials as $financial) {
                                                    if ($financial->nature == 'STANDALONE') {
                                                        $filtered_financials_standalone[] = $financial;
                                                    }
                                                }

                                                // Assuming the financial data is single entry for the year and nature
                                                $standalone_financial = $filtered_financials_standalone[0] ?? null;

                                                $ratings = collect($jdecode->data->credit_ratings)
                                                    ->filter(
                                                        fn($rating) => date('Y', strtotime($rating->rating_date)) ==
                                                            date('Y', strtotime($fy->end_date)),
                                                    )
                                                    ->sortByDesc('rating_date')
                                                    ->first();

                                            @endphp
                                            {{-- {{dd($financials,$filtered_financials_standalone,$year,)}} --}}
                                            <tr>
                                                <th colspan="2" class="text-center">
                                                    FY {{ $fy->fy }}
                                                    <input type="hidden" name="fy[{{ $key }}][fy_id]"
                                                        value="{{ $fy->id }}">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Rating</th>
                                                <td colspan="2"><input type="text" id="rating"
                                                        name="fy[{{ $key }}][rating]" min="0" readonly
                                                        class="form-control form-control-sm text-right"
                                                        value="{{ $ratings->rating ?? '' }}">
                                                    @error('rating')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Rating Date</th>
                                                <td colspan="2"><input type="date" id="rating_date"
                                                        name="fy[{{ $key }}][rating_date]" min="0"
                                                        readonly class="form-control form-control-sm text-right"
                                                        value="{{ $ratings->rating_date ?? '' }}">
                                                    @error('rating_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Rating Agency</th>
                                                <td colspan="2"><input type="text" id="rating_agency"
                                                        name="fy[{{ $key }}][rating_agency]" min="0"
                                                        readonly class="form-control form-control-sm text-right"
                                                        value="{{ $ratings->rating_agency ?? '' }}">
                                                    @error('rating_agency')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            {{-- {{dd($standalone_financial->bs->liabilities->long_term_borrowings,$standalone_financial->bs->liabilities->short_term_borrowings,$standalone_financial->bs->liabilities->long_term_borrowings ?? 0)}} --}}
                                            @php
                                                $long_term_borrowings =
                                                    $standalone_financial->bs->liabilities->long_term_borrowings ?? 0;
                                                $short_term_borrowings =
                                                    $standalone_financial->bs->liabilities->short_term_borrowings ?? 0;

                                                $longTermBorrowings =
                                                    ($long_term_borrowings + $short_term_borrowings) / 10000000;
                                            @endphp
                                            <tr>
                                                <th>Borrowings </th>
                                                <td colspan="2"><input type="number"
                                                        id="fy[{{ $key }}][borrowings]"
                                                        name="fy[{{ $key }}][borrowings]" min="0"
                                                        readonly class="form-control form-control-sm text-right"
                                                        step="0.01"
                                                        value="{{ number_format($longTermBorrowings, 2, '.', '') }}">
                                                    @error('borrowings')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bank Exposure(As on 31 March)  <span class="text-danger">*</span></th>
                                                <td><input type="number" id="fy[{{ $key }}][bank_exposure]"
                                                        name="fy[{{ $key }}][bank_exposure]" step="0.01"
                                                        class="form-control form-control-sm text-right" min="0"   value="{{ old('fy.' . $key . '.bank_exposure') }}" required>
                                                    @error('bank_exposure')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            @php
                                                $share_capital =
                                                    $standalone_financial->bs->liabilities->share_capital ?? 0;
                                                $reserves_and_surplus =
                                                    $standalone_financial->bs->liabilities->reserves_and_surplus ?? 0;

                                                $total_equity = ($share_capital + $reserves_and_surplus) / 10000000;
                                            @endphp
                                            <tr>
                                                <th>Total Equity(Net Worth)</th>

                                                <td><input type="number" id="fy[{{ $key }}][total_equity]"
                                                        name="fy[{{ $key }}][total_equity]" min="0"
                                                        readonly class="form-control form-control-sm text-right"
                                                        step="0.01"
                                                        @if (isset($total_equity)) value="{{ number_format($total_equity, 2, '.', '') }}" @endif>
                                                    @error('total_equity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            @php
                                                if (isset($standalone_financial->pnl->lineItems->net_revenue)) {
                                                    $net_revenue =
                                                        $standalone_financial->pnl->lineItems->net_revenue / 10000000;
                                                } else {
                                                    $net_revenue = 0;
                                                }
                                            @endphp
                                            <tr>
                                                <th>Net Revenue </th>
                                                <td><input type="number" id="fy[{{ $key }}][net_revenue]"
                                                        name="fy[{{ $key }}][net_revenue]" min="0"
                                                        readonly class="form-control form-control-sm text-right"
                                                        step="0.01"
                                                        @if (isset($net_revenue)) value="{{ number_format($net_revenue, 2, '.', '') }}" @endif>
                                                    @error('net_revenue')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            @php
                                                if (isset($standalone_financial->pnl->lineItems->profit_after_tax)) {
                                                    $profit_after_tax =
                                                        $standalone_financial->pnl->lineItems->profit_after_tax /
                                                        10000000;
                                                } else {
                                                    $profit_after_tax = 0;
                                                }
                                            @endphp
                                            <tr>
                                                <th>Profit After Tax </th>
                                                <td><input type="number" id="fy[{{ $key }}][net_revenue]"
                                                        name="fy[{{ $key }}][profit_after_tax]" min="0"
                                                        readonly class="form-control form-control-sm text-right"
                                                        step="0.01"
                                                        @if (isset($profit_after_tax)) value="{{ number_format($profit_after_tax, 2, '.', '') }}" @endif>
                                                    @error('profit_after_tax')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>



                    <div class="card border-primary m-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <a href="{{ route('admin.bank_branch.index') }}"
                                        class="btn btn-secondary btn-sm form-control form-control-sm">
                                        <em class="fas fa-arrow-left"></em> Back
                                    </a>
                                </div>
                                <div class="col-md-2 offset-md-4">
                                    <button type="submit" id="submit"
                                        class="btn btn-primary btn-sm form-control form-control-sm">
                                        <em class="fas fa-save"></em>&nbsp; Save as Draft
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

 
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UserRequest', '#user_create') !!}
    {{-- @include('partials.js.prevent_multiple_submit') --}}
    @include('partials.user.pincode-js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
                        $('#sector').change(function() {
                var selectedValue = $(this).val();
                
                if (selectedValue === '21') {
                  $('#sectorname-container').show();
                } else {
                  $('#sectorname-container').hide();
                }
             });
            console.log('tt');
            const subBtn = document.getElementById("submit");
            // const finalBtn = document.getElementById("final");
            $('.prevent_multiple_submit').on('submit', function() {
                if ($('.msg').length === 0) {
                    $(".prevent_multiple_submit").parent().append(
                        '<div class="offset-md-4 msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>'
                    );
                }
                subBtn.disabled = true;
                setTimeout(function() {
                    subBtn.disabled = false;
                }, (1000 * 20));
                setTimeout(function() {
                    $(".msg").hide()
                }, (1000 * 20));
            });
        });
    </script>

<script>
        $(document).ready(function () {
             
            window.fetchBranchDetails = function() {
                var ifsc_code = $('#ifsc_code').val(); 
                console.log('Selected IFSC Code:', ifsc_code);
    
                if (ifsc_code) {
                   
                    $.ajax({
                        url: '{{ route('admin.user.getBranchDetails') }}',  
                        method: 'GET',
                        data: { ifsc_code: ifsc_code },
                        success: function(response) {
                            
                            if (response.name && response.full_address) {
                                $('#branch_name').val(response.name);
                                $('#full_address').val(response.full_address);
                            } else {
                                alert('Branch details not found!');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('AJAX Error:', status, error);
                            alert('Unable to fetch branch details.');
                        }
                    });
                }
            };
        });
    </script>
    @endsection
  

 
