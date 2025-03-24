@extends('layouts.user.dashboard-master')
@section('content')
    <div class="main-body">
        @if ($errors->any())
            <h4>{{ $errors->first() }}</h4>
        @endif
        <div class="container">
            <div class="row" style=" display:block;" id="preview">
                <form action="{{route('user.application.submit',$appMast->id)}}" class="prevent_multiple_submit" method="post" enctype="multipart/form-data">
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
                                    @php
                                        $fy2020_tot = 0;
                                        $fy2021_tot = 0;
                                        $fy2022_tot = 0;
                                        $rev_fy2020_tot = 0;
                                        $rev_fy2021_tot = 0;
                                        $rev_fy2022_tot = 0;
                                    @endphp
                                    @foreach ($particulars as $key => $particular)
                                        @if($particular->id == 1)
                                            <tr>
                                                <td>1) Target Segment</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>
                                                <p>{!! $particular->particular !!}</p>
                                                {{-- <p>{{ $particular->id }}</p> --}}
                                            </td>
                                            @foreach ($fys->where('id','<>',4) as $fy)
                                                <td class="text-center">
                                                    <span>
                                                        @if($particular->id != 5){{ $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value }}@endif
                                                    </span>

                                                    @if($particular->id == 1 || $particular->id == 2 || $particular->id == 3 || $particular->id == 4)
                                                        @if ($fy->id == 1)
                                                            @php
                                                                $rev_fy2020_tot = $rev_fy2020_tot +  $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp

                                                        @endif
                                                        @if ($fy->id == 2)
                                                            @php
                                                                $rev_fy2021_tot = $rev_fy2021_tot +  $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                        @if ($fy->id == 3)
                                                            @php
                                                                $rev_fy2022_tot = $rev_fy2022_tot +  $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @if($particular->id == 5 && $fy->id == 1)
                                                        <b>{{$rev_fy2020_tot}}</b>
                                                    @endif
                                                    @if($particular->id == 5 && $fy->id == 2)
                                                        <b>{{$rev_fy2021_tot}}</b>
                                                    @endif
                                                    @if($particular->id == 5 && $fy->id == 3)
                                                        <b>{{$rev_fy2022_tot}}</b>
                                                    @endif
                                                    @if($particular->id == 8 || $particular->id == 9)
                                                        @if ($fy->id == 1)
                                                            @php
                                                                $fy2020_tot = $fy2020_tot +  $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                        @if ($fy->id == 2)
                                                            @php
                                                                $fy2021_tot = $fy2021_tot +  $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                        @if ($fy->id == 3)
                                                            @php
                                                                $fy2022_tot = $fy2022_tot +  $finan_history->where('part_id', $particular->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            Net worth[A+B]
                                        </td>
                                        <td class="text-center">
                                            <b>{{$fy2020_tot}}</b>
                                        </td>
                                        <td class="text-center">
                                            <b>{{$fy2021_tot}}</b>
                                        </td>
                                        <td class="text-center">
                                            <b>{{$fy2022_tot}}</b>
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
                                        <tr>
                                            <td class="text-center">
                                                {{ $currnt_manu_loc->addr_location }}
                                            </td>
                                            <td class="text-center">
                                                {{ $currnt_manu_loc->gstin }}
                                            </td>
                                            <td class="text-center">
                                                {{ $currnt_manu_loc->pincode }}

                                            </td>
                                            <td class="text-center">
                                                {{ $currnt_manu_loc->state }}
                                            </td>
                                            <td class="text-center">
                                                {{$currnt_manu_loc->city}}
                                            </td>
                                            <td class="text-center">
                                                {{$currnt_manu_loc->district}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-primary " style="margin:4px;">
                            <div class="card-header bg-gradient-info" >
                                <b>2.2. Proposed</b>
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
                                        </tr>
                                        @foreach ($prop_manu_loc as $key=>$loc)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loc->addr_location }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $loc->gstin }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $loc->pincode }}

                                                </td>
                                                <td class="text-center">
                                                    {{ $loc->state }}
                                                </td>
                                                <td class="text-center">
                                                    {{$loc->city}}
                                                </td>
                                                <td class="text-center">
                                                    {{$loc->district}}
                                                </td>
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
                                            {{-- <th class="text-center">Total</th> --}}
                                        </tr>
                                        @php
                                            $prop_fy_2021 = 0;
                                            $prop_fy_2022 = 0;
                                            $prop_fy_2023 = 0;
                                        @endphp
                                        @foreach ($all_particulars->where('section', '=', '3.1') as $key=>$part)
                                            <tr>
                                                <td>
                                                    <p>{{ $part->particular }}</p>
                                                </td>
                                                @foreach ($fys->where('id','<>',1) as $fy)
                                                    <td class="text-center">
                                                        <span>
                                                            {{ $prop_sale->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value }}
                                                        </span>
                                                            @if($fy->id==2)
                                                                @php
                                                                    $prop_fy_2021 = $prop_fy_2021 +  $prop_sale->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value
                                                                @endphp
                                                            @endif
                                                            @if($fy->id==3)
                                                                @php
                                                                    $prop_fy_2022 = $prop_fy_2022 +  $prop_sale->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value
                                                                @endphp
                                                            @endif
                                                            @if($fy->id==4)
                                                                @php
                                                                    $prop_fy_2023 = $prop_fy_2023 +  $prop_sale->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value
                                                                @endphp
                                                            @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>
                                                Total
                                            </td>
                                            <td class="text-center">
                                                <b>{{$prop_fy_2021}}</b>
                                            </td>
                                            <td class="text-center">
                                                <b>{{$prop_fy_2022}}</b>
                                            </td>
                                            <td class="text-center">
                                                <b>{{$prop_fy_2023}}</b>
                                            </td>
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
                                        @php
                                            $invest_tot = 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <p>
                                                    {{ $all_particulars->where('section', '=', '3.2')->first()->particular }}
                                                </p>
                                            </td>
                                            @foreach ($fys->where('id','<>',1) as $key => $fy)
                                                <td class="text-center">
                                                    <span class="investment">
                                                        {{ $prop_invst->where('part_id', $all_particulars->where('section', '=', '3.2')->first()->id)->where('fy_id',$fy->id)->first()->value }}
                                                    </span>
                                                    @php
                                                        $invest_tot = $invest_tot +  $prop_invst->where('part_id', $all_particulars->where('section', '=', '3.2')->first()->id)->where('fy_id',$fy->id)->first()->value
                                                    @endphp
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
                                    </tr>
                                    @php
                                        $prop_fy_2021 = 0;
                                        $prop_fy_2022 = 0;
                                        $prop_fy_2023 = 0;
                                    @endphp
                                    @foreach ($all_particulars->where('section', '=', '4') as $key=>$part)
                                        <tr>
                                            <td>
                                                <p>{{ $part->particular }}</p>
                                            </td>
                                            @foreach ($fys->where('id','<>',1) as $fy)
                                                <td class="text-center">
                                                    <span>
                                                        {{ $prop_emp->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value }}
                                                    </span>
                                                        @if($fy->id==2)
                                                            @php
                                                                $prop_fy_2021 = $prop_fy_2021 +  $prop_emp->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                        @if($fy->id==3)
                                                            @php
                                                                $prop_fy_2022 = $prop_fy_2022 +  $prop_emp->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                        @if($fy->id==4)
                                                            @php
                                                                $prop_fy_2023 = $prop_fy_2023 +  $prop_emp->where('part_id', $part->id)->where('fy_id',$fy->id)->first()->value
                                                            @endphp
                                                        @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            Total
                                        </td>
                                        <td class="text-center">
                                           <b>{{$prop_fy_2021}}</b>
                                        </td>
                                        <td class="text-center">
                                           <b>{{$prop_fy_2022}}</b>
                                        </td>
                                        <td class="text-center">
                                           <b>{{$prop_fy_2023}}</b>
                                        </td>
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
                                                                {{ $docMast->doc_particular }}
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
                                                    <th class="text-center">Actual (Rs. in Crore)</th>
                                                    <th class="text-center">Minimum (Rs. in Crore)</th>
                                                </tr>
                                                <tr id="shareholder_addmore">
                                                    <td class="text-center">
                                                        <p>
                                                            {{ $all_particulars->where('section', '=', '5.1')->first()->particular }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>FY {{$fys[1]->fy}}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        {{$tar_seg->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $eligible->where('part_id', $all_particulars->where('section', '=', '5.1')->first()->id)->where('fy_id',$fys[1]->id)->first()->actual }}

                                                    </td>
                                                    <td class="text-center">
                                                        {{$eligible->where('part_id', $all_particulars->where('section', '=', '5.1')->first()->id)->where('fy_id',$fys[1]->id)->first()->minimum}}

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
                                            <input type="checkbox" value="1" class="square-blue" id="checkbox" name="checkbox" checked disabled>
                                            The application by M/s {{ Auth::user()->name }} Limited is, <i>prima facie, </i>found to be Eligible/Ineligible under the Scheme, based on constitution of business, product segment applied for and sales achieved Rs. <span>{{ $eligible->where('part_id', $all_particulars->where('section', '=', '4.1')->first()->id)->where('fy_id',$fys[0]->id)->first()->actual }}</span> crore For FY 2020-21 is Recommended/Decline for issuance of Letter of Approval.
                                        </label>

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>


                    <div class="row py-2">
                        @if ($appMast->status != 'S')
                            <div class="col-md-2 offset-md-0">
                                <a href="{{route('user.application.edit',$appMast->id)}}"
                                    class="btn btn-warning btn-sm form-control form-control-sm font-weight-bold">
                                    <i class="fa  fa-backward"></i> Back</a>
                            </div>
                            <div class="col-md-2 offset-md-3">
                                <a type="button" href="{{route('user.application.submit',$appMast->id)}}" class="btn btn-primary btn-sm form-control form-control-sm" id="submit"> Final Submit </a>
                            </div>

                        @else
                            <div class="col-md-2 offset-md-5">
                                <a href="javascript:void(0);" onclick="printPage();"
                                class="btn btn-warning btn-sm form-control form-control-sm">Print <i class="fas fa-print"></i></a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('user.partials.application.app_pincode-js')
    @include('user.partials.js.prevent_multiple_submit')
    <script src="{{ asset('js/jsvalidation.min.js') }}"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <script>
        function printPage(time) {
            var today = new Date();
            var date =  today.getDate() + '-' + (today.getMonth() + 1) + '-' +today.getFullYear();
            var dateTime = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date + ' ' + dateTime;

            if ('{{$appMast->status}}' == 'D') {
                var status = 'Draft';
            } else {
                var status = 'Application No. -' + '{{ $appMast->app_no }}';
            }

            var div1 = document.getElementById('preview');

            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><head><title> PLI-Drones And Drone Components Application Preview[' + status + ']</title>');
            newWin.document.write('<link href="{{ asset('css/app.css') }}" rel="stylesheet">');
            newWin.document.write('<link href="{{ asset('css/app/preview.css') }}" rel="stylesheet">');
            newWin.document.write('<style>@media print { .pagebreak { clear: both; page-break-before: always; }}</style>');
            newWin.document.write('</head><body onload="window.print()">');
            newWin.document.write('<h2 class="text-center">Application Details '+time+'</h2>');
            newWin.document.write(div1.innerHTML);
            newWin.document.write(
                '<p style="page-break-after: always;">&nbsp;</p><p style="page-break-before: always;">&nbsp;</p>');
            newWin.document.close();
        };

    </script>
@endpush
