@extends('layouts.admin.master')
@section('title')
    Add Borrower
@endsection
@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
    <style>
        input[type="file"] {
            padding: 1px;
        }
    </style>
@endpush
@section('content')
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card border-primary m-2" id="result">
                    <div class="card card-success card-outline shadow p-1 text-center">
                        <b>
                            Retail Borrower
                        </b>
                    </div>
                </div>
                <form action="{{ route('admin.retail.apidata') }}" id="user_create" role="form" method="get"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    {{-- <div class="card border-primary m-2"> --}}
                        {{-- <div class="card card-success card-outline shadow p-1">
                            <b>User Details</b>
                        </div> --}}
                        <div class="card border-primary m-2">
                            <div class="card-body mt-4">
                                <table class="table table-sm table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th width="300px">PAN of the Customer</th>
                                            <td><input type="text" id="pan" name="pan" value="{{$pan}}"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <button type="submit" id="submit" style="height: 30px; width: 170px;"
                                                    class="btn btn-primary btn-sm form-control form-control-sm">
                                                    <em class="fa fa-search"></em>&nbsp;&nbsp; Get Details
                                                </button>
                                                {{-- <a href="{{route('admin.user.apidata',$claimMast->id)}}"
                                                    class="btn btn-warning btn-sm btn-block  float-right col-2 mr-2">
                                                    Shareholding <i class="fas fa-arrow-right"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    {{-- </div> --}}
                </form>
                <form action="{{ route('admin.retail.store') }}" id="retail_create" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>
                                Customer's Details
                                {{-- <i class="fa fa-edit"></i> --}}
                                <small class="text-danger">(All <span class="text-danger">*</span> fields are mandatory)</small>
                            </b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Customer Name <span class="text-danger">*</span></th>
                                            <td><input type="text" id="cust_name" name="cust_name" style="width: 70%" class="form-control form-control-sm">
                                                @error('cust_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PAN <span class="text-danger">*</span></th>
                                            <td><input type="text" id="pan" name="pan" class="form-control form-control-sm" style="width: 70%" value="{{$pan}}" readonly>
                                                {{-- <a class="btn btn-primary btn-sm" id="addmore"></i>Click Here to check PAN is Registered</a> --}}
                                                @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Email <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="email" name="email" style="width: 70%" class="form-control form-control-sm">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mobile <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="mobile" name="mobile" style="width: 70%"
                                                    class="form-control form-control-sm">
                                                    @error('mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Type of Asset Class <span class="text-danger">*</span></th>
                                            <td style="width: 70%;">
                                                <select name="asset_class" id="asset_class" class="form-control form-control-sm">
                                                    <option value="" disabled selected>Please Select Class</option>
                                                    @foreach ($class_type as $ty)
                                                        <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                                    @endforeach
                                                    @error('asset_class')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <th>Bank Zone <span class="text-danger">*</span></th>
                                            <td colspan="2">
                                            <select name="zone" id="zone" style="width: 70%" class="form-control form-control-sm">
                                                <option value="" disabled selected>Please Select Zone</option>
                                                @foreach ($zone as $zo)
                                                    <option value="{{ $zo->zone }}">
                                                        {{ $zo->zone }}</option>
                                                @endforeach
                                                @error('zone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="reg_off_add"
                                                            class="col-form-label col-form-label-sm">Address <span class="text-danger">*</span></label>
                                                        <textarea id="reg_off_add" name="address" class="form-control form-control-sm"
                                                            placeholder="Address"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode <span class="text-danger">*</span></label>
                                                        <input type="number" min="0" id="co_off_pin" name="pincode"
                                                            class="form-control form-control-sm" placeholder="Pin Code"
                                                            onkeyup="GetCityByPinCode('co',this.value)">
                                                            <span id="pincodeMsg" style="color:red;font-weight:bold;display: none"></span>

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_state"
                                                            class="col-form-label col-form-label-sm">State </label>
                                                        <input type="text" class="form-control form-control-sm select-state" readonly
                                                            name="state" id="coAddState">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_city"
                                                            class="col-form-label col-form-label-sm">City <span class="text-danger">*</span></label>
                                                            <select id="coAddCity" name="city"
                                                                class="form-control form-control-sm select-city">
                                                                <option value="" selected="selected">Please choose..</option>
                                                            </select>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary m-2">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Financial Year Wise Details (In Rupees) <i class="fa fa-edit"></i></b>
                            {{-- <div class="col-md-3 offset-md-6">
                                <a class="btn btn-success btn-sm float-right mb-2" id="addmore">
                                    <i class="fa fa-plus"></i> Add New Asset Class</a>
                            </div> --}}
                        </div>

                        <div class="card border-primary m-2">
                            <div class="card-body">
                                <table class="table table-sm table-striped table-hover" id="financials_table">
                                    <tbody>
                                        <tr>
                                            <th class="text-right">
                                                FY {{$fys->fy}}
                                                <input type="hidden" name="fy[0][fy_id]" value="{{$fys->id}}">
                                            </th>
                                            <th class="text-right">
                                                <a class="btn btn-success btn-sm" id="addmore"><i class="fa fa-plus"></i> Add New Asset Class</a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Type of Asset Class <span class="text-danger">*</span></th>
                                            <td>
                                                <select name="fy[0][asset_class]" id="asset_class" style="width: 70%" class="form-control form-control-sm">
                                                    <option value="" disabled selected>Please Select Class</option>
                                                    @foreach ($class_type as $ty)
                                                        <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                                    @endforeach
                                                    @error('asset_class')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bank Exposure(As on 31 March)</th>
                                            <td><input type="number" id="fy[0][bank_exposure]" name="fy[0][bank_exposure]" step="0.01"
                                                    class="form-control form-control-sm text-right" style="width: 70%" min="0">
                                                    @error('bank_exposure')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Value of the Asset</th>
                                            <td><input type="number" id="fy[0][value_asset]" name="fy[0][value_asset]" step="0.01"
                                                    class="form-control form-control-sm text-right" min="0" style="width: 70%">
                                                    @error('value_asset')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Loan Tenure</th>
                                            <td><input type="number" id="fy[0][loan_tenure]" name="fy[0][loan_tenure]" step="0.01"
                                                    class="form-control form-control-sm text-right" min="0" style="width: 70%">
                                                    @error('loan_tenure')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                        {{-- @foreach ($fys as $key=>$fy)
                                            <tr>
                                                <th colspan="2" class="text-center">
                                                    FY {{$fy->fy}}
                                                    <input type="hidden" name="fy[{{$key}}][fy_id]" value="{{$fy->id}}">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Bank Exposure(As on 31 March)</th>
                                                <td><input type="number" id="fy[{{$key}}][bank_exposure]" name="fy[{{$key}}][bank_exposure]" step="0.01"
                                                        class="form-control form-control-sm text-right" min="0">
                                                        @error('bank_exposure')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Value of the Asset</th>
                                                <td><input type="number" id="fy[{{$key}}][value_asset]" name="fy[{{$key}}][value_asset]" step="0.01"
                                                        class="form-control form-control-sm text-right" min="0">
                                                        @error('value_asset')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Loan Tenure</th>
                                                <td><input type="number" id="fy[{{$key}}][loan_tenure]" name="fy[{{$key}}][loan_tenure]" step="0.01"
                                                        class="form-control form-control-sm text-right" min="0">
                                                        @error('loan_tenure')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row pb-3">
                        <div class="col-md-2 ml-4">
                            <a href="{{ route('admin.retail.adduser') }}"
                            class="btn btn-warning btn-sm float-left"> <i
                                class="fas fa-arrow-left"></i> Back </a>
                        </div>

                        <div class="col-md-2 offset-md-2">
                            <button type="submit" id="submit"
                                class="btn btn-primary btn-sm form-control form-control-sm">
                                <em class="fas fa-save"></em>&nbsp; Save as Draft
                            </button>
                        </div>
                        <div class="col-md-2 offset-md-0">
                            <button disabled id="final"
                                class="btn btn-primary btn-sm form-control form-control-sm">
                                &nbsp; Submit
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\RetailRequest', '#retail_create') !!}
    {{-- @include('partials.js.prevent_multiple_submit') --}}
    @include('partials.user.pincode-js')
    <script>
        $(document).ready(function () {
            const subBtn = document.getElementById("submit");
            // const finalBtn = document.getElementById("final");
            $('.prevent_multiple_submit').on('submit', function() {
                if ($('.msg').length === 0) {
                    $( ".prevent_multiple_submit" ).parent().append('<div class="offset-md-4 msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>');
                }
                subBtn.disabled = true;
                setTimeout(function(){subBtn.disabled = false;}, (1000*20));
                setTimeout(function(){$( ".msg" ).hide()}, (1000*20));
                });


            var fyCount = 1;
            $('#addmore').click(function() {
                $('#financials_table').append(
                    `<tr class="fy-section">
                        <th class="text-right">FY <span id="fy_label_`+fyCount+`">{{$fys->fy}}</span>
                            <input type="hidden" name="fy[`+fyCount+`][fy_id]" value="{{$fys->id}}">
                        </th>
                        <th class="text-right">
                            <a class="btn btn-danger btn-sm float-right mb-2 remove"> <i class="far fa-trash-alt"></i> Remove</a>
                        </th>
                    </tr>
                    <tr class="fy-section">
                        <th>Type of Asset Class <span class="text-danger">*</span></th>
                        <td>
                            <select name="fy[`+fyCount+`][asset_class]" id="asset_class_`+fyCount+`" class="form-control form-control-sm" style="width: 70%">
                                <option value="" disabled selected>Please Select Class</option>
                                @foreach ($class_type as $ty)
                                    <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                @endforeach
                                @error('asset_class')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </td>
                    </tr>

                    <tr class="fy-section">
                        <th>Bank Exposure(As on 31 March)</th>
                        <td>
                            <input type="number" id="fy_`+fyCount+`_bank_exposure" name="fy[`+fyCount+`][bank_exposure]" step="0.01"
                                class="form-control form-control-sm text-right" min="0" style="width: 70%">
                            @error('bank_exposure')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr class="fy-section">
                        <th>Value of the Asset</th>
                        <td>
                            <input type="number" id="fy_`+fyCount+`_value_asset" name="fy[`+fyCount+`][value_asset]" step="0.01"
                                class="form-control form-control-sm text-right" min="0" style="width: 70%">
                            @error('value_asset')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr class="fy-section">
                        <th>Loan Tenure</th>
                        <td>
                            <input type="number" id="fy_`+fyCount+`_loan_tenure" name="fy[`+fyCount+`][loan_tenure]" step="0.01"
                                class="form-control form-control-sm text-right" min="0" style="width: 70%">
                            @error('loan_tenure')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>`
                );

                fyCount++;

            });

            // Use event delegation to bind the click event for dynamically added .remove buttons
            $('#financials_table').on('click', '.remove', function() {
                // Remove the current row and the 5 rows before it
                $(this).closest('tr').nextAll('.fy-section').addBack().slice(0, 5).remove();
            });

        });


    </script>
@endpush


