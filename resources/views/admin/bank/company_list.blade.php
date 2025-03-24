@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           {{ $error }}
        </div>
        @endforeach

    @endif

  @if(session('success'))
   
<div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       {{ session('success') }}
    </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
           {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            {{-- <a class="btn btn-default" href="{{ route('admin.new_admin.create') }}"> Create New Bank </a> --}}
            <div class="card border-primary mt-4">
                <div class="card card-success card-outline shadow p-1">
                   <h5 class="card-title">Companies List</h5>
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
                                            <th>Email</th>
                                            <th>Contact Person</th>
                                            <th>Designation</th>
                                            <th>Mobile</th>
                                            {{-- <th>Status</th>
                                            <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($bank_details)}} --}}
                                        @if ($comp)
                                            @foreach ($comp as $key => $val)
                                                <tr>
                                                    <td class="text-center" style="font-size:1rem;">{{ $key + 1 }}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$val->name}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$val->email}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$val->contact_person ? $val->contact_person : '--'}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$val->designation ? $val->designation : '--'}}</td>
                                                    <td class="text-center" style="font-size:1rem;">{{$val->mobile ? $val->mobile : '--'}}</td>
                                                    {{-- <td class="text-center" style="font-size:1rem;">{{$val->status ? $val->status : '--'}}</td> --}}
                                                    {{-- <td class="text-center">
                                                        @if ($val->status == 'S')
                                                            <span class="text-success" style="font-size:1rem;"><b>Created</b></span>
                                                        @elseif($val->status == 'D')
                                                            <span class="text-warning" style="font-size:1rem;"><b>Draft</b></span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($val->status == 'S')
                                                            <a href="{{route('admin.user.viewuser',['id' => encrypt($val->id)])}}" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-eye"></i>View</a>
                                                        @elseif($val->status == 'D')
                                                            <a href="{{route('admin.user.edituser',['id' => encrypt($val->id)])}}" class="btn btn-success btn-sm">
                                                                <i class="fa fa-edit"></i>Edit</a>
                                                        @endif
                                                    </td> --}}
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