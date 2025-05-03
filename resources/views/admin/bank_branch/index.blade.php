@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('content')
    <div class="container-fluid">

    @section('css')
        @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
    @endsection

    <div class="row">
        <div class="col-md-12 p-0">
            <div class="card border-primary mt-4">
                <div class="card card-success card-outline shadow p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 textcolor">List of Branches</h5>
                        <div class="dropdown">
                            <a class="dropdown-toggle textcolor text-decoration-none" href="#" role="button"
                                id="branchMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-bank activetext"></i> Manage Branches
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="branchMenu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.bank_branch.addbranch') }}">
                                        <i class="mdi mdi-plus"></i> Add Branch
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.bank_branch_bulk.create') }}">
                                        <i class="mdi mdi-upload-multiple"></i> Bulk Upload
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="branchTable" class="table table-sm table-striped table-hover w-100">
                            <thead>
                                <tr class="tablebgcolor text-center border" style="font-size: 0.7rem; height: 40px;">
                                    <th class="textcolor border" style="text-align: center; vertical-align: middle;width: 60px;">SL.No</th>
                                    <th class="textcolor" style="text-align: center; vertical-align: middle;">Branch
                                        Name</th>
                                    <th class="textcolor border" style="text-align: center; vertical-align: middle;">Email</th>
                                    <th class="textcolor" style="text-align: center; vertical-align: middle;">IFSC Code
                                    </th>
                                    <th class="textcolor border" style="text-align: center; vertical-align: middle;width: 75px;">Pincode
                                    </th>
                                    <th class="textcolor" style="text-align: center; vertical-align: middle;width: 75px;">Contact
                                        Person</th>
                                    <th class="textcolor border" style="text-align: center; vertical-align: middle;">
                                        Designation</th>
                                    <!-- <th class="textcolor" style="text-align: center; vertical-align: middle;">Mobile
                                    </th> -->
                                    <th class="textcolor border" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Status
                                    </th>
                                    <th class="textcolor border" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Created At
                                    </th>
                                    <th class="textcolor border" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Updated At
                                    </th>
                                    <th class="textcolor" style="text-align: center; vertical-align: middle;">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($branch_details) > 0)
                                    @foreach ($branch_details as $key => $bank)
                                        <tr>
                                            <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{ $key + 1 }}</td>
                                            <td class="text-center align-middle shadow-none textcolor" style="font-size:0.8rem;">{{ $bank->name }}</td>
                                            <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{ $bank->email }}</td>
                                            <td class="text-center align-middle shadow-none textcolor" style="font-size:0.8rem;">{{ $bank->ifsc_code }}
                                            </td>
                                            <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{ $bank->pincode }}</td>
                                            <td class="text-center align-middle shadow-none textcolor" style="font-size:0.8rem;">
                                                {{ $bank->contact_person ?? '--' }}</td>
                                            <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">
                                                {{ $bank->designation ?? '--' }}</td>
                                            <!-- <td class="text-center align-middle shadow-none textcolor" style="font-size:0.8rem;">
                                                {{ $bank->mobile ?? '--' }}</td> -->
                                            <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.9rem;">
                                                @if ($bank->isactive == 'Y')
                                                    <span class="badge activebg activetext p-2">Active</span>
                                                @elseif($bank->isactive == 'N')
                                                    <span class="badge bg-warning">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">
                                            {{ $bank->created_at ?? '--' }}</td>
                                            <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">
                                            {{ $bank->updated_at ?? '--' }}</td>
                                            <td class="text-center align-middle border shadow-none" style="font-size:0.8rem;">
                                                <div class="dropdown">
                                                    <button class="btn border dropdown-toggle" type="button"
                                                        id="actionMenu{{ $bank->id }}" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v activetext"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="actionMenu">
                                                        @if ($bank->status == 'S')
                                                            <li>
                                                                <a class="dropdown-item text-warning"
                                                                    href="{{ route('admin.bank_branch.view', ['id' => encrypt($bank->id)]) }}">
                                                                    <i class="fa fa-eye"></i> View
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a class="dropdown-item text-success"
                                                                href="{{ route('admin.bank_branch.edit', ['id' => encrypt($bank->id)]) }}">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                        </li>
                                                        @if ($bank->isactive == 'Y')
                                                            <li>
                                                                <a class="dropdown-item text-danger"
                                                                    href="{{ route('admin.new_admin.bank.deactivate', ['id' => encrypt($bank->id)]) }}">
                                                                    <i class="fa fa-toggle-off"></i> Deactivate
                                                                </a>
                                                            </li>
                                                        @elseif($bank->isactive == 'N')
                                                            <li>
                                                                <a class="dropdown-item text-success"
                                                                    href="{{ route('admin.new_admin.bank.activate', ['id' => encrypt($bank->id)]) }}">
                                                                    <i class="fa fa-toggle-on"></i> Activate
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="10"><b>No data found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/dashboard-4.init.js', 'resources/js/pages/datatables.init.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to check if column counts match
            function checkColumnCount() {
                var headerColumnCount = $('#branchTable thead tr th').length;
                var bodyColumnCount = $('#branchTable tbody tr:first td').length;
                return headerColumnCount === bodyColumnCount;
            }

            // Check if DataTable is already initialized
            if (!$.fn.dataTable.isDataTable('#branchTable')) {
                // Verify that the column count matches
                if (checkColumnCount()) {
                    // Initialize DataTable with all features
                    var table = $('#branchTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'copy',
                                className: 'btn btn-secondary me-1',
                                text: '<i class="fa fa-copy"></i> Copy'
                            },
                            {
                                extend: 'csv',
                                className: 'btn btn-secondary me-1',
                                text: '<i class="fa fa-file-csv"></i> CSV'
                            },
                            {
                                extend: 'print',
                                className: 'btn btn-secondary me-1',
                                text: '<i class="fa fa-print"></i> Print'
                            }
                        ],
                        responsive: true,
                        processing: true,
                        pageLength: 10,
                        lengthChange: false,
                        searching: true,
                        ordering: true,
                        info: true,
                        paging: true,
                        order: [[8, 'desc']],
                        columnDefs: [
                            { 
                                targets: -1, // Last column (Action)
                                orderable: false // Disable sorting
                            }
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search...",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                            infoEmpty: "No matching records found",
                            infoFiltered: "(filtered from _MAX_ total entries)",
                            paginate: {
                                first: "First",
                                last: "Last",
                                next: "Next",
                                previous: "Previous"
                            },
                            zeroRecords: "No matching records found"
                        },
                        drawCallback: function(settings) {
                            var api = this.api();
                            var pageInfo = api.page.info();
                            
                            // Hide pagination if no results or only one page
                            if (pageInfo.recordsDisplay <= pageInfo.length) {
                                $(this).parent().find('.dataTables_paginate').hide();
                            } else {
                                $(this).parent().find('.dataTables_paginate').show();
                            }
                        }
                    });

                    // Add custom styling to the search input
                    $('.dataTables_filter input')
                        .addClass('form-control')
                        .css({
                            'width': '250px',
                            'display': 'inline-block',
                            'margin-left': '10px'
                        });

                    // Add custom styling to the buttons
                    $('.dt-buttons')
                        .addClass('mb-2')
                        .css({
                            'display': 'inline-block',
                            'margin-right': '20px'
                        });
                } else {
                    console.error("DataTable Error: Column count mismatch between header and rows.");
                }
            }
        });
    </script>
@endsection
