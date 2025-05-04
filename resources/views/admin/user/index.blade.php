@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">


@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

     <div class="row">
        <div class="col-md-12 p-0">
            <div class="card border-primary mt-3">
                <div class="card card-success card-outline textcolor shadow p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Exposure List</h5>
                        <div class="dropdown">
                            <a class="dropdown-toggle text-dark text-decoration-none" href="#" role="button"
                                id="branchMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-bank activetext"></i> Manage Exposure
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="branchMenu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.adduser') }}">
                                        <i class="mdi mdi-plus"></i> Add Exposure
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.user.bulk.company.create') }}">
                                        <i class="mdi mdi-upload-multiple"></i> Bulk Upload
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
           <div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="companyTable" class="table table-sm table-striped">
                    <thead>
                        <tr class="tablebgcolor text-center" style="font-size: 0.8rem; height: 40px;">
                            <th class="border textcolor" style="padding: 8px 18px 8px 5px; text-align: center; vertical-align: middle; width: 40px;">Sr. No</th>
                            <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Company Name</th>
                            <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle; width: 135px;">Company Type</th>
                            <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Sector</th>
                            <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">PAN</th>
                            <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Unique Login ID</th>
                            

                            <th class="border textcolor" style="padding: 8px 10px 8px 5px; text-align: center; vertical-align: middle; width: 60px;">Status</th>
                            <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Created At</th>
                            <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Updated At</th>
                            <th class="border textcolor" style="padding: 8px 15px 8px 5px; text-align: center; vertical-align: middle;width: 60px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($corp_detail)
                            @foreach ($corp_detail as $key => $user)
                                <tr>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{ $key + 1 }}</td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;"><a href="{{route('admin.user.home',['id' => encrypt($user->id)])}}">{{$user->name}} </a></td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{$user->comp_type}}</td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{$user->sector}}

                                    @php
                                    $sectorclass = ($user->sector_id == 21) ? $user->sector_name : '';
                                    @endphp
                                    @if($sectorclass)
                                    ({{$sectorclass}})
                                    @endif
                                    </td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{$user->pan ? $user->pan : '--'}}</td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{$user->unique_login_id ? $user->unique_login_id : '--'}}</td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">
                                        @if ($user->status == 'S')
                                            <span class="text-success"><b>Created</b></span>
                                        @elseif($user->status == 'D')
                                            <span class="text-warning"><b>Draft</b></span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{$user->created_at}}</td>
                                    <td class="text-center align-middle border shadow-none textcolor" style="font-size:0.8rem;">{{$user->updated_at}}</td>
                                    <td class="text-center shadow-none" style="font-size:0.8rem;">
                                        @if($user->created_by == Auth::user()->id)
                                            <a href="{{route('admin.user.edituser',['id' => encrypt($user->id)])}}" class="btn btn-primary activeeditbg activebg activetext p-2 Custom-btn-edit btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        @else
                                            <a href="{{route('admin.user.existuser_edit',['id' => encrypt($user->id)])}}" class="btn Custom-btn-edit btn-sm activeeditbg activebg activetext p-2 btn-primary">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8">No data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('script')
    @vite(['resources/js/pages/datatables.init.js'])
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
    $(document).ready(function() {

        function checkColumnCount() {
            var headerColumnCount = $('#companyTable thead tr th').length;
            var bodyColumnCount = $('#companyTable tbody tr:first td').length;
            return headerColumnCount === bodyColumnCount;
        }


        if (!$.fn.dataTable.isDataTable('#companyTable')) {

            if (checkColumnCount()) {

                $('#companyTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true
                });
            } else {

                console.error("DataTable Error: Column count mismatch between header and rows.");
            }
        }
    });
</script>




@endsection
