@extends('layouts.user.dashboard-master')
@section('title')
    Add Questionnaire
@endsection
@push('styles')
    {{-- <link href="{{ asset('css/app/application.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
@endpush
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <br>
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<style type="text/css">
    .table tbody tr td input {
    height: auto;
}
</style>
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('user.social.store') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" value="{{ $fy_id }}" name="fy_id">
                    <input type="hidden" value="{{ $user->id }}" name="com_id">
                    @if (isset($social_mast->id))
                        <input type="hidden" value="{{ $social_mast->id }}" name="social_mast_id">
                    @endif

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>Social Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b class="table-heading-sec">Employment Data</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="employee_data">
                                                         <td>
                                            <label class="" style=" margin-left: 50px;" data-toggle="tooltip" data-placement="right" title="ffdgdf">
                                                <input type="checkbox" class="first" id="check" name="ques">hiiiiiiiiiiii
                                            </label>
                                            <input type="hidden" name="ques" value="">
                                        </td>
                                                <thead>
                                                   <tr class="text-center table-success">
                                      <th
                                        style="width: 5%"
                                        class="text-center"
                                      >
                                        Sr. No.
                                      </th>
                                      <th
                                        style="width: 30%"
                                        class="text-center"
                                      >
                                        Question
                                      </th>
                                      <th
                                        style="width: 10%"
                                        class="text-center"
                                      >
                                        Male
                                      </th>
                                      <th
                                        style="width: 10%"
                                        class="text-center"
                                      >
                                        Female
                                      </th>
                                      <th
                                        style="width: 10%"
                                        class="text-center"
                                      >
                                        Others
                                      </th>
                                      <th
                                        style="width: 10%"
                                        class="text-center"
                                      >
                                        Total
                                      </th>
                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $a=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('section','Employment') as $key => $emp)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $key+1 }}
                                                            </td>
                                                            <td @if($emp->type=='heading')
                                                                    style="font-size: 1rem; font-weight: bold;"  colspan="5"
                                                                @else
                                                                    style="font-size: 1rem;"
                                                                @endif>
                                                                {{$emp->question}}
                                                                @if($emp->type!='heading')
                                                                    @if($emp->id != 8 && $emp->id != 16 && $emp->id != 24 && $emp->id != 32)
                                                                        <input type="hidden" value="{{ $emp->id }}" name="emp[{{ $a }}][ques_id]">
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @if($emp->type!='heading')
                                                                @if($emp->id == 8 || $emp->id == 16 || $emp->id == 24 || $emp->id == 32)
                                                                    <td>
                                                                        <input type="number" style="text-align: right" id="{{ $emp->type == 'tot_emp' ? 'tot_m_emp' :
                                                                            ($emp->type == 'tot_work' ? 'tot_m_worker' :
                                                                            ($emp->type == 'tot_abled_emp' ? 'tot_m_abled_emp' :
                                                                            ($emp->type == 'tot_abled_work' ? 'tot_m_abled_work' : 'tot_xyz'))) }}" class="form-control form-control-sm" disabled>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" style="text-align: right" id="{{ $emp->type == 'tot_emp' ? 'tot_f_emp' :
                                                                            ($emp->type == 'tot_work' ? 'tot_f_worker' :
                                                                            ($emp->type == 'tot_abled_emp' ? 'tot_f_abled_emp' :
                                                                            ($emp->type == 'tot_abled_work' ? 'tot_f_abled_work' : 'tot_xyz'))) }}" class="form-control form-control-sm" disabled>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" style="text-align: right" id="{{ $emp->type == 'tot_emp' ? 'tot_o_emp' :
                                                                            ($emp->type == 'tot_work' ? 'tot_o_worker' :
                                                                            ($emp->type == 'tot_abled_emp' ? 'tot_o_abled_emp' :
                                                                            ($emp->type == 'tot_abled_work' ? 'tot_o_abled_work' : 'tot_xyz'))) }}" class="form-control form-control-sm" disabled>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" style="text-align: right" id="{{ $emp->type == 'tot_emp' ? 'tot_t_emp' :
                                                                            ($emp->type == 'tot_work' ? 'tot_t_worker' :
                                                                            ($emp->type == 'tot_abled_emp' ? 'tot_t_abled_emp' :
                                                                            ($emp->type == 'tot_abled_work' ? 'tot_t_abled_work' : 'tot_xyz'))) }}" class="form-control form-control-sm" disabled>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <input type="number" style="text-align: right" min="0" class="form-control form-control-sm emp_{{$a}} {{ $emp->type == 'employee' ? ' m_emp' :
                                                                            ($emp->type == 'worker' ? ' m_worker' :
                                                                            ($emp->type == 'abled_emp' ? 'm_abled_emp' :
                                                                            ($emp->type == 'abled_work' ? 'm_abled_work' : 'xyz'))) }}" data_type="horizontal_{{$a}}" onkeyup="Employee_Total(this)" name="emp[{{ $a }}][emp_male]">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" style="text-align: right" min="0" class="form-control form-control-sm emp_{{$a}} {{ $emp->type == 'employee' ? ' f_emp' :
                                                                            ($emp->type == 'worker' ? ' f_worker' :
                                                                            ($emp->type == 'abled_emp' ? 'f_abled_emp' :
                                                                            ($emp->type == 'abled_work' ? 'f_abled_work' : 'xyz'))) }}" data_type="horizontal_{{$a}}" onkeyup="Employee_Total(this)" name="emp[{{ $a }}][emp_female]">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" style="text-align: right" min="0" class="form-control form-control-sm emp_{{$a}} {{ $emp->type == 'employee' ? ' o_emp' :
                                                                            ($emp->type == 'worker' ? ' o_worker' :
                                                                            ($emp->type == 'abled_emp' ? 'o_abled_emp' :
                                                                            ($emp->type == 'abled_work' ? 'o_abled_work' : 'xyz'))) }}" data_type="horizontal_{{$a}}" onkeyup="Employee_Total(this)" name="emp[{{ $a }}][emp_others]">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" style="text-align: right" min="0" class="form-control form-control-sm {{ $emp->type == 'employee' ? ' t_emp' :
                                                                            ($emp->type == 'worker' ? ' t_worker' :
                                                                            ($emp->type == 'abled_emp' ? 't_abled_emp' :
                                                                            ($emp->type == 'abled_work' ? 't_abled_work' : 'xyz'))) }}" data_type="horizontal_{{$a}}" onkeyup="Employee_Total(this)" id="tot_emp_{{$a}}" disabled>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                        @php
                                                            $a++;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td class="text-center" colspan="5">
                                                            Total Employees and Workers
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm" id="tot_emp_worker" style="text-align: right" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" colspan="5">
                                                            Total % of Female Employees and Workers
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm" id="tot_per_female" style="text-align: right" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" colspan="5">
                                                            Total % of Differently Abled  Employees and Workers
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm" id="tot_diff_abled_emp" style="text-align: right" disabled>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                             <b class="table-heading-sec">Representation of Women in the Board</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="env-table">
                                                <thead>
                                     <tr class="text-center table-success">
                                              <th
                                                style="width: 5%"
                                                class="text-center"
                                              >
                                                Sr. No.
                                              </th>
                                              <th
                                                style="width: 30%"
                                                class="text-center"
                                              >
                                                Particulars
                                              </th>
                                              <th
                                                style="width: 10%"
                                                class="text-center"
                                              >
                                                Total Employees in the category (A)
                                              </th>
                                              <th
                                                style="width: 10%"
                                                class="text-center"
                                              >
                                                No. of Female Employees (B)
                                              </th>
                                              <th
                                                style="width: 10%"
                                                class="text-center"
                                              >
                                                % of Female Employees (B/A*100)
                                              </th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $b=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('section','Represent Women') as $key => $women)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td style="font-size: 1rem;">
                                                                {{$women->question}}
                                                                <input type="hidden" value="{{ $women->id }}" name="women[{{ $b }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <input type="number" min="0" style="text-align: right" class="form-control form-control-sm {{$women->id==33 ? 'director' : 'management'}}" onkeyup="Percentage_women(this)" name="women[{{ $b }}][women_tot_emp]">
                                                            </td>
                                                            <td>
                                                                <input type="number" min="0" style="text-align: right" class="form-control form-control-sm {{$women->id==33 ? 'director' : 'management'}}" onkeyup="Percentage_women(this)" name="women[{{ $b }}][women_tot_female_emp]">
                                                            </td>
                                                            <td>
                                                                <input type="number" min="0" style="text-align: right" class="form-control form-control-sm" id="{{$women->id==33 ? 'tot_director' : 'tot_management'}}" disabled>
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
                                            <b class="table-heading-sec">Expenses on Employee wellbeing</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="env-table">
                                                <thead>
                                    <tr class="text-center table-success">
                                      <th
                                        style="width: 5%"
                                        class="text-center"
                                      >
                                        Sr. No.
                                      </th>
                                      <th
                                        style="width: 30%"
                                        class="text-center"
                                      >
                                        Particulars
                                      </th>
                                      <th
                                        style="width: 10%"
                                        class="text-center"
                                      >
                                        Cost incurred on wellbeing measures in
                                        INR (A)
                                      </th>
                                      <th
                                        style="width: 10%"
                                        class="text-center"
                                      >
                                        Total revenue of the company (B)
                                      </th>
                                      <th
                                        style="width: 10%"
                                        class="text-center"
                                      >
                                        Cost incurred on well being as a % of
                                        total revenue of the company (A/B *100)
                                      </th>
                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $c=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('section','Cost Incurred') as $key => $cost)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td style="font-size: 1rem;">
                                                                {{$cost->question}}
                                                                <input type="hidden" value="{{ $cost->id }}" name="cost_incurr[{{ $c }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <input type="number" style="text-align: right" min="0" class="form-control form-control-sm wellbeing" onkeyup="Percentage_wellbeing(this)" name="cost_incurr[{{ $c }}][cost_incurred]">
                                                            </td>
                                                            <td>
                                                                <input type="number" style="text-align: right" min="0" id="tot_revenue" class="form-control form-control-sm wellbeing" onkeyup="Percentage_wellbeing(this)" name="cost_incurr[{{ $c }}][tot_revenue]">
                                                            </td>
                                                            <td>
                                                                <input type="number" style="text-align: right" min="0" class="form-control form-control-sm" id="tot_wellbeing" disabled>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $c++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b class="table-heading-sec">CSR Details</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="env-table">
                                                <thead>
                                                  <tr class="text-center table-success">
                                                  <th  style="width: 5%" class="text-center"> Sr. No.</th>
                                                  <th style="width: 30%" class="text-center"> Particulars</th>
                                                  <th  style="width: 30%" class="text-center" >   Value  </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $d=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('section','CSR Details') as $key => $csr)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td style="font-size: 1rem;">
                                                                {{$csr->question}}
                                                                <input type="hidden" value="{{ $csr->id }}" name="csr[{{ $d }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                @if($csr->id==46)
                                                                    <input type="number" style="text-align: right" min="0" class="form-control form-control-sm" name="csr[{{ $d }}][csr_details]">
                                                                @else
                                                                    <select class="form-control form-control-sm" name="csr[{{ $d }}][csr_details]" id="">
                                                                        <option value="" selected disabled>Please Select</option>
                                                                        <option value="Y">Yes</option>
                                                                        <option value="N">No</option>
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $d++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b class="table-heading-sec">Area of CSR Activities</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="csr-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        <th style="width: 5%" class="text-center">
                                                            Sr. No.
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Particulars
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Value
                                                        </th>
                                                        {{-- <th style="width: 10%" class="text-center">
                                                            SDG Impact
                                                        </th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $e=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('section','CSR Activities') as $key => $csr_acti)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td style="font-size: 1rem;">
                                                                {{$csr_acti->question}}
                                                                <input type="hidden" value="{{ $csr_acti->id }}" name="csr_acti[{{ $e }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <select class="form-control form-control-sm csr" id="activity_{{$e}}" name="csr_acti[{{ $e }}][csr_activity]">
                                                                    <option value="" selected disabled>Please Select</option>
                                                                    <option value="Y">Yes</option>
                                                                    <option value="N">No</option>
                                                                </select>
                                                            </td>
                                                            {{-- <td>
                                                                <select class="form-control form-control-sm csr" id="sdg_{{$e}}" name="csr_acti[{{ $e }}][sdg_id]" disabled>
                                                                    <option value="" selected disabled>Please Select</option>
                                                                    @foreach ($sdgMast as $key => $sdg)
                                                                        <option value="{{$sdg->id}}">{{$sdg->sdg_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td> --}}
                                                        </tr>
                                                        @php
                                                            $e++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b class="table-heading-sec">Impact Assessment of CSR Activities</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="env-table">
                                                <thead class="">
                                                    <tr class="text-center ">
                                                        <td style="width: 60%">
                                                            <p class="lead">
                                                                 If yes, how many lives are impacted
                                                                </p>
                                                            
                                                        </td>
                                                        <td style="width: 40%">
                                                           <select class="form-control form-control-sm csr_impact" id="impact" name="impact">
                                                                <option value="" selected disabled>Please Select</option>
                                                                <option value="Y">Yes</option>
                                                                <option value="N">No</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>

                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        <th style="width: 5%" class="text-center">
                                                            Sr. No.
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Particulars
                                                        </th>
                                                        <th style="width: 15%" class="text-center">
                                                            Male
                                                        </th>
                                                        <th style="width: 15%" class="text-center">
                                                            Female
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $f=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('section','CSR Impact') as $key => $csr_impact)
                                                        {{-- @if ($csr_impact->type!='if_yes') --}}
                                                            <tr>
                                                                <td class="text-center">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td style="font-size: 1rem;">

                                                                    {{$csr_impact->question}}
                                                                    <input type="hidden" value="{{ $csr_impact->id }}" name="csr_impact[{{ $f }}][ques_id]">

                                                                </td>
                                                                <td>
                                                                    <input type="number" style="text-align: right" min="0" class="form-control form-control-sm csr_val" name="csr_impact[{{ $f }}][csr_male]" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="number" style="text-align: right" min="0" class="form-control form-control-sm csr_val" name="csr_impact[{{ $f }}][csr_female]" readonly>
                                                                </td>
                                                            </tr>
                                                        {{-- @endif --}}
                                                        @php
                                                            $f++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b class="table-heading-sec">Training of employees and workers</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        <th style="width: 5%" class="text-center">
                                                            Sr. No.
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Particulars
                                                        </th>
                                                        <th style="width: 15%" class="text-center">
                                                            Total No Employees & Workers Trained
                                                        </th>
                                                        <th style="width: 15%" class="text-center">
                                                            Amount spent on Trainings
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $g=1;
                                                    @endphp
                                                    @foreach ($quesMast->where('section','Training') as $key => $train)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td style="font-size: 1rem;">
                                                                {{$train->question}}
                                                                <input type="hidden" value="{{ $train->id }}" name="train[{{ $g }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <input type="number" style="text-align: right" min="0" class="form-control form-control-sm train_emp" onkeyup="Training_Total(this)" name="train[{{ $g }}][train_tot_emp]">
                                                            </td>
                                                            <td>
                                                                <input type="number" style="text-align: right" min="0" class="form-control form-control-sm amt_spent" onkeyup="Training_Total(this)" name="train[{{ $g }}][train_amt_spent]">
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $g++;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            Total
                                                        </td>
                                                        <td>
                                                            <input type="number" style="text-align: right" class="form-control form-control-sm" id="tot_train_emp" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="number" style="text-align: right" class="form-control form-control-sm" id="tot_amt_spent" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            Percentage of Employees  trained
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="number" style="text-align: right" class="form-control form-control-sm" id="per_emp" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            Percentage share of amount spent on trainings out of total revenue of the company
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="number" style="text-align: right" class="form-control form-control-sm" id="per_amt_spent" disabled>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b class="table-heading-sec">Welfare Section</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered  table-sm table-striped" id="env-table">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        <th style="width: 5%" class="text-center">
                                                            Sr. No.
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Particulars
                                                        </th>
                                                        <th style="width: 15%" class="text-center">
                                                            Remark
                                                        </th>
                                                        <th style="width: 15%" class="text-center">
                                                            Photographs
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($quesMast->where('section','Employee Welfare') as $key => $welfare)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td style="font-size: 1rem;">
                                                                {{$welfare->question}}
                                                                <input type="hidden" value="{{ $welfare->id }}" name="welfare[{{ $key }}][ques_id]">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm" name="welfare[{{ $key }}][emp_welfare_remark]">
                                                            </td>
                                                            <td>
                                                                <input type="file" class="form-control form-control-sm" name="welfare[{{ $key }}][Welfare_doc]">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row pb-2 mt-2 mb-4">
                            <div class="col-md-2 ml-5">
                                <a href="{{ route('user.social.index') }}"
                                class="btn btn-warning btn-sm float-left  Custom-btn"> <i
                                    class="fas fa-arrow-left "></i> Back </a>
                            </div>

                            <div class="col-md-1 offset-md-3">

                                {{-- <a class="btn btn-warning m-2 btn-sm form-control form-control-sm"
                                        href="{{ route('user.print_preview', ['com_id'=>encrypt($user->id), 'fy_id'=>encrypt($fy_id)]) }}">
                                        Print Preview</a> --}}
                                {{-- @if(!$busi_value->isEmpty()) --}}
                                    <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm  Custom-btn"><i
                                            class="fas fa-save"></i>
                                        Submit</button>
                                {{-- @endif --}}
                            </div>
                        </div>
                        <!-- /.card -->
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
        $(document).ready(function() {

            const busiBtn = document.getElementById("busi_submit");

            $('.busi_prevent_multiple_submit').on('submit', function() {
                if ($('.busi_msg').length === 0) {
                    $( ".busi_prevent_multiple_submit" ).parent().append('<div class="offset-md-4 busi_msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>');
                }
                busiBtn.disabled = true;
                setTimeout(function(){busiBtn.disabled = false;}, (1000*20));
                setTimeout(function(){$( ".busi_msg" ).hide()}, (1000*20));
            });

            // $("#csr-table").delegate(".csr", "change", function() {

            //     var Id = $(this).attr('id');
            //     Id = Id.substring(9);
            //     var sdgDropdown = $('#sdg_' + Id);

            //     if (this.value === "Y") {
            //         sdgDropdown.removeAttr('disabled');  // Enable the SDG dropdown if "Y" is selected
            //     } else {
            //         sdgDropdown.attr('disabled', 'disabled');  // Disable the SDG dropdown if "N" or other value is selected
            //         sdgDropdown.val('');  // Clear the SDG dropdown value
            //     }
            // });

            $(document).delegate(".csr_impact", "change", function() {
                // var id = $(this).attr('id');
                var value = $('#impact').val();
                // var value = $(this).val();
                if (value === "Y") {
                    $('.csr_val').removeAttr('readonly');  // Enable the csr_val field if "Y" is selected
                } else {
                    $('.csr_val').attr('readonly', 'readonly');  // Disable the csr_val field if "N" or other value is selected
                }
            });

        });

        function Employee_Total(e) {
            // Get class and data type for current element
            var classNames = $(e).attr('class');
            classNames = classNames.substring(36);
            var data_type = $(e).attr('data_type');
            var data_type_id = data_type.substring(11);
            var className = classNames.replace(' valid', '');

            // Sum values for the current row (Male, Female, Others)
            var sum = 0;
            $('.' + className).each(function () {
                var val = +$(this).val(); // Convert value to number
                if (!isNaN(val)) {
                    sum += val;
                }
            });
            $('#tot_' + className).val(sum.toFixed(2)); // Update total for current row



            // Sum values for the entire row (all employees - Male, Female, Others)
            var tot = 0;
            $('.emp_' + data_type_id).each(function () {
                var val = +$(this).val(); // Convert value to number
                if (!isNaN(val)) {
                    tot += val;
                }
            });
            $('#tot_emp_' + data_type_id).val(tot.toFixed(2)); // Update total for row



            // Calculate Total Employees and Workers across all rows
            var totalEmployeesAndWorkers = 0;
            $('.t_emp, .t_worker, .t_abled_emp, .t_abled_work').each(function () {
                var val = +$(this).val(); // Convert value to number
                if (!isNaN(val)) {
                    totalEmployeesAndWorkers += val;
                }
            });
            $('#tot_emp_worker').val(totalEmployeesAndWorkers.toFixed(2)); // Update total employees and workers

            // Calculate Total Female Employees and Workers Percentage
            var totalFemale = 0;
            $('.f_emp, .f_worker, .f_abled_emp, .f_abled_work ').each(function () {
                var val = +$(this).val(); // Convert value to number
                if (!isNaN(val)) {
                    totalFemale += val;
                }
            });
            var femalePercentage = (totalEmployeesAndWorkers > 0) ? (totalFemale / totalEmployeesAndWorkers) * 100 : 0;
            $('#tot_per_female').val(femalePercentage.toFixed(2)); // Update female percentage

            // Calculate Total Differently Abled Employees and Workers Percentage
            var totalDifferentlyAbled = 0;
            $('.t_abled_emp, .t_abled_work').each(function () {
                var val = +$(this).val(); // Convert value to number
                if (!isNaN(val)) {
                    totalDifferentlyAbled += val;
                }
            });
            var differentlyAbledPercentage = (totalEmployeesAndWorkers > 0) ? (totalDifferentlyAbled / totalEmployeesAndWorkers) * 100 : 0;
            $('#tot_diff_abled_emp').val(differentlyAbledPercentage.toFixed(2)); // Update differently abled percentage

            // $('.t_emp').each(function () {
            //     Employee_Total(this);
            // });
        }

        function Percentage_women(e) {
            // var classNames = $(e).val();
            var classNames = $(e).attr('class');
            classNames = classNames.substring(29);
            className = classNames.replace(' valid', '');
            const a = [];
            var sr = 0;
            $('.' + className).each(function() {
                a[sr] = $(this).val();
                sr = sr + 1;
            });
            // Ensure that both a[0] and a[1] are numeric and not empty
            var value1 = parseFloat(a[0]);
            var value2 = parseFloat(a[1]);

            if (!isNaN(value1) && !isNaN(value2) && value1 !== 0) {
                var tot = (value2 / value1) * 100;
                $('#tot_' + className).val(tot.toFixed(2));
            } else {
                $('#tot_' + className).val(''); // Clear the field or handle the error
                // console.error("Invalid input values: value1 = " + a[0] + ", value2 = " + a[1]);
            }
        };

        function Percentage_wellbeing(e) {
            // var classNames = $(e).val();
            var classNames = $(e).attr('class');
            classNames = classNames.substring(29);
            className = classNames.replace(' valid', '');
            const a = [];
            var sr = 0;
            $('.' + className).each(function() {
                a[sr] = $(this).val();
                sr = sr + 1;
            });
            // Ensure that both a[0] and a[1] are numeric and not empty
            var value1 = parseFloat(a[0]);
            var value2 = parseFloat(a[1]);

            if (!isNaN(value1) && !isNaN(value2) && value1 !== 0) {
                var tot = (value1 / value2) * 100;
                $('#tot_' + className).val(tot.toFixed(2));
            } else {
                $('#tot_' + className).val(''); // Clear the field or handle the error
                // console.error("Invalid input values: value1 = " + a[0] + ", value2 = " + a[1]);
            }
        };

        function Training_Total(e) {
            var classNames = $(e).attr('class');
            classNames = classNames.substring(29);
            // alert(classNames);
            // console.log(classNames);
            className = classNames.replace(' valid', '');
            var sum = 0;
            $('.' + className).each(function() {
                sum += +$(this).val();
            });
            $('#tot_' + className).val(sum.toFixed(2));

            var tot_emp_work = $('#tot_emp_worker').val();
            var tot_train_emp = $('#tot_train_emp').val();

            tot_tot_train_emp = tot_train_emp/tot_emp_work;
            $('#per_emp').val(tot_tot_train_emp.toFixed(2));

            var tot_revenue = $('#tot_revenue').val();
            var amt_spent = $('#tot_amt_spent').val();

            tot_per_amt = amt_spent/tot_emp_work;
            $('#per_amt_spent').val(tot_per_amt.toFixed(2));

        };

    </script>
@endpush
