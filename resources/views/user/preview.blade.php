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
        <div class="row" id="business_activity">
            <div class="col-lg-10 offset-md-1">
                <div class="card card-success card-outline mt-5 ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                    <div class="card-header">
                        <b>Business Activity</b>
                    </div>
                    <div class="card border-primary">
                        <div class="card-body p-1 m-2">
                            <div class="row ">
                                <div class="table-responsive rounded col-md-12">
                                    <table class="table table-bordered table-hover table-sm table-striped" id="appTable"
                                        style="width: 100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="">Sr. No.</th>
                                                <th class="">Activity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($busi_acti->where('status', '1') as $key => $busi)
                                                <tr>
                                                    <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                    <td style="font-size: 1rem">
                                                        {{ $busi->acitvity }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="environment_data">
            <div class="col-lg-10 offset-md-1">
                <div class="card card-success card-outline ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                    <div class="card-header">
                        <b>Environment Data Preview </b>
                    </div>
                    <div class="card border-primary">
                        <div class="card-body p-1 m-2">
                            <div class="row ">
                                <div class="table-responsive rounded col-md-12">
                                    <table class="table table-bordered table-hover table-sm table-striped" id="appTable"
                                        style="width: 100%">
                                        @foreach ($scope_mast as $key => $scope)
                                            <tbody>
                                                <tr class="text-center">
                                                    <th style="font-size: 1rem;">
                                                        {{$scope->name}}
                                                    </th>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @foreach ($seg_mast->where('scope_id',$scope->id) as $key => $seg)
                                                    <tr>
                                                        <th style="font-size: 1rem">
                                                            {{$seg->header_name}}
                                                        </th>
                                                        <th colspan="2" style="font-size: 1rem">
                                                            Data Quality - {{$data_quality->where('segment_id',$seg->id)->first()->name}}
                                                        </th>
                                                        {{-- <td></td> --}}
                                                    </tr>
                                                    @foreach ($ques_val->where('segment_id',$seg->id) as $key => $ques)
                                                        <tr>
                                                            <td style="font-size: 1rem">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;  {{$ques->question}}
                                                            </td>
                                                            <td style="font-size: 1rem">
                                                                {{$ques->value}}
                                                            </td>
                                                            <td style="font-size: 1rem">
                                                                {{$ques->unit}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            {{-- {{dd($bank_details)}} --}}

                            @if ($input_mast->status == 'D')
                                <form action="{{ route('user.questionnaire.submit') }}" id="preview_submit" role="form"
                                    method="post" class='prevent_multiple_submit' files=true enctype='multipart/form-data'
                                    accept-charset="utf-8">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="checkbox" name="undertaking"> &nbsp;
                                            This is to certify that the data and information given in the application is true, to the best of my knowledge and understanding.
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 offset-md-3">
                                                <button type="submit" id="submit"
                                                    class="btn btn-primary  m-2 btn-sm form-control form-control-sm form-control form-control-sm-sm">
                                                    <em class="fas fa-save"></em> Submit
                                                </button>

                                            <input type="hidden" name="input_id" value="{{ $input_mast->id }}">
                                            <input type="hidden" name="bank_id" value="{{ $bank_details->bank_id }}">
                                            <input type="hidden" name="class_type" value="{{ $bank_details->class_type_id }}">
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <div class="row">
                                <div class="col-md-2 ml-4">
                                    <a href="{{ route('user.fy', ['branch_id' => encrypt($bank_details->branch_id), 'class_type' => encrypt($bank_details->class_type_id)]) }}"
                                        class="btn btn-warning btn-sm float-left"> <i class="fas fa-arrow-left"></i>
                                        Back </a>
                                </div>
                                @if ($input_mast->status == 'S')
                                    <div class="col-md-2 offset-md-2">
                                        <div onclick="printPage();" class="btn btn-warning m-2 btn-sm form-control form-control-sm">
                                            Print <i class="fas fa-print"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="row" >
            <div class="col-lg-10 offset-md-1">
                <div class="card card-success card-outline ml-2" >
                    @if ($input_mast->status == 'D')
                        <form action="{{ route('user.questionnaire.submit') }}" id="preview_submit" role="form"
                            method="post" class='prevent_multiple_submit' files=true enctype='multipart/form-data'
                            accept-charset="utf-8">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" name="undertaking"> &nbsp;
                                    This is to certify that the data and information given in the application is true, to the best of my knowledge and understanding.
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-2 offset-md-3">
                                        <button type="submit" id="submit"
                                            class="btn btn-primary  m-2 btn-sm form-control form-control-sm form-control form-control-sm-sm">
                                            <em class="fas fa-save"></em> Submit
                                        </button>

                                    <input type="hidden" name="input_id" value="{{ $input_mast->id }}">
                                    <input type="hidden" name="bank_id" value="{{ $bank_details->bank_id }}">
                                    <input type="hidden" name="class_type" value="{{ $bank_details->class_type_id }}">
                                </div>
                            </div>
                        </form>
                    @endif

                    @if ($input_mast->status == 'S')
                        <div class="row pb-3">
                            <div class="col-md-2 offset-md-2">
                                <div onclick="printPage();" class="btn btn-warning m-2 btn-sm form-control form-control-sm">
                                    Print <i class="fas fa-print"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}
        <div id="level_details" class="container py-4 px-4 col-lg-10" style="background-color: #f9fafc; border: 1px solid #d1d5db; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
            <h5 style="color: #1f2937; font-weight: bold; margin-bottom: 10px;">🌍 Data Quality Index</h5>
            <p style="line-height: 1.6; color: #4b5563;">
                <span style="font-weight: bold;">Level 1</span> - Verified emissions data<br>
                <span style="font-weight: bold;">Level 2</span> - Non-verified GHG emissions data or real primary energy data<br>
                <span style="font-weight: bold;">Level 3</span> - Emissions calculated using primary physical activity data of the company’s production and emission factors specific to that primary data<br>
                <span style="font-weight: bold;">Level 4</span> - Estimate emissions based on sector and revenue<br>
                <span style="font-weight: bold;">Level 5</span> - Emissions based on national-level proxy data
            </p>
        </div>
    </div>
    <br>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\PreviewDocRequest', '#preview_sign_store') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\PreviewDocRequest', '#preview_sign_update') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        function printPage(time) {
            var today = new Date();
            var date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
            var dateTime = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date + ' ' + dateTime;
            var companyName = "{{$user->name}}";

            var div1 = document.getElementById('business_activity');
            var div2 = document.getElementById('environment_data');
            var div3 = document.getElementById('level_details');

            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><head><title> ESG-Prakrit Environment Preview</title>');
            newWin.document.write('<link href="{{ asset('css/app.css') }}" rel="stylesheet">');
            newWin.document.write('<link href="{{ asset('css/app/preview.css') }}" rel="stylesheet">');
            newWin.document.write('<style>@media print { .pagebreak { clear: both; page-break-before: always; }}</style>');
            newWin.document.write('</head><body onload="window.print()">');
            newWin.document.write('<h3 class="text-center">Environment Data Preview</h3>');

            newWin.document.write(div1.innerHTML);
            newWin.document.write('<p>&nbsp;</p>');
            newWin.document.write(div2.innerHTML);
            // newWin.document.write('<p style="page-break-after: always;">&nbsp;</p>');
            newWin.document.write('<p>&nbsp;</p>');
            newWin.document.write('<div style="margin-left: 20px;">' + div3.innerHTML + '</div>');
            newWin.document.write('<p>&nbsp;</p>');
            newWin.document.write('<h3>&nbsp;&nbsp;&nbsp;&nbsp;Company Name - ' + companyName + '</h3>');
            newWin.document.write('<h3>&nbsp;&nbsp;&nbsp;&nbsp;Date & Time - ' + time + '</h3>');
            newWin.document.close();
        };

    </script>
@endpush
