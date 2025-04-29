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
                <form action="{{ route('user.brsr.sectionp4update') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit'
                    accept-charset="utf-8">
                    @csrf
                    
                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 4) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">
           
          <div class="card card-success card-outline mt-4">
            <div class="card-header">
              <b>PRINCIPLE 4: Businesses should respect the interests of and be responsive to all its stakeholders </b> <br /><br />
            <b>Essential Indicators</b> <br /><br />
             @php
              $b=1;
               @endphp
              @foreach ($principle4_ques1->where('question_section','process') as $key => $segment1)
              <input type="hidden" value="{{ $principle4_value->where('ques_id',$segment1->id)->first()->id }}" name="segment1[{{ $b }}][row_id]">
             <b>1. {{ $segment1->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment1[{{ $b }}][process_key]" id="process_key_{{$b}}" placeholder="" rows="6">{{ $principle4_value->where('ques_id',$segment1->id)->first()->process_key }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

         <div class="card card-success card-outline mt-4">
                         <div class="card-header">
                         <b>2. List stakeholder groups identified as key for your entity and the frequency of
                         engagement with each stakeholder group. </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Stakeholder Group </th>
                      <th style="width: 30%" class="text-center">Whether identified as Vulnerable & Marginalized Group (Yes/No) </th>
                      <th style="width: 30%" class="text-center">Channels of communication (Email, SMS, Newspaper,Pamphlets,Advertisement,Community Meetings,Notice Board,Website), Other</th>
                      <th style="width: 30%" class="text-center">Frequency of engagement (Annually/ Half yearly/Quarterly /others – please specify)</th>
                      <th style="width: 30%" class="text-center">Purpose and scope of engagement including key topics and concerns raised during such engagement</th>
                   </tr>
                </thead>
               <tbody id="additional_data_rows1">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp4_value as $key => $p4_value)
                <tr>
                <input type="hidden" value="{{ $p4_value->id }}" name="additionals[{{ $b }}][row_id]">
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[{{ $b }}][stakeholder_group]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p4_value->stakeholder_group }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[{{ $b }}][identified_yes_no]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p4_value->identified_yes_no }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[{{ $b }}][channel]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p4_value->channel }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[{{ $b }}][frequency]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p4_value->frequency }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals[{{ $b }}][purpose]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p4_value->purpose }}</textarea></td>
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
              <b>Leadership Indicators</b> <br /><br />
             @php
              $b=2;
               @endphp
              @foreach ($principle4_ques2->where('question_section','consultation') as $key => $segment2)
              <input type="hidden" value="{{ $principle4_value->where('ques_id',$segment2->id)->first()->id }}" name="segment2[{{ $b }}][row_id]">
             <b>1. {{ $segment2->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment2[{{ $b }}][consultation]" id="consultation_{{$b}}" placeholder="" rows="6">{{ $principle4_value->where('ques_id',$segment2->id)->first()->consultation }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        <div class="card card-success card-outline mt-4">
            <div class="card-header">
             @php
              $b=3;
               @endphp
              @foreach ($principle4_ques3->where('question_section','consultation1') as $key => $segment3)
              <input type="hidden" value="{{ $principle4_value->where('ques_id',$segment3->id)->first()->id }}" name="segment3[{{ $b }}][row_id]">
              <b>2. {{ $segment3->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment3[{{ $b }}][stakeholder_consultation]" id="stakeholder_consultation_{{$b}}" placeholder="" rows="6">{{ $principle4_value->where('ques_id',$segment3->id)->first()->stakeholder_consultation }}</textarea>
            </div>
             @php
              $b++;
             @endphp
             @endforeach
        </div>

        
        <div class="card card-success card-outline mt-4">
            <div class="card-header">
             @php
              $b=3;
               @endphp
              @foreach ($principle4_ques4->where('question_section','consultation2') as $key => $segment4)
              <input type="hidden" value="{{ $principle4_value->where('ques_id',$segment4->id)->first()->id }}" name="segment4[{{ $b }}][row_id]">
              <b>3. {{ $segment4->question }} </b>
            </div>
             <div class="card-body p-1">
                <textarea class="form-control form-control-sm" name="segment4[{{ $b }}][stakeholder_groups]" id="stakeholder_groups_consultation_{{$b}}" placeholder="" rows="6">{{ $principle4_value->where('ques_id',$segment4->id)->first()->stakeholder_groups }}</textarea>
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