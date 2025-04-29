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
                <form action="{{ route('user.brsr.sectionp8store') }}" id="social_store" role="form" method="post"
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
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows1">
                <tr>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_f]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
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
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows2">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_f]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn2"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>

      <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=1;
               @endphp
              @foreach ($community_ques->where('question_section','community') as $key => $segment1)
              <input type="hidden" value="{{ $segment1->id }}" name="segment1[{{ $b }}][ques_id]">
             <b>3. {{ $segment1->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment1[{{ $b }}][community]" id="community_{{$b}}" placeholder="" rows="6"></textarea>
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
                                                                <input type="hidden" value="{{ $segment2->id }}" name="segment2[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment2[{{ $b }}][input_material_current_fy]" id="input_material_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment2[{{ $b }}][input_material_previous_fy]" id="input_material_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $b == 2 ? $previous_msme : ($b == 3 ? $previous_others : '') }}</textarea>
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
                                                                <input type="hidden" value="{{ $segment3->id }}" name="segment3[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment3[{{ $b }}][location_current_fy]" id="location_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment3[{{ $b }}][location_previous_fy]" id="location_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ 
  $b == 4 ? $previous_rural : 
  ($b == 5 ? $previous_semiurban : 
  ($b == 6 ? $previous_urban: 
  ($b == 7 ? $previous_metro : '')))
}} </textarea>
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
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows3">
                <tr>
                  
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn3"><i class="fas fa-plus"></i> Add</button>
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
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows4">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn4"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>

      <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=8;
               @endphp
              @foreach ($group_ques1->where('question_section','vulnerable_groups') as $key => $segment4)
              <input type="hidden" value="{{ $segment4->id }}" name="segment4[{{ $b }}][ques_id]">
             <b>3. (a) {{ $segment4->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment4[{{ $b }}][preferential_policy]" id="preferential_policy_{{$b}}" placeholder="" rows="6"></textarea>
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
              <input type="hidden" value="{{ $segment5->id }}" name="segment5[{{ $b }}][ques_id]">
             <b>(b) {{ $segment5->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment5[{{ $b }}][vulnerable_groups1]" id="vulnerable_groups1_{{$b}}" placeholder="" rows="6"></textarea>
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
              <input type="hidden" value="{{ $segment6->id }}" name="segment6[{{ $b }}][ques_id]">
             <b>(c) {{ $segment6->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment6[{{ $b }}][vulnerable_groups2]" id="vulnerable_groups2_{{$b}}" placeholder="" rows="6"></textarea>
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
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows5">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn5"><i class="fas fa-plus"></i> Add</button>
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
                       <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows6">
                <tr>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn6"><i class="fas fa-plus"></i> Add</button>
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
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows7">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn7"><i class="fas fa-plus"></i> Add</button>
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
        $('#add_row_btn1').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_f]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
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
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn2').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td class="text-center">${rowCount}</td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_d]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_e]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_f]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                     </td>
                </tr>
            `;
            $('#additional_data_rows2').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows2 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn3').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows3').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
        });
    });
</script>

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn4').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td class="text-center">${rowCount}</td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                     </td>
                </tr>
            `;
            $('#additional_data_rows4').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows4 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn5').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td class="text-center">${rowCount}</td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals5[${rowCount}][text_d]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                     </td>
                </tr>
            `;
            $('#additional_data_rows5').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows5 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn6').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals6[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                   
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows6').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
           
        });
    });
</script>
<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn7').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td class="text-center">${rowCount}</td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals7[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                     </td>
                </tr>
            `;
            $('#additional_data_rows7').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows7 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
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