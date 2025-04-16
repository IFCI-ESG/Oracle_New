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
<div class="row pb-3">
    <div class="col-md-0 offset-md-1">
        <span  style="color:#DC3545;font-size:20px"> <b> Application Name : </b> </span>
    </div>
    <div class="col-md-0" style="font-size:20px">{{$apps->user->name}}</div>
</div>
<form action={{ route('admin.applications.savedoc') }} id="ci-create" role="form" method="post"
    class='form-horizontal' files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-gradient-info">
                    Upload Documents
                </div>
                <div class="card-body py-0 px-0">
                    <div class="table-responsive p-0 m-0">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr class="table-primary">
                                    <th class="w-5 text-center">Sec#</th>
                                    <th class="w-40 text-center">Document Name</th>
                                    <th class="w-5 text-center">Date</th>
                                    <th class="w-30 text-center">Upload</th>
                                    <th class="w-20 text-center">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($doc as $doc) --}}
                                    <tr>
                                        
                                        <input type="hidden"  name="id" class="form-control form-control-sm" value="{{$apps->id}}">
                                        <td>1</td>
                                        <td><select id="filetype" name="filetype" class="form-control form-control-sm" onchange="file_select(this.value)" >
                                            <option value="" selected="selected">Please choose..</option>
                                            @foreach($doc as  $doc)
                                                <option value="{{ $doc->doc_type }}" >{{ $doc->doc_name }}</option>
                                            @endforeach
                                        </select></td>
                                        <td><input type="date" name="docDate" > </td>
                                        <td><input type="file" id="doc_type" name="" 
                                            class="form-control form-control-sm valid"></td>
                                        <td><input type="text" class="form-control form-control-sm valid" 
                                            id="remarks" name="remarks"></td>
                                    </tr>
                                {{-- @endforeach --}}
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-2">
        <div class="col-md-2 offset-md-0">
            <a href={{ route('admin.applications.document', $apps->id) }} 
                class="btn btn-info text-white btn-sm form-control form-control-sm">
                <i class="fas fa-angle-double-left"></i>Back </a>
        </div>
        <div class="col-md-2 offset-md-3">
            <button type="submit" class="btn btn-primary btn-sm form-control form-control-sm submitshareper" id="submitshareper"><i
                    class="fas fa-save"></i>
                Save </button>
        </div>
        
    </div>

</form> 
@endsection
@push('scripts')
<script>
    function file_select(file_val){ 
        var filetype = document.getElementById('doc_type');
        filetype.name=file_val;
        return false;
    }
</script>

{!! JsValidator::formRequest('App\Http\Requests\Admin\EditUploads','#ci-create') !!}
@endpush