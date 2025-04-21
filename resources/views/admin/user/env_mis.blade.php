@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- include('layouts.shared.page-title' , ['title' => 'MIS','subtitle' => 'MIS']) -->

        <div class="row" >
            <div class="col-xl-12">
                <div id="reportContainer" style="height: 80vh;"></div>
            </div>
        </div>
</div>


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
    </script>

@endsection

@section('script')
    @vite(['resources/js/pages/dashboard-4.init.js'])
@endsection

