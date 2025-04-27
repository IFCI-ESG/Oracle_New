@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])


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
        <form action="{{ route('user.seq.update') }}" id="seq_store" role="form" method="post"
            class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
            accept-charset="utf-8">
            @csrf
            {{-- <input type="hidden" value="{{ $fy_id }}" name="fy_id"> --}}
            <input type="hidden" value="{{ $module_mast->id }}" name="module_mast_id">

            <div class="card card-outline-seq card-tabs shadow-lg">
                <div class="card-header p-0 pt-3 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                role="tab" aria-controls="social" aria-selected="true"><b >Carbon SEQ For FY-{{$fys->fy}}</b></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="governance" role="tabpanel" aria-labelledby="governance-tab">

                            <div class="card card-outline-seq">
                                <div class="card-header">
                                    <input type="radio" name="seq_type" class="form-check-input-lg" id="individual_radio" value="individual" @if($seq_value->first()->seq_type == 'individual') checked @endif>
                                    <b>If Individual Tree Level Data Available</b>
                                    <a class="btn btn-primary btn-sm float-right mb-2" id="addmore_individual" @if($seq_value->first()->seq_type != 'individual') disabled @endif>
                                        <i class="fa fa-plus"></i> Add Row
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <table class="table table-bordered table-hover table-sm table-striped" id="individual_table">
                                        <thead>
                                            <tr class="text-center table-seq">
                                                <th style="width: 5%" class="text-center">
                                                    Sr. No.
                                                </th>
                                                <th class="text-center">
                                                    Species
                                                </th>
                                                <th class="text-center">
                                                    GBH(m)
                                                </th>
                                                <th class="text-center">
                                                    DBH (m)
                                                </th>
                                                <th class="text-center">
                                                    Height (m)
                                                </th>
                                                <th class="text-center">
                                                    Volume (cubic meter)
                                                </th>
                                                <th class="text-center">
                                                    Density (t/m3)
                                                </th>
                                                <th class="text-center">
                                                    AGB (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    BGB (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Total Biomass (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Carbon Content (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Co2 Sequestered (t)
                                                </th>
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($seq_value->first()->seq_type == 'individual')
                                                @foreach ($seq_value as $key=>$val)
                                                    <tr class="individual_class">
                                                        <td class="text-center">
                                                            {{$key+1}}
                                                            <input type="hidden" value="{{$val->id}}" name="individual[{{$key}}][row_id]">
                                                        </td>
                                                        <td><input type="text" class="form-control form-control-sm" value="{{$val->species}}" name="individual[{{$key}}][species]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->gbh}}" name="individual[{{$key}}][gbh]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="individual[{{$key}}][dbh]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->height}}" name="individual[{{$key}}][height]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="individual[{{$key}}][volume]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->density}}" name="individual[{{$key}}][density]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="individual[{{$key}}][agb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="individual[{{$key}}][bgb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="individual[{{$key}}][total_biomass]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="individual[{{$key}}][carbon_content]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="individual[{{$key}}][co2_sequestered]" disabled></td>
                                                        @if ($key>0)
                                                            <td class="text-center">
                                                                <a class="btn btn-danger btn-sm" onclick="deleteRow({{ $val->id }})"><i class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr style="display: none;" id="individual_row">
                                                    <td class="text-center">1.</td>
                                                    <td><input type="text" class="form-control form-control-sm" name="individual[0][species]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][gbh]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][dbh]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][height]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][volume]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][density]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][agb]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][bgb]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][total_biomass]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][carbon_content]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="individual[0][co2_sequestered]" disabled></td>
                                                    {{-- <td class="text-center">
                                                        <a class="btn btn-danger btn-sm remove-row"><i class="far fa-trash-alt"></i></a>
                                                    </td> --}}
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card card-outline-seq">
                                <div class="card-header">
                                    <input type="radio" name="seq_type" class="form-check-input-lg" id="multiple_radio" value="multiple" @if ($seq_value->first()->seq_type == 'multiple') checked @endif>
                                    <b>If total no. of trees planted data of even age class is available</b>
                                    <a class="btn btn-primary btn-sm float-right mb-2" id="addmore_multiple" @if ($seq_value->first()->seq_type != 'multiple') disabled @endif>
                                        <i class="fa fa-plus"></i> Add Row
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <table class="table table-bordered table-hover table-sm table-striped" id="multiple_table">
                                        <thead>
                                            <tr class="text-center table-seq">
                                                <th style="width: 5%" class="text-center">
                                                    Sr. No.
                                                </th>
                                                <th class="text-center">
                                                    Species
                                                </th>
                                                <th class="text-center">
                                                    No. of Trees
                                                </th>
                                                <th class="text-center">
                                                    GBH(m) of single tree
                                                </th>
                                                <th class="text-center">
                                                    DBH (m) of single tree
                                                </th>
                                                <th class="text-center">
                                                    Height (m) of single tree
                                                </th>
                                                <th class="text-center">
                                                    Volume (cubic meter)
                                                </th>
                                                <th class="text-center">
                                                    Density (t/m3)
                                                </th>
                                                <th class="text-center">
                                                    AGB (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    BGB (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Total Biomass (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Carbon Content (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Co2 Sequestered (t) in one tree
                                                </th>
                                                <th class="text-center">
                                                    Total for "n" trees
                                                </th>
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($seq_value->first()->seq_type == 'multiple')
                                                @foreach ($seq_value as $key=>$val)
                                                    <tr class="multiple_class">
                                                        <td class="text-center">
                                                            {{$key+1}}
                                                            <input type="hidden" value="{{$val->id}}" name="multiple[{{$key}}][row_id]">
                                                        </td>
                                                        <td><input type="text" class="form-control form-control-sm" value="{{$val->species}}" name="multiple[{{$key}}][species]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->no_of_trees}}" name="multiple[{{$key}}][no_of_trees]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->gbh}}" name="multiple[{{$key}}][gbh]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][dbh]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->height}}" name="multiple[{{$key}}][height]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][volume]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->density}}" name="multiple[{{$key}}][density]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][agb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][bgb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][total_biomass]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][carbon_content]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][co2_sequestered]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="multiple[{{$key}}][total_for_n_trees]" disabled></td>
                                                        @if ($key>0)
                                                            <td class="text-center">
                                                                <a class="btn btn-danger btn-sm" onclick="deleteRow({{ $val->id }})"><i class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr style="display: none;" id="multiple_row">
                                                    <td class="text-center">1.</td>
                                                    <td><input type="text" class="form-control form-control-sm" name="multiple[0][species]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][no_of_trees]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][gbh]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][dbh]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][height]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][volume]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][density]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][agb]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][bgb]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][total_biomass]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][carbon_content]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][co2_sequestered]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="multiple[0][total_for_n_trees]" disabled></td>
                                                    {{-- <td class="text-center">
                                                        <a class="btn btn-danger btn-sm remove-row"><i class="far fa-trash-alt"></i></a>
                                                    </td> --}}
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card card-outline-seq">
                                <div class="card-header">
                                    <input type="radio" name="seq_type" class="form-check-input-lg" id="area_radio" value="area" @if ($seq_value->first()->seq_type == 'area') checked @endif>
                                    <b>If sample area of even age class tree data is given</b>
                                    <a class="btn btn-primary btn-sm float-right mb-2" id="addmore_area" @if ($seq_value->first()->seq_type != 'area') disabled @endif>
                                        <i class="fa fa-plus"></i> Add Row
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <!-- Div for Sample Area and Total Area -->
                                    <div class="row justify-content-center mb-3">
                                        <div class="col-md-3">
                                            <label for="sample_area" class="form-label">Sample Area (ha):</label>
                                            <input type="number" name="sample_area" @if($seq_value->first()->sample_area) value="{{$seq_value->first()->sample_area}}" @endif  id="sample_area" class="form-control" placeholder="Enter Sample Area">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="total_area" class="form-label">Total Area (ha):</label>
                                            <input type="number" name="total_area" @if($seq_value->first()->total_area) value="{{$seq_value->first()->total_area}}" @endif id="total_area" class="form-control" placeholder="Enter Total Area">
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover table-sm table-striped" id="area_table">
                                        <thead>
                                            <tr class="text-center table-seq">
                                                <th style="width: 5%" class="text-center">
                                                    Sr. No.
                                                </th>
                                                <th class="text-center">
                                                    Species
                                                </th>
                                                <th class="text-center">
                                                    GBH(m)
                                                </th>
                                                <th class="text-center">
                                                    DBH (m)
                                                </th>
                                                <th class="text-center">
                                                    Height (m)
                                                </th>
                                                <th class="text-center">
                                                    Volume (cubic meter)
                                                </th>
                                                <th class="text-center">
                                                    Density (t/m3)
                                                </th>
                                                <th class="text-center">
                                                    AGB (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    BGB (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Total Biomass (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Carbon Content (tonnes)
                                                </th>
                                                <th class="text-center">
                                                    Co2 Sequestered (t)
                                                </th>
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($seq_value->first()->seq_type == 'area')
                                                @foreach ($seq_value as $key=>$val)
                                                    <tr class="area_class">
                                                        <td class="text-center">
                                                            {{$key+1}}
                                                            <input type="hidden" value="{{$val->id}}" name="area[{{$key}}][row_id]">
                                                        </td>
                                                        <td><input type="text" class="form-control form-control-sm" value="{{$val->species}}" name="area[{{$key}}][species]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->gbh}}" name="area[{{$key}}][gbh]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="area[{{$key}}][dbh]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->height}}" name="area[{{$key}}][height]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" name="area[{{$key}}][volume]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right" value="{{$val->density}}" name="area[{{$key}}][density]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="area[{{$key}}][agb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="area[{{$key}}][bgb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="area[{{$key}}][total_biomass]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="area[{{$key}}][carbon_content]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right"  name="area[{{$key}}][co2_sequestered]" disabled></td>
                                                        @if ($key>0)
                                                            <td class="text-center">
                                                                <a class="btn btn-danger btn-sm" onclick="deleteRow({{ $val->id }})"><i class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr style="display: none;" id="area_row">
                                                    <td class="text-center">1.</td>
                                                    <td><input type="text" class="form-control form-control-sm" name="area[0][species]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][gbh]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][dbh]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][height]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][volume]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][density]"></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][agb]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][bgb]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][total_biomass]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][carbon_content]" disabled></td>
                                                    <td><input type="number" class="form-control form-control-sm text-right" name="area[0][co2_sequestered]" disabled></td>
                                                    {{-- <td class="text-center">
                                                        <a class="btn btn-danger btn-sm remove-row"><i class="far fa-trash-alt"></i></a>
                                                    </td> --}}
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="11" class="text-right">Total for sample area (ha)</td>
                                                <td><input type="number" class="form-control form-control-sm text-right" id="total_sample" readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="11" class="text-right">For 1 (ha)</td>
                                                <td><input type="number" class="form-control form-control-sm text-right" id="for_1" readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="11" class="text-right">For Total area (ha)</td>
                                                <td><input type="number" class="form-control form-control-sm text-right" id="for_total" readonly></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row pb-2 mt-2">
                    <div class="col-md-2 ml-4">
                        <a href="{{ route('user.seq.index') }}"
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


{!! JsValidator::formRequest('App\Http\Requests\User\SEQRequest', '#seq_store') !!}
@include('partials.js.prevent_multiple_submit')
<script>
$(document).ready(function () {

    setTimeout(function () {
        // Trigger keyup for tables to recalculate values
        $('#individual_table, #multiple_table, #area_table').find('input').trigger('keyup');

        // Call calculateFormulas for each row in all tables
        $('#individual_table tbody tr, #multiple_table tbody tr, #area_table tbody tr').each(function () {
            calculateFormulas($(this));
        });

        // Trigger total area calculation
        calculateTotalArea();
    }, 2000);

    let SampleAreaValue = '';
    let TotalAreaValue = '';

    $('#individual_table, #multiple_table, #area_table').on('keyup', 'input', function () {
        const row = $(this).closest('tr'); // Get the current row
        calculateFormulas(row); // Perform calculations for the current row
        calculateTotalArea(); // Update total area whenever inputs change
    });

    $('#individual_row').hide(); // Hide all rows in the individual table
    $('#multiple_row').hide(); // Hide all rows in the multiple table
    $('#area_row').hide(); // Hide all rows in the area table
    // Initially disable both Add Row buttons
    let selectedRadio = $('input[name="seq_type"]:checked').val();

    // Call the change handler logic to enable/disable buttons
    if (selectedRadio === 'individual') {
        $('#addmore_individual').removeClass('disabled').prop('disabled', false);
        $('#addmore_multiple').addClass('disabled').prop('disabled', true);
        $('#addmore_area').addClass('disabled').prop('disabled', true);
        $('#sample_area').addClass('disabled').prop('disabled', true);
        $('#total_area').addClass('disabled').prop('disabled', true);
    } else if (selectedRadio === 'multiple') {
        $('#addmore_individual').addClass('disabled').prop('disabled', true);
        $('#addmore_multiple').removeClass('disabled').prop('disabled', false);
        $('#addmore_area').addClass('disabled').prop('disabled', true);
        $('#sample_area').addClass('disabled').prop('disabled', true);
        $('#total_area').addClass('disabled').prop('disabled', true);
    } else if (selectedRadio === 'area') {
        $('#addmore_individual').addClass('disabled').prop('disabled', true);
        $('#addmore_multiple').addClass('disabled').prop('disabled', true);
        $('#addmore_area').removeClass('disabled').prop('disabled', false);
        $('#sample_area').removeClass('disabled').prop('disabled', false);
        $('#total_area').removeClass('disabled').prop('disabled', false);
    }
    // $('#addmore_individual').addClass('disabled').prop('disabled', true);
    // $('#addmore_multiple').addClass('disabled').prop('disabled', true);
    // $('#addmore_area').addClass('disabled').prop('disabled', true);
    // $('#sample_area').addClass('disabled').prop('disabled', true);
    // $('#total_area').addClass('disabled').prop('disabled', true);


    // Enable/disable Add Row buttons based on selected radio button
    $('input[name="seq_type"]').on('change', function () {

        $('#individual_row').hide();
        $('#multiple_row').hide();
        $('#area_row').hide();

        if ($(this).val() === 'individual')
        {
            // If 'Individual Tree Level Data' is selected
            $('#addmore_area').addClass('disabled').prop('disabled', true);
            $('#addmore_multiple').addClass('disabled').prop('disabled', true);
            $('#sample_area').addClass('disabled').prop('disabled', true);
            $('#total_area').addClass('disabled').prop('disabled', true);
            $('#addmore_individual').removeClass('disabled').prop('disabled', false);
            // $('#multiple_table tbody').empty(); // Clear rows from Multiple table
            // $('#area_table tbody').empty();
            $('.multiple_class').hide();
            $('.area_class').hide();
            $('#individual_row').show();
            $('.individual_class').show();
            SampleAreaValue = $('#sample_area').val();
            TotalAreaValue = $('#total_area').val();
            $('#sample_area').val('');
            $('#total_area').val('');
            $('#total_sample').val('');
            $('#for_1').val('');
            $('#for_total').val('');
        } else if ($(this).val() === 'multiple')
        {
            // If 'Total Trees Planted Data' is selected
            $('#addmore_individual').addClass('disabled').prop('disabled', true);
            $('#addmore_area').addClass('disabled').prop('disabled', true);
            $('#sample_area').addClass('disabled').prop('disabled', true);
            $('#total_area').addClass('disabled').prop('disabled', true);
            $('#addmore_multiple').removeClass('disabled').prop('disabled', false);
            // $('#individual_table tbody').empty(); // Clear rows from Individual table
            // $('#area_table tbody').empty(); // Clear rows from Multiple table
            $('.area_class').hide();
            $('#individual_row').hide();
            $('.individual_class').hide();
            $('#multiple_row').show();
            $('.multiple_class').show();
            SampleAreaValue = $('#sample_area').val();
            TotalAreaValue = $('#total_area').val();
            $('#sample_area').val('');
            $('#total_area').val('');
            $('#total_sample').val('');
            $('#for_1').val('');
            $('#for_total').val('');
        } else if ($(this).val() === 'area')
        {
            // If 'Total Trees Planted Data' is selected
            $('#addmore_multiple').addClass('disabled').prop('disabled', true);
            $('#addmore_individual').addClass('disabled').prop('disabled', true);
            $('#sample_area').removeClass('disabled').prop('disabled', false);
            $('#total_area').removeClass('disabled').prop('disabled', false);
            $('#addmore_area').removeClass('disabled').prop('disabled', false);
            $('#area_row').show();
            $('.area_class').show();
            $('#sample_area').val(SampleAreaValue);
            $('#total_area').val(TotalAreaValue);
            $('#individual_row').hide();
            $('.individual_class').hide();
            $('#multiple_row').hide();
            $('.multiple_class').hide();
            // $('#individual_table tbody').empty(); // Clear rows from Individual table
            // $('#multiple_table tbody').empty(); // Clear rows from Multiple table
        }
    });

    // Add Row functionality for Individual Table
    let individualIndex = 1;
    $('#addmore_individual').click(function () {
        $('#individual_table tbody').append(
            `<tr>
                <td class="text-center">${individualIndex}</td>
                <td><input type="text" class="form-control form-control-sm" name="individual[${individualIndex}][species]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][gbh]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][dbh]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][height]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][volume]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][density]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][agb]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][bgb]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][total_biomass]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][carbon_content]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="individual[${individualIndex}][co2_sequestered]" disabled></td>
                <td class="text-center">
                    <a class="btn btn-danger btn-sm remove-row"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>`
        );
        individualIndex++;
    });

    // Add Row functionality for Multiple Table
    let multipleIndex = 1;
    $('#addmore_multiple').click(function () {
        $('#multiple_table tbody').append(
            `<tr>
                <td class="text-center">${multipleIndex}</td>
                <td><input type="text" class="form-control form-control-sm" name="multiple[${multipleIndex}][species]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][no_of_trees]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][gbh]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][dbh]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][height]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][volume]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][density]"></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][agb]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][bgb]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][total_biomass]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][carbon_content]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][co2_sequestered]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right" name="multiple[${multipleIndex}][total_for_n_trees]" disabled></td>
                <td class="text-center">
                    <a class="btn btn-danger btn-sm remove-row"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>`
        );
        multipleIndex++;
    });

    // Add Row functionality for Area Table
    let areaIndex = 1;
    $('#addmore_area').click(function () {
        $('#area_table tbody').append(
            `<tr>
                <td class="text-center">${areaIndex}</td>
                <td><input type="text" class="form-control form-control-sm" name="area[${areaIndex}][species]"></td>
                <td><input type="number" class="form-control form-control-sm text-right gbh" name="area[${areaIndex}][gbh]"></td>
                <td><input type="number" class="form-control form-control-sm text-right dbh" name="area[${areaIndex}][dbh]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right height" name="area[${areaIndex}][height]"></td>
                <td><input type="number" class="form-control form-control-sm text-right volume" name="area[${areaIndex}][volume]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right density" name="area[${areaIndex}][density]"></td>
                <td><input type="number" class="form-control form-control-sm text-right agb" name="area[${areaIndex}][agb]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right bgb" name="area[${areaIndex}][bgb]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right total_biomass" name="area[${areaIndex}][total_biomass]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right carbon_content" name="area[${areaIndex}][carbon_content]" disabled></td>
                <td><input type="number" class="form-control form-control-sm text-right co2_sequestered" name="area[${areaIndex}][co2_sequestered]" disabled></td>
                <td class="text-center">
                    <a class="btn btn-danger btn-sm remove-row"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>`
        );
        areaIndex++;
        calculateTotalArea();
    });

    // Remove Row functionality
    $('table').on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        calculateTotalArea();
    });

    $('#sample_area, #total_area').on('keyup change', calculateTotalArea);
    $('#area_table').on('keyup change', '.gbh, .height, .density', function () {
        calculateTotalArea();
    });
});

function calculateFormulas(row)
{
    const gbh = parseFloat(row.find('input[name$="[gbh]"]').val()) || 0;
    const height = parseFloat(row.find('input[name$="[height]"]').val()) || 0;
    const density = parseFloat(row.find('input[name$="[density]"]').val()) || 0;
    const noOfTrees = parseFloat(row.find('input[name$="[no_of_trees]"]').val()) || 1; // Default to 1 if not present or empty

    const dbh = gbh / 3.14;
    const volume = (3.14 * dbh) * (dbh / 4) * height;
    const agb = volume * density * 1.51;
    const bgb = agb * 0.28;
    const totalBiomass = agb + bgb;
    const carbonContent = totalBiomass * 0.47;
    const co2Sequestered = carbonContent * 3.67;

    // "Total for n trees" calculation (only for multiple table)
    const totalForNTrees = co2Sequestered * noOfTrees;

    // Update calculated values in the respective input fields
    row.find('input[name$="[dbh]"]').val(dbh.toFixed(2));
    row.find('input[name$="[volume]"]').val(volume.toFixed(2));
    row.find('input[name$="[agb]"]').val(agb.toFixed(2));
    row.find('input[name$="[bgb]"]').val(bgb.toFixed(2));
    row.find('input[name$="[total_biomass]"]').val(totalBiomass.toFixed(2));
    row.find('input[name$="[carbon_content]"]').val(carbonContent.toFixed(2));
    row.find('input[name$="[co2_sequestered]"]').val(co2Sequestered.toFixed(2));

    // Update "Total for n trees" only if the field exists (multiple table)
    if (row.find('input[name$="[total_for_n_trees]"]').length) {
        row.find('input[name$="[total_for_n_trees]"]').val(totalForNTrees.toFixed(2));
    }
}

// Calculate totals for the footer
function calculateTotalArea()
{
    let totalSampleArea = 0;
    let sampleArea = parseFloat($('#sample_area').val()) || 0;
    let totalArea = parseFloat($('#total_area').val()) || 0;

    $('#area_table .co2_sequestered').each(function () {
        totalSampleArea += parseFloat($(this).val()) || 0;
    });

    $('#total_sample').val(totalSampleArea.toFixed(2));
    let for1Ha = sampleArea > 0 ? totalSampleArea / sampleArea : 0;
    $('#for_1').val(for1Ha.toFixed(2));
    let forTotalArea = for1Ha * totalArea;
    $('#for_total').val(forTotalArea.toFixed(2));
}

function deleteRow(row_id) {
    swal({
            title: "Do You Want to Delete this Record",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: {
                    text: "Yes",
                    value: "Y",
                },
            },
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((result) => {
            if (result == 'Y') {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: '../row_delete/' + row_id + '/seq',
                    success: function(data) {
                        console.log(data);
                        if (data == true) {
                            swal(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success')
                            window.location.reload();
                        } else {
                            swal(
                                'Not Deleted!',
                                'Your record has not been Deleted.',
                                'warning')

                        }
                    }
                })
            }
        });
}



</script>
@endsection
