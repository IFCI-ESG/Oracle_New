@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
       @include('layouts.shared.page-title' , ['title' => 'Exposure','subtitle' => ''])
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           {{ $error }}
        </div>
        @endforeach

    @endif

  @if(session('success'))

    <div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       {{ session('success') }}
    </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
           {{ session('error') }}
        </div>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
           
            <form action="" id="getdetails" role="form" method="get"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-primary m-2">
                        <div class="card-body mt-4">
                        <table class="table table-sm">
                <tbody>
                @if (Auth::user()->hasRole('Admin'))
                                    <tr>
                                        <th class="company-head">IFSC Code</th>
                                        <td>
                                            <input type="text" id="ifsc_code" name="ifsc_code" value="{{$adminUser->ifsc_code}}" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="company-head">Branch Name</th>
                                        <td>
                                            <input type="text" id="branch_name" name="branch_name" value="{{$adminUser->name}}" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="company-head">Branch Address</th>
                                        <td>
                                            <input type="text" id="full_address" name="full_address"  value="{{$adminUser->full_address}}" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                    <th class="company-head">PAN of the Customer </th>
                                 <td>
                                 <input type="text" id="pan" name="pan"  value="{{$user->pan}}" class="form-control" readonly>
                                   
                                 </td>
                         </tr>
                  
                </tbody>
            </table>
                        </div>
                    </div>
                </form>
                <form action="{{ route('admin.user.update') }}" id="user_create" role="form" method="post"
                    class='det_prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

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
                                                    value="{{ $user->name }}" class="form-control form-control-sm"
                                                    >
                                                @error('comp_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>CIN</th>
                                            <td><input type="text" id="cin" name="cin" readonly
                                                    value="{{ $user->cin_llpin }}" class="form-control form-control-sm"
                                                    >
                                                @error('cin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PAN</th>
                                            <td><input type="text" id="pan" name="pan" readonly
                                                    value="{{ $user->pan }}" class="form-control form-control-sm"
                                                    >
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
                                                            class="col-form-label col-form-label-sm">Registered Office </label>
                                                        <textarea id="reg_off_add" name="reg_address" class="form-control form-control-sm" readonly
                                                            placeholder="Registered office address">{{$user->reg_off_add}}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                        <input type="number" min="0" id="reg_off_pin" readonly
                                                            name="pincode" class="form-control form-control-sm"
                                                            placeholder="Pin Code" value="{{$user->reg_off_pin}}">
                                                            <span id="pincodeMsg" style="color:red;font-weight:bold;display: none"></span>

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_state"
                                                            class="col-form-label col-form-label-sm">State</label>
                                                        <input type="text" class="form-control form-control-sm select-state"
                                                            name="state" id="regAddState"  value="{{$user->reg_off_state}}" readonly>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_city"
                                                            class="col-form-label col-form-label-sm">City</label>
                                                            <input type="text" class="form-control form-control-sm select-state"
                                                            name="city" id="regAddState"  value="{{$user->reg_off_city}}" readonly>
                                                        {{-- <select id="regAddCity" name="city"
                                                            class="form-control form-control-sm select-city">
                                                            <option value="{{$user->reg_off_city}}" selected="selected">{{$user->reg_off_city}}</option>
                                                        </select> --}}
                                                    </div>

                                                </div>
                                                {{-- <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="reg_off_add"
                                                            class="col-form-label col-form-label-sm">Registered Address
                                                        </label>
                                                        <textarea name="reg_address" class="form-control form-control-sm" readonly placeholder="Registered office address">{{ $user->reg_off_add }}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                        <input type="number" name="pincode" readonly
                                                            class="form-control form-control-sm"
                                                            value="{{ $user->reg_off_pin }}">

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_state"
                                                            class="col-form-label col-form-label-sm">State</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="state" id="regAddState"
                                                            value="{{ $user->reg_off_state }}" readonly>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_city"
                                                            class="col-form-label col-form-label-sm">City</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="city" id="regAddState"
                                                            value="{{ $user->reg_off_city }}" readonly>
                                                    </div>

                                                </div> --}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="reg_off_add"
                                                            class="col-form-label col-form-label-sm">Business Office </label>
                                                        <textarea id="reg_off_add" name="co_off_add" class="form-control form-control-sm" readonly
                                                            placeholder="Business office address">{{$user->co_off_add}}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                        <input type="number" min="0" id="reg_off_pin" readonly
                                                            name="co_off_pin" class="form-control form-control-sm"
                                                            placeholder="Pin Code" value="{{$user->co_off_pin}}">
                                                            <span id="pincodeMsg" style="color:red;font-weight:bold;display: none"></span>

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_state"
                                                            class="col-form-label col-form-label-sm">State</label>
                                                        <input type="text" class="form-control form-control-sm select-state"
                                                            name="co_off_state" id="regAddState"  value="{{$user->co_off_state}}" readonly>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_city"
                                                            class="col-form-label col-form-label-sm">City</label>
                                                            <input type="text" class="form-control form-control-sm select-state"
                                                            name="co_off_city" id="regAddState"  value="{{$user->co_off_city}}" readonly>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Borrower's Details <small class="text-danger">(All <span class="text-danger">*</span> fields are mandatory)</small></b>
                        </div>

                        <div class="card border-primary m-2">
                            <div class="card-body mt-4">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            {{-- <tr>
                                                <th>IFSC Code <span class="text-danger">*</span></th>
                                                <td colspan="2">
                                                    <input type="text" id="ifsc_code" name="ifsc_code"    value="{{ $user->ifsc_code }}" class="form-control form-control-sm"
                                                           pattern="^[A-Za-z]{4}\d{7}$"
                                                           title="IFSC code must be 11 characters long: first 4 letters and last 7 digits"
                                                           oninput="validateIFSC()" placeholder="ABCD0123456" required>
                                                    <div id="ifsc-error-message" style="color: red; display: none; font-size: 0.9rem;"></div>
                                                    @error('ifsc_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr> --}}

                                            <script>
                                                function validateIFSC() {
                                                    let ifscCode = document.getElementById("ifsc_code").value.trim();
                                                    let ifscPattern = /^[A-Za-z]{4}\d{7}$/;
                                                    let errorMessage = document.getElementById("ifsc-error-message");

                                                    // Check if the IFSC code matches the pattern
                                                    if (!ifscPattern.test(ifscCode)) {
                                                        errorMessage.innerText = "Invalid IFSC format. It should be 4 letters followed by 7 digits.";
                                                        errorMessage.style.display = "block";
                                                    } else {
                                                        errorMessage.style.display = "none";
                                                    }
                                                }
                                            </script>

                                        <tr>
                                            <th>Email <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="email" name="email"
                                                    value="{{ $user->email }}" class="form-control form-control-sm" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="auth_name" name="auth_name"
                                                    class="form-control form-control-sm"
                                                    value="{{ $user->contact_person }}" required>
                                                @error('auth_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Designation <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="designation" name="designation"
                                                    class="form-control form-control-sm" value="{{ $user->designation }}" required>
                                                @error('designation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mobile <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="mobile" name="mobile"
                                                    class="form-control form-control-sm" value="{{ $user->mobile }}" required>
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Type of Asset Class <span class="text-danger">*</span></th>
                                            <td style="width: 50%;">
                                                <select name="asset_class" id="asset_class" class="form-control form-control-sm" required>
                                                    @foreach ($class_type as $ty)
                                                        <option value="{{ $ty->id }}"
                                                             {{ $ty->id == $financial->first()->class_type_id ? 'selected' : '' }}>
                                                            {{ $ty->name }}</option>
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
                                                <select name="comp_type" id="type" class="form-control form-control-sm comp_det" required>
                                                    @foreach ($type as $ty)
                                                        <option value="{{ $ty->id }}"
                                                            {{ $ty->id == $user->comp_type_id ? 'selected' : '' }}>
                                                            {{ $ty->name }}</option>
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
                                                <select name="sector" id="sector" class="form-control form-control-sm comp_det" required>
                                                    @foreach ($sector as $sec)
                                                        <option value="{{ $sec->id }}"
                                                            {{ $sec->id == $user->sector_id ? 'selected' : '' }}>
                                                            {{ $sec->name }}</option>
                                                    @endforeach
                                                    @error('sector')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bank Zone <span class="text-danger">*</span></th>
                                            <td colspan="2">
                                                <select name="zone" id="zone"
                                                    class="form-control form-control-sm" required>
                                                    {{-- <option value="" disabled selected>Please Select Zone</option> --}}
                                                    @foreach ($zone as $zo)
                                                        <option value="{{ $zo->zone }}"
                                                            {{ $zo->zone == $financial->first()->zone ? 'selected' : '' }}>
                                                            {{ $zo->zone }}</option>
                                                    @endforeach
                                                    @error('zone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Password</th>
                                            <td colspan="2"><input type="text" id="password" name="password"
                                                    class="form-control form-control-sm">
                                                @error('password')
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
                                        @foreach ($financial as $key=>$fin)
                                            <tr>
                                                <th colspan="2" class="text-center">
                                                    {{-- FY- {{$jdecode->data->financials[0]->year}} --}}
                                                    FY {{$fin->fy}}
                                                    <input type="hidden" name="fy[{{$key}}][row_id]" value="{{$fin->id}}">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Rating</th>
                                                <td colspan="2"><input type="text" id="rating" name="fy[{{$key}}][rating]"
                                                        min="0" class="form-control form-control-sm text-right" readonly
                                                        value="{{ $fin->rating }}">
                                                    @error('rating')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Rating Date</th>
                                                <td colspan="2"><input type="date" id="rating_date" name="fy[{{$key}}][rating_date]"
                                                        min="0" class="form-control form-control-sm text-right" readonly
                                                        value="{{ $fin->rating_date }}">
                                                    @error('rating_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Rating Agency</th>
                                                <td colspan="2"><input type="text" id="rating_agency"
                                                        name="fy[{{$key}}][rating_agency]" min="0" readonly
                                                        class="form-control form-control-sm text-right"
                                                        value="{{ $fin->rating_agency }}">
                                                    @error('rating_agency')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Borrowings </th>
                                                <td colspan="2"><input type="number" id="borrowings"
                                                        name="fy[{{$key}}][borrowings]" min="0" readonly
                                                        class="form-control form-control-sm text-right" step="0.01"
                                                        value="{{ number_format($fin->borrowings, 2, '.', '') }}">
                                                    @error('borrowings')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bank Exposure(As on 31 March)  <span class="text-danger">*</span></th>

                                                <td><input type="number" id="bank_exposure" name="fy[{{$key}}][bank_exposure]"
                                                        class="form-control form-control-sm text-right" min="0" step="0.01"
                                                        value="{{ number_format($fin->bank_exposure, 2, '.', '') }}" required>
                                                    @error('bank_exposure')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Total Equity (Net Worth)</th>

                                                <td><input type="number" id="total_equity" name="fy[{{$key}}][total_equity]" step="0.01"
                                                        min="0" class="form-control form-control-sm text-right" readonly
                                                        value="{{ number_format($fin->total_equity, 2, '.', '') }}">
                                                    @error('total_equity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Net Revenue </th>
                                                <td><input type="number" id="net_revenue" name="fy[{{$key}}][net_revenue]" min="0"
                                                        class="form-control form-control-sm text-right" step="0.01" readonly
                                                        value="{{ number_format($fin->net_revenue, 2, '.', '') }}">
                                                    @error('net_revenue')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Profit After Tax </th>
                                                <td><input type="number" id="profit_after_tax" name="fy[{{$key}}][profit_after_tax]"
                                                        min="0" class="form-control form-control-sm text-right" step="0.01" readonly
                                                        value="{{ number_format($fin->profit_after_tax, 2, '.', '') }}">
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
                    <div class="card">
                    <div class="row">
                        <div class="col-md-2 offset-md-3">
                            <button type="submit" id="save_submit"
                               class="btn company-btn btn-primary btn-sm form-control form-control-sm">
                                <em class="fas fa-save"></em>&nbsp; Update
                            </button>
                        </div>
                        </form>

                        <div class="col-md-2 offset-md-0">
                            <form action="{{ route('admin.user.submit') }}" id="final_submit" role="form" method="post"
                                class='fin_prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                                @csrf
                                <button type="submit" id="finalsubmit" @if($user->status=='S') disabled @endif
                                    class="btn company-btn btn-success btn-sm form-control form-control-sm">
                                    <em class="fas fa-save"></em> Submit
                                </button>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

 
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UserRequest', '#user_create') !!}
    {{-- @include('partials.js.prevent_multiple_submit') --}}
    @include('partials.user.pincode-js')

    <script>
        $(document).ready(function() {

            const saveBtn = document.getElementById("save_submit");
            const finalBtn = document.getElementById("finalsubmit");

            $('.det_prevent_multiple_submit').on('submit', function() {
                if ($('.det_msg').length === 0) {
                    $( ".det_prevent_multiple_submit" ).parent().append('<div class="offset-md-4 det_msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>');
                }
                saveBtn.disabled = true;
                setTimeout(function(){saveBtn.disabled = false;}, (1000*20));
                finalBtn.disabled = true;
                setTimeout(function(){finalBtn.disabled = false;}, (1000*20));
                setTimeout(function(){$( ".det_msg" ).hide()}, (1000*20));
            });


            $('.fin_prevent_multiple_submit').on('submit', function() {
                if ($('.det_msg').length === 0) {
                    $('.fin_prevent_multiple_submit').parent().after('<div class="offset-md-4 det_msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>');
                }
                finalBtn.disabled = true;
                setTimeout(function(){finalBtn.disabled = false;}, (1000*20));
                saveBtn.disabled = true;
                setTimeout(function(){saveBtn.disabled = false;}, (1000*20));
                setTimeout(function(){$( ".det_msg" ).hide()}, (1000*20));
            });


            $('.comp_det').on('change', function(e) {
                e.preventDefault(); // Prevent the default action of the change event

                swal({
                    title: "Warning",
                    text: "If you change the Sector or Company Type then all the Input sheet values will be deleted.",
                    icon: "warning",
                    buttons: {
                        cancel: "Cancel",
                        confirm: {
                            text: "Proceed",
                            value: "proceed",
                        },
                    },
                    dangerMode: true,
                    closeOnClickOutside: false,
                })
                // .then((result) => {
                //     if (result === "proceed") {
                //         // If the user confirms, you can proceed with the sector change
                //         // Remove the preventDefault() effect by re-triggering the change event
                //         $(this).off('change').trigger('change');
                //     } else {
                //         // If the user cancels, revert the sector selection (optional)
                //         $(this).val($(this).data('previous'));
                //     }
                // });

                // // Store the previous value to revert if needed
                // $(this).data('previous', $(this).val());
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
 
