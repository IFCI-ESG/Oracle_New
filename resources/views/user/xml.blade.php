@extends('layouts.user.dashboard-master')
@section('title')
    Financial Year
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
    {{-- ContentStarts --}}
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('user.xml_store') }}" id="user_create" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-primary m-2">
                        <div class="card-body mt-4">
                            <table class="table table-sm table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        {{-- <th width="500px">PAN</th> --}}
                                        <td><input type="file" id="pan" name="pan"
                                                class="form-control form-control-sm" style="width:50%">
                                            @error('pan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="submit" id="submit"
                                                class="btn btn-primary btn-sm form-control form-control-sm">
                                                <em class="fas fa-save"></em> Fetch Details
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
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit') --}}
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
