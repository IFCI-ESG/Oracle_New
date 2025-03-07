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
                            <h2>Lorem ipsum dolor</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit repellendus doloribus
                                voluptates quo deleniti ipsum.</p>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/dashboard-img1.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <h3><a href="#">Dashboard</a></h3>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. </p>

                                    <a href="#" class="btn dashboard-btn">Dashboard</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/add-borrower1.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <h3><a href="#">Add Borrower</a></h3>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>

                                    <a href="#" class="btn dashboard-btn">Add Borrower</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dashboard-info">
                                <img class="img-responsive img-rounded" src="../assets/images/dashboard-img/company-listed1.jpg"
                                    alt="700x300">
                                <div class="dashboard-box-info">
                                    <h3><a href="#">Company Listed</a></h3>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>

                                    <a href="#" class="btn dashboard-btn">Company Listed</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>
    {{-- bank login Dashboard  end --}}


@endsection

@push('scripts')
    {{-- <script src="{{ asset('admin/js/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatable/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/js/admin.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.22.2/powerbi.js"> </script>
    <script>
        // Replace {embedUrl} and {accessToken} with the appropriate values for your report
        models = window['powerbi-client'].models;

        // Get a reference to the report container
        var reportContainer = document.getElementById('reportContainer');
        var permissions = models.Permissions.All;
        // Embed the report
        var report = powerbi.embed(reportContainer, {
            type: 'report',
            accessToken: '{{ $embed_token }}',
            embedUrl: '{{ $embed_url }}',
            permissions: permissions,
            tokenType: models.TokenType.Embed,
            settings: {
                filterPaneEnabled: false,
                navContentPaneEnabled: true
            }
        });

    </script> --}}
@endpush
