@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')

    @include('layouts.shared.page-title', ['title' => 'Physical Risk', 'subtitle' => 'Environment'])

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
       <style>
        ul {
        list-style-type: none;
        }

        li {
        display: inline-block;
        }

        input[type="checkbox"][id^="myCheckbox"] {
        display: none;
        }

        .img_label {
        border: 1px solid #fff;
        padding: 10px;
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
        }

        label:before {
        background-color: white;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid grey;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
        }

        label img {
        height: 170px;
        width: 170px;
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
        }

        :checked + label {
        border-color: #ddd;
        }

        :checked + label:before {
        content: "✓";
        background-color: green;
        transform: scale(1);
        }

        :checked + label img {
        transform: scale(0.9);
        z-index: -1;
        }
    </style>

    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('user.physical.update') }}" id="gov_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    {{-- <input type="hidden" value="{{ $fy_id }}" name="fy_id"> --}}

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>Physical Risk For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="governance" role="tabpanel" aria-labelledby="governance-tab">

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b>Plant Locations</b>
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
                                                    @foreach ($plantlocation as $key => $plant)
                                                        <tr>
                                                            <td colspan="4">
                                                                <div class="card my-3 shadow-sm border-primary">
                                                                    <div class="card-header bg-primary text-white">
                                                                        <b>Plant {{ $key + 1 }} Details</b>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <input type="hidden" value="{{ $physical_values->id }}" name="plant[{{ $key }}][row_id]">

                                                                            <!-- Plant Address -->
                                                                            <div class="form-group col-md-3">
                                                                                <label for="plant_off_add_{{ $key }}"
                                                                                    class="col-form-label col-form-label-sm">Plant Address</label>
                                                                                <textarea id="plant_off_add_{{ $key }}" name="plant[{{ $key }}][plnt_address]"
                                                                                    class="form-control form-control-sm" disabled>{{ $plant->plnt_address }}</textarea>
                                                                            </div>

                                                                            <!-- Pincode -->
                                                                            <div class="form-group col-md-3">
                                                                                <label
                                                                                    for="plant_off_pin_{{ $key }}"
                                                                                    class="col-form-label col-form-label-sm">Pincode</label>
                                                                                <input type="number" min="0"
                                                                                    id="plant_off_pin_{{ $key }}"
                                                                                    name="plant[{{ $key }}][plnt_pincode]"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled
                                                                                    value="{{ $plant->plnt_pincode }}">
                                                                            </div>

                                                                            <!-- State -->
                                                                            <div class="form-group col-md-3">
                                                                                <label
                                                                                    for="plant_off_state_{{ $key }}"
                                                                                    class="col-form-label col-form-label-sm">State</label>
                                                                                <input type="text"
                                                                                    id="plant_off_state_{{ $key }}"
                                                                                    name="plant[{{ $key }}][plnt_state]"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled
                                                                                    value="{{ $plant->plnt_state }}">
                                                                            </div>

                                                                            <!-- City -->
                                                                            <div class="form-group col-md-3">
                                                                                <label
                                                                                    for="plant_off_city_{{ $key }}"
                                                                                    class="col-form-label col-form-label-sm">City</label>
                                                                                <input type="text"
                                                                                    id="plant_off_city_{{ $key }}"
                                                                                    name="plant[{{ $key }}][plnt_city]"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled
                                                                                    value="{{ $plant->plnt_city }}">
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            // Decode the stored JSON to access risks per plant
                                                                            $plantPhysicalValue = $physical_values->plant_and_risk_id ?? '{}';
                                                                            $plantRisks = json_decode($plantPhysicalValue, true);
                                                                            $img_ids = $plantRisks[$plant->id] ?? []; // Get the risks for the current plant, or an empty array if not set
                                                                            // dd($plantPhysicalValue,$plantRisks,$img_ids);
                                                                        @endphp
                                                                        <!-- Risk Section -->
                                                                        <div class="mt-4">
                                                                            <h6 class="text-secondary mb-2">Physical Risks:
                                                                            </h6>
                                                                            <div class="d-flex flex-wrap">
                                                                                @foreach ($physical_img as $riskKey => $img)
                                                                                    <div class="form-check mr-3 mb-2">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox" {{ in_array($img->id, $img_ids) ? 'checked' : '' }}
                                                                                            name="plant[{{ $key }}][risk][]"
                                                                                            value="{{ $img->id }}">
                                                                                        <label
                                                                                            class="form-check-label">{{ $img->particular }}</label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{-- @foreach ($plantlocation as $key => $plant)
                                                        <input type="hidden" name="plant[{{ $key }}][row_id]"
                                                            id="row_id" class="form-control form-control-sm"
                                                            value="{{ $plant->id }}">
                                                        <tr class="plant_loc">
                                                            <td colspan="4">
                                                                <div class="row">

                                                                    <div class="form-group col-md-3">
                                                                        <label for="plant_off_add"
                                                                            class="col-form-label col-form-label-sm">Plant Address </label>
                                                                        <textarea id="plant_off_add" name="plant[{{ $key }}][plnt_address]" disabled class="form-control form-control-sm">{{ $plant->plnt_address }}</textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="plant_off_pin"
                                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                                        <input type="number" min="0" id="plant_off_pin"
                                                                            name="plant[{{ $key }}][plnt_pincode]"
                                                                            class="form-control form-control-sm" disabled
                                                                            value="{{ $plant->plnt_pincode }}">

                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="plant_off_state"
                                                                            class="col-form-label col-form-label-sm">State</label>
                                                                        <input type="text"
                                                                            class="form-control form-control-sm select-state"
                                                                            name="plant[{{ $key }}][plnt_state]"
                                                                            id="plantAddState{{ $key }}"
                                                                            value="{{ $plant->plnt_state }}" disabled>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="plant_off_city"
                                                                            class="col-form-label col-form-label-sm">City</label>
                                                                        <input type="text"
                                                                            class="form-control form-control-sm select-state"
                                                                            name="plant[{{ $key }}][plnt_state]"
                                                                            id="plantAddState{{ $key }}"
                                                                            value="{{ $plant->plnt_city }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b>Aggregate Risks</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-sm table-bordered table-hover" id="company_table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <ul>
                                                                @php
                                                                    // Decode the stored JSON to access risks per plant
                                                                    $plantPhysicalValue = $physical_values->plant_and_risk_id ?? '{}';
                                                                    $plantRisks = json_decode($plantPhysicalValue, true);
                                                                    $img_ids = array_unique(array_merge(...array_values($plantRisks)));
                                                                    // dd($plantPhysicalValue,$plantRisks,$img_ids);
                                                                @endphp
                                                                @foreach ($physical_img as $key => $img)
                                                                    <li>
                                                                        {{-- <input type="hidden" name="img[{{$key}}][img_id]" value="{{ $img->id }}"/> --}}
                                                                        <input type="checkbox" name="img_selection[]" id="myCheckbox{{$key}}" value="{{ $img->id }}" {{ in_array($img->id, $img_ids) ? 'checked' : '' }}/>
                                                                        <label class="img_label" for="myCheckbox{{$key}}">
                                                                            <img src="{{ asset('assets/physical_risk_img/' . $img->img_name . '.jpg') }}" alt="Image{{$key}}" />
                                                                            <div class="text-center">
                                                                                {{$img->particular}}
                                                                            </div>
                                                                        </label>
                                                                    </li>
                                                                @endforeach
                                                              </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.physical.index') }}"
                                class="btn btn-warning btn-sm float-left"> <i
                                    class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-1 offset-md-3">

                                {{-- <a class="btn btn-warning m-2 btn-sm form-control form-control-sm"
                                        href="{{ route('user.print_preview', ['com_id'=>encrypt($user->id), 'fy_id'=>encrypt($fy_id)]) }}">
                                        Print Preview</a> --}}
                                {{-- @if(!$busi_value->isEmpty()) --}}
                                    <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                            class="fas fa-save"></i>
                                        Update</button>
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
    {!! JsValidator::formRequest('App\Http\Requests\User\GovernanceRequest', '#gov_store') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>

        $(document).ready(function() {


        });

    </script>
@endpush






