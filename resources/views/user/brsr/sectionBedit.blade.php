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
                <form action="{{ route('user.brsr.update') }}" id="social_update" role="form" method="post"
                      class='form-horizontal prevent_multiple_submit' accept-charset="utf-8">
                    @csrf
                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social" role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section A (General Disclosures) Data For FY-{{$fys->fy}}</b></a>
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
                @php
                   $operation = $policy_value->firstWhere('ques_id', $emp->id);
                @endphp
                <tr>
                    @if($emp->question_type == 'heading')
                        <td colspan="8" class="text-center" style="font-size: 1rem; font-weight: bold;">
                            {{$emp->question}}
                        </td>
                    @else
 
                      <td style="font-size: 1rem;">
                            {{$emp->question}}
                            <input type="hidden" value="{{ $policy_value->where('id',$operation->id)->first()->id }}" name="emp[{{ $a }}][row_id]">
                       </td>
                      
                     
                       <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p1]" id="policy_p1_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p1 }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p2]" id="policy_p2_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p2 }}</textarea>
                        </td>
                        
                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p3]" id="policy_p3_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p3 }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p4]" id="policy_p4_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p4 }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p5]" id="policy_p5_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p5 }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p6]" id="policy_p6_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p6 }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p7]" id="policy_p7_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p7 }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p8]" id="policy_p8_{{$a}}" oninput="autoResize(this)" > {{ $operation->policy_p8 }}</textarea>
                        </td>

                        <td class="text-center">
                        <textarea style="text-align: left; width: 69px; overflow:hidden; resize: none;" class="form-control form-control-sm emp_{{$a}} t_emp auto-grow" 
                          name="emp[{{ $a }}][policy_p9]" id="policy_p9_{{$a}}" oninput="autoResize(this)" >{{ $operation->policy_p9 }}</textarea>
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

 

 

 

 

 
 

 

 

  
                        </div>
                            </div>
                        </div>

                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.brsr.index') }}" class="btn btn-warning btn-sm float-left">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>
                            <div class="col-md-2 offset-md-3">
                            <div style="display: flex; gap: 10px;">
                                <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm">
                                    <i class="fas fa-save"></i> Update
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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