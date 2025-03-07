@extends('layouts.user.dashboard-master')
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
                <form action="{{ route('user.thematic.store') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="pillar_id" value="{{ $pillar_ques->first()->pillar_id }}">
                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b >Thematic</b></a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b class="table-heading-sec">{{$pillar_ques->first()->pillar_name}}</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="employee_data">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        <th style="width: 5%" class="text-center">
                                                            Sr. No.
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Question
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                            Value
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $a=1;
                                                    @endphp
                                                    @foreach ($pillar_ques as $key=>$p_ques)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{$a}}
                                                            </td>
                                                            <td>
                                                                {{$p_ques->name}}
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="part[{{ $key }}][ques_id]" value="{{ $p_ques->id }}">

                                                                @if ($p_ques->data_type=='text')
                                                                    <input type="text" name="part[{{$key}}][value]" class="form-control form-control-sm">
                                                                @elseif ($p_ques->data_type=='numeric')
                                                                    <input type="number" name="part[{{$key}}][value]" class="form-control form-control-sm">
                                                                @elseif ($p_ques->data_type=='Y/N')
                                                                    <select class="form-control form-control-sm" name="part[{{$key}}][value]" id="">
                                                                        <option value="" selected disabled>Please Select</option>
                                                                        <option value="Y">Yes</option>
                                                                        <option value="N">No</option>
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $a++;
                                                        @endphp
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
                                <a href="{{ route('user.thematic') }}"
                                class="btn btn-warning btn-sm float-left Custom-btn"> <i class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-1 offset-md-3">
                                <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm Custom-btn"><i
                                        class="fas fa-save"></i>
                                    Submit</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\SocialRequest', '#social_store') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {



        });


    </script>
@endpush



