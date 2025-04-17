@extends('layouts.user.dashboard-master')
@section('content')
    <div class="main-body">
        @if ($errors->any())
            <h4>{{ $errors->first() }}</h4>
        @endif
        <div class="container">
            <div class="row" style="display:block; ">
                <form action="{{route('user.application.update',$appMast->id)}}" class="prevent_multiple_submit" id="application-edit" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="app_id" value="{{$appMast->id}}">
                    <div class="card border-primary ">
                        <div class="card-header bg-gradient-info">
                            <b>1. Financial History (Rs. in Crore)</b>
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
                                                <p>{!! $particular->particular !!}<span class="text-danger">*</span></p>
                                            </td>
                                            @foreach ($fys->where('id','<>',4) as $fy)
                                                <td class="text-center">
                                                    <input type="hidden" name="financial[{{ $key }}][fy{{$fy->year}}][id]" @if($particular->id == 5) disabled @endif
                                                        class="form-control form-control-sm" @if($particular->id != 5) value="{{ $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->id }}" @endif>
                                                    <input type="hidden" name="financial[{{ $key }}][fy{{$fy->year}}][part_id]"
                                                        class="form-control form-control-sm" value="{{ $particular->id }}" @if($particular->id == 5) disabled @endif>
                                                    <input type="hidden" name="financial[{{ $key }}][fy{{$fy->year}}][fy_id]"
                                                        class="form-control form-control-sm" value="{{ $fy->id }}" @if($particular->id == 5) disabled @endif>
                                                    <input type="number" name="financial[{{ $key }}][fy{{$fy->year}}][value]"
                                                        class="form-control form-control-sm {{ ($particular->id == 1 || $particular->id == 2 || $particular->id == 3 || $particular->id == 4) ? 'rev_fy'.$fy->year : (($particular->id == 8 || $particular->id == 9) ? 'fin_fy'.$fy->year : 'tax')}}"
                                                        @if($particular->id == 5) id="rev_tot_fy{{$fy->year}}" disabled @endif @if($particular->id != 5) value="{{ $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value }}" @endif
                                                        @if($particular->id != 5 && $particular->id != 6 && $particular->id != 7) onkeyup="Total(this)"@endif>
                                                    {{-- <input type="number" name="financial[{{ $key }}][fy{{$fy->year}}][value]" > --}}
                                                    {{-- <input type="number" name="financial[{{ $key }}][fy{{$fy->year}}][value]" @if($particular->id == 6 || $particular->id == 7)onkeyup="FinancialTot(this)"@endif
                                                    class="form-control form-control-sm @if($particular->id == 6 || $particular->id == 7)fin_fy{{$fy->year}}@elseif($particular->id == 6 || $particular->id == 7)fin_fy{{$fy->year}}@elseif($particular->id == 6 || $particular->id == 7)fin_fy{{$fy->year}}@endif"
                                                    value="{{ $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value }}"> --}}
                                                </td>
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
                                                <input type="hidden" name="currloc[id]"
                                                class="form-control form-control-sm" value="{{ $currnt_manu_loc->id }}">
                                                <input type="text" name="currloc[currmanufacturing_location]" id="currlocmanufacturing_location0" class="form-control form-control-sm" value="{{ $currnt_manu_loc->addr_location }}">
                                            </td>
                                            <td>
                                                <input type="text" name="currloc[currgstin]" id="currlocAddGstin0" class="form-control form-control-sm" value="{{ $currnt_manu_loc->gstin }}">
                                            </td>
                                            <td>
                                                <input type="number" name="currloc[currpincode]" id="pincode0" class="form-control form-control-sm" value="{{ $currnt_manu_loc->pincode }}"
                                                onkeyup="GetCityByPinCode('currloc',this.value,0)">
                                                <span id="pincodeMsg" style="color:red;font-weight:bold;display: none"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="currloc[currstate]" id="currlocAddState0" class="form-control form-control-sm" value="{{ $currnt_manu_loc->state }}" readonly>
                                            </td>
                                            <td class="text-center">
                                                <select name="currloc[currcity]" id="currlocAddCity0"
                                                    class="form-control form-control-sm" value="{{ $currnt_manu_loc->city }}">
                                                    @if($currnt_manu_loc->city!=null)
                                                        <option value="{{$currnt_manu_loc->city}}"  selected="selected">{{$currnt_manu_loc->city}}</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <select name="currloc[currdistrict]" id="currlocAddDistrict0"
                                                    class="form-control form-control-sm" value="{{ $currnt_manu_loc->district }}">
                                                    @if($currnt_manu_loc->district!=null)
                                                        <option value="{{$currnt_manu_loc->district}}"  selected="selected">{{$currnt_manu_loc->district}}</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-primary " style="margin:4px;">
                            <div class="card-header bg-gradient-info" >
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
                                        @foreach ($prop_manu_loc as $key=>$loc)
                                            <tr id="location-row{{$key}}">
                                                <td>
                                                    <input type="hidden" name="locations[{{$key}}][id]"
                                                    class="form-control form-control-sm" value="{{ $loc->id }}">
                                                    <input type="text" name="locations[{{$key}}][manufacturing_location]" id="manufacturing_location{{$key}}" class="form-control form-control-sm" value="{{ $loc->addr_location }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="locations[{{$key}}][gstin]" id="locationsAddGstin{{$key}}" class="form-control form-control-sm" value="{{ $loc->gstin }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="locations[{{$key}}][pincode]" id="pincode{{$key}}" class="form-control form-control-sm" value="{{ $loc->pincode }}"
                                                    onkeyup="GetCityByPinCode('locations',this.value,{{$key}})">
                                                    <span id="pincodeMsg{{$key}}" style="color:red;font-weight:bold;display: none"></span>
                                                </td>
                                                <td>
                                                    <input type="text" name="locations[{{$key}}][state]" id="locationsAddState{{$key}}" class="form-control form-control-sm" value="{{ $loc->state }}" readonly>
                                                </td>
                                                <td class="text-center">
                                                    <select name="locations[{{$key}}][city]" id="locationsAddCity{{$key}}"
                                                        class="form-control form-control-sm" value="{{ $loc->city }}">
                                                        @if($loc->city!=null)
                                                            <option value="{{$loc->city}}"  selected="selected">{{$loc->city}}</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <select name="locations[{{$key}}][district]" id="locationsAddDistrict{{$key}}"
                                                        class="form-control form-control-sm" value="{{ $loc->district }}">
                                                        @if($loc->district!=null)
                                                            <option value="{{$loc->district}}"  selected="selected">{{$loc->district}}</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                @if ($key>0)
                                                    <td>
                                                        <a class="btn btn-danger btn-sm float-right mb-2" onclick="deleteLoc({{$loc->id}})"> <i class="far fa-trash-alt"></i></a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
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
                                                        <input type="hidden" name="sales[{{ $srl }}][fy{{$fy->year}}][id]"
                                                        class="form-control form-control-sm" value="{{ $prop_sale->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->id }}">
                                                        <input type="hidden" name="sales[{{ $srl }}][fy{{$fy->year}}][part_id]"
                                                            class="form-control form-control-sm" value="{{ $part->id }}">
                                                        <input type="hidden" name="sales[{{ $srl }}][fy{{$fy->year}}][fy_id]"
                                                            class="form-control form-control-sm" value="{{ $fy->id }}">
                                                        <input type="number" name="sales[{{ $srl }}][fy{{$fy->year}}][value]" onkeyup="Total(this)"
                                                            class="form-control form-control-sm {{'Dom_fy'.$fy->year}}"
                                                            value="{{ $prop_sale->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value }}">
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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card border-primary"  style="margin:4px;">
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
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>
                                                    {{ $all_particulars->where('section', '=', '3.2')->first()->particular }}<span class="text-danger">*</span>
                                                </p>
                                            </td>
                                            @foreach ($fys->where('id','<>',1) as $key => $fy)
                                                <td class="text-center">
                                                    <input type="hidden" name="investment[fy{{$fy->year}}][id]"
                                                    class="form-control form-control-sm" value="{{ $prop_invst->where('part_id', $all_particulars->where('section', '=', '3.2')->first()->id)->where('fy_id',$fy->id)->first()->id }}">
                                                    <input type="hidden" name="investment[fy{{$fy->year}}][part_id]"
                                                    class="form-control form-control-sm" value="{{ $all_particulars->where('section', '=', '3.2')->first()->id }}">
                                                    <input type="hidden" name="investment[fy{{$fy->year}}][fy_id]"
                                                    class="form-control form-control-sm" value="{{ $fy->id }}">
                                                    <input type="number" name="investment[fy{{$fy->year}}][value]"
                                                    class="form-control form-control-sm investment"
                                                    value="{{ $prop_invst->where('part_id', $all_particulars->where('section', '=', '3.2')->first()->id)->where('fy_id',$fy->id)->first()->value }}">
                                                </td>
                                            @endforeach
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
                                    @foreach ($all_particulars->where('section', '=', '4') as $key=>$part)
                                        <tr>
                                            <td>
                                                <p>{{ $part->particular }}<span class="text-danger">*</span></p>
                                            </td>
                                                @foreach ($fys->where('id','<>',1) as $fy)
                                                <td class="text-center">
                                                    <input type="hidden" name="employment[{{ $num }}][fy{{$fy->year}}][id]"
                                                    class="form-control form-control-sm" value="{{ $prop_emp->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->id }}">
                                                    <input type="hidden" name="employment[{{ $num }}][fy{{$fy->year}}][part_id]"
                                                    class="form-control form-control-sm" value="{{ $part->id }}">
                                                    <input type="hidden" name="employment[{{ $num }}][fy{{$fy->year}}][fy_id]"
                                                    class="form-control form-control-sm" value="{{ $fy->id }}">
                                                    <input type="number" name="employment[{{ $num }}][fy{{$fy->year}}][value]" onkeyup="Total(this)"
                                                    class="form-control form-control-sm {{'emp_fy'.$fy->year}}"
                                                    value="{{ $prop_emp->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value }}">
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
                                                                {{ $docMast->doc_particular }} {!! ($docMast->doc_serial!=9) ? '<span class="text-danger">*</span>' : '' !!}
                                                                @if($docMast->doc_serial == 2)
                                                                    <a href="{{ asset('docs/app/Letter Of Authorisation.docx') }}"
                                                                        class="btn btn-primary btn-sm float-right"
                                                                        download="Letter Of Authorisation">Format</a>
                                                                @elseif($docMast->doc_serial == 5)
                                                                    <a href="{{ asset('docs/app/Integrity Undertaking.docx') }}"
                                                                        class="btn btn-primary btn-sm float-right"
                                                                        download="Integrity Undertaking">Format</a>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="hidden" name="annexure_id[{{$docMast->doc_id}}]"
                                                                class="form-control form-control-sm"  value="@if(isset($app_upload->where('app_id', $appMast->id)->where('doc_id',$docMast->doc_id)->first()->upload_id[0])) {{ $app_upload->where('app_id', $appMast->id)->where('doc_id',$docMast->doc_id)->first()->upload_id[0] }} @endif">
                                                                <input type="file" name="annexure_edit[{{ $docMast->doc_type }}]" class="form-control form-control-sm">
                                                            </td>
                                                            <td>
                                                                @if(isset($app_upload->where('app_id', $appMast->id)->where('doc_id',$docMast->doc_id)->first()->upload_id[0]))
                                                                    <a href="{{ route('user.download.file', $app_upload->where('app_id', $appMast->id)->where('doc_id',$docMast->doc_id)->first()->upload_id[0] ) }}" class="btn btn-sm btn-info" target=""> View </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border-primary " style="margin:4px;">
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
                                                    <th class="text-center">Actual (Rs. in Crore)<span class="text-danger">*</span></th>
                                                    <th class="text-center">Minimum (Rs. in Crore)</th>
                                                </tr>
                                                <tr id="shareholder_addmore">
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
                                                        <input type="hidden" name="elgibility[id]"
                                                        class="form-control form-control-sm" value="{{ $eligible->where('part_id', $all_particulars->where('section', '=', '5.1')->first()->id)->where('fy_id',$fys[1]->id)->first()->id }}">
                                                        <input type="hidden" name="elgibility[part_id]"
                                                        class="form-control form-control-sm" value="{{ $all_particulars->where('section', '=', '5.1')->first()->id }} ">
                                                        <input type="number" name="elgibility[actual]" id="actual"
                                                            class="form-control form-control-sm act" value="{{ $eligible->where('part_id', $all_particulars->where('section', '=', '5.1')->first()->id)->where('fy_id',$fys[1]->id)->first()->actual }}">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="elgibility[minimum]" id="minimum"
                                                            class="form-control form-control-sm text-right" value="{{$eligible->where('part_id', $all_particulars->where('section', '=', '5.1')->first()->id)->where('fy_id',$fys[1]->id)->first()->minimum}}" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="card border-primary ">
                                    <div class="card-header bg-gradient-info">
                                        <b>4.2 Recommendation</b>
                                    </div>
                                    <div class="card-body">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="1" class="square-blue" id="checkbox" name="checkbox" required checked>
                                            The application by M/s {{ Auth::user()->name }} Limited is, <i>prima facie, </i>found to be Eligible/Ineligible under the Scheme, based on constitution of business, product segment applied for and sales achieved Rs. <span id="actual_price" class="font-weight-bold"></span> crore For FY 2020-21 is Recommended/Decline for issuance of Letter of Approval.
                                        </label>

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-md-2 offset-md-2">
                            <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm font-weight-bold">
                                <i class="fa fa-save"></i> Save as Draft</button>
                        </div>
                        <div class="col-md-2 offset-md-3">
                            <a href="{{route('user.application.preview',$appMast->id)}}" class="btn btn-primary btn-sm form-control form-control-sm font-weight-bold" id="">
                            <i class="fas fa-save"></i> Preview</a>
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
    {!! JsValidator::formRequest('App\Http\Requests\User\ApplicationRequest', '#application-edit') !!}
    <script src="{{ asset('js/jsvalidation.min.js') }}"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


    <script>

        $(document).ready(function() {

            setTimeout(function() {
                $(".fin_fy2020").trigger('onkeyup');
                $(".fin_fy2021").trigger('onkeyup');
                $(".fin_fy2022").trigger('onkeyup');
                $(".dom_fy2021").trigger('onkeyup');
                $(".dom_fy2022").trigger('onkeyup');
                $(".dom_fy2023").trigger('onkeyup');
                $(".emp_fy2021").trigger('onkeyup');
                $(".emp_fy2022").trigger('onkeyup');
                $(".emp_fy2023").trigger('onkeyup');
                // $(".price").trigger('blur');
            }, 2000)

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


            var locRowCount = {{count($prop_manu_loc)}};
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
                    'id="pincode' + locRowCount + '" class="form-control form-control-sm"onkeyup="GetCityByPinCode(\'locations\',this.value,' + locRowCount +
                    ')"><span id="pincodeMsg' +
                    locRowCount +
                    '" style="color:red;font-weight:bold;display: none"></span></td>' +
                    '<td>' +
                    '<input type="text" name="locations[' + locRowCount + '][state]"' +
                    'id="locationsAddState' + locRowCount + '" class="form-control form-control-sm" readonly>' +
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

                $(this).parent().parent().remove();
            });


            var Count = {{count($appProd)}};
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

            console.log(className);

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

        function deleteLoc(row_id) {
        swal({
                title: "Do You Want to Delete this Manufacturing Location",
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
                        url: '../../location/delete/' + row_id,
                        success: function(data) {
                            console.log(data);
                            if(data == true){
                                swal(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success')
                                    window.location.reload();
                            }else{
                                swal(
                                    'Not Deleted!',
                                    'Your data has not been Deleted.',
                                    'warning')

                            }
                        }
                    })
                }
            });
        }

        // function deleteProd(row_id) {
        // swal({
        //         title: "Do You Want to Delete this Product",
        //         icon: "warning",
        //         buttons: {
        //             cancel: true,
        //             confirm: {
        //                 text: "Yes",
        //                 value: "Y",
        //             },
        //         },
        //         dangerMode: true,
        //         closeOnClickOutside: false,
        //     })
        //     .then((result) => {
        //         if (result == 'Y') {
        //             $.ajax({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 type: "GET",
        //                 url: '../../product/delete/' + row_id,
        //                 success: function(data) {
        //                     console.log(data);
        //                     if(data == true){
        //                         swal(
        //                             'Deleted!',
        //                             'Your data has been deleted.',
        //                             'success')
        //                             window.location.reload();
        //                     }else{
        //                         swal(
        //                             'Not Deleted!',
        //                             'Your data has not been Deleted.',
        //                             'warning')

        //                     }
        //                 }
        //             })
        //         }
        //     });
        // }


    </script>
@endpush
