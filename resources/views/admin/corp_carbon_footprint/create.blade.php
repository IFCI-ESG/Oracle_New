@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.shared.page-title', ['title' => 'Carbon Footprint', 'subtitle' => 'Environment'])
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
            <div class="col-lg-10 offset-md-1">
                <form action="{{ route('admin.corp_activity.store') }}" id="activity" role="form" method="post"
                    class='form-horizontal busi_prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="fy_id" value="{{ $fy_id }}">
                    <input type="hidden" name="com_id" value="{{ Auth::user()->id }}">
                    <div class="card card-success card-outline mt-5 ml-2"
                        style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                        <div class="card-header">
                            <b>Business Activity </b>
                        </div>
                        <div class="card">
                            <div class="card-body p-1 m-2">
                                {{-- <div class="row ">
                                <div class="table-responsive rounded col-md-12"> --}}
                                <table class="table table-hover table-sm table-striped" id="appTable" style="width: 100%">
                                    <thead>
                                        <tr class="text-center table-environment">
                                            <th class="">Sr. No.</th>
                                            <th class="">Activity</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($busi_value->isEmpty())
                                            @foreach ($busi_mast->where('status', '1') as $key => $busi)
                                                <tr>
                                                    <td class="text-center" style="font-size: 1rem">
                                                        <b>{{ $key + 1 }}</b></td>
                                                    <td style="font-size: 1rem">
                                                        {{ $busi->activity }}
                                                        <input type="hidden" name="business[{{ $key }}][part_id]"
                                                            value="{{ $busi->id }}">
                                                    </td>
                                                    <td class="text-center">
                                                        <label>
                                                            <input type="checkbox" class="business_check"
                                                                name="business[{{ $key }}][check]">
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($busi_value as $key => $busi)
                                                <tr>
                                                    <td class="text-center" style="font-size: 1rem">
                                                        <b>{{ $key + 1 }}</b></td>
                                                    <td style="font-size: 1rem">
                                                        {{ $busi->activity }}
                                                        {{-- <input type="hidden" name="business[{{$key}}][row_id]" value="{{$busi->id}}"> --}}
                                                    </td>
                                                    <td class="text-center">
                                                        <label>
                                                            <input type="checkbox"
                                                                name="business[{{ $key }}][check]" disabled
                                                                @if ($busi->is_checked) checked @endif>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{-- </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    @if ($busi_value->isEmpty())
                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 offset-md-5">
                                <button type="submit" id="busi_submit"
                                    class="btn btn-primary btn-sm form-control form-control-sm"><i class="fas fa-save"></i>
                                    Submit</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="container  py-4 px-2 col-lg-10">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    {{-- <form action="{{ route('user.data.store') }}" id="questions" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf --}}

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="environment-tab" data-toggle="pill" href="#environment"
                                        role="tab" aria-controls="environment"
                                        aria-selected="true"><b>{{ $sector->name }} Sector Carbon Footprint Data For
                                            FY-{{ $fys->fy }}</b></a>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('user.questionnaire.quality_store') }}" id="" role="form"
                            method="post" class='form-horizontal prevent_multiple_submit' files=true
                            enctype='multipart/form-data' accept-charset="utf-8">
                            @csrf
                            <input type="hidden" value="{{ $fy_id }}" name="fy_id">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="com_id">
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="environment" role="tabpanel"
                                        aria-labelledby="environment-tab">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                @php
                                                    if ($seg_tot > 0) {
                                                        $percentage = ($ques_tot / $seg_tot) * 100;
                                                    } else {
                                                        $percentage = 0;
                                                    }
                                                @endphp
                                                <h5 class="text-center">Progress</h5> <br>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                        role="progressbar" aria-valuenow="{{ $percentage }}"
                                                        aria-valuemin="0" aria-valuemax="100"
                                                        style="width: {{ $percentage }}%">
                                                        {{ number_format($percentage, 2) }}%</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <table class="table table-hover table-striped " id="env-table">
                                                    <thead>
                                                        <tr class="table-environment">
                                                            <th style="width: 10%" class="text-center">
                                                                Sr. No.
                                                            </th>
                                                            <th style="width: 20%" class="text-center">
                                                                Scope
                                                            </th>
                                                            <th style="width: 15%" class="text-center">
                                                                Particulars
                                                            </th>
                                                            <th style="width: 20%" class="text-center">
                                                                Action
                                                            </th>
                                                            <th style="width: 20%" class="text-center">
                                                                Data Quality
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($scope_mast as $key => $scope)
                                                            @foreach ($seg_mast->where('status', '1')->where('scopeid',$scope->id) as $key => $seg)
                                                                <tr>
                                                                    <td class="text-center">
                                                                        {{ $key + 1 }}
                                                                    </td>
                                                                    <td class="text-center" style="font-size: 1rem;">
                                                                        {{ $seg->scope_name }}
                                                                    </td>
                                                                    <td style="font-size: 1rem;">
                                                                        {{ $seg->label }}
                                                                        <input type="hidden" value="{{ $seg->id }}"
                                                                            name="part[{{ $key }}][seg_id]">
                                                                    </td>
                                                                    @if (!$busi_value->isEmpty())
                                                                        @if ($ques_value->where('segment_id', $seg->id)->where('fy_id', $fy_id)->isNotEmpty())
                                                                            <td class="text-center test1"
                                                                                data_seg_id={{ $seg->id }}
                                                                                data_comp_id="{{ Auth::user()->id }}"
                                                                                ques_data="{{ $seg->label }}"
                                                                                data_fy_id="{{ $fy_id }}">
                                                                                <a class="btn btn-primary btn-sm ShowRow"
                                                                                    data-toggle="modal"
                                                                                    data-target="#ViewModalCenter">
                                                                                    <i class="fa fa-eye"></i>View</a>
                                                                            </td>
                                                                        @else
                                                                            <td class="text-center test"
                                                                                data_seg_id={{ $seg->id }}
                                                                                ques_data="{{ $seg->label }}"
                                                                                data_sector_id="{{ Auth::user()->sector_id }}">
                                                                                <a class="btn btn-primary btn-sm ShowRow"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModalCenter">
                                                                                    <i class="fa fa-plus"></i>&nbsp;&nbsp;
                                                                                    Add</a>
                                                                            </td>
                                                                        @endif
                                                                        @if (!$data_qual_value->isEmpty())
                                                                            <td>
                                                                                <input type="hidden"
                                                                                    value="{{ $data_qual_value->where('segment_id', $seg->id)->first()->id }}"
                                                                                    name="part[{{ $key }}][row_id]">
                                                                                <select
                                                                                    name="part[{{ $key }}][data_quality_id]"
                                                                                    id="quality"
                                                                                    class="form-control form-control-sm">
                                                                                    @foreach ($data_quality as $data)
                                                                                        <option value="{{ $data->id }}"
                                                                                            {{ $data->id == $data_qual_value->where('segment_id', $seg->id)->first()->data_quality_id ? 'selected' : '' }}>
                                                                                            {{ $data->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                        @else
                                                                            <td>
                                                                                <select
                                                                                    name="part[{{ $key }}][data_quality_id]"
                                                                                    id="quality"
                                                                                    class="form-control form-control-sm">
                                                                                    <option value="" disabled selected>
                                                                                        Quality</option>
                                                                                    @foreach ($data_quality as $data)
                                                                                        <option value="{{ $data->id }}">
                                                                                            {{ $data->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                        @endif
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- {{dd($bank_details);}} --}}
                            <div class="row pb-2 mt-2 d-flex align-items-center">
                                <div class="col-md-2 ml-4">
                                    <a href="{{ route('admin.corp_carbon') }}"
                                        class="btn btn-warning btn-sm float-left"> <i class="fas fa-arrow-left"></i>
                                        Back </a>
                                </div>

                                <div class="col-md-2 offset-md-2">
                                    @if (!$busi_value->isEmpty())
                                        <button type="submit" id="final_submit"
                                            class="btn btn-primary btn-sm form-control form-control-sm"><i
                                                class="fas fa-save"></i>
                                            @if (!$data_qual_value->isEmpty())
                                                Update
                                            @else
                                                Save as Draft
                                            @endif
                                        </button>
                                    @endif

                                </div>
                                <div class="col-md-2 offset-md-2">
                                    @if (!$data_qual_value->isEmpty())
                                        <a class="btn btn-primary m-2 btn-sm form-control form-control-sm"
                                            href="{{ route('user.print_preview', ['com_id' => encrypt(Auth::user()->id), 'fy_id' => encrypt($fy_id), 'bank_id' => encrypt($bank_details->bank_id), 'class_type' => encrypt($bank_details->class_type_id)]) }}">
                                            Submit</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        <div class="container py-4 px-4 col-lg-10"
            style="background-color: #f9fafc; border: 1px solid #d1d5db; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
            <h5 style="color: #1f2937; font-weight: bold; margin-bottom: 10px;">🌍 Data Quality Index</h5>
            <p style="line-height: 1.6; color: #4b5563;">
                <span style="font-weight: bold;">Level 1</span> - Verified emissions data<br>
                <span style="font-weight: bold;">Level 2</span> - Non-verified GHG emissions data or real primary energy
                data<br>
                <span style="font-weight: bold;">Level 3</span> - Emissions calculated using primary physical activity data
                of the company’s production and emission factors specific to that primary data<br>
                <span style="font-weight: bold;">Level 4</span> - Estimate emissions based on sector and revenue<br>
                <span style="font-weight: bold;">Level 5</span> - Emissions based on national-level proxy data
            </p>
        </div>
        <br>
    {{-- @push('scripts') --}}
        {{-- {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#user_store') !!}
        {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#user_update') !!} --}}
        {{-- {!! JsValidator::formRequest('App\Http\Requests\User\DataRequest', '#data_store') !!} --}}
        {{-- @include('partials.js.prevent_multiple_submit') --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @include('admin.partials.carbon.popup')
        @include('admin.partials.carbon.popup_view')

        <script>
            $(document).ready(function() {

                $('#activity').on('submit', function(e) {
                    // Check if at least one checkbox is checked
                    // alert($('.business_check:checked').length);
                    if ($('.business_check:checked').length === 0) {
                        alert('Please check at least one checkbox.');
                        e.preventDefault(); // Prevent form submission
                    }

                    var confirmation = confirm('You cannot revert the changes. Do you want to continue?');
                    if (!confirmation) {
                        event.preventDefault();
                    }
                });


                $('#user_store').on('submit', function(e) {
                    // Check if at least one checkbox is checked
                    // alert($('input[type="checkbox"]:checked').length);
                    if ($('.first:checked').length === 0) {
                        alert('Please check at least one checkbox.');
                        e.preventDefault(); // Prevent form submission
                    }
                });

                $('#user_update').on('submit', function(e) {
                    // Check if at least one checkbox is checked
                    // alert($('input[type="checkbox"]:checked').length);
                    if ($('.second:checked').length === 0) {
                        alert('Please check at least one checkbox.');
                        e.preventDefault(); // Prevent form submission
                    }
                });


                const busiBtn = document.getElementById("busi_submit");

                $('.busi_prevent_multiple_submit').on('submit', function() {
                    if ($('.busi_msg').length === 0) {
                        $(".busi_prevent_multiple_submit").parent().append(
                            '<div class="offset-md-4 busi_msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>'
                            );
                    }
                    busiBtn.disabled = true;
                    setTimeout(function() {
                        busiBtn.disabled = false;
                    }, (1000 * 20));
                    setTimeout(function() {
                        $(".busi_msg").hide()
                    }, (1000 * 20));
                });



                const popBtn = document.getElementById("pop_submit");
                const popClose = document.getElementById("pop_close");

                $('.pop_prevent_multiple_submit').on('submit', function() {
                    if ($('.pop_msg').length === 0) {
                        $(popClose).parent().after(
                            '<div class="offset-md-4 pop_msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>'
                            );
                    }
                    popBtn.disabled = true;
                    setTimeout(function() {
                        popBtn.disabled = false;
                    }, (1000 * 20));
                    setTimeout(function() {
                        $(".pop_msg").hide()
                    }, (1000 * 20));
                });



                const popviewBtn = document.getElementById("popview_submit");
                const popViewClose = document.getElementById("pop_view_close");

                $('.pop_view_prevent_multiple_submit').on('submit', function() {
                    if ($('.pop_view_msg').length === 0) {
                        $(popViewClose).parent().after(
                            '<div class="offset-md-4 pop_view_msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>'
                            );
                    }
                    popviewBtn.disabled = true;
                    setTimeout(function() {
                        popviewBtn.disabled = false;
                    }, (1000 * 20));
                    setTimeout(function() {
                        $(".pop_view_msg").hide()
                    }, (1000 * 20));
                });

                // for dynamic pop
                var Quesdata;
                var a;
                var unit;
                $("#env-table").on('click', '.test', function() {
                        // console.log('d');
                    segId = $(this).attr('data_seg_id');
                    sectId = $(this).attr('data_sector_id');
                    // alert(segId);
                    // var button = $(event.relatedTarget); // Button that triggered the modal
                    // var segId = button.data('ques-id'); // Extract ques_id from data-* attributes

                    // Clear previous content
                    $('#popupTable').empty();
                    var row = '';
                    // Perform AJAX request to get subques_mast data
                    $.ajax({
                        url: '../../corp_get_ques_data/' + sectId + '/' +
                        segId, // Adjust the route as needed
                        type: 'GET',
                        // data: { ques_id: quesId },
                        success: function(response) {
                            // console.log(response);
                            console.log("AJAX response:", response);

                            var subQuesData = response.data;
                            console.log("Sub-question data:", subQuesData);

                            if ($('#popupTable').length === 0) {
                                console.log("Error: #popupTable does not exist!");
                                return;
                            }

                            // Populate the modal content
                            subQuesData.forEach(function(drop, key) {
                                $('#popupTable').append(`
                                    <tr>
                                        <td>
                                            <label style="margin-left: 50px;" title="${drop.descrption}">
                                                <input type="checkbox" class="first" id="check_${key}" name="ques[${key}][check]">
                                                &nbsp;&nbsp; ${drop.particular}
                                            </label>
                                            <input type="hidden" name="ques[${key}][ques_id]" value="${drop.id}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right"
                                                min="0" name="ques[${key}][value]" id="text_${key}" disabled step=".01">
                                        </td>
                                        <td class="text-center" style="width: 20%">${drop.unit}</td>
                                        <td class="text-center" style="width: 20%">${drop.data_source}</td>
                                    </tr>
                                `);
                            });
                            // $('#popupTable').append(row);

                            $('[data-toggle="tooltip"]').tooltip();
                            $('#exampleModalCenter').modal('show');
                        },

                        error: function(xhr) {
                            console.error(xhr.responseText); // Handle error
                        }
                    });

                    Quesdata = $(this).attr('ques_data');
                    unit = $(this).attr('data_unit');

                    $("#seg_id").val($(this).attr('data_seg_id'));
                    $(".part_name").html(Quesdata);
                    $(".unit").html(unit);

                });



                $("#popupTable").delegate(".first", "change", function() {
                    // $('.first').on('change', function() {
                    var Id = $(this).attr('id');
                    Id = Id.substring(6);
                    if ($(this).is(':checked')) {
                        $('#text_' + Id).removeAttr('disabled'); // Enable the text input
                    } else {
                        $('#text_' + Id).attr('disabled', 'disabled'); // Disable the text input
                        $('#text_' + Id).val('');
                    }
                });


                // for dynamic pop_view
                // var Quesdata;

                $("#env-table").on('click', '.test1', function() {
                    segId = $(this).attr('data_seg_id');
                    fy_id = $(this).attr('data_fy_id');
                    Quesdata = $(this).attr('ques_data');
                    unit = $(this).attr('data_unit');


                    $('#popupTable_view').empty();

                    $.ajax({
                        url: '../../corp_get_ques_data_view/' + segId + '/' +
                        fy_id, // Adjust the route as needed
                        type: 'GET',
                        // data: { ques_id: segId },
                        success: function(response) {
                            // console.log(response);
                            var subQuesData = response.data;

                            // Populate the modal content
                            subQuesData.forEach(function(drop, key) {
                                var isChecked = drop.is_checked ? 'checked' : ''; // Assuming response includes isChecked property
                                var isDisabled = drop.is_checked ? '' : 'disabled'; // Enable if checked, else disable
                                var formattedValue = drop.value ? parseFloat(drop.value).toFixed(2) : '0.00';

                                $('#popupTable_view').append(`
                                    <tr>
                                        <td>
                                            <input type="hidden" name="ques[${key}][row_id]" value="${drop.id}">
                                            <label style="margin-left: 50px;" data-toggle="tooltip" title="${drop.descrption}">
                                                <input type="checkbox" class="second" id="checkview_${key}" name="ques[${key}][check]" value="1" ${isChecked}>
                                                &nbsp;&nbsp; ${drop.particular}
                                            </label>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right"
                                                name="ques[${key}][value]" id="textview_${key}" ${isDisabled}
                                                value="${formattedValue}" step=".01">
                                        </td>
                                        <td class="text-center">${drop.unit}</td>
                                        <td class="text-center">${drop.data_source}</td>
                                    </tr>
                                `);
                            });

                            $('[data-toggle="tooltip"]').tooltip();
                            $('#ViewModalCenter').modal('show');

                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // Handle error
                        }
                    });
                    // $("#ques_id_view").val(a);
                    Quesdata = $(this).attr('ques_data');
                    unit = $(this).attr('data_unit');

                    $("#head_id").val($(this).attr('data_head_id'));
                    $(".part_name").html(Quesdata);
                    $(".unit").html(unit);
                });

                $("#popupTable_view").delegate(".second", "change", function() {
                    // $('.first').on('change', function() {
                    var Id = $(this).attr('id');
                    Id = Id.substring(10);
                    if ($(this).is(':checked')) {
                        $('#textview_' + Id).removeAttr('disabled'); // Enable the text input
                    } else {
                        $('#textview_' + Id).attr('disabled', 'disabled'); // Disable the text input
                        $('#textview_' + Id).val('');
                    }
                });

            });
        </script>
    {{-- @endpush --}}
@endsection
