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
        <div class="col-lg-8 offset-md-2 mt-4 p-0">
            <div class="card card-success card-outline mt-2 ml-2" style="box-shadow: 0px 2px 8px -6px #00000096;">
                <div class="card-header card card-success mb-0 card-outline shadow p-2">
                    <b class="textcolor">Selection of Financial Year </b>
                </div>
                <div class="card border-primary">
                    <div class="card-body p-1 m-2 mb-0 mt-0">
                        <div class="row ">
                            <div class="table-responsive rounded col-md-12">
                                <table class="table table-bordered table-sm mb-0" id="appTable"
                                    style="width: 100%">
                                    <thead>
                                        <tr class="text-center tablebgcolor">
                                            <th class="textcolor" style="width: 10%">Sr No.</th>
                                            <th class="textcolor">Financial Year</th>
                                            <th class="textcolor">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fys->where('status', '1') as $key => $fy)
                                            <tr>
                                                <td class="text-center textcolor" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                <td class="text-center textcolor" style="font-size: 1rem">
                                                    {{ $fy->fy }}
                                                </td>
                                                @php
                                                    $record = $rbi_mast->where('fy_id', $fy->id)->first();
                                                @endphp
                                                
                                                @if ($record && $record->status == 'D')
                                                    <td class="text-center">
                                                        <a class="btn btn-success btn-sm"
                                                            href="{{ route('admin.rbi_disclosure.pillar', encrypt($fy->id)) }}"> Edit</a>
                                                    </td>
                                                @elseif($record && $record->status == 'S')
                                                    <td class="text-center">
                                                        view
                                                        {{-- <a class="btn btn-warning btn-sm"
                                                            href="{{ route('admin.rbi_disclosure.view', ['com_id' => encrypt($user->id),'fy_id'=> encrypt($fy->id)] ) }}"> View</a> --}}
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <a class="btn btn-primary btn-sm activebtnbg"
                                                            href="{{ route('admin.rbi_disclosure.pillar', encrypt($fy->id)) }}"> Create</a>
                                                    </td>
                                                @endif
                                            
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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



