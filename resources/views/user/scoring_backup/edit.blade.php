@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

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

<style>

    .form-check-label {
        font-size: 1.1rem;
    }
    .form-check-input:checked + .form-check-label {
        color: #007bff;
        font-weight: bold;
    }
    .form-check-input:focus {
        box-shadow: none;
    }
    .Environmernt{
        color: darkgreen;
        font-weight: 800;
        font-size: 20px;
    }
       .Social{
        color: blue;
    }
       .Governance{
        color: yellowgreen;
    }
    .table tbody tr td input {
    height: auto;
}
</style>
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
            <form action="{{ route('user.scoring.update') }}" id="scoring_store" role="form" method="post"
            class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
            accept-charset="utf-8">
            @csrf
            <input type="hidden" value="{{ $fys->id}}" name="fy_id">
            <input type="hidden" value="{{ $user->id }}" name="com_id">
            <input type="hidden" value="{{ $module_mast->id }}" name="module_mast_id">

            <div class="card card-outline-governance card-tabs shadow-lg">
                <div class="card-header p-0 pt-3 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                               <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                            role="tab" aria-controls="social" aria-selected="true" style="    border-left-color: #495057;"><b>Scoring Data For FY-{{$fys->fy}}</b></a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="governance" role="tabpanel" aria-labelledby="governance-tab">

                            @foreach($question as $key => $pillerdata) 
                             <div class="card card-outline-governance" style="    border: 3px solid #12CCCC;">
                                <div class="card-header">
                                    <b class="{{$key}}">{{$key}}<b>


            @foreach ($pillerdata as $key1 => $subpiller)
            <div class="card card-outline-governance">
            <div class="card-header">
                <h5>{{$key1}}<h5>
                    @php
                    $i=1;
                    @endphp
                    @foreach ($subpiller as $key2 => $value)
                    <div class="card-body p-3">
                        <table class="table table-bordered table-hover table-sm table-striped" id="board-table">
                            <tbody>
                                <tr>
                                    <td class="text-center" style="width: 5%" >
                                        {{$i}}
                                    </td>
                                    <td style="width: 40%" >
                                        {{$value->question}}

                                    </td>
                                    <td style="width: 40%">
                                        <div class="form-check">
                                            <input  type="radio" name="answer[{{$value->id}}]" id="" style="       height: auto !important;" value="1"  @if($value->ans==1) checked @endif>
                                            <label class="form-check-label" for="1">
                                                {{$value->option1}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input  type="radio" name="answer[{{$value->id}}]" id="" style="       height: auto !important;" value="2"

                                            @if($value->ans==2) checked @endif
                                            >
                                            <label class="form-check-label" for="1">
                                                {{$value->option2}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input  type="radio" name="answer[{{$value->id}}]" id="" style="       height: auto !important;" value="3">
                                            <label class="form-check-label" for="1"  @if($value->ans==3) checked @endif>
                                                {{$value->option3}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input  type="radio" name="answer[{{$value->id}}]" id="" style="       height: auto !important;" value="4"  @if($value->ans==4) checked @endif>
                                            <label class="form-check-label" for="1">
                                                {{$value->option4}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
            @endforeach
            </div>
            </div>
            @endforeach
            </div>
            </div>
            </div>

                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.scoring.index') }}"
                                class="btn btn-warning btn-sm float-left"> <i
                                class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-1 offset-md-3">

                                {{-- <a class="btn Custom-btn-back m-2 btn-sm form-control form-control-sm"
                                href="{{ route('user.print_preview', ['com_id'=>encrypt($user->id), 'fy_id'=>encrypt($fy_id)]) }}">
                            Print Preview</a> --}}
                            {{-- @if(!$busi_value->isEmpty()) --}}
                            <button type="submit" id="submit" class="btn btn-primary btn-md "><i
                                class="fas fa-save"></i>
                            Save As Draft</button>
                            {{-- @endif --}}
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
@include('partials.js.prevent_multiple_submit')

@endpush

