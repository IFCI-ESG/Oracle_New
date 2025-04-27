@extends('layouts.user.dashboard-master')
@section('title')
    Financial Year
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

    <div class="row" >
        <div class="col-lg-8 offset-md-2">
            <div class="card card-success card-outline mt-5 ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                <div class="card-header text-center" style="margin: 4px">
                    <b class="table-heading-sec">{{$bank_details->bank_name}} ({{$bank_details->loan_type}})</b>
                </div>
                <div class="card-header" style="margin: 4px">
                    <b >Selection of Financial Year </b>
                </div>
                <div class="card border-primary" style="margin: 4px">
                    <div class="card-body p-1 m-2">
                        <div class="row ">
                            <div class="table-responsive rounded col-md-12">
                                <table class="table table-bordered  table-sm table-striped" id="appTable"
                                    style="width: 100%">
                                    <thead>
                                        <tr  class="text-center table-success">
                                            <th class="">Sr. No.</th>
                                            <th class="">Financial Year</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fys->where('status', '1') as $key => $fy)
                                            <tr>
                                                <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                <td class="text-center" style="font-size: 1rem">
                                                    {{ $fy->fy }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($bank_details->class_type_id == 1 || $bank_details->class_type_id == 2)
                                                        @if (count($ques->where('fy_id',$fy->id)))
                                                            @if($input_mast->where('fy_id',$fy->id)->first()->status == 'S')
                                                                <a class="btn btn-warning btn-sm"
                                                                    href="{{ route('user.questionnaire_view', ['bank_id' => encrypt($bank_details->bank_id),'class_type'=> encrypt($bank_details->class_type_id),'com_id' => encrypt($user->id),'fy_id'=> encrypt($fy->id)] ) }}"> View</a>
                                                            @else
                                                                <a class="btn btn-success btn-sm Custom-btn-edit"
                                                                    href="{{ route('user.addquestionnaire', ['bank_id' => encrypt($bank_details->bank_id),'class_type'=> encrypt($bank_details->class_type_id),'fy_id'=> encrypt($fy->id)] ) }}"> Edit</a>
                                                            @endif
                                                        @else
                                                            <a class="btn btn-primary btn-sm Custom-btn"
                                                                href="{{ route('user.addquestionnaire', ['bank_id' => encrypt($bank_details->bank_id),'class_type'=> encrypt($bank_details->class_type_id),'fy_id'=> encrypt($fy->id)]) }}"> Create</a>
                                                        @endif
                                                    @elseif ($bank_details->class_type_id == 3)
                                                        3
                                                    @elseif ($bank_details->class_type_id == 4)
                                                        4
                                                    @elseif ($bank_details->class_type_id == 5)
                                                        5
                                                    @elseif ($bank_details->class_type_id == 6)
                                                        6
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                            <div class="row pb-2 mt-2 d-flex align-items-center">
                <div class="col-md-12 ml-4">
                    <a href="{{ route('user.bank') }}"
                    class="btn btn-warning btn-sm float-left Custom-btn"> <i
                        class="fas fa-arrow-left"></i> Back </a>
                </div>
            </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {
            $('#activity').on('submit', function(e) {
                // Check if at least one checkbox is checked
                // alert('d');
                if ($('input[type="checkbox"]:checked').length === 0) {
                    alert('Please check at least one checkbox.');
                    e.preventDefault(); // Prevent form submission
                }

                var confirmation = confirm('You cannot revert the changes. Do you want to continue?');
                if (!confirmation) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endpush
