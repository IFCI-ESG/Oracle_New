@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

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
                <form action="{{ route('user.brsr.sectionp1store') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" value="{{ $fy_id }}" name="fy_id">
                    <input type="hidden" value="{{ $user->id }}" name="com_id">
                    @if (isset($social_mast->id))
                        <input type="hidden" value="{{ $social_mast->id }}" name="brsr_mast_id">
                    @endif

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 1) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b>PRINCIPLE 1 Businesses should conduct and govern themselves with integrity, and in a manner that is Ethical, Transparent and Accountable.<b><br /><br /> 
                                            <b>Essential Indicators</b> <br /><br />
                                            <b> 1. Percentage coverage by training and awareness programmes on any of the Principles
                                            during the financial year: </b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 30%" class="text-center">
                                                           Segment
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                        Total number of training and awareness programmes held
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                        Topics / principles covered under the training and its impact

                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                          %age of persons in respective category covered by the awareness programmes
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=1;
                                                    @endphp
                                                    @foreach ($segment_quesMast->where('question_section','P1_segment') as $key => $segment)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment->question}}
                                                                <input type="hidden" value="{{ $segment->id }}" name="segment[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment[{{ $b }}][total_training]" id="total_training _{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment[{{ $b }}][topics_principles]" id="topics_principles_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment[{{ $b }}][age_percent]" id="age_percent_{{$b}}" class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            
                                                        </tr>
                                                        @php
                                                            $b++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                          
                                            <b> 2. Details of fines / penalties /punishment/ award/ compounding fees/ settlement amount 
                                                paid in proceedings (by the entity or by directors / KMPs) with regulators/ law
enforcement agencies/ judicial institutions, in the financial year, in the following format
(Note: the entity shall make disclosures on the basis of materiality as specified in Regulation 30
of SEBI (Listing Obligations and Disclosure Obligations) Regulations, 2015 and as disclosed on
the entity’s website): </b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 30%" class="text-center">
                                                          
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                         NGRBC Principle
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                         Name of the regulatory/enforcement agencies judicial institutions

                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                        Amount (In INR)
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                          Brief of the Case
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                        Has an appeal been preferred? (Yes/No)
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=5;
                                                    @endphp
                                                    @foreach ($monetary_quesMast->where('question_section','P1_monetary') as $key => $segment1)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment1->question}}
                                                                <input type="hidden" value="{{ $segment1->id }}" name="segment1[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment1[{{ $b }}][ngrbc_principle]" id=" ngrbc_principle_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment1[{{ $b }}][regulatory_name]" id="regulatory_name_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment1[{{ $b }}][amount]" id="amount_{{$b}}" class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment1[{{ $b }}][brief_case]" id="brief_case_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment1[{{ $b }}][appeal_prefered]" id="appeal_prefered_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                          </tr>
                                                        @php
                                                            $b++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    
                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                           
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 30%" class="text-center">
                                                          
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                         NGRBC Principle
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                         Name of the regulatory/enforcement agencies judicial institutions

                                                        </th>
                                                       
                                                        <th style="width: 10%" class="text-center">
                                                          Brief of the Case
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                        Has an appeal been preferred? (Yes/No)
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=8;
                                                    @endphp
                                                    @foreach ($nonmonetary_quesMast->where('question_section','P1_nonmonetary') as $key => $segment2)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment2->question}}
                                                                <input type="hidden" value="{{ $segment2->id }}" name="segment2[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment2[{{ $b }}][ngrbc_principle]" id=" ngrbc_principle_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment2[{{ $b }}][regulatory_name]" id="regulatory_name_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment2[{{ $b }}][brief_case]" id="brief_case_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment2[{{ $b }}][appeal_prefered]" id="appeal_prefered_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                          </tr>
                                                        @php
                                                            $b++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        
                       <div class="card card-success card-outline mt-4">
                         <div class="card-header">
                          <b>3. Of the instances disclosed in Question 2 above, details of the Appeal/ Revision
                          preferred in cases where monetary or non-monetary action has been appealed. </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Case Details</th>
                      <th style="width: 30%" class="text-center">Name of the regulatory/ enforcement agencies/ judicial institutions</th>
                     
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows">
                <tr>
                  
                  <td><textarea class="form-control form-control-sm auto-grow" name="additional[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additional[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn"><i class="fas fa-plus"></i> Add Case Details</button>
        </div>
      </div>


      <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=10;
               @endphp
              @foreach ($para1_quesMast->where('question_section','P1_para1') as $key => $segment3)
              <input type="hidden" value="{{ $segment3->id }}" name="segment3[{{ $b }}][ques_id]">
             <b>4. {{ $segment3->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment3[{{ $b }}][policy_description]" id="policy_description_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline">
                                        <div class="card-header">
                                          
                                            <b> 5. Number of Directors/KMPs/employees/workers against whom disciplinary action was 
                                                taken by any law enforcement agency for the charges of bribery/ corruption: </b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 30%" class="text-center">
                                                          
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                           FY {{ $current_fy }} Current Financial Year
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                           FY {{ $previous_fy }} Previous Financial Year
                                                        </th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=11;
                                                    @endphp
                                                    @foreach ($directors_quesMast->where('question_section','P1_corruption') as $key => $segment4)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment4->question}}
                                                                <input type="hidden" value="{{ $segment4->id }}" name="segment4[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                            <textarea style="text-align: left;" name="segment4[{{ $b }}][directors_current_fy]" id=" directors_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">  </textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment4[{{ $b }}][directors_previous_fy]" id="directors_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $b == 11 ? $previous_directors : ($b == 12 ? $previous_kmps : ($b == 13 ? $previous_employees : ($b == 14 ? $previous_workers : ''))) }}</textarea>
                                                            </td>
                                                            
                                                          </tr>
                                                        @php
                                                            $b++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                            
<div class="card card-success card-outline">
    <div class="card-header">
      <b>6. Details of complaints with regard to conflict of interest:</b><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                  
                    <th style="width: 30%" class="text-center"></th>
                    <th style="width: 10%" class="text-center" colspan="2">FY {{ $current_fy }} Current Financial Year</th>
                    <th style="width: 10%" class="text-center" colspan="2">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
                <tr class="text-center table-success">
                    
                    <th></th>
                    <th>Number</th>
                    <th>Remarks</th>
                    <th>Number</th>
                    <th>Remarks</th>
                 
                </tr>
            </thead>
            <tbody>
                @php
                    $b = 15;
                @endphp
                @foreach ($compliants_quesMast->where('question_section','P1_compliants') as $key => $segment5)
                <tr>
                       <td style="font-size: 1rem;">
                            {{$segment5->question}}
                         <input type="hidden" value="{{ $segment5->id }}" name="segment5[{{ $b }}][ques_id]">
                       </td>
                       <td>
                         <textarea style="text-align: left;" name="segment5[{{ $b }}][no_compliants_current_fy]" id=" no_compliants_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                       </td>

                       <td>
                         <textarea style="text-align: left;" name="segment5[{{ $b }}][remarks_compliants_current_fy]" id="remarks_compliants_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                       </td>

                       <td>
                         <textarea style="text-align: left;" name="segment5[{{ $b }}][no_compliants_previous_fy]" id="no_compliants_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $b == 15 ? $previous_directors_compliants : ($b == 16 ? $previous_kmps_compliants : '') }}</textarea>
                       </td>
                        <td>
                         <textarea style="text-align: left;" name="segment5[{{ $b }}][remarks_compliants_previous_fy]" id="remarks_compliants_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $b == 15 ? $previous_directors_remarks : ($b == 16 ? $previous_kmps_remarks : '') }}</textarea>
                       </td>
                    </tr>
                    @php
                      $b++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=17;
               @endphp
              @foreach ($para2_quesMast->where('question_section','P1_para2') as $key => $segment6)
              <input type="hidden" value="{{ $segment6->id }}" name="segment6[{{ $b }}][ques_id]">
             <b>7. {{ $segment6->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment6[{{ $b }}][corrective_action]" id="corrective_action_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline">
                                        <div class="card-header">
                                          
                                            <b>8. Number of days of accounts payables ((Accounts payable *365) / Cost of
                                            goods/services procured) in the following format:</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 30%" class="text-center">
                                                          
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                           FY {{ $current_fy }} Current Financial Year
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                           FY {{ $previous_fy }} Previous Financial Year
                                                        </th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=18;
                                                    @endphp
                                                    @foreach ($accounts_quesMast->where('question_section','P1_accounts') as $key => $segment7)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$segment7->question}}
                                                                <input type="hidden" value="{{ $segment7->id }}" name="segment7[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment7[{{ $b }}][account_current_fy]" id=" account_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment7[{{ $b }}][account_previous_fy]" id="account_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $prev_accounts }} </textarea>
                                                            </td>
                                                            
                                                          </tr>
                                                        @php
                                                            $b++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                          
                                            <b>9. Open-ness of business
Provide details of concentration of purchases and sales with trading houses, dealers,
and related parties along-with loans and advances & investments, with related parties,
in the following format:</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 30%" class="text-center">
                                                          Metrics
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                           FY {{ $current_fy }} Current Financial Year
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                           FY {{ $previous_fy }} Previous Financial Year
                                                        </th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=19;
                                                    @endphp
                                                    @foreach ($business_quesMast->where('question_section','P1_purchase') as $key => $segment8)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$segment8->question}}
                                                                <input type="hidden" value="{{ $segment8->id }}" name="segment8[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment8[{{ $b }}][business_current_fy]" id="business_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                            <textarea 
    style="text-align: left; overflow:hidden; resize:none;"  
    name="segment8[{{ $b }}][business_previous_fy]" 
    id="business_previous_fy_{{$b}}"  
    class="form-control form-control-sm auto-grow"  
    oninput="autoResize(this)">
    {{ 
      $b == 19 ? $prev_house : 
      ($b == 20 ? $trading_house : 
      ($b == 21 ? $top10_house : 
      ($b == 22 ? $prev_dealers : 
      ($b == 23 ? $prev_nodealers : 
      ($b == 24 ? $prev_topdealers : 
      ($b == 25 ? $prev_purchase : 
      ($b == 26 ? $prev_sales : 
      ($b == 27 ? $prev_loans :  
      ($b == 28 ? $prev_investment : ''))))))))) 
    }}
  </textarea>
</td>

                                                            
                                                          </tr>
                                                        @php
                                                            $b++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                       <div class="card card-success card-outline mt-4">
                         <div class="card-header">
                          <b> Leadership Indicators </b> <br /> <br />
                          <b>1. Awareness programmes conducted for value chain partners on any of the Principles during the financial year: </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Total number of awareness programmes held </th>
                      <th style="width: 30%" class="text-center">Topics / principles covered under the training </th>
                      <th style="width: 30%" class="text-center">%age of value chain partners covered (by value of business done with such partners) under the awareness programmes</th>
                     
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows1">
                <tr>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn1"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>

      
      <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=29;
               @endphp
              @foreach ($entity_quesMast->where('question_section','P1_entityprocess') as $key => $segment9)
              <input type="hidden" value="{{ $segment9->id }}" name="segment9[{{ $b }}][ques_id]">
             <b>2. {{ $segment9->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment9[{{ $b }}][entity_process]" id="entity_process_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>
                </div>
                             </div>
                            </div>
                        </div>


                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.brsr.index') }}"
                                class="btn btn-warning btn-sm float-left"> <i
                                    class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-2 offset-md-3">
                             <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                            class="fas fa-save"></i>
                                        Submit</button>
                              
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
     

@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\SocialRequest', '#social_store') !!}
    @include('partials.js.prevent_multiple_submit')

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                   
                    <td><textarea class="form-control form-control-sm auto-grow" name="additional[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additional[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                    
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            
            
        });
    });
</script>

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn1').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows1').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            
            
        });
    });
</script>

<script>
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px'; 
    }
    
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.auto-grow').forEach(autoResize);
    });
</script>

@endpush
@endsection