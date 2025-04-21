@extends('layouts.user.dashboard-master')
@section('title')
    Application
@endsection

@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
@endpush

@section('content')


    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{ route('user.application.create') }}"> Create New Application </a>
            <div class="card border-primary mt-4">
                <div class="card-header text-white bg-primary border-primary pt-1">
                    <span>Application</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="table-primary text-center">
                                            <th>Sr No</th>
                                            <th>Applicant Name</th>
                                            <th>Target Segment</th>
                                            <th>Status</th>
                                            <th>Submitted at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($appMast)
                                            @foreach ($appMast as $key => $app)
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ Auth::user()->name }}</td>
                                                <td class="text-center">{{ $tar_seg->name }}</td>
                                                <td class="text-center">{{ $app->status }}</td>
                                                <td class="text-center">{{ $app->submitted_at }}</td>
                                                <td>
                                                    @if ($app->status == 'S')
                                                        <a href="{{ route('user.application.preview', $app->id) }}"
                                                            class="btn btn-success btn-sm form-control form-control-sm font-weight-bold">
                                                            <i class="fas fa-eye"></i> View</a>
                                                    @else
                                                        <a href="{{ route('user.application.edit', $app->id) }}"
                                                            class="btn btn-warning btn-sm form-control form-control-sm font-weight-bold">
                                                            <i class="fas fa-edit"></i> Edit</a>
                                                    @endif
                                                </td>
                                            @endforeach
                                        @else
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
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
