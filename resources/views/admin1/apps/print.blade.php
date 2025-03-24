<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/master.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/preview.css') }}" rel="stylesheet">
</head>

<body onload="printPage();">
    <div class="wrapper" id="complete_form">
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" id="complete_form">

                <div class="card border-primary mt-2" id="company">
                    <div class="card-header bg-gradient-info">
                        1. Applicant / Company Details
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th rowspan="15"><b>1.1</b></th>
                                        <th style="width: 25%" class="pl-4">Company Name
                                        </th>
                                        <td style="width: 74%">{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Incorporation</th>
                                         <td>{{ date('d/m/Y',strtotime($app->doi)) }} 
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Type of Legal Entity</th>
                                        <td>{{ $user->company_classification }}
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <th>Brief Profile of Business</th>
                                        <td>{{ $app->bus_profile }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CIN</th>
                                        <td>{{ $user->cin_llpin }}</td>
                                    </tr>
                                    <tr>
                                        <th>PAN</th>
                                        <td>{{ $user->pan }}</td>
                                    </tr>

                                    
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        <th>Website</th>
                                        <td>{{ $app->website }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registered Office Address</th>
                                        <td>
                                             {{ $reg_add }} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Corporate Office Address</th>
                                         <td> {{ $corp_add }} </td> 
                                    </tr>
                                    @if($appMast->round==3)
                                        <tr>
                                            <th>Category</th>
                                            <td> {{ $appMast->app_category }} </td> 
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Target Segment</th>
                                         <td> {{ $segs_name }} </td> 
                                    </tr>

                                    <tr>
                                        <th>Eligible Product</th>
                                        <td>
                                            <table>
                                                <tbody>
                                        @foreach($seg_pro_name as $prod)
                                        @if($seg_id==$prod->target_id)
                                        
                                            
                                            
                                         <td> {{ $prod->product }} </td>
                                         
                                         @endif
                                        @endforeach
                                                </tbody>
                                            </table>
                                        <td>
                                    </tr>

                                    
                                    
                                    <tr>
                                        <th>Public Listed</th>
                                        <td>
                                            @if($app->listed == 'N') No
                                            @endif
                                            @if($app->listed == 'Y') Yes @endif
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        @if($app->listed == 'Y') 
                                        <th></th>
                                        <th>Name of Stock Exchange</th>
                                        <td>
                                            
                                         {{$app->stock_exchange}} 
                                            
                                        </td>
                                   
                                    @endif
                                </tr>
                                
                                <tr>
                                    <th></th>
                                    <th>Any Legal or Financial Cases pending against Applicant/Promoters</th>
                                    <td>  
                                     {{$app->case_pend}}   
                                    </td>   
                            </tr>

                            <tr>
                                <th></th>
                                <th>External Credit Rating</th>
                                <td>  
                                 @if($app->externalcreditrating=="Y") Yes
                                 @else No 
                                 @endif  
                                </td>   
                        </tr>
                        @if($app->externalcreditrating=="Y") 
                        <tr>
                            <th></th>
                            <th style="width: 16%" class="pl-1"></th>
                            <td style="width: 83%" class="p-0">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Credit Rating</th>
                                                <th>Name of Rating Agency</th>
                                                <th>Date of Rating	</th>
                                                <th>Valid Up to	</th>
                                                                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($appMast->ratings as $rat)
                                            <tr>
                                                <td>{{ $rat->rating }}</td>
                                                <td>{{ $rat->name }}</td>
                                                <td>{{ $rat->date }}</td>
                                                <td>{{ $rat->validity }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endif
                                 

                                
                                   

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Promoter & Promoter Group
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Promoter & Promoter Group
                                                            </th>
                                                            <th>No. of Shares</th>
                                                            <th>% Shareholding</th>
                                                            <th>Capital</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->promoters as $promot)
                                                        <tr> 
                                                            <td>{{ $promot->name }}
                                                            </td>
                                                            <td>{{ $promot->shares }}
                                                            </td>
                                                            <td>{{ $promot->per }}
                                                            </td>
                                                            <td>{{ $promot->capital }}
                                                            </td>
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Others than Promoter & Promoter Group
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Others than Promoter & Promoter Group
                                                            </th>
                                                            <th>No. of Shares</th>
                                                            <th>% Shareholding</th>
                                                            <th>Capital</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->otherShareholders as $share)
                                                        <tr> 
                                                            <td>{{ $share->name }}
                                                            </td>
                                                            <td>{{ $share->shares }}
                                                            </td>
                                                            <td>{{ $share->per }}
                                                            </td>
                                                            <td>{{ $share->capital }}
                                                            </td>
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>GST Registration
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                GSTIN
                                                            </th>
                                                            <th>Registered Address</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->gstins as $gst)
                                                        <tr> 
                                                            <td>{{ $gst->gstin }}
                                                            </td>
                                                            <td>{{ $gst->add }}
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Statutory Auditor Details
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Name of the Firm
                                                            </th>
                                                            <th>Firm Registration No.</th>
                                                            <th>Financial Year Employed </th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->auditors as $aud)
                                                        <tr> 
                                                            <td>{{ $aud->name }}
                                                            </td>
                                                            <td>{{ $aud->frn }}
                                                            </td>
                                                            <td>{{ $aud->fy }}
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Credit History
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Bankruptcy</th>
                                                            <th>RBI Defaulter List</th>
                                                            <th>Wilful Defaulter List</th>
                                                            <th>SEBI Barred List</th>
                                                            <th>CIBIL Score</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>@if($app->bankruptcy=="Y") Yes
                                                                @else NO
                                                                @endif
                                                            </td>
                                                            <td>@if($app->rbi_default=="Y") Yes
                                                                @else NO
                                                                @endif
                                                            </td>
                                                            <td>@if($app->wilful_default=="Y") Yes
                                                                @else NO
                                                                @endif
                                                            </td>
                                                            <td>@if($app->sebi_barred=="Y") Yes
                                                                @else NO
                                                                @endif
                                                            </td>
                                                            <td>{{ $app->cibil_score }}
                                                            </td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Details of Authorised Signatory
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <tr>
                                                        <th>
                                                            Name
                                                        </th>
                                                        <td>{{ $user->contact_person }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Designation
                                                        </th>
                                                        <td>{{ $user->designation }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            E-Mail
                                                        </th>
                                                        <td>{{ $user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Mobile
                                                        </th>
                                                        <td>{{ $user->mobile }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Profile of Chairman, CEO, Managing Director
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone no.</th>
                                                            <th>Designation</th>
                                                            <th>Address</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->profiles as $pro)
                                                        <tr> 
                                                            <td>{{ $pro->name }}
                                                            </td>
                                                            <td>{{ $pro->email }}
                                                            </td>
                                                            <td>{{ $pro->phone }}
                                                            </td>
                                                            <td>{{ $pro->din  }}
                                                            </td>
                                                            <td>{{ $pro->add }}
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Key Managerial Personnel Details
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone no.</th>
                                                            <th>Designation</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->kmps as $kmp)
                                                        <tr> 
                                                            <td>{{ $kmp->name }}
                                                            </td>
                                                            <td>{{ $kmp->email }}
                                                            </td>
                                                            <td>{{ $kmp->phone }}
                                                            </td>
                                                            <td>{{ $kmp->pan_din  }}
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-primary mt-2" id="eligibility">
                    <div class="card-header bg-gradient-info">
                        2. Eligibility Criteria (Refer para 4.1 of the Scheme Guidelines)
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th rowspan="14"><b>2.1</b></th>
                                        <th style="width: 30%" class="pl-4">Whether Project Proposed by Applicant is Greenfield Project as per clause 2.15 of the Guidelines
                                        </th>
                                        <td style="width: 70%">@if($appMast->eligibility->greenfield == 'Y') Yes @else No @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Whether Applicant has been declared as bankrupt,wilful defaulter or reported as fraud by any Bank or Finanical Institution - clause 4.1.3 of the Guidelines</th>
                                         <td>@if($appMast->eligibility->bankrupt == 'Y') Yes @else No @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Net Worth for Eligibility Criteria (Inculding Group Companies/ Enterprise, if considered ) in INR</th>
                                        <td>{{ $appMast->eligibility->networth }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Whether mandatory undertaking referred to in clause 7.5 of the Scheme Guidelines is being submitted</th>
                                        <td>@if($appMast->eligibility->ut_audit == 'Y') Yes @else No @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Whether mandatory undertakings referred to in clause 17.6 of the scheme guidelines is being submitted.
                                            (Integrity Pact)</th>
                                        <td>@if($appMast->eligibility->ut_integrity == 'Y') Yes @else No @endif</td>
                                    </tr>

                                    
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                       
                                    </tr>
                                    <tr>
                                        
                                    </tr>

                                    <tr>
                                       
                                    </tr>

                                    <tr>
                                        
                                    </tr>

                                    
                                    
                                    <tr>
                                        
                                    </tr>
                                    
                                    

                               

                                
                        
                       
                        
                                 

                                

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Details of Group Companies
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name of the Company</th>
                                                            <th>Registered at (Location)</th>
                                                            <th>Registration No.</th>
                                                            <th>Relationship with Applicant</th>
                                                            <th>Net-Worth (in INR)	</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->groups as $group)
                                                        <tr> 
                                                            <td>{{ $group->name }}
                                                            </td>
                                                            <td>{{ $group->location }}
                                                            </td>
                                                            <td>{{ $group->regno }}
                                                            </td>
                                                            <td>{{ $group->relation }}
                                                            </td>
                                                            <td>{{ $group->networth }}
                                                            </td>
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Application Fee Details
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Fee Payment</th>
                                                            <th>Payment Date</th>
                                                            <th>Unique Reference Number</th>
                                                            <th>Bank Name</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>{{ $appMast->fees->payment }}</td>
                                                            <td>{{ $appMast->fees->date }}</td>
                                                            <td>{{ $appMast->fees->urn }}</td>
                                                            <td>{{ $appMast->fees->bank_name }}</td>
                                                            <td>{{ $appMast->fees->amount }}</td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-primary mt-2" id="financial">
                    <div class="card-header bg-gradient-info">
                        3. Financial Details
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                         

                                    <tr>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                       @if($appMast->round==3)
                                                            <tr>
                                                                <th>Revenue</th>
                                                                <th>FY 2018-19</th>
                                                                <th>FY 2019-20</th>
                                                                <th>FY 2020-21</th>
                                                                <th>FY 2021-2022</th>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <th>Revenue</th>
                                                                <th>FY 2017-18</th>
                                                                <th>FY 2018-19</th>
                                                                <th>FY 2019-20</th>
                                                            </tr>
                                                        @endif  
                                                    </thead>
                                                    <tbody>
                                                        @if($appMast->round==3)
                                                            <tr> 
                                                                <th>Sales from Pharmaceutical Operations</th>
                                                            </tr>

                                                            <tr> 
                                                                <td>Domestic</td>
                                                                <td>{{ $financials->phar_dom_18 }}</td>
                                                                <td>{{ $financials->phar_dom_19 }}</td>
                                                                <td>{{ $financials->phar_dom_20 }}</td>
                                                                <td>{{ $financials->phar_dom_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td>Export</td>
                                                                <td>{{ $financials->phar_exp_18 }}</td>
                                                                <td>{{ $financials->phar_exp_19 }}</td>
                                                                <td>{{ $financials->phar_exp_20 }}</td>
                                                                <td>{{ $financials->phar_exp_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <th>Sales from other than Pharmaceutical Operations</th>
                                                            </tr>

                                                            <tr> 
                                                                <td>Domestic</td>
                                                                <td>{{ $financials->oth_dom_18 }}</td>
                                                                <td>{{ $financials->oth_dom_19 }}</td>
                                                                <td>{{ $financials->oth_dom_20 }}</td>
                                                                <td>{{ $financials->oth_dom_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td>Export</td>
                                                                <td>{{ $financials->oth_exp_18 }}</td>
                                                                <td>{{ $financials->oth_exp_19 }}</td>
                                                                <td>{{ $financials->oth_exp_20 }}</td>
                                                                <td>{{ $financials->oth_exp_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td><strong>Other Income</strong></td>
                                                                <td>{{ $financials->oth_inc_18 }}</td>
                                                                <td>{{ $financials->oth_inc_19 }}</td>
                                                                <td>{{ $financials->oth_inc_20 }}</td>
                                                                <td>{{ $financials->oth_inc_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td><strong>Total Revenue</strong></td>
                                                                <td>{{ $financials->tot_rev_18 }}</td>
                                                                <td>{{ $financials->tot_rev_19 }}</td>
                                                                <td>{{ $financials->tot_rev_20 }}</td>
                                                                <td>{{ $financials->tot_rev_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <th>Profit Before Tax (PBT) and Profit After Tax (PAT)</th>
                                                            </tr>

                                                            <tr> 
                                                                <td>Profit Before Tax</td>
                                                                <td>{{ $financials->pbt18 }}</td>
                                                                <td>{{ $financials->pbt19 }}</td>
                                                                <td>{{ $financials->pbt20 }}</td>
                                                                <td>{{ $financials->pbt21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td>Profit After Tax</td>
                                                                <td>{{ $financials->pat18 }}</td>
                                                                <td>{{ $financials->pat19 }}</td>
                                                                <td>{{ $financials->pat20 }}</td>
                                                                <td>{{ $financials->pat21 }}</td>
                                                            </tr>


                                                            <tr> 
                                                                <th>Capex & Source of Funds</th>
                                                            </tr>

                                                            <tr> 
                                                                <td>(i) Capex</td>
                                                                <td>{{ $financials->cap_18 }}</td>
                                                                <td>{{ $financials->cap_19 }}</td>
                                                                <td>{{ $financials->cap_20 }}</td>
                                                                <td>{{ $financials->cap_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td>(ii) Source of Funds</td>
                                                                <td>{{ $financials->sof_18 }}</td>
                                                                <td>{{ $financials->sof_19 }}</td>
                                                                <td>{{ $financials->sof_20 }}</td>
                                                                <td>{{ $financials->sof_21 }}</td>
                                                            </tr>
                                                        
                                                            <tr> 
                                                                <th>Equity Capital</th>
                                                            </tr>

                                                            <tr> 
                                                                <td>Share Capital Issued</td>
                                                                <td>{{ $financials->sh_cap_18 }}</td>
                                                                <td>{{ $financials->sh_cap_19 }}</td>
                                                                <td>{{ $financials->sh_cap_20 }}</td>
                                                                <td>{{ $financials->sh_cap_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td> - Promoters</td>
                                                                <td>{{ $financials->eq_prom_18 }}</td>
                                                                <td>{{ $financials->eq_prom_19 }}</td>
                                                                <td>{{ $financials->eq_prom_20 }}</td>
                                                                <td>{{ $financials->eq_prom_21 }}</td>
                                                            </tr>
                                                            <tr> 
                                                                <td>- Indian Govt. & Foreign Govt.</td>
                                                                <td>{{ $financials->eq_ind_18 }}</td>
                                                                <td>{{ $financials->eq_ind_19 }}</td>
                                                                <td>{{ $financials->eq_ind_20 }}</td>
                                                                <td>{{ $financials->eq_ind_21 }}</td>
                                                            </tr>
                                                            <tr> 
                                                                <td>- Multilateral Agencies</td>
                                                                <td>{{ $financials->eq_mult_18 }}</td>
                                                                <td>{{ $financials->eq_mult_19 }}</td>
                                                                <td>{{ $financials->eq_mult_20 }}</td>
                                                                <td>{{ $financials->eq_mult_21 }}</td>
                                                            </tr>
                                                            <tr> 
                                                                <td>- Banks & Other institutions</td>
                                                                <td>{{ $financials->eq_bank_18 }}</td>
                                                                <td>{{ $financials->eq_bank_19 }}</td>
                                                                <td>{{ $financials->eq_bank_20 }}</td>
                                                                <td>{{ $financials->eq_bank_21 }}</td>
                                                            </tr>
                                                            <tr> 
                                                                <td>- Others</td>
                                                                <td>{{ $financials->others_18 }}</td>
                                                                <td>{{ $financials->others_19 }}</td>
                                                                <td>{{ $financials->others_20 }}</td>
                                                                <td>{{ $financials->others_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td>Internal Accruals</td>
                                                                <td>{{ $financials->int_acc_18 }}</td>
                                                                <td>{{ $financials->int_acc_19 }}</td>
                                                                <td>{{ $financials->int_acc_20 }}</td>
                                                                <td>{{ $financials->int_acc_21 }}</td>
                                                            </tr>


                                                            <tr> 
                                                                <th>Debt/Loan</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Promoters</td>
                                                                <td>{{ $financials->ln_prom_18 }}</td>
                                                                <td>{{ $financials->ln_prom_19 }}</td>
                                                                <td>{{ $financials->ln_prom_20 }}</td>
                                                                <td>{{ $financials->ln_prom_21 }}</td>
                                                            </tr>

                                                            <tr> 
                                                                <td>Banks & Other institutions</td>
                                                                <td>{{ $financials->ln_bank_18 }}</td>
                                                                <td>{{ $financials->ln_bank_19 }}</td>
                                                                <td>{{ $financials->ln_bank_20 }}</td>
                                                                <td>{{ $financials->ln_bank_21 }}</td>
                                                            </tr>
                                                            <tr> 
                                                                <td>Multilateral Agencies</td>
                                                                <td>{{ $financials->ln_mult_18 }}</td>
                                                                <td>{{ $financials->ln_mult_19 }}</td>
                                                                <td>{{ $financials->ln_mult_20 }}</td>
                                                                <td>{{ $financials->ln_mult_21 }}</td>
                                                                
                                                            </tr>
                                                            <tr> 
                                                                <td>Indian Govt. & Foreign Govt.</td>
                                                                <td>{{ $financials->ln_ind_18 }}</td>
                                                                <td>{{ $financials->ln_ind_19 }}</td>
                                                                <td>{{ $financials->ln_ind_20 }}</td>
                                                                <td>{{ $financials->ln_ind_21 }}</td>
                                                            </tr>


                                                            <tr> 
                                                                <th>Grant / Any other assistance</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Indian Govt.</td>
                                                                <td>{{ $financials->gr_ind_18 }}</td>
                                                                <td>{{ $financials->gr_ind_19 }}</td>
                                                                <td>{{ $financials->gr_ind_20 }}</td>
                                                                <td>{{ $financials->gr_ind_21 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>Foreign Govt.</td>
                                                                <td>{{ $financials->gr_frn_18 }}</td>
                                                                <td>{{ $financials->gr_frn_19 }}</td>
                                                                <td>{{ $financials->gr_frn_20 }}</td>
                                                                <td>{{ $financials->gr_frn_21 }}</td>
                                                            </tr>        
                                                        @else
                                                            <tr> 
                                                                <th>Sales from Pharmaceutical Operations</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Domestic</td>
                                                                <td>{{ $financials->phar_dom_17 }}</td>
                                                                <td>{{ $financials->phar_dom_18 }}</td>
                                                                <td>{{ $financials->phar_dom_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>Export</td>
                                                                <td>{{ $financials->phar_exp_17 }}</td>
                                                                <td>{{ $financials->phar_exp_18 }}</td>
                                                                <td>{{ $financials->phar_exp_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <th>Sales from other than Pharmaceutical Operations</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Domestic</td>
                                                                <td>{{ $financials->oth_dom_17 }}</td>
                                                                <td>{{ $financials->oth_dom_18 }}</td>
                                                                <td>{{ $financials->oth_dom_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>Export</td>
                                                                <td>{{ $financials->oth_exp_17 }}</td>
                                                                <td>{{ $financials->oth_exp_18 }}</td>
                                                                <td>{{ $financials->oth_exp_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td><strong>Other Income</strong></td>
                                                                <td>{{ $financials->oth_inc_17 }}</td>
                                                                <td>{{ $financials->oth_inc_18 }}</td>
                                                                <td>{{ $financials->oth_inc_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td><strong>Total Revenue</strong></td>
                                                                <td>{{ $financials->tot_rev_17 }}</td>
                                                                <td>{{ $financials->tot_rev_18 }}</td>
                                                                <td>{{ $financials->tot_rev_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <th>Profit Before Tax (PBT) and Profit After Tax (PAT)</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Profit Before Tax</td>
                                                                <td>{{ $financials->pbt17 }}</td>
                                                                <td>{{ $financials->pbt18 }}</td>
                                                                <td>{{ $financials->pbt19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>Profit After Tax</td>
                                                                <td>{{ $financials->pat17 }}</td>
                                                                <td>{{ $financials->pat18 }}</td>
                                                                <td>{{ $financials->pat19 }}</td>
                                                                
                                                            </tr>


                                                            <tr> 
                                                                <th>Capex & Source of Funds</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>(i) Capex</td>
                                                                <td>{{ $financials->cap_17 }}</td>
                                                                <td>{{ $financials->cap_18 }}</td>
                                                                <td>{{ $financials->cap_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>(ii) Source of Funds</td>
                                                                <td>{{ $financials->sof_17 }}</td>
                                                                <td>{{ $financials->sof_18 }}</td>
                                                                <td>{{ $financials->sof_19 }}</td>
                                                                
                                                            </tr>
                                                        
                                                            <tr> 
                                                                <th>Equity Capital</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Share Capital Issued</td>
                                                                <td>{{ $financials->sh_cap_17 }}</td>
                                                                <td>{{ $financials->sh_cap_18 }}</td>
                                                                <td>{{ $financials->sh_cap_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td> - Promoters</td>
                                                                <td>{{ $financials->eq_prom_17 }}</td>
                                                                <td>{{ $financials->eq_prom_18 }}</td>
                                                                <td>{{ $financials->eq_prom_19 }}</td>
                                                                
                                                            </tr>
                                                            <tr> 
                                                                <td>- Indian Govt. & Foreign Govt.</td>
                                                                <td>{{ $financials->eq_ind_17 }}</td>
                                                                <td>{{ $financials->eq_ind_18 }}</td>
                                                                <td>{{ $financials->eq_ind_19 }}</td>
                                                                
                                                            </tr>
                                                            <tr> 
                                                                <td>- Multilateral Agencies</td>
                                                                <td>{{ $financials->eq_mult_17 }}</td>
                                                                <td>{{ $financials->eq_mult_18 }}</td>
                                                                <td>{{ $financials->eq_mult_19 }}</td>
                                                                
                                                            </tr>
                                                            <tr> 
                                                                <td>- Banks & Other institutions</td>
                                                                <td>{{ $financials->eq_bank_17 }}</td>
                                                                <td>{{ $financials->eq_bank_18 }}</td>
                                                                <td>{{ $financials->eq_bank_19 }}</td>
                                                                
                                                            </tr>
                                                            <tr> 
                                                                <td>- Others</td>
                                                                <td>{{ $financials->others_17 }}</td>
                                                                <td>{{ $financials->others_18 }}</td>
                                                                <td>{{ $financials->others_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>Internal Accruals</td>
                                                                <td>{{ $financials->int_acc_17 }}</td>
                                                                <td>{{ $financials->int_acc_18 }}</td>
                                                                <td>{{ $financials->int_acc_19 }}</td>
                                                                
                                                            </tr>


                                                            <tr> 
                                                                <th>Debt/Loan</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Promoters</td>
                                                                <td>{{ $financials->ln_prom_17 }}</td>
                                                                <td>{{ $financials->ln_prom_18 }}</td>
                                                                <td>{{ $financials->ln_prom_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>Banks & Other institutions</td>
                                                                <td>{{ $financials->ln_bank_17 }}</td>
                                                                <td>{{ $financials->ln_bank_18 }}</td>
                                                                <td>{{ $financials->ln_bank_19 }}</td>
                                                                
                                                            </tr>
                                                            <tr> 
                                                                <td>Multilateral Agencies</td>
                                                                <td>{{ $financials->ln_mult_17 }}</td>
                                                                <td>{{ $financials->ln_mult_18 }}</td>
                                                                <td>{{ $financials->ln_mult_19 }}</td>
                                                                
                                                            </tr>
                                                            <tr> 
                                                                <td>Indian Govt. & Foreign Govt.</td>
                                                                <td>{{ $financials->ln_ind_17 }}</td>
                                                                <td>{{ $financials->ln_ind_18 }}</td>
                                                                <td>{{ $financials->ln_ind_19 }}</td>
                                                                
                                                            </tr>


                                                            <tr> 
                                                                <th>Grant / Any other assistance</th>
                                                                </tr>

                                                            <tr> 
                                                                <td>Indian Govt.</td>
                                                                <td>{{ $financials->gr_ind_17 }}</td>
                                                                <td>{{ $financials->gr_ind_18 }}</td>
                                                                <td>{{ $financials->gr_ind_19 }}</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>Foreign Govt.</td>
                                                                <td>{{ $financials->gr_frn_17 }}</td>
                                                                <td>{{ $financials->gr_frn_18 }}</td>
                                                                <td>{{ $financials->gr_frn_19 }}</td>
                                                                
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card border-primary mt-2" id="proposal">
                    <div class="card-header bg-gradient-info">
                        5. Proposal Details
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th rowspan="14"><b>5.1</b></th>
                                        <th style="width: 30%" class="pl-4">Address of the proposed Manufacturing Facility of Eligible Product applied for
                                        </th>
                                        <td style="width: 70%">{{ $proposaldetail->prop_man_add }}</td>
                                    </tr>

                                     <tr>
                                       
                                        <th style="width: 30%" class="pl-4">Global Medical Device Manufacturing Turnover
                                        </th>
                                        
                                    </tr>
                                    <tr>
                                       
                                        <th style="width: 30%" class="pl-4">Total Manufacturing Turnover Considered for Evaluation Criteria(₹)
                                        </th>
                                        <td style="width: 70%">{{ $proposaldetail->total_manufactur }}</td>
                                        
                                    </tr>
                                    <tr>
                                       
                                        <th style="width: 30%" class="pl-4">Evaluation Score Claimed by the Applicant
                                        </th>
                                        <td style="width: 70%">{{ $proposaldetail->evaluationscore }}</td>
                                        
                                    </tr>

                                    
                                    <tr>
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>

                                    
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                       
                                    </tr>
                                    <tr>
                                        
                                    </tr>

                                    <tr>
                                       
                                    </tr>

                                    <tr>
                                        
                                    </tr>

                                    
                                    
                                    <tr>
                                        
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Details of Group Companies/ Enterprise whose global manufacturing turnover considered above:

                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name of the Company</th>
                                                            <th>Registered Location</th>
                                                            <th>Manufacturing Turnover in Target</th>
                                                            <th>Relationship with Applicant</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->proposalgmd as $gmd)
                                                        <tr> 
                                                            <td>{{ $gmd->company_name }}
                                                            </td>
                                                            <td>{{ $gmd->reg_location }}
                                                            </td>
                                                            <td>{{ $gmd->manufactur_turnover }}
                                                            </td>
                                                            <td>{{ $gmd->applicant_relationship  }}
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Global Medical Device Manufacturing Turnover
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Average R&D Expenditure for FY 2017-18 &FY2018-19 (%)</th>
                                                            <th>Evaluation Score Claimed by the Applicant</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>{{ $proposaldetail->averagerdexp }}</td>
                                                            <td>{{ $proposaldetail->evaluationscoreclaimed }}</td>
                                                        
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Particulars</th>
                                                            <th>FY 2017-18 (A)</th>
                                                            <th>FY2018-19 (B)</th>
                                                            <th>Total of Both Years (A+B)</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>Sales Revenue in Target Segment</td>
                                                            <td>{{ $proposaldetail->salerevenue1718 }}</td>
                                                            <td>{{ $proposaldetail->salerevenue1819 }}</td>
                                                            <td>{{ $proposaldetail->revenuetotalab }}</td>
                                                        
                                                            
                                                        </tr>

                                                        <tr> 
                                                            <td>Expenditure incurred on Research and Development</td>
                                                            <td>{{ $proposaldetail->expenditure1718 }}</td>
                                                            <td>{{ $proposaldetail->expenditure1819 }}</td>
                                                            <td>{{ $proposaldetail->expendituretotal }}</td>
                                                        
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    @if($appMast->round==3)
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Global Medical Device Investment of Applicant
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Total Average Considered for Evaluation Criteria(₹)</th>
                                                            <th>Evaluation Score Claimed by the Applicant</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr> 
                                                            <td>{{ $proposaldetail->total_average }}</td>
                                                            <td>{{ $proposaldetail->investmentscore }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- {{dd($projInvest)}} --}}

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="11" class="text-center">Details of Group Companies/ Enterprise whose global investment has been considered above:</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Name of the Company	</th>
                                                            <th>Registered Location	</th>
                                                            <th>Investment in Target Segment (₹)</th>
                                                            <th>Relationship with Applicant	</th>
                                                            <th>FY 2016-2017</th>	
                                                            <th>FY 2017-2018</th>	
                                                            <th>FY 2018-2019</th>	
                                                            <th>FY 2019-2020</th>	
                                                            <th>FY 2020-2021</th>	
                                                            <th>Total</th>	
                                                            <th>Average</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach($projInvest as $val)
                                                        <tr> 
                                                            <td>{{ $val->company_name }}</td>
                                                            <td>{{ $val->reg_location }}</td>
                                                            <td>{{ $val->investment_applicant }}</td>
                                                            <td>{{ $val->applicant_relationship }}</td>
                                                            <td>{{ $val->fy2017 }}</td>
                                                            <td>{{ $val->fy2018 }}</td>
                                                            <td>{{ $val->fy2019 }}</td>
                                                            <td>{{ $val->fy2020 }}</td>
                                                            <td>{{ $val->fy2021 }}</td>
                                                            <td>{{ $val->total }}</td>
                                                            <td>{{ $val->average }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Details of Group Companies/ Enterprise whose Average R&D Expenditure considered above:

                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name of the Company/ Enterprise/ (Registered Location)	</th>
                                                            <th>Sales Revenue
                                                                (FY2017-18)</th>
                                                                <th>R&D Expenditure
                                                                    (FY2017-18)</th>
                                                                    <th>Sales Revenue
                                                                        (FY2018-19)</th>
                                                                        <th>R&D Expenditure
                                                                            (FY2018-19)</th>
                                                                            <th>Relationship with Applicant</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->proposalgroupcompany as $gcom)
                                                        <tr> 
                                                            <td>{{ $gcom->company_name }}</td>
                                                            <td>{{ $gcom->sale_rev17 }}</td>
                                                            <td>{{ $gcom->exp_rd17 }}</td>
                                                            <td>{{ $gcom->sale_rev18 }}</td>
                                                            <td>{{ $gcom->exp_rd18 }}</td>
                                                            <td>{{ $gcom->relation }}</td>
                                                            
                                                        </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Contract Manufacturer (Refer Clause 5 of Annexure 4 of scheme guidelines)
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Contract Manufacturer (Refer Clause 5 of Annexure 4 of scheme guidelines)</th>
                                                            <th>Is any Intellectual Property Licensee required to carry out Manufacturing of Eligible Product in Target Segment applied for (Refer Clause 8 of Annexure 4 of scheme guidelines)</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>@if($proposaldetail->contract_manufacturer=='Y') Yes @else No @endif</td>
                                                            <td>@if($proposaldetail->property_licensee=='Y') Yes @else No @endif</td>
                                                        
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>   

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>ISO 13485 Certificate
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Whether ISO 13485 Certificate with number & validity available with the applicant and or Group company. (Refer Clause 5 of Annexure 4 of scheme guidelines)</th>
                                                            <th>Evaluation Score Claimed by the Applicant</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>@if($proposaldetail->isocertificate=="Y")Yes @else No @endif </td>
                                                            <td>{{ $proposaldetail->evaluation_score }}</td>
                                                        
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Name of Company having ISO 13485 certification
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name of Company having ISO 13485 certification</th>
                                                            <th>Issuing Authority & Country</th>
                                                                <th>Certificate Number</th>
                                                                    <th>Validity</th>
                                                                        <th>Relationship with Applicant</th>
                                                                           
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->proposaliso as $iso)
                                                        <tr> 
                                                           
                                                            <td>{{ $iso->nameofcompanyiso }}</td>
                                                            <td>{{ $iso->issuing_authority }}</td>
                                                            <td>{{ $iso->certificate_number }}</td>
                                                            <td>{{ $iso->validity }}</td>
                                                            <td>{{ $iso->relationship_applicant }}</td>
                                                          
                                                        </tr>
                                                   
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Number of Approved Products
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Number of Approved Products</th>
                                                            <th>Evaluation Score Claimed by the Applicant</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>{{ $proposaldetail->approved_products }}</td>
                                                            <td>{{ $proposaldetail->evaluation_score_product }}</td>
                                                        
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Product Owner (Applicant or Group Company Name)
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Owner (Applicant or Group Company Name)</th>
                                                            <th>Issuing Authority & Country</th>
                                                                <th>License Number</th>
                                                                    <th>Device Name</th>
                                                                        <th>Relationship with Applicant</th>
                                                                           
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->proposalapprpro as $pro)
                                                        <tr> 
                                                           
                                                            <td>{{ $pro->product_owner }}</td>
                                                            <td>{{ $pro->issuing_authority_owner }}</td>
                                                            <td>{{ $pro->licence_number }}</td>
                                                            <td>{{ $pro->device_name }}</td>
                                                            <td>{{ $pro->product_relationship_applicant }}</td>
                                                          
                                                        </tr>
                                                   
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Number of Patents
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Number of Patents</th>
                                                            <th>Evaluation Score Claimed by the Applicant</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <td>{{ $proposaldetail->approved_products_patent }}</td>
                                                            <td>{{ $proposaldetail->evaluation_score_product_patent }}</td>
                                                        
                                                            
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Product Owner (Applicant or Group Company Name)
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Owner</th>
                                                            <th>Date of Patent Validity</th>
                                                                <th>Patent Number</th>
                                                                    <th>Device Name</th>
                                                                        <th>Relationship with Applicant</th>
                                                                           
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($appMast->proposalpatent as $patent)
                                                        <tr> 
                                                           
                                                            <td>{{ $patent->product_owner_patent }}</td>
                                                            <td>{{ $patent->patent_validity }}</td>
                                                            <td>{{ $patent->Patent_number }}</td>
                                                            <td>{{ $patent->device_name_patent }}</td>
                                                            <td>{{ $patent->patent_relationship_applicant }}</td>
                                                          
                                                        </tr>
                                                   
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Detailed Project Report
                                        </th>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Key Information</th>
                                                            <th>Whether Information Provided</th>
                                                                <th>Reference to section or Page Number in DPR</th>
                                                                    <th>Remarks</th>
                                                                       
                                                                           
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                          
                                                            @foreach($proj_prt as $val)
                                                            @foreach($projDet as $det)
                                                            @if($det->prop_id == $val->id)
                                                            <tr>
                                                                <td class="text-center">{{ $val->name }}</td>
                                                                <td>
                                                                    {{ $det->info_prov == "Y" ? 'Yes' : '' }}
                                                                    {{ $det->info_prov == "N" ? 'No' : '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $det->dpr_ref }}
                                                                </td>
                                                                <td>
                                                                    {{ $det->remarks }}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                           
                                                
                                </tbody>
                            </table>
                            
                            
                        </div>
                    </div>
                </div>

                <div class="card border-primary mt-2" id="projection">
                    <div class="card-header bg-gradient-info">
                        6. Projections
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                         

                                    <tr>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Particulars
                                                                (₹ in INR)</th>
                                                            <th>FY2019-20 (Baseline)</th>
                                                            <th>FY 2020-21</th>
                                                            <th>FY 2021-22</th>
                                                            <th>FY 2022-23</th>
                                                            <th>FY 2023-24</th>
                                                            <th>FY 2024-25</th>
                                                            <th>FY 2025-26</th>
                                                            <th>FY 2026-27</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr> 
                                                            <th>Target Segment</th>
                                                            </tr>

                                                        <tr> 
                                                            <td>Export Sales</td>
                                                             <td>{{ $projection->baselineexpfy20 }}</td>
                                                            <td>{{ $projection->expfy20 }}</td>
                                                            <td>{{ $projection->expfy21 }}</td>
                                                            <td>{{ $projection->expfy22 }}</td>
                                                            <td>{{ $projection->expfy23 }}</td>
                                                            <td>{{ $projection->expfy24 }}</td>
                                                            <td>{{ $projection->expfy25 }}</td>
                                                            <td>{{ $projection->expfy26 }}</td>
                                                            
                                                            
                                                        </tr>

                                                        <tr> 
                                                            <td>Domestic Sale</td>
                                                            <td>{{ $projection->baselinedomfy20 }}</td>
                                                            <td>{{ $projection->domfy20 }}</td>
                                                            <td>{{ $projection->domfy21 }}</td>
                                                            <td>{{ $projection->domfy22 }}</td>
                                                            <td>{{ $projection->domfy23 }}</td>
                                                            <td>{{ $projection->domfy24 }}</td>
                                                            <td>{{ $projection->domfy25 }}</td>
                                                            <td>{{ $projection->domfy26 }}</td>
                                                            
                                                        </tr>

                                                        <tr> 
                                                            <th>Other than Target Segment</th>
                                                            </tr>

                                                            <tr> 
                                                                <td>Export Sales</td>
                                                                 <td>{{ $projection->otsbaselineexpfy20  }}</td>
                                                                <td>{{ $projection->otsexpfy20 }}</td>
                                                                <td>{{ $projection->otsexpfy21 }}</td>
                                                                <td>{{ $projection->otsexpfy22 }}</td>
                                                                <td>{{ $projection->otsexpfy23 }}</td>
                                                                <td>{{ $projection->otsexpfy24 }}</td>
                                                                <td>{{ $projection->otsexpfy25 }}</td>
                                                                <td>{{ $projection->otsexpfy26 }}</td>
                                                                
                                                                
                                                            </tr>
    
                                                            <tr> 
                                                                <td>Domestic Sale</td>
                                                                <td>{{ $projection->otsbaselinedomfy20 }}</td>
                                                                <td>{{ $projection->otsdomfy20 }}</td>
                                                                <td>{{ $projection->otsdomfy21 }}</td>
                                                                <td>{{ $projection->otsdomfy22 }}</td>
                                                                <td>{{ $projection->otsdomfy23 }}</td>
                                                                <td>{{ $projection->otsdomfy24 }}</td>
                                                                <td>{{ $projection->otsdomfy25 }}</td>
                                                                <td>{{ $projection->otsdomfy26 }}</td>
                                                                
                                                            </tr>

                                                        
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                       
                                                        <tr>
                                                            <th>Capex - (₹)</th>
                                                            <th>FY2019-20 (Baseline)</th>
                                                            <th>FY 2020-21</th>
                                                            <th>FY 2021-22</th>
                                                            <th>FY 2022-23</th>
                                                            <th>FY 2023-24</th>
                                                            <th>FY 2024-25</th>
                                                            <th>FY 2025-26</th>
                                                            <th>FY 2026-27</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        

                                                        <tr> 
                                                            <td>Committed Investment in Target Segment (Cumulative)</td>
                                                            <td>{{ $projection_cap->cit_baseline }}</td>
                                                            <td>{{ $projection_cap->cit20 }}</td>
                                                            <td>{{ $projection_cap->cit21 }}</td>
                                                            <td>{{ $projection_cap->cit22 }}</td>
                                                            <td>{{ $projection_cap->cit23 }}</td>
                                                            <td>{{ $projection_cap->cit24 }}</td>
                                                            <td>{{ $projection_cap->cit25 }}</td>
                                                            <td>{{ $projection_cap->cit26 }}</td>
                                                            
                                                            
                                                        </tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr style="background: #2caabe; color: white; width:100%">
                                                            <th>Employment Generation (Nos.)</th>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th>Employee Base (Cumulative)</th>
                                                            
                                                            <th>FY 2020-21</th>
                                                            <th>FY 2021-22</th>
                                                            <th>FY 2022-23</th>
                                                            <th>FY 2023-24</th>
                                                            <th>FY 2024-25</th>
                                                            <th>FY 2025-26</th>
                                                            <th>FY 2026-27</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        

                                                        <tr> 
                                                            <td>Employee Base (Cumulative)</td>
                                                            
                                                            <td>{{ $projection_emp->fy20 }}</td>
                                                            <td>{{ $projection_emp->fy21 }}</td>
                                                            <td>{{ $projection_emp->fy22 }}</td>
                                                            <td>{{ $projection_emp->fy23 }}</td>
                                                            <td>{{ $projection_emp->fy24 }}</td>
                                                            <td>{{ $projection_emp->fy25 }}</td>
                                                            <td>{{ $projection_emp->fy26 }}</td>
                                                            
                                                            
                                                        </tr>

                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Domestic Value Addition (₹)</th>
                                                            <th>FY 2020-21</th>
                                                            <th>FY 2021-22</th>
                                                            <th>FY 2022-23</th>
                                                            <th>FY 2023-24</th>
                                                            <th>FY 2024-25</th>
                                                            <th>FY 2025-26</th>
                                                            <th>FY 2026-27</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                       

                                                        <tr> 
                                                            <td>Revenue from Target Segment (A)	</td>
                                                             
                                                            <td>{{ $projectiondva->rv20 }}</td>
                                                            <td>{{ $projectiondva->rv21 }}</td>
                                                            <td>{{ $projectiondva->rv22 }}</td>
                                                            <td>{{ $projectiondva->rv23 }}</td>
                                                            <td>{{ $projectiondva->rv24 }}</td>
                                                            <td>{{ $projectiondva->rv25 }}</td>
                                                            <td>{{ $projectiondva->rv26 }}</td>
                                                            
                                                            
                                                        </tr>

                                                        <tr> 
                                                            <td>Non Originating Raw Material (B)</td>
                                                          
                                                            <td>{{ $projectiondva->no20 }}</td>
                                                            <td>{{ $projectiondva->no21 }}</td>
                                                            <td>{{ $projectiondva->no22 }}</td>
                                                            <td>{{ $projectiondva->no23 }}</td>
                                                            <td>{{ $projectiondva->no24 }}</td>
                                                            <td>{{ $projectiondva->no25 }}</td>
                                                            <td>{{ $projectiondva->no26 }}</td>
                                                            
                                                        </tr>

                                                        

                                                            <tr> 
                                                                <td>Non Originating Services (C)</td>
                                                                 
                                                            <td>{{ $projectiondva->dv20 }}</td>
                                                            <td>{{ $projectiondva->dv21 }}</td>
                                                            <td>{{ $projectiondva->dv22 }}</td>
                                                            <td>{{ $projectiondva->dv23 }}</td>
                                                            <td>{{ $projectiondva->dv24 }}</td>
                                                            <td>{{ $projectiondva->dv25 }}</td>
                                                            <td>{{ $projectiondva->dv26 }}</td>
                                                                
                                                                
                                                            </tr>
    
                                                            <tr> 
                                                                <td>DVA %</td>
                                                                
                                                                <td>{{ $projectiondva->dva20 }}</td>
                                                                <td>{{ $projectiondva->dva21 }}</td>
                                                                <td>{{ $projectiondva->dva22 }}</td>
                                                                <td>{{ $projectiondva->dva23 }}</td>
                                                                <td>{{ $projectiondva->dva24 }}</td>
                                                                <td>{{ $projectiondva->dva25 }}</td>
                                                                <td>{{ $projectiondva->dva26 }}</td>
                                                                
                                                            </tr>

                                                        
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="card border-primary mt-2" id="evaluation">
                    <div class="card-header bg-gradient-info">
                        @if($appMast->round==3)
                            7. Evaluation Criteria (Refer Annexure 3A of the Scheme Guidelines
                        @else
                            7. Evaluation Criteria (Refer Annexure 3 of the Scheme Guidelines
                        @endif
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                         

                                    <tr>
                                        <td class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Parameter</th>
                                                            <th>Score</th>
                                                            <th>Maximum Score</th>
                                                            <th>Scores Claimed by Applicant</th>
                                                            <th>Evaluation Score by PMA</th>
                                                            
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($appMast->round==3)
                                                            <tr> 
                                                                <td>1</td>
                                                                <td>Global Medical Devices manufacturing turnover of applicant and / or group company for FY 2018-19 Rs.20 crore</td>
                                                                <td>5</td>
                                                                <td>30</td>
                                                                <td>{{ !empty($proposaldetail->evaluationscore) ? $proposaldetail->evaluationscore:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For every additional Rs.20 crore manufacturing turnover in Global Medical Devices.</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>


                                                            <tr>
                                                                <td>2</td>
                                                                <td>Average of last 5 - year investment of applicant and / or group company for FY Rs.5 crore i.e. FY 2016-17 to FY 2020-21 </td>
                                                                <td>5</td>
                                                                <td>20</td>
                                                                <td>{{ !empty($proposaldetail->investmentscore) ? $proposaldetail->investmentscore:'' }}</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>For Every additional Rs.  3 crore investment in the medical devices</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr> 
                                                                <td>3</td>
                                                                <td>Existing Patent / Technology transfer with the applicant or group company in Target Segment.</td>
                                                                <td>5</td>
                                                                <td>20</td>
                                                                <td>{{ !empty($proposaldetail->evaluation_score_product_patent) ? $proposaldetail->evaluation_score_product_patent:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For every additional Patent/Technology transfer</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>4</td>
                                                                <td>Existing ISO 13485 as on the date of application available with the applicant and / or group company.</td>
                                                                <td>10</td>
                                                                <td>10</td>
                                                                <td>{{ !empty($proposaldetail->evaluation_score) ? $proposaldetail->evaluation_score:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>5</td>
                                                                <td>Existing Product CDSCO,AERB approved /regulatory product approval in USA (USFDA), UK, Australia, Japan, Canada, European Union (CE) as on the date of application available with the applicant and / or group company. Any one approval out of above list</td>
                                                                <td>5</td>
                                                                <td>10</td>
                                                                <td>{{ !empty($proposaldetail->evaluation_score_product) ? $proposaldetail->evaluation_score_product:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For additional regulatory approval out of above list</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>6</td>
                                                                <td>Average R & D expenses of the applicant and / or group companies for the period of FY 2017-18 & FY 2018-19 as a percentage of sales revenue (which is capitalized in the books of account or in capital work in progress) From 5% to 10%</td>
                                                                <td>5</td>
                                                                <td>10</td>
                                                                <td>{{ !empty($proposaldetail->evaluationscoreclaimed) ? $proposaldetail->evaluationscoreclaimed:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For more than 10%</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>Total</td>
                                                                <td></td>
                                                                <td>100</td>
                                                                <td>
                                                                    @php 
                                                                    $evaluationscore= isset($proposaldetail->evaluationscore) ? $proposaldetail->evaluationscore : 0;
                                                                    $investmentscore= isset($proposaldetail->investmentscore) ? $proposaldetail->investmentscore : 0;
                                                                    $evaluation_score_product_patent= isset($proposaldetail->evaluation_score_product_patent) ? $proposaldetail->evaluation_score_product_patent : 0;
                                                                    $evaluation_score= isset($proposaldetail->evaluation_score) ? $proposaldetail->evaluation_score : 0;
                                                                    $evaluationscoreclaimed= isset($proposaldetail->evaluationscoreclaimed) ? $proposaldetail->evaluationscoreclaimed : 0;
                                                                    $evaluation_score_product= isset($proposaldetail->evaluation_score_product) ? $proposaldetail->evaluation_score_product : 0;
                        
                                                                    print_r($evaluationscore + $investmentscore +
                                                                    $evaluation_score_product_patent + $evaluation_score+
                                                                    $evaluation_score_product + $evaluationscoreclaimed);
                        
                                                                     @endphp
                                                                </td>
                                                                <td>0</td>
                                                            </tr>
                                                        @else 
                                                       

                                                            <tr> 
                                                                <td>1</td>
                                                                <td>Global Medical Devices manufacturing turnover of applicant and / or group company for FY 2018-19 Rs.60 crore</td>
                                                                <td>5</td>
                                                                <td>50</td>
                                                                <td>{{ !empty($proposaldetail->evaluationscore) ? $proposaldetail->evaluationscore:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For every additional Rs.60 crore manufacturing turnover in Global Medical Devices.</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>2</td>
                                                                <td>Existing Patent / Technology transfer with the applicant or group company in Target Segment.</td>
                                                                <td>5</td>
                                                                <td>20</td>
                                                                <td>{{ !empty($proposaldetail->evaluation_score_product_patent) ? $proposaldetail->evaluation_score_product_patent:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For every additional Patent/Technology transfer</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>3</td>
                                                                <td>Existing ISO 13485 as on the date of application available with the applicant and / or group company.</td>
                                                                <td>10</td>
                                                                <td>10</td>
                                                                <td>{{ !empty($proposaldetail->evaluation_score) ? $proposaldetail->evaluation_score:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>4</td>
                                                                <td>Existing Product CDSCO,AERB approved /regulatory product approval in USA (USFDA), UK, Australia, Japan, Canada, European Union (CE) as on the date of application available with the applicant and / or group company. Any one approval out of above list</td>
                                                                <td>5</td>
                                                                <td>10</td>
                                                                <td>{{ !empty($proposaldetail->evaluation_score_product) ? $proposaldetail->evaluation_score_product:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For additional regulatory approval out of above list</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td>5</td>
                                                                <td>Average R & D expenses of the applicant and / or group companies for the period of FY 2017-18 & FY 2018-19 as a percentage of sales revenue (which is capitalized in the books of account or in capital work in progress) From 5% to 10%</td>
                                                                <td>5</td>
                                                                <td>10</td>
                                                                <td>{{ !empty($proposaldetail->evaluationscoreclaimed) ? $proposaldetail->evaluationscoreclaimed:'' }}</td>
                                                                <td>0</td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>For more than 10%</td>
                                                                <td>5</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                            <tr> 
                                                                <td></td>
                                                                <td>Total</td>
                                                                <td></td>
                                                                <td>100</td>
                                                                <td>
                                                                    @php 
                                                                    $evaluationscore= isset($proposaldetail->evaluationscore) ? $proposaldetail->evaluationscore : 0;
                                                                    $evaluation_score_product_patent= isset($proposaldetail->evaluation_score_product_patent) ? $proposaldetail->evaluation_score_product_patent : 0;
                                                                    $evaluation_score= isset($proposaldetail->evaluation_score) ? $proposaldetail->evaluation_score : 0;
                                                                    $evaluationscoreclaimed= isset($proposaldetail->evaluationscoreclaimed) ? $proposaldetail->evaluationscoreclaimed : 0;
                                                                    $evaluation_score_product= isset($proposaldetail->evaluation_score_product) ? $proposaldetail->evaluation_score_product : 0;
                        
                                                                    print_r($evaluationscore +
                                                                    $evaluation_score_product_patent + $evaluation_score+
                                                                    $evaluation_score_product + $evaluationscoreclaimed);
                        
                                                                     @endphp
                                                                </td>
                                                                <td>0</td>
                                                                
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card border-primary mt-2" id="undertaking">
                    <div class="card-header bg-gradient-info">
                        4. Undertakings and Certificates
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th><b>4.1</b></th>
                                        <th style="width: 16%" class="pl-1">Undertakings and Certificates</th>
                                        <td style="width: 83%" class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-sm">
                                                    <tbody class="doctbody">
                                                        <tr>
                                                            <th class="w-40 text-center">Letter of Authorization (Refer Clause 1.1 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('1', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '1')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('1', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '1')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="p-0">Certificate of Shareholding/ Ownership Pattern (Refer clause 5 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('2', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '2')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('2', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '2')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Undertaking for Defaulter’s List/Bankruptcy (Refer clause 1.6 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('3', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '3')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('3', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '3')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Undertaking for Pending Legal or Financial Cases ( Refer clause 5 of Annexure 4 of the Scheme guidelines)</th>
                                                            @if(in_array('4', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '4')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('4', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '4')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Certificate of Net Worth Certificate (Refer Clause 1.7 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('5', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '5')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('5', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '5')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Undertaking for Consent of Audit (Refer Clause 7.5 and Annexure 5 of the Scheme Guidelines)</th>
                                                            @if(in_array('6', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '6')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('6', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '6')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Integrity Pact (Refer Clause 17.7 and Annexure 11 of the Scheme Guidelines)</th>
                                                            @if(in_array('7', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '7')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('7', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '7')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Certificate of expenditure on R&D by Applicant and Group Companies</th>
                                                            @if(in_array('8', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '8')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('8', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '8')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th class="text-center">Certificate of Manufacturing Turnover</th>
                                                            @if(in_array('9', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '9')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('9', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '9')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        @if($appMast->round==3)
                                                            <tr>
                                                                <th class="text-center">Certificate of Investment in Medical Devices Sector</th>
                                                                
                                                                @if(in_array('34', $docids))
                                                                    @foreach($docs as $key=>$doc)
                                                                    @if($key == '34')
                                                                    <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                        class="btn btn-success btn-sm float-centre">
                                                                        View</a>
                                                                    </td>
                                                                    @endif
                                                                    @endforeach
                                                                @else
                                                                    <td>
                                                                        <i class="fas fa-times-circle text-danger"></i>
                                                                    </td>
                                                                @endif
                                                                @if(in_array('34', $docids))
                                                                @foreach($docRem as $key=>$docRe)
                                                                @if($key == '34')
                                                                    <td>
                                                                        {{ $docRe }}
                                                                    </td>
                                                                @endif
                                                                @endforeach
                                                                @else
                                                                <td></td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>4.2</b></th>
                                        <th style="width: 16%" class="pl-1">Other Documents</th>
                                        <td style="width: 83%" class="p-0">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-sm">
                                                    <tbody class="doctbody">
                                                        <tr>
                                                            <th class="w-40 text-center">Memorandum & Articles of Association, Partnership Deed (Refer clause 10 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('10', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '10')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('10', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '10')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="p-0">Certificate of Incorporation (Refer clause 10 of Annexure 4 of the Scheme Guidelines)	</th>
                                                            @if(in_array('11', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '11')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('11', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '11')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Business Profile</th>
                                                            @if(in_array('12', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '12')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('12', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '12')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Copy of PAN (Refer clause 10 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('13', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '13')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('13', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '13')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Copy of GST Number (Refer clause 10 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('14', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '14')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('14', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '14')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">CIBIL Report of the applicant (Refer clause 1.6 of Annexure 4 of the Scheme Guidelines)	</th>
                                                            @if(in_array('15', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '15')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('15', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '15')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Copy of latest MGT 7 or MGT 9 filed with ROC.</th>
                                                            @if(in_array('16', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '16')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('16', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '16')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Profile of Chairman, CEO, Managing Director, KMP (Refer clause 1.8 of Annexure 4 of the Scheme Guidelines)</th>
                                                            @if(in_array('17', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '17')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('17', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '17')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">FY 2017-18</th>
                                                            @if(in_array('18', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '18')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('18', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '18')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">FY 2018-19</th>
                                                            @if(in_array('19', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '19')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('19', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '19')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th class="text-center">FY 2019-20</th>
                                                            @if(in_array('20', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '20')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('20', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '20')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                        @if($appMast->round==3)
                                                            <tr>
                                                                <th class="text-center">FY 2020-21</th>
                                                                @if(in_array('32', $docids))
                                                                    @foreach($docs as $key=>$doc)
                                                                    @if($key == '32')
                                                                    <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                        class="btn btn-success btn-sm float-centre">
                                                                        View</a>
                                                                    </td>    
                                                                    @endif
                                                                    @endforeach
                                                                @else
                                                                    <td>
                                                                        <i class="fas fa-times-circle text-danger"></i>
                                                                    </td>
                                                                @endif
                                                                @if(in_array('32', $docids))
                                                                @foreach($docRem as $key=>$docRe)
                                                                @if($key == '32')
                                                                    <td>
                                                                        {{ $docRe }}
                                                                    </td>
                                                                @endif
                                                                @endforeach
                                                                @else
                                                                <td></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center">FY 2021-22</th>
                                                                @if(in_array('33', $docids))
                                                                    @foreach($docs as $key=>$doc)
                                                                    @if($key == '33')
                                                                    <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                        class="btn btn-success btn-sm float-centre">
                                                                        View</a>
                                                                    </td>
                                                                    @endif
                                                                    @endforeach
                                                                @else
                                                                    <td>
                                                                        <i class="fas fa-times-circle text-danger"></i>
                                                                    </td>
                                                                @endif
                                                                @if(in_array('33', $docids))
                                                                @foreach($docRem as $key=>$docRe)
                                                                @if($key == '33')
                                                                    <td>
                                                                        {{ $docRe }}
                                                                    </td>
                                                                @endif
                                                                @endforeach
                                                                @else
                                                                <td></td>
                                                                @endif
                                                            </tr>
                                                        @endif

                                                        <tr>
                                                            <th class="text-center">Detailed Project Report</th>
                                                            @if(in_array('21', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '21')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('21', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '21')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th class="text-center">Proof of ISO 13485 Certificate</th>
                                                            @if(in_array('22', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '22')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('22', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '22')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th class="text-center">Proof of Existing Product CDSCO AERB approved regulatory product approval in USA (USFDA), UK,Australia, Japan, Canada, European Union (CE)</th>
                                                            @if(in_array('23', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '23')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('23', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '23')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th class="text-center">Proof of Existing Patent/ Technology transfer</th>
                                                            @if(in_array('24', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '24')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('24', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '24')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th class="text-center">Detailed Annexure consisting name,technical specification, intended use with instruction of use for other Product applied for</th>
                                                            @if(in_array('25', $docids))
                                                                @foreach($docs as $key=>$doc)
                                                                @if($key == '25')
                                                                <td><a href="{{$doc}}" download="{{$doc}}" target="_blank"
                                                                    class="btn btn-success btn-sm float-centre">
                                                                    View</a>
                                                                </td>
                                                                @endif
                                                                @endforeach
                                                            @else
                                                                <td>
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </td>
                                                            @endif
                                                            @if(in_array('25', $docids))
                                                            @foreach($docRem as $key=>$docRe)
                                                            @if($key == '25')
                                                                <td>
                                                                    {{ $docRe }}
                                                                </td>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                

            </div>
        </div>

        
    </div>
</div>
</div>
</body>
</html>
<script>
function printPage() {
var div0ToPrint = document.getElementById('company');
var div1ToPrint = document.getElementById('eligibility');
var div2ToPrint = document.getElementById('financial');
var div3ToPrint = document.getElementById('proposal');
var div4ToPrint = document.getElementById('projection');
var div5ToPrint = document.getElementById('evaluation');
var div6ToPrint = document.getElementById('undertaking');

var newWin = window.open('', 'Print-Window');
newWin.document.open();
newWin.document.write('<html><head><title></title>');
newWin.document.write('<link href="{{ asset("css/app.css") }}" rel="stylesheet">');
newWin.document.write('<link href="{{ asset("css/app/preview.css") }}" rel="stylesheet">');
newWin.document.write(
'<style>@media print { .pagebreak { clear: both; page-break-before: always; } }</style>');
newWin.document.write('</head><body onload="window.print()">');
newWin.document.write(div0ToPrint.innerHTML);
newWin.document.write('<div class="pagebreak"></div>');
newWin.document.write(div1ToPrint.innerHTML);
newWin.document.write('<div class="pagebreak"></div>');
newWin.document.write(div2ToPrint.innerHTML);
newWin.document.write('<div class="pagebreak"></div>');
newWin.document.write(div3ToPrint.innerHTML);
newWin.document.write('<div class="pagebreak"></div>');
newWin.document.write(div4ToPrint.innerHTML);
newWin.document.write('<div class="pagebreak"></div>');
newWin.document.write(div5ToPrint.innerHTML);
newWin.document.write('<div class="pagebreak"></div>');
newWin.document.write(div6ToPrint.innerHTML);
newWin.document.write('<div class="pagebreak"></div>');

newWin.document.close();
};
</script>


