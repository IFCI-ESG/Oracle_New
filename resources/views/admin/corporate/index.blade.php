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
                        <h5 class="card-title mb-0">List of Corporates</h5>
                        {{-- <a href="{{ route('admin.corp_admin.create') }}"
                            class="d-flex justify-content-between align-items-center">
                            <i class="mdi mdi-image-plus"></i> Add Bank
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-sm table-striped table-hover">
                                    <thead>
                                        <tr class="table-dark text-center" style="font-size: 0.8rem; height: 40px;">
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Sr.No.</th>
                                            <th style="padding: 8px 5px; text-align: center; vertical-align: middle;">
                                                Corporate Name</th>
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
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($bank_details)}} --}}
                                        @if ($corp_details)
                                            @foreach ($corp_details as $key => $corp)
                                                <tr>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $key + 1 }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $corp->name }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $corp->email }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $corp->contact_person ? $corp->contact_person : '--' }}</td>
                                                    <td class="text-center" style="font-size:0.8rem;">
                                                        {{ $corp->designation ? $corp->designation : '--' }}</td>
                                                    <td class="text-center" style="font-size:0.8rem ;">
                                                        {{ $corp->mobile ? $corp->mobile : '--' }}</td>

                                                    <td class="text-center">
                                                        @if ($corp->isactive == 'Y')
                                                            <span class="badge text-bg-success"
                                                                style="background-color: #E5F5E5; color: #28A745; font-size: 0.8rem; padding: 3px 8px; border-radius: 4px;">Active</span>
                                                        @elseif($corp->isactive == 'N' || is_null($corp->isactive))
                                                            <span class="badge text-bg-warning"
                                                                style="background-color: #FFF4E5; color: #FFA500; font-size: 0.8rem; padding: 3px 8px; border-radius: 4px;">
                                                                Inactive
                                                            </span>
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button class="btn btn-light dropdown-toggle" type="button"
                                                                id="actionMenu" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="actionMenu">
                                                                @if ($corp->status == 'S')
                                                                    <li>
                                                                        <a class="dropdown-item text-warning"
                                                                            href="{{ route('admin.corp_admin.view', ['id' => encrypt($corp->id)]) }}">
                                                                            <i class="fa fa-eye"></i> View
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <a class="dropdown-item text-success"
                                                                        href="{{ route('admin.corp_admin.edit', ['id' => encrypt($corp->id)]) }}">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </a>
                                                                </li>
                                                                @if ($corp->isactive == 'Y')
                                                                    <li>
                                                                        <a class="dropdown-item text-danger"
                                                                            href="{{ route('admin.new_admin.bank.deactivate', ['id' => encrypt($corp->id)]) }}">
                                                                            <i class="fa fa-toggle-off"></i> Deactivate
                                                                        </a>
                                                                    </li>
                                                                @elseif($corp->isactive == 'N')
                                                                    <li>
                                                                        <a class="dropdown-item text-success"
                                                                            href="{{ route('admin.new_admin.bank.activate', ['id' => encrypt($corp->id)]) }}">
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
<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true
        });
    });
</script>

@endsection
