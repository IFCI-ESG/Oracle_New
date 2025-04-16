@extends('layouts.master')
@push('styles')

    <style>
        .onfocus .video-play {
            /* min-height: 99.9%; */
            /* background: linear-gradient(rgba(var(--color-black-rgb), 0.2), rgba(var(--color-black-rgb), 0.7)), url("../images/about_ifci.jpg") center center; */
            background: linear-gradient(rgba(var(--color-black-rgb), 0.2), rgba(var(--color-black-rgb), 0.7)), url("../images/key3.jpg") center center !important;
            /* background-size: cover; */
            /* object-fit: fill; */
        }

    </style>

@endpush
@section('content')
    {{-- <div class="container"> --}}

        <section id="onfocus" class="onfocus" style="background:  url("../images/key3.jpg") center center;">
            <div class="container-fluid" style="padding-top:80px">

                <div class="row g-0">
                    <div class="col-lg-6 video-play3 position-relative">
                        {{-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a> --}}
                    </div>
                    <div class="col-lg-6">
                        <div class="content d-flex flex-column justify-content-center h-100">
                            <h3>Key Policy Initiatives</h3>
                            <p class="fst-italic">
                                National Hydrogen Energy Mission for grey and green hydrogen.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle"></i> In energy efficiency, the market-based scheme
                                    of Perform, Achieve and Trade (PAT) has avoided 92 million tonnes of CO2 equivalent
                                    emissions during its first and second cycles.</li>
                                <li><i class="bi bi-check-circle"></i> India is accelerating its e-mobility transition with
                                    the Faster Adoption and Manufacturing of (Hybrid &) Electric Vehicles Scheme.</li>
                                <li><i class="bi bi-check-circle"></i> India leapfrogged from Bharat Stage-IV (BS-IV)
                                    to Bharat Stage-VI (BS-VI) emission norms by April 1, 2020, the latter being originally
                                    scheduled for adoption in 2024.</li>
                                <li><i class="bi bi-check-circle"></i> The remodelled Faster Adoption and Manufacturing of
                                    Electric Vehicles (FAME II) scheme</li>
                                <li><i class="bi bi-check-circle"></i> Production-Linked Incentive (PLI) scheme for Advanced
                                    Chemistry Cell (ACC) for the supplier side.</li>
                                <li><i class="bi bi-check-circle"></i> The Pradhan Mantri Ujjwala Yojana has helped 88
                                    million households to shift from coal based cooking fuels to LPG connections.</li>
                                    <li><i class="bi bi-check-circle"></i> Healthy and sustainable way of living based on traditions and values of conservation and
                                        moderation through a mass movement for LIFE- ‘Lifestyle for Environment’.</li>
                            </ul>
                            {{-- <a href="#" class="read-more align-self-start"><span>Read More</span><i class="bi bi-arrow-right"></i></a> --}}
                        </div>
                    </div>
                </div>

            </div>
        </section>

    {{-- </div> --}}
@endsection
