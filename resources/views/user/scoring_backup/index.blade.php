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
<div class="row" >
    <div class="col-lg-8 offset-md-2">
        <div class="card card-success card-outline mt-5 ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                       <div class="card-header">
                    <b>Selection of Financial Year </b>
                </div>
            <div class="card border-primary">
                <div class="card-body p-1 m-2">
                    <div class="row ">
                        <div class="table-responsive rounded col-md-12">
                            <table class="table table-bordered table-hover table-sm table-striped" id="appTable"
                            style="width: 100%">
                            <thead>
                                <tr class="text-center table-social">
                                    <th style="width: 5%" class="text-center">Sr. No.</th>
                                    <th style="width: 30%" class="text-center">Financial Year</th>
                                    <th style="width: 30%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if(count($fys)>0)

                                @foreach ($fys as $key => $fy)
                                <tr>
                                    <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                    <td class="text-center" style="font-size: 1rem">
                                        {{ $fy->fy }}
                                    </td>
                                    @if (count($score_value->where('fy_id',$fy->id)))
                                    @if ($module_mast->where('fy_id',$fy->id)->first()->status=='S')
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm Custom-btn-view"
                                        href="{{ route('user.scoring.view', encrypt($module_mast->where('fy_id',$fy->id)->first()->id) )  }}"> View</a>
                                    </td>
                                    @elseif($module_mast->where('fy_id',$fy->id)->first()->status=='D')
                                    <td class="text-center">
                                        <a class="btn btn-success btn-sm Custom-btn-edit"
                                        href="{{ route('user.scoring.edit', encrypt($module_mast->where('fy_id',$fy->id)->first()->id) ) }}"> Edit</a>
                                    </td>
                                    @endif
                                    @else
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm Custom-btn"
                                        href="{{ route('user.scoring.create', encrypt($fy->id)) }}"> Create</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                @else
                                <tr><td colspan="3"><b>No data Found</b></td>
                                </tr>
                                @endif
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
{!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
@include('partials.js.prevent_multiple_submit')
<script>
    $(document).ready(function() {

    });
</script>
@endpush
