@extends('layouts.user.dashboard-master')

@section('content')
    <div class="main-body">
        @if ($errors->any())
            <h4>{{ $errors->first() }}</h4>
        @endif
        <div class="container">
            <div class="row" style=" display:block; ">
                <form action=" {{ route('user.application.store') }}" class="prevent_multiple_submit" id="application-create" method="post" enctype="multipart/form-data">
                    @csrf
                    <small class="text-danger">(All fields are mandatory)</small>
                    <div class="card border-primary ">
                        <div class="card-header bg-gradient-info">
                            <b>1. Financial History (Rs. in Crore)</b>
                            {{-- <a href="{{route('user.baseline_create')}}">baseline</a> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover" id="shareholder-table">
                                <tbody>
                                    <tr class="table-primary">
                                        <th class="text-center">Participant</th>
                                        @foreach ($fys->where('id','<>',4) as $fy)
                                            <th class="text-center">
                                                    FY {{ $fy->year }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    @foreach ($particulars as $key => $particular)
                                        @if($particular->id == 1)
                                            <tr>
                                                <td>1) Target Segment</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>
                                                <p>
                                                   {!!$particular->particular!!}<span class="text-danger">*</span>
                                                </p>
                                            </td>
                                            @foreach ($fys->where('id','<>',4) as $fy)
                                                <td class="text-center">
                                                    <input type="hidden" name="financial[{{ $key }}][fy{{ $fy->year }}][part_id]"
                                                        class="form-control form-control-sm" value="{{ $particular->id }}" @if($particular->id == 5) disabled  @endif>
                                                    <input type="hidden" name="financial[{{ $key }}][fy{{ $fy->year }}][fy_id]"
                                                        class="form-control form-control-sm" value="{{ $fy->id }}" @if($particular->id == 5) disabled  @endif>
                                                    <input type="number" name="financial[{{ $key }}][fy{{$fy->year}}][value]"
                                                        class="form-control form-control-sm {{ ($particular->id == 1 || $particular->id == 2 || $particular->id == 3 || $particular->id == 4) ? 'rev_fy'.$fy->year : (($particular->id == 8 || $particular->id == 9) ? 'fin_fy'.$fy->year : 'tax')}}"
                                                        @if($particular->id == 5) id="rev_tot_fy{{$fy->year}}" disabled  @endif
                                                        @if($particular->id != 5 && $particular->id != 6 && $particular->id != 7) onkeyup="Total(this)"@endif>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            Net worth[A+B]
                                        </td>
                                        <td>
                                            <input type="number" name="financial_tot_fy2020" disabled
                                                id="financial_tot_fy2020" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input type="number" name="financial_tot_fy2021" disabled
                                                id="financial_tot_fy2021" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input type="number" name="financial_tot_fy2022" disabled
                                                id="financial_tot_fy2022" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card border-primary ">
                        <div class="card-header bg-gradient-info">
                            <b>2. MANUFACTURING LOCATIONS</b>
                        </div>
                        <div class="card border-primary" style="margin:4px;">
                            <div class="card-header bg-gradient-info">
                                <b>2.1. Current</b>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-hover" id="">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center">Address of location<span class="text-danger">*</span></th>
                                            <th class="text-center">GSTIN<span class="text-danger">*</span></th>
                                            <th class="text-center">Pin<span class="text-danger">*</span></th>
                                            <th class="text-center">State<span class="text-danger">*</span></th>
                                            <th class="text-center">City/Town/Village<span class="text-danger">*</span></th>
                                            <th class="text-center">District<span class="text-danger">*</span></th>
                                        </tr>

                                        <tr id="">
                                            <td>
                                                <input type="text" name="currloc[currmanufacturing_location]" id="currlocmanufacturing_location0" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="currloc[currgstin]" id="currlocAddGstin0" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number" name="currloc[currpincode]" id="pincode0" class="form-control form-control-sm" onkeyup="GetCityByPinCode('currloc',this.value,0)">
                                                <span id="pincodeMsg0" style="color:red;font-weight:bold;display: none"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="currloc[currstate]" id="currlocAddState0" class="form-control form-control-sm" readonly>
                                            </td>
                                            <td class="text-center">
                                                <select name="currloc[currcity]" id="currlocAddCity0" class="form-control form-control-sm">
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <select name="currloc[currdistrict]" id="currlocAddDistrict0" class="form-control form-control-sm">
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card border-primary" style="margin:4px;">
                            <div class="card-header bg-gradient-info">
                                <b>2.2. Proposed</b>
                                <a class="btn btn-success btn-sm float-right mb-2" id="location_addmore">
                                    <i class="fa fa-plus"></i> Add Row</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-hover" id="location-table">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center">Address of location<span class="text-danger">*</span></th>
                                            <th class="text-center">GSTIN<span class="text-danger">*</span></th>
                                            <th class="text-center">Pin<span class="text-danger">*</span></th>
                                            <th class="text-center">State<span class="text-danger">*</span></th>
                                            <th class="text-center">City/Town/Village<span class="text-danger">*</span></th>
                                            <th class="text-center">District<span class="text-danger">*</span></th>
                                            <th class="text-center">Action<span class="text-danger">*</span></th>
                                        </tr>

                                        <tr id="location-row0">
                                            <td>
                                                <input type="text" name="locations[0][manufacturing_location]" id="manufacturing_location0" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="locations[0][gstin]" id="locationsAddGstin0" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number" name="locations[0][pincode]" id="pincode0" class="form-control form-control-sm" onkeyup="GetCityByPinCode('locations',this.value,0)">
                                                <span id="pincodeMsg0" style="color:red;font-weight:bold;display: none"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="locations[0][state]" id="locationsAddState0" class="form-control form-control-sm" readonly>
                                            </td>
                                            <td class="text-center">
                                                <select name="locations[0][city]" id="locationsAddCity0" class="form-control form-control-sm">
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <select name="locations[0][district]" id="locationsAddDistrict0" class="form-control form-control-sm">
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary ">
                        <div class="card-header bg-gradient-info">
                            <b>3. PROPOSED SALES & INVESTMENT</b>
                        </div>
                        <div class="card border-primary" style="margin:4px;">
                            <div class="card-header bg-gradient-info">
                                <b> 3.1 Sales (Rs. in Crore)</b>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-hover" id="">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center">Key Parameters</th>
                                            @foreach ($fys->where('id','>',1) as $fy)
                                                <th class="text-center">
                                                        FY {{ $fy->fy }}
                                                </th>
                                            @endforeach
                                            @php
                                                $srl=0;
                                            @endphp
                                            {{-- <th class="text-center">Total</th> --}}
                                        </tr>
                                        <tr id="shareholder_addmore">
                                            @foreach ($all_particulars->where('section', '=', '3.1') as $key=>$part)
                                                <tr>
                                                    <td>
                                                        <p>{{ $part->particular }}<span class="text-danger">*</span></p>
                                                    </td>
                                                    @foreach ($fys->where('id','<>',1) as $fy)
                                                    <td class="text-center">
                                                        <input type="hidden" name="sales[{{ $srl }}][fy{{$fy->year}}][part_id]"
                                                            class="form-control form-control-sm" value="{{ $part->id }}">
                                                        <input type="hidden" name="sales[{{ $srl }}][fy{{$fy->year}}][fy_id]"
                                                            class="form-control form-control-sm" value="{{ $fy->id }}">
                                                        <input type="number" name="sales[{{ $srl }}][fy{{$fy->year}}][value]" onkeyup="Total(this)"
                                                            class="form-control form-control-sm {{'Dom_fy'.$fy->year}}">
                                                    </td>
                                                    @endforeach
                                                    {{-- <td>
                                                        <input type="number" name="emp_total" id="{{( $part->id == 3 ) ? 'direct_tot' : 'indirect_tot'}}" disabled
                                                        class="form-control form-control-sm total" onchange="Total(this)">
                                                    </td> --}}
                                                </tr>
                                                @php
                                                    $srl++;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td>
                                                    Total
                                                </td>
                                                <td>
                                                    <input type="number" name="totalSales_fy2021" id="totalSales_fy2021" disabled
                                                    class="form-control form-control-sm">
                                                </td>
                                                <td>
                                                    <input type="number" name="totalSales_fy2022" id="totalSales_fy2022" disabled
                                                    class="form-control form-control-sm">
                                                </td>
                                                <td>
                                                    <input type="number" name="totalSales_fy2023" id="totalSales_fy2023" disabled
                                                    class="form-control form-control-sm">
                                                </td>
                                                {{-- <td>
                                                    <input type="number" name="all_total" id="all_total" disabled
                                                    class="form-control form-control-sm">
                                                </td> --}}
                                            </tr>

                                            {{-- <td>
                                                <p>
                                                    {{ $all_particulars->where('section', '=', '3.1')->first()->particular }}
                                                </p>
                                            </td>
                                            @foreach ($fys->where('id','<>',1) as $key => $fy)
                                                <td class="text-center">
                                                    <input type="hidden" name="sales[fy{{$fy->year}}][part_id]"
                                                    class="form-control form-control-sm" value="{{ $all_particulars->where('section', '=', '3.1')->first()->id }}">
                                                    <input type="hidden" name="sales[fy{{$fy->year}}][fy_id]"
                                                    class="form-control form-control-sm" value="{{ $fy->id }}">
                                                    <input type="number" name="sales[fy{{$fy->year}}][value]" id="fy{{$fy->year}}"
                                                    class="form-control form-control-sm sales">
                                                </td>
                                            @endforeach
                                            <td>
                                                <input type="number" name="sales_total" id="sales_total" disabled
                                                class="form-control form-control-sm">
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card border-primary" style="margin:4px;">
                            <div class="card-header bg-gradient-info">
                                <b>3.2 Investment (Rs. in Crore)</b>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-hover" id="">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center">Projection</th>
                                            @foreach ($fys->where('id','>',1) as $fy)
                                                <th class="text-center">
                                                        FY {{ $fy->fy }} <br> {{($fy->id == 2) ? '(As on 31/03/2022)' : (($fy->id == 3) ? '(As on 31/03/2023)' : '(As on 31/03/2024)')}}
                                                </th>
                                            @endforeach
                                            {{-- <th class="text-center">Total</th> --}}
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>
                                                    {{ $all_particulars->where('section', '=', '3.2')->first()->particular }}<span class="text-danger">*</span>
                                                </p>
                                            </td>
                                            @foreach ($fys->where('id','<>',1) as $key => $fy)
                                                <td class="text-center">
                                                    <input type="hidden" name="investment[fy{{$fy->year}}][part_id]"
                                                    class="form-control form-control-sm" value="{{ $all_particulars->where('section', '=', '3.2')->first()->id }}">
                                                    <input type="hidden" name="investment[fy{{$fy->year}}][fy_id]"
                                                    class="form-control form-control-sm" value="{{ $fy->id }}">
                                                    <input type="number" name="investment[fy{{$fy->year}}][value]"
                                                    class="form-control form-control-sm investment">
                                                </td>
                                            @endforeach
                                            {{-- <td>
                                                <input type="number" name="investment_total" id="investment_total" disabled
                                                class="form-control form-control-sm">
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="card border-primary ">
                        <div class="card-header bg-gradient-info">
                            <b>4. PROPOSED EMPLOYMENT (In Nos.)</b>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover" id="shareholder-table">
                                <tbody>
                                    <tr class="table-primary">
                                        <th class="text-center">Projection</th>
                                        @foreach ($fys->where('id','>',1) as $fy)
                                            <th class="text-center">
                                                    FY {{ $fy->fy }} <br> {{($fy->id == 2) ? '(As on 31/03/2022)' : (($fy->id == 3) ? '(As on 31/03/2023)' : '(As on 31/03/2024)')}}
                                            </th>
                                        @endforeach
                                        {{-- <th class="text-center">Total</th> --}}
                                        @php
                                            $num=0;
                                        @endphp
                                    </tr>
                                    @foreach ($all_particulars->where('section', '=', '4') as $ky=>$part)
                                        <tr>
                                            <td>
                                                <p>{{ $part->particular }}<span class="text-danger">*</span></p>
                                            </td>
                                            @foreach ($fys->where('id','<>',1) as $fy)
                                                <td class="text-center">
                                                    <input type="hidden" name="employment[{{ $num }}][fy{{$fy->year}}][part_id]"
                                                    class="form-control form-control-sm" value="{{ $part->id }}">
                                                    <input type="hidden" name="employment[{{ $num }}][fy{{$fy->year}}][fy_id]"
                                                    class="form-control form-control-sm" value="{{ $fy->id }}">
                                                    <input type="number" name="employment[{{ $num }}][fy{{$fy->year}}][value]" onkeyup="Total(this)"
                                                    class="form-control form-control-sm {{'emp_fy'.$fy->year}}">
                                                </td>
                                            @endforeach
                                            {{-- <td>
                                                <input type="number" name="emp_total" id="{{( $part->id == 3 ) ? 'direct_tot' : 'indirect_tot'}}" disabled
                                                class="form-control form-control-sm total" onchange="Total(this)">
                                            </td> --}}
                                        </tr>
                                        @php
                                            $num++;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td>
                                            Total
                                        </td>
                                        <td>
                                            <input type="number" name="total_fy2021" id="total_fy2021" disabled
                                            class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input type="number" name="total_fy2022" id="total_fy2022" disabled
                                            class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input type="number" name="total_fy2023" id="total_fy2023" disabled
                                            class="form-control form-control-sm">
                                        </td>
                                        {{-- <td>
                                            <input type="number" name="all_total" id="all_total" disabled
                                            class="form-control form-control-sm">
                                        </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-primary">
                                <div class="card border-primary">
                                    <div class="card-header bg-gradient-info">
                                        <b>5. ANNEXURES </b>
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="table-responsive form-group">
                                            <table class="table table-sm table-bordered table-hover">
                                                <tbody>
                                                    @foreach ($docMasts as $key => $docMast)
                                                        <tr>
                                                            <td>
                                                                {{ $docMast->doc_particular }} {!! ($docMast->doc_serial!=8 && $docMast->doc_serial!=9) ? '<span class="text-danger">*</span>' : '' !!}
                                                                @if($docMast->doc_serial == 2)
                                                                    <a href="{{ asset('docs/app/Letter Of Authorisation.docx') }}"
                                                                        class="btn btn-primary btn-sm float-right"
                                                                        download="Letter Of Authorisation">Format</a>
                                                                @elseif($docMast->doc_serial == 4)
                                                                    <a href="{{ asset('docs/app/Undertaking on Credit History.docx') }}"
                                                                        class="btn btn-primary btn-sm float-right"
                                                                        download="Undertaking on Credit History">Format</a>
                                                                @elseif($docMast->doc_serial == 5)
                                                                    <a href="{{ asset('docs/app/Integrity Undertaking.docx') }}"
                                                                        class="btn btn-primary btn-sm float-right"
                                                                        download="Integrity Undertaking">Format</a>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="file" name="annexure[{{ $docMast->doc_type }}]" class="form-control form-control-sm">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border-primary" style="margin:4px;">
                                    <div class="card-header bg-gradient-info">
                                        <b>5.1 Eligibility as per scheme guideline</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered table-hover" id="d-table">
                                            <tbody>
                                                <tr class="table-primary">
                                                    <th class="text-center">Particular</th>
                                                    <th class="text-center">Period</th>
                                                    <th class="text-center">Target Segment</th>
                                                    <th class="text-center">Actual (Rs. in Crore)</th>
                                                    <th class="text-center">Minimum (Rs. in Crore)</th>
                                                </tr>

                                                <tr id="">
                                                    <td class="text-center">
                                                        <p>
                                                            {{ $all_particulars->where('section', '=', '5.1')->first()->particular }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="hidden" name="elgibility[fy_id]"
                                                            class="form-control form-control-sm" value="{{ $fys[1]->id }}">
                                                        <p>FY {{$fys[1]->fy}}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        {{$tar_seg->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="hidden" name="elgibility[part_id]"
                                                        class="form-control form-control-sm" value="{{ $all_particulars->where('section', '=', '5.1')->first()->id }}">
                                                        <input type="number" name="elgibility[actual]" id="actual"
                                                            class="form-control form-control-sm act">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="elgibility[minimum]" id="minimum"
                                                            class="form-control form-control-sm text-right" value="{{$tar_seg->name == 'Drones' ? '2' : '0.5'}}" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="card border-primary ">
                                    <div class="card-header bg-gradient-info">
                                        <b>5.2 Recommendation</b>
                                    </div>
                                    <div class="card-body">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="1" class="square-blue" id="checkbox" name="checkbox" required>
                                            The application by M/s {{ Auth::user()->name }} Limited is, <i>prima facie, </i>found to be Eligible/Ineligible under the Scheme, based on constitution of business, product segment applied for and sales achieved Rs. <span id="actual_price" class="font-weight-bold"></span> crore For FY 2020-21 is Recommended/Decline for issuance of Letter of Approval.
                                        </label>

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-group form-actions">
                                <div class="col-lg-9 col-12 text-center">
                                    <button type="submit" class="btn btn-primary" id="submit">Save as Draft
                                    </button>
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
    @include('user.partials.application.app_pincode-js')
    @include('user.partials.js.prevent_multiple_submit')
     {!! JsValidator::formRequest('App\Http\Requests\User\ApplicationRequest', '#application-create') !!}
    <script src="{{ asset('js/jsvalidation.min.js') }}"></script>
    <script src="{{ asset('js/jquery.multiselect.js') }}"></script>
    {{-- <script src="{{ asset('js/application/bootstrap-multiselect.js') }}"></script> --}}

    {{-- <link href="{{ asset('css/jquery.multiselect.css') }}" rel="stylesheet"> --}}
    <script>
        $(document).ready(function() {

            $(document).on('change', '.act', function() {
                var a = $(this).val();
                var b = document.getElementById("minimum").value;
                if(parseFloat(b)>parseFloat(a)){
                    swal(
                        'Not Accepted!',
                        'Actual Value is not less than minimum value.',
                        'warning')
                        $(this).val("");
                }
            });

            // $('#actual').blur(function (e) {
            // var name = $(this).val();
            // $("#actual_price").text(name);
            // });

            $('select[multiple].active.3col.elig').multiselect({
                columns: 2,
                placeholder: 'Select Product Segment',
                // search: true,
                // searchOptions: {
                //     'default': 'Search Eligible Products'
                // },
                selectAll: true
            });

            var locRowCount = 1;
            $('#location_addmore').click(function() {
                $('#location-table').append(
                    '<tr id="location-row' + locRowCount + '">' +
                    '<td>' +
                    '<input type="text" name="locations[' + locRowCount +
                    '][manufacturing_location]"' +
                    'id="manufacturing_location' + locRowCount +
                    '" class="form-control form-control-sm">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="locations[' + locRowCount + '][gstin]"' +
                    'id=locationsAddGstin' + locRowCount + ' class="form-control form-control-sm">' +
                    '</td>' +
                    '<td>' +
                    '<input type="number" name="locations[' + locRowCount + '][pincode]"' +
                    'id="pincode' + locRowCount + '" class="form-control form-control-sm" onkeyup="GetCityByPinCode(\'locations\',this.value,' + locRowCount +
                    ')"><span id="pincodeMsg' +
                    locRowCount +
                    '" style="color:red;font-weight:bold;display: none"></span></td>' +
                    '<td>' +
                    '<input type="text" name="locations[' + locRowCount + '][state]"' +
                    'id=locationsAddState' + locRowCount + ' class="form-control form-control-sm" readonly>' +
                    '</td>' +
                    '<td  class="text-center">' +
                    '<select name="locations[' + locRowCount + '][city]" id="locationsAddCity' + locRowCount + '" class="form-control form-control-sm" onchange="city(this)">'+
                    '</select>'+
                    '</td>' +
                    '<td  class="text-center">' +
                    '<select name="locations[' + locRowCount + '][district]" id="locationsAddDistrict' + locRowCount + '" class="form-control form-control-sm" onchange="district(this)">'+
                    '</select>'+
                    '</td>' +
                    '<td>' +
                    '<a class="btn btn-danger btn-sm float-right mb-2 remove1"> <i class="far fa-trash-alt"></i></a>' +
                    '</td>' +
                    '</tr>'
                );

                locRowCount++;
            });

            $("#location-table").on('click', '.remove1', function() {

                // alert("he");
                $(this).parent().parent().remove();
            });



            var Count = 1;
            $('#pro_addmore').click(function() {
                $('#pro-table').append(
                    '<tr id="pro-row' + Count + '">' +
                    '<td>' +
                    '</td>' +
                    '<td>' +
                    '<input type="hidden" name="product[' + Count +'][part_id]"'+
                                                'class="form-control form-control-sm" @if($tar_seg->name == 'Drones')value="{{ $all_particulars->where('section', '=', '2.1')->first()->id }}" @else'+
                                                'value="{{ $all_particulars->where('section', '=', '2')->first()->id }}"  @endif>'+
                    '<input type="text" name="product[' + Count +'][name]" id="name' + Count +'" class="form-control form-control-sm">' +
                    '</td>' +
                    '<td>' +
                    '<a class="btn btn-danger btn-sm mb-2 remove2"> <i class="far fa-trash-alt"></i></a>' +
                    '</td>' +
                    '</tr>'
                );

                Count++;
            });

            $("#pro-table").on('click', '.remove2', function() {

                $(this).parent().parent().remove();
            });


        });

        function Total(e) {
            var className = $(e).attr('class');
            className = className.substring(33);
            className = className.replace(' is-valid','');
            console.log(className);
            var sm=0;
            $('.rev_' + className).each(function() {
             sm += +$(this).val();
            });
            $("#rev_tot_"+className).val(sm.toFixed(2));

            var sum=0;
            $('.fin_' + className).each(function() {
             sum += +$(this).val();
            });
            $("#financial_tot_"+className).val(sum.toFixed(2));

            // console.log(className);

            var sr=0;
            $('.Dom_' + className).each(function() {
             sr += +$(this).val();
            });
            $("#totalSales_"+className).val(sr.toFixed(2));

            var add=0;
            $('.emp_' + className).each(function() {
             add += +$(this).val();
            });
            $("#total_"+className).val(add.toFixed(2));
        };




    </script>
@endpush
