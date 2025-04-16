@extends('layouts.admin.master')
@section('title')
    Add Bank
@endsection

@section('content')

    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.company_bulk.store') }}" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-success m-2">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Retail Borrowers Bulk Uploads</b>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-12 ">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
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

                        <div class="row" style="padding: 5vh;">
                            <div class="col-md-3">
                                <label>Upload Borrowers Data</label>
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="" name="files"
                                    class="form-control form-control-sm text-right">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="submit"
                                    class="btn btn-primary btn-mb form-control form-control-sm form-control form-control-sm-sm"
                                    style=" margin:auto;display:block;width: auto;">
                                    <em class="fas fa-save"> </em> Upload
                                </button>
                            </div>

                            <div class="col-md-2">
                                <a href="{{ asset('csv_sample/Branch_upload_sample.csv') }}">Sample CSV file </a>
                            </div>
                        </div>
                    </div>
                    <br>
                </form>
            </div>

            <div class="col-md-8">
                <form action="{{ route('admin.company_bulk.store') }}" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-success m-2">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Corporate Borrowers Bulk Uploads</b>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-12 ">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
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

                        <div class="row" style="padding: 5vh;">
                            <div class="col-md-3">
                                <label>Upload Borrowers Data</label>
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="" name="files"
                                    class="form-control form-control-sm text-right">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="submit"
                                    class="btn btn-primary btn-mb form-control form-control-sm form-control form-control-sm-sm"
                                    style=" margin:auto;display:block;width: auto;">
                                    <em class="fas fa-save"> </em> Upload
                                </button>
                            </div>

                            <div class="col-md-2">
                                <a href="{{ asset('csv_sample/Branch_upload_sample.csv') }}">Sample CSV file </a>
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