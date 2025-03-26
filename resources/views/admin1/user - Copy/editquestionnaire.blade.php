@extends('layouts.user.dashboard-master')
@section('title')
Questionnaire Details
@endsection
@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
    <style>
        input[type="file"] {
            padding: 1px;
        }
    </style>
@endpush
@section('content')
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('user.questionnaire.store') }}" id="bankDetails_create" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card card-success card-outline">
                        <div class="card-header">
                          <h2 class="card-title">
                            <i class="fas fa-edit"></i>
                           Input Sheet
                          </h2>
                        </div>
                        <div class="card-body">
                          <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Segments</h4>
                          <div class="row">
                            <div class="col-5 col-sm-3">
                              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($segments as $key=>$seg)
                                    <a @if($seg->id==1) class="nav-link active shadow" @else class="nav-link shadow" @endif
                                         id="vert-tabs-{{$seg->id}}-tab" data-toggle="pill" href="#vert-tabs-{{$seg->id}}" role="tab" aria-controls="vert-tabs-{{$seg->id}}" aria-selected="{{($seg->id==1) ? 'true' : 'false'}}">{{$seg->segment_name}}
                                    </a>
                                @endforeach
                              </div>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    @php
                                        $s_no = 2;
                                    @endphp
                                    {{-- {{dd($questions)}} --}}
                                    <small class="text-danger">(All segments related questions are mandatory)</small>
                                @foreach ($segments as $key=>$seg)
                                    <div @if($seg->id==1) class="tab-pane text-left fade show active" @else class="tab-pane fade" @endif
                                        style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474); max-height: 500px; overflow-y: auto;"
                                        id="vert-tabs-{{$seg->id}}" role="tabpanel" aria-labelledby="vert-tabs-{{$seg->id}}-tab">
                                        <table class="table table-sm table-striped table-hover">
                                            <tbody>
                                                <tr class="">
                                                    <th class="text-center" style="width: 50%">Particulars</th>
                                                    <th class="text-center" style="width: 20%">Unit</th>
                                                    <th class="text-center" style="width: 20%">Value</th>
                                                </tr>
                                                @foreach ($questions->where('status','1')->where('seg_id',$seg->id) as $key => $ques)
                                                    <tr>
                                                        <td style="font-size: 1rem;">
                                                            {{$ques->particular}}
                                                            <input type="hidden" value="{{ $ques->ques_id }}" name="part[{{ $key }}][ques_id]">
                                                            <input type="hidden" value="{{ $ques->row_id }}" name="part[{{ $key }}][row_id]">
                                                        </td>
                                                        @if($ques->unit_status=='1' && $ques->data_type!='radio')
                                                            <td class="text-center" style="font-size: 0.9rem;">
                                                                {!! $ques->unit !!}
                                                            </td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td>
                                                            @if($ques->data_type=='radio')
                                                                <div>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label>
                                                                        <input type="radio" name="part[{{ $key }}][value]" value="1" @if($ques->value == '1') checked @endif class="form-control form-control-sm text-right"> Yes
                                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label>
                                                                        <input type="radio" name="part[{{ $key }}][value]" value="0" @if($ques->value == '0') checked @endif class="form-control form-control-sm text-right"> No
                                                                    </label>
                                                                </div>
                                                            @else
                                                                <input  type="{{$ques->data_type}}" readonly required value="{{$ques->value}}" name="part[{{ $key }}][value]" class="form-control form-control-sm text-right" style="width:100%">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card -->
                      </div>

                    {{-- <div class="row pb-3"> --}}

                    <div class="row pb-3">

                        {{-- <div class="col-md-2 offset-md-4">
                            <button type="submit" id="submit"
                                class="btn btn-primary btn-sm form-control form-control-sm form-control form-control-sm-sm">
                                <em class="fas fa-save"></em> Save
                            </button>
                        </div> --}}

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\User\Claims\ClaimS5BankDetailsRequest', '#bankDetails_create') !!} --}}
    {{-- @include('user.partials.js.prevent_multiple_submit') --}}
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
