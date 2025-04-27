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
                <div class="user-add-sec">
                 <form action="{{ route('admin.user.apidata') }}" id="user_create" role="form" method="get"
                    class='prevent_multiple_submit_details' files=true enctype='multipart/form-data' accept-charset="utf-8">                    @csrf
                   
                        <div class="card border-primary">
                            <div class="card-body m-4">

                                             <div class="row" style="margin-top:10px">
                            <div class="col-12 ">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                            </div>
                        </div>
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th rowspan="2" class="company-head">PAN of the Customer</th>
                                            <td rowspan="2">
                                                <input type="text" id="pan" name="pan" class="form-control">
                                                @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-right" rowspan="2">
                                                <button type="submit" id="details" class="btn company-btn btn-primary btn-sm form-control form-control-sm">
                                                    <em class="fa fa-search"></em>&nbsp;&nbsp; Get Details
                                                </button>
                               
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                </form>
                                <div id="det">
                                    
                                </div>
                                <!-- <div class="offset-md-4" id=""><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div> -->
                            </div>
                        </div>
                    {{-- </div> --}}

                <div class="middle-sec"> Or </div>

                <div class="card border-primary m-3 file-upload-sec">
                                     <div class="row" style="margin-top: 2vh;margin-right: 5vh;margin-bottom: 2vh; text-align:right;">
                       
                             <div class="col-md-12">
                                  <a href="{{ asset('csv_sample/corp_upload_Sample.csv') }}">Sample CSV file </a>
                             </div></div>
                    <div class="card-body m-4">
                                      <form action="{{ route('admin.company_bulk.corp.store') }}"  role="form" method="post"    class='prevent_multiple_submit-upload' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th rowspan="2" class="company-head">Bulk Upload Data</th>
                                    <td rowspan="2">
                                        <div class="file-drop-area">
                                        <span class="file-btn"> Upload Data</span>
                                        <span class="file-msg">or drag and drop files here</span>
                                        <input type="file" id="files" name="files" class="form-control file-input">
                                        </div>
                                            @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
             
                                    </td>
                                    <td class="text-right" rowspan="2">

                                        <input type="hidden" id="file pan" name="pan" class="form-control" />
                                        <button type="submit" id="submit-upload" class="btn btn-2 company-btn btn-primary btn-sm form-control form-control-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"/></svg>Upload
                                        </button>
                                
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user_create') !!} --}}
    <!-- @include('partials.js.prevent_multiple_submit') -->

        <script>

$(document).ready(function () {

const btn1 = document.getElementById("details");

$('.prevent_multiple_submit_details').on('submit', function(event) {
    //event.preventDefault(); 
    
    $('#det').html('<div class="offset-md-4 msg1"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>');

    btn1.disabled = true;
    setTimeout(function() {
        btn1.disabled = false;
    }, 1000 * 20);  // 20 seconds

    // Hide the loading message after 20 seconds
    setTimeout(function() {
        $(".msg1").fadeOut();
    }, 1000 * 20);  // 20 seconds
});


    


    const btn = document.getElementById("submit-upload");
        $('.prevent_multiple_submit-upload').on('submit', function() {
            $( ".prevent_multiple_submit-upload" ).parent().append('<div class="offset-md-4 msg"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>');

            btn.disabled = true;
            setTimeout(function(){btn.disabled = false;}, (1000*20));
            setTimeout(function(){$( ".msg" ).hide()}, (1000*20));
            });

     });


    </script>

@endpush
