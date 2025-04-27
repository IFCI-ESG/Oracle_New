@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection
@section('content')
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
        <div class="row" >
            <div class="col-lg-10 offset-md-1">
                <form action="{{ route('user.activity.store') }}" id="activity" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="fy_id" value="{{ $fy_id }}" >
                    <input type="hidden" name="com_id" value="{{$user->id}}">
                    <div class="card card-success card-outline mt-5 ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                        <div class="card-header">
                            <b>Business Activity </b>
                        </div>
                        <div class="card border-primary">
                            <div class="card-body p-1 m-2">
                                <div class="row ">
                                    <div class="table-responsive rounded col-md-12">
                                        <table class="table table-bordered table-hover table-sm table-striped" id="appTable"
                                            style="width: 100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="">Sr No.</th>
                                                    <th class="">Activity</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($busi_value->isEmpty())
                                                    @foreach ($busi_mast->where('status', '1') as $key => $busi)
                                                        <tr>
                                                            <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                            <td style="font-size: 1rem">
                                                                {{ $busi->activity }}
                                                                <input type="hidden" name="business[{{$key}}][part_id]" value="{{$busi->id}}">
                                                            </td>
                                                            <td class="text-center">
                                                                <label>
                                                                    <input type="checkbox" name="business[{{$key}}][check]">
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    @foreach ($busi_value as $key => $busi)
                                                        <tr>
                                                            <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                            <td style="font-size: 1rem">
                                                                {{ $busi->activity }}
                                                                {{-- <input type="hidden" name="business[{{$key}}][row_id]" value="{{$busi->id}}"> --}}
                                                            </td>
                                                            <td class="text-center">
                                                                <label>
                                                                    <input type="checkbox" name="business[{{$key}}][check]" disabled  @if($busi->is_checked) checked @endif>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($busi_value->isEmpty())
                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 offset-md-5">
                                <button type="submit" id="busi_submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                    class="fas fa-save"></i>
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
                    {{-- <form action="{{ route('user.questionnaire.store') }}" id="questions" role="form" method="post"
                        class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                        accept-charset="utf-8">
                        @csrf --}}

                        <div class="card card-success card-outline card-tabs shadow-lg">
                            <div class="card-header p-0 pt-3 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="environment-tab" data-toggle="pill" href="#environment"
                                            role="tab" aria-controls="environment" aria-selected="true"><b>{{$sector->name}} Sector Environment Data For FY-{{$fys->fy}}</b></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="environment" role="tabpanel"
                                        aria-labelledby="environment-tab">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <table class="table table-striped projects" id="env-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%" class="text-center">
                                                                Sr. No.
                                                            </th>
                                                            <th style="width: 15%" class="text-center">
                                                                Particulars
                                                            </th>
                                                            {{-- <th style="width: 10%" class="text-center">
                                                                Unit
                                                            </th> --}}
                                                            {{-- <th style="width: 20%" class="text-center">
                                                                Type
                                                            </th>
                                                            <th style="width: 20%" class="text-center">
                                                                Value
                                                            </th> --}}
                                                            <th style="width: 20%" class="text-center">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- {{dd($ques_mast,$ques_value)}} --}}
                                                        @foreach ($seg_mast->where('status','1') as $key => $seg)
                                                            <tr>
                                                                <td class="text-center">
                                                                    {{ $key+1 }}
                                                                </td>
                                                                <td style="font-size: 1rem;" >
                                                                    {{$seg->label}}
                                                                    <input type="hidden" value="{{ $seg->id }}" name="part[{{ $key }}][ques_id]">
                                                                </td>
                                                                    @if ($ques_value->isNotEmpty())
                                                                        <td class="text-center test1" data_seg_id={{ $seg->id }} data_comp_id="{{$user->id}}" ques_data="{{ $seg->label }}" data_fy_id="{{$fy_id}}" >
                                                                            <a class="btn btn-primary btn-sm ShowRow"
                                                                                data-toggle="modal" data-target="#ViewModalCenter">
                                                                                <i class="fa fa-eye"></i>View</a>
                                                                        </td>
                                                                    @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2 mt-2">

                                {{-- <div class="col-md-2 ml-4">
                                    <a href="{{ route('user.fy', ['branch_id' => encrypt($bank_details->branch_id), 'class_type' => encrypt($bank_details->class_type_id)]) }}"
                                    class="btn btn-warning btn-sm float-left"> <i
                                        class="fas fa-arrow-left"></i> Back </a>
                                </div> --}}


                            </div>
                            <!-- /.card -->
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('partials.user.environment.popup_view')
    <script>
        $(document).ready(function() {

            // for dynamic pop_view
            // var Quesdata;

            $("#env-table").on('click', '.test1', function() {
                // alert('d');
                segId = $(this).attr('data_seg_id');
                fy_id = $(this).attr('data_fy_id');
                Quesdata = $(this).attr('ques_data');
                com_id = $(this).attr('data_comp_id');
                unit = $(this).attr('data_unit');

                $('#popupTable_view').empty();

                $.ajax({
                    url: '../../../../questionnaire_data_view/'+ segId + '/' + fy_id + '/' + com_id, // Adjust the route as needed
                    type: 'GET',
                    // data: { ques_id: headId },
                    success: function(response) {
                        console.log(response);
                        var subQuesData = response.data;

                        // Populate the modal content
                        subQuesData.forEach(function(drop, key) {

                            // var isChecked = drop.is_checked ? 'checked' : ''; // Assuming response includes isChecked property
                            // var isDisabled = drop.is_checked ? '' : 'disabled'; // Enable if checked, else disable
                            var formattedValue = parseFloat(drop.value).toFixed(2);
                            $('#popupTable_view').append(`
                                <tr>
                                    <td>
                                        <input type="hidden" name="ques[${key}][row_id]" value="${drop.id}">
                                        <label style="margin-left: 50px;" data-toggle="tooltip" title="${drop.descrption}">
                                            &nbsp;&nbsp; ${drop.particular}
                                        </label>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm text-right"
                                            name="ques[${key}][value]" id="textview_${key}" disabled
                                            value="${formattedValue}" step=".01">
                                    </td>
                                    <td class="text-center">${drop.unit}</td>
                                    <td class="text-center">${drop.data_source}</td>
                                </tr>
                            `);
                            // $('#popupTable_view').append('<tr>' +
                            //     '<td>' +
                            //         '<input type="hidden" name="ques[' + key + '][row_id]" value="'+drop.id+'">'+
                            //         '<label class="" style=" margin-left: 50px;" data-toggle="tooltip" data-placement="right" title="' + drop.descrption + '">' + drop.particular +
                            //         '</label>' +
                            //     '</td>' +
                            //     '<td>' +
                            //         '<input type="number" class="form-control form-control-sm text-right" name="ques[' + key + '][value]" id="textview_' + key + '" disabled value="' + formattedValue + '" step=".01">' +
                            //     '</td>' +
                            //     '<td class="text-center">' + drop.unit + '</td>' +
                            //     '<td class="text-center">' + drop.data_source + '</td>' +
                            //     '</tr>');
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

                $("#ques_id").val($(this).attr('data_ques_id'));
                $(".part_name").html(Quesdata);
                $(".unit").html(unit);
            });



        });

    </script>
@endpush




