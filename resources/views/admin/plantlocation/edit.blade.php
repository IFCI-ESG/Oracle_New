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
    <div class="row">
        <div class="col-lg-10 offset-md-1" style="margin-bottom: 20vh;">
            <form action=" {{ route('user.plant.update', $user->id) }} " id="addForm"
                method="post" enctype="multipart/form-data" class="prevent_multiple_submit">
                @csrf
                @method('patch')
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <div class="card card-success card-outline mt-5"
                    style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                    <div class="card-header">
                        <b> Locations</b>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive rounded col-md-12">
                            <table class="table table-sm table-bordered table-hover" id="company_table">
                                <tbody>
                                    <tr>
                                        <th>
                                            Name of the Company
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
                                                        <span id="" style="color:red;font-weight:bold;display: none"></span>

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
                                                    <label for="co_off_add"
                                                        class="col-form-label col-form-label-sm">Business Office </label>
                                                    <textarea id="co_off_add" name="co_off_add" class="form-control form-control-sm"
                                                        placeholder="Registered office address">{{$user->co_off_add}}</textarea>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="co_off_pin"
                                                        class="col-form-label col-form-label-sm">Pincode</label>
                                                        <input type="number" min="0" id="co_off_pin" name="co_off_pin"
                                                            class="form-control form-control-sm" placeholder="Pin Code"
                                                            onkeyup="GetCityByPinCode('co',this.value)" value="{{$user->co_off_pin}}">
                                                        <span id="pincodeMsg"
                                                            style="color:red;font-weight:bold;display: none"></span>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="co_off_state"
                                                        class="col-form-label col-form-label-sm">State</label>
                                                    <input type="text" class="form-control form-control-sm select-state"
                                                        name="co_off_state" id="coAddState"  value="{{$user->co_off_state}}" readonly>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="co_off_city"
                                                        class="col-form-label col-form-label-sm">City</label>
                                                        <select id="coAddCity" name="co_off_city"
                                                            class="form-control form-control-sm select-city">
                                                            <option value="" selected="selected">{{$user->co_off_city}}</option>
                                                        </select>
                                                        {{-- <input type="text" class="form-control form-control-sm select-state"
                                                        name="co_off_city" id="regAddState"  value="{{$user->co_off_city}}" readonly> --}}
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="Y" name="plant_flag"
                                                class="form-check-input-lg" id="plant_check"
                                                @if ($user->plant_flag == 'Y') checked @endif>
                                            <b>Plant Location, If Available </b>
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
                    url: '{{ url("pincodes")}}/' + pincode,
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

@endsection