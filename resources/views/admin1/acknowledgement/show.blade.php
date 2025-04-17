@extends('layouts.admin.master')

@section('title')
Applicant - {{ $user->name }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')

<style>

    div{
        font-family: tahoma;
    }
    </style>
{{-- Content Starts --}}

{{-- <div class="row">
    <div class="col-md-2 offset-md-10">
        <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-sm btn-block">
            <i class="fas fa-angle-double-left"></i> Back</a>
    </div>
</div> --}}

<div class="row">
    <div class="col-lg-12">
        

            <div class="row py-4">
                <div class="col-md-12">
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <b><div class="text-center" style="font-size: 20px;">Acknowledgement</div></b>
                        </div>

                        
                    <div style="margin: 30px; font-family: tahoma; font-size: 16px;"><div style="padding-bottom: 12px;">To,</div>
                    <address style="line-height: 25px; font-family: tahoma; font-size: 16px; padding-left: 18px">
                        {{ $user->name }}<br>
                        {{ $user->off_add }}<br>
                        {{ $user->off_city }}, {{ $user->off_state }}<br>
                        {{ $user->off_pin }}
                        </address>
                    </div>

                    <div style="padding: 13px; font-size:16px; font-family: tahoma; padding-top: 0px;">
                        This acknowledgement is being issued in connection with your application for PLI Scheme for Medical Devices. 
                </div>

                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th style="width: 2%" class="text-center">S.no</th>
                                        <th style="width: 40%" colspan=2 class="text-center">Particulars</th>
                                        
                                    </tr>

                                    
                                    <tr>
                                        <th class="text-center">1</th>
                                        <th>Applicant Name</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">2</th>
                                        <th>Application No.</th>
                                        <td>{{ $appMast->app_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">3</th>
                                        <th>Application Submission Date </th>
                                        <td>{{  date('d/m/Y', strtotime($appMast->submitted_at)) }}</td>
                                    </tr>

                                    <tr>
                                        <th class="text-center">4</th>
                                        <th>Target Segment applied for</th>
                                        <td>
                                            <table class="sub-table">
                                                <tr>
                                                    <th>Target Segment</th>
                                                    <th>Eligible Product</th>
                                                </tr>
                                               
                                                <tr>
                                                    <td>{{ $segs_name }}</td>
                                                    <td><ul style="line-height: 18px;">@foreach($seg_pro_name as $prod)
                                                        @if($seg_id==$prod->target_id)
                                                         
                                                           <li>{{ $prod->product }} </li>
                                                         
                                                         @endif
                                                        @endforeach</ul></td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center">5</th>
                                        <th>Net Worth of the Applicant (including Group Companies)</th>
                                        <td>Rs. {{ number_format($elgb->networth/10000000,2) }} crore</td>
                                    </tr>

                                    <tr>
                                        <th class="text-center">6</th>
                                        <th>Whether project is Greenfield or not</th>
                                        <td>@if($elgb->greenfield=="Y") Yes @else No @endif</td>
                                    </tr>

                                    <tr>
                                        <th class="text-center">7</th>
                                        <th>Whether Applicant has been declared as bankrupt,wilful defaulter or reported 
                                            as fraud by any Bank or Financial Institution   
                                        </th>
                                        <td> 
                                            @if($elgb->bankrupt=="Y") Yes @else No @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">8</th>
                                        <th colspan=2>Projected Sales (Rs. in crore) </th>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-sm table-bordered table-hover">
                                <tbody> 
                                    <tr>
                                        <th>Particulars</th>
                                        <th class="text-center">FY 2020-21</th>
                                        <th class="text-center">FY 2021-22</th>
                                        <th class="text-center">FY 2022-23</th>
                                        <th class="text-center">FY 2023-24</th>
                                        <th class="text-center">FY 2024-25</th>
                                        <th class="text-center">FY 2025-26</th>
                                        <th class="text-center">FY 2026-27</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Target Segment</th>
                                    </tr>
                                    @php 
                                    $totalexp=$projection->expfy20+$projection->expfy21+$projection->expfy22+$projection->expfy23+$projection->expfy24+$projection->expfy25+$projection->expfy26;
                                    $totaldom=$projection->domfy20+$projection->domfy21+$projection->domfy22+$projection->domfy23+$projection->domfy24+$projection->domfy25+$projection->domfy26;
                                    $totalexpdom=$totalexp+$totaldom;
                                    @endphp
                                    <tr>
                                        <td>Export Sales</td>
                                        <td class="text-center">{{ number_format($projection->expfy20/10000000,2)  }}</td>
                                        <td class="text-center">{{ number_format($projection->expfy21/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->expfy22/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->expfy23/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->expfy24/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->expfy25/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->expfy26/10000000,2) }}</td>
                                        <th class="text-center">{{ number_format($totalexp/10000000,2) }}</th>
                                    </tr>

                                    <tr>
                                        <td>Domestic Sale</td>
                                        <td class="text-center">{{ number_format($projection->domfy20/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->domfy21/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->domfy22/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->domfy23/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->domfy24/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->domfy25/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection->domfy26/10000000,2) }}</td>
                                        <th class="text-center">{{ number_format($totaldom/10000000,2) }}</th>
                                    </tr>
                                    @php 
                                    $total20 = $projection->expfy20+$projection->domfy20; 
                                    $total21 = $projection->expfy21+$projection->domfy21; 
                                    $total22 = $projection->expfy22+$projection->domfy22; 
                                    $total23 = $projection->expfy23+$projection->domfy23; 
                                    $total24 = $projection->expfy24+$projection->domfy24; 
                                    $total25 = $projection->expfy25+$projection->domfy25; 
                                    $total26 = $projection->expfy26+$projection->domfy26; 
                                    @endphp
                                    <tr>
                                        <th>Total</th>
                                        <th class="text-center">{{ number_format($total20/10000000,2) }}</th>
                                        <th class="text-center">{{ number_format($total21/10000000,2) }}</th>
                                        <th class="text-center">{{ number_format($total22/10000000,2) }}</th>
                                        <th class="text-center">{{ number_format($total23/10000000,2) }}</th>
                                        <th class="text-center">{{ number_format($total24/10000000,2) }}</th>
                                        <th class="text-center">{{ number_format($total25/10000000,2) }}</th>
                                        <th class="text-center">{{ number_format($total26/10000000,2) }}</th>
                                        <th class="text-center">{{ number_format($totalexpdom/10000000,2) }}</th>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th style="width: 7%" class="text-center">9</th>
                                        <th colspan=2>Committed Investment (Rs. in crore)</th>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>Particulars</th>
                                        <th class="text-center">FY 2020-21</th>
                                        <th class="text-center">FY 2021-22</th>
                                        <th class="text-center">FY 2022-23</th>
                                        <th class="text-center">FY 2023-24</th>
                                        <th class="text-center">FY 2024-25</th>
                                        <th class="text-center">FY 2025-26</th>
                                        <th class="text-center">FY 2026-27</th>
                                    </tr>
                                    <tr>
                                        <td>Committed Investment</td>
                                        <td class="text-center">{{ number_format($projection_cap->cit20/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection_cap->cit21/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection_cap->cit22/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection_cap->cit23/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection_cap->cit24/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection_cap->cit25/10000000,2) }}</td>
                                        <td class="text-center">{{ number_format($projection_cap->cit26/10000000,2) }}</td>
                                       
                                    </tr>
                                </tbody>    
                            </table>

                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th style="width: 5%" class="text-center">10</th>
                                        <th style="width: 40%" colspan=2>Application Fee Details</th>
                                        <td>
                                            <table class="sub-table">
                                                <tr>
                                                    <th style="width: 20%">Fee (INR)</th>
                                                    <th style="width: 40%">Ref No</th>
                                                    <th style="width: 40%">Date of payment</th>
                                                   
                                                </tr>
                                               
                                                <tr>
                                                    <td>{{ $fees->amount }}</td>
                                                    <td>{{ $fees->urn }}</td>
                                                    <td>{{ $fees->date }}</td>
                                                   
                                                </tr>

                                </tbody>
                            </table> 

                        </tbody>
                    </table> 

                            
                        </div>
                        <b style="margin-left: 15px;padding-top: 15px;">Important Note:-</b>
                            <ol style=" margin-top: -4px; padding: 20px; font-size:15px">
                                <li style="margin-bottom: 10px;"> This acknowledgement shall not be construed as approval under the Scheme.</li>

                                <li style="margin-bottom: 10px;"> The above acknowledgement is being issued upon prima facie examination of the application form
                                            and based on data submitted by you. In case any further clarification documents are required during the appraisal process
                                            the same shall be intimated to you.</li>
                                
                                     <li>The acknowledgement issued based on above doesn't qualify an applicant for claiming the incentive under the Scheme.
                                         You will be eligible for incentive after approval of EC and in case you comply with the criteria stipulated under the Scheme Guidelines.
                                    
                                     </li>

                                
                            </ol>
                    </div>
                </div>
            </div>
            

            <div class="row mb-2">
                <div class="col-2 offset-md-5">
                    <a href="{{ route('admin.acknowledgement.print',$appMast->id) }}" target="_blank">  <button type="submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                            class="fas fa-save"></i>Print</button></a>
                </div>
            </div>

        
    </div>
</div>

@endsection


