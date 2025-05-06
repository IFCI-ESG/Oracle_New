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
                <form action="{{ route('user.brsr.sectionp2store') }}" id="social_store" role="form" method="post"
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
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 2) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b>PRINCIPLE 2 Businesses should provide goods and services in a manner that is sustainable and safe </b> <br /><br />
                                            <b>Essential Indicators</b> <br /><br />
                                            <b> 1. Percentage of R&D and capital expenditure (capex) investments in specific technologies to improve the environmental and social impacts of product and processes to total R&D
                                            and capex investments made by the entity, respectively. </b>
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
                                                        <th style="width: 20%" class="text-center">
                                                        Details of improvements in environmental and social impacts
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=1;
                                                    @endphp
                                                    @foreach ($capex_quesMast->where('question_section','expenditure') as $key => $segment)
                                                        <tr>
                                                           
                                                            <td style="font-size: 1rem;">
                                                                {{$segment->question}}
                                                                <input type="hidden" value="{{ $segment->id }}" name="segment[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment[{{ $b }}][capex_current_fy]" id="capex_current_fy _{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment[{{ $b }}][capex_previous_fy]" id="capex_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $b == 1 ? $previous_rnd : ($b == 2 ? $previous_capex : '') }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;"  name="segment[{{ $b }}][capex_details]" id="capex_details_{{$b}}" class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
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
              $b=3;
               @endphp
              @foreach ($entity_quesMast->where('question_section','entity') as $key => $segment2)
              <input type="hidden" value="{{ $segment2->id }}" name="segment2[{{ $b }}][ques_id]">
             <b>2. a. {{ $segment2->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment2[{{ $b }}][entity_procedure]" id="entity_procedure_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         
         <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=4;
               @endphp
              @foreach ($inputs_quesMast->where('question_section','inputs') as $key => $segment3)
              <input type="hidden" value="{{ $segment3->id }}" name="segment3[{{ $b }}][ques_id]">
             <b>b. {{ $segment3->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment3[{{ $b }}][input_percent]" id="input_percent_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=5;
               @endphp
              @foreach ($reclaim_quesMast->where('question_section','process') as $key => $segment4)
              <input type="hidden" value="{{ $segment4->id }}" name="segment4[{{ $b }}][ques_id]">
             <b>3. {{ $segment4->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment4[{{ $b }}][reclaim_product]" id="reclaim_product_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

         <div class="card card-success card-outline mt-4">
            <div class="card-header">
            @php
              $b=6;
               @endphp
              @foreach ($epr_quesMast->where('question_section','activity') as $key => $segment5)
              <input type="hidden" value="{{ $segment5->id }}" name="segment5[{{ $b }}][ques_id]">
             <b>4. {{ $segment5->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment5[{{ $b }}][epr]" id="epr_{{$b}}" placeholder="" rows="6"></textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
         </div>

        
         <div class="card card-success card-outline mt-4">
                         <div class="card-header">
                          <b> Leadership Indicators </b> <br /> <br />
                          <b>1. Has the entity conducted Life Cycle Perspective / Assessments (LCA) for any of its
products (for manufacturing industry) or for its services (for service industry)? If yes,
provide details in the following format? </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">NIC Code</th>
                      <th style="width: 30%" class="text-center">Name of Product /Service</th>
                      <th style="width: 30%" class="text-center">% of total Turnover contributed</th>
                      <th style="width: 30%" class="text-center">Boundary for which the Life Cycle Perspective / Assessment was conducted</th>
                      <th style="width: 30%" class="text-center">Whether conducted by independent external agency (Yes/No)</th>
                      <th style="width: 30%" class="text-center">Results communicated in public domain (Yes/No) If yes, provide the web-link. </th>
                     
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows1">
                <tr>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[1][text_f]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
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
                          <b> Leadership Indicators </b> <br /> <br />
                          <b>2. If there are any significant social or environmental concerns and/or risks arising from
production or disposal of your products / services, as identified in the Life Cycle
Perspective / Assessments (LCA) or through any other means, briefly describe the same
along-with action taken to mitigate the same. </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Name of Product / Service</th>
                      <th style="width: 30%" class="text-center">Description of the risk / concern </th>
                      <th style="width: 30%" class="text-center">Action Taken</th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows2">
                <tr>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                
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
    <b> Leadership Indicators </b> <br /><br />
    <b>3. Percentage of recycled or reused input material to total material (by value) used in
      production (for manufacturing industry) or providing services (for service industry).</b>
  </div>
  <div class="card-body p-3">
    <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
      <thead>
        <tr class="text-center table-success">
          <th rowspan="2" style="width: 30%">Indicate input material</th>
          <th colspan="2" style="width: 60%">Recycled or re-used input material to total material</th>
          <th rowspan="2" style="width: 10%">Actions</th>
        </tr>
        <tr class="text-center table-success">
          <th style="width: 30%">FY  {{ $current_fy }} Current Financial Year</th>
          <th style="width: 30%">FY  {{ $previous_fy }} Previous Financial Year</th>
        </tr>
      </thead>
      <tbody id="additional_data_rows3">
        <tr>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_a]" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_b]" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td>
            <textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_c]" style="overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea>
          </td>
          <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
    <button type="button" class="btn btn-success btn-sm" id="add_row_btn3"><i class="fas fa-plus"></i> Add</button>
   </div>
  </div>

  
  <div class="card card-success card-outline">
    <div class="card-header">
      <b>4. Of the products and packaging reclaimed at end of life of products, amount (in metric
      tonnes) reused, recycled, and safely disposed, as per the following format: </b><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                  
                    <th style="width: 20%" class="text-center"></th>
                    <th style="width: 20%" class="text-center" colspan="3">FY {{ $current_fy }} Current Financial Year</th>
                    <th style="width: 20%" class="text-center" colspan="3">FY {{ $previous_fy }} Previous Financial Year</th>
                </tr>
                <tr class="text-center table-success">
                    
                    <th></th>
                    <th>Re-Used</th>
                    <th>Recycled</th>
                    <th>Safely Disposed</th>
                    <th>Re-Used</th>
                    <th>Recycled</th>
                    <th>Safely Disposed</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $b = 7;
                @endphp
                @foreach ($rrr_quesMast->where('question_section','rrr') as $key => $segment6)
                <tr>
                       <td style="font-size: 1rem;">
                            {{$segment6->question}}
                         <input type="hidden" value="{{ $segment6->id }}" name="segment6[{{ $b }}][ques_id]">
                       </td>
                       <td>
                         <textarea style="text-align: left;" name="segment6[{{ $b }}][reuse_current_fy]" id="reuse_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                       </td>

                       <td>
                         <textarea style="text-align: left;" name="segment6[{{ $b }}][recycle_current_fy]" id="recycle_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                       </td>

                       <td>
                         <textarea style="text-align: left;" name="segment6[{{ $b }}][disposed_current_fy]" id="disposed_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)"></textarea>
                       </td>
                        <td>
                        
  <textarea 
    style="text-align: left;  overflow: hidden; resize: none;" 
    name="segment6[{{ $b }}][reuse_previous_fy]" 
    id="reuse_previous_fy_{{$b}}"  
    class="form-control form-control-sm auto-grow"  
    oninput="autoResize(this)">
{{ 
  $b == 7 ? $prev_plastic_reuse : 
  ($b == 8 ? $prev_ewaste_reuse : 
  ($b == 9 ? $prev_haz_reuse : ''))
}}
  </textarea>
</td>
<td>
  <textarea 
    style="text-align: left; overflow: hidden; resize: none;" 
    name="segment6[{{ $b }}][recycle_previous_fy]" 
    id="recycle_previous_fy_{{$b}}"  
    class="form-control form-control-sm auto-grow"  
    oninput="autoResize(this)">
{{ 
  $b == 7 ? $prev_plastic_recycle : 
  ($b == 8 ? $prev_ewaste_recycle : 
  ($b == 9 ? $prev_haz_recycle : ''))
}}
  </textarea>
</td>
<td>
  <textarea 
    style="text-align: left;overflow: hidden; resize: none;" 
    name="segment6[{{ $b }}][disposed_previous_fy]" 
    id="disposed_previous_fy_{{$b}}"  
    class="form-control form-control-sm auto-grow"  
    oninput="autoResize(this)">
{{ 
  $b == 7 ? $prev_plastic_dispose : 
  ($b == 8 ? $prev_ewaste_dispose : 
  ($b == 9 ? $prev_haz_dispose : ''))
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
                         <b>5. Reclaimed products and their packaging materials (as percentage of products sold) for
                         each product category. </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Indicate product category</th>
                      <th style="width: 30%" class="text-center">Reclaimed products and their packaging materials as % of total products sold in respective category</th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows4">
                <tr>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                   <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                   </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn4"><i class="fas fa-plus"></i> Add</button>
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
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                      <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals[${rowCount}][text_f]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
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
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals1[${rowCount}][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
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
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
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
         ] <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows4').append(newRow);  
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