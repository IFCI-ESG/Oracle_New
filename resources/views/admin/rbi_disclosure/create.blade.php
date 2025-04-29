@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid mt-4">

        @include('layouts.shared.page-title', ['title' => $pillar_ques->first()->pillar_name, 'subtitle' => 'RBI Disclosure'])

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
           <div class="row justify-content-center mt-2">
            <div class="col-md-12">
                <form action="{{ route('admin.rbi_disclosure.store') }}" id="rbi_disclosure" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="pillar_id" value="{{ $pillar_ques->first()->pillar_id }}">
                    <input type="hidden" name="fy_id" value="{{ $fy_id }}">
                    <div class="card card-success card-outline card-tabs mb-5">
                        {{-- <div class="card border-primary card-header mb-0 shadow  card-success card-outline p-2" style="font-size: 1rem">
                            <b class="card-success p-1 shadow">Thematic</b>
                        </div> --}}

                        <div class="card border-primary">
                            {{-- <div class="card-body textcolor" style="font-size: 1rem">
                                <b>{{$pillar_ques->first()->pillar_name}}</b>
                            </div> --}}
                            <div class="card-body pt-2">
                                <table class="table table-bordered table-sm mb-0" id="employee_data">
                                    <thead>
                                        <tr class="text-center tablebgcolor">
                                            <th style="width: 4%" class="text-center textcolor">Sr. No.</th>
                                            <th style="width: 36%" class="text-center textcolor">Question</th>
                                            <th style="width: 10%" class="text-center textcolor">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $a = 1;
                                        @endphp
                                        {{-- {{ dd($pillar_ques->groupBy('types_of_disclosure')) }} --}}
                                
                                        @foreach ($pillar_ques->groupBy('types_of_disclosure') as $disclosure_type => $disclosure_questions)
                                            <!-- Type of Disclosure -->
                                            <tr>
                                                <td colspan="3" class="text-center font-weight-bold">
                                                   <b> {{ $disclosure_type }} </b>
                                                </td>
                                            </tr>
                            
                                            @foreach ($disclosure_questions as $key => $p_ques)
                                                <tr>
                                                    <td class="text-center">{{ $key+1 }}</td>
                                                    <td>{{ $p_ques->ques }}</td>
                                                    <td>
                                                        <input type="hidden" name="part[{{ $a }}][ques_id]" value="{{ $p_ques->id }}">
                            
                                                        @if ($p_ques->data_type == 'text')
                                                            <input type="text" name="part[{{$a}}][value]" class="form-control form-control-sm">
                                                        @elseif ($p_ques->data_type == 'numeric')
                                                            <input type="number" name="part[{{$a}}][value]" class="form-control form-control-sm">
                                                        @elseif ($p_ques->data_type == 'Y/N')
                                                            <select class="form-control form-control-sm" name="part[{{$a}}][option]" id="select_{{ $a }}" onchange="calc(this)">
                                                                {{-- <option value="" selected disabled>Please Select</option> --}}
                                                                <option value="Y">Yes</option>
                                                                <option value="N" selected>No</option>
                                                            </select> <br>
                                                            <input type="text" name="part[{{$a}}][value]" id="detail_{{ $a }}" class="form-control form-control-sm" style="display: none;">
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $a++;
                                                @endphp
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>

                        <div class="row pb-4 px-3">
                            <div class="col-md-6 ml-4">
                                <a href="{{ route('admin.rbi_disclosure.pillar', encrypt($fy_id) ) }}"
                                class="btn btn-secondary btn-sm float-left p-2 w-25"> <i class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-6 offset-md-0">
                                <button type="submit" id="submit" class="btn btn-primary d-block ms-auto activebtnbg w-25 p-2 btn-sm form-control form-control-sm"><i
                                        class="fas fa-save"></i>
                                    Submit</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        
        function calc(e)
        {
            var Id = $(e).attr('id');
            Id = Id.substring(7);
            var detail = $('#detail_' + Id);
            // alert(detail);

            if ($(e).val() === "Y") {
                detail.show();
            } else {
                detail.hide();
            }
        }

    </script>
@endsection
@push('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {!! JsValidator::formRequest('App\Http\Requests\User\RbiDisclosureRequest', '#rbi_disclosure') !!} --}}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

        });


    </script>
@endpush



