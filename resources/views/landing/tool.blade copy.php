@extends('layouts.master')

@push('style')

@endpush

@section('content')
    <!--====== Know Your Carbon Footprint PART START ======-->
    <div class="award-section individual-calculator pb-60">
        <div class="container">
            <div class="row mb-30">
                <div class="col-lg-8">
                    <div class="section-title text-animation mt-30">
                        <h2>Experience Our Tool</h2>
                    </div>
                </div>
            </div>
            <div class="row calculator-box">
                <div class="col-lg-9">
                    <div class="table-responsive">
                        <table class="individual-calculator-table">
                            <tbody>
                                <tr>
                                    <td data-label="Award" class="heading-sec">
                                        Total electricity purchased from the grid
                                    </td>
                                    <td data-label="Platform" class="text-right">
                                        <input type="number" placeholder="Number" class="form-control form-control-sm"
                                            min="0" id="electricity">
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Award" class="heading-sec">
                                        Trainings provided to staff
                                    </td>
                                    <td data-label="Platform" class="text-right">
                                        <input type="number" placeholder="Percentage" class="form-control form-control-sm"
                                            min="0" max="100" id="trained_staff">
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Award" class="heading-sec">
                                        Grievance Redressal Rate
                                    </td>
                                    <td data-label="Platform" class="text-right">
                                        <input type="number" placeholder="Percentage" class="form-control form-control-sm"
                                            min="0" max="100" id="grievance">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-left">
                                        <b> Click Here to Preview
                                    </td>
                                    <td class="text-center animation-btn-css">

                                        <div class="button-icon">
                                            <button class="button" onclick="Total(this)">

                                                <p class="title">Submit </p>
                                                <img src="assets/images/calculator-icon.png" alt="">
                                                <p class="description">Submit </p>
                                            </button>

                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-40 card-header border" id="charts" style="display: none;">
                <div class="row text-center">
                    <div class="col-md-12">
                        <img src="assets/images/logo/footer-logo-jpg1.jpg" height="100px" width="500px" alt="">
                    </div>
                </div>
                <div class="row mt-20 text-center">
                    <div class="col-md-12">
                        <h1>ESG Snapshot</h1>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Environment</h3>
                                    {{-- <a href="#" id="en">View Report</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="position-relative mb-4">
                                    <canvas id="env" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Social</h3>
                                    {{-- <a href="#" id="scl">View Report</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="position-relative mb-4">
                                    <canvas id="social" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <div class="row mt-40">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Governance</h3>
                                    {{-- <a href="#">View Report</a> --}}
                                </div>
                            </div>
                            <div class="row mt-10">
                                <div class="col-lg-12">
                                    <div class="position-relative mb-4">
                                        <canvas id="governance" height="200"></canvas>
                                        {{-- <canvas id="seconddonut" height="200"></canvas> --}}

                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="position-relative mb-4">
                                        <canvas id="firstdonut" height="200"></canvas>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Minimum wages ensured for workers</th>
                                                <td>
                                                    <img src="assets/images/tick.png" height="30px" width="40px" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Any penalty imposed by any government department</th>
                                                <td>
                                                    <img src="assets/images/cross.png" height="30px" width="40px" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Data privacy of customer data ensured</th>
                                                <td>
                                                    <img src="assets/images/tick.png" height="30px" width="40px" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Full disclosure of product/ service related risks</th>
                                                <td>
                                                    <img src="assets/images/tick.png" height="30px" width="40px" alt="">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="position-relative mb-4">
                                        <canvas id="seconddonut" height="200"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="position-relative mb-4">
                                        <canvas id="thirddonut" height="200"></canvas>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">UN-SDG Mapping</h3>
                                    {{-- <a href="#">View Report</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-15">
                                    <div class="col-lg-4">
                                        <div class="position-relative mb-4">
                                            <img src="assets/unsdg/sdg_1.png">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="position-relative mb-4">
                                            <img src="assets/unsdg/sdg_2.png">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="position-relative mb-4">
                                            <img src="assets/unsdg/sdg_5.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25 mb-10">
                                    <div class="col-lg-4">
                                        <div class="position-relative mb-4">
                                            <img src="assets/unsdg/sdg_8.png">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="position-relative mb-4">
                                            <img src="assets/unsdg/sdg_10.png">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="position-relative mb-4">
                                            <img src="assets/unsdg/sdg_13.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row mt-20 text-center">
                    <div class="col-md-12">
                        <h1>ESG Snapshot</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== Individual Calculator PART ENDS ======-->



    {{-- popup --}}
    <!-- Modal services 1 -->
    <div class="modal fade meterGauge" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Meter Gauge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <canvas id="meterGauge" width="400" height="200">
                        <div class="meterGauge-content">
                            <p>test text</p>
                        </div>
                    </canvas>

                    <div class="col-lg-6">
                        {{-- <img src="assets/images/batch-logo-1.png" alt=""> --}}
                        <img src="assets/images/batch-logo-1.png" alt="" class="img-fluid">
                        <div id="emissionValue" class="overlay-text"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal services 1 end -->
    {{-- popup end --}}
@endsection
@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <!-- Include html2canvas library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.0.0-rc.7/html2canvas.min.js"></script>

    <!-- Include jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script>
        $(document).ready(function() {

        });

        var barChart;
        var pieChart;
        var pieChart2;

        function Total(e)
        {
            var electricity_val = document.getElementById("electricity").value;
            var electricity_emiss = parseFloat(electricity_val * 0.716);
            var diesel_consumed = parseFloat(170000 * 2.68787);
            var cement_production = parseFloat(800 * 374.4827);
            var limestone_purchased = parseFloat(200000 * 2.76);
            var distance_by_rail = parseFloat(1000000 * 0.010);

            var trained_staff = document.getElementById("trained_staff").value;
            trained_staff = parseFloat(trained_staff);
            var women_workforce = parseFloat(52);
            var disabled_workforce = parseFloat(5);
            var labour = parseFloat(65);
            var injury_rate = parseFloat(0.50);

            var grievance = document.getElementById("grievance").value;
            grievance = parseFloat(grievance);


            if (electricity_val === "" || trained_staff === "" || grievance === "") {
                alert("Please Select all the fields.");
                return;
            }

            if (isNaN(electricity_val) || isNaN(trained_staff) || isNaN(grievance)) {
                alert("Please fill all the required fields with valid values.");
                return;
            }

            // Check for negative values
            if (electricity_val < 0 || trained_staff < 0 || grievance < 0) {
                alert("Values cannot be negative.");
                return;
            }

            if (trained_staff < 0 || trained_staff > 100 || grievance < 0 || grievance > 100 ) {
                alert("Invalid input: Value must be a number between 0 and 100");
                return;
            }

            var tot_emiss = electricity_emiss + diesel_consumed + cement_production + limestone_purchased + distance_by_rail;

            $("#charts").show();

            // Update the bar chart with the emissions
            updateBarChart([electricity_emiss, diesel_consumed, cement_production, limestone_purchased, distance_by_rail],tot_emiss);
            createPieChart([trained_staff, women_workforce, disabled_workforce, labour, injury_rate]);
            createPieChart2([grievance]);
            firstDonutChart();
            secondDonutChart();
            thirdDonutChart();
        }

        function updateBarChart(values, tot_emiss)
        {
            var labels = ['Electricity', 'Diesel', 'Cement Production', 'Limestone', 'Rail Distance'];
            var backgroundColors = ['rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(255, 205, 86, 0.8)',
                'rgba(201, 203, 207, 0.8)', 'rgba(153, 102, 255, 0.8)'
            ];

            if (barChart) {
                barChart.destroy();
            }

            // Create the bar chart
            var ctx = document.getElementById('env').getContext('2d');
            barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Emissions (kg kg CO₂)',
                        data: values,
                        backgroundColor: backgroundColors,
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        barThickness: 30, // Controls the bar thickness
                        maxBarThickness: 50 // Ensures the bar won't get too thick
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    },
                    title: {
                        display: true,
                        text: 'Emissions by Source',
                        fontSize: 16
                    }
                }
            });

                // Download chart as an image
            // document.getElementById('en').addEventListener('click', function() {
            //     var link = document.createElement('a');
            //     link.href = document.getElementById('env').toDataURL('image/jpg');
            //     link.download = 'environment.jpg';
            //     link.click();
            // });
        }

        function createPieChart(pieData)
        {
            var pieLabels = ['Trained Staff', 'Women Workforce', 'Disabled Workforce', 'Labour', 'Injury Rate'];
            var pieBackgroundColors = ['#36a2eb', '#ff6384', '#ffcd56', '#4bc0c0', '#9966ff'];

            if (pieChart) {
                pieChart.destroy(); // Destroy the previous chart instance
            }

            var ctx = document.getElementById('social').getContext('2d');
            pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: pieLabels,
                    datasets: [{
                        data: pieData,
                        backgroundColor: pieBackgroundColors,
                        borderColor: 'rgba(255, 255, 255, 0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: 'Workforce and Injury Distribution',
                        fontSize: 16
                    }
                }
            });

                // Download chart as an image
            // document.getElementById('scl').addEventListener('click', function() {
            //     var link = document.createElement('a');
            //     link.href = document.getElementById('social').toDataURL('image/jpg');
            //     link.download = 'social.jpg';
            //     link.click();
            // });
        }

        function createPieChart2(pieData2)
        {

            var remainingValue = 100 - pieData2; // Calculate the remaining value out of 100

            var pieLabels = ['Grievance', 'Remaining'];
            var pieData = [pieData2, remainingValue]; // Two slices: user value and remaining value
            var pieBackgroundColors = ['#36a2eb', '#ffcd56']; // Two different colors

            // Check if pieChart2 already exists and destroy it
            if (pieChart2) {
                pieChart2.destroy();
            }

            var ctx = document.getElementById('governance').getContext('2d');

            pieChart2 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: pieLabels, // Labels for the pie chart slices
                    datasets: [{
                        data: pieData, // Data values for the pie chart
                        backgroundColor: pieBackgroundColors, // Background colors for the slices
                        borderColor: 'rgba(255, 255, 255, 0.8)', // Black border for visibility
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: 'User Input and Remaining Value Distribution',
                        fontSize: 12
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index] || '';
                                var value = data.datasets[0].data[tooltipItem.index];
                                return label + ': ' + value.toFixed(2) + '%'; // Display value as a percentage
                            }
                        }
                    }
                }
            });
        }

        function firstDonutChart()
        {
            var yesValue = 100; // Static value for Yes

            var donutLabels = ['Yes'];
            var donutData = [yesValue]; // Static data for Yes and No
            var donutBackgroundColors = ['#81c784']; // Blue for Yes, Gray for No

            // Create the chart
            var ctx = document.getElementById('firstdonut').getContext('2d');

            // Destroy existing chart if it exists
            // if (window.donutChart) {
            //     window.donutChart.destroy();
            // }

            window.donutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: donutLabels, // Labels for Yes and No
                    datasets: [{
                        data: donutData, // Data values for Yes and No
                        backgroundColor: donutBackgroundColors, // Blue for Yes, Gray for No
                        borderColor: 'rgba(0, 0, 0, 0.1)', // Light border color
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 50, // This creates the donut hole effect
                    title: {
                        display: true,
                        text: 'Dummy Donut Chart',
                        fontSize: 16
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index] || '';
                                var value = data.datasets[0].data[tooltipItem.index];
                                return label + ': ' + value; // Display value as number
                            }
                        }
                    }
                }
            });
        }

        function secondDonutChart()
        {
            var yesValue = 100; // Static value for Yes

            var donutLabels = ['Yes'];
            var donutData = [yesValue]; // Static data for Yes and No
            var donutBackgroundColors = ['#81c784']; // Blue for Yes, Gray for No

            // Create the chart
            var ctx = document.getElementById('seconddonut').getContext('2d');

            window.donutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: donutLabels, // Labels for Yes and No
                    datasets: [{
                        data: donutData, // Data values for Yes and No
                        backgroundColor: donutBackgroundColors, // Blue for Yes, Gray for No
                        borderColor: 'rgba(0, 0, 0, 0.1)', // Light border color
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 50, // This creates the donut hole effect
                    title: {
                        display: true,
                        text: 'Dummy Donut Chart',
                        fontSize: 16
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index] || '';
                                var value = data.datasets[0].data[tooltipItem.index];
                                return label + ': ' + value; // Display value as number
                            }
                        }
                    }
                }
            });
        }

        function thirdDonutChart()
        {
            var noValue = 100; // Static value for Yes

            var donutLabels = ['No'];
            var donutData = [noValue]; // Static data for Yes and No
            var donutBackgroundColors = ['#ef9a9a']; // Blue for Yes, Gray for No

            // Create the chart
            var ctx = document.getElementById('thirddonut').getContext('2d');

            // Destroy existing chart if it exists
            // if (window.donutChart) {
            //     window.donutChart.destroy();
            // }

            window.donutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: donutLabels, // Labels for Yes and No
                    datasets: [{
                        data: donutData, // Data values for Yes and No
                        backgroundColor: donutBackgroundColors, // Blue for Yes, Gray for No
                        borderColor: 'rgba(0, 0, 0, 0.1)', // Light border color
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 50, // This creates the donut hole effect
                    title: {
                        display: true,
                        text: 'Dummy Donut Chart',
                        fontSize: 16
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index] || '';
                                var value = data.datasets[0].data[tooltipItem.index];
                                return label + ': ' + value; // Display value as number
                            }
                        }
                    }
                }
            });
        }



    </script>
@endpush
