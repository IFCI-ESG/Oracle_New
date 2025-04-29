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
                <form action="{{ route('user.brsr.sectionp7update') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit'
                    accept-charset="utf-8">
                    @csrf
                     <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 7) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">
                                <div class="card card-success card-outline mt-4">
    <div class="card-header">
        <b>PRINCIPLE 7 Businesses, when engaging in influencing public and regulatory policy, should do so in a manner that is responsible and transparent </b> <br /><br />
        <b>Essential Indicators</b> <br /><br />
        <b>1. a. Number of affiliations with trade and industry chambers/ associations.</b>
    </div>

    <div class="card-body p-1">
        @php
            $a = 1;
        @endphp
        @foreach($sectionp7_value1 as $key => $p7_value)
            <div class="mb-2">
                <input type="hidden" value="{{ $p7_value->id }}" name="additionals1[{{ $a }}][row_id]">
                <textarea class="form-control form-control-sm" name="additionals1[{{ $a }}][affliation_no]" placeholder="" rows="6">{{ $p7_value->affliation_no }}</textarea>
            </div>
            @php
                $a++;
            @endphp
        @endforeach
    </div>
</div>

<!-- Second card -->
<div class="card card-success card-outline mt-4">
    <div class="card-header">
        <b>b. List the top 10 trade and industry chambers/ associations (determined based on the total members of such body) the entity is a member of/ affiliated to.</b>
    </div>

    <div class="card-body p-3">
        <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
            <thead>
                <tr class="text-center table-success">
                    <th style="width: 10%" class="text-center">S.No</th>
                    <th style="width: 30%" class="text-center">Name of the trade and industry chambers/associations</th>
                    <th style="width: 30%" class="text-center">Reach of trade and industry chambers/ associations (State/National)</th>
                </tr>
            </thead>

            <tbody id="additional_data_rows1">
                @php
                    $b = 1;
                @endphp
                @foreach($sectionp7_value2 as $key => $p7_value1)
                    <tr>
                        <input type="hidden" value="{{ $p7_value1->id }}" name="additionals2[{{ $b }}][row_id]">
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][trade_no]" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $p7_value1->trade_no }}</textarea></td>
                        <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[{{ $b }}][trade_reach]" style="overflow:hidden; resize:none;" oninput="autoResize(this)">{{ $p7_value1->trade_reach }}</textarea></td>
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
                         <b>2. Provide details of corrective action taken or underway on any issues related to anticompetitive conduct by the entity, based on adverse orders from regulatory authorities. </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Name of authority</th>
                      <th style="width: 30%" class="text-center">Brief of the case</th>
                      <th style="width: 30%" class="text-center">Corrective action taken</th>
                   
                    </tr>
                </thead>
               <tbody id="additional_data_rows2">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp7_value3 as $key => $p7_value2)
                <tr>
                <input type="hidden" value="{{ $p7_value2->id }}" name="additionals3[{{ $b }}][row_id]">
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[{{ $b }}][authority_name]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value2->authority_name }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[{{ $b }}][brief_case]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value2->brief_case }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[{{ $b }}][action_taken]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value2->action_taken }}</textarea></td>
                 
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
                         <b>1. Details of public policy positions advocated by the entity:</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Public policy advocated</th>
                      <th style="width: 30%" class="text-center">Method resorted for such advocacy</th>
                      <th style="width: 30%" class="text-center">Whether information available in public domain? (Yes/No)</th>
                      <th style="width: 30%" class="text-center">Frequency of Review by Board (Annually/Half yearly/Quarterly/Others –please specify)</th>
                      <th style="width: 30%" class="text-center">Web Link, if available</th>
                    
                    </tr>
                </thead>
               <tbody id="additional_data_rows3">
               @php
                    $b = 1;
                @endphp
                @foreach($sectionp7_value4 as $key => $p7_value3)
                <tr>
                <input type="hidden" value="{{ $p7_value3->id }}" name="additionals4[{{ $b }}][row_id]">
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][public_policy]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value3->public_policy }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][advocacy]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value3->advocacy }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][public_domain]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value3->public_domain }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][frequency_review]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value3->frequency_review }}</textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[{{ $b }}][web_link]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)">{{ $p7_value3->web_link }}</textarea></td>
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