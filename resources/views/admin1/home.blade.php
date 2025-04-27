@extends('layouts.admin.master')

@section('title')
Admin Dashboard
@endsection

@push('styles')

@endpush

@section('content')

   {{-- bank login Dashboard --}}
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
                            <h2>Embracing ESG Principles with ESG Prakrit ! </h2>
                            {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit repellendus doloribus
                                voluptates quo deleniti ipsum.</p> --}}
                                <br>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/dashboard-img1.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <h3><a href="#">Dashboard</a></h3>
                                    {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. </p> --}}

                                    <a href="{{ route('admin.dash') }}" class="btn dashboard-btn">Dashboard</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/add-borrower1.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <h3><a href="#">Add Borrower</a></h3>
                                    {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p> --}}

                                    <a href="{{ route('admin.user.index') }}" class="btn dashboard-btn">Add Borrower</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/company-listed1.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <h3><a href="#">MIS</a></h3>
                                    {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p> --}}

                                    <a href="{{ route('admin.env_mis') }}" class="btn dashboard-btn">MIS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    {{-- bank login Dashboard  end --}}

    {{-- <div class="row">
        @if(Auth::user()->hasRole('SuperAdmin') && Auth::user()->hasRole('Admin'))
            <iframe title="ESG Staging" width="100%" height="600"
            src="https://app.powerbi.com/view?r=eyJrIjoiOTlmYWY4NzgtMjI2Ny00Y2MxLWE2MGMtYjRjZmNmODA3NGQ5IiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9"
                    frameborder="0" allowFullScreen="true"></iframe>
        @elseif(Auth::user()->hasRole('Admin'))
            <iframe title="ESG Staging" width="100%" height="600"
            src="https://app.powerbi.com/view?r=eyJrIjoiOTlmYWY4NzgtMjI2Ny00Y2MxLWE2MGMtYjRjZmNmODA3NGQ5IiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9"
                    frameborder="0" allowFullScreen="true"></iframe>
        @endif
    </div> --}}

@endsection

@push('scripts')

@endpush
