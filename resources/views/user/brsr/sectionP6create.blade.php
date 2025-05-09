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
                <form action="{{ route('user.brsr.sectionp6store') }}" id="social_store" role="form" method="post"
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
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 6) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                
     <!-- Total Energy - Start -->
      <div class="card card-success card-outline">
       <div class="card-header">
        <b>PRINCIPLE 6  Businesses should respect and make efforts to protect and restore the environment </b> <br /><br />
        <b>Essential Indicators</b> <br /><br />
        <b>1. Details of total energy consumption (in Joules or multiples) and energy intensity, in the following format: </b><br /><br />
       
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 1;
                    $x = 1;
                @endphp
                @foreach ($ques1->where('question_section', 'tot_energy') as $key => $tot)
                <tr>
                  
                    @if($tot->question_type == 'heading')
                        <td colspan="8" class="text-left" style="font-size: 1rem; font-weight: bold;">
                            {{$tot->question}}
                        </td>
                    @else
                       
                        <td style="font-size: 1rem;">
                            {{$tot->question}}
                             <input type="hidden" value="{{ $tot->id }}" name="tot[{{ $b }}][ques_id]">
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm tot_{{$b}}" name="tot[{{ $b }}][tot_energy_current_fy]" id="tot_energy_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any" @if(in_array($tot->id, [5,10,11])) readonly @endif>
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm tot_{{$b}} m_emp" name="tot[{{ $b }}][tot_energy_previous_fy]" id="tot_energy_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any" @if(in_array($tot->id, [5,10,11])) readonly @endif>
                        </td>

                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an 
        external agency? (Y/N) If yes, name of the external agency. </p>
    </div>
</div>
<!-- Total Energy End -->

<div class="card card-success card-outline mt-4">
    <div class="card-header">
      @php
        $b=14;
      @endphp
      @foreach ($ques2->where('question_section','entity_sites') as $key => $value1)
        <input type="hidden" value="{{ $value1->id }}" name="value1[{{ $b }}][ques_id]">
         <b>2. {{ $value1->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value1[{{ $b }}][entity_sites]" id="entity_sites_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
 </div>

 <div class="card card-success card-outline">
       <div class="card-header">
        <b>3. Provide details of the following disclosures related to water, in the following format: </b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 15;
                    $x = 1;
                @endphp
                @foreach ($ques3->where('question_section', 'disclosure') as $key => $value2)
                <tr>
                  
                    @if($value2->question_type == 'heading')
                        <td colspan="8" class="text-left" style="font-size: 1rem; font-weight: bold;">
                            {{$value2->question}}
                        </td>
                    @else
                       
                        <td style="font-size: 1rem;">
                            {{$value2->question}}
                             <input type="hidden" value="{{ $value2->id }}" name="value2[{{ $b }}][ques_id]">
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm value2_{{$b}}" name="value2[{{ $b }}][disclosure_current_fy]" id="disclosure_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any"  @if(in_array($value2->id, [23])) readonly @endif>
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm value2_{{$b}} m_emp" name="value2[{{ $b }}][disclosure_previous_fy]" id="disclosure_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any"  @if(in_array($value2->id, [23])) readonly @endif>
                        </td>

                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an external agency? (Y/N) If yes, name of the external agency. </p>
    </div>
</div>

<div class="card card-success card-outline">
       <div class="card-header">
        <b>4. Provide the following details related to water discharged: </b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 26;
                    $x = 1;
                @endphp
                @foreach ($ques4->where('question_section', 'water_discharge') as $key => $value3)
                <tr>
                  
                    @if($value3->question_type == 'heading')
                        <td colspan="8" class="text-left" style="font-size: 1rem; font-weight: bold;">
                            {{$value3->question}}
                        </td>
                    @else
                        <td style="font-size: 1rem;">
                            {{$value3->question}}
                             <input type="hidden" value="{{ $value3->id }}" name="value3[{{ $b }}][ques_id]">
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm value3_{{$b}}" name="value3[{{ $b }}][water_discharge_current_fy]" id="water_discharge_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any">
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm value3_{{$b}} m_emp" name="value3[{{ $b }}][water_discharge_previous_fy]" id="water_discharge_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any">
                        </td>

                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an external agency? (Y/N) If yes, name of the external agency </p>
    </div>
</div>


<div class="card card-success card-outline mt-4">
    <div class="card-header">
      @php
        $b=42;
      @endphp
      @foreach ($ques5->where('question_section','zero_liquid') as $key => $value4)
        <input type="hidden" value="{{ $value4->id }}" name="value4[{{ $b }}][ques_id]">
         <b>5. {{ $value4->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value4[{{ $b }}][zero_liquid]" id="zero_liquid_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
 </div>

 <div class="card card-success card-outline">
       <div class="card-header">
        <b>6. Please provide details of air emissions (other than GHG emissions) by the entity, in the following format: </b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                    <th style="width: 10%" class="text-center">Please specify unit</th>
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 43;
                    $x = 1;
                @endphp
                @foreach ($ques6->where('question_section', 'ghg_emission') as $key => $value5)
                <tr>
                  
                    @if($value5->question_type == 'heading')
                        <td colspan="8" class="text-left" style="font-size: 1rem; font-weight: bold;">
                            {{$value5->question}}
                        </td>
                    @else
                        <td style="font-size: 1rem;">
                            {{$value5->question}}
                             <input type="hidden" value="{{ $value5->id }}" name="value5[{{ $b }}][ques_id]">
                        </td>

                        <td>
                          <textarea style="text-align: left;" name="value5[{{ $b }}][air_emission_unit]" id="air_emission_unit_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm value5_{{$b}}" name="value5[{{ $b }}][air_emission_current_fy]" id="air_emission_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any">
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm value5_{{$b}} m_emp" name="value5[{{ $b }}][air_emission_previous_fy]" id="air_emission_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any">
                        </td>

                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an external agency? (Y/N) If yes, name of the external agency.</p>
    </div>
</div>


<div class="card card-success card-outline">
       <div class="card-header">
        <b>7. Provide details of greenhouse gas emissions (Scope 1 and Scope 2 emissions) & its intensity, in the following format </b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                    <th style="width: 10%" class="text-center">Unit</th>
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 50;
                    $x = 1;
                @endphp
                @foreach ($ques7->where('question_section', 'ghg_emission_scope') as $key => $value6)
                <tr>
                  
                    @if($value6->question_type == 'heading')
                        <td colspan="8" class="text-left" style="font-size: 1rem; font-weight: bold;">
                            {{$value6->question}}
                        </td>
                    @else
                        <td style="font-size: 1rem;">
                            {{$value6->question}}
                             <input type="hidden" value="{{ $value6->id }}" name="value6[{{ $b }}][ques_id]">
                        </td>

                        <td>
                          <textarea style="text-align: left;" name="value6[{{ $b }}][gas_emission_unit]" id="gas_emission_unit_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm value6_{{$b}}" name="value6[{{ $b }}][gas_emission_current_fy]" id="gas_emission_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any">
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm value6_{{$b}} m_emp" name="value6[{{ $b }}][gas_emission_previous_fy]" id="gas_emission_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any">
                        </td>

                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an external agency? (Y/N) If yes, name of the external agency</p>
    </div>
</div>

<div class="card card-success card-outline mt-4">
    <div class="card-header">
      @php
        $b=56;
      @endphp
      @foreach ($ques8->where('question_section','ghg_reduce') as $key => $value7)
        <input type="hidden" value="{{ $value7->id }}" name="value7[{{ $b }}][ques_id]">
         <b>8. {{ $value7->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value7[{{ $b }}][ghg_emission]" id="ghg_emission_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
 </div>

 <div class="card card-success card-outline">
       <div class="card-header">
        <b>9. Provide details related to waste management by the entity, in the following format: </b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                  
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 57;
                    $x = 1;
                @endphp
                @foreach ($ques9->where('question_section', 'waste_manage_entity') as $key => $value8)
                <tr>
                  
                    @if($value8->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$value8->question}}
                        </td>
                    @else
                        <td style="font-size: 1rem;">
                            {{$value8->question}}
                             <input type="hidden" value="{{ $value8->id }}" name="value8[{{ $b }}][ques_id]">
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm value8_{{$b}}" name="value8[{{ $b }}][waste_management_current_fy]" id="waste_management_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any"   @if(in_array($value8->id, [69,79,85])) readonly @endif>
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm value8_{{$b}} m_emp" name="value8[{{ $b }}][waste_management_previous_fy]" id="waste_management_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any"   @if(in_array($value8->id, [69,79,85])) readonly @endif>
                        </td>

                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an external agency? (Y/N) If yes, name of the external agency</p>
    </div>
</div>

<div class="card card-success card-outline mt-4">
    <div class="card-header">
      @php
        $b=78;
      @endphp
      @foreach ($ques10->where('question_section','toxic_usage') as $key => $value9)
        <input type="hidden" value="{{ $value9->id }}" name="value9[{{ $b }}][ques_id]">
         <b>10. {{ $value9->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value9[{{ $b }}][waste_management_practices]" id="waste_management_practices_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
 </div>

 <div class="card card-success card-outline mt-4">
         <div class="card-header">
             <b>11. If the entity has operations/offices in/around ecologically sensitive areas (such as national 
                parks, wildlife sanctuaries, biosphere reserves, wetlands, biodiversity hotspots, forests, 
                coastal regulation zones etc.) where environmental approvals / clearances are required, please specify details in the following format: </b>
          </div>
            <div class="card-body p-3">
               <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                 <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Location of operations/offices</th>
                      <th style="width: 30%" class="text-center">Type of operations</th>
                      <th style="width: 30%" class="text-center">Whether the conditions of environmental approval / clearance are being complied with? (Y/N) If no, the reasons thereof and corrective action taken, if any.</th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows1">
                <tr>
                  <td class="text-center">1</td>
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
             <b>12. Details of environmental impact assessments of projects undertaken by the entity based on applicable laws, in the current financial year:</b>
          </div>
            <div class="card-body p-3">
               <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                 <thead>
                      <tr class="text-center table-success">
                       <th style="width: 30%" class="text-center">Name and brief details of project</th>
                       <th style="width: 30%" class="text-center">EIA Notification No.</th>
                       <th style="width: 30%" class="text-center">Date</th>
                       <th style="width: 30%" class="text-center">Whether conducted by independent external agency (Yes / No)</th>
                       <th style="width: 30%" class="text-center">Results communicated in public domain (Yes / No) </th>
                       <th style="width: 30%" class="text-center">Relevant Web link</th>
                       <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows2">
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
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn2"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>
       
      <div class="card card-success card-outline mt-4">
         <div class="card-header">
             <b>13. Is the entity compliant with the applicable environmental law/ regulations/ guidelines in 
                India; such as the Water (Prevention and Control of Pollution) Act, Air (Prevention and 
                Control of Pollution) Act, Environment protection act and rules thereunder (Y/N). If not, 
                provide details of all such non-compliances, in the following format: </b>
          </div>
            <div class="card-body p-3">
               <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                 <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Specify the law / regulation / guidelines which was not complied with </th>
                      <th style="width: 30%" class="text-center">Provide details of the non-compliance</th>
                      <th style="width: 30%" class="text-center">Any fines / penalties / action taken by regulatory agencies such as pollution control boards or by courts</th>
                      <th style="width: 30%" class="text-center">Corrective action taken, if any</th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows3">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
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
      <b>Leadership Indicators</b> <br /><br />
      @php
        $b=79;
      @endphp
      @foreach ($ques11->where('question_section','area_operations') as $key => $value10)
        <input type="hidden" value="{{ $value10->id }}" name="value10[{{ $b }}][ques_id]">
         <b>1. {{ $value10->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value10[{{ $b }}][area_water_stress]" id="area_water_stress_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
  </div>

 <div class="card card-success card-outline">
       <div class="card-header">
        <b>(iii) Water withdrawal, consumption and discharge in the following format</b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 80;
                    $x = 1;
                @endphp
                @foreach ($ques12->where('question_section', 'water_withdrawal') as $key => $value11)
                <tr>
                  
                    @if($value11->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$value11->question}}
                        </td>
                    @else
                        <td style="font-size: 1rem;">
                            {{$value11->question}}
                             <input type="hidden" value="{{ $value11->id }}" name="value11[{{ $b }}][ques_id]">
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm value11_{{$b}}" name="value11[{{ $b }}][consumption_current_fy]" id="consumption_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any">
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm value11_{{$b}} m_emp" name="value11[{{ $b }}][consumption_previous_fy]" id="consumption_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any">
                        </td>
                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an external agency? (Y/N) If yes, name of the external agency</p>
    </div>
 </div>

 <div class="card card-success card-outline">
       <div class="card-header">
        <b>2. Provide details of greenhouse gas emissions (Scope 1 and Scope 2 emissions) & its intensity, in the following format </b><br /><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 30%" class="text-center">Parameter</th>
                    <th style="width: 10%" class="text-center">Unit</th>
                    <th style="width: 10%" class="text-center">FY {{ $current_fy }} Current Financial Year </th>
                    <th style="width: 10%" class="text-center">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $b = 105;
                    $x = 1;
                @endphp
                @foreach ($ques13->where('question_section', 'scope3_emission') as $key => $value12)
                <tr>
                  
                    @if($value12->question_type == 'heading')
                        <td colspan="8" class="text-left" style="font-size: 1rem; font-weight: bold;">
                            {{$value12->question}}
                        </td>
                    @else
                        <td style="font-size: 1rem;">
                            {{$value12->question}}
                             <input type="hidden" value="{{ $value12->id }}" name="value12[{{ $b }}][ques_id]">
                        </td>

                        <td>
                          <textarea style="text-align: left;" name="value12[{{ $b }}][scope3_unit]" id="scope3_unit_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                        </td>

                        <td class="text-center">
                           <input type="number" class="form-control form-control-sm value12_{{$b}}" name="value12[{{ $b }}][scope3_current_fy]" id="scope3_current_fy_{{$b}}" 
                           style="text-align: right;" min="0" step="any">
                        </td>

                        <td class="text-center">
                          <input type="number" class="form-control form-control-sm value12_{{$b}} m_emp" name="value12[{{ $b }}][scope3_previous_fy]" id="scope3_previous_fy_{{$b}}" 
                          style="text-align: right;" min="0" step="any">
                        </td>

                    @php
                        $b++;
                    @endphp
                   
                  @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <p> Note: Indicate if any independent assessment/ evaluation/assurance has been carried out by an external agency? (Y/N) If yes, name of the external agency</p>
    </div>
</div>


<div class="card card-success card-outline mt-4">
     <div class="card-header">
      @php
        $b=108;
      @endphp
      @foreach ($ques14->where('question_section','direct_indirect_impact') as $key => $value13)
        <input type="hidden" value="{{ $value13->id }}" name="value13[{{ $b }}][ques_id]">
         <b>3. {{ $value13->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value13[{{ $b }}][direct_indirect_impact]" id="direct_indirect_impact_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
  </div>

  <div class="card card-success card-outline mt-4">
         <div class="card-header">
             <b>4. If the entity has undertaken any specific initiatives or used innovative technology or 
                   solutions to improve resource efficiency, or reduce impact due to emissions / effluent 
                   discharge / waste generated, please provide details of the same as well as outcome of such 
                   initiatives, as per the following format: </b>
          </div>
            <div class="card-body p-3">
               <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                 <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Initiative undertaken</th>
                      <th style="width: 30%" class="text-center">Details of the initiative (Web-link, if any, may be provided along-with summary) </th>
                      <th style="width: 30%" class="text-center">Outcome of the initiative </th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows4">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  
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
        $b=109;
      @endphp
      @foreach ($ques15->where('question_section','business_continuity') as $key => $value14)
        <input type="hidden" value="{{ $value14->id }}" name="value14[{{ $b }}][ques_id]">
         <b>5. {{ $value14->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value14[{{ $b }}][business_continuity]" id="business_continuity_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
  </div>

  
  <div class="card card-success card-outline mt-4">
     <div class="card-header">
      @php
        $b=110;
      @endphp
      @foreach ($ques16->where('question_section','adverse_impact') as $key => $value15)
        <input type="hidden" value="{{ $value15->id }}" name="value15[{{ $b }}][ques_id]">
         <b>6. {{ $value15->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value15[{{ $b }}][adverse_impact]" id="adverse_impact_{{$b}}" placeholder="" rows="6"></textarea>
        </div>
       @php
        $b++;
       @endphp
    @endforeach
  </div>
  
  <div class="card card-success card-outline mt-4">
     <div class="card-header">
      @php
        $b=111;
      @endphp
      @foreach ($ques17->where('question_section','env_impacts') as $key => $value16)
        <input type="hidden" value="{{ $value16->id }}" name="value16[{{ $b }}][ques_id]">
         <b>7. {{ $value16->question }} </b>
        </div>
        <div class="card-body p-1">
           <textarea class="form-control form-control-sm" name="value16[{{ $b }}][value_chain_partners]" id="value_chain_partners_{{$b}}" placeholder="" rows="6"></textarea>
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
        $('#add_row_btn1').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                    <td class="text-center">${rowCount}</td>
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
            $('#additional_data_rows2').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            
            
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
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_d]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows3').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows3 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
            
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
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
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
   function calculateEnergyBreakdown() {
     const renewableIndexes = [1, 2, 3];
     const nonRenewableIndexes = [5, 6, 7];
     let renewableCurr = 0, renewablePrev = 0;
     let nonRenewableCurr = 0, nonRenewablePrev = 0;
     renewableIndexes.forEach(i => {
        renewableCurr += parseFloat(document.getElementById(`tot_energy_current_fy_${i}`)?.value || 0);
        renewablePrev += parseFloat(document.getElementById(`tot_energy_previous_fy_${i}`)?.value || 0);
     });

    document.getElementById(`tot_energy_current_fy_4`).value = renewableCurr.toFixed(2);
    document.getElementById(`tot_energy_previous_fy_4`).value = renewablePrev.toFixed(2);
    nonRenewableIndexes.forEach(i => {
        nonRenewableCurr += parseFloat(document.getElementById(`tot_energy_current_fy_${i}`)?.value || 0);
        nonRenewablePrev += parseFloat(document.getElementById(`tot_energy_previous_fy_${i}`)?.value || 0);
    });

    document.getElementById(`tot_energy_current_fy_8`).value = nonRenewableCurr.toFixed(2);
    document.getElementById(`tot_energy_previous_fy_8`).value = nonRenewablePrev.toFixed(2);
    document.getElementById(`tot_energy_current_fy_9`).value = (renewableCurr + nonRenewableCurr).toFixed(2);
    document.getElementById(`tot_energy_previous_fy_9`).value = (renewablePrev + nonRenewablePrev).toFixed(2);
   }
    document.querySelectorAll('input[type="number"]').forEach(input => {
      input.addEventListener('input', calculateEnergyBreakdown);
    });
</script>

<script>
function calculateDisclosureTotal() {
    let currTotal = 0, prevTotal = 0;
    let currTotal1 = 0, prevTotal1 = 0;
    let currTotal2 = 0, prevTotal2 = 0;
    let currTotal3 = 0, prevTotal3 = 0;
    for (let i = 15; i <= 19; i++) {
        currTotal += parseFloat(document.getElementById(`disclosure_current_fy_${i}`)?.value || 0);
        prevTotal += parseFloat(document.getElementById(`disclosure_previous_fy_${i}`)?.value || 0);
    }
    const currTotalField = document.getElementById('disclosure_current_fy_20');
    const prevTotalField = document.getElementById('disclosure_previous_fy_20');
    if (currTotalField) currTotalField.value = currTotal.toFixed(2);
    if (prevTotalField) prevTotalField.value = prevTotal.toFixed(2);

   for (let i = 57; i <= 64; i++) {
        currTotal1 += parseFloat(document.getElementById(`waste_management_current_fy_${i}`)?.value || 0);
        prevTotal1 += parseFloat(document.getElementById(`waste_management_previous_fy_${i}`)?.value || 0);
    }
    const currTotalField1 = document.getElementById('waste_management_current_fy_65');
    const prevTotalField1 = document.getElementById('waste_management_previous_fy_65');
    if (currTotalField1) currTotalField1.value = currTotal1.toFixed(2);
    if (prevTotalField1) prevTotalField1.value = prevTotal1.toFixed(2);

    for (let i = 70; i <= 72; i++) {
        currTotal2 += parseFloat(document.getElementById(`waste_management_current_fy_${i}`)?.value || 0);
        prevTotal2 += parseFloat(document.getElementById(`waste_management_previous_fy_${i}`)?.value || 0);
    }
    const currTotalField2 = document.getElementById('waste_management_current_fy_73');
    const prevTotalField2 = document.getElementById('waste_management_previous_fy_73');
    if (currTotalField2) currTotalField2.value = currTotal2.toFixed(2);
    if (prevTotalField2) prevTotalField2.value = prevTotal2.toFixed(2);

    for (let i = 74; i <= 76; i++) {
        currTotal3 += parseFloat(document.getElementById(`waste_management_current_fy_${i}`)?.value || 0);
        prevTotal3 += parseFloat(document.getElementById(`waste_management_previous_fy_${i}`)?.value || 0);
    }
    const currTotalField3 = document.getElementById('waste_management_current_fy_77');
    const prevTotalField3 = document.getElementById('waste_management_previous_fy_77');
    if (currTotalField3) currTotalField3.value = currTotal3.toFixed(2);
    if (prevTotalField3) prevTotalField3.value = prevTotal3.toFixed(2);

}

for (let i = 15; i <= 19; i++) {
    document.getElementById(`disclosure_current_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
    document.getElementById(`disclosure_previous_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
}
for (let i = 57; i <= 64; i++) {
    document.getElementById(`waste_management_current_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
    document.getElementById(`waste_management_previous_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
}
for (let i = 70; i <= 72; i++) {
    document.getElementById(`waste_management_current_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
    document.getElementById(`waste_management_previous_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
}
for (let i = 74; i <= 76; i++) {
    document.getElementById(`waste_management_current_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
    document.getElementById(`waste_management_previous_fy_${i}`)?.addEventListener('input', calculateDisclosureTotal);
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