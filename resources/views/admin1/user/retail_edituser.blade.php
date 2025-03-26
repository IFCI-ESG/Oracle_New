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
                <form action="{{ route('admin.retail.update') }}" id="retail_update" role="form" method="post"
                    class='det_prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div id="result"></div>
                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Customer's Details <small class="text-danger">(All <span class="text-danger">*</span> fields are mandatory)</small></b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Customer Name <span class="text-danger">*</span></th>
                                            <td><input type="text" id="cust_name" name="cust_name"
                                                    value="{{ $user->name }}" class="form-control form-control-sm"
                                                    style="width: 70%" >
                                                @error('cust_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PAN <span class="text-danger">*</span></th>
                                            <td><input type="text" id="pan" name="pan"
                                                    value="{{ $user->pan }}" class="form-control form-control-sm"
                                                    style="width: 70%" >
                                                @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="email" name="email" style="width: 70%"
                                                    value="{{ $user->email }}" class="form-control form-control-sm">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mobile <span class="text-danger">*</span></th>
                                            <td colspan="2"><input type="text" id="mobile" name="mobile" style="width: 70%"
                                                    class="form-control form-control-sm" value="{{ $user->mobile }}">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bank Zone <span class="text-danger">*</span></th>
                                            <td colspan="2">
                                                <select name="zone" id="zone" style="width: 70%"
                                                    class="form-control form-control-sm">
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
                                        <tr>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="co_off_add"
                                                            class="col-form-label col-form-label-sm">Address </label>
                                                        <textarea id="co_off_add" name="address" class="form-control form-control-sm"
                                                            placeholder="Address">{{$user->reg_off_add}}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="co_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                            <input type="number" min="0" id="co_off_pin" name="pincode"
                                                                class="form-control form-control-sm" placeholder="Pin Code"
                                                                onkeyup="GetCityByPinCode('co',this.value)" value="{{$user->reg_off_pin}}">
                                                            <span id="pincodeMsg"
                                                                style="color:red;font-weight:bold;display: none"></span>

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="co_off_state"
                                                            class="col-form-label col-form-label-sm">State</label>
                                                        <input type="text" class="form-control form-control-sm select-state"
                                                            name="state" id="coAddState"  value="{{$user->reg_off_state}}" readonly>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="co_off_city"
                                                            class="col-form-label col-form-label-sm">City</label>
                                                            <select id="coAddCity" name="city"
                                                                class="form-control form-control-sm select-city">
                                                                <option value="{{$user->reg_off_city}}" selected="selected">{{$user->reg_off_city}}</option>
                                                            </select>
                                                            {{-- <input type="text" class="form-control form-control-sm select-state"
                                                            name="co_off_city" id="regAddState"  value="{{$user->co_off_city}}" readonly> --}}
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
                            <b>Financial Year Wise Details (In Rupees) <i class="fa fa-edit"></i></b>
                        </div>

                        <div class="card border-primary m-2">
                            <div class="card-body">
                                <table class="table table-sm table-striped table-hover" id="financials_table">
                                    <tbody>
                                        @foreach ($financial as $key => $fin)
                                            <tr>
                                                <th class="text-right">
                                                    FY {{$fin->fy}}
                                                    <input type="hidden" name="fy[{{$key}}][row_id]" value="{{$fin->id}}">
                                                </th>
                                                @if ($key > 0)
                                                    <th class="text-right">
                                                        {{-- <a class="btn btn-danger btn-sm float-right mb-2"
                                                            onclick="deleteRow({{ $fin->id }})"> <i
                                                                class="far fa-trash-alt"></i> Remove</a> --}}
                                                    </th>
                                                @else
                                                    <th class="text-right">
                                                        <a class="btn btn-success btn-sm" id="addmore"><i class="fa fa-plus"></i> Add New Asset Class</a>
                                                    </th>
                                                @endif

                                            </tr>
                                            <tr>
                                                <th>Type of Asset Class <span class="text-danger">*</span></th>
                                                <td>
                                                    <select name="fy[{{$key}}][asset_class]" id="asset_class" style="width: 70%" class="form-control form-control-sm asset_class">
                                                        @foreach ($class_type as $ty)
                                                            <option value="{{ $ty->id }}" {{$ty->id == $fin->class_type_id ? 'selected' : ''}}>{{ $ty->name }}</option>
                                                        @endforeach
                                                        @error('asset_class')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bank Exposure(As on 31 March)</th>
                                                <td><input type="number" id="fy[{{$key}}][bank_exposure]" name="fy[{{$key}}][bank_exposure]" step="0.01"
                                                        class="form-control form-control-sm text-right" style="width: 70%" min="0" value="{{$fin->bank_exposure}}">
                                                        @error('bank_exposure')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Value of the Asset</th>
                                                <td><input type="number" id="fy[{{$key}}][value_asset]" name="fy[{{$key}}][value_asset]" step="0.01"
                                                        class="form-control form-control-sm text-right" min="0" style="width: 70%"  value="{{$fin->value_asset}}">
                                                        @error('value_asset')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Loan Tenure</th>
                                                <td><input type="number" id="fy[{{$key}}][loan_tenure]" name="fy[{{$key}}][loan_tenure]" step="0.01"
                                                        class="form-control form-control-sm text-right" min="0" style="width: 70%"  value="{{$fin->loan_tenure}}">
                                                        @error('loan_tenure')
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

                    <br>

                    <div class="row pb-3">
                        <div class="col-md-2 offset-md-0">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-arrow-left"></i>
                                Back </a>
                        </div>

                        <div class="col-md-2 offset-md-2">
                            <button type="submit" id="save_submit"
                                class="btn btn-primary btn-sm form-control form-control-sm">
                                <em class="fas fa-save"></em>&nbsp; Update
                            </button>
                        </div>
                </form>

                        <div class="col-md-2 offset-md-0">
                            <form action="{{ route('admin.retail.submit') }}" id="final_submit" role="form" method="post"
                                class='fin_prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                                @csrf
                                <button type="submit" id="finalsubmit" @if($user->status=='S') disabled @endif
                                    class="btn btn-primary btn-sm form-control form-control-sm">
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
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\RetailRequest', '#retail_update') !!}
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


            var fyCount = {{ count($financial) }};
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

            $('.asset_class').on('change', function(e) {
                e.preventDefault(); // Prevent the default action of the change event

                swal({
                    title: "Warning",
                    text: "If you change the Asset Class then all the data related to this class will be deleted.",
                    icon: "warning",
                    buttons: {
                        // cancel: "Cancel",
                        confirm: {
                            text: "OK",
                            value: "proceed",
                        },
                    },
                    dangerMode: true,
                    closeOnClickOutside: false,
                })
            });


        });

        function deleteRow(row_id)
        {
            swal({
                    title: "Do You Want to Delete this Record",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: {
                            text: "Yes",
                            value: "Y",
                        },
                    },
                    dangerMode: true,
                    closeOnClickOutside: false,
                })
                .then((result) => {
                    if (result == 'Y') {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: '../row_delete/' + row_id + '/plant',
                            success: function(data) {
                                // console.log(data);
                                if (data == true) {
                                    swal(
                                        'Deleted!',
                                        'Your record has been deleted.',
                                        'success')
                                    window.location.reload();
                                } else {
                                    swal(
                                        'Not Deleted!',
                                        'Your record has not been Deleted.',
                                        'warning')

                                }
                            }
                        })
                    }
                });
        }

    </script>
@endpush
