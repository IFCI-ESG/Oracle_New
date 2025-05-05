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
                <form action="{{ route('user.brsr.sectionp5update') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit'
                    accept-charset="utf-8">
                    @csrf

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 5) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                              
                <!-- Employees - Start -->
   <div class="card card-success card-outline">
     <div class="card-header">
        <b>PRINCIPLE 5  Businesses should respect and promote human rights </b> <br /><br />
        <b>Essential Indicators</b> <br /><br />
        <b>1. Employees and workers who have been provided training on human rights issues and 
        policy(ies) of the entity, in the following format: </b><br /><br />
       
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Category</th>
                    <th style="width: 10%" class="text-center" colspan="3">Current Financial Year {{ $current_fy }}</th>
                    <th style="width: 10%" class="text-center" colspan="3">Previous Financial Year {{ $previous_fy }}</th>
                </tr>
                <tr class="text-center table-success">
                    
                    
                    <th></th>
                    <th>Total (A)</th>
                    <th>No. of employees / workers covered (B)</th>
                    <th>% (B / A)</th>
                    <th>Total (C) </th>
                    <th>No. of employees / workers covered (D) </th>
                    <th>% (D / C)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $b = 1;
                    $x = 1;
                @endphp
                @foreach ($employees_ques->where('question_section', 'emp_worker') as $key => $emp)
                @php
                   $employee_value_for_current_question = $principle5_value->firstWhere('ques_id', $emp->id);
                @endphp
                <tr>
                    <!-- If it's a heading, don't display S. No. and merge columns -->
                    @if($emp->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp->question}}
                        </td>
                    @else
                        <!-- Display S. No. for non-heading rows -->
                        <td style="font-size: 1rem;">
                            {{$emp->question}}
                            <input type="hidden" value="{{ $principle5_value->where('ques_id',$emp->id)->first()->id }}" name="emp[{{ $b }}][row_id]">
                        </td>

                        <!-- Emp Total Current Fy (A) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp[{{ $b }}][emp_tot_current_fy]" id="emp_tot_current_fy_{{$b}}" 
                               value = '{{ $employee_value_for_current_question->emp_tot_current_fy ?? 0}}' oninput="calculatePercentages({{ $b }})"
                                  @if(in_array($emp->id, [4,8])) readonly @endif>
                        </td>

                        <!-- Emp No Current Fy (B) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} m_emp" name="emp[{{ $b }}][emp_no_current_fy]" id="emp_no_current_fy_{{$b}}"  
                            value = '{{ $employee_value_for_current_question->emp_no_current_fy ?? 0}}' oninput="calculatePercentages({{ $b }})"@if(in_array($emp->id, [4,8])) readonly @endif>
                        </td>

                        <!-- Emp Percent Current Fy -->
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="emp_percent_current_fy_{{$b}}" name="emp[{{ $b }}][emp_percent_current_fy]" 
                              value = '{{ $employee_value_for_current_question->emp_percent_current_fy ?? 0}}' class="form-control form-control-sm" readonly>
                        </td>

                        <!-- Emp Total Previous Fy (C) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp[{{ $b }}][emp_tot_previous_fy]" id="emp_tot_previous_fy_{{$b}}" 
                              value = '{{ $employee_value_for_current_question->emp_tot_previous_fy ?? 0}}' oninput="calculatePercentages({{ $b }})"   @if(in_array($emp->id, [4,8])) readonly @endif>
                        </td>
                        
                          <!-- Emp No Previous Fy (D) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} f_emp" name="emp[{{ $b }}][emp_no_previous_fy]" id="emp_no_previous_fy_{{$b}}" 
                              value = '{{ $employee_value_for_current_question->emp_no_previous_fy ?? 0}}' oninput="calculatePercentages({{ $b }})" @if(in_array($emp->id, [4,8])) readonly @endif>
                        </td>
                         <!-- Emp Percent Previous Percent -->
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="emp_percent_previous_fy_{{$b}}" name="emp[{{ $b }}][emp_percent_previous_fy]"
                            value = '{{ $employee_value_for_current_question->emp_percent_previous_fy ?? 0}}' class="form-control form-control-sm" readonly>
                        </td>
                    @php
                        $b++;
                    @endphp
                    @php
                        $x++;
                    @endphp
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Employees End -->

<!-- Employees wages - Start -->
<div class="card card-success card-outline">
    <div class="card-header">
        <b>2. Details of minimum wages paid to employees and workers, in the following format:</b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
            <tr class="text-center table-success">
              <th></th>
              <th colspan="5" style="width: 50%">Current Financial Year {{ $current_fy }}</th>
              <th colspan="5" style="width: 50%">Previous Financial Year {{ $previous_fy }}</th>
             </tr>
                <tr class="text-center table-success">
                    <th rowspan="2">Category</th>
                    <th rowspan="2" style="width: 10%">Total (A)</th>
                    <th colspan="2" style="width: 20%">Equal to Minimum Wage</th>
                    <th colspan="2" style="width: 20%">More than Minimum Wage</th>
                    <th rowspan="2" style="width: 10%">Total (D)</th>
                    <th colspan="2" style="width: 20%">Equal to Minimum Wage</th>
                    <th colspan="2" style="width: 20%">More than Minimum Wage</th>
                </tr>
                <tr class="text-center table-success">
                    <th>No. (B)</th>
                    <th>% (B / A)</th>
                    <th>No. (C)</th>
                    <th>% (C / A)</th>
                    <th>No. (E)</th>
                    <th>% (E / D)</th>
                    <th>No. (F)</th>
                    <th>% (F / D)</th>
                </tr>
            </thead>
            <tbody>
                @php 
                $b = 7;
                 @endphp
                @foreach ($wages_ques->where('question_section', 'emp_wages') as $emp1)
                @php
                   $wages_value_for_current_question = $principle5_value->firstWhere('ques_id', $emp1->id);
                @endphp
                    <tr>
                        @if ($emp1->question_type == 'heading')
                            <td colspan="11" class="text-center fw-bold">{{ $emp1->question }}</td>
                        @else
                            <td>
                                {{ $emp1->question }}
                                <input type="hidden" value="{{ $principle5_value->where('ques_id',$emp1->id)->first()->id }}" name="emp1[{{ $b }}][row_id]">
                            </td>

                            <!-- A -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][wage_tot_current_fy]" id="wage_tot_current_fy_{{ $b }}"
                                value = '{{ $wages_value_for_current_question->wage_tot_current_fy ?? 0}}'  oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- B -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][wage_equal_no_current_fy]" id="wage_equal_no_current_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_equal_no_current_fy ?? 0}}'  oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- B / A % -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][wage_equal_percent_current_fy]"  id="wage_equal_percent_current_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_equal_percent_current_fy ?? 0}}' readonly>
                            </td>

                            <!-- C -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][wage_more_no_current_fy]" id="wage_more_no_current_fy_{{ $b }}"
                                value = '{{ $wages_value_for_current_question->wage_more_no_current_fy ?? 0}}'  oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- C / A % --> 
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][wage_more_percent_current_fy]"  id="wage_more_percent_current_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_more_percent_current_fy ?? 0}}'  readonly>
                            </td>

                            <!-- D -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][wage_tot_previous_fy]" id="wage_tot_previous_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_tot_previous_fy ?? 0}}' oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- E -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][wage_equal_no_previous_fy]" id="wage_equal_no_previous_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_equal_no_previous_fy ?? 0}}'  oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- E / D % -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][wage_equal_percent_previous_fy]"  id="wage_equal_percent_previous_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_equal_percent_previous_fy ?? 0}}'  readonly>
                            </td>

                            <!-- F -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][wage_more_no_previous_fy]" id="wage_more_no_previous_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_more_no_previous_fy ?? 0}}'  oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- F / D % -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][wage_more_percent_previous_fy]" id="wage_more_percent_previous_fy_{{ $b }}" 
                                value = '{{ $wages_value_for_current_question->wage_more_percent_previous_fy ?? 0}}'  readonly>
                            </td>
                        @endif
                    </tr>
                    @php $b++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Employees wages End -->

<div class="card card-success card-outline mt-4">
   <div class="card-header">
      <b>3.Details of remuneration/salary/wages </b><br /><br />
      <b> a. Median remuneration / wages: </b><br />
  </div>
  <div class="card-body p-3">
    <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
      <thead>
        <tr class="text-center table-success">
        <th style="width: 30%" class="text-center"></th>
          <th colspan="2" style="width: 60%">Male</th>
          <th colspan="2" style="width: 60%">Female</th>
          
        </tr>
        <tr class="text-center table-success">
          <th></th>
          <th style="width: 30%">Number</th>
          <th style="width: 30%">Median remuneration/ salary/ wages of respective category</th>
          <th style="width: 30%">Number</th>
          <th style="width: 30%">Median remuneration/ salary/ wages of respective category</th>
        </th>
        </tr>
      </thead>
      <tbody id="additional_data_rows3">
        @php
         $b = 21;
        @endphp
        @foreach ($salary_ques->where('question_section','emp_salary') as $key => $segment3)
        <tr>
        <td style="font-size: 1rem;">
            {{$segment3->question}}
            <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment3->id)->first()->id }}" name="segment3[{{ $b }}][row_id]">
        </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment3[{{ $b }}][male_sal_number]" id="male_sal_number_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment3->id)->first()->male_sal_number }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment3[{{ $b }}][male_wages]" id="male_wages_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment3->id)->first()->male_wages }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment3[{{ $b }}][female_sal_number]" id="female_sal_number_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment3->id)->first()->female_sal_number }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment3[{{ $b }}][female_wages]" id="female_wages_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment3->id)->first()->female_wages }}</textarea>
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
                           <b> b. Gross wages paid to females as % of total wages paid by the entity, in the following format: </b>
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
                                                        $b=25;
                                                    @endphp
                                                    @foreach ($grosswages_ques->where('question_section','gross_wage') as $key => $segment4)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment4->question}}
                                                                <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment4->id)->first()->id }}" name="segment4[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment4[{{ $b }}][gross_wages_current_fy]" id="gross_wages_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment4->id)->first()->gross_wages_current_fy }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment4[{{ $b }}][gross_wages_previous_fy]" id="gross_wages_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment4->id)->first()->gross_wages_previous_fy }}</textarea>
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
              $b=26;
               @endphp
              @foreach ($focal_ques->where('question_section','focal_point') as $key => $segment5)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment5->id)->first()->id }}" name="segment5[{{ $b }}][row_id]">
             <b>4. {{ $segment5->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment5[{{ $b }}][focal_point]" id="focal_point_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment5->id)->first()->focal_point }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=27;
               @endphp
              @foreach ($internal_ques->where('question_section','internal') as $key => $segment6)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment6->id)->first()->id }}" name="segment6[{{ $b }}][row_id]">
             <b>5. {{ $segment6->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment6[{{ $b }}][internal_mech]" id="internal_mech_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment6->id)->first()->internal_mech }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
   <div class="card-header">
      <b>6. Number of Complaints on the following made by employees and workers: </b><br /><br />
    </div>
  <div class="card-body p-3">
    <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
      <thead>
        <tr class="text-center table-success">
        <th style="width: 18%" class="text-center"></th>
          <th colspan="3" style="width: 70%">Current Financial Year {{ $current_fy }}</th>
          <th colspan="3" style="width: 70%">Previous Financial Year {{ $previous_fy }}</th>
          
        </tr>
        <tr class="text-center table-success">
          <th></th>
          <th style="width: 20%">Filed during the year</th>
          <th style="width: 20%">Pending resolution at the end of year</th>
          <th style="width: 20%">Remarks</th>
          <th style="width: 30%">Filed during the year</th>
          <th style="width: 30%">Pending resolution at the end of year</th>
          <th style="width: 30%">Remarks</th>
        </th>
        </tr>
      </thead>
      <tbody id="additional_data_rows3">
      @php
                    $b = 28;
                @endphp
                @foreach ($compliants_ques->where('question_section','compliants') as $key => $segment7)
        <tr>
        <td style="font-size: 1rem;">
            {{$segment7->question}}
            <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment7->id)->first()->id }}" name="segment7[{{ $b }}][row_id]">
        </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment7[{{ $b }}][compliants_filed_current_fy]" id="compliants_filed_current_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment7->id)->first()->compliants_filed_current_fy }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment7[{{ $b }}][compliants_pending_current_fy]" id="compliants_pending_current_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment7->id)->first()->compliants_pending_current_fy }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment7[{{ $b }}][compliants_remarks_current_fy]" id="compliants_remarks_current_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment7->id)->first()->compliants_remarks_current_fy }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment7[{{ $b }}][compliants_filed_previous_fy]" id="compliants_filed_previous_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment7->id)->first()->compliants_filed_previous_fy }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment7[{{ $b }}][compliants_pending_previous_fy]" id="compliants_pending_previous_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment7->id)->first()->compliants_pending_previous_fy }}</textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="segment7[{{ $b }}][compliants_remarks_previous_fy]" id="compliants_remarks_previous_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment7->id)->first()->compliants_remarks_previous_fy }}</textarea>
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
                           <b> 7. Complaints filed under the Sexual Harassment of Women at Workplace (Prevention, Prohibition and Redressal) Act, 2013, in the following format: </b>
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
                                                        $b=34;
                                                    @endphp
                                                    @foreach ($ppr_ques->where('question_section','ppr') as $key => $segment8)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment8->question}}
                                                                <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment8->id)->first()->id }}" name="segment8[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment8[{{ $b }}][ppr_current_fy]" id="ppr_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment8->id)->first()->ppr_current_fy }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment8[{{ $b }}][ppr_previous_fy]" id="ppr_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment8->id)->first()->ppr_previous_fy }}</textarea>
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
              $b=37;
               @endphp
              @foreach ($case_ques->where('question_section','case') as $key => $segment9)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment9->id)->first()->id }}" name="segment9[{{ $b }}][row_id]">
             <b>8. {{ $segment9->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment9[{{ $b }}][cases]" id="cases_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment9->id)->first()->cases }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=38;
               @endphp
              @foreach ($case_ques1->where('question_section','case1') as $key => $segment10)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment10->id)->first()->id }}" name="segment10[{{ $b }}][row_id]">
             <b>9. {{ $segment10->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment10[{{ $b }}][contracts]" id="contracts_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment10->id)->first()->contracts }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline">
                    <div class="card-header">
                           <b> 10. Assessments for the year: </b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                        % of your plants and offices that were assessed  (by entity or statutory authorities orthird parties)

                                                        </th>
                                                       
                                                         
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=39;
                                                    @endphp
                                                    @foreach ($assessment_ques->where('question_section','emp_assessment') as $key => $segment11)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment11->question}}
                                                                <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment11->id)->first()->id }}" name="segment11[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment11[{{ $b }}][assessment_percent]" id="assessment_percent_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment11->id)->first()->assessment_percent }}</textarea>
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
              $b=45;
               @endphp
              @foreach ($risk_ques->where('question_section','risk') as $key => $segment12)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment12->id)->first()->id }}" name="segment12[{{ $b }}][row_id]">
             <b>11. {{ $segment12->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment12[{{ $b }}][corrective_actions]" id="corrective_actions_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment12->id)->first()->corrective_actions }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=46;
               @endphp
              @foreach ($business_ques->where('question_section','business_process') as $key => $segment13)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment13->id)->first()->id }}" name="segment13[{{ $b }}][row_id]">
              <b> Leadership Indicators </b> </br></br>
             <b>1. {{ $segment13->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment13[{{ $b }}][business_process]" id="business_process_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment13->id)->first()->business_process }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=47;
               @endphp
              @foreach ($scope_ques->where('question_section','scope') as $key => $segment14)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment14->id)->first()->id }}" name="segment14[{{ $b }}][row_id]">
               <b>2. {{ $segment14->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment14[{{ $b }}][scope_details]" id="scope_details_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment14->id)->first()->scope_details }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=48;
               @endphp
              @foreach ($entity_ques->where('question_section','entity') as $key => $segment15)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment15->id)->first()->id }}" name="segment15[{{ $b }}][row_id]">
              <b>3. {{ $segment15->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment15[{{ $b }}][premise]" id="premise_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment15->id)->first()->premise }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline">
                    <div class="card-header">
                           <b> 4. Details on assessment of value chain partners</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          % of value chain partners (by value of business done with such partners) that were assessed
                                                        </th>
                                                     </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=49;
                                                    @endphp
                                                    @foreach ($valuechain_ques->where('question_section','value_chain') as $key => $segment16)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$segment16->question}}
                                                                <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment16->id)->first()->id }}" name="segment16[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment16[{{ $b }}][value_chain_percent]" id="value_chain_percent_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle5_value->where('ques_id',$segment16->id)->first()->value_chain_percent }}</textarea>
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
               $b=55;
               @endphp
              @foreach ($action_ques->where('question_section','actions') as $key => $segment17)
              <input type="hidden" value="{{ $principle5_value->where('ques_id',$segment17->id)->first()->id }}" name="segment17[{{ $b }}][row_id]">
                <b>5. {{ $segment17->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment17[{{ $b }}][risk_concerns]" id="risk_concerns_{{$b}}" placeholder="" rows="6">{{ $principle5_value->where('ques_id',$segment17->id)->first()->risk_concerns }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
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
    const totalMappings = {
        3: [1, 2], // Index 3 = 1 + 2
        6: [4, 5]  // Index 6 = 4 + 5
    };

    const fieldPrefixes = [
        'emp_tot_current_fy',
        'emp_no_current_fy',
        'emp_tot_previous_fy',
        'emp_no_previous_fy'
    ];

    function calculatePercentages(index) {
        const getVal = (id) => parseFloat(document.getElementById(id)?.value) || 0;

        const A = getVal(`emp_tot_current_fy_${index}`);
        const B = getVal(`emp_no_current_fy_${index}`);
        const C = getVal(`emp_tot_previous_fy_${index}`);
        const D = getVal(`emp_no_previous_fy_${index}`);

        const percentCurrent = A > 0 ? (Math.min((B / A) * 100, 100)).toFixed(2) + '%' : '0%';
        const percentPrevious = C > 0 ? (Math.min((D / C) * 100, 100)).toFixed(2) + '%' : '0%';
        document.getElementById(`emp_percent_current_fy_${index}`).value = percentCurrent;
        document.getElementById(`emp_percent_previous_fy_${index}`).value = percentPrevious;
    }

    function calculateTotals() {
        for (const [totalIndex, sourceIndexes] of Object.entries(totalMappings)) {
            fieldPrefixes.forEach(field => {
                let sum = 0;
                sourceIndexes.forEach(i => {
                    const el = document.getElementById(`${field}_${i}`);
                    if (el) sum += parseFloat(el.value) || 0;
                });

                const totalInput = document.getElementById(`${field}_${totalIndex}`);
                if (totalInput) {
                    totalInput.value = sum;
                }
            });

            calculatePercentages(totalIndex);
        }
    }

 window.addEventListener('DOMContentLoaded', () => {
        Object.values(totalMappings).flat().forEach(i => {
            fieldPrefixes.forEach(field => {
                const el = document.getElementById(`${field}_${i}`);
                if (el) {
                    el.addEventListener('input', () => {
                        calculatePercentages(i);
                        calculateTotals();
                    });
                }
            });
        });
    });
</script>

<script>
function calculateWagesPercent(id) {
    // Get numeric values (Current FY)
    let A = parseFloat(document.getElementById(`wage_tot_current_fy_${id}`)?.value) || 0;
    let B = parseFloat(document.getElementById(`wage_equal_no_current_fy_${id}`)?.value) || 0;
    let C = parseFloat(document.getElementById(`wage_more_no_current_fy_${id}`)?.value) || 0;

    // Get numeric values (Previous FY)
    let D = parseFloat(document.getElementById(`wage_tot_previous_fy_${id}`)?.value) || 0;
    let E = parseFloat(document.getElementById(`wage_equal_no_previous_fy_${id}`)?.value) || 0;
    let F = parseFloat(document.getElementById(`wage_more_no_previous_fy_${id}`)?.value) || 0;

    // Calculate percentages with limit to 100%
    let percentB = A > 0 ? Math.min((B / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentC = A > 0 ? Math.min((C / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentE = D > 0 ? Math.min((E / D) * 100, 100).toFixed(2) + "%" : "0%";
    let percentF = D > 0 ? Math.min((F / D) * 100, 100).toFixed(2) + "%" : "0%";

    // Update DOM values
    document.getElementById(`wage_equal_percent_current_fy_${id}`).value = percentB;
    document.getElementById(`wage_more_percent_current_fy_${id}`).value = percentC;
    document.getElementById(`wage_equal_percent_previous_fy_${id}`).value = percentE;
    document.getElementById(`wage_more_percent_previous_fy_${id}`).value = percentF;
}
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