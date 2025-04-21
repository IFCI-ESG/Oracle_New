<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ $theme ?? 'light' }}" data-topbar-color="{{ $topbar ?? 'light' }}"
      dir="{{ $rtl ?? 'ltl' }}">

<head>
    @include('layouts.shared/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
    @vite(['resources/scss/icons.scss', 'resources/js/head.js'])
    {{-- @yield('script') --}}


<style type="text/css">
    .card-header-black{
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
    input,select,checkbox {
      font-size: 16px!important;
    }

</style>
</head>

<body>
<!-- Begin page -->
<div id="wrapper">
    @include('layouts.shared/user-left-sidebar')

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

@include('sweetalert::alert')

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')

@vite(['resources/js/app.js', 'resources/js/layout.js'])

</body>

</html>
