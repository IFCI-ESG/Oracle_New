@extends('layouts.admin.master')
@section('title')
    Add Borrower
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
                <form action="{{ route('admin.user.signzyapidata') }}" id="getdetails" role="form" method="get"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    {{-- <div class="card border-primary m-2"> --}}
                        {{-- <div class="card card-success card-outline shadow p-1">
                            <b>User Details</b>
                        </div> --}}
                        <div class="card border-primary m-2">
                            <div class="card-body mt-4">
                                <table class="table table-sm table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th style="width: 300px">Number</th>
                                            <td style="width: 300px">
                                                <input type="text" name="caa"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('caa')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <button type="submit" id="getdetails" style="height: 30px; width: 170px;"
                                                    class="btn btn-primary btn-sm form-control form-control-sm">
                                                    <em class="fa fa-search"></em>&nbsp;&nbsp; Get Details
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    {{-- </div> --}}
                </form>


            </div>
        </div>
    </div>
@endsection
@push('scripts')


@endpush
