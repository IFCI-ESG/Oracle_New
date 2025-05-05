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
                <form action="{{ route('user.brsr.sectionp8update') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit'
                    accept-charset="utf-8">
                    @csrf
                

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 8) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">
                      
                        <div class="card card-success card-outline mt-4">
                          <div class="card-header">
                          <b>PRINCIPLE 8 Businesses should promote inclusive growth and equitable development </b> <br /><br />
                          <b>Essential Indicators</b> <br /><br />
                           <b>1. Details of Social Impact Assessments (SIA) of projects undertaken by the entity based on applicable laws, in the current financial year.</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Name and brief details of project</th>
                      <th style="width: 30%" class="text-center">SIA Notification No.</th>
                      <th style="width: 30%" class="text-center">Date of notification</th>
                      <th style="width: 30%" class="text-center">Whether conducted by independent external agency (Yes / No)</th>
                      <th style="width: 30%" class="text-center">Results communicated in public domain (Yes / No)</th>
                      <th style="width: 30%" class="text-center">Relevant Web link</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows1">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp8_value1 as $key => $p8_value1)
                <tr>
                <input type="hidden" value="{{ $p8_value1->id }}" name="additionals1[{{ $b }}][row_id]">
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[{{ $b }}][project_name]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value1->project_name }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[{{ $b }}][sia_no]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value1->sia_no }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[{{ $b }}][notify_date]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value1->notify_date }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[{{ $b }}][external_agency]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value1->external_agency }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[{{ $b }}][public_domain]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value1->public_domain }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[{{ $b }}][web_link]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value1->web_link }}</textarea></td>
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
                          <b>2.Provide information on project(s) for which ongoing Rehabilitation and Resettlement
                          (R&R) is being undertaken by your entity, in the following format</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Name of Project for which R&R is ongoing </th>
                      <th style="width: 30%" class="text-center">State</th>
                      <th style="width: 30%" class="text-center">District</th>
                      <th style="width: 30%" class="text-center">No. of Project Affected Families (PAFs) </th>
                      <th style="width: 30%" class="text-center">% of PAFs covered by R&R </th>
                      <th style="width: 30%" class="text-center">Amounts paid to PAFs in the FY (In INR)</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows2">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp8_value2 as $key => $p8_value2)
                <tr>
                <input type="hidden" value="{{ $p8_value2->id }}" name="additionals2[{{ $b }}][row_id]">
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][rr_name]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value2->rr_name }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][state_name]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value2-> state_name }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][district_name]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value2->district_name }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][affected_family]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value2->affected_family }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][paf_percent]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value2->paf_percent }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][paf_amount]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value2->paf_amount }}</textarea></td>
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
              $b=1;
               @endphp
              @foreach ($community_ques->where('question_section','community') as $key => $segment1)
              <input type="hidden" value="{{ $sectionp8_value->where('ques_id',$segment1->id)->first()->id }}" name="segment1[{{ $b }}][row_id]">
             <b>3. {{ $segment1->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment1[{{ $b }}][community]" id="community_{{$b}}" placeholder="" rows="6">{{ $sectionp8_value->where('ques_id',$segment1->id)->first()->community }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

         
         <div class="card card-success card-outline">
             <div class="card-header">
                <b> 4. Percentage of input material (inputs to total inputs by value) sourced from suppliers:</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                        Current Financial Year {{ $current_fy }}
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          Previous Financial Year {{ $previous_fy }}
                                                        </th>
                                                     </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=2;
                                                    @endphp
                                                    @foreach ($material_ques->where('question_section','input_material') as $key => $segment2)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$segment2->question}}
                                                                <input type="hidden" value="{{ $sectionp8_value->where('ques_id',$segment2->id)->first()->id }}" name="segment2[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment2[{{ $b }}][input_material_current_fy]" id="input_material_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $sectionp8_value->where('ques_id',$segment2->id)->first()->input_material_current_fy }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment2[{{ $b }}][input_material_previous_fy]" id="input_material_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $sectionp8_value->where('ques_id',$segment2->id)->first()->input_material_previous_fy }}</textarea>
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
                <b> 5. Job creation in smaller towns – Disclose wages paid to persons employed (including 
                    employees or workers employed on a permanent or non-permanent / on contract basis) in the following locations, as % of total wage cost</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
                                                            Location
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                        Current Financial Year {{ $current_fy }}
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          Previous Financial Year {{ $previous_fy }}
                                                        </th>
                                                     </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=4;
                                                    @endphp
                                                    @foreach ($location_ques->where('question_section','location') as $key => $segment3)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$segment3->question}}
                                                                <input type="hidden" value="{{ $sectionp8_value->where('ques_id',$segment3->id)->first()->id }}" name="segment3[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment3[{{ $b }}][location_current_fy]" id="location_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $sectionp8_value->where('ques_id',$segment3->id)->first()->location_current_fy }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment3[{{ $b }}][location_previous_fy]" id="location_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $sectionp8_value->where('ques_id',$segment3->id)->first()->location_previous_fy }}</textarea>
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
                         <b>1. Provide details of actions taken to mitigate any negative social impacts identified in the Social Impact Assessments (Reference: Question 1 of Essential Indicators above):</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                        <th style="width: 30%" class="text-center">Details of negative social impact identified</th>
                        <th style="width: 30%" class="text-center">Corrective action taken </th>
                      </tr>
                </thead>
               <tbody id="additional_data_rows3">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp8_value3 as $key => $p8_value3)
                 <tr>
                  <input type="hidden" value="{{ $p8_value3->id }}" name="additionals3[{{ $b }}][row_id]">
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[{{ $b }}][social_details]" style="overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value3->social_details}}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[{{ $b }}][action_taken]" style="overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value3->action_taken }}</textarea></td>
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
                          <b>2. Provide the following information on CSR projects undertaken by your entity in 
                          designated aspirational districts as identified by government bodies:</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">State</th>
                      <th style="width: 30%" class="text-center">Aspirational District</th>
                      <th style="width: 30%" class="text-center">Amount spent (In INR)</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows4">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp8_value4 as $key => $p8_value4)
                <tr>
                <input type="hidden" value="{{ $p8_value4->id }}" name="additionals4[{{ $b }}][row_id]">
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][csr_state]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value4->csr_state}}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][asp_district]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value4->asp_district}}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][amount_spent]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value4->amount_spent}}</textarea></td>
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
              $b=8;
               @endphp
              @foreach ($group_ques1->where('question_section','vulnerable_groups') as $key => $segment4)
              <input type="hidden" value="{{ $sectionp8_value->where('ques_id',$segment4->id)->first()->id }}" name="segment4[{{ $b }}][row_id]">
             <b>3. (a) {{ $segment4->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment4[{{ $b }}][preferential_policy]" id="preferential_policy_{{$b}}" placeholder="" rows="6">{{ $sectionp8_value->where('ques_id',$segment4->id)->first()->preferential_policy }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=9;
               @endphp
              @foreach ($group_ques2->where('question_section','vulnerable_groups1') as $key => $segment5)
              <input type="hidden" value="{{ $sectionp8_value->where('ques_id',$segment5->id)->first()->id }}" name="segment5[{{ $b }}][row_id]">
             <b>(b) {{ $segment5->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment5[{{ $b }}][vulnerable_groups]" id="vulnerable_groups_{{$b}}" placeholder="" rows="6">{{ $sectionp8_value->where('ques_id',$segment5->id)->first()->vulnerable_groups }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=10;
               @endphp
              @foreach ($group_ques3->where('question_section','vulnerable_groups2') as $key => $segment6)
              <input type="hidden" value="{{ $sectionp8_value->where('ques_id',$segment6->id)->first()->id }}" name="segment6[{{ $b }}][row_id]">
              <b>(c) {{ $segment6->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment6[{{ $b }}][total_procurement]" id="total_procurement_{{$b}}" placeholder="" rows="6">{{ $sectionp8_value->where('ques_id',$segment6->id)->first()->total_procurement }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
                          <div class="card-header">
                          <b>4. Details of the benefits derived and shared from the intellectual properties owned or 
                            acquired by your entity (in the current financial year), based on traditional knowledge: </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Intellectual Property based on traditional knowledge</th>
                      <th style="width: 30%" class="text-center">Owned/Acquired (Yes/No) </th>
                      <th style="width: 30%" class="text-center">Benefit shared (Yes / No) </th>
                      <th style="width: 30%" class="text-center">Basis of calculating benefit share </th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows5">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp8_value5 as $key => $p8_value5)
                <tr>
                <input type="hidden" value="{{ $p8_value5->id }}" name="additionals5[{{ $b }}][row_id]">
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[{{ $b }}][traditional]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value5->traditional}}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[{{ $b }}][acquired]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value5->acquired}}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[{{ $b }}][benefit_shared]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value5->benefit_shared}}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[{{ $b }}][basis_benefit]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value5->basis_benefit}}</textarea></td>
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
                          <b>5. Details of corrective actions taken or underway, based on any adverse order in 
                            intellectual property related disputes wherein usage of traditional knowledge is involved. </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                       <th style="width: 30%" class="text-center">Name of authority</th>
                       <th style="width: 30%" class="text-center">Brief of the Case</th>
                       <th style="width: 30%" class="text-center">Corrective action taken</th>
                       
                    </tr>
                </thead>
               <tbody id="additional_data_rows6">
                @php
                  $b = 1;
                @endphp
                @foreach($sectionp8_value6 as $key => $p8_value6)
                <tr>
                <input type="hidden" value="{{ $p8_value6->id }}" name="additionals6[{{ $b }}][row_id]">
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[{{ $b }}][authority_name]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value6->authority_name }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[{{ $b }}][brief_case]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value6->brief_case }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[{{ $b }}][corrective_action]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value6->corrective_action }}</textarea></td>
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
                          <b>6. Details of beneficiaries of CSR Projects:</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">CSR Project</th>
                      <th style="width: 30%" class="text-center">No. of persons benefitted from CSR Projects</th>
                      <th style="width: 30%" class="text-center">% of beneficiaries from vulnerable and marginalized groups</th>
                     
                    </tr>
                </thead>
               <tbody id="additional_data_rows7">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp8_value7 as $key => $p8_value7)
                <tr>
                <input type="hidden" value="{{ $p8_value7->id }}" name="additionals7[{{ $b }}][row_id]">
                <td class="text-center">{{ $key + 1 }}</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[{{ $b }}][csr_project]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value7->csr_project }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[{{ $b }}][csr_persons]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value7->csr_persons }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[{{ $b }}][groups_percent]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p8_value7->groups_percent }}</textarea></td>
                </tr>
                 @php
                    $b++;
                    @endphp
                @endforeach
            </tbody>
          </table>
       
        </div>
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
                                        Update</button>
                              
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