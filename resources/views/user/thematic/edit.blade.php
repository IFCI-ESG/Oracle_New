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
                <form action="{{ route('user.thematic.update') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>Thematic</b></a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">

                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <b>{{$pillar_ques->first()->pillar_name}}</b>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-bordered table-hover table-sm table-striped" id="employee_data">
                                                <thead>
                                                    <tr class="text-center table-success">
                                                        <th style="width: 10%" class="text-center">
                                                            Sr. No.
                                                        </th>
                                                        <th style="width: 30%" class="text-center">
                                                            Question
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                            Value
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $a=1;
                                                    @endphp
                                                    @foreach ($pillar_val as $key=>$p_val)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{$a}}
                                                            </td>
                                                            <td>
                                                                {{$p_val->name}}
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="part[{{ $key }}][row_id]" value="{{ $p_val->id }}">

                                                                @if ($p_val->data_type=='text')
                                                                    <input type="text" value="{{$p_val->value}}" name="part[{{$key}}][value]" class="form-control form-control-sm">
                                                                @elseif ($p_val->data_type=='numeric')
                                                                    <input type="number" value="{{$p_val->value}}" name="part[{{$key}}][value]" class="form-control form-control-sm">
                                                                @elseif ($p_val->data_type=='Y/N')
                                                                    <select class="form-control form-control-sm" name="part[{{$key}}][value]" id="">
                                                                        {{-- <option value="" selected disabled>Please Select</option> --}}
                                                                        <option value="Y" {{$p_val->value == 'Y' ? 'selected' : '' }}>Yes</option>
                                                                        <option value="N" {{$p_val->value == 'N' ? 'selected' : '' }}>No</option>
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $a++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.thematic') }}"
                                class="btn btn-warning btn-sm float-left"> <i class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-1 offset-md-3">
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
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\SocialRequest', '#social_store') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {



        });


    </script>
@endpush



