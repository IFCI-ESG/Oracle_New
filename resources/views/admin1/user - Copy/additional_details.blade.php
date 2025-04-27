@extends('layouts.user.dashboard-master')
@section('title')
    Additional Details
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
    <div class="row">
        <div class="col-lg-10 offset-md-1">
            <form action=" {{ route('user.additional_details') }} " id="addForm" method="post"
                    enctype="multipart/form-data" class="prevent_multiple_submit">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

                <div class="card card-success card-outline mt-5" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                    <div class="card-header">
                       <b> 1. Company Details / Project Information</b>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive rounded col-md-12">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>
                                            Name of the Applicant / Company
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
                                        <th>What is the total number of Permanent Employees ? </th>
                                        <td>
                                            <input type="number" id="per_employee" name="per_employee"
                                                class="form-control form-control-sm" style="width:50%"
                                                value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>What is the total number of Temporary Employees ? </th>
                                        <td>
                                            <input type="number" name="temp_employee" id="temp_employee" style="width:50%"
                                                class="form-control form-control-sm valid">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>What is the total production capacity of company ? </th>
                                        <td>
                                            <input type="text" name="prod_capacity" id="prod_capacity" style="width:50%"
                                                class="form-control form-control-sm valid">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_add"
                                                        class="col-form-label col-form-label-sm">Registered Office </label>
                                                    <textarea id="reg_off_add" name="reg_address" class="form-control form-control-sm"
                                                        placeholder="Registered office address"></textarea>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_pin"
                                                        class="col-form-label col-form-label-sm">Pincode</label>
                                                    <input type="number" min="0" id="reg_off_pin"
                                                        name="pincode" class="form-control form-control-sm"
                                                        placeholder="Pin Code"
                                                        onkeyup="GetCityByPinCode('reg',this.value)">
                                                        <span id="pincodeMsg" style="color:red;font-weight:bold;display: none"></span>

                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_state"
                                                        class="col-form-label col-form-label-sm">State</label>
                                                    <input type="text" class="form-control form-control-sm select-state"
                                                        name="state" id="regAddState" readonly>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="reg_off_city"
                                                        class="col-form-label col-form-label-sm">City</label>
                                                    <select id="regAddCity" name="city"
                                                        class="form-control form-control-sm select-city">
                                                        <option value="" selected="selected">Please choose..</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="form-group col-md-3">
                                                    <label for="reg_off_dist"
                                                        class="col-form-label col-form-label-sm">District</label>
                                                    <select id="regAddDistrict" name="district"
                                                        class="form-control form-control-sm select-city">
                                                        <option value="" selected="selected">Please choose..</option>
                                                    </select>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-10 offset-md-2">
                        <div class="form-group form-actions">
                            <div class="col-lg-9 col-12 text-center">
                                <button type="submit" class="btn btn-primary" id="submit"> Save As Draft </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!} --}}
    @include('partials.js.prevent_multiple_submit')
    @include('partials.user.pincode-js')
    <script>
        $(document).ready(function() {

        });


    </script>
@endpush
