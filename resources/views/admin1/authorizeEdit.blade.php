@extends('layouts.admin.master')
@section('title')
Applicant - {{ $userDetails->name }}@endsection
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
        <div class="row">
            <div class="col-md-2 offset-md-10">
                <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-sm btn-block">
                    <i class="fas fa-angle-double-left"></i> Back</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('admin.users.update_authorised_signatory',$userDetails->id) }}" id="Auth_edit" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    @method('PATCH') 
                    <input type="hidden" name="user_id" value="{{ $userDetails->id }}">
                    <div class="card border-primary">
                        <div class="card-header bg-gradient-info p-1">
                            <b>Authorized Signatory</b>
                        </div>
                       
                            <div class="card-body mt-4">
                                <table class="table table mt-3">

                                    <tbody class="">
                                        <tr>
                                            <th>Authorized Signatory Name</th>
                                            <td class="text-center pt-2"><input type="text" id="name" name="name"
                                                    class="form-control form-control-sm" value="{{$userDetails->contact_person}}"></td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td class="text-center pt-2"><input type="text" id="designation"
                                                    name="designation" class="form-control form-control-sm" value="{{$userDetails->designation}}"></td>
                                        </tr>
                                        <tr>
                                            <th>Contact No.</th>
                                            <td class="text-center pt-2">
                                                <input type="text" id="" name="contact" class="form-control form-control-sm" value="{{$userDetails->mobile}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email Id</th>
                                            <td class="text-center pt-2"><input type="text" id="email" name="email"
                                                    class="form-control form-control-sm" value="{{$userDetails->email}}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>

                    <div class="row pb-3">
                       
                        <div class="col-md-2 offset-md-5">
                            <button type="submit" id="submit"
                                class="btn btn-primary btn-sm form-control form-control-sm form-control form-control-sm-sm">
                                Update
                            </button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\AuthSignRequest', '#Auth_edit') !!}
    @include('user.partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
