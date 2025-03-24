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
                                            <th>Sr No</th>
                                            <th>Company Name</th>
                                            <th>Sector</th>
                                            {{-- <th>PAN</th> --}}
                                            <th>FY</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($company_list)
                                            @foreach ($company_list as $key => $list)
                                                <tr>
                                                    <td class="text-center" style="font-size:1rem;">{{ $key + 1 }}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$list->name}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$list->sector}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$list->fy}}</td>
                                                    {{-- <td class="text-center" style="font-size:1rem;">{{$list->pan ? $list->pan : '--'}}</td> --}}
                                                    {{-- <td class="text-center" style="font-size:1rem;">{{$list->email}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$list->mobile}}</td> --}}
                                                    <td class="text-center">
                                                        @if ($list->status == 'S')
                                                            <span class="text-success" style="font-size:1rem;"><b>Submitted</b></span>
                                                        @elseif($list->status == 'D')
                                                            <span class="text-warning" style="font-size:1rem;"><b>Draft</b></span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($list->status == 'S')
                                                            <a href="{{route('admin.user.company_view',['com_id' => encrypt($list->com_id),'fy_id'=> encrypt($list->fy_id)])}}" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-eye"></i>View</a>
                                                        {{-- @elseif($user->status == 'D')
                                                            <a href="{{route('admin.user.edituser',['id' => encrypt($user->id)])}}" class="btn btn-success btn-sm">
                                                                <i class="fa fa-edit"></i>Edit</a> --}}
                                                        @endif
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
    </script>
@endpush
