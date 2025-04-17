@extends('layouts.admin.master')

@section('title')
Applicant - {{ $user->name }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
{{-- Error Messages --}}
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
{{-- Content Starts --}}

<div class="row">
    <div class="col-md-2 offset-md-10">
        <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-sm btn-block">
            <i class="fas fa-angle-double-left"></i> Back</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12" id="preview">
        <div class="card border-primary">
            <div class="card-header bg-gradient-info">
                1. Applicant / Company Details
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th class=''>Name of the Applicant / Company</th>
                                <td colspan="4">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Target Segment</th>
                                <td colspan="4">{{ $tar_seg->name }}</td>
                            </tr>
                            <tr>
                                <th>COI (Certificate of Incorporation)</th>
                                <td colspan="4">
                                    @if (isset($additional->coi))
                                        <a href="{{ route('admin.download.file', $additional->coi) }}"
                                            class="btn btn-sm btn-info" target=""> View </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Incorporation</th>
                                <td colspan="4">
                                    {{date('d-m-Y', strtotime($user->inc_date))}}
                                </td>
                            </tr>
                            <tr>
                                <th>CIN</th>
                                <td colspan="4">{{ $user->cin_llpin }}</td>
                            </tr>
                            <tr>
                                <th>PAN</th>
                                <td>
                                    {{ $user->pan }}
                                </td>
                                <td colspan="3">
                                    @if (isset($additional->pan_card))
                                        <a href="{{ route('admin.download.file', $additional->pan_card) }}"
                                            class="btn btn-sm btn-info" target=""> View </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>GST No.</th>
                                <td colspan="4">
                                    @if (isset($additional->gst_no))
                                        <a href="{{ route('admin.download.file', $additional->gst_no) }}"
                                            class="btn btn-sm btn-info" target=""> View </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Registered Office</b><br>
                                    {{ $user->reg_off_add }}
                                </td>
                                <td>
                                    <b>Pincode</b><br>
                                    {{ $user->reg_off_pin }}
                                </td>
                                <td>
                                    <b>State</b><br>
                                    {{ $user->reg_off_state }}
                                </td>
                                <td>
                                    <b>City</b><br>
                                    {{ $user->reg_off_city }}
                                </td>
                                <td>
                                    <b>District</b><br>
                                    {{ $user->reg_off_district }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Corporate Office</b><br>
                                    {{ $user->co_off_add }}
                                </td>
                                <td>
                                    <b>Pincode</b><br>
                                    {{ $user->co_off_pin }}
                                </td>
                                <td>
                                    <b>State</b><br>
                                    {{ $user->co_off_state }}
                                </td>
                                <td>
                                    <b>City</b><br>
                                    {{ $user->co_off_city }}
                                </td>
                                <td>
                                    <b>District</b><br>
                                    {{ $user->co_off_district }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-primary" id="comp">
            <div class="card-header bg-gradient-info">
                2. Brief background of the Company
            </div>
            <div class="card-body p-0">
                <div class="table-responsive form-group">
                    <table class="table table-sm table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th style="width: 50%">Business Profile</th>
                                <td class="text-justify" style="width: 74%">
                                    {{ $additional->business_profile }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-primary">
            <div class="card-header bg-gradient-info">
                3. Board of Directors
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-hover" id="land-table">
                    <tbody>
                        <tr class="table-primary">
                            <th class="text-center">Name</th>
                            <th class="text-center">Designation</th>
                            <th class="text-center">DIN</th>
                            <th class="text-center">Age</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Mobile no.</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Area of Expertise</th>
                        </tr>
                        @foreach ($directors as $key => $dir)
                            <tr>
                                <td class="text-center">
                                    {{ $dir->name }}
                                </td>
                                <td class="text-center">
                                    {{ $dir->designation }}
                                </td>
                                <td class="text-center">
                                    {{ $dir->din }}
                                </td>
                                <td class="text-center">
                                    {{ $dir->age }}
                                </td>
                                <td class="text-center">
                                    {{ $dir->address }}
                                </td>
                                <td class="text-center">
                                    {{ $dir->mobile }}
                                </td>
                                <td class="text-center">
                                    {{ $dir->email }}
                                </td>
                                <td class="text-justify">
                                    {{ $dir->expertise }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card border-primary ">
            <div class="card-header bg-gradient-info">
                4. Shareholding Pattern
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-hover" id="shareholding-table">
                    <tbody>
                        <tr class="table-primary">
                            <th class="text-center">Name</th>
                            <th class="text-center">Nationality/ Country<sup class="text-danger">*</sup></th>
                            <th class="text-center">No. of Equity Shares<sup class="text-danger">*</sup></th>
                            <th class="text-center">Equity Shares%<sup class="text-danger">*</sup></th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Pincode</th>
                            <th class="text-center">State</th>
                            <th class="text-center">City</th>
                            <th class="text-center">District</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($shareholding as $key => $share)
                            <tr>
                                <td class="text-center">
                                    {{ $share->name }}
                                </td>
                                <td class="text-center">
                                    {{ $countries->where('id', $share->country_id)->first()->country }}
                                </td>
                                <td class="text-center">
                                    {{ $share->no_of_equity_share }}
                                </td>
                                <td class="text-center">
                                    {{ $share->equity_share_percentage }}
                                </td>
                                <td class="text-center">
                                    {{ $share->email }}
                                </td>
                                <td class="text-center">
                                    {{ $share->address }}
                                </td>
                                <td class="text-center">
                                    {{ $share->pincode }}
                                </td>
                                <td class="text-center">
                                    {{ $share->state }}
                                </td>
                                <td class="text-center">
                                    {{ $share->city }}
                                </td>
                                <td class="text-center">
                                    {{ $share->district }}
                                </td>
                                @php
                                    $total = $total +  $share->no_of_equity_share
                                @endphp
                            </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th class="text-center" colspan="2">Total</th>
                        <td class="text-center">
                            <b>{{$total}}</b>
                        </td>
                        <td class="text-center">
                            <b>{{$share->where('created_by',$user->id)->sum('equity_share_percentage')}}</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card border-primary ">
            <div class="card-header bg-gradient-info">
                5. Other Details
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-hover" id="bodshareholding-table">
                    <tbody>
                        <tr>
                            <th colspan="5" data-toggle="tooltip" data-placement="right" title="Please furnish the details such scheme under">
                                Whether the Company/Applicant is registered under any other PLI scheme of GOI</th>
                            <td colspan="2">
                                @if (count($additional->goi) > 0)
                                    Yes
                                @endif
                                @if (count($additional->goi) == 0)
                                    No
                                @endif
                            </td>
                            <td colspan="1">
                                @if ($additional->goi)
                                    <a href="{{ route('admin.download.file', $additional->goi) }}"
                                        class="btn btn-sm btn-info" target=""> View </a>
                                @endif
                            </td>
                            <td colspan="2">
                                @if($additional->goi) {{ $docMast->where('id',$additional->goi[0])->first()->remarks}} @endif

                            </td>
                        </tr>
                        <tr>
                            <th colspan="5" title="please furnish details such as name of the company, share-holding pattern and board of Directors as on 31/03/2022">
                                Whether any other Group Company/Applicant has applied under this scheme</th>
                            <td colspan="2">
                                @if (count($additional->bod) > 0)
                                    Yes
                                @endif
                                @if (count($additional->bod) == 0)
                                    No
                                @endif
                            </td>
                            <td colspan="1">
                                @if ($additional->bod)
                                    <a href="{{ route('admin.download.file', $additional->bod) }}"
                                        class="btn btn-sm btn-info" target=""> View </a>
                                @endif
                            </td>
                        </tr>
                        @php
                            $bodtotal = 0;
                        @endphp
                        @if (count($additional->bod) > 0)
                            <tr class="table-primary bodshare" id="bod_shareHeader"
                                @if (!$additional->bod) style="display:none" @endif>
                                <th class="text-center">Name</th>
                                <th class="text-center">Nationality/ Country<sup class="text-danger">*</sup></th>
                                <th class="text-center">No. of Equity Shares<sup class="text-danger">*</sup></th>
                                <th class="text-center">Equity Shares%<sup class="text-danger">*</sup></th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Pincode</th>
                                <th class="text-center">State</th>
                                <th class="text-center">City</th>
                                <th class="text-center">District</th>
                            </tr>
                            @foreach ($bodshareholding as $key => $share)
                                <tr id="bod_share{{ $key }}" class="bodshare"
                                    @if (!$additional->bod) style="display:none" @endif>
                                    <td class="text-center">
                                        {{ $share->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $countries->where('id', $share->country_id)->first()->country }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->no_of_equity_share }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->equity_share_percentage }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->email }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->address }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->pincode }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->state }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->city }}
                                    </td>
                                    <td class="text-center">
                                        {{ $share->district }}
                                    </td>
                                    @php
                                        $bodtotal = $bodtotal +  $share->no_of_equity_share
                                    @endphp
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tr id="bod_shareTot" @if (!$additional->bod) style="display:none" @endif>
                        <th class="text-center" colspan="2">Total</th>
                        <td class="text-center">
                            <b>{{$bodtotal}}</b>
                        </td>
                        <td class="text-center">
                            <b>{{$share->where('created_by',$user->id)->sum('equity_share_percentage')}}</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card border-primary">
            <div class="card-header bg-gradient-info">
                6. Credit History of the Applicant / Company
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <b>RBI/CIBIL Defaulter List</b> <br>
                                    @if (count($additional->dir_rbi_cibil) > 0)
                                        Yes
                                    @endif
                                    @if (count($additional->dir_rbi_cibil) == 0)
                                        No
                                    @endif
                                </td>
                                <td>
                                    @if ($additional->dir_rbi_cibil)
                                        <a href="{{ route('admin.download.file', $additional->dir_rbi_cibil) }}"
                                            class="btn btn-sm btn-info" target=""> View </a>
                                    @endif
                                </td>
                                <td>
                                    <b>Wilful Defaulter List</b> <br>
                                    @if (count($additional->rbi_cibil) > 0)
                                        Yes
                                    @endif
                                    @if (count($additional->rbi_cibil) == 0)
                                        No
                                    @endif
                                </td>
                                <td>
                                    @if ($additional->rbi_cibil)
                                        <a href="{{ route('admin.download.file', $additional->rbi_cibil) }}"
                                            class="btn btn-sm btn-info" target=""> View </a>
                                    @endif
                                </td>
                                <td>
                                    <b>CIBIL Report</b> <br>
                                    @if ($additional->cibil_check == 'Y')
                                        Yes
                                    @endif
                                    @if ($additional->cibil_check == 'N')
                                        No
                                    @endif
                                </td>
                                {{-- </div> --}}
                                <td>
                                    @if ($additional->cibil)
                                        <a href="{{ route('admin.download.file', $additional->cibil) }}"
                                            class="btn btn-sm btn-info" target=""> View </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-primary">
            <div class="card-header bg-gradient-info">
                7. Authorized Signatory Details
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->contact_person }}
                                </td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td>
                                    {{ $user->designation }}
                                </td>
                            </tr>
                            <tr>
                                <th>Verification Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile No.</th>
                                <td>{{ $user->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Alternate Mobile No.</th>
                                <td>
                                    {{ $user->alternateno }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-primary ">
            <div class="card-header bg-gradient-info">
                8. Segment
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-hover" id="pro-table">
                    <tbody>
                        <tr class="table-primary">
                            <th class="text-center">Product Segment</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Purpose</th>
                        </tr>
                        {{-- {{dd($product_seg)}} --}}
                        @foreach ($product_seg as $key => $pro)
                            <tr id="pro-row{{ $key }}">
                                <td>
                                    {{ $product_segMast->where('id', $pro->segment_id)->first()->product_name }}
                                </td>
                                <td class="text-center">
                                    {{ $pro->name }}
                                </td>
                                <td class="text-center">
                                    {{ $pro->purpose }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card border-primary">
            <div class="card-header bg-gradient-info">
                9. Proposed Investment / Sales for the scheme period (FY 2021-2022 to FY 2023-2024)(Rs. in Crore)
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>Investment</th>
                                <td style="width: 74%">
                                    {{ $additional->prop_inv }}
                                </td>
                            </tr>
                            <tr>
                                <th>Sales</th>
                                <td style="width: 74%">
                                    {{ $additional->prop_sales }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-md-2 offset-md-5">
                <a href="javascript:void(0);" onclick="printPage();"
                class="btn btn-warning btn-sm form-control form-control-sm">Print <i class="fas fa-print"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
   function printPage(time) {
        var today = new Date();
        var date =  today.getDate() + '-' + (today.getMonth() + 1) + '-' +today.getFullYear();
        var dateTime = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var time = date + ' ' + dateTime;

        var div1 = document.getElementById('preview');

        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><title> PLI-Drones And Drone Components Additional Detail Preview</title>');
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
