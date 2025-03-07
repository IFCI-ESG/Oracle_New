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
            <form action=" {{ route('user.additional_details') }} " id="addForm" method="post"
                enctype="multipart/form-data" class="prevent_multiple_submit">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

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
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_add"
                                                        class="col-form-label col-form-label-sm">Registered Office </label>
                                                    <textarea id="reg_off_add" name="reg_address" class="form-control form-control-sm"
                                                        placeholder="Registered office address"></textarea>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_pin"
                                                        class="col-form-label col-form-label-sm">Pincode</label>
                                                    <input type="number" min="0" id="reg_off_pin" name="pincode"
                                                        class="form-control form-control-sm" placeholder="Pin Code"
                                                        onkeyup="GetCityByPinCode('reg',this.value)">
                                                    <span id="pincodeMsg"
                                                        style="color:red;font-weight:bold;display: none"></span>

                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_state"
                                                        class="col-form-label col-form-label-sm">State</label>
                                                    <input type="text" class="form-control form-control-sm select-state"
                                                        name="state" id="regAddState" readonly>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_city"
                                                        class="col-form-label col-form-label-sm">City</label>
                                                    <select id="regAddCity" name="city"
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

                                    <tr>
                                        <td><input type="checkbox" name="plant_flag" class="form-check-input-lg" id="plant_check"
                                                value="Y">
                                            <span style="font-size: 1rem"><b> Plant Location, If Available </b></span>
                                        </td>
                                    </tr>
                                    <tr class="plant_loc">
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="plant_off_add"
                                                        class="col-form-label col-form-label-sm">Plant
                                                        Address </label>
                                                    <textarea id="plant_off_add" name="plant[0][plnt_address]" class="form-control form-control-sm"
                                                        placeholder="Plant address"></textarea>
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


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-10 offset-md-2">
                        <div class="form-group form-actions">
                            <div class="col-lg-9 col-12 text-center">
                                <button type="submit" class="btn btn-primary" id="submit"> Save As Draft </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!} --}}
    @include('partials.js.prevent_multiple_submit')
    @include('partials.user.pincode-js')
    <script>
        $(document).ready(function() {
            var plantcount = 1;
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

            $('.plant_loc').closest('tr').hide();
            $("#plant_check").on('change', function() {
                var plant = $('#plant_check').is(':checked');
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
                            $("#pincodeMsg1").text('Pincode Not Found');
                            $("#pincodeMsg1").show();

                        } else {
                            $("#pincodeMsg1").hide();
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
    </script>
@endpush
