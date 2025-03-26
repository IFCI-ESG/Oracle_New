@extends('layouts.user.dashboard-master')
@section('title')
    Financial Year
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
    {{-- ContentStarts --}}

    <div class="row" >
        <div class="col-lg-8 offset-md-2">
            <div class="card card-success card-outline mt-5 ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                <div class="card-header">
                    <b class="table-heading-sec">Selection of Financial Year </b>
                </div>
                <div class="card border-primary">
                    <div class="card-body p-1 m-2">
                        <div class="row ">
                            <div class="table-responsive rounded col-md-12">
                                <table class="table table-bordered  table-sm table-striped" id="appTable"
                                    style="width: 100%">
                                    <thead>
                                        <tr class="text-center  table-success">
                                            <th class="text-center" style="width: 5%" >Sr No.</th>
                                            <th class="text-center" style="width:30%" >Financial Year</th>
                                            <th class="text-center" style="width: 30%" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fys->where('status', '1') as $key => $fy)
                                            <tr>
                                                <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                <td class="text-center" style="font-size: 1rem">
                                                    {{ $fy->fy }}
                                                </td>
                                                {{-- {{dd($social_mast->where('fy_id',$fy->id))}} --}}
                                                @if (count($social_value->where('fy_id',$fy->id)))
                                                    @if ($social_mast->where('fy_id',$fy->id)->first()->status=='S')
                                                        <td class="text-center">
                                                            {{-- <a class="btn btn-warning btn-sm"
                                                                href="{{ route('user.social.view', ['com_id' => encrypt($user->id),'fy_id'=> encrypt($fy->id)] ) }}"> View</a> --}}
                                                        </td>
                                                    @elseif($social_mast->where('fy_id',$fy->id)->first()->status=='D')
                                                        <td class="text-center">
                                                            <a class="btn btn-success btn-sm Custom-btn-edit"
                                                                href="{{ route('user.social.edit', encrypt($social_mast->where('fy_id',$fy->id)->first()->id) ) }}"> Edit</a>
                                                        </td>
                                                    @endif
                                                @else
                                                    <td class="text-center">
                                                        <a class="btn btn-primary btn-sm Custom-btn"
                                                            href="{{ route('user.social.create', encrypt($fy->id)) }}"> Create</a>
                                                    </td>
                                                @endif
                                                {{-- @if (count($social_mast->where('fy_id',$fy->id)->where('com_id',$user->id)))
                                                    @if($social_mast->where('fy_id',$fy->id)->where('com_id',$user->id)->first()->status=='S')
                                                        <td class="text-center">
                                                            <a class="btn btn-warning btn-sm"
                                                                href="{{ route('user.social.create', ['com_id' => encrypt($user->id),'fy_id'=> encrypt($fy->id)] ) }}"> View</a>
                                                        </td>
                                                    @else
                                                        <td class="text-center">
                                                            <a class="btn btn-success btn-sm"
                                                                href="{{ route('user.social.edit', encrypt($social_mast->id) ) }}"> Edit</a>
                                                        </td>
                                                    @endif
                                                @else
                                                    <td class="text-center">
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('user.social.create', encrypt($fy->id)) }}"> Create</a>
                                                    </td>
                                                    
                                                @endif --}}
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
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
