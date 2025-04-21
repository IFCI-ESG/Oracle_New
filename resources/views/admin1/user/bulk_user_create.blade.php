@extends('layouts.admin.master')
@section('title')
    Add Bank
@endsection

@section('content')

    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.company_bulk.store') }}"  role="form" method="post"    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-success m-2">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Borrowers Bulk Uploads</b>
                        </div>



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

                        <div class="row" style="margin-top: 2vh;margin-right: 5vh;margin-bottom: 2vh; text-align:right;">
                       
                             <div class="col-md-12">
                                  <a href="{{ asset('csv_sample/Branch_upload_sample.csv') }}">Sample CSV file </a>
                             </div></div>


                         <div class="row" style="padding: 5vh;">
                            <div class="col-md-4"><label>Upload Borrowers Data</label></div>
                             <div class="col-md-4">
                                  <input type="file" id=""  name="files"  class="form-control form-control-sm text-right" >
                             </div>
                             <div class="col-md-4">
                                 <button type="submit" id="submit"
                                class="btn btn-primary btn-mb form-control form-control-sm form-control form-control-sm-sm" style=" margin:auto;display:block;width: auto;">
                                <em class="fas fa-save"> </em> Upload
                            </button>
                             </div>
                    
                        </div>
                        <div class="row">
                        <div class="col-md-2 offset-md-5">
                            
                        </div>
                    </div>
                    </div>
                    <br>
                  
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\BankRequest', '#bankDetails_create') !!}
    @include('partials.js.prevent_multiple_submit')

@endpush
