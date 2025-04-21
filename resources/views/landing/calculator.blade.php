@extends('layouts.master')

@push('styles')
    <style>
        #submitOtpBtn:hover {
            background: #45a049;
        }

        #resendOtpBtn:hover {
            background: #e64a19;
        }
    </style>
@endpush

@section('content')
    <!--====== Know Your Carbon Footprint PART START ======-->
    <div class="calcuator-main-sec">
    <div class="award-section individual-calculator">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-animation mt-30">
                        <h2>Your Carbon Footprint</h2>
                        {{-- <div class="dash-and-paragraph text-animation">
                            <div class="dash"></div> --}}
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                        {{-- </div> --}}
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="calculator-box">
                        <ul class="award-img-group text-animation">
                            <li class="">
                                <div class="award-img"><img src="assets/images/individual-calculator-img/Household-img8.jpg"
                                        alt=""></div>
                            </li>
                            <li class="">
                                <div class="award-img"><img src="assets/images/individual-calculator-img/travel-img8.jpg"
                                        alt=""></div>
                            </li>
                            <li class="">
                                <div class="award-img"><img
                                        src="assets/images/individual-calculator-img/electricity-img4.jpg" alt="">
                                </div>
                            </li>
                            <li class="">
                                <div class="award-img">
                                    <img src="assets/images/individual-calculator-img/Household-img8.jpg" alt="">
                                    {{-- <img src="assets/images/individual-calculator-img/cooking-fuel-consumption-img1.jpg" alt=""> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="table-responsive">
                        <div id="otpForm">
                            <table class="individual-calculator-table">
                                <tbody>
                                    <tr class="calculator-sec1">
                                        <th class="text-left heading-sec name">Name</th>
                                        <th class="name-input">
                                            <input type="text" class="form-control form-control-sm" id="name"
                                                name="name">
                                        </th>
                                        <th class="text-center mobile">Mobile</th>
                                        <td class="opt-btn">
                                            <input type="number" class="form-control form-control-sm" id="mobile"
                                                name="mobile">
                                            <button type="button" class="button button-opt" id="submit">
                                                <p class="description">Submit</p>
                                            </button>
                                            {{-- <button type="button" class="button button-opt" id="sendOtpBtn">
                                                <p class="description">Send OTP</p>
                                            </button> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- <div id="otpVerificationForm" style="display:none;">
                            <div style="display:flex; justify-content: center; align-items: center; background-color: #f9f9f9;">
                                <div style="background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 10px 20px; display: flex; align-items: center; gap: 10px; max-width: 800px;">
                                    <input type="text" id="otp" placeholder="Enter OTP"
                                        style="flex: 1; padding: 10px; font-size: 16px; border: 1px solid #ddd; border-radius: 5px;">
                                    <button type="button" id="submitOtpBtn"
                                        style="background: #4CAF50; color: white; border: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; cursor: pointer;">
                                        Submit
                                    </button>
                                    <button type="button" id="resendOtpBtn"
                                        style="background: #FF5722; color: white; border: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; cursor: pointer;">
                                        Resend
                                    </button>
                                </div>
                            </div>
                        </div> --}}



                        <div id="calculatorForm" style="display:none;">
                            <!-- Calculator Section -->
                            <table class="individual-calculator-table">
                                @foreach ($ques_mast as $key => $ques)
                                    <tr class="calculator-sec3">
                                        <td data-label="Award" class="heading-sec" colspan="1">
                                            <a href="javascript:void(0)"
                                                @if ($ques->id == 1) class="active-cl" data-src="assets/images/individual-calculator-img/Household-img8.jpg"
                                                @elseif($ques->id == 2)
                                                    data-src="assets/images/individual-calculator-img/travel-img8.jpg"
                                                @elseif($ques->id == 3)
                                                    data-src="assets/images/individual-calculator-img/electricity-img4.jpg"
                                                @elseif($ques->id == 4)
                                                    data-src="assets/images/individual-calculator-img/cooking-fuel-consumption-img1.jpg" @endif>
                                                {{ $ques->heading }}
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </td>
                                        <td data-label="Platform" colspan="2">
                                            {{ $ques->question }}
                                            @if ($ques->id == 2 || $ques->id == 3)
                                                ({{ $subques_mast->where('ques_id', $ques->id)->first()->unit }})
                                            @elseif($ques->id == 4)
                                                (Number/Rupees)
                                            @endif
                                        </td>
                                        <td data-label="Year" class="m-DN">
                                            @if ($ques->id != 1)
                                                @if ($ques->id == 2)
                                                    @for ($i = 1; $i < 4; $i++)
                                                        <select class="form-control form-control-sm tot mb-2"
                                                            id="travel_{{ $i }}">
                                                            <option value="" disabled selected> Select</option>
                                                            @foreach ($subques_mast->where('ques_id', $ques->id) as $sub)
                                                                <option value="{{ $sub->emission_factor }}">
                                                                    {{ $sub->subques }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endfor
                                                @else
                                                    <select class="form-control form-control-sm tot"
                                                        @if ($ques->id == 3) id="electricity"
                                                        @elseif ($ques->id == 4)
                                                            id="fuel" @endif>
                                                        <option value="" disabled selected> Select</option>
                                                        @foreach ($subques_mast->where('ques_id', $ques->id) as $sub)
                                                            <option value="{{ $sub->emission_factor }}">{{ $sub->subques }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            @endif
                                        </td>
                                        <td data-label="Platform" class="text-center">
                                            @if ($ques->id == 2)
                                                @for ($i = 1; $i < 4; $i++)
                                                    <input type="text" class="form-control form-control-sm tot mb-2"
                                                        id="travel_val_{{ $i }}">
                                                @endfor
                                            @else
                                                <input type="text" class="form-control form-control-sm tot"
                                                    @if ($ques->id == 1) id="house_val"
                                                    @elseif ($ques->id == 3)
                                                        id="electricity_val"
                                                    @elseif ($ques->id == 4)
                                                        id="fuel_val" @endif>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="calculator-sec4">
                                    <td colspan="3" class="text-left">
                                        <strong> Total Emissions for Individual per Month (Kg CO<sub>2</sub>e)</strong>
                                    </td>
                                    <td class="text-center animation-btn-css">


                                        <div class="button-icon">
                                            <button class="button" onclick="Total(this)" data-toggle="modal" data-target="">
                                                <p class="title">Calculate</p>
                                                <img src="assets/images/calculator-icon.png" alt="">
                                                <p class="description">Calculate</p>
                                            </button>

                                            <button class="button" id="modelShow" style="display: none;" data-toggle="modal"
                                                data-target="#exampleModal"> </button>
                                        </div>

                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm tot height"
                                            id="total_emisssion" disabled="">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
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
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Meter Gauge</h5> --}}
                    <img src="assets/images/logo/ESG-Prakrit-logo4.png" alt="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body meterGauge">
                    <div class="meterGauge-text">
                        <h4 id="person_name"></h4>
                    </div>
                    {{-- <canvas id="meterGauge" width="400" height="200">  </canvas> --}}
                    <div class="celebration-dec">
                        <div class="row">
                            {{-- <div class="col-lg-6">
                            <canvas id="meterGauge" width="400" height="200"></canvas>
                        </div> --}}

                            <div class="col-lg-12">
                                {{-- <img src="assets/images/batch-logo-1.png" alt=""> --}}
                                <img src="assets/images/blank-batch-logo1.png" alt="" class="img-fluid">
                                <div id="emissionValue" class="overlay-text"></div>
                                <div class="calc-kg"><strong>(Kg CO<sub>2</sub>e)</strong></div>

                            </div>
                        </div>
                    </div>

                    <div class="dashboard-info-video">
                        <img src="../assets/images/video/confetti-party-popper.gif" alt="">
                    </div>

                    <div class="col-lg-12">
                        <div class="meterGauge-text">
                            <h4>Incredible! You are an <br />ESG PRAKRIT CHAMPION!</h4>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="meterGauge-social-media">
                            <ul>
                                <li>
                                    <a href="#">
                                        <h4>Share</h4><i class="fa-solid fa-share-from-square"></i>
                                    </a>

                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <p
                            style="font-size: 12px;font-style: italic;color: #555;text-align: center;margin-top: 10px;font-weight: 600;">
                            <strong>Disclaimer:</strong> Calculations are based on self-declared data.
                        </p>

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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script> --}}

    <script>
        $(".individual-calculator .individual-calculator-table tbody tr td a").mouseover(function() {
            var value = $(this).attr('data-src');
            $(".award-img img").attr("src", value);
        })

        $('#submit').on('click', function() {
            var name = $('#name').val();
            var mobile = $('#mobile').val();
            var mobileRegex = /^[0-9]{10}$/;

            if (!name) {
                alert('Please enter your name.');
                return;
            }

            if (!mobile || !mobileRegex.test(mobile)) {
                alert('Please enter a valid 10-digit mobile number.');
                return;
            }

            $('#calculatorForm').show();
        });

        // Handle "Send OTP" button click
        $('#sendOtpBtn').on('click', function() {
            var mobile = $('#mobile').val();
            var name = $('#name').val();

            // Validate mobile and name before making the AJAX request
            if (!mobile || !name) {
                alert('Please enter both mobile number and name.');
                return;
            }
            // console.log('Sending request with:', { mobile, name });
            $.ajax({
                url: '{{ route('sendOtp') }}',
                type: 'POST',
                dataType: 'json', // Expect JSON response
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    mobile: mobile,
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        // alert('OTP sent');
                        $('#otpVerificationForm').show(); // Show OTP verification form
                        $('#sendOtpBtn').hide(); // Optionally hide the OTP button form after sending the OTP
                    } else {
                        alert('Failed to send OTP. Please try again.');
                    }
                },
                error: function(xhr) {
                    console.error('Error occurred:', xhr.responseText);
                    alert('Please Check the Data.');
                }
            });
        });

        // Handle "Submit OTP" button click
        $('#submitOtpBtn').on('click', function() {
            var otp = $('#otp').val();
            var mobile = $('#mobile').val();
            var name = $('#name').val();

            if (!otp || !mobile) {
                alert('Please enter the OTP and mobile number.');
                return;
            }

            if (!mobile.match(/^[6-9]\d{9}$/)) {
                alert("Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
                return;
            }

            $.ajax({
                url: '{{ route('verifyOtp') }}',
                type: 'POST',  // Ensure it's POST
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    mobile: mobile,
                    otp: otp,
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        $('#otpVerificationForm').hide();
                        $('#calculatorForm').show();
                    } else {
                        alert('Invalid OTP');
                    }
                },
                error: function(xhr) {
                    console.error('Error occurred:', xhr.responseText);
                    alert('Please Check the Data.');
                }
            });

        });

        // Handle "Resend OTP" button click
        $('#resendOtpBtn').on('click', function() {
            var mobile = $('#mobile').val();
            var name = $('#name').val();

            if (!mobile || !name) {
                alert('Please enter both mobile number and name.');
                return;
            }

            if (!mobile.match(/^[6-9]\d{9}$/)) {
                alert("Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
                return;
            }


            $.ajax({
                url: '{{ route('sendOtp') }}',
                type: 'POST',  // Ensure it's POST
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    mobile: mobile,
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response)
                    if (response.success) {
                        alert('OTP Resent');
                    } else {
                        alert('Failed to resend OTP. Please try again.');
                    }
                },
                error: function(xhr) {
                    console.error('Error occurred:', xhr.responseText);
                    alert('An error occurred. Please try again.');
                }
            });
        });


        var gaugeChart;

        function Total(e) {
            // var house = document.getElementById("house").value;
            var travel_1 = document.getElementById("travel_1").value;
            var travel_2 = document.getElementById("travel_2").value;
            var travel_3 = document.getElementById("travel_3").value;
            var electricity = document.getElementById("electricity").value;
            var fuel = document.getElementById("fuel").value;

            var house_val = document.getElementById("house_val").value;
            var travel_val_1 = document.getElementById("travel_val_1").value;
            var travel_val_2 = document.getElementById("travel_val_2").value;
            var travel_val_3 = document.getElementById("travel_val_3").value;
            var electricity_val = document.getElementById("electricity_val").value;
            var fuel_val = document.getElementById("fuel_val").value;

            house_val = parseFloat(house_val);
            travel_val_1 = parseFloat(travel_val_1);
            travel_val_2 = travel_val_2 ? parseFloat(travel_val_2) : null; // Allow null
            travel_val_3 = travel_val_3 ? parseFloat(travel_val_3) : null; // Allow null
            electricity_val = parseFloat(electricity_val);
            fuel_val = parseFloat(fuel_val);

            if (travel_1 === "" || electricity === "" || fuel === "") {
                alert("Please Select all the fields.");
                return;
            }

            if (isNaN(house_val) || isNaN(travel_val_1) || isNaN(electricity_val) || isNaN(fuel_val)) {
                alert("Please fill all the required fields with valid values.");
                return;
            }


            // Check for negative values
            if (travel_1 < 0 || electricity < 0 || fuel < 0 || house_val < 0 || travel_val_1 < 0 || electricity_val < 0 ||
                fuel_val < 0) {
                alert("Values cannot be negative.");
                return;
            }

            if ((travel_val_2 !== null && travel_val_2 < 0) || (travel_val_3 !== null && travel_val_3 < 0)) {
                alert("Optional travel values cannot be negative.");
                return;
            }

            tot_travel_emiss = (travel_1 * travel_val_1) + (travel_2 * travel_val_2) + (travel_3 * travel_val_3)

            emiss_travel = tot_travel_emiss * 30;
            // emiss_travel = (travel * travel_val) * 30;
            emiss_electricity = (electricity * electricity_val) / house_val;
            emiss_fuel = (fuel * fuel_val) / house_val;

            tot_emiss = emiss_travel + emiss_electricity + emiss_fuel;

            $('#total_emisssion').val(tot_emiss.toFixed(2));

            var name = document.getElementById("name").value;
            document.getElementById("person_name").innerText = name;

            $("#modelShow").trigger('click');

            // Update the meter gauge with total emissions
            updateGauge(tot_emiss);
        }

        function updateGauge(tot_emiss) {
            var data = {
                value: tot_emiss,
                max: 2000,
                label: "Emission"
            };

            if (gaugeChart) {
                gaugeChart.destroy();
            }

            // Update the value in the div
            document.getElementById('emissionValue').innerText = data.value.toFixed(2);


            // Chart.js chart's configuration
            // We are using a Doughnut type chart to
            // get a Gauge format chart
            // This is approach is fine and actually flexible
            // to get beautiful Gauge charts out of it
            var config = {
                type: 'doughnut',
                data: {
                    labels: [data.label],
                    datasets: [{
                        data: [data.value, data.max - data.value],
                        backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(0, 0, 0, 0.1)'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 85,
                    rotation: -90,
                    circumference: 180,
                    tooltips: {
                        enabled: false
                    },
                    legend: {
                        display: false
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: false
                    },
                    title: {
                        display: true,
                        text: data.label,
                        fontSize: 16
                    }
                }
            };

            // Create the chart
            var chartCtx = document.getElementById('meterGauge').getContext('2d');
            gaugeChart = new Chart(chartCtx, config);
        }
    </script>
@endpush
