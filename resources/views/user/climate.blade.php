@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.shared.page-title', ['title' => 'Climate Related Financial Risk', 'subtitle' => 'Environment'])


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
                            <h2>Climate Related Financial Risk </h2>
                            {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit repellendus doloribus
                                voluptates quo deleniti ipsum.</p> --}}
                                <br>
                        </div>


                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../images/dashboard-img/thematic.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <a href="{{ route('user.thematic') }}" class="btn dashboard-btn">Thematic </a>
                                    {{-- <a href="{{ route('user.physical') }}" class="btn dashboard-btn">Physical Risk</a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../images/dashboard-img/risk.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <a href="{{ route('user.risk') }}" class="btn dashboard-btn">Risk</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../images/dashboard-img/opportunity.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <a href="#" class="btn dashboard-btn">Opportunity</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </div>
    @endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
