@extends('layouts.admin.master')
@section('title')
    Add Questionnaire
@endsection
@push('styles')
    {{-- <link href="{{ asset('css/app/application.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
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
    <div class="container  py-4 px-2 col-lg-12">
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
                                                    @foreach ($head_mast->where('status','1') as $key => $head)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $key+1 }}
                                                            </td>
                                                            <td style="font-size: 1rem;" >
                                                                {{$head->particular}}
                                                                <input type="hidden" value="{{ $head->id }}" name="part[{{ $key }}][ques_id]">
                                                            </td>
                                                                @if ($ques_value->isNotEmpty())
                                                                    <td class="text-center test1" data_head_id={{ $head->id }} data_comp_id="{{$user->id}}" ques_data="{{ $head->particular }}" data_fy_id="{{$fy_id}}" >
                                                                        {{-- <td class="text-center test1" data_ques_id={{ $ques->id }} data_comp_id="{{$user->id}}" ques_data="{{ $ques->particular }}" data_unit="{{$ques->unit}}" data_fy_id="{{$fy_id}}" > --}}
                                                                        <a class="btn btn-warning btn-sm ShowRow"
                                                                            data-toggle="modal" data-target="#ViewModalCenter">
                                                                            <i class="fa fa-eye"></i>View</a>
                                                                    </td>
                                                                {{-- @else
                                                                    <td class="text-center test" data_ques_id={{ $ques->id }} ques_data="{{ $ques->particular }}" data_sector_id="{{Auth::user()->sector_id}}">
                                                                        <a class="btn btn-primary btn-sm ShowRow"
                                                                            data-toggle="modal" data-target="#exampleModalCenter">
                                                                            <i class="fa fa-plus"></i>&nbsp;&nbsp; Add</a>
                                                                    </td>
                                                                @endif --}}
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

                            <div class="col-md-2 ml-4">
                                <a href="{{ route('admin.user.company_list') }}"
                                class="btn btn-warning btn-sm float-left"> <i
                                    class="fas fa-arrow-left"></i> Back </a>
                            </div>
    
                           
                        </div>
                        <!-- /.card -->
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('partials.admin.environment.popup_view')
    <script>
        $(document).ready(function() {

            // for dynamic pop_view
            // var Quesdata;

            $("#env-table").on('click', '.test1', function() {
                // alert('d');
                headId = $(this).attr('data_head_id');
                fy_id = $(this).attr('data_fy_id');
                Quesdata = $(this).attr('ques_data');
                com_id = $(this).attr('data_comp_id');
                unit = $(this).attr('data_unit');

                $('#popupTable_view').empty();

                $.ajax({
                    url: '../../../company_data_view/'+ headId + '/' + fy_id + '/' + com_id, // Adjust the route as needed
                    type: 'GET',
                    // data: { ques_id: headId },
                    success: function(response) {
                        // console.log(response);
                        var subQuesData = response.data;

                        // Populate the modal content
                        subQuesData.forEach(function(drop, key) {

                            // var isChecked = drop.is_checked ? 'checked' : ''; // Assuming response includes isChecked property
                            var isDisabled = drop.is_checked ? '' : 'disabled'; // Enable if checked, else disable
                            var formattedValue = parseFloat(drop.value).toFixed(2);

                            $('#popupTable_view').append('<tr>' +
                                '<td>' +
                                    '<input type="hidden" name="ques[' + key + '][row_id]" value="'+drop.id+'">'+
                                    '<label class="" style=" margin-left: 50px;" data-toggle="tooltip" data-placement="right" title="' + drop.descrption + '">' + drop.particular +
                                    '</label>' +
                                '</td>' +
                                '<td>' +
                                    '<input type="number" class="form-control form-control-sm text-right" name="ques[' + key + '][value]" id="textview_' + key + '" disabled value="' + formattedValue + '" step=".01">' +
                                '</td>' +
                                '<td class="text-center">' + drop.unit + '</td>' +
                                '<td class="text-center">' + drop.data_source + '</td>' +
                                '</tr>');
                            // $('#popupTable_view').append(row);
                        });
                            
                        $('[data-toggle="tooltip"]').tooltip();
                       
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText); // Handle error
                    }
                });
                // $("#ques_id_view").val(a);
                Quesdata = $(this).attr('ques_data');
                unit = $(this).attr('data_unit');

                $("#ques_id").val($(this).attr('data_head_id'));
                $(".part_name").html(Quesdata);
                $(".unit").html(unit);
            });

           

        });

    </script>
@endpush
