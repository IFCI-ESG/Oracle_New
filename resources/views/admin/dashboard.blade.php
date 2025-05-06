@extends('layouts.vertical', ['title' => 'Dashboard 4'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

         <!-- include('layouts.shared.page-title' , ['title' => 'Dashboard','subtitle' => 'Dashboards'])  -->

        <div class="row" >
            <div class="col-12">
                    <div class=" card">
                    <div class="card-body">
                <div id="reportContainer" style="height: 75vh;"></div>
                {{--<iframe title="ESG E" width="100%" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZDM4ZTBkOWItMzQ2Ny00MmY2LWExYzctOTRmZDZjOTY4ZjBhIiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9"
                    frameborder="0" allowFullScreen="true"></iframe>--}}
                    {{-- {{dd($user)}} --}}
                    {{-- <iframe width="100%" height="600"
                        src="https://app.powerbi.com/view?r=eyJrIjoiZDM4ZTBkOWItMzQ2Ny00MmY2LWExYzctOTRmZDZjOTY4ZjBhIiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9&filter=bank_financial_details/bank_id eq '{{ urlencode($user) }}'"
                        frameborder="0" allowFullScreen="true">
                    </iframe> --}}
                    {{-- {{dd($user)}} --}}
                    {{-- @if ($type=='Environment')

                        <iframe title="ESG E" width="100%" height="600"
                            src="https://app.powerbi.com/view?r=eyJrIjoiMzNlNWJlOTUtN2YwNC00NDA0LWJjZTktMWFjMDFmZDUxMGNjIiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9" frameborder="0" allowFullScreen="true"></iframe>

                    @elseif($type=='Social')
                        @php
                            $powerBiUrl = "https://app.powerbi.com/view?r=eyJrIjoiNDZkNDNjNWYtNmY0Ny00NjM5LWJkZGMtNTM0MzU1YWEzNjI3IiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9&filter=bank_financial_details/bank_id eq $user";
                        @endphp
                        <iframe title="ESG S" width="100%" height="600"
                                src="{{ $powerBiUrl }}"
                                frameborder="0" allowFullScreen="true">
                        </iframe>
                    @elseif ($type=='Governance')
                        @php
                            $powerBiUrl = "https://app.powerbi.com/view?r=eyJrIjoiNDM5NTAzZmUtYzg3ZS00MDhhLWIyZmItODg4YmM3NTk5MGE2IiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9&filter=bank_financial_details/bank_id eq $user";
                        @endphp
                        <iframe title="ESG G" width="100%" height="600"
                                src="{{ $powerBiUrl }}"
                                frameborder="0" allowFullScreen="true">
                        </iframe>
                    @elseif ($type=='Scoring')
                        @php
                            $powerBiUrl = "https://app.powerbi.com/view?r=eyJrIjoiOTkyMmZkNjEtOWIzMC00M2U4LTgzMWQtYzY3ODUxOGJhYTQ4IiwidCI6ImUwMWY0MmYxLTdhMjQtNDY2Zi04ZTcwLTY2YTRlNTA3ZWUwNSJ9&filter=bank_financial_details/bank_id eq $user";
                        @endphp
                        <iframe title="ESG SC" width="100%" height="600"
                                src="{{ $powerBiUrl }}"
                                frameborder="0" allowFullScreen="true">
                        </iframe>
                    @endif --}}

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


