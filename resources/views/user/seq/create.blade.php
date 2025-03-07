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
        <div class="row " style="margin-top: 10vh;">
            <div class="col-md-12">
                <form action="{{ route('user.seq.store') }}" id="seq_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" value="{{ $fy_id }}" name="fy_id">
                    <input type="hidden" value="{{ $user->id }}" name="com_id">

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
                                            <input type="radio" name="seq_type" class="form-check-input-lg" id="individual_radio" value="individual">
                                            <b>If Individual Tree Level Data Available</b>
                                            <a class="btn btn-primary btn-sm float-right mb-2" id="addmore_individual" disabled>
                                                <i class="fa fa-plus"></i> Add Row
                                            </a>
                                        </div>
                                        <div class="card-body p-3 table-container">
                                            <table class="table-responsive "  id="individual_table">
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-outline-seq">
                                        <div class="card-header">
                                            <input type="radio" name="seq_type" class="form-check-input-lg" id="multiple_radio" value="multiple">
                                            <b>If total no. of trees planted data of even age class is available</b>
                                            <a class="btn btn-primary btn-sm float-right mb-2" id="addmore_multiple" disabled>
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-outline-seq">
                                        <div class="card-header">
                                            <input type="radio" name="seq_type" class="form-check-input-lg" id="area_radio" value="area">
                                            <b>If sample area of even age class tree data is given</b>
                                            <a class="btn btn-primary btn-sm float-right mb-2" id="addmore_area" disabled>
                                                <i class="fa fa-plus"></i> Add Row
                                            </a>
                                        </div>
                                        <div class="card-body p-3">
                                            <!-- Div for Sample Area and Total Area -->
                                            <div class="row justify-content-center mb-3">
                                                <div class="col-md-3">
                                                    <label for="sample_area" class="form-label">Sample Area (ha):</label>
                                                    <input type="number" name="sample_area" id="sample_area" class="form-control" placeholder="Enter Sample Area">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="total_area" class="form-label">Total Area (ha):</label>
                                                    <input type="number" name="total_area" id="total_area" class="form-control" placeholder="Enter Total Area">
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
                                                    <tr style="display: none;" id="area_row">
                                                        <td class="text-center">1.</td>
                                                        <td><input type="text" class="form-control form-control-sm" name="area[0][species]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right gbh" name="area[0][gbh]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right dbh" name="area[0][dbh]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right height" name="area[0][height]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right volume" name="area[0][volume]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right density" name="area[0][density]"></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right agb" name="area[0][agb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right bgb" name="area[0][bgb]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right total_biomass" name="area[0][total_biomass]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right carbon_content" name="area[0][carbon_content]" disabled></td>
                                                        <td><input type="number" class="form-control form-control-sm text-right co2_sequestered" name="area[0][co2_sequestered]" disabled></td>
                                                        {{-- <td class="text-center">
                                                            <a class="btn btn-danger btn-sm remove-row"><i class="far fa-trash-alt"></i></a>
                                                        </td> --}}
                                                    </tr>
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

                          
                                    <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                            class="fas fa-save"></i>
                                        Save As Draft</button>
                              
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
    </div>



    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function () {

            $('#individual_table, #multiple_table, #area_table').on('keyup', 'input', function () {
                const row = $(this).closest('tr'); // Get the current row
                calculateFormulas(row); // Perform calculations for the current row
                calculateTotalArea(); // Update total area whenever inputs change
            });

            $('#individual_table tbody tr').hide(); // Hide all rows in the individual table
            $('#multiple_table tbody tr').hide(); // Hide all rows in the multiple table
            $('#area_table tbody tr').hide(); // Hide all rows in the area table
            // Initially disable both Add Row buttons
            $('#addmore_individual').addClass('disabled').prop('disabled', true);
            $('#addmore_multiple').addClass('disabled').prop('disabled', true);
            $('#addmore_area').addClass('disabled').prop('disabled', true);
            $('#sample_area').addClass('disabled').prop('disabled', true);
            $('#total_area').addClass('disabled').prop('disabled', true);

            // Enable/disable Add Row buttons based on selected radio button
            $('input[name="seq_type"]').on('change', function () {
                  // Hide all rows initially
                $('#individual_table tbody tr').hide();
                $('#multiple_table tbody tr').hide();
                $('#area_table tbody tr').hide();
                if ($(this).val() === 'individual') {
                    // If 'Individual Tree Level Data' is selected
                    $('#addmore_area').addClass('disabled').prop('disabled', true);
                    $('#addmore_multiple').addClass('disabled').prop('disabled', true);
                    $('#sample_area').addClass('disabled').prop('disabled', true);
                    $('#total_area').addClass('disabled').prop('disabled', true);
                    $('#addmore_individual').removeClass('disabled').prop('disabled', false);
                    // $('#multiple_table tbody').empty(); // Clear rows from Multiple table
                    // $('#area_table tbody').empty();
                    $('#individual_row').show();
                    $('#sample_area').val('');
                    $('#total_area').val('');
                    $('#total_sample').val('');
                    $('#for_1').val('');
                    $('#for_total').val('');
                } else if ($(this).val() === 'multiple') {
                    // If 'Total Trees Planted Data' is selected
                    $('#addmore_individual').addClass('disabled').prop('disabled', true);
                    $('#addmore_area').addClass('disabled').prop('disabled', true);
                    $('#sample_area').addClass('disabled').prop('disabled', true);
                    $('#total_area').addClass('disabled').prop('disabled', true);
                    $('#addmore_multiple').removeClass('disabled').prop('disabled', false);
                    // $('#individual_table tbody').empty(); // Clear rows from Individual table
                    // $('#area_table tbody').empty(); // Clear rows from Multiple table
                    $('#multiple_row').show();
                    $('#sample_area').val('');
                    $('#total_area').val('');
                    $('#total_sample').val('');
                    $('#for_1').val('');
                    $('#for_total').val('');
                } else if ($(this).val() === 'area') {
                    // If 'Total Trees Planted Data' is selected
                    $('#addmore_multiple').addClass('disabled').prop('disabled', true);
                    $('#addmore_individual').addClass('disabled').prop('disabled', true);
                    $('#sample_area').removeClass('disabled').prop('disabled', false);
                    $('#total_area').removeClass('disabled').prop('disabled', false);
                    $('#addmore_area').removeClass('disabled').prop('disabled', false);
                    // $('#individual_table tbody').empty(); // Clear rows from Individual table
                    // $('#multiple_table tbody').empty(); // Clear rows from Multiple table
                    $('#area_row').show();
                }
            });

            // Add Row functionality for Individual Table
            let individualIndex = 1;
            $('#addmore_individual').click(function () {
                $('#individual_table').append(
                    `<tr>
                        <td class="text-center">${individualIndex+1}.</td>
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
                $('#multiple_table').append(
                    `<tr>
                        <td class="text-center">${multipleIndex+1}.</td>
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
                $('#area_table').append(
                    `<tr>
                        <td class="text-center">${areaIndex+1}.</td>
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




    </script>
@endsection
