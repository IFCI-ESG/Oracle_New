@extends('layouts.admin.master')

@section('title')
Admin Dashboard
@endsection

@push('styles')

@endpush

@section('content')

{{--
            <div class="col-md-12 h-100 d-inline-block"  >
                <div id="reportContainer"  >

                </div>
            </div> --}}



{{-- <div class="container"> --}}
    <div class="row">

        <iframe title="ESG Assesment Tool(EAT) Colourful theme" width="100%" height="600"
        src="https://app.powerbi.com/view?r=eyJrIjoiMDdmN2QxYmMtMmVlZC00MzJhLWJmYjQtMjIwN2IwMTg5NTJiIiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9"
            frameborder="0" allowFullScreen="true"></iframe>
     </div>
{{-- </div> --}}



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
