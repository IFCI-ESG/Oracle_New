@extends('layouts.master')
@section('content')
<div class="main">
    <div class="container">

        <section id="contact" class="contact">
            {{-- <div class="container" style="padding-top:70px">

                <div class="section-header">
                    <h2>Individual Calculator</h2>
                </div>

            </div> --}}

            <div class="row" style="padding-top:70px">
                <div class="col-md-10 offset-md-1">
                    <div class="card my-2">
                        <div class="card-header" style="background-color: #9fd18b">
                          <h3>Individual Calculator</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <table class="table table-bordered table-hover table-striped" id="env-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%" class="text-center">
                                                        Sr. No.
                                                    </th>
                                                    <th class="text-center">
                                                        Aspect
                                                    </th>
                                                    <th class="text-center">
                                                        Question
                                                    </th>
                                                    <th class="text-center">
                                                        Type
                                                    </th>
                                                    <th class="text-center">
                                                        Value
                                                    </th>
                                                    <th class="text-center">
                                                        Unit
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ques_mast as $key => $ques)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $key+1 }}
                                                        </td>
                                                        <td >
                                                            {{$ques->heading}}
                                                        </td>
                                                        <td>
                                                            {{$ques->question}}
                                                        </td>
                                                        {{-- @if($ques->id==1) colspan="2" @endif --}}
                                                        <td class="text-center" >
                                                            @if($ques->id!=1)
                                                                <select class="form-control form-control-sm tot"
                                                                    @if($ques->id==2)
                                                                        id="travel"
                                                                    @elseif($ques->id==3)
                                                                        id="electricity"
                                                                    @elseif($ques->id==4)
                                                                        id="fuel"
                                                                    @endif
                                                                    >
                                                                    <option value="" disabled selected>Please Select </option>
                                                                    @foreach ($subques_mast->where('ques_id',$ques->id) as $sub)
                                                                        <option value="{{ $sub->emission_factor }}">{{ $sub->subques }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        </td>
                                                        <td class="text-center" >
                                                            {{-- @if($ques->id!=1) --}}
                                                                <input type="text" class="form-control form-control-sm tot"
                                                                    @if($ques->id==1)
                                                                        id="house_val"
                                                                    @elseif($ques->id==2)
                                                                        id="travel_val"
                                                                    @elseif($ques->id==3)
                                                                        id="electricity_val"
                                                                    @elseif($ques->id==4)
                                                                        id="fuel_val"
                                                                    @endif >
                                                            {{-- @endif --}}
                                                        </td>
                                                        <td>
                                                            @if($ques->id==2 || $ques->id==3)
                                                                {{$subques_mast->where('ques_id',$ques->id)->first()->unit}}
                                                            @elseif($ques->id==4)
                                                                Number/Rupees
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="3" class="text-center">
                                                           <b> Total Emissions for Individual per Month </b>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-primary btn-sm form-control form-control-sm"
                                                                style="height: 30px; width: 170px;" onclick="Total(this)">
                                                                Calculate
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm tot"  id="total_emisssion" disabled>
                                                        </td>
                                                        <td>
                                                            Kg Co2e
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                        {{-- <div class="progress mt-4">
                                            <div id="emissionScoreMeter" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 position-relative">
                            <canvas id="emissionScoreGauge" width="400" height="200"></canvas>
                            <div id="emissionScoreLabel" class="text-center mt-2">0 Kg CO2e</div>
                        </div>


                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
       function Total(e)
       {
            // var house = document.getElementById("house").value;
            var travel = document.getElementById("travel").value;
            var electricity = document.getElementById("electricity").value;
            var fuel = document.getElementById("fuel").value;

            var house_val = document.getElementById("house_val").value;
            var travel_val = document.getElementById("travel_val").value;
            var electricity_val = document.getElementById("electricity_val").value;
            var fuel_val = document.getElementById("fuel_val").value;

            house_val = parseFloat(house_val);
            travel_val = parseFloat(travel_val);
            electricity_val = parseFloat(electricity_val);
            fuel_val = parseFloat(fuel_val);

            if (travel === "" || electricity === "" || fuel === "")  {
                alert("Please Select all the fields.");
                return;
            }

            if(house_val === "" || travel_val === "" || electricity_val === "" || fuel_val === ""){
                alert("Please fill all the fields.");
                return;
            }


            // Check for negative values
            if (travel < 0 || electricity < 0 || fuel < 0 || house_val < 0 || travel_val < 0 || electricity_val < 0 || fuel_val < 0) {
                alert("Values cannot be negative.");
                return;
            }

            emiss_travel = (travel*travel_val)*30;
            emiss_electricity = (electricity*electricity_val)/house_val;
            emiss_fuel = (fuel*fuel_val)/house_val;

            tot_emiss = emiss_travel + emiss_electricity + emiss_fuel;

            $('#total_emisssion').val(tot_emiss.toFixed(2));

                 // Update the progress bar
            // var max_emission = 1000; // Maximum value for progress bar, adjust as needed
            // var percentage = Math.min((tot_emiss / max_emission) * 100, 100);
            // $('#emissionScoreMeter').css('width', percentage + '%').attr('aria-valuenow', percentage);



        }

        // $(document).ready(function() {

        //     // Define the custom gauge chart plugin
        //     const gaugePlugin = {
        //           id: 'gauge',
        //           beforeDraw: (chart) => {
        //               const {ctx, chartArea: {width, height}} = chart;
        //               ctx.save();

        //               const value = chart.config.data.datasets[0].value;
        //               const minValue = chart.config.data.datasets[0].minValue;
        //               const maxValue = chart.config.data.datasets[0].maxValue;
        //               const angle = Math.PI + (1 - (value - minValue) / (maxValue - minValue)) * Math.PI;
        //               const cx = width / 2;
        //               const cy = height - 10;
        //               const r = Math.min(width, height) / 2;

        //               // Draw the background arc
        //               ctx.beginPath();
        //               ctx.arc(cx, cy, r, Math.PI, 2 * Math.PI);
        //               ctx.lineWidth = 20;
        //               ctx.strokeStyle = '#e0e0e0';
        //               ctx.stroke();

        //               // Draw the value arc
        //               ctx.beginPath();
        //               ctx.arc(cx, cy, r, Math.PI, angle);
        //               ctx.lineWidth = 20;
        //               ctx.strokeStyle = '#66bb6a';
        //               ctx.stroke();

        //               // Draw the needle
        //               ctx.beginPath();
        //               ctx.moveTo(cx, cy);
        //               ctx.lineTo(cx + r * Math.cos(angle), cy + r * Math.sin(angle));
        //               ctx.lineWidth = 5;
        //               ctx.strokeStyle = '#000000';
        //               ctx.stroke();

        //               ctx.restore();
        //           }
        //       };

        //       // Register the custom gauge plugin
        //       Chart.register(gaugePlugin);

        //       // Create the gauge chart
        //       const ctx = document.getElementById('emissionScoreGauge').getContext('2d');
        //       const gaugeChart = new Chart(ctx, {
        //           type: 'doughnut',
        //           data: {
        //               datasets: [{
        //                   value: 0,
        //                   minValue: 0,
        //                   maxValue: 1000,
        //                   data: [1], // dummy data
        //                   backgroundColor: ['#ffffff'], // dummy color
        //               }]
        //           },
        //           options: {
        //               rotation: Math.PI,
        //               circumference: Math.PI,
        //               plugins: {
        //                   gauge: {}
        //               },
        //               cutout: '90%',
        //               responsive: true,
        //               maintainAspectRatio: false
        //           }
        //       });

        //       // Function to update the gauge chart


        //       // Example of updating the gauge chart with a new value
        //       updateGauge(500); // Update the gauge to 500 Kg CO2e
        // });
        // function updateGauge(value) {
        //     gaugeChart.config.data.datasets[0].value = value;
        //     gaugeChart.update();
        //     document.getElementById('emissionScoreLabel').innerText = value + ' Kg CO2e';
        // }
    </script>
@endpush
