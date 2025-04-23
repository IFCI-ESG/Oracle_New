@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

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
    <div class="row" >
        <div class="col-lg-8 offset-md-2 mt-3 p-0">
            <div class="card card-success card-outline mt-3" style="box-shadow: 0px 2px 8px -6px #00000096;">
                <div class="card-header card card-success card-outline shadow p-2 mb-1" style="font-size: 1rem">
                    <b class="textcolor">RBI Disclosure For FY-{{$fys->fy}}</b>
                </div>
                <div class="card border-primary">
                    <div class="card-body p-1 m-0">
                        <div class="row ">
                            <div class="table-responsive rounded col-md-12">
                                <table class="table table-bordered table-sm mb-0" id="appTable"
                                    style="width: 100%">
                                    <thead>
                                        <tr class="text-center tablebgcolor">
                                            <th class="textcolor" style="width: 10%">Sr. No.</th>
                                            <th class="textcolor">Pillars</th>
                                            <th class="textcolor">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pillar_mast as $key=>$p_mast)
                                            <tr>
                                                <td class="text-center textcolor" style=""><b>{{ $key + 1 }}</b></td>
                                                <td class="text-center textcolor" style="">
                                                    {{ $p_mast->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if (isset($pillar_val) && isset($rbi_mast) && $pillar_val->where('rbi_mast_id',$rbi_mast->id)->where('pillar_id',$p_mast->id)->isNotEmpty())
                                                        <a class="btn btn-success btn-sm"
                                                            href="{{ route('admin.rbi_disclosure.edit', ['bank_id' => encrypt(Auth::user()->id), 'pillar_id' => encrypt($p_mast->id), 'fy_id' => encrypt($fys->id)]) }}"> Edit</a>
                                                    @else
                                                        <a class="btn btn-primary activebtnbg btn-sm"
                                                                    href="{{ route('admin.rbi_disclosure.create', ['pillar_id' => encrypt($p_mast->id), 'fy_id' => encrypt($fys->id)]) }}"> Create</a>
                                                    @endif
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
            <div class="col-md-6 ml-4">
                <a href="{{ route('admin.rbi_disclosure') }}"
                class="btn btn-secondary btn-sm float-left p-2 w-25"> <i class="fas fa-arrow-left"></i> Back </a>
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



