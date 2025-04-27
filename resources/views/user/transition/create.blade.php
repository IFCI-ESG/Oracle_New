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
            <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('user.transition.store') }}" id="transition_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" value="{{ $fy_id }}" name="fy_id">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="com_id">

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>Transition Risk For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="governance" role="tabpanel" aria-labelledby="governance-tab">

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b>Details</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-sm table-bordered table-hover" id="company_table">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%"></td>
                                                        <th>
                                                            Name of the Company
                                                        </th>
                                                        <td style="font-size: 1rem">
                                                            {{ Auth::user()->name }}
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th>Sector</th>
                                                        <td style="font-size: 1rem">{{ $sector->name  }}</td>
                                                        <td style="width: 20%"></td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <th>Sector Risk</th>
                                                        <td style="font-size: 1rem; @if($sector->exposure_risk === 'HIGH')
                                                                        color: red; background-color: #f8d7da;
                                                                    @elseif($sector->exposure_risk === 'MEDIUM')
                                                                        color: orange; background-color: #fff3cd;
                                                                    @elseif($sector->exposure_risk === 'LOW')
                                                                        color: green; background-color: #d4edda;
                                                                    @endif">
                                                                    {{ $sector->exposure_risk  }}
                                                        </td>
                                                        <td style="width: 20%"></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($sector->exposure_risk === 'HIGH' || $sector->exposure_risk === 'MEDIUM')
                            <div class="card-body">
                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        <b>Policy & Legal Risks</b>
                                    </div>
                                    <div class="card-body p-3">
                                        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
                                            <thead>
                                                <tr class="text-center table-environment">
                                                    <th style="width: 10%" class="text-center">
                                                        Sr. No.
                                                    </th>
                                                    <th style="width: 30%" class="text-center">
                                                        Question
                                                    </th>
                                                    <th style="width: 10%" class="text-center">
                                                        Value
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $a=1;
                                                @endphp
                                                @foreach ($transition_ques->where('section','Policy & Legal Risks')->sortBy('order') as $key => $emp)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $a }}
                                                        </td>
                                                        <td>
                                                            {{$emp->question}}
                                                            <input type="hidden" value="{{ $emp->id }}" name="policy[{{ $a }}][ques_id]">
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <select name="policy[{{ $a }}][value]" id="value" style="width: 70%; margin: 0 auto;" class="form-control form-control-sm">
                                                                <option value="" disabled selected>Please Select</option>
                                                                <option value="Y">Yes</option>
                                                                <option value="N">No</option>
                                                            </select>
                                                            {{-- @error('value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}
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

                            <div class="card-body">
                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        <b>Technology</b>
                                    </div>
                                    <div class="card-body p-3">
                                        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
                                            <thead>
                                                <tr class="text-center table-environment">
                                                    <th style="width: 10%" class="text-center">
                                                        Sr. No.
                                                    </th>
                                                    <th style="width: 30%" class="text-center">
                                                        Question
                                                    </th>
                                                    <th style="width: 10%" class="text-center">
                                                        Value
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $b=1;
                                                @endphp
                                                @foreach ($transition_ques->where('section','Technology')->sortBy('order') as $key => $emp)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $b }}
                                                        </td>
                                                        <td>
                                                            {{$emp->question}}
                                                            <input type="hidden" value="{{ $emp->id }}" name="tech[{{ $b }}][ques_id]">
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <select name="tech[{{ $b }}][value]" id="value" style="width: 70%; margin: 0 auto;" class="form-control form-control-sm">
                                                                <option value="" disabled selected>Please Select</option>
                                                                <option value="Y">Yes</option>
                                                                <option value="N">No</option>
                                                            </select>
                                                            {{-- @error('value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $b++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        <b>Market</b>
                                    </div>
                                    <div class="card-body p-3">
                                        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
                                            <thead>
                                                <tr class="text-center table-environment">
                                                    <th style="width: 10%" class="text-center">
                                                        Sr. No.
                                                    </th>
                                                    <th style="width: 30%" class="text-center">
                                                        Question
                                                    </th>
                                                    <th style="width: 10%" class="text-center">
                                                        Value
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $c=1;
                                                @endphp
                                                @foreach ($transition_ques->where('section','Market')->sortBy('order') as $key => $emp)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $c }}
                                                        </td>
                                                        <td>
                                                            {{$emp->question}}
                                                            <input type="hidden" value="{{ $emp->id }}" name="market[{{ $c }}][ques_id]">
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <select name="market[{{ $c }}][value]" id="value" style="width: 70%; margin: 0 auto;" class="form-control form-control-sm">
                                                                <option value="" disabled selected>Please Select</option>
                                                                <option value="Y">Yes</option>
                                                                <option value="N">No</option>
                                                            </select>
                                                            {{-- @error('value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $c++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        <b>Reputation</b>
                                    </div>
                                    <div class="card-body p-3">
                                        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
                                            <thead>
                                                <tr class="text-center table-environment">
                                                    <th style="width: 10%" class="text-center">
                                                        Sr. No.
                                                    </th>
                                                    <th style="width: 30%" class="text-center">
                                                        Question
                                                    </th>
                                                    <th style="width: 10%" class="text-center">
                                                        Value
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $d=1;
                                                @endphp
                                                @foreach ($transition_ques->where('section','Reputation')->sortBy('order') as $key => $emp)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $d }}
                                                        </td>
                                                        <td>
                                                            {{$emp->question}}
                                                            <input type="hidden" value="{{ $emp->id }}" name="reputation[{{ $d }}][ques_id]">
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <select name="reputation[{{ $d }}][value]" id="value" style="width: 70%; margin: 0 auto;" class="form-control form-control-sm">
                                                                <option value="" disabled selected>Please Select</option>
                                                                <option value="Y">Yes</option>
                                                                <option value="N">No</option>
                                                            </select>
                                                            {{-- @error('value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $d++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.transition.index') }}"
                                class="btn btn-warning btn-sm float-left"> <i
                                    class="fas fa-arrow-left"></i> Back </a>
                            </div>
                            @if ($sector->exposure_risk === 'HIGH' || $sector->exposure_risk === 'MEDIUM')
                                <div class="col-md-2 offset-md-3">
                                    {{-- <a class="btn Custom-btn-back m-2 btn-sm form-control form-control-sm"
                                            href="{{ route('user.print_preview', ['com_id'=>encrypt(Auth::user()->id), 'fy_id'=>encrypt($fy_id)]) }}">
                                            Print Preview</a> --}}
                                    {{-- @if(!$busi_value->isEmpty()) --}}
                                        <button type="submit" id="submit" class="btn btn-primary btn-sm "><i
                                                class="fas fa-save"></i>
                                            Submit</button>
                                    {{-- @endif --}}
                                </div>
                            @endif

                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\TransitionRequest', '#transition_store') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {


        });


    </script>
@endpush

@endsection
