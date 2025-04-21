@extends('layouts.user.dashboard-master')
@section('title')
    Additional Details
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
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <br>
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- ContentStarts --}}
    <div class="row">
        <div class="col-lg-10 offset-md-1">
            <form action=" {{ route('user.additional_details.update', $additional->user_id) }} " id="addForm"
                method="post" enctype="multipart/form-data" class="prevent_multiple_submit">
                @csrf
                @method('patch')
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="additional_id" id="additional_id" class="form-control form-control-sm"
                    value="{{ $additional->id }}">
                <div class="card card-success card-outline mt-5"
                    style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                    <div class="card-header">
                        <b> 1. Company Details / Project Information</b>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive rounded col-md-12">
                            <table class="table table-sm table-bordered table-hover" id="company_table">
                                <tbody>
                                    <tr>
                                        <th>
                                            Name of the Applicant / Company
                                        </th>
                                        <td style="font-size: 1rem">
                                            {{ Auth::user()->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CIN</th>
                                        <td style="font-size: 1rem">{{ Auth::user()->cin_llpin }}</td>
                                    </tr>
                                    <tr>
                                        <th>What is the total number of Permanent Employees ? </th>
                                        <td>
                                            <input type="number" id="per_employee" name="per_employee"
                                                class="form-control form-control-sm" style="width:50%"
                                                value="{{ $additional->per_employee }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>What is the total number of Temporary Employees ? </th>
                                        <td>
                                            <input type="number" name="temp_employee" id="temp_employee" style="width:50%"
                                                class="form-control form-control-sm valid"
                                                value="{{ $additional->temp_employee }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>What is the total production capacity of company ? </th>
                                        <td>
                                            <input type="text" name="prod_capacity" id="prod_capacity" style="width:50%"
                                                class="form-control form-control-sm valid"
                                                value="{{ $additional->prod_capacity }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_add"
                                                        class="col-form-label col-form-label-sm">Registered Office </label>
                                                    <textarea id="reg_off_add" name="reg_address" class="form-control form-control-sm"
                                                        placeholder="Registered office address">{{ $additional->reg_address }}</textarea>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_pin"
                                                        class="col-form-label col-form-label-sm">Pincode</label>
                                                    <input type="number" min="0" id="reg_off_pin" name="pincode"
                                                        class="form-control form-control-sm" placeholder="Pin Code"
                                                        value="{{ $additional->pincode }}"
                                                        onkeyup="GetCityByPinCode('reg',this.value)">
                                                    <span id="pincodeMsg"
                                                        style="color:red;font-weight:bold;display: none"></span>

                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_state"
                                                        class="col-form-label col-form-label-sm">State</label>
                                                    <input type="text" class="form-control form-control-sm select-state"
                                                        name="state" id="regAddState" value="{{ $additional->state }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_city"
                                                        class="col-form-label col-form-label-sm">City</label>
                                                    <select id="regAddCity" name="city"
                                                        class="form-control form-control-sm select-city">
                                                        <option value="{{ $additional->city }}" selected="selected">
                                                            {{ $additional->city }}</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="Y" name="plant_flag"
                                                class="form-check-input-lg" id="plant_check"
                                                @if ($additional->plant_flag == 'Y') checked @endif>
                                            <b>Wheather, Plant location </b>
                                        </td>
                                    </tr>

                                    @if (sizeof($plantlocation) != 0)
                                        @foreach ($plantlocation as $key => $plant)
                                            {{-- {{dd($plant)}} --}}
                                            <input type="hidden" name="plant[{{ $key }}][row_id]" id="row_id"
                                                class="form-control form-control-sm" value="{{ $plant->id }}">
                                            <tr class="plant_loc">
                                                <td colspan="2">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="plant_off_add"
                                                                class="col-form-label col-form-label-sm">Plant
                                                                Address </label>
                                                            <textarea id="plant_off_add" name="plant[{{ $key }}][plnt_address]" class="form-control form-control-sm">{{ $plant->plnt_address }}</textarea>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="plant_off_pin"
                                                                class="col-form-label col-form-label-sm">Pincode</label>
                                                            <input type="number" min="0" id="plant_off_pin"
                                                                name="plant[{{ $key }}][plnt_pincode]"
                                                                class="form-control form-control-sm"
                                                                onkeyup="GetCityByPinCode1('plant',this.value, {{ $key }})"
                                                                value="{{ $plant->plnt_pincode }}">
                                                            <span id="pincodeMsg{{ $key }}"
                                                                style="color:red;font-weight:bold;display: none"></span>

                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="plant_off_state"
                                                                class="col-form-label col-form-label-sm">State</label>
                                                            <input type="text"
                                                                class="form-control form-control-sm select-state"
                                                                name="plant[{{ $key }}][plnt_state]"
                                                                id="plantAddState{{ $key }}"
                                                                value="{{ $plant->plnt_state }}" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="plant_off_city"
                                                                class="col-form-label col-form-label-sm">City</label>
                                                            <select id="plantAddCity{{ $key }}"
                                                                name="plant[{{ $key }}][plnt_city]"
                                                                class="form-control form-control-sm select-city">
                                                                {{-- <option value="" selected="selected">Please choose.. --}}
                                                                <option value="{{ $plant->plnt_city }}"
                                                                    selected="selected">
                                                                    {{ $plant->plnt_city }}</option>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if ($key > 0)
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-sm float-right mb-2"
                                                        onclick="deleteRow({{ $plant->id }})"> <i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <a class="btn btn-success btn-sm float-right mb-2" id="addmore">
                                                        <i class="fa fa-plus"></i> Add Row</a>
                                                </td>
                                        @endif

                                        </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="plant_loc">
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="plant_off_add"
                                                        class="col-form-label col-form-label-sm">Plant
                                                        Address </label>
                                                    <textarea id="plant_off_add" name="plant[0][plnt_address]" class="form-control form-control-sm"
                                                        placeholder="plant address"></textarea>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="plant_off_pin"
                                                        class="col-form-label col-form-label-sm">Pincode</label>
                                                    <input type="number" min="0" id="plant_off_pin"
                                                        name="plant[0][plnt_pincode]" class="form-control form-control-sm"
                                                        placeholder="Pin Code"
                                                        onkeyup="GetCityByPinCode1('plant',this.value, 0)">
                                                    <span id="pincodeMsg0"
                                                        style="color:red;font-weight:bold;display: none"></span>

                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="plant_off_state"
                                                        class="col-form-label col-form-label-sm">State</label>
                                                    <input type="text"
                                                        class="form-control form-control-sm select-state"
                                                        name="plant[0][plnt_state]" id="plantAddState0" readonly>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="plant_off_city"
                                                        class="col-form-label col-form-label-sm">City</label>
                                                    <select id="plantAddCity0" name="plant[0][plnt_city]"
                                                        class="form-control form-control-sm select-city">
                                                        <option value="" selected="selected">Please choose..
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        <th>
                                            <a class="btn btn-success btn-sm float-right mb-2" id="addmore">
                                                <i class="fa fa-plus"></i> Add Row</a>
                                        </th>
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-10 offset-md-2">
                        <div class="form-group form-actions">
                            <div class="col-lg-9 col-12 text-center">
                                <button type="submit" class="btn btn-primary" id="submit"> Update </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#addForm') !!}
    @include('partials.js.prevent_multiple_submit')
    @include('partials.user.pincode-js')


    <script>
        $(document).ready(function() {
            if ({{ count($plantlocation) }} == 0) {
                var plantcount = 1;
            } else {
                var plantcount = {{ count($plantlocation) }};
            }
            $('#addmore').click(function() {
                $('#company_table').append(
                    '<tr class="plant_loc"><td colspan="2"><div class="row"><div class="form-group col-md-3">' +
                    '<label for="plant_off_add" class="col-form-label col-form-label-sm">Plant Address</label>' +
                    '<textarea id="plant_off_add" name="plant[' + plantcount +
                    '][plnt_address]" class="form-control form-control-sm" placeholder="Plant address"></textarea>' +
                    '</div><div class="form-group col-md-3">' +
                    '<label for="plant_off_pin" class="col-form-label col-form-label-sm">Pincode</label>' +
                    '<input type="number" min="0" id="plant_off_pin" name="plant[' + plantcount +
                    '][plnt_pincode]" class="form-control form-control-sm" placeholder="Pin Code" onkeyup="GetCityByPinCode1(`plant`,this.value,' +
                    plantcount + ')">' +
                    '<span id="pincodeMsg' + plantcount +
                    '" style="color:red;font-weight:bold;display: none"></span></div>' +
                    '<div class="form-group col-md-3"><label for="plant_off_state" class="col-form-label col-form-label-sm">State</label>' +
                    '<input type="text" class="form-control form-control-sm select-state" name="plant[' +
                    plantcount + '][plnt_state]" id="plantAddState' + plantcount + '" readonly></div>' +
                    '<div class="form-group col-md-3"><label for="plant_off_city" class="col-form-label col-form-label-sm">City</label><select id="plantAddCity' +
                    plantcount + '" name="plant[' + plantcount +
                    '][plnt_city]" class="form-control form-control-sm select-city"><option value="" selected="selected">Please choose..</option></select> ' +
                    '</div></div><th><a class="btn btn-danger btn-sm float-right mb-2 remove"> <i class="far fa-trash-alt"></i></a>' +
                    '</th></td></tr>'
                );

                plantcount++;
            });

            $("#company_table").on('click', '.remove', function() {
                $(this).parent().parent().remove();
            });

            if ({{ count($plantlocation) }} == 0) {
                $('.plant_loc').closest('tr').hide();
            }
            $("#plant_check").on('change', function() {
                var plant = $('#plant_check').is(':checked');
                // alert(plant);
                if (plant) {
                    $('.plant_loc').closest('tr').show();
                } else {
                    $('.plant_loc').closest('tr').hide();
                }
            });

        });


        function GetCityByPinCode1(name, pincode, key) {
            console.log(name + pincode + key);
            var state = '#' + name + 'AddState' + key;
            var city = '#' + name + 'AddCity' + key;
            // var district = '#' + name + 'AddDistrict';
            var pinmsg = '#' + 'pincodeMsg' + key;

            if (pincode.length != 6) {
                $(pinmsg).text('Pincode Incorrect!');
                $(pinmsg).show();
                $(state).val('');
                $(city).val('');
                // $(district).val('');
            }
            if (pincode.length == 6 && $.isNumeric(pincode)) {
                $.ajax({
                    url: '/pincodes/' + pincode,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data.state.length);
                        if (data.state.length == 0) {
                            // alert('g');
                            $(pinmsg).text('Pincode Not Found');
                            $(pinmsg).show();

                        } else {
                            $(pinmsg).hide();
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


        function deleteRow(row_id) {
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
                                console.log(data);
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
