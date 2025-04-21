@extends('layouts.admin.master')
@section('title')
    Add User
@endsection

@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-default" href="{{ route('admin.adduser') }}"> Create New User </a>
            <div class="card border-primary mt-4">
                <div class="card card-success card-outline shadow p-1">
                   <h5 class="card-title">User</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-sm table-striped table-hover">
                                    <thead>
                                        <tr class="table-dark text-center">
                                            <th>Sr No</th>
                                            <th>Company Name</th>
                                            {{-- <th>PAN</th> --}}
                                            <th>Unique Login ID</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($user_detail)
                                            @foreach ($user_detail as $key => $user)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td class="text-center">{{$user->name}}</td>
                                                    {{-- <td class="text-center">{{$user->pan ? $user->pan : '--'}}</td> --}}
                                                    <td class="text-center">{{$user->unique_login_id ? $user->unique_login_id : '--'}}</td>
                                                    <td class="text-center">{{$user->email}}</td>
                                                    <td class="text-center">{{$user->mobile}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
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
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@endpush
