@extends('layouts.admin.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/apps.css') }}">
<style>
    #table{
        width:inherit !important;
    }
</style>
@endpush


@section('title')
Applications - Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-md-0 offset-md-1">
        <span  style="color:#DC3545;font-size:20px"> <b> Application Name : </b> </span>
    </div>
    <div class="col-md-0" style="font-size:20px">{{$apps->user->name}}</div>
</div>
<div class="row">
    <div class="col-md-0 offset-md-1">
        <span style="color:#DC3545;font-size:20px"> <b> Application Number : </b></span>
    </div>
    <div class="col-md-0" style="font-size:20px">{{$apps->app_no}}</div>
    {{-- {{dd($apps->id)}} --}}
    <div class="col-md-12 float-right">
        
        <span style="color:#DC3545;font-size:20px">
            <a href="{{route('admin.applications.upload', $apps->id)  }}"
            class="btn btn-info text-white btn-sm float-right  p-2">Upload Document</a></span>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
       <div class="card border-primary">
            <div class="card-header bg-gradient-info">
                Documents
            </div>
            <div class="card-body py-0 px-0">
                <div class="table-responsive p-0 m-0">
                    <table class="table table-sm table-bordered table-hover uploadTable">
                        <thead>
                            <tr class="table-primary">
                                <th class="w-45 text-center">Type</th>
                                <th class="w-10 text-center">Name</th>
                                <th class="w-30 text-center">Date</th>
                                <th class="w-5 text-center">Remark</th>
                                <th class="w-5 text-center">View</th>
                            </tr>
                        </thead>
                        <tbody class="applicant-uploads">
                            {{-- ///{{dd($contents,$docids,$docs)}} --}}
                            @foreach($contents as $key=>$content)
                            <tr>
                            <td>{{$content->doc_name}}</td>
                            <td>{{$content->file_name}}</td>
                            <td>{{$content->created_at}}</td>
                            <td>{{$content->remarks}}</td>
                            <td> @if(in_array($content->id, $docids))
                                @foreach($docs as $key=>$doc)
                                @if($key == $content->id)
                                <a href="{{$doc}}" target="_blank" download="{{ $doc_names[$content->id] }}" download="{{ $doc_names[$content->id] }}"
                                    class="btn btn-info text-white btn-sm float-centre">
                                    View</a>
                                @endif
                                @endforeach
                                @else
                                <i class="fas fa-times-circle text-danger"></i>
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

<div class="row pb-2">
    <div class="col-md-2 offset-md-0">
        <a href="{{ route('admin.apps.index') }} "
            class="btn btn-info text-white btn-sm form-control form-control-sm">
            <i class="fas fa-angle-double-left"></i>Back </a>
    </div>
</div>
@endsection