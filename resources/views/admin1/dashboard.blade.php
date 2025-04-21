{{-- @extends('layouts.admin.master')

@section('title')
Admin Dashboard
@endsection

@push('styles')

<style>
    #reportContainer
    {
        position: relative;
        width: 100%;
        height: 80vh;
        overflow: hidden;
    }
</style>

@endpush

@section('content') --}}

    <div id="reportContainer"></div>
    {{-- <div style="text-right">
        <button id="fullscreenButton">Go Full Screen</button>
    </div> --}}

    {{-- <div class="row">
        @if(Auth::user()->hasRole('SuperAdmin') && Auth::user()->hasRole('Admin'))
            <iframe title="ESG Staging" width="100%" height="600"
            src="https://app.powerbi.com/view?r=eyJrIjoiNWM0M2FiY2YtOTI0OC00ODUwLTg3YjItMjZkNWZiMGQ5MWJmIiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9"
                    frameborder="0" allowFullScreen="true"></iframe>
        @elseif(Auth::user()->hasRole('Admin'))
            <iframe title="ESG Staging" width="100%" height="600"
            src="https://app.powerbi.com/view?r=eyJrIjoiNWM0M2FiY2YtOTI0OC00ODUwLTg3YjItMjZkNWZiMGQ5MWJmIiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9"
                    frameborder="0" allowFullScreen="true"></iframe>
        @endif

    </div> --}}

{{-- @endsection

@push('scripts') --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.22.2/powerbi.js"> </script>
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
            filters: [
            {
                $schema: "https://powerbi.com/product/schema#basic",
                target: {
                    table : "bank_financial_details",
                    column: "bank_id"
                },
                operator: "Is",
                values: [{{$user}}]
            }
        ],
            permissions: permissions,
            tokenType: models.TokenType.Embed,
            settings: {
                filterPaneEnabled: false,
                navContentPaneEnabled: true,
                // layoutType: models.LayoutType.MobilePortrait, // or .Custom for better control
                // displayOption: models.DisplayOption.FitToWidth  // This ensures it scales properly to width
            }
        });

         // add full screen functionality
        // document.getElementById('fullscreenButton').addEventListener('click', function () {
        //     report.fullscreen();
        // });
    </script>

{{-- @endpush --}}
