@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        @include('layouts.shared.page-title' , ['title' => 'Climate Risk','subtitle' => 'Environment'])
@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
    <style>
        input[type="file"] {
            padding: 1px;
        }
    </style>
@endpush
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

    <section class="admin-dashboard admin-dashboard-info">
        <div class="container">

            <div class="row align-items-center">
            {{--
                <div class="col-lg-3">
                    <div div class="dashboard-info-video">
                        <video loop autoplay>
                            <source src="../assets/images/video/Grey and White Clean Course FAQ Mobile Video.mp4"
                                type="video/mp4">
                        </video>
                    </div>
                </div> --}}

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Risk </h2>
                            {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit repellendus doloribus
                                voluptates quo deleniti ipsum.</p> --}}
                                <br>
                        </div>


                        <div class="col-md-6">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../asset/images/dashboard-img/thematic-physical.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    {{-- <a href="{{ route('user.thematic') }}" class="btn dashboard-btn">Thematic </a> --}}
                                    <a href="{{ route('user.physical.index') }}" class="btn dashboard-btn">Physical Risk</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../asset/images/dashboard-img/thematic-transition.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <a href="{{ route('user.transition.index') }}" class="btn dashboard-btn">Transition Risk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row pb-2 mt-2 d-flex align-items-center">
                <div class="col-md-2">
                    <a href="{{ route('user.climate') }}"
                    class="btn btn-warning btn-sm float-left"> <i
                        class="fas fa-arrow-left"></i> Back </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
