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
    <div class="row" >
        <div class="col-lg-8 offset-md-2">
            <div class="card card-success card-outline mt-5 ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                <div class="card-header" style="margin: 4px">
                    <b class="table-heading-sec">Thematic </b>
                </div>
                <div class="card border-primary" style="margin: 4px">
                    <div class="card-body p-1 m-2">
                        <div class="row ">
                            <div class="table-responsive rounded col-md-12">
                                <table class="table table-bordered  table-sm table-striped" id="appTable"
                                    style="width: 100%">
                                    <thead>
                                        <tr class="text-center table-success">
                                            <th class="">Sr. No.</th>
                                            <th class="">Pillars</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pillar_mast as $key=>$p_mast)
                                            <tr>
                                                <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                <td class="text-center" style="font-size: 1rem">
                                                    {{ $p_mast->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($pillar_val->where('pillar_id',$p_mast->id)->isNotEmpty())
                                                        <a class="btn btn-success btn-sm Custom-btn"
                                                            href="{{ route('user.thematic.edit', ['pillar_id' => encrypt($p_mast->id), 'com_id' => encrypt($user->id)]) }}"> Edit</a>
                                                    @else
                                                        <a class="btn btn-primary btn-sm Custom-btn"
                                                                    href="{{ route('user.thematic.pillar', ['pillar_id' => encrypt($p_mast->id)]) }}"> Create</a>
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

                        <div class="row pb-2 mt-2 d-flex align-items-center">
                <div class="col-md-2 ml-4">
                    <a href="{{ route('user.climate') }}"
                    class="btn btn-warning btn-sm float-left Custom-btn"> <i
                        class="fas fa-arrow-left"></i> Back </a>
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



