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
                <form action="{{ route('user.brsr.sectionbstore') }}" id="social_store" role="form" method="post"
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
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section B (Management and Process Disclosures) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                   
                    <!-- Disclosure Questions Start -->
                <div class="card card-success card-outline">
                <div class="card-header">
                 <b><u>Policy and management processes</u></b><br /><br />
                </div>
        <div class="card-body p-3">
       <div style="max-height: 150vh; overflow: auto;">
         <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 3%" class="text-center">Disclosure Questions</th>
                    <th style="width: 10%" class="text-center">P1</th>
                    <th style="width: 10%" class="text-center">P2</th>
                    <th style="width: 10%" class="text-center">P3</th>
                    <th style="width: 10%" class="text-center">P4</th>
                    <th style="width: 10%" class="text-center">P5</th>
                    <th style="width: 10%" class="text-center">P6</th>
                    <th style="width: 10%" class="text-center">P7</th>
                    <th style="width: 10%" class="text-center">P8</th>
                    <th style="width: 10%" class="text-center">P9</th>
                  
                </tr>
               
            </thead>
            <tbody>
                @php
                    $a = 1;
                    $x = 1;
                @endphp
                @foreach ($policy_quesMast->where('question_section', 'SectionBPolicy') as $key => $emp)
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
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p1]" id="policy_p1_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p1') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p2]" id="policy_p2_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p2') }}</textarea>
                        </td>
                        
                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p3]" id="policy_p3_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p3') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p4]" id="policy_p4_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p4') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p5]" id="policy_p5_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p5') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p6]" id="policy_p6_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p6') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p7]" id="policy_p7_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p7') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p8]" id="policy_p8_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p8') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p9]" id="policy_p9_{{$a}}" oninput="autoResize(this)" >{{ old('emp.' . $a . '.policy_p9') }}</textarea>
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
</div>
<!-- Disclosure Question End -->

<!-- Governance Question Start -->
<div class="card card-success card-outline mt-4">
    <div class="card-header">
      <b>7. Statement by director responsible for the business responsibility report, highlighting ESG related challenges, targets and achievements (listed entity has flexibility regarding the
      placement of this disclosure)</b>
    </div>
    <div class="card-body p-1">
        <textarea class="form-control form-control-sm" name="governance[1][text_a]" rows="6"></textarea>
    </div>
</div>

<div class="card card-success card-outline mt-4">
    <div class="card-header">
      <b>8. Details of the highest authority responsible for implementation and oversight of the Business Responsibility policy (ies)</b>
    </div>
    <div class="card-body p-1">
        <textarea class="form-control form-control-sm" name="governance[1][text_b]" rows="6"></textarea>
    </div>
</div>

<div class="card card-success card-outline mt-4">
    <div class="card-header">
      <b>9. Does the entity have a specified Committee of the Board/ Director responsible for decision making on sustainability related issues? (Yes / No). If
yes, provide details.</b>
    </div>
    <div class="card-body p-1">
        <textarea class="form-control form-control-sm" name="governance[1][text_c]" rows="6"></textarea>
    </div>
</div>
<!-- Governance Question End -->

  <!-- Review of NGRBCs Start -->
<div class="card card-success card-outline">
    <div class="card-header">
        <b><u>10. Details of Review of NGRBCs by the Company:</u></b><br /><br />
    </div>
    <div class="card-body p-3">
        <!-- Horizontal scroll container -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm table-striped text-center align-middle">
                <thead>
                    <tr class="table-success">
                        <th rowspan="2" style="width: 10%;">Subject for Review</th>
                        <th colspan="9">Indicate whether review was undertaken by Director / Committee of the Board / Any other Committee</th>
                        <th colspan="9">Frequency (Annually/ Half yearly/ Quarterly/ Any other – please specify)</th>
                    </tr>
                    <tr class="table-success">
                        <th>P1</th>
                        <th>P2</th>
                        <th>P3</th>
                        <th>P4</th>
                        <th>P5</th>
                        <th>P6</th>
                        <th>P7</th>
                        <th>P8</th>
                        <th>P9</th>
                        <th>P1</th>
                        <th>P2</th>
                        <th>P3</th>
                        <th>P4</th>
                        <th>P5</th>
                        <th>P6</th>
                        <th>P7</th>
                        <th>P8</th>
                        <th>P9</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $a = 1;
                    @endphp
                    @foreach ($ngrbc_quesMast->where('question_section', 'SectionBngrbc') as $emps)
                        @if($emps->question_type == 'heading')
                            <tr>
                                <td colspan="19" class="text-center fw-bold bg-light">
                                    {{ $emps->question }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="text-start">
                                    {{ $emps->question }}
                                    <input type="hidden" name="emps[{{ $a }}][ques_id]" value="{{ $emps->id }}">
                                </td>

                                {{-- Review Fields P1 to P9 --}}
                                <td><textarea name="emps[{{ $a }}][review_p1]" id="review_p1_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p1') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p2]" id="review_p2_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p2') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p3]" id="review_p3_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p3') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p4]" id="review_p4_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p4') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p5]" id="review_p5_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p5') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p6]" id="review_p6_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p6') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p7]" id="review_p7_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p7') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p8]" id="review_p8_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p8') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][review_p9]" id="review_p9_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.review_p9') }}</textarea></td>

                                {{-- Frequency Fields P1 to P9 --}}
                                <td><textarea name="emps[{{ $a }}][frequency_p1]" id="frequency_p1_{{$a}}" class="form-control form-control-sm auto-grow"  style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p1') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p2]" id="frequency_p2_{{$a}}" class="form-control form-control-sm auto-grow"  style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p2') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p3]" id="frequency_p3_{{$a}}" class="form-control form-control-sm auto-grow"  style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p3') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p4]" id="frequency_p4_{{$a}}" class="form-control form-control-sm auto-grow"  style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p4') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p5]" id="frequency_p5_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p5') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p6]" id="frequency_p6_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p6') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p7]" id="frequency_p7_{{$a}}" class="form-control form-control-sm auto-grow"  style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p7') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p8]" id="frequency_p8_{{$a}}" class="form-control form-control-sm auto-grow" style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p8') }}</textarea></td>
                                <td><textarea name="emps[{{ $a }}][frequency_p9]" id="frequency_p9_{{$a}}" class="form-control form-control-sm auto-grow"  style="text-align: left; width: 45px; overflow:hidden; resize: none;" oninput="autoResize(this)">{{ old('emps.' . $a . '.frequency_p9') }}</textarea></td>
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
        </div> <!-- /.table-responsive -->
    </div>
</div>
<!-- Review of NGRBCs End -->


    <!-- Entity Assessment Questions Start -->
    <div class="card card-success card-outline">
                <div class="card-header">
 
                </div>
        <div class="card-body p-3">
       <div style="max-height: 150vh; overflow: auto;">
         <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 3%" class="text-center"></th>
                    <th style="width: 10%" class="text-center">P1</th>
                    <th style="width: 10%" class="text-center">P2</th>
                    <th style="width: 10%" class="text-center">P3</th>
                    <th style="width: 10%" class="text-center">P4</th>
                    <th style="width: 10%" class="text-center">P5</th>
                    <th style="width: 10%" class="text-center">P6</th>
                    <th style="width: 10%" class="text-center">P7</th>
                    <th style="width: 10%" class="text-center">P8</th>
                    <th style="width: 10%" class="text-center">P9</th>
                  
                </tr>
               
            </thead>
            <tbody>
                @php
                    $a = 1;
                    $x = 1;
                @endphp
                @foreach ($entity_quesMast->where('question_section', 'SectionBentity') as $key => $emp1)
                <tr>
                    @if($emp1->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp1->question}}
                        </td>
                    @else
                       
                      <td style="font-size: 1rem;">
                            {{$emp1->question}}
                             <input type="hidden" value="{{ $emp1->id }}" name="emp1[{{ $a }}][ques_id]">
                       </td>

                       <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p1]" id="policy_p1_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p1') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p2]" id="policy_p2_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p2') }}</textarea>
                        </td>
                        
                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p3]" id="policy_p3_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p3') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p4]" id="policy_p4_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p4') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p5]" id="policy_p5_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p5') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p6]" id="policy_p6_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p6') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p7]" id="policy_p7_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p7') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p8]" id="policy_p8_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p8') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp1[{{ $a }}][policy_p9]" id="policy_p9_{{$a}}" oninput="autoResize(this)" >{{ old('emp1.' . $a . '.policy_p9') }}</textarea>
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
</div>
<!-- Entity Assessment Question End -->


  <!-- No State Questions Start -->
  <div class="card card-success card-outline">
                <div class="card-header">
                 <b><u>12. If answer to question (1) above is “No” i.e. not all Principles are covered by a policy,
                 reasons to be stated:</u></b><br /><br />
                </div>
        <div class="card-body p-3">
       <div style="max-height: 150vh; overflow: auto;">
         <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 3%" class="text-center">Questions</th>
                    <th style="width: 10%" class="text-center">P1</th>
                    <th style="width: 10%" class="text-center">P2</th>
                    <th style="width: 10%" class="text-center">P3</th>
                    <th style="width: 10%" class="text-center">P4</th>
                    <th style="width: 10%" class="text-center">P5</th>
                    <th style="width: 10%" class="text-center">P6</th>
                    <th style="width: 10%" class="text-center">P7</th>
                    <th style="width: 10%" class="text-center">P8</th>
                    <th style="width: 10%" class="text-center">P9</th>
                  
                </tr>
               
            </thead>
            <tbody>
                @php
                    $a = 1;
                    $x = 1;
                @endphp
                @foreach ($state_quesMast->where('question_section', 'SectionBstate') as $key => $emp2)
                <tr>
                    @if($emp2->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp2->question}}
                        </td>
                    @else
                       
                      <td style="font-size: 1rem;">
                            {{$emp2->question}}
                             <input type="hidden" value="{{ $emp2->id }}" name="emp2[{{ $a }}][ques_id]">
                       </td>

                       <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p1]" id="policy_p1_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p1') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p2]" id="policy_p2_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p2') }}</textarea>
                        </td>
                        
                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p3]" id="policy_p3_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p3') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p4]" id="policy_p4_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p4') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p5]" id="policy_p5_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p5') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p6]" id="policy_p6_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p6') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p7]" id="policy_p7_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p7') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p8]" id="policy_p8_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p8') }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp2[{{ $a }}][policy_p9]" id="policy_p9_{{$a}}" oninput="autoResize(this)" >{{ old('emp2.' . $a . '.policy_p9') }}</textarea>
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
</div>
<!-- No State Question End -->


  

 
 
 

 

 
 
       


  
 

 
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