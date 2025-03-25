@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])


@section('content')



    <!-- Start Content-->
    <div class="container-fluid mt-4">


        {{-- <div class="row"> --}}
                <div class="row">

                    <div class="col-md-6 col-xl-4">
                        <div class="widget-rounded-circle card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                            <i class="bi-currency-rupee font-22 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="text-end">
                                            @php
                                                $totalBanks = DB::table('users')->where('profileid', 2)->count();
                                            @endphp
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalBanks }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate text-wrap">Total Banks</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->


                <div class="col-md-6 col-xl-4">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                        <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="text-end">
                                        @php
                                            $activeBanksCount = DB::table('users')
                                                ->where('isactive', 'Y')
                                                ->where('profileid', 2)
                                                ->count();
                                        @endphp
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $activeBanksCount }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate text-wrap">Active Banks</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->


                <div class="col-md-6 col-xl-4">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                        <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="text-end">
                                        @php
                                            $publicSectorBanksCount = DB::table('users')
                                                ->where('bank_sector_type', 'public')
                                                ->where('profileid', 2)
                                                ->count();
                                        @endphp
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $publicSectorBanksCount }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate text-wrap">Public Sector Banks</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->


            {{-- </div> --}}

            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="text-end">
                                    @php
                                        $publicSectorBanksCount = DB::table('users')
                                            ->where('bank_sector_type', 'private')
                                            ->where('profileid', 2)
                                            ->count();
                                    @endphp
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $publicSectorBanksCount }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate text-wrap">Private Sector Banks</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->


            <div class="col-md-6 col-xl-4">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                        <i class="fe-flag font-22 avatar-title text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="text-end">
                                        @php
                                            $totalBanks = DB::table('users')->where('profileid', 4)->count();
                                        @endphp
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalBanks }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate text-wrap">Total Companies</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
        {{-- </div> --}}
        <!-- end row -->

    </div> <!-- container -->
@endsection
{{-- @section('script')
    @vite(['resources/js/pages/dashboard-4.init.js'])
@endsection --}}

