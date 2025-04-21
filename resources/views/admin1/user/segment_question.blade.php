@extends('layouts.user.dashboard-master')
@section('title')
    Add Questionnaire
@endsection
@push('styles')
    {{-- <link href="{{ asset('css/app/application.css') }}" rel="stylesheet"> --}}
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
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('user.questionnaire.store') }}" id="questions" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" value="{{$fy_id}}" name="fy_id">

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="section-tab" data-toggle="pill" href="#section"
                                        role="tab" aria-controls="section" aria-selected="true">{{$segments->segment_name}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="section" role="tabpanel" aria-labelledby="section-tab">
                                    <div class="card">
                                        <table class="table table-sm table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center"  style="width: 50%">Particulars</th>
                                                    <th class="text-center" style="width: 20%">Unit</th>
                                                    <th class="text-center" style="width: 20%">Value</th>
                                                </tr>
                                                @foreach ($questions->where('status','1') as $key => $ques)
                                                <tr>
                                                    <td style="font-size: 1rem;">
                                                        {{$ques->particular}}
                                                        <input type="hidden" value="{{ $ques->id }}" name="part[{{ $key }}][ques_id]">
                                                    </td>
                                                    @if($ques->unit_status=='1' && $ques->data_type!='radio')
                                                        <td class="text-center" style="font-size: 0.9rem;">
                                                            {!! $ques->unit !!}
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td>
                                                        @if($ques->data_type=='radio')
                                                            <div>
                                                                <select class="form-control form-control-sm" name="part[{{ $key }}][value]" id="">
                                                                    <option value="" disabled selected>Select</option>
                                                                    <option value="Y">Yes</option>
                                                                    <option value="N">No</option>
                                                                </select>
                                                                {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label>
                                                                    <input type="radio" required name="part[{{ $key }}][value]" value="1" class="form-control form-control-sm text-right"> Yes
                                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label>
                                                                    <input type="radio" required name="part[{{ $key }}][value]" value="0" class="form-control form-control-sm text-right"> No
                                                                </label> --}}
                                                            </div>
                                                        @else
                                                            <input  type="{{$ques->data_type}}"  required value="" name="part[{{ $key }}][value]" class="form-control form-control-sm text-right" style="width:100%">
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="row pb-3">
                                            <div class="col-md-2 offset-md-5">
                                                <button type="submit" id="submit"
                                                    class="btn btn-primary btn-sm form-control form-control-sm form-control form-control-sm-sm">
                                                    <em class="fas fa-save"></em> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit') --}}
    <script>
        $(document).ready(function() {

        });

        function validatePercentage(input) {
            let value = parseFloat(input.value);
            alert(value);
            if (isNaN(value) || value < 0 || value > 100) {
                input.setCustomValidity('Please enter a valid percentage (0-100)');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>
@endpush
