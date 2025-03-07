@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">



        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                {{ session('error') }}
            </div>
        @endif

        <style>
            .form-check-label {
                font-size: 1.1rem;
            }

            .form-check-input:checked+.form-check-label {
                color: #007bff;
                font-weight: bold;
            }

            .form-check-input:focus {
                box-shadow: none;
            }

            .Environmernt {
                color: darkgreen;
                font-weight: 800;
                font-size: 20px;
            }

            .Social {
                color: blue;
            }

            .Governance {
                color: yellowgreen;
            }

            .table tbody tr td input {
                height: auto;
            }


            canvas {
                display: block;
                margin: 0 auto;
            }
        </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <br>
                <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container  py-4 px-2 col-lg-12">
            <div class="row justify-content-center">
                <div class="col-md-12">


                    <div class="card card-outline-governance card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"
                                        style="    border-left-color: #495057;"><b>Scoring Data For
                                            FY-{{ $fys->fy }}</b></a>
                                </li>
                            </ul>
                        </div>


                        <!-- <div class="card card-outline-governance">
                            <div class="card-header">
                                <div class="card-body p-3">
                                    <table class="table table-bordered table-hover table-sm table-striped" id="board-table">
                                        <tbody>

                                        </tbody>
                                        <tr>
                                            <td class="text-center" style="width: 5%" >
                                             <b style = "color:black;">  OverAll Rating </b>
                                            </td>
                                            <td class="text-center" style="width: 5%" colspan="2" >
                                             <b style = "color:black;">  {{$rating_grade}}  </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="width: 5%">
                                                <canvas id="myChart" width="339" height="339"
                                                    onmousemove="cnvs_getCoordinates(event)"></canvas>

                                            </td>
                                            <td class="text-center" style="width: 5%">
                                                <canvas id="myChart1" width="339" height="339"
                                                    onmousemove="cnvs_getCoordinates(event)"></canvas>

                                            </td>
                                            <td class="text-center" style="width: 5%">
                                                <canvas id="myChart2"width="339" height="339"
                                                    onmousemove="cnvs_getCoordinates(event)"></canvas>

                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div> -->



                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="governance" role="tabpanel"
                                    aria-labelledby="governance-tab">

                                    @foreach ($question as $key => $pillerdata)
                                        <div class="card card-outline-governance" style="    border: 3px solid #12CCCC;">
                                            <div class="card-header">
                                                <b class="{{ $key }}">{{ $key }}<b>


                                                        @foreach ($pillerdata as $key1 => $subpiller)
                                                            <div class="card card-outline-governance">
                                                                <div class="card-header">
                                                                    <h5>{{ $key1 }}<h5>
                                                                            @php
                                                                                $i = 1;
                                                                            @endphp
                                                                            @foreach ($subpiller as $key2 => $value)
                                                                                <div class="card-body p-3">
                                                                                    <table
                                                                                        class="table table-bordered table-hover table-sm table-striped"
                                                                                        id="board-table">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center"
                                                                                                    style="width: 5%">
                                                                                                    {{ $i }}
                                                                                                </td>
                                                                                                <td style="width: 40%">
                                                                                                    {{ $value->question }}

                                                                                                </td>
                                                                                                <td style="width: 40%">
                                                                                                    <div class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="answer[{{ $value->id }}]"
                                                                                                            id=""
                                                                                                            style="       height: auto !important;"
                                                                                                            value="1"
                                                                                                            @if ($value->ans == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="1">
                                                                                                            {{ $value->option1 }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="answer[{{ $value->id }}]"
                                                                                                            id=""
                                                                                                            style="       height: auto !important;"
                                                                                                            value="2"
                                                                                                            @if ($value->ans == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="1">
                                                                                                            {{ $value->option2 }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    @if (($value->option3 != '') && ($value->option4 != ''))
                                                                                                        <div
                                                                                                            class="form-check">
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="answer[{{ $value->id }}]"
                                                                                                                id=""
                                                                                                                style="       height: auto !important;"
                                                                                                                value="3">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="1"
                                                                                                                @if ($value->ans == 3) checked @endif>
                                                                                                                {{ $value->option3 }}
                                                                                                            </label>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="form-check">
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="answer[{{ $value->id }}]"
                                                                                                                id=""
                                                                                                                style="       height: auto !important;"
                                                                                                                value="4"
                                                                                                                @if ($value->ans == 4) checked @endif>
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="1">
                                                                                                                {{ $value->option4 }}
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                @php
                                                                                    $i++;
                                                                                @endphp
                                                                            @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.scoring.index') }}"
                                class="btn btn-warning btn-sm float-left"> <i
                                class="fas fa-arrow-left"></i> Back </a>
                            </div>


                        </div>
                        <!-- /.card -->
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
        <!-- <script src="https://cdn.everviz.com/everviz.js"></script> -->
        <script>
            const ctx = document.getElementById("myChart").getContext("2d");
            const ctx1 = document.getElementById("myChart1").getContext("2d");
            const ctx2 = document.getElementById("myChart2").getContext("2d");

            const gaugeNeedle = {
                id: "gaugeNeedle",
                afterDatasetDraw(chart, args, options) {
                    const {
                        ctx,
                        config,
                        data,
                        chartArea: {
                            top,
                            bottom,
                            left,
                            right,
                            width,
                            height
                        }
                    } = chart;

                    ctx.save();
                    const needleValue = data.datasets[0].needleValue;
                    const meterValue = data.datasets[0].meterValue;
                    const dataTotal = data.datasets[0].data.reduce((a, b) => a + b, 0);
                    const angle = Math.PI + (1 / dataTotal) * needleValue * Math.PI;

                    const cx = chart._metasets[0].data[0].x;
                    const cy = chart._metasets[0].data[0].y;
                    const outerRadius = chart._metasets[0].data[0].outerRadius;
                    const innerRadius = chart._metasets[0].data[0].innerRadius;

                    // Needle
                    ctx.translate(cx, cy);
                    ctx.rotate(angle);
                    ctx.beginPath();
                    ctx.fillStyle = "#cdd5e1";
                    ctx.fillRect(0, -2, innerRadius - 5, 4);

                    // Needle Dot
                    ctx.translate(-cx, -cy);
                    ctx.beginPath();
                    ctx.arc(cx, cy, 7, 0, 2 * Math.PI);
                    ctx.fill();
                    ctx.restore();

                    ctx.font = "bold 38px sans-serif";
                    ctx.fillStyle = "#000000";
                    ctx.textAlign = "center";
                    ctx.fillText(meterValue, cx, cy + 30);

                    ctx.font = "normal 12px sans-serif";
                    ctx.fillStyle = "#333333";


                    ctx.font = "12px sans-serif";
                    ctx.fillStyle = "#898989";

                }
            };

            const environmentScore = {{ $environment_esg_score }}; // Replace with dynamic value
            const socialScore = {{ $social_esg_score }}; // Replace with dynamic value
            const governanceScore = {{ $governance_esg_score }}; // Replace with dynamic value

            const myChart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    labels: ["Value", "Remaining"],
                    datasets: [{
                        label: "# of Votes",
                        data: [environmentScore, 10 - environmentScore],
                        backgroundColor: ["#4caf50", "#e0e0e0"],
                        borderWidth: 0,
                        needleValue: environmentScore,
                        meterValue: environmentScore.toFixed(2),
                        cutout: "80%",
                        circumference: 180,
                        rotation: -90,
                    }]
                },
                options: {
                    circumference: 180,
                    rotation: -90,
                    cutout: "80%",
                    responsive: true,
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    },
                    plugins: {
                        tooltip: {
                            enabled: false
                        },
                        legend: {
                            position: "top",
                            display: true
                        },
                        title: {
                            display: true,
                            text: "Environment Score Chart"
                        }
                    }
                },
                plugins: [
                    {
                    beforeDraw: function (chart) {
                        const ctx = chart.ctx;
                        const chartArea = chart.chartArea;
                        const width = chart.width;
                        const height = chart.height;

                        // Customize font style for labels
                        ctx.save();
                        ctx.font = 'bold 16px Arial';
                        ctx.fillStyle = '#000'; // Black color for labels

                        // Get the center of the chart
                        const centerX = chartArea.left + width / 2;
                        const centerY = chartArea.top + height / 2;
                        const radius = Math.min(width, height) / 2;

                        // Label "0" at the bottom-left corner of the half circle
                        const angle0 = Math.PI;  // 180 degrees (left side of the half circle)
                        const x0 = centerX + radius * Math.cos(angle0);
                        const y0 = centerY + radius * Math.sin(angle0);
                        ctx.fillText('0', x0 - (-10), y0 + 70);  // Adjust for better placement (slightly below the corner)

                        // Label "10" at the bottom-right corner of the half circle
                        const angle10 = 0;  // 0 degrees (right side of the half circle)
                        const x10 = centerX + radius * Math.cos(angle10);
                        const y10 = centerY + radius * Math.sin(angle10);
                        ctx.fillText('10', x10 - 17, y10 + 70);  // Adjust for better placement (slightly below the corner)

                        ctx.restore();
                    }
                    },
                    gaugeNeedle]
            });

            const myChart1 = new Chart(ctx1, {
                type: "doughnut",
                data: {
                    labels: ["Value", "Remaining"],
                    datasets: [{
                        label: "# of Votes",
                        data: [socialScore, 10 - socialScore],
                        backgroundColor: ["blue", "#e0e0e0"],
                        borderWidth: 0,
                        needleValue: socialScore,
                        meterValue: socialScore.toFixed(2),
                        cutout: "80%",
                        circumference: 180,
                        rotation: -90,
                    }]
                },
                options: {
                    circumference: 180,
                    rotation: -90,
                    cutout: "80%",
                    responsive: true,
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    },
                    plugins: {
                        tooltip: {
                            enabled: false
                        },
                        legend: {
                            position: "top",
                            display: true
                        },
                        title: {
                            display: true,
                            text: "Social Score Chart"
                        }
                    }
                },
                plugins: [
                    {
                    beforeDraw: function (chart) {
                        const ctx = chart.ctx;
                        const chartArea = chart.chartArea;
                        const width = chart.width;
                        const height = chart.height;

                        // Customize font style for labels
                        ctx.save();
                        ctx.font = 'bold 16px Arial';
                        ctx.fillStyle = '#000'; // Black color for labels

                        // Get the center of the chart
                        const centerX = chartArea.left + width / 2;
                        const centerY = chartArea.top + height / 2;
                        const radius = Math.min(width, height) / 2;

                        // Label "0" at the bottom-left corner of the half circle
                        const angle0 = Math.PI;  // 180 degrees (left side of the half circle)
                        const x0 = centerX + radius * Math.cos(angle0);
                        const y0 = centerY + radius * Math.sin(angle0);
                        ctx.fillText('0', x0 - (-10), y0 + 70);  // Adjust for better placement (slightly below the corner)

                        // Label "10" at the bottom-right corner of the half circle
                        const angle10 = 0;  // 0 degrees (right side of the half circle)
                        const x10 = centerX + radius * Math.cos(angle10);
                        const y10 = centerY + radius * Math.sin(angle10);
                        ctx.fillText('10', x10 - 17, y10 + 70);  // Adjust for better placement (slightly below the corner)

                        ctx.restore();
                    }
                    },
                    gaugeNeedle]
            });

            const myChart2 = new Chart(ctx2, {
                type: "doughnut",
                data: {
                    labels: ["Value", "Remaining"],
                    datasets: [{
                        label: "# of Votes",
                        data: [governanceScore, 10 - governanceScore],
                        backgroundColor: ["#ffd300", "#e0e0e0"],
                        borderWidth: 0,
                        needleValue: governanceScore,
                        meterValue: governanceScore.toFixed(2),
                        cutout: "80%",
                        circumference: 180,
                        rotation: -90,
                    }]
                },
                options: {
                    circumference: 180,
                    rotation: -90,
                    cutout: "80%",
                    responsive: true,
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    },
                    plugins: {
                        tooltip: {
                            enabled: false
                        },
                        legend: {
                            position: "top",
                            display: true
                        },
                        title: {
                            display: true,
                            text: "Governance Score Chart"
                        }
                    }
                },
                plugins: [
                {
                beforeDraw: function (chart) {
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;
                    const width = chart.width;
                    const height = chart.height;

                    // Customize font style for labels
                    ctx.save();
                    ctx.font = 'bold 16px Arial';
                    ctx.fillStyle = '#000'; // Black color for labels

                    // Get the center of the chart
                    const centerX = chartArea.left + width / 2;
                    const centerY = chartArea.top + height / 2;
                    const radius = Math.min(width, height) / 2;

                    // Label "0" at the bottom-left corner of the half circle
                    const angle0 = Math.PI;  // 180 degrees (left side of the half circle)
                    const x0 = centerX + radius * Math.cos(angle0);
                    const y0 = centerY + radius * Math.sin(angle0);
                    ctx.fillText('0', x0 - (-10), y0 + 70);  // Adjust for better placement (slightly below the corner)

                    // Label "10" at the bottom-right corner of the half circle
                    const angle10 = 0;  // 0 degrees (right side of the half circle)
                    const x10 = centerX + radius * Math.cos(angle10);
                    const y10 = centerY + radius * Math.sin(angle10);
                    ctx.fillText('10', x10 - 17, y10 + 70);  // Adjust for better placement (slightly below the corner)

                    ctx.restore();
                }
                },
                gaugeNeedle]
            });
        </script>







    @endsection
