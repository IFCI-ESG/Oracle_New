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
            <a class="btn btn-default" href="{{ route('admin.adduser') }}"> Create New Borrower </a>
            <div class="card border-primary mt-4">
                <div class="card card-success card-outline shadow p-1">
                   <h5 class="card-title">Borrowers</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-sm table-striped table-hover">
                                    <thead>
                                        <tr class="table-dark text-center">
                                            <th>Sr. No</th>
                                            <th>Company Name</th>
                                            <th>Company Type</th>
                                            <th>Sector</th>
                                            <th>PAN</th>
                                            <th>Unique Login ID</th>
                                            {{-- <th>Email</th>
                                            <th>Mobile</th> --}}
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($user_detail)
                                            @foreach ($user_detail as $key => $user)
                                                <tr>
                                                    <td class="text-center" style="font-size:1rem;">{{ $key + 1 }}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$user->name}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$user->comp_type}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$user->sector}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$user->pan ? $user->pan : '--'}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$user->unique_login_id ? $user->unique_login_id : '--'}}</td>
                                                    {{-- <td class="text-center" style="font-size:1rem;">{{$user->email}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$user->mobile}}</td> --}}
                                                    <td class="text-center">
                                                        @if ($user->status == 'S')
                                                            <span class="text-success" style="font-size:1rem;"><b>Created</b></span>
                                                        @elseif($user->status == 'D')
                                                            <span class="text-warning" style="font-size:1rem;"><b>Draft</b></span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- @if ($user->status == 'S')
                                                            <a href="{{route('admin.user.viewuser',['id' => encrypt($user->id)])}}" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-eye"></i>View</a>
                                                        @elseif($user->status == 'D') --}}
                                                            @if($user->created_by==Auth::user()->id)
                                                                <a href="{{route('admin.user.edituser',['id' => encrypt($user->id)])}}" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-edit"></i>Edit</a>
                                                            @else
                                                                <a href="{{route('admin.user.existuser_edit',['id' => encrypt($user->id)])}}" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-edit"></i>Edit</a>
                                                            @endif
                                                            {{-- <a class="btn btn-danger btn-sm" onclick="delButtonId({{$user->id}})">
                                                                <i class="fa fa-trash"></i></a> --}}
                                                        {{-- @endif --}}
                                                    </td>
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

        function delButtonId(id) {
            // alert(id);
            swal({
                    title: "Do You Want to Delete this Company and All the records related to that",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: {
                            text: "Yes",
                            value: "Y",
                        },
                    },
                    dangerMode: true,
                    closeOnClickOutside: false,
                })
                .then((result) => {
                    if (result == 'Y') {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: 'user/delete/' + id ,
                            success: function(data) {
                                // console.log(data);
                                if (data == true) {
                                    swal(
                                        'Deleted!',
                                        'Company has been deleted.',
                                        'success')
                                    window.location.reload();
                                } else {
                                    swal(
                                        'Not Deleted!',
                                        'Company has been Not Deleted.',
                                        'warning')

                                }
                            }
                        })
                    }
                });
            }
    </script>
@endpush
