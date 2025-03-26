@extends('layouts.admin.master')
@section('title')
    Add User
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
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.user.store') }}" id="user_create" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-primary m-2">
                        <div class="card card-success card-outline shadow p-1">
                            <b>User Details</b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th width="500px">Company Name</th>
                                            <td><input type="text" id="comp_name" name="comp_name"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('comp_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">CIN</th>
                                            <td><input type="text" id="cin" name="cin"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('cin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">Sector</th>
                                            <td>
                                            <select name="sector" id="sector" class="form-control form-control-sm" style="width:50%">
                                                <option value="">Please Select Sector</option>
                                                @foreach ($sector as $sec)
                                                    <option value="{{ $sec->id }}">
                                                        {{ $sec->name }}</option>
                                                @endforeach
                                                @error('sector')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">Zone</th>
                                            <td>
                                            <select name="zone" id="zone" class="form-control form-control-sm" style="width:50%">
                                                <option value="">Please Select Zone</option>
                                                @foreach ($zone as $zo)
                                                    <option value="{{ $zo->zone }}">
                                                        {{ $zo->zone }}</option>
                                                @endforeach
                                                @error('zone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">Password</th>
                                            <td><input type="text" id="password" name="password"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">Authorized Signatory Name</th>
                                            <td><input type="text" id="auth_name" name="auth_name"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('auth_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">Designation</th>
                                            <td><input type="text" id="designation" name="designation"
                                                    class="form-control form-control-sm" style="width:50%">
                                                    @error('designation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">Email</th>
                                            <td><input type="text" id="email" name="email"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="500px">Mobile</th>
                                            <td><input type="text" id="mobile" name="mobile"
                                                    class="form-control form-control-sm" style="width:50%">
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">

                        <div class="col-md-2 offset-md-4">
                            <button type="submit" id="submit"
                                class="btn btn-primary btn-sm form-control form-control-sm form-control form-control-sm-sm">
                                <em class="fas fa-save"></em> Save
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user_create') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
