@extends('layouts.vertical', ['title' => 'Dashboard 4'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

         <!-- include('layouts.shared.page-title' , ['title' => 'Dashboard','subtitle' => 'Dashboards'])  -->

        <div class="row" >
            <div class="col-12">
                    <div class=" card mt-4">
                    <div class="card-body p-1">
                <div id="reportContainer" style="height: 75vh;"></div>

            </div>

            </div>
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
                    table : "attr_emission",
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

@endsection

@section('script')
    @vite(['resources/js/pages/dashboard-4.init.js'])
@endsection



