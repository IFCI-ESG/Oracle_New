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
Login Id
@endsection

@section('content')

<form action="{{ route('admin.login.store') }}" id="form_Data" role="form" method="post"
    class='form-horizontal' files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary">
              
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <table class="table table-sm table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <td class="text-center"> <input type="text" name="name"
                                        value="" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Email Id:</th>
                                    <td class="text-center"> <input type="text" name="email_id"
                                        value="" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Mobile</th>
                                    <td class="text-center"> <input type="number" name="mobile"
                                        value="" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Password</th>
                                    <td class="text-center"> <input type="password" name="password"
                                        value="" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Admin Type</th>
                                    <td>
                                        <select class="form-control " name="user_type" id="user_type">
                                        <option value="">Select</option>
                                        @foreach ($role as $val)
                                            <option value="{{ $val->id }}">@if($val->name == 'Admin') Rights (Modification + View) @else Rights (View Only) @endif</option>
                                        @endforeach
                                        </select>
                                    </td>
                                </tr>
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
            <a href="{{ route('admin.create_id') }}" 
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
{!! JsValidator::formRequest('App\Http\Requests\Admin\LoginRequest', '#form_Data') !!}
@endpush