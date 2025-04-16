@extends('layouts.admin.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/apps.css') }}">
<style>
#table {
    width: inherit !important;
}
</style>
@endpush


@section('title')
Login Id
@endsection

@section('content')

<form action="{{ route('admin.login.update',$id) }}" id="form_Data" role="form" method="post" class='form-horizontal'
    files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf
    {!! method_field('patch') !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary">
              
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <table class="table table-sm table-striped table-bordered table-hover">
                            <tbody>
                            @foreach ($login as $key => $logins)
                                <tr>
                                    <th class="text-center">Name</th>
                                    <td class="text-center"> <input type="text" name="name"
                                        value="{{$logins->name}}" class="form-control form-control-sm" disabled></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Email Id:</th>
                                    <td class="text-center"> <input type="text" name="email_id"
                                        value="{{$logins->email}}" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Mobile</th>
                                    <td class="text-center"> <input type="number" name="mobile"
                                        value="{{$logins->mobile}}" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Admin Type</th>
                                    <td>
                                        <select class="form-control " name="user_type" id="user_type">
                                        <option value="2" @if($role->role_id==2) selected @endif>Modification + View</option>
                                        <option value="8" @if($role->role_id==8) selected @endif>View Only</option>
                                        </select>
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
    </div>
    <div class="row pb-2">
        <div class="col-md-2 offset-md-0">
            <a href="{{ route('admin.create_id') }}" class="btn btn-warning btn-sm form-control form-control-sm">
                <i class="fas fa-angle-double-left"></i> Back </a>
        </div>
        <div class="col-md-2 offset-md-3">
            <button type="submit" class="btn btn-primary btn-sm form-control form-control-sm submitshareper"
                id="submitshareper"><i class="fas fa-save"></i>
                Save </button>
        </div>

    </div>

</form>
@endsection
@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Admin\LoginRequest', '#form_Data') !!}
@endpush