@extends('layouts.admin.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/apps.css') }}">
@endpush
@section('title')
    Applications - Dashboard
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <br>
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- <div class="row">
        <div class="col-md-1 offset-md-10">
            <span class="text-danger">Export: </span>
        </div>
        <div class="col-md-1">
            <a href="{{ route('admin.applications.export') }}" class="btn btn-sm btn-block btn-primary text-white">Excel</a>
        </div>
    </div> --}}
    <div class="row py-2">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header text-white bg-primary border-primary">
                    <h5>Applicant/Company Details</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered table-hover" id="apps">
                        <thead class="appstable-head">
                            <tr class="table-info">
                                <th class="text-center">Sr No</th>
                                <th class="text-center">Organization Name</th>
                                <th class="text-center">Target Segment</th>
                                <th class="text-center">Application No</th>
                                <th class="text-center">Round</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Submitted At</th>
                                <th class="text-center">View</th>
                                {{-- <th class="text-center">Print</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Document</th> --}}
                            </tr>
                                    {{--
                            <tr class="table-info">
                            <th>View</th>
                            <th>Print</th>
                            </tr>
                            --}}
                        </thead>
                        <tbody class="appstable-body">
                            {{-- {{dd($users)}} --}}
                            @foreach ($users as $key => $user)
                                {{-- @if ($user->status == 'S' || ($user->round == 4 && $user->status == 'D')) --}}
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->target_seg_name }}</td>
                                    <td>{{ $user->app_no }}</td>
                                    <th class="text-center">{{ $user->round }}</th>
                                    <td class="text-center">
                                        @if ($user->status == 'S')
                                            <span class="text-success"><b>SUBMITTED</b></span>
                                        @elseif($user->status == 'D')
                                            <span class="text-primary"><b>DRAFT</b></span>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                                    <td>
                                        @if ($user->status == 'S')
                                            {{ date('d/m/Y', strtotime($user->submitted_at)) }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($user->status == 'S')
                                            <a href="{{ route('admin.applications.preview', ['id' => $user->id]) }}"
                                                class="btn btn-info btn-sm btn-block"><i
                                                    class="right fas fa-eye"></i></a>
                                        @elseif($user->status == 'D')
                                            <a href="#" class="btn btn-info btn-sm btn-block disabled"><i
                                                    class="right fas fa-eye"></i></a>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                            @if ($user->status == 'S')
                                                <a href="{{ route('admin.userlications.print', ['id' => $user->id]) }}"
                                                    class="btn btn-info btn-sm btn-block" target="_blank"><i
                                                        class="fas fa-print"></i></a>
                                            @elseif($user->status == 'D')
                                                <a href="#" class="btn btn-info btn-sm btn-block disabled"><i
                                                        class="fas fa-print"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($user->status == 'S')
                                                <a href="{{ route('admin.userlications.address_edit', ['id' => $user->id]) }}"
                                                    class="btn btn-warning btn-sm btn-block" target="_blank"><i
                                                        class="fas fa-edit"></i></a>
                                            @elseif($user->status == 'D')
                                                <a href="#" class="btn btn-info btn-sm btn-block disabled"><i
                                                        class="fas fa-edit"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($user->status == 'D')
                                                <a href='javascript:void(0)'
                                                    class="btn btn-info  text-white btn-sm btn-block disabled"><i
                                                        class="far fa-file-alt"></i></a>
                                            @elseif($user->status == 'S')
                                                <a href="{{ route('admin.userlications.document', $user->id) }}"
                                                    class="btn btn-info  text-white btn-sm btn-block">
                                                    <i class="far fa-file-alt"></i></a>
                                            @endif
                                        </td> --}}

                                </tr>
                                {{-- @endif --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('admin.partials.applicationfilter')
    {{-- <script>
        $('#apps').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
            ]
        } );
    </script> --}}
@endpush
