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
                <form action="{{ route('user.brsr.sectionp9update') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit'
                    accept-charset="utf-8">
                    @csrf
                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 9) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">
           
 

       <div class="card card-success card-outline mt-4">
            <div class="card-header">
              <b>PRINCIPLE 9 Businesses should engage with and provide value to their consumers in a responsible manner </b> <br /><br />
            <b>Essential Indicators</b> <br /><br />
             @php
              $b=1;
               @endphp
              @foreach ($principle9_ques1->where('question_section','complaints') as $key => $segment1)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment1->id)->first()->id }}" name="segment1[{{ $b }}][row_id]">
             <b>1. {{ $segment1->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment1[{{ $b }}][consumer_compliant]" id="consumer_compliant_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment1->id)->first()->consumer_compliant }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

         
         <div class="card card-success card-outline">
             <div class="card-header">
                <b> 2. Turnover of products and/ services as a percentage of turnover from all products/service 
                that carry information about:</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center">
 
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                          As a percentage to total turnover
                                                        </th>
                                                      
                                                     </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=2;
                                                    @endphp
                                                    @foreach ($principle9_ques2->where('question_section','total_turnover') as $key => $segment2)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$segment2->question}}
                                                                <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment2->id)->first()->id }}" name="segment2[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment2[{{ $b }}][turnover_percent]" id="turnover_percent_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment2->id)->first()->turnover_percent }}</textarea>
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
      <b>3. Number of consumer complaints in respect of the following:</b><br />
    </div>
    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
            <thead>
                <tr class="text-center table-success">
                  
                    <th style="width: 30%" class="text-center"></th>
                    <th style="width: 10%" class="text-center" colspan="2">FY {{ $current_fy }} Current Financial Year</th>
                    <th style="width: 10%" class="text-center">Remarks</th>
                    <th style="width: 10%" class="text-center" colspan="2">FY {{ $previous_fy }} Previous Financial Year</th>
                    <th style="width: 10%" class="text-center">Remarks</th>
                </tr>
                <tr class="text-center table-success">
                    
                    <th></th>
                    <th>Received during  the year</th>
                    <th>Pending resolution at end of year</th>
                    <th></th>
                    <th>Received during the year</th>
                    <th>Pending resolution at end of year</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $b = 5;
                @endphp
                @foreach ($principle9_ques3->where('question_section','cons_compliants') as $key => $segment3)
                <tr>
                       <td style="font-size: 1rem;">
                            {{$segment3->question}}
                            <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment3->id)->first()->id }}" name="segment3[{{ $b }}][row_id]">
                       </td>
                       <td>
                         <textarea style="text-align: left;" name="segment3[{{ $b }}][received_compliants_current_fy]" id="received_compliants_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment3->id)->first()->received_compliants_current_fy }}</textarea>
                       </td>

                       <td>
                         <textarea style="text-align: left;" name="segment3[{{ $b }}][pending_compliants_current_fy]" id="pending_compliants_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment3->id)->first()->pending_compliants_current_fy }}</textarea>
                       </td>

                       <td>
                         <textarea style="text-align: left;" name="segment3[{{ $b }}][remarks_current_fy]" id="remarks_current_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment3->id)->first()->remarks_current_fy}}</textarea>
                       </td>
                        <td>
                         <textarea style="text-align: left;" name="segment3[{{ $b }}][received_compliants_previous_fy]" id="received_compliants_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment3->id)->first()->received_compliants_previous_fy }}</textarea>
                       </td>
                       <td>
                         <textarea style="text-align: left;" name="segment3[{{ $b }}][pending_compliants_previous_fy]" id="pending_compliants_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment3->id)->first()->pending_compliants_previous_fy }}</textarea>
                       </td>
                        <td>
                         <textarea style="text-align: left;" name="segment3[{{ $b }}][remarks_previous_fy]" id="remarks_previous_fy_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment3->id)->first()->remarks_previous_fy }}</textarea>
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
                <b> 4. Details of instances of product recalls on account of safety issues:</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        
                                                        <th style="width: 10%" class="text-center"></th>
                                                        <th style="width: 20%" class="text-center">Number</th>
                                                        <th style="width: 20%" class="text-center">Reasons for recall</th>
                                                     </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=12;
                                                    @endphp
                                                    @foreach ($principle9_ques4->where('question_section','instance') as $key => $segment4)
                                                        <tr>
                                                            <td style="font-size: 1rem;">
                                                                {{$segment4->question}}
                                                                <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment4->id)->first()->id }}" name="segment4[{{ $b }}][row_id]">
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment4[{{ $b }}][instant_number]" id="instant_number_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment4->id)->first()->instant_number }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea style="text-align: left;" name="segment4[{{ $b }}][recall_reason]" id="recall_reason_{{$b}}"  class="form-control form-control-sm auto-grow"  oninput="autoResize(this)">{{ $principle9_value->where('ques_id',$segment4->id)->first()->recall_reason }}</textarea>
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
                 $b=14;
               @endphp
               @foreach ($principle9_ques5->where('question_section','web-link') as $key => $segment5)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment5->id)->first()->id }}" name="segment5[{{ $b }}][row_id]">
               <b>5. {{ $segment5->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment5[{{ $b }}][web_link]" id="web_link_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment5->id)->first()->web_link }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=15;
               @endphp
               @foreach ($principle9_ques6->where('question_section','actions') as $key => $segment6)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment6->id)->first()->id }}" name="segment6[{{ $b }}][row_id]">
               <b>6. {{ $segment6->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment6[{{ $b }}][corrective_actions]" id="corrective_actions_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment6->id)->first()->corrective_actions }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=16;
               @endphp
               @foreach ($principle9_ques7->where('question_section','no_breach') as $key => $segment7)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment7->id)->first()->id }}" name="segment7[{{ $b }}][row_id]">
                <b>7. Provide the following information relating to data breaches </b><br /><br />
                 <b>a. {{ $segment7->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment7[{{ $b }}][no_instances]" id="no_instances_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment7->id)->first()->no_instances }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>
        
        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=17;
               @endphp
               @foreach ($principle9_ques8->where('question_section','breach_percent') as $key => $segment8)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment8->id)->first()->id }}" name="segment8[{{ $b }}][row_id]">
                 <b>b. {{ $segment8->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment8[{{ $b }}][breach_percent]" id="breach_percent_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment8->id)->first()->breach_percent }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=18;
               @endphp
               @foreach ($principle9_ques9->where('question_section','breach_impact') as $key => $segment9)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment9->id)->first()->id }}" name="segment9[{{ $b }}][row_id]">
                <b>c. {{ $segment9->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment9[{{ $b }}][impact]" id="impact_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment9->id)->first()->impact }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=19;
               @endphp
               @foreach ($principle9_ques10->where('question_section','channels') as $key => $segment10)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment10->id)->first()->id }}" name="segment10[{{ $b }}][row_id]">
                   <b>Essential Indicators</b> <br /><br />
                   <b>1. {{ $segment10->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment10[{{ $b }}][channels]" id="channels_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment10->id)->first()->channels }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=20;
               @endphp
               @foreach ($principle9_ques11->where('question_section','steps') as $key => $segment11)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment11->id)->first()->id }}" name="segment11[{{ $b }}][row_id]">
                 <b>2. {{ $segment11->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment11[{{ $b }}][steps]" id="steps_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment11->id)->first()->steps }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=21;
               @endphp
               @foreach ($principle9_ques12->where('question_section','service') as $key => $segment12)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment12->id)->first()->id }}" name="segment12[{{ $b }}][row_id]">
                <b>3. {{ $segment12->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment12[{{ $b }}][risk]" id="risk_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment12->id)->first()->risk }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
                 <div class="card-header">
                 @php
                 $b=22;
               @endphp
               @foreach ($principle9_ques13->where('question_section','product_info') as $key => $segment13)
               <input type="hidden" value="{{ $principle9_value->where('ques_id',$segment13->id)->first()->id }}" name="segment13[{{ $b }}][row_id]">
                <b>4. {{ $segment13->question }} </b>
              </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment13[{{ $b }}][product_info]" id="product_info_{{$b}}" placeholder="" rows="6">{{ $principle9_value->where('ques_id',$segment13->id)->first()->product_info }}</textarea>
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