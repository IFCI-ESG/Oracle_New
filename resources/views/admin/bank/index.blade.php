@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('content')

    <div class="container-fluid">

    @section('css')
        @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
    @endsection

    <div class="row">
        <div class="col-md-12">

            <div class="card border-primary mt-4">
                <div class="card card-success card-outline shadow p-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">List of Banks</h5>
                        <a href="{{ route('admin.new_admin.create') }}"
                            class="d-flex justify-content-between align-items-center">
                            <i class="mdi mdi-image-plus"></i> Add Bank
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Add table control row with buttons and search -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="button-group">
                                    <button id="copy-btn" class="btn btn-secondary btn-sm me-2">Copy</button>
                                    <button id="csv-btn" class="btn btn-secondary btn-sm me-2">CSV</button>
                                    <button id="print-btn" class="btn btn-secondary btn-sm">Print</button>
                                </div>
                                <div class="search-box d-flex align-items-center">
                                    <label for="table-search" class="me-2">Search:</label>
                                    <input type="search" id="table-search" class="form-control form-control-sm" placeholder="">
                                </div>
                            </div>
                            <!-- End table control row -->
                            <div class="table-responsive">
                                <table id="example" class="table table-sm table-striped table-hover">
                                    <thead>
                                        <tr class="table-dark text-center" style="font-size: 0.8rem; height: 40px;">
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                SL.No</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Bank Name</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Email</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Contact Person</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Designation</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Mobile</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Status</th>
                                                <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Created At</th>
                                                <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Updated At</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($bank_details)}} --}}
                                        @if ($bank_details)
                                            @foreach ($bank_details as $key => $bank)
                                                <tr>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $key + 1 }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $bank->name }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $bank->email }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $bank->contact_person ? $bank->contact_person : '--' }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $bank->designation ? $bank->designation : '--' }}</td>
                                                    <td class="text-center" style="font-size:0.8rem ;">
                                                        {{ $bank->mobile ? $bank->mobile : '--' }}</td>

                                                    <td class="text-center">
                                                        @if ($bank->isactive == 'Y')
                                                            <span class="badge text-bg-success"
                                                                style="background-color: #E5F5E5; color: #28A745; font-size: 0.8rem; padding: 3px 8px; border-radius: 4px;">Active</span>
                                                                @elseif($bank->isactive == 'N' || is_null($bank->isactive))
    <span class="badge text-bg-warning"
        style="background-color: #FFF4E5; color: #FFA500; font-size: 0.8rem; padding: 3px 8px; border-radius: 4px;">
        Inactive
    </span>
@endif

                                                    </td>
                                                    <td class="text-center" style="font-size:0.8rem ;">
                                                    {{ $bank->created_at ? $bank->created_at : '--' }}</td>
                                                    <td class="text-center" style="font-size:0.8rem ;">
                                                    {{ $bank->updated_at ? $bank->updated_at : '--' }}</td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button class="btn btn-light dropdown-toggle" type="button"
                                                                id="actionMenu" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="actionMenu">
                                                                @if ($bank->status == 'S')
                                                                    <li>
                                                                        <a class="dropdown-item text-warning"
                                                                            href="{{ route('admin.new_admin.view', ['id' => encrypt($bank->id)]) }}">
                                                                            <i class="fa fa-eye"></i> View
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <a class="dropdown-item text-success"
                                                                        href="{{ route('admin.new_admin.edit', ['id' => encrypt($bank->id)]) }}">
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
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
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
</div>
@section('script')
    @vite(['resources/js/pages/datatables.init.js'])
@endsection

<style>
    .button-group button {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 6px 15px;
        border-radius: 4px;
        font-weight: 400;
        font-size: 14px;
    }
    .search-box label {
        font-weight: normal;
        color: #333;
        font-size: 14px;
        margin-bottom: 0;
    }
    .search-box input {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 6px 12px;
        width: 250px;
        height: 34px;
        font-size: 14px;
    }
    table.dataTable thead th {
        background-color: #343a40;
        color: white;
        padding: 10px 8px;
        font-size: 14px;
        text-align: center;
        vertical-align: middle;
    }
    table.dataTable tbody td {
        padding: 8px;
        font-size: 14px;
        vertical-align: middle;
    }
    table.dataTable tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }
</style>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script>
    $(document).ready(function() {
        // Add custom date sorting function
        $.fn.dataTable.ext.type.order['date-format-pre'] = function(d) {
            if (!d) return 0;
            return moment(d, 'YYYY-MM-DD HH:mm:ss').valueOf();
        };

        // Create hidden DataTable buttons
        var table = $('#example').DataTable({
            dom: 'Brt<"bottom"ip>', // Buttons (hidden), table, info, pagination
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copy',
                    className: 'btn-secondary d-none'
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'btn-secondary d-none'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn-secondary d-none'
                }
            ],
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            columnDefs: [
                { targets: 7, type: 'date-format' }, // Created At column
                { targets: 8, type: 'date-format' }, // Updated At column
                { targets: 9, orderable: false }  // Action column
            ],
            order: [[7, 'desc']] // Default sort by Created At in descending order
        });
        
        // Connect custom search box
        $('#table-search').on('keyup', function() {
            table.search(this.value).draw();
        });
        
        // Connect custom buttons to DataTables buttons
        $('#copy-btn').on('click', function() {
            table.button(0).trigger(); // Trigger first button (copy)
        });
        
        $('#csv-btn').on('click', function() {
            table.button(1).trigger(); // Trigger second button (csv)
        });
        
        $('#print-btn').on('click', function() {
            table.button(2).trigger(); // Trigger third button (print)
        });
    });
</script>

@endsection

