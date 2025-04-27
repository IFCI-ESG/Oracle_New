@extends('layouts.admin.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('title')
    Users Dashboard
@endsection

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header text-white bg-primary border-primary">
                    <h5>Registered Applicants</h5>
                </div>
                <div class="card-body">
                    {{-- <div class="row">
                    <div class="col-md-1 offset-md-4">
                        <span class="text-danger">Export: </span>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('admin.users.export') }}" class="btn btn-sm btn-block btn-primary text-white">Excel</a>
                    </div>
                </div> --}}
                    <div class="table-responsive pt-2">
                        <table class="table table-sm table-striped table-bordered table-hover" id="users">
                            <thead class="userstable-head">
                                <tr class="table-info">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Organization Name</th>
                                    <th class="text-center">PAN</th>
                                    <th class="text-center">Contact Person</th>
                                    <th class="text-center">email</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Registered At</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    {{-- <th colspan="3" class="text-center">Applicant Login</th> --}}
                                </tr>
                                {{-- <tr class="table-info">
                                <th>Status</th>
                                <th>View</th>
                                <th>Edit<br>Authorised<br>Signatory</th>
                            </tr> --}}
                            </thead>
                            <tbody class="userstable-body">
                                {{-- @php
                                $count = 1
                            @endphp --}}
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->pan }}</td>
                                        <td>{{ $user->contact_person }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td data-sort='YYYYMMDD'>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                        <td class="text-center">
                                            {{-- @if ($user->isapproved == 'Y' && $user->hasRole('Applicant')) --}}
                                            @if ($user->isapproved == 'Y' && $user->hasRole('ActiveUser'))
                                                <span class="text-success"><b>Activated</b></span>
                                            @elseif($user->isapproved == 'N')
                                                <span class="text-danger"><b>De-activated</b></span>
                                            @else
                                                <span><b>Pending</b></span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->hasRole('Admin'))
                                            <td><a href="{{ route('admin.users.preview', $user->id) }}"
                                                    class="btn btn-warning btn-sm btn-block"><i
                                                        class="right fas fa-eye"></i></a>
                                            </td>
                                        @endif

                                        {{-- @else
                                        <td><a href="{{ route('admin.users.edit',$user->id) }}"
                                            class="btn btn-primary btn-sm btn-block"><i class="right fas fa-eye"></i></a>
                                        </td> --}}
                                        @if (Auth::user()->hasRole('Admin'))
                                            <td>
                                                <a href="{{ route('admin.users.edit_authorised_signatory', $user->id) }}"
                                                    class="btn btn-primary btn-sm btn-block"><i
                                                        class="right fas fa-edit"></i></a>
                                            </td>
                                        @endif

                                    </tr>
                                    {{-- @php
                                    $count++
                                @endphp --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // $('#users').DataTable( {
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copyHtml5',
            //         'excelHtml5',
            //         'csvHtml5',
            //         'pdfHtml5'
            //     ]
            // } );
            initialiseTable();
        });

        function initialiseTable() {
            $('#users').DataTable({

                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [0, 'asc']
                ],
                "language": {
                    "search": 'Enter any value for <span class="text-danger">LIVE</span> Search <i class="fa fa-search"></i>',
                    "searchPlaceholder": "search",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
            });
        }
    </script>
@endpush
