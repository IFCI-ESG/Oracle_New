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
                <form action="{{ route('user.brsr.sectionp3store') }}" id="social_store" role="form" method="post"
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
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 3) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

  <div class="card card-success card-outline">
    <div class="card-header">
        <b>PRINCIPLE 3 Businesses should respect and promote the well-being of all employees, including those in their value chains</b><br /><br />
        <b>Essential Indicators</b><br /><br />
        <b>1. a. Details of measures for the well-being of employees:</b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th></th>
                    <th colspan="12" style="width: 100%">% of employees covered by</th>
                </tr>
                <tr class="text-center table-success">
                    <th rowspan="2">Category</th>
                    <th rowspan="2">Total (A)</th>
                    <th colspan="2">Health insurance</th>
                    <th colspan="2">Accident insurance</th>
                    <th colspan="2">Maternity benefits</th>
                    <th colspan="2">Paternity Benefits</th>
                    <th colspan="2">Day Care facilities</th>
                </tr>
                <tr class="text-center table-success">
                    <th>No. (B)</th>
                    <th>% (B / A)</th>
                    <th>No. (C)</th>
                    <th>% (C / A)</th>
                    <th>No. (D)</th>
                    <th>% (D / A)</th>
                    <th>No. (E)</th>
                    <th>% (E / A)</th>
                    <th>No. (F)</th>
                    <th>% (F / A)</th>
                </tr>
            </thead>
            <tbody>
                @php $b = 1; @endphp
                @foreach ($p3_ques1->where('question_section', 'emp') as $emp1)
                    <tr>
                        @if ($emp1->question_type == 'heading')
                            <td colspan="12" class="text-center fw-bold">{{ $emp1->question }}</td>
                        @else
                            <td>
                                {{ $emp1->question }}
                                <input type="hidden" name="emp1[{{ $b }}][ques_id]" value="{{ $emp1->id }}">
                            </td>

                            <!-- A -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][emp_total]" id="emp_total_{{ $b }}" oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- B -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][emp_health_no]" id="emp_health_no_{{ $b }}" oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- % B / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][emp_health_percent]" id="emp_health_percent_{{ $b }}" readonly>
                            </td>

                            <!-- C -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][emp_accident_no]" id="emp_accident_no_{{ $b }}" oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- % C / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][emp_accident_percent]" id="emp_accident_percent_{{ $b }}" readonly>
                            </td>

                            <!-- D -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][emp_maternity_no]" id="emp_maternity_no_{{ $b }}" oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- % D / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][emp_maternity_percent]"  id="emp_maternity_percent_{{ $b }}" readonly>
                            </td>

                            <!-- E -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][emp_paternity_no]" id="emp_paternity_no_{{ $b }}" oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- % E / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][emp_paternity_percent]" id="emp_paternity_percent_{{ $b }}" readonly>
                            </td>
                              <!-- E -->
                              <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp1[{{ $b }}][emp_daycare_no]" id="emp_daycare_no_{{ $b }}" oninput="calculateWagesPercent({{ $b }})">
                            </td>

                            <!-- % E / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp1[{{ $b }}][emp_daycare_percent]" id="emp_daycare_percent_{{ $b }}" readonly>
                            </td>
                        @endif
                    </tr>
                    @php $b++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
 
<div class="card card-success card-outline">
    <div class="card-header">
       <b>b. Details of measures for the well-being of workers:</b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th></th>
                    <th colspan="12" style="width: 100%">% of workers covered by</th>
                </tr>
                <tr class="text-center table-success">
                    <th rowspan="2">Category</th>
                    <th rowspan="2">Total (A)</th>
                    <th colspan="2">Health insurance</th>
                    <th colspan="2">Accident insurance</th>
                    <th colspan="2">Maternity benefits</th>
                    <th colspan="2">Paternity Benefits</th>
                    <th colspan="2">Day Care facilities</th>
                </tr>
                <tr class="text-center table-success">
                    <th>No. (B)</th>
                    <th>% (B / A)</th>
                    <th>No. (C)</th>
                    <th>% (C / A)</th>
                    <th>No. (D)</th>
                    <th>% (D / A)</th>
                    <th>No. (E)</th>
                    <th>% (E / A)</th>
                    <th>No. (F)</th>
                    <th>% (F / A)</th>
                </tr>
            </thead>
            <tbody>
                @php $b = 9; @endphp
                @foreach ($p3_ques2->where('question_section', 'worker') as $emp2)
                    <tr>
                        @if ($emp2->question_type == 'heading')
                            <td colspan="12" class="text-center fw-bold">{{ $emp2->question }}</td>
                        @else
                            <td>
                                {{ $emp2->question }}
                            <input type="hidden" name="emp2[{{ $b }}][ques_id]" value="{{ $emp2->id }}">
                            </td>

                            <!-- A -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp2[{{ $b }}][work_total]" id="work_total_{{ $b }}" oninput="calculateWagesPercent1({{ $b }})">
                            </td>

                            <!-- B -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp2[{{ $b }}][work_health_no]" id="work_health_no_{{ $b }}" oninput="calculateWagesPercent1({{ $b }})">
                            </td>

                            <!-- % B / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp2[{{ $b }}][work_health_percent]" id="work_health_percent_{{ $b }}" readonly>
                            </td>

                            <!-- C -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp2[{{ $b }}][work_accident_no]" id="work_accident_no_{{ $b }}" oninput="calculateWagesPercent1({{ $b }})">
                            </td>

                            <!-- % C / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp2[{{ $b }}][work_accident_percent]" id="work_accident_percent_{{ $b }}" readonly>
                            </td>

                            <!-- D -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp2[{{ $b }}][work_maternity_no]" id="work_maternity_no _{{ $b }}" oninput="calculateWagesPercent1({{ $b }})">
                            </td>

                            <!-- % D / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp2[{{ $b }}][work_maternity_percent]"  id="work_maternity_percent_{{ $b }}" readonly>
                            </td>

                            <!-- E -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp2[{{ $b }}][work_paternity_no]" id="work_paternity_no_{{ $b }}" oninput="calculateWagesPercent1({{ $b }})">
                            </td>

                            <!-- % E / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp2[{{ $b }}][work_paternity_percent]" id="work_paternity_percent_{{ $b }}" readonly>
                            </td>
                              <!-- E -->
                              <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp2[{{ $b }}][work_daycare_no]" id="work_daycare_no_{{ $b }}" oninput="calculateWagesPercent1({{ $b }})">
                            </td>

                            <!-- % E / A -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp2[{{ $b }}][work_daycare_percent]" id="work_daycare_percent_{{ $b }}" readonly>
                            </td>
                        @endif
                    </tr>
                    @php $b++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
 
    <div class="card card-success card-outline">
                    <div class="card-header">
                           <b> c. Spending on measures towards well-being of employees and workers (including 
                           permanent and other than permanent) in the following format – </b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          FY {{ $current_fy }} Current Financial Year 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          FY  {{ $previous_fy }} Previous Financial Year
                                                        </th>
                                                         
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=17;
                                                    @endphp
                                                    @foreach ($p3_ques3->where('question_section','emp-well-being') as $key => $emp3)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$emp3->question}}
                                                                <input type="hidden" value="{{ $emp3->id }}" name="emp3[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="emp3[{{ $b }}][measures_current_fy]" id="measures_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="emp3[{{ $b }}][measures_previous_fy]" id="measures_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
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
          <b>2. Details of retirement benefits, for Current FY and Previous Financial Year. </b><br /><br />
        </div>
        <div class="card-body p-3">
         <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
         <thead>
        <tr class="text-center table-success">
        <th style="width: 18%" class="text-center"></th>
          <th colspan="3" style="width: 70%">FY {{ $current_fy }} Current Financial Year </th>
          <th colspan="3" style="width: 70%">FY {{ $previous_fy }} Previous Financial Year </th>
          
        </tr>
        <tr class="text-center table-success">
          <th>Benefits</th>
          <th style="width: 20%">No. of employees covered as a % of total employees</th>
          <th style="width: 20%">No. of workers covered as a % of total workers </th>
          <th style="width: 20%">Deducted and deposited with the authority (Y/N/N.A.) </th>
          <th style="width: 30%">No. of employees covered as a % of total employees</th>
          <th style="width: 30%">No. of workers covered as a % of total workers </th>
          <th style="width: 30%">Deducted and deposited with the authority (Y/N/N.A.) </th>
        </th>
        </tr>
      </thead>
      <tbody id="additional_data_rows3">
        @php
          $b = 18;
        @endphp
                @foreach ($p3_ques4->where('question_section','retirement') as $key => $emp4)
        <tr>
        <td style="font-size: 1rem;">
            {{$emp4->question}}
                <input type="hidden" value="{{ $emp4->id }}" name="emp4[{{ $b }}][ques_id]">
        </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp4[{{ $b }}][retire_no_emp_current_fy]" id="retire_no_emp_current_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp4[{{ $b }}][retire_no_work_current_fy]" id="retire_no_work_current_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp4[{{ $b }}][retire_deducted_current_fy]" id="retire_deducted_current_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp4[{{ $b }}][retire_no_emp_previous_fy]" id="retire_no_emp_previous_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp4[{{ $b }}][retire_no_work_previous_fy]" id="retire_no_work_previous_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp4[{{ $b }}][retire_deducted_previous_fy]" id="retire_deducted_previous_fy_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
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
              $b=22;
               @endphp
              @foreach ($p3_ques5->where('question_section','entity') as $key => $emp5)
              <input type="hidden" value="{{ $emp5->id }}" name="emp5[{{ $b }}][ques_id]">
              <b> 3. Accessibility of workplaces </b><br /><br />
             <b> {{ $emp5->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp5[{{ $b }}][entity_accessible]" id="entity_accessible_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=23;
               @endphp
              @foreach ($p3_ques6->where('question_section','policy_link') as $key => $emp6)
              <input type="hidden" value="{{ $emp6->id }}" name="emp6[{{ $b }}][ques_id]">
             <b>4. {{ $emp6->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp6[{{ $b }}][entity_rights]" id="entity_rights_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

      <div class="card card-success card-outline mt-4">
         <div class="card-header">
          <b>5. Return to work and Retention rates of permanent employees and workers that took parental leave. </b><br /><br />
        </div>
        <div class="card-body p-3">
         <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
         <thead>
        <tr class="text-center table-success">
        <th style="width: 18%" class="text-center"></th>
          <th colspan="2" style="width: 70%">Permanent employees</th>
          <th colspan="2" style="width: 70%">Permanent workers</th>
          
        </tr>
        <tr class="text-center table-success">
          <th></th>
          <th style="width: 20%">Return to work rate</th>
          <th style="width: 20%">Retention rate</th>
          <th style="width: 20%">Return to work rate</th>
          <th style="width: 30%">Retention rate</th>
         </th>
        </tr>
      </thead>
      <tbody id="additional_data_rows3">
        @php
          $b = 24;
        @endphp
                @foreach ($p3_ques7->where('question_section','rentention_rate') as $key => $emp7)
       <tr>
        <td style="font-size: 1rem;">
            {{$emp7->question}}
                <input type="hidden" value="{{ $emp7->id }}" name="emp7[{{ $b }}][ques_id]">
        </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp7[{{ $b }}][return_work1]" id="return_work1_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp7[{{ $b }}][retention_rate1]" id="retention_rate1_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp7[{{ $b }}][return_work2]" id="return_work2_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="emp7[{{ $b }}][retention_rate2]" id="retention_rate2_{{$b}}" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
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
                  <b> 6. Is there a mechanism available to receive and redress grievances for the following categories of employees and worker? If yes, give details of the mechanism in brief.</b>
              </div>
                      <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                        Yes/No (If Yes, then give details of the mechanism in brief) 
                                                        </th>
                                                       </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=27;
                                                    @endphp
                                                    @foreach ($p3_ques8->where('question_section','grievance') as $key => $emp8)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$emp8->question}}
                                                                <input type="hidden" value="{{ $emp8->id }}" name="emp8[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="emp8[{{ $b }}][mechanism_details]" id="mechanism_details_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
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
        <b>7. Membership of employees and worker in association(s) or Unions recognised by the 
        listed entity:</b><br /><br />
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
                    <th>Total employees / workers in respective category (A)</th>
                    <th>No. of employees / workers in respective category, who are part of association(s) or Union (B)</th>
                    <th>% (B / A)</th>
                    <th>Total employees / workers in respective category (C)</th>
                    <th>No. of employees / workers in respective category, who are part of association(s) or Union (D) </th>
                    <th>% (D / C)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $b = 31;
                    $x = 1;
                @endphp
                @foreach ($p3_ques9->where('question_section', 'emp_worker') as $key => $emp9)
                <tr>
                    <!-- If it's a heading, don't display S. No. and merge columns -->
                    @if($emp9->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp9->question}}
                        </td>
                    @else
                        <!-- Display S. No. for non-heading rows -->
                        <td style="font-size: 1rem;">
                            {{$emp9->question}}
                             <input type="hidden" value="{{ $emp9->id }}" name="emp9[{{ $b }}][ques_id]">
                        </td>

                        <!-- Emp Total Current Fy (A) -->
                        <td class="text-center">
                        <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp9[{{ $b }}][union_tot_emp_current_fy]" id="union_tot_emp_current_fy_{{$b}}" 
                                oninput="calculatePercentages({{ $b }})" 
                                  @if(in_array($emp9->id, [31,34])) readonly @endif>
                        </td>

                        <!-- Emp No Current Fy (B) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} m_emp" name="emp9[{{ $b }}][union_no_emp_current_fy]" id="union_no_emp_current_fy_{{$b}}"  
                                oninput="calculatePercentages({{ $b }})" @if(in_array($emp9->id, [31,34])) readonly @endif>
                        </td>

                        <!-- Emp Percent Current Fy -->
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="union_emp_percent_current_fy_{{$b}}" name="emp9[{{ $b }}][union_emp_percent_current_fy]" class="form-control form-control-sm" readonly>
                        </td>

                        <!-- Emp Total Previous Fy (C) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp9[{{ $b }}][union_tot_emp_previous_fy]" id="union_tot_emp_previous_fy_{{$b}}" 
                                oninput="calculatePercentages({{ $b }})" @if(in_array($emp9->id, [31,34])) readonly @endif>
                        </td>
                        
                          <!-- Emp No Previous Fy (D) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} f_emp" name="emp9[{{ $b }}][union_no_emp_previous_fy]" id="union_no_emp_previous_fy_{{$b}}" 
                                oninput="calculatePercentages({{ $b }})" @if(in_array($emp9->id, [31,34])) readonly @endif>
                        </td>
                         <!-- Emp Percent Previous Percent -->
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="union_emp_percent_previous_fy_{{$b}}" name="emp9[{{ $b }}][union_emp_percent_previous_fy]" class="form-control form-control-sm" 
                            readonly>
                        </td>
                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

 
<div class="card card-success card-outline">
    <div class="card-header">
        <b>8. Details of training given to employees and workers</b><br /><br />
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
                    <th colspan="2" style="width: 20%">On Health and safety measures</th>
                    <th colspan="2" style="width: 20%">On Skill upgradation</th>
                    <th rowspan="2" style="width: 10%">Total (D)</th>
                    <th colspan="2" style="width: 20%">On Health and safety measures</th>
                    <th colspan="2" style="width: 20%">On Skill upgradation</th>
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
                $b = 37;
                 @endphp
                @foreach ($p3_ques10->where('question_section', 'training') as $emp10)
                    <tr>
                        @if ($emp10->question_type == 'heading')
                            <td colspan="11" class="text-center fw-bold">{{ $emp10->question }}</td>
                        @else
                            <td>
                                {{ $emp10->question }}
                                <input type="hidden" name="emp10[{{ $b }}][ques_id]" value="{{ $emp10->id }}">
                            </td>

                            <!-- A -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp10[{{ $b }}][training_tot_current_fy]" id="training_tot_current_fy_{{ $b }}" oninput="calculateWagesPercent2({{ $b }})"  @if(in_array($emp10->id, [40,44])) readonly @endif>
                            </td>

                            <!-- B -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp10[{{ $b }}][training_health_no_current_fy]" id="training_health_no_current_fy_{{ $b }}" oninput="calculateWagesPercent2({{ $b }})" @if(in_array($emp10->id, [40,44])) readonly @endif>
                            </td>

                            <!-- B / A % -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp10[{{ $b }}][training_health_percent_current_fy]"  id="training_health_percent_current_fy_{{ $b }}" readonly>
                            </td>

                            <!-- C -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp10[{{ $b }}][training_skill_no_current_fy]" id="training_skill_no_current_fy_{{ $b }}" oninput="calculateWagesPercent2({{ $b }})" @if(in_array($emp10->id, [40,44])) readonly @endif>
                            </td>

                            <!-- C / A % --> 
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp10[{{ $b }}][training_skill_percent_current_fy]"  id="training_skill_percent_current_fy_{{ $b }}" readonly>
                            </td>

                            <!-- D -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp10[{{ $b }}][training_tot_previous_fy]" id="training_tot_previous_fy_{{ $b }}" oninput="calculateWagesPercent2({{ $b }})" @if(in_array($emp10->id, [40,44])) readonly @endif>
                            </td>

                            <!-- E -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp10[{{ $b }}][training_health_no_previous_fy]" id="training_health_no_previous_fy_{{ $b }}" oninput="calculateWagesPercent2({{ $b }})" @if(in_array($emp10->id, [40,44])) readonly @endif>
                            </td>

                            <!-- E / D % -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp10[{{ $b }}][training_health_percent_previous_fy]"  id="training_health_percent_previous_fy_{{ $b }}" readonly>
                            </td>

                            <!-- F -->
                            <td>
                                <input type="number" class="form-control form-control-sm" min="0" name="emp10[{{ $b }}][training_skill_no_previous_fy]" id="training_skill_no_previous_fy_{{ $b }}" oninput="calculateWagesPercent2({{ $b }})" @if(in_array($emp10->id, [40,44])) readonly @endif>
                            </td>

                            <!-- F / D % -->
                            <td>
                                <input type="text" class="form-control form-control-sm" name="emp10[{{ $b }}][training_skill_percent_previous_fy]" id="training_skill_percent_previous_fy_{{ $b }}" readonly>
                            </td>
                        @endif
                    </tr>
                    @php $b++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="card card-success card-outline">
     <div class="card-header">
        <b>9. Details of performance and career development reviews of employees and worker:</b><br /><br />
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
                    <th>No. (B)</th>
                    <th>% (B / A)</th>
                    <th>Total (C)</th>
                    <th>No. (D) </th>
                    <th>% (D / C)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $b = 45;
                    $x = 1;
                @endphp
                @foreach ($p3_ques11->where('question_section', 'performance') as $key => $emp11)
                <tr>
                    <!-- If it's a heading, don't display S. No. and merge columns -->
                    @if($emp11->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp11->question}}
                        </td>
                    @else
                        <!-- Display S. No. for non-heading rows -->
                        <td style="font-size: 1rem;">
                            {{$emp11->question}}
                             <input type="hidden" value="{{ $emp11->id }}" name="emp11[{{ $b }}][ques_id]">
                        </td>

                        <!-- Emp Total Current Fy (A) -->
                        <td class="text-center">
                        <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp11[{{ $b }}][performance_tot_current_fy]" id="performance_tot_current_fy_{{$b}}" 
                                oninput="calculatePercentages1({{ $b }})" 
                                  @if(in_array($emp11->id, [48,52])) readonly @endif>
                        </td>

                        <!-- Emp No Current Fy (B) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} m_emp" name="emp11[{{ $b }}][performance_no_current_fy]" id="performance_no_current_fy_{{$b}}"  
                                oninput="calculatePercentages1({{ $b }})" @if(in_array($emp11->id, [48,52])) readonly @endif>
                        </td>

                        <!-- Emp Percent Current Fy -->
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="performance_percent_current_fy_{{$b}}" name="emp11[{{ $b }}][performance_percent_current_fy]" class="form-control form-control-sm" readonly>
                        </td>

                        <!-- Emp Total Previous Fy (C) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp11[{{ $b }}][performance_tot_previous_fy]" id="performance_tot_previous_fy_{{$b}}" 
                                oninput="calculatePercentages1({{ $b }})" @if(in_array($emp11->id, [48,52])) readonly @endif>
                        </td>
                        
                          <!-- Emp No Previous Fy (D) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} f_emp" name="emp11[{{ $b }}][performance_no_previous_fy]" id="performance_no_previous_fy_{{$b}}" 
                                oninput="calculatePercentages1({{ $b }})" @if(in_array($emp11->id, [48,52])) readonly @endif>
                        </td>
                         <!-- Emp Percent Previous Percent -->
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="performance_percent_previous_fy_{{$b}}" name="emp11[{{ $b }}][performance_percent_previous_fy]" class="form-control form-control-sm" 
                            readonly>
                        </td>
                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=51;
             
               @endphp
              @foreach ($p3_ques12->where('question_section','health') as $key => $emp12)
              <input type="hidden" value="{{ $emp12->id }}" name="emp12[{{ $b }}][ques_id]">
             <b>10. a. {{ $emp12->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp12[{{ $b }}][occupational_health]" id="occupational_health_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
            
             @endphp
             @endforeach
    </div>

    
<div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=52;
             
               @endphp
              @foreach ($p3_ques13->where('question_section','health1') as $key => $emp13)
              <input type="hidden" value="{{ $emp13->id }}" name="emp13[{{ $b }}][ques_id]">
             <b>b. {{ $emp13->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp13[{{ $b }}][access_risk]" id="access_risk_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
            
             @endphp
             @endforeach
    </div>


    
<div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=53;
             @endphp
              @foreach ($p3_ques14->where('question_section','health2') as $key => $emp14)
              <input type="hidden" value="{{ $emp14->id }}" name="emp14[{{ $b }}][ques_id]">
             <b>c. {{ $emp14->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp14[{{ $b }}][hazards_risk]" id="hazards_risk_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
            
             @endphp
             @endforeach
    </div>

  <div class="card card-success card-outline mt-4">
           <div class="card-header">
            @php
              $b=54;
             @endphp
              @foreach ($p3_ques15->where('question_section','health3') as $key => $emp15)
              <input type="hidden" value="{{ $emp15->id }}" name="emp15[{{ $b }}][ques_id]">
              <b>d. {{ $emp15->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp15[{{ $b }}][health_service]" id="health_service_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
            
             @endphp
             @endforeach
    </div>

    <div class="card card-success card-outline">
                    <div class="card-header">
                           <b> 11. Details of safety related incidents, in the following format: </b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
                                                          Category
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          FY {{ $current_fy }} Current Financial Year 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          FY  {{ $previous_fy }} Previous Financial Year
                                                        </th>
                                                         
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=55;
                                                    @endphp
                                                    @foreach ($p3_ques16->where('question_section','incidents') as $key => $emp16)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$emp16->question}}
                                                                <input type="hidden" value="{{ $emp16->id }}" name="emp16[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="emp16[{{ $b }}][incident_current_fy]" id="incident_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="emp16[{{ $b }}][incident_previous_fy]" id="incident_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
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
              $b=63;
             @endphp
              @foreach ($p3_ques17->where('question_section','safe_work') as $key => $emp17)
              <input type="hidden" value="{{ $emp17->id }}" name="emp17[{{ $b }}][ques_id]">
              <b>12. {{ $emp17->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp17[{{ $b }}][entity_measures]" id="entity_measures_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
            
             @endphp
             @endforeach
    </div>

    <div class="card card-success card-outline">
    <div class="card-header">
      <b>13. Number of Complaints on the following made by employees and workers</b>
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 10%" class="text-center"></th>
                    <th style="width: 30%" class="text-center" colspan="3">FY {{ $current_fy }} Current Financial Year</th>
                    <th style="width: 30%" class="text-center" colspan="3">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
                <tr class="text-center table-success">
                    
                    <th></th>
                    <th>Filed during the year </th>
                    <th>Pending resolution at the end of year</th>
                    <th>Remarks</th>
                    <th>Filed during the year</th>
                    <th>Pending resolution at the end of year</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $a = 64;
                    $x = 1;
                @endphp
                @foreach ($p3_ques18->where('question_section', 'complaints') as $key => $emp18)
                <tr>
                  
                    @if($emp18->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp18->question}}
                        </td>
                    @else
                       
                      <td style="font-size: 1rem;">
                            {{$emp18->question}}
                             <input type="hidden" value="{{ $emp18->id }}" name="emp18[{{ $a }}][ques_id]">
                       </td>

                        <td class="text-center">
                            <textarea style="text-align: left; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                              name="emp18[{{ $a }}][comp_filed_current_fy]" id="comp_filed_current_fy_{{$a}}" oninput="autoResize(this)"></textarea>
                        </td>
                        <td class="text-center">
                            <textarea style="text-align: left; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                                 name="emp18[{{ $a }}][comp_pending_current_fy]" id="comp_pending_current_fy_{{$a}}" oninput="autoResize(this)"></textarea>
                        </td>
                        <td class="text-center">
                           <textarea style="text-align: left; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                                 name="emp18[{{ $a }}][comp_remarks_current_fy]" id="comp_remarks_current_fy_{{$a}}" oninput="autoResize(this)"></textarea>
                        </td>

                        <td class="text-center">
                            <textarea style="text-align: left; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                              name="emp18[{{ $a }}][comp_field_previous_fy]" id="comp_field_previous_fy_{{$a}}" oninput="autoResize(this)"></textarea>
                        </td>
                        <td class="text-center">
                            <textarea style="text-align: left; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                                 name="emp18[{{ $a }}][comp_pending_previous_fy]" id="comp_pending_previous_fy_{{$a}}" oninput="autoResize(this)"></textarea>
                        </td>
                        <td class="text-center">
                           <textarea style="text-align: left; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                                 name="emp18[{{ $a }}][comp_remarks_previous_fy]" id="comp_remarks_previous_fy_{{$a}}" oninput="autoResize(this)"></textarea>
                        </td>
                     @php
                        $a++;
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

<div class="card card-success card-outline">
             <div class="card-header">
                  <b> 14. Assessments for the year: </b>
              </div>
                      <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                        Yes/No (If Yes, then give details of the mechanism in brief) 
                                                        </th>
                                                       </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=66;
                                                    @endphp
                                                    @foreach ($p3_ques19->where('question_section','assessment') as $key => $emp19)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$emp19->question}}
                                                                <input type="hidden" value="{{ $emp19->id }}" name="emp19[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="emp19[{{ $b }}][plant_percentage]" id="plant_percentage_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
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
              $b=68;
             @endphp
              @foreach ($p3_ques20->where('question_section','corrective_action') as $key => $emp20)
              <input type="hidden" value="{{ $emp20->id }}" name="emp20[{{ $b }}][ques_id]">
              <b>15. {{ $emp20->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp20[{{ $b }}][corrective_action]" id="corrective_action_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
            
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
           <div class="card-header">
            <b> Leadership Indicators </b><br /><br />
            @php
              $b=69;
             @endphp
              @foreach ($p3_ques21->where('question_section','package') as $key => $emp21)
              <input type="hidden" value="{{ $emp21->id }}" name="emp21[{{ $b }}][ques_id]">
              <b>1. {{ $emp21->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp21[{{ $b }}][entity_extend]" id="entity_extend_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
           <div class="card-header">
             @php
              $b=70;
             @endphp
              @foreach ($p3_ques22->where('question_section','package1') as $key => $emp22)
              <input type="hidden" value="{{ $emp22->id }}" name="emp22[{{ $b }}][ques_id]">
              <b>2. {{ $emp22->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp22[{{ $b }}][entity_ensure]" id="entity_ensure_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

         
              
   <div class="card card-success card-outline">
     <div class="card-header">
        <b>3. Provide the number of employees / workers having suffered high consequence work related injury / ill-health / fatalities (as reported in Q11 of Essential Indicators above), 
            who have been are rehabilitated and placed in suitable employment or whose family 
            members have been placed in suitable employment:</b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 10%" class="text-center"></th>
                    <th style="width: 30%" class="text-center" colspan="2">Total no. of affected employees/ workers </th>
                    <th style="width: 30%" class="text-center" colspan="2">No. of employees/workers that are rehabilitated and placed in suitable employment or whose family members have been placed in suitable employment</th>
                </tr>
                <tr class="text-center table-success">
                    <th></th>
                    <th> FY {{ $current_fy }} Current Financial Year </th>
                    <th> FY {{ $previous_fy }} Previous Financial Year </th>
                    <th> FY {{ $current_fy }} Current Financial Year </th>
                    <th> FY {{ $previous_fy }} Previous Financial Year </th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                    $b = 71;
                    $x = 1;
                @endphp
                @foreach ($p3_ques23->where('question_section', 'consequence') as $key => $emp23)
                <tr>
                    @if($emp23->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp23->question}}
                        </td>
                    @else
                        <td style="font-size: 1rem;">
                            {{$emp23->question}}
                             <input type="hidden" value="{{ $emp23->id }}" name="emp23[{{ $b }}][ques_id]">
                        </td>

                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp23[{{ $b }}][affected_emp_current_fy]" id="affected_emp_current_fy_{{$b}}">
                        </td>

                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} m_emp" name="emp23[{{ $b }}][affected_emp_previous_fy]" id="affected_emp_previous_fy_{{$b}}">
                        </td>

                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}}" name="emp23[{{ $b }}][family_mem_current_fy]" id="family_mem_current_fy_{{$b}}">
                        </td>

                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$b}} m_emp" name="emp23[{{ $b }}][family_mem_previous_fy]" id="family_mem_previous_fy_{{$b}}">
                        </td>
                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card card-success card-outline mt-4">
           <div class="card-header">
             @php
              $b=73;
             @endphp
              @foreach ($p3_ques24->where('question_section','retirement1') as $key => $emp24)
              <input type="hidden" value="{{ $emp24->id }}" name="emp24[{{ $b }}][ques_id]">
              <b>4. {{ $emp24->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp24[{{ $b }}][retirement_emp]" id="retirement_emp_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline">
             <div class="card-header">
                  <b> 5. Details on assessment of value chain partners: </b>
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
                                                        $b=74;
                                                    @endphp
                                                    @foreach ($p3_ques25->where('question_section','value_chain') as $key => $emp25)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$emp25->question}}
                                                                <input type="hidden" value="{{ $emp25->id }}" name="emp25[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="emp25[{{ $b }}][assessment_value]" id="assessment_value_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
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
              $b=76;
             @endphp
              @foreach ($p3_ques26->where('question_section','risks') as $key => $emp26)
              <input type="hidden" value="{{ $emp26->id }}" name="emp26[{{ $b }}][ques_id]">
              <b>6. {{ $emp26->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="emp26[{{ $b }}][work_condition]" id="work_condition_{{$b}}" placeholder="" rows="6"></textarea>
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
    31: [32, 33], // Row 31 is the total of rows 32 & 33
    34: [35, 36]  // Row 34 is the total of rows 35 & 36
};

// Fields that should be summed up
const fieldPrefixes = [
    'union_tot_emp_current_fy',
    'union_no_emp_current_fy',
    'union_tot_emp_previous_fy',
    'union_no_emp_previous_fy'
];

// Calculate percentage and ensure it doesn’t exceed 100%
function calculatePercentages(index) {
    const getVal = (id) => parseFloat(document.getElementById(id)?.value) || 0;

    const A = getVal(`union_tot_emp_current_fy_${index}`);
    const B = getVal(`union_no_emp_current_fy_${index}`);
    const C = getVal(`union_tot_emp_previous_fy_${index}`);
    const D = getVal(`union_no_emp_previous_fy_${index}`);

    const percentCurrent = A > 0 ? Math.min((B / A) * 100, 100).toFixed(2) + '%' : '0%';
    const percentPrevious = C > 0 ? Math.min((D / C) * 100, 100).toFixed(2) + '%' : '0%';

    document.getElementById(`union_emp_percent_current_fy_${index}`).value = percentCurrent;
    document.getElementById(`union_emp_percent_previous_fy_${index}`).value = percentPrevious;
}

// Auto-sum totals for rows like 31 = 32+33
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
    
    const allIndexes = Object.values(totalMappings).flat();

   
    allIndexes.forEach(i => {
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

    Object.keys(totalMappings).forEach(totalIndex => {
        const noFields = ['union_no_emp_current_fy', 'union_no_emp_previous_fy'];
        noFields.forEach(field => {
            const el = document.getElementById(`${field}_${totalIndex}`);
            if (el && !el.readOnly) {
                el.addEventListener('input', () => {
                    calculatePercentages(totalIndex);
                });
            }
        });
    });
});
</script>

<script>
function calculateWagesPercent(id) {
    
    let A = parseFloat(document.getElementById(`emp_total_${id}`)?.value) || 0;
    let B = parseFloat(document.getElementById(`emp_health_no_${id}`)?.value) || 0;
    let C = parseFloat(document.getElementById(`emp_accident_no_${id}`)?.value) || 0;
    let D = parseFloat(document.getElementById(`emp_maternity_no_${id}`)?.value) || 0;
    let E = parseFloat(document.getElementById(`emp_paternity_no_${id}`)?.value) || 0;
    let F = parseFloat(document.getElementById(`emp_daycare_no_${id}`)?.value) || 0;
  
    let percentB = A > 0 ? Math.min((B / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentC = A > 0 ? Math.min((C / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentD = A > 0 ? Math.min((D / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentE = A > 0 ? Math.min((E / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentF = A > 0 ? Math.min((F / A) * 100, 100).toFixed(2) + "%" : "0%";

    // Update DOM values
    document.getElementById(`emp_health_percent_${id}`).value = percentB;
    document.getElementById(`emp_accident_percent_${id}`).value = percentC;
    document.getElementById(`emp_maternity_percent_${id}`).value = percentD;
    document.getElementById(`emp_paternity_percent_${id}`).value = percentE;
    document.getElementById(`emp_daycare_percent_${id}`).value = percentF;
}
</script>

<script>
function calculateWagesPercent1(id) {
    
    let A = parseFloat(document.getElementById(`work_total_${id}`)?.value) || 0;
    let B = parseFloat(document.getElementById(`work_health_no_${id}`)?.value) || 0;
    let C = parseFloat(document.getElementById(`work_accident_no_${id}`)?.value) || 0;
    let D = parseFloat(document.getElementById(`work_maternity_no_${id}`)?.value) || 0;
    let E = parseFloat(document.getElementById(`work_paternity_no_${id}`)?.value) || 0;
    let F = parseFloat(document.getElementById(`work_daycare_no_${id}`)?.value) || 0;
  
    let percentB = A > 0 ? Math.min((B / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentC = A > 0 ? Math.min((C / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentD = A > 0 ? Math.min((D / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentE = A > 0 ? Math.min((E / A) * 100, 100).toFixed(2) + "%" : "0%";
    let percentF = A > 0 ? Math.min((F / A) * 100, 100).toFixed(2) + "%" : "0%";

    // Update DOM values
    document.getElementById(`work_health_percent_${id}`).value = percentB;
    document.getElementById(`work_accident_percent_${id}`).value = percentC;
    document.getElementById(`work_maternity_percent_${id}`).value = percentD;
    document.getElementById(`work_paternity_percent_${id}`).value = percentE;
    document.getElementById(`work_daycare_percent_${id}`).value = percentF;
}
</script>

<script>
const trainingTotalMappings = {
    40: [37, 38, 39],  
    44: [41, 42, 43] 
};

function calculateWagesPercent2(id) {
    let A = parseFloat(document.getElementById(`training_tot_current_fy_${id}`)?.value) || 0;
    let B = parseFloat(document.getElementById(`training_health_no_current_fy_${id}`)?.value) || 0;
    let C = parseFloat(document.getElementById(`training_skill_no_current_fy_${id}`)?.value) || 0;
    let D = parseFloat(document.getElementById(`training_tot_previous_fy_${id}`)?.value) || 0;
    let E = parseFloat(document.getElementById(`training_health_no_previous_fy_${id}`)?.value) || 0;
    let F = parseFloat(document.getElementById(`training_skill_no_previous_fy_${id}`)?.value) || 0;

    document.getElementById(`training_health_percent_current_fy_${id}`).value = A > 0 ? Math.min((B / A) * 100, 100).toFixed(2) + "%" : "0%";
    document.getElementById(`training_skill_percent_current_fy_${id}`).value = A > 0 ? Math.min((C / A) * 100, 100).toFixed(2) + "%" : "0%";
    document.getElementById(`training_health_percent_previous_fy_${id}`).value = D > 0 ? Math.min((E / D) * 100, 100).toFixed(2) + "%" : "0%";
    document.getElementById(`training_skill_percent_previous_fy_${id}`).value = D > 0 ? Math.min((F / D) * 100, 100).toFixed(2) + "%" : "0%";
}

function calculateTrainingTotals() {
    for (const [totalId, childIds] of Object.entries(trainingTotalMappings)) {
        const fields = [
            'training_tot_current_fy_',
            'training_health_no_current_fy_',
            'training_skill_no_current_fy_',
            'training_tot_previous_fy_',
            'training_health_no_previous_fy_',
            'training_skill_no_previous_fy_'
        ];

        fields.forEach(field => {
            let sum = 0;
            childIds.forEach(id => {
                const el = document.getElementById(`${field}${id}`);
                if (el) {
                    sum += parseFloat(el.value) || 0;
                }
            });

            const totalEl = document.getElementById(`${field}${totalId}`);
            if (totalEl) {
                totalEl.value = sum;
            }
        });

         
        calculateWagesPercent2(totalId);
    }
}

 
window.addEventListener('DOMContentLoaded', () => {
    const allIds = Object.values(trainingTotalMappings).flat();
    allIds.forEach(id => {
        [
            'training_tot_current_fy_',
            'training_health_no_current_fy_',
            'training_skill_no_current_fy_',
            'training_tot_previous_fy_',
            'training_health_no_previous_fy_',
            'training_skill_no_previous_fy_'
        ].forEach(prefix => {
            const el = document.getElementById(`${prefix}${id}`);
            if (el) {
                el.addEventListener('input', () => {
                    calculateWagesPercent2(id);
                    calculateTrainingTotals();
                });
            }
        });
    });
});
</script>

<script>
const performanceTotalMappings = {
    47: [45, 46],
    50: [48, 49]
};

function calculatePercentages1(id) {
    const A = parseFloat(document.getElementById(`performance_tot_current_fy_${id}`)?.value) || 0;
    const B = parseFloat(document.getElementById(`performance_no_current_fy_${id}`)?.value) || 0;
    const C = parseFloat(document.getElementById(`performance_tot_previous_fy_${id}`)?.value) || 0;
    const D = parseFloat(document.getElementById(`performance_no_previous_fy_${id}`)?.value) || 0;
    document.getElementById(`performance_percent_current_fy_${id}`).value = A > 0 ? Math.min((B / A) * 100, 100).toFixed(2) + "%" : "0%";
    document.getElementById(`performance_percent_previous_fy_${id}`).value = C > 0 ? Math.min((D / C) * 100, 100).toFixed(2) + "%" : "0%";

}

function calculatetotPercentages1() {
    for (const [totalId, childIds] of Object.entries(performanceTotalMappings)) {
        const fields = [
            'performance_tot_current_fy_',
            'performance_no_current_fy_',
            'performance_tot_previous_fy_',
            'performance_no_previous_fy_'
        ];

        fields.forEach(field => {
            let sum = 0;
            childIds.forEach(id => {
                const el = document.getElementById(`${field}${id}`);
                if (el) {
                    sum += parseFloat(el.value) || 0;
                }
            });

            const totalEl = document.getElementById(`${field}${totalId}`);
            if (totalEl) {
                totalEl.value = sum;
            }
        });

        calculatePercentages1(totalId);
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const allIds = Object.values(performanceTotalMappings).flat();
    allIds.forEach(id => {
        [
            'performance_tot_current_fy_',
            'performance_no_current_fy_',
            'performance_tot_previous_fy_',
            'performance_no_previous_fy_'
        ].forEach(prefix => {
            const el = document.getElementById(`${prefix}${id}`);
            if (el) {
                el.addEventListener('input', () => {
                    calculatePercentages1(id);
                    calculatetotPercentages1();
                });
            }
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