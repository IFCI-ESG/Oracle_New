@extends('layouts.admin.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush


@section('title')
Users - Dashboard
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
                        <a href="{{ route('admin.users.export') }}"
                            class="btn btn-sm btn-block btn-primary text-white">Excel</a>
                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered table-hover" id="users">
                        <thead class="userstable-head">
                            <tr class="table-info">
                                <th rowspan="2" class="text-center">Sr No</th>
                                <th rowspan="2" class="text-center">Applicant Name</th>
                                <th rowspan="2" class="text-center">Application No</th>
                                
                                <th rowspan="2" class="text-center">Target Segment</th>
                                <th rowspan="2" class="text-center">Submitted Date</th>
                                <th colspan="2" class="text-center">Acknowledgent</th>
                                
                            </tr>
                            <tr class="table-info">
                               
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="userstable-body">
                           @foreach($apps as $app)
                          
                            <tr>
                                <td class="text-center">{{ $app->sno }}</td>
                            <td class="text-center">@foreach($user as $use) @if($use->id==$app->created_by) {{ $use->name }} @endif @endforeach</td>
                                <td class="text-center">{{ $app->app_no }}</td>
                            
                                <td class="text-center">@foreach($target_segment as $pro)@if($app->target_segment==$pro->target_id){{ $pro->target_segment }}@endif @endforeach</td>
                                <td class="text-center" data-sort='YYYYMMDD'>{{ $app->submitted_at }}</td>
                            
                                <td class="text-center"><a href="{{ route('admin.acknowledgement.show',$app->id) }}"
                                        class="btn btn-warning btn-sm btn-block"><i class="right fas fa-edit"></i></a>
                                </td>
                            </tr>
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
    $(document).ready(function () {
        $('#users').DataTable({
            "order": [
                [0, "asc"]
            ],
            "columns": [
                null,
                null,
                null,
                null,
               
                
                {
                    "type": "date"
                },
               
                null,
            ],
            "language": {
                "search": 'Enter any value for <span class="text-danger">LIVE</span> Search <i class="fa fa-search"></i>',
                "searchPlaceholder": "search",
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            }
        });
    });

</script>
@endpush
