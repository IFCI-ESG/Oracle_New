<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-bs-theme="{{ $theme ?? 'light' }}" data-topbar-color="{{ $topbar ?? 'light' }}"
    dir="{{ $rtl ?? 'ltl' }}">

<head>
    @include('layouts.shared/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
    @vite(['resources/scss/icons.scss', 'resources/js/head.js'])

    <style type="text/css">
        .card-header-black {
            background-color: #000;
            color: white;
            font-size: 18px;
        }

        input[readonly] {
            background-color: #f8f9fa;
        }

        th {
            font-size: 16px;
        }

        input,
        select,
        checkbox {
            font-size: 16px !important;
        }
    </style>
</head>

<body @yield('body-extra')>
    <!-- Begin page -->
    <div id="wrapper">
        @include('layouts.shared/left-sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            @include('layouts.shared/topbar')
            <div class="content">
                <!-- content -->
                @yield('content')
            </div>
            @include('layouts.shared/footer')
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('layouts.shared/right-sidebar')

    @include('layouts.shared/footer-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('script')

    @vite(['resources/js/app.js', 'resources/js/layout.js'])


</body>


</html>
