@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        @include('layouts.shared.page-title' , ['title' => 'Dashboard','subtitle' => 'Dashboards'])
@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel=".h">
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
                            <h2>Environment </h2>
                            {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit repellendus doloribus
                                voluptates quo deleniti ipsum.</p> --}}
                                <br>
                        </div>

                        <div class="col-md-6">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/Carbon-Footprint-Financed-Emission.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    {{-- <h3><a href="#">Dashboard</a></h3> --}}
                                    {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. </p> --}}

                                    <a href="{{ route('user.bank') }}" class="btn dashboard-btn">Carbon Footprint & Financed Emission</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/climate-related.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <a href="{{ route('user.climate') }}" class="btn dashboard-btn">Climate Related Financial Risk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('script')
    @vite(['resources/js/pages/dashboard-4.init.js'])
@endsection

