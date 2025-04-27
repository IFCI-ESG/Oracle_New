@extends('layouts.admin.master')
@section('title')
    Add User
@endsection
@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
    <style>
        input[type="file"] {
            padding: 1px;
        }
    </style>
@endpush
@section('content')
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.user.apidata') }}" id="user_create" role="form" method="get"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    {{-- <div class="card border-primary m-2"> --}}
                        {{-- <div class="card card-success card-outline shadow p-1">
                            <b>User Details</b>
                        </div> --}}
                        <div class="card border-primary m-2">
                            <div class="card-body mt-4">
                                <table class="table table-sm table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th width="300px">PAN of the Company</th>
                                            <td><input type="text" id="pan" name="pan"
                                                    class="form-control form-control-sm" style="width:50%">
                                                @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <button type="submit" id="submit" style="height: 30px; width: 170px;"
                                                    class="btn btn-primary btn-sm form-control form-control-sm">
                                                    <em class="fa fa-search"></em>&nbsp;&nbsp; Get Details
                                                </button>
                                                {{-- <a href="{{route('admin.user.apidata',$claimMast->id)}}"
                                                    class="btn btn-warning btn-sm btn-block  float-right col-2 mr-2">
                                                    Shareholding <i class="fas fa-arrow-right"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    {{-- </div> --}}
                </form>


            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user_create') !!} --}}
    @include('partials.js.prevent_multiple_submit')
    <script>
        // $(document).ready(function() {
        //     $('#apiData').on('click', function() {
        //         alert('d');
        //         $.ajax({
        //             url: '../user/apidata/', // Replace with your API endpoint
        //             type: 'GET', // HTTP method (GET, POST, etc.)
        //             dataType: 'json', // The type of data that you're expecting back from the server
        //             success: function(response) {
        //                 // Handle success
        //                 $('#result').html(JSON.stringify(response));
        //             },
        //             error: function(xhr, status, error) {
        //                 // Handle error
        //                 console.error('Error: ' + error);
        //                 $('#result').html('An error occurred');
        //             }
        //         });
        //     });
        // });
    </script>
@endpush
