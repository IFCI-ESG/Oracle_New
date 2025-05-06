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
                <form action="{{ route('user.brsr.store') }}" id="social_store" role="form" method="post"
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
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section A (General Disclosures) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b><u>Details of the listed entity</u></b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        <th style="width: 10%" class="text-center">
                                                            Sr. No.
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Question
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                            Response
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $a=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('question_section','Section A') as $key => $emp)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $key+1 }}
                                                            </td>
                                                            <td @if($emp->type=='heading')
                                                                    style="font-size: 1rem; font-weight: bold;" colspan="5"
                                                                @else
                                                                    style="font-size: 1rem;"
                                                                @endif>
                                                                {{$emp->question}}  
                                                                 <input type="hidden" value="{{ $emp->id }}" name="emp[{{ $a }}][ques_id]">
                                                                </td>
                                                                @if ($emp->id == 4 || $emp->id == 5)
                                                                <td>
                                                                     <textarea style="text-align: left; width: 500px;"  name="emp[{{ $a }}][response]" class="form-control form-control-sm" required></textarea>
                                                                </td>
                                                                @elseif ($emp->id == 1)
                                                                <td> 
                                                                        <input type="text" style="text-align: left;width:500px;"  class="form-control form-control-sm" value="{{ $user->cin_llpin }}" name="emp[{{ $a }}][response]" readonly>
                                                                    </td>
                                                                @elseif ($emp->id == 2)
                                                                <td>
                                                                        <input type="text" style="text-align: left;width:500px;" name="emp[{{ $a }}][response]"  class="form-control form-control-sm" value="{{ $user->name }}" readonly>
                                                                    </td>
                                                                @elseif ($emp->id == 6)
                                                                <td>
                                                                        <input type="text" style="text-align: left;width:500px;"name="emp[{{ $a }}][response]" class="form-control form-control-sm" value="{{ $user->email }}" readonly>
                                                                    </td>
                                                                    @elseif ($emp->id == 7)
                                                                <td>
                                                                        <input type="text" style="text-align: left;width:500px;"name="emp[{{ $a }}][response]" class="form-control form-control-sm" value="{{ $user->mobile }}" readonly>
                                                                    </td>

                                                                @elseif ($emp->id == 12)
                                                                <td>
                                                                     <textarea style="text-align: left; width: 500px;height:100px;" name="emp[{{ $a }}][response]"  class="form-control form-control-sm" required></textarea>
                                                                </td>

                                                                
                                                                @elseif ($emp->id == 13)
                                                                <td>
                                                                     <textarea style="text-align: left; width: 500px;height:200px;" name="emp[{{ $a }}][response]"  class="form-control form-control-sm" required  ></textarea>
                                                                </td>

                                                                @else 
                                                                <td>
                                                                    <input type="text" style="text-align: left;width:500px;" name="emp[{{ $a }}][response]"  class="form-control form-control-sm" required >
                                                                </td>
                                                                    @endif
                                                        </tr>
                                                        @php
                                                            $a++;
                                                        @endphp
                                                    @endforeach
                                               
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    
                    <!-- Products/Services  -->
                  <div class="card card-success card-outline mt-4">
                   <div class="card-header">
                     <b><u>Products/Services</u></b><br/><br/>
                     <b> 16. Details of business activities (accounting for 90% of the turnover): </b>
                   </div>
                    <div class="card-body p-3">
                    <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                     <thead>
                    <tr class="text-center table-success">
                     <th style="width: 10%" class="text-center">S.No</th>
                     <th style="width: 30%" class="text-center">Description of Main Activity</th>
                     <th style="width: 30%" class="text-center">Description of Business Activity</th>
                     <th style="width: 30%" class="text-center">% of Turnover of the entity</th>
                     <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additional[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additional[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additional[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn"><i class="fas fa-plus"></i> Add Business Activities</button>
        </div>
      </div>
       <!-- End of product/Services business activities Table -->


         <!-- Products/Services sold table  -->
         <div class="card card-success card-outline mt-4">
                   <div class="card-header">
                   
                     <b> 17. Products/Services sold by the entity (accounting for 90% of the entity’s Turnover):</b>
                   </div>
                    <div class="card-body p-3">
                    <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table1">
                     <thead>
                    <tr class="text-center table-success">
                     <th style="width: 10%" class="text-center">S.No</th>
                     <th style="width: 30%" class="text-center">Product/Service</th>
                     <th style="width: 30%" class="text-center">NIC Code</th>
                     <th style="width: 30%" class="text-center">% of total Turnover contributed</th>
                     <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows1">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_f]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                 <td class="text-center">
                   <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                 </td>
             </tr>
          </tbody>
      </table>
     <button type="button" class="btn btn-success btn-sm" id="add_row_btn1"><i class="fas fa-plus"></i> Add Products/Services Sold by Entity</button>
    </div>
</div>
<!-- End of Products/Services sold Table -->

<!-- Operations -->
<div class="card card-success card-outline mt-4">
    <div class="card-header">
        <b><u>Operations</u></b><br/><br/>
        <b> 18. Number of locations where plants and/or operations/offices of the entity are situated: </b>
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="operations_data_table">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Location</th>
                    <th style="width: 30%" class="text-center">Number of Plants</th>
                    <th style="width: 30%" class="text-center">Number of offices</th>
                    <th style="width: 30%" class="text-center">Total</th>
                </tr>
            </thead>
            <tbody id="operations_data_rows">
                <tr>
                    <td><input type="text" class="form-control form-control-sm" name="operation[1][text_a]" value="National" readonly></td>
                    <td><input type="number" class="form-control form-control-sm" name="operation[1][text_b]" oninput="calculateTotal(1)" value="0" required></td>
                    <td><input type="number" class="form-control form-control-sm" name="operation[1][text_c]" oninput="calculateTotal(1)" value="0" required></td>
                    <td><input type="number" class="form-control form-control-sm" name="operation[1][text_d]" id="total_1" value="0" readonly></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" name="operation[1][text_e]" value="International" readonly></td>
                    <td><input type="number" class="form-control form-control-sm" name="operation[1][text_f]" oninput="calculateTotals(2)" value="0" required></td>
                    <td><input type="number" class="form-control form-control-sm" name="operation[1][text_g]" oninput="calculateTotals(2)" value="0" required></td>
                    <td><input type="number" class="form-control form-control-sm" name="operation[1][text_h]" id="total_2" value="0" readonly></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- End of Operations- no-of-locations Table -->


 <!-- Operations - Market Served by Entity -->
<div class="card card-success card-outline mt-4">
    <div class="card-header">
        <b><u>19. Markets served by the entity:</u></b><br /><br />
        <b> a. Number of locations </b>
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="operations_data_table1">
            <thead>
                <tr class="text-center table-success">
                  
                    <th style="width: 30%" class="text-center">Locations</th>
                    <th style="width: 30%" class="text-center">Number</th>
                </tr>
            </thead>
            <tbody id="operations_data_rows1">
                <tr>
                    <td><input type="text" class="form-control form-control-sm" name="operation[1][text_i]" value="National (No. of States)" readonly></td>
                    <td><input type="text" class="form-control form-control-sm" name="operation[1][text_j]" required></td>
                </tr>
                 <tr>
                    <td><input type="text" class="form-control form-control-sm" name="operation[1][text_k]" value="International (No. of Countries)" readonly></td>
                    <td><input type="text" class="form-control form-control-sm" name="operation[1][text_l]" required></td>
                 </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- End of Operations- Market Served by Entity Table -->

 <!-- Operations - contribution of exports -->
 <div class="card card-success card-outline mt-4">
    <div class="card-header">
      <b>b. What is the contribution of exports as a percentage of the total turnover of the entity?</b>
    </div>
    <div class="card-body p-1">
        <textarea class="form-control form-control-sm" name="operation[1][text_m]" placeholder="Enter the contribution of exports as a percentage of total turnover" rows="6" required></textarea>
    </div>
</div>

<!-- End of Operations-  contribution of exports Table -->

 <!-- Operations - Brief on type of customers -->
 <div class="card card-success card-outline mt-4">
    <div class="card-header">
      <b>c. A brief on types of customers </b>
    </div>
    <div class="card-body p-1">
        <textarea class="form-control form-control-sm" name="operation[1][text_n]" placeholder="Enter brief on types of customers " rows="6" required></textarea>
    </div>
</div>
<!-- End of Operations-  contribution of exports Table -->
 
<!-- Employees - Start -->
<div class="card card-success card-outline">
    <div class="card-header">
        <b><u>Employees</u></b><br /><br />
        <b>20. Details as at the end of Financial Year: </b><br /><br />
        <b>a. Employees and workers (including differently abled): </b>
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 10%" class="text-center">S. No.</th>
                    <th style="width: 30%" class="text-center">Particulars</th>
                    <th style="width: 10%" class="text-center">Total (A)</th>
                    <th style="width: 10%" class="text-center" colspan="2">Male (B)</th>
                    <th style="width: 10%" class="text-center" colspan="2">Female (C)</th>
                </tr>
                <tr class="text-center table-success">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>No. (B)</th>
                    <th>% (B / A)</th>
                    <th>No. (C)</th>
                    <th>% (C / A)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $a = 16;
                    $x = 1;
                @endphp
                @foreach ($employees_quesMast->where('question_section', 'Section A - Employment') as $key => $emp)
                <tr>
                    <!-- If it's a heading, don't display S. No. and merge columns -->
                    @if($emp->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp->question}}
                        </td>
                    @else
                        <!-- Display S. No. for non-heading rows -->
                        <td class="text-center">{{ $x }}</td>
                        <td style="font-size: 1rem;">
                            {{$emp->question}}
                           
                                <input type="hidden" value="{{ $emp->id }}" name="emp[{{ $a }}][ques_id]">
                           
                        </td>

                        <!-- Total (A) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$a}}" name="emp[{{ $a }}][total]" id="totalemp_{{$a}}" 
                                onkeyup="calculatePercentages({{ $a }})"  required
                                @if(in_array($emp->id, [17,18,19,21,22,23, 25,26,27,29,30,31])) readonly @endif>
                        </td>

                        <!-- Male (B) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][emp_male]" id="emp_male_{{$a}}"  
                                oninput="calculatePercentages({{ $a }})" required
                                @if(in_array($emp->id, [19, 23, 27, 31])) readonly @endif>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="male_percent_{{$a}}" class="form-control form-control-sm" readonly>
                        </td>
                        
                        <!-- Female (C) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 120px;" min="0" class="form-control form-control-sm emp_{{$a}} f_emp" name="emp[{{ $a }}][emp_female]" id="emp_female_{{$a}}" 
                                oninput="calculatePercentages({{ $a }})" required
                                @if(in_array($emp->id, [19, 23, 27, 31])) readonly @endif>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 120px;" id="female_percent_{{$a}}" class="form-control form-control-sm" readonly>
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
<!-- Employees End -->

 
<!-- Participation/Inclusion/Representation of women - Start -->
<div class="card card-success card-outline">
    <div class="card-header">
      <b><u>21. Participation/Inclusion/Representation of women</u></b><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                  
                    <th style="width: 30%" class="text-center"></th>
                    <th style="width: 10%" class="text-center">Total</th>
                    <th style="width: 10%" class="text-center" colspan="2">No. and percentage of Females</th>
                 
                </tr>
                <tr class="text-center table-success">
                    
                    <th></th>
                    <th>(A)</th>
                    <th>No. (B)</th>
                    <th>% (B / A)</th>
                 
                </tr>
            </thead>
            <tbody>
                @php
                    $a = 32;
                    $x = 1;
                @endphp
                @foreach ($participation_quesMast->where('question_section', 'Section A - Participation') as $key => $emp)
                <tr>
                  
                    @if($emp->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp->question}}
                        </td>
                    @else
                       
                      <td style="font-size: 1rem;">
                            {{$emp->question}}
                             <input type="hidden" value="{{ $emp->id }}" name="emp[{{ $a }}][ques_id]">
                       </td>

                        <!-- Total (A) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 200px;" min="0" class="form-control form-control-sm emp_{{$a}} t_emp" name="emp[{{ $a }}][total_part]" id="total_part_{{$a}}" 
                                oninput="calculatePercentages_participation({{ $a }})" required>
                        </td>

                        <!-- Male (B) -->
                        <td class="text-center">
                            <input type="number" style="text-align: right; width: 200px;" min="0" class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][emp_part]" id="emp_part_{{$a}}"  
                                oninput="calculatePercentages_participation({{ $a }})" required>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align:left;width: 200px;" id="part_percent_{{$a}}" class="form-control form-control-sm" readonly>
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
<!--  Participation/Inclusion/Representation of women End -->

<!-- Turnover rate for permanent employees and workers Start -->
<div class="card card-success card-outline">
    <div class="card-header">
      <b><u>22. Turnover rate for permanent employees and workers Start</u></b><br /><br />
      <b><i>(Disclose trends for the past 3 years)</i></b>
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                  
                    <th style="width: 30%" class="text-center"></th>
                    <th style="width: 10%" class="text-center" colspan="3">FY {{ $current_fy }} (Turnover rate in current FY)</th>
                    <th style="width: 10%" class="text-center" colspan="3">FY {{ $previous_fy }} (Turnover rate in previous FY)</th>
                    <th style="width: 10%" class="text-center" colspan="3">FY {{ $prior_previous_fy }} (Turnover rate in the year prior to the previous FY)</th>
                </tr>
                <tr class="text-center table-success">
                    
                    <th></th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Total</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Total</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Total</th>
                 
                </tr>
            </thead>
            <tbody>
                @php
                    $a = 34;
                    $x = 1;
                @endphp
                    @foreach ($turnover_quesMast->where('question_section', 'Section A - Turnover') as $key => $emp)
                <tr>
                  
                    @if($emp->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp->question}}
                        </td>
                    @else
                       
                      <td style="font-size: 1rem;">
                            {{$emp->question}}
                             <input type="hidden" value="{{ $emp->id }}" name="emp[{{ $a }}][ques_id]">
                       </td>

                        <!--(Turnover rate in current FY) -->
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;" class="form-control form-control-sm emp_{{$a}} t_emp" name="emp[{{ $a }}][current_turnover_male]" id="current_turnover_male_{{$a}}" 
                                 required>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;"  class="form-control form-control-sm emp_{{$a}} t_emp" name="emp[{{ $a }}][current_turnover_female]" id="current_turnover_female_{{$a}}" 
                                required>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;" class="form-control form-control-sm emp_{{$a}} t_emp" name="emp[{{ $a }}][current_turnover_total]" id="current_turnover_total_{{$a}}" 
                                 required>
                        </td>

                        <!-- (Turnover rate in previous FY) -->
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;" class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][previous_turnover_male]" id="previous_turnover_male_{{$a}}"  
                             @if($a==34) value = "{{ $previous_turnover_male }}" @elseif($a==35)  value = "{{ $previous_turnover_male1 }}"  @endif  required>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;"  class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][previous_turnover_female]" id="previous_turnover_female_{{$a}}"  
                            @if($a==34) value = "{{ $previous_turnover_female }}" @elseif($a==35)  value = "{{ $previous_turnover_female1 }}" @endif  required>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;" class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][previous_turnover_total]" id="previous_turnover_total_{{$a}}"  
                              @if($a==34) value = "{{ $previous_turnover_total }}" @elseif($a==35)  value = "{{ $previous_turnover_total1 }}" @endif required>
                        </td>
 
                        <!-- (Turnover rate in prior to previous FY) -->
                         
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;" class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][priorprev_turnover_male]" id="priorprev_turnover_male_{{$a}}"  
                            @if($a==34) value = "{{ $prior_previous_turnover_male }}" @elseif($a==35)  value = "{{ $prior_previous_turnover_male1 }}"  @endif  required>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;" class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][priorprev_turnover_female]" id="priorprev_turnover_female_{{$a}}"  
                            @if($a==34) value = "{{ $prior_previous_turnover_female }}" @elseif($a==35)  value = "{{ $prior_previous_turnover_female1 }}" @endif required>
                        </td>
                        <td class="text-center">
                            <input type="text" style="text-align: left; width: 70px;"  class="form-control form-control-sm emp_{{$a}} m_emp" name="emp[{{ $a }}][priorprev_turnover_total]" id="priorprev_turnover_total_{{$a}}"  
                            @if($a==34) value = "{{ $prior_previous_turnover_total }}" @elseif($a==35)  value = "{{ $prior_previous_turnover_total1 }}" @endif required>
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
<!-- Turnover rate for permanent employees and workers Start End -->

 <!-- Holding, Subsidiary and Associate Companies (including joint ventures) - start -->
 <div class="card card-success card-outline mt-4">
          <div class="card-header">
                     <b><u>Holding, Subsidiary and Associate Companies (including joint ventures)</u></b><br/><br/>
                     <b> 23. (a) Names of holding / subsidiary / associate companies / joint ventures </b>
                   </div>
                    <div class="card-body p-3">
                    <table class="table table-bordered table-hover table-sm table-striped" id="holding_data_table">
                 <thead>
                   <tr class="text-center table-success">
                     <th style="width: 10%" class="text-center">S.No</th>
                     <th style="width: 30%" class="text-center">Name of the holding / subsidiary / associate companies / joint ventures (A) </th>
                     <th style="width: 30%" class="text-center">Indicate whether holding/ Subsidiary/Associate/ Joint Venture</th>  
                     <th style="width: 30%" class="text-center">% of shares held by listed entity</th>
                     <th style="width: 30%" class="text-center">Does the entity indicated at column A, participate in the Business Responsibility initiatives of the listed entity? (Yes/No)</th>
                     <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="holding_data_rows">
                 <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="holding[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="holding[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="holding[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="holding[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                 <td class="text-center">
                   <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                 </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn2"><i class="fas fa-plus"></i> Add Holding , Subsidiary and Associate Company</button>
        </div>
      </div>
       <!-- Holding, Subsidiary and Associate Companies (including joint ventures) Table -->

        <!-- CSR Applicable - Start -->
         <div class="card card-success card-outline mt-4">
            <div class="card-header">
             <b><u>CSR Details</u></b><br /><br />
             <b>24.  (i) Whether CSR is applicable as per section 135 of Companies Act, 2013: (Yes/No) </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="holdings[1][text_e]" placeholder="" rows="6" required></textarea>
            </div>
         </div>

         <div class="card card-success card-outline mt-4">
            <div class="card-header">
               <b> (ii) Turnover (in Rs.)</b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="holdings[1][text_f]" placeholder="" rows="6" required></textarea>
            </div>
         </div>

         <div class="card card-success card-outline mt-4">
            <div class="card-header">
                <b>(iii) Net worth (in Rs.)</b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="holdings[1][text_g]" placeholder="" rows="6" required></textarea>
            </div>
         </div>

        <!-- CSR Applicable - End -->


        <!-- Compliace Start -->
   <div class="card card-success card-outline">
    <div class="card-header">
      <b><u>Transparency and Disclosures Compliances</u></b><br /><br />
      <b>25. Complaints/Grievances on any of the principles (Principles 1 to 9) under the National Guidelines on Responsible Business Conduct:</b>
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Stakeholder group from whom complaint is received </th>
                    <th style="width: 30%" class="text-center">Grievance Redressal Mechanism in Place (Yes/No) (If Yes, then provide web-link for grievance redress policy)  </th>
                    <th style="width: 10%" class="text-center" colspan="3">FY {{ $current_fy }} Current Financial Year</th>
                    <th style="width: 10%" class="text-center" colspan="3">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
                <tr class="text-center table-success">
                    
                    <th></th>
                    <th></th>
                    <th>Number of complaints filed during the year </th>
                    <th>Number of complaints pending resolution at close of the year</th>
                    <th>Remarks</th>
                    <th>Number of complaints filed during the year</th>
                    <th>Number of complaints pending resolution at close of the year</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $a = 36;
                    $x = 1;
                @endphp
                @foreach ($compliance_quesMast->where('question_section', 'Section A - Compliace') as $key => $emp)
                <tr>
                  
                    @if($emp->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp->question}}
                        </td>
                    @else
                       
                      <td style="font-size: 1rem;">
                            {{$emp->question}}
                             <input type="hidden" value="{{ $emp->id }}" name="emp[{{ $a }}][ques_id]">
                       </td>

                       <td class="text-center">
                        <textarea style="text-align: left;  overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][grievance_redressal]" id="grievance_redressal_{{$a}}" oninput="autoResize(this)" required>{{ old('emp.' . $a . '.grievance_redressal') }}</textarea>
                        </td>

                        <td class="text-center">
                            <textarea style="text-align: left;   overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                              name="emp[{{ $a }}][current_fy_no_of_compliants]" id="current_fy_no_of_compliants_{{$a}}" oninput="autoResize(this)" required>{{ old('emp.' . $a . '.current_fy_no_of_compliants') }}</textarea>
                        </td>
                        <td class="text-center">
                            <textarea style="text-align: left;   overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                                 name="emp[{{ $a }}][current_no_of_pending_compliants]" id="current_no_of_pending_compliants_{{$a}}" oninput="autoResize(this)" required>{{ old('emp.' . $a . '.current_no_of_pending_compliants') }}</textarea>
                        </td>
                        <td class="text-center">
                           <textarea style="text-align: left;  overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                                 name="emp[{{ $a }}][current_fy_remarks]" id="current_fy_remarks_{{$a}}" oninput="autoResize(this)" required>{{ old('emp.' . $a . '.current_fy_remarks') }}</textarea>
                        </td>

                        <td class="text-center">
    <textarea 
        style="text-align: left;   overflow: hidden; resize: none;" 
        class="form-control form-control-sm emp_{{$a}} m_emp auto-grow" 
        name="emp[{{ $a }}][previous_fy_no_of_compliants]" 
        id="previous_fy_no_of_compliants_{{$a}}" 
        oninput="autoResize(this)" 
        required>
        @if($a==36) {{ $previous_fy_no_of_compliants }}
        @elseif($a==37) {{ $previous_fy_no_of_compliants1 }}
        @elseif($a==38) {{ $previous_fy_no_of_compliants2 }}
        @elseif($a==39) {{ $previous_fy_no_of_compliants3 }}
        @elseif($a==40) {{ $previous_fy_no_of_compliants4 }}
        @elseif($a==41) {{ $previous_fy_no_of_compliants5 }}
        @elseif($a==42) {{ $previous_fy_no_of_compliants6 }}
        @endif
    </textarea>
</td>

                  
                  <td class="text-center">
                    <textarea 
                   style="text-align: left;  overflow: hidden; resize: none;"  
        class="form-control form-control-sm emp_{{$a}} m_emp auto-grow" 
        name="emp[{{ $a }}][previous_no_of_pending_compliants]" 
        id="previous_no_of_pending_compliants_{{$a}}" 
        oninput="autoResize(this)" 
        required>@if($a==36){{ $previous_pending_compliants }}
@elseif ($a==37){{ $previous_pending_compliants1 }} 
@elseif ($a==38){{ $previous_pending_compliants2 }} 
@elseif ($a==39){{ $previous_pending_compliants3 }}
@elseif ($a==40){{ $previous_pending_compliants4 }}
@elseif ($a==41){{ $previous_pending_compliants5 }}
@elseif ($a==42){{ $previous_pending_compliants6 }}@endif</textarea>
</td>

<td class="text-center">
    <textarea 
        style="text-align: left;  overflow: hidden; resize: none;"  
        class="form-control form-control-sm emp_{{$a}} m_emp auto-grow" 
        name="emp[{{ $a }}][previous_fy_remarks]" 
        id="previous_fy_remarks_{{$a}}" 
        oninput="autoResize(this)" 
        required>@if($a==36){{ $previous_remarks }}
@elseif ($a==37){{ $previous_remarks1 }} 
@elseif ($a==38){{ $previous_remarks2 }} 
@elseif ($a==39){{ $previous_remarks3 }}
@elseif ($a==40){{ $previous_remarks4 }}
@elseif ($a==41){{ $previous_remarks5 }}
@elseif ($a==42){{ $previous_remarks6 }}@endif</textarea>
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
<!-- Compliace End -->


 <!-- Overview of the entity’s material responsible business conduct issues - start -->
 <div class="card card-success card-outline mt-4">
          <div class="card-header">
                    <b> 26. Overview of the entity’s material responsible business conduct issues </b><br /><br />
                    <b> Please indicate material responsible business conduct and sustainability issues pertaining to environmental and social matters that present a risk or an opportunity to your business,
                        rationale for identifying the same, approach to adapt or mitigate the risk along-with its financial implications, as per the following format </b>
                   </div>
                    <div class="card-body p-3">
                    <table class="table table-bordered table-hover table-sm table-striped" id="material_data_table">
                 <thead>
                   <tr class="text-center table-success">
                     <th style="width: 10%" class="text-center">S.No</th>
                     <th style="width: 30%" class="text-center">Material issue identified</th>
                     <th style="width: 30%" class="text-center">Indicate whether risk or opportunity (R/O)</th>  
                     <th style="width: 30%" class="text-center">Rationale for identifying the risk / opportunity</th>
                     <th style="width: 30%" class="text-center">In case of risk, approach to adapt or mitigate </th>
                     <th style="width: 30%" class="text-center">Financial implications of the risk or opportunity (Indicate positive or negative implications)</th>
                     <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="material_data_rows">
                 <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="material[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="material[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="material[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="material[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="material[1][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                 <td class="text-center">
                   <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                 </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn3"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>
       <!-- Overview of the entity’s material responsible business conduct issues Table end -->

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
                    <td class="text-center">${rowCount}</td>
                    <td><textarea class="form-control form-control-sm auto-grow" name="additional[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additional[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="additional[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                  
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            
            rowCount--;
            $('#additional_data_rows tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
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
                    <td class="text-center">${rowCount}</td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_d]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)" required></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_e]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_f]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)" required></textarea></td>
                  
                    
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row1"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows1').append(newRow);  
        });

        $(document).on('click', '.remove-row1', function() {
            $(this).closest('tr').remove();  
            
            rowCount--;
            $('#additional_data_rows1 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
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
                      <td><textarea class="form-control form-control-sm auto-grow" name="holding[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="holding[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="holding[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="holding[${rowCount}][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#holding_data_rows').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            
            rowCount--;
            $('#holding_data_rows tr').each(function(index) {
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
                    <td class="text-center">${rowCount}</td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="material[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="material[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="material[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="material[${rowCount}][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="material[${rowCount}][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)" required></textarea></td>  
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#material_data_rows').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#material_data_rows tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
        });
    });
</script>

<script>
    function calculateTotal(rowId) {
        const plants = parseFloat(document.querySelector(`input[name='operation[1][text_b]']`).value) || 0;
        const offices = parseFloat(document.querySelector(`input[name='operation[1][text_c]']`).value) || 0;
        const total = plants + offices;
        document.querySelector(`#total_${rowId}`).value = total;
    }

    function calculateTotals(rowId) {
        const plants = parseFloat(document.querySelector(`input[name='operation[1][text_f]']`).value) || 0;
        const offices = parseFloat(document.querySelector(`input[name='operation[1][text_g]']`).value) || 0;
        const total = plants + offices;
        document.querySelector(`#total_${rowId}`).value = total;
    }
</script>
 


<script>
     
    function calculatePercentages(rowIndex) {
        
        const maleCount = parseInt(document.querySelector(`.emp_${rowIndex}.m_emp`).value) || 0;
        const femaleCount = parseInt(document.querySelector(`.emp_${rowIndex}.f_emp`).value) || 0;
        const totalCount = maleCount + femaleCount;
        document.querySelector(`#totalemp_${rowIndex}`).value = totalCount;

        const malePercent = totalCount > 0 ? (maleCount / totalCount) * 100 : 0;
        document.querySelector(`#male_percent_${rowIndex}`).value = malePercent.toFixed(2) + '%';

        const femalePercent = totalCount > 0 ? (femaleCount / totalCount) * 100 : 0;
        document.querySelector(`#female_percent_${rowIndex}`).value = femalePercent.toFixed(2) + '%';

        if (rowIndex === 16 || rowIndex === 17) {
            updateTotalForRow3();
        } else if (rowIndex === 19 || rowIndex ===20) {
            updateTotalForRow4();
        } else if (rowIndex === 22 || rowIndex === 23) {
            updateTotalForRow5();
        } else if (rowIndex === 25 || rowIndex === 26) {
            updateTotalForRow6();
        }

    }
    
    function calculatePercentages_participation(rowIndex) {
        const femaleCount = parseInt(document.querySelector(`.emp_${rowIndex}.m_emp`).value) || 0;
        const totalCount = parseInt(document.querySelector(`.emp_${rowIndex}.t_emp`).value) || 0;
        const Percent = totalCount > 0 ? (femaleCount / totalCount) * 100 : 0;
        document.querySelector(`#part_percent_${rowIndex}`).value = Percent.toFixed(2) + '%';
    }
     
    function updateTotalForRow3() {
        
        const totalRow1 = parseInt(document.querySelector("#totalemp_16").value) || 0;
        const totalRow2 = parseInt(document.querySelector("#totalemp_17").value) || 0;
        const totalRow3 = totalRow1 + totalRow2;
        document.querySelector("#totalemp_18").value = totalRow3;

        const maleRow1 = parseInt(document.querySelector(".emp_16.m_emp").value) || 0;
        const femaleRow1 = parseInt(document.querySelector(".emp_16.f_emp").value) || 0;
        const maleRow2 = parseInt(document.querySelector(".emp_17.m_emp").value) || 0;
        const femaleRow2 = parseInt(document.querySelector(".emp_17.f_emp").value) || 0;

        const maleCount = maleRow1 + maleRow2;
        const femaleCount = femaleRow1 + femaleRow2;
        document.querySelector("#emp_male_18").value = maleCount;
        document.querySelector("#emp_female_18").value = femaleCount;

        const malePercent = totalRow3 > 0 ? (maleCount / totalRow3) * 100 : 0;
        const femalePercent = totalRow3 > 0 ? (femaleCount / totalRow3) * 100 : 0;

        document.querySelector("#male_percent_18").value = malePercent.toFixed(2) + '%';
        document.querySelector("#female_percent_18").value = femalePercent.toFixed(2) + '%';
    }

    function updateTotalForRow4() {
       
       const totalRow4 = parseInt(document.querySelector("#totalemp_19").value) || 0;
       const totalRow5 = parseInt(document.querySelector("#totalemp_20").value) || 0;
       const totalRow6 = totalRow4 + totalRow5;
       document.querySelector("#totalemp_21").value = totalRow6;

       const maleRow4 = parseInt(document.querySelector(".emp_19.m_emp").value) || 0;
       const femaleRow4 = parseInt(document.querySelector(".emp_19.f_emp").value) || 0;
       const maleRow5 = parseInt(document.querySelector(".emp_20.m_emp").value) || 0;
       const femaleRow5 = parseInt(document.querySelector(".emp_20.f_emp").value) || 0;

       const maleCount1 = maleRow4 + maleRow5;
       const femaleCount1 = femaleRow4 + femaleRow5;
       document.querySelector("#emp_male_21").value = maleCount1;
       document.querySelector("#emp_female_21").value = femaleCount1;

       const malePercent1 = totalRow6 > 0 ? (maleCount1 / totalRow6) * 100 : 0;
       const femalePercent1 = totalRow6 > 0 ? (femaleCount1 / totalRow6) * 100 : 0;

       document.querySelector("#male_percent_21").value = malePercent1.toFixed(2) + '%';
       document.querySelector("#female_percent_21").value = femalePercent1.toFixed(2) + '%';
   }

   function updateTotalForRow5() {
       
       const totalRow7 = parseInt(document.querySelector("#totalemp_22").value) || 0;
       const totalRow8 = parseInt(document.querySelector("#totalemp_23").value) || 0;
       const totalRow9 = totalRow7 + totalRow8;
       document.querySelector("#totalemp_24").value = totalRow9;

       const maleRow7 = parseInt(document.querySelector(".emp_22.m_emp").value) || 0;
       const femaleRow7 = parseInt(document.querySelector(".emp_22.f_emp").value) || 0;
       const maleRow8 = parseInt(document.querySelector(".emp_23.m_emp").value) || 0;
       const femaleRow8 = parseInt(document.querySelector(".emp_23.f_emp").value) || 0;

       const maleCount2 = maleRow7 + maleRow8;
       const femaleCount2 = femaleRow7 + femaleRow8;
       document.querySelector("#emp_male_24").value = maleCount2;
       document.querySelector("#emp_female_24").value = femaleCount2;

       const malePercent2 = totalRow9 > 0 ? (maleCount2 / totalRow9) * 100 : 0;
       const femalePercent2 = totalRow9 > 0 ? (femaleCount2 / totalRow9) * 100 : 0;

       document.querySelector("#male_percent_24").value = malePercent2.toFixed(2) + '%';
       document.querySelector("#female_percent_24").value = femalePercent2.toFixed(2) + '%';
   }

   function updateTotalForRow6() {
       
       const totalRow10 = parseInt(document.querySelector("#totalemp_25").value) || 0;
       const totalRow11= parseInt(document.querySelector("#totalemp_26").value) || 0;
       const totalRow12 = totalRow10 + totalRow11;
       document.querySelector("#totalemp_27").value = totalRow12;

       const maleRow10 = parseInt(document.querySelector(".emp_25.m_emp").value) || 0;
       const femaleRow10 = parseInt(document.querySelector(".emp_25.f_emp").value) || 0;
       const maleRow11 = parseInt(document.querySelector(".emp_26.m_emp").value) || 0;
       const femaleRow11 = parseInt(document.querySelector(".emp_26.f_emp").value) || 0;

       const maleCount3 = maleRow10 + maleRow11;
       const femaleCount3 = femaleRow10 + femaleRow11;
       document.querySelector("#emp_male_27").value = maleCount3;
       document.querySelector("#emp_female_27").value = femaleCount3;

       const malePercent3 = totalRow12 > 0 ? (maleCount3 / totalRow12) * 100 : 0;
       const femalePercent3 = totalRow12 > 0 ? (femaleCount3 / totalRow12) * 100 : 0;

       document.querySelector("#male_percent_27").value = malePercent3.toFixed(2) + '%';
       document.querySelector("#female_percent_27").value = femalePercent3.toFixed(2) + '%';
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