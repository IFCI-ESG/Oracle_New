@extends('layouts.master_march')

@push('styles')
    <style>
        #submitOtpBtn:hover {
            background: #45a049;
        }

        #resendOtpBtn:hover {
            background: #e64a19;
        }

        .disabled-overlay {
            pointer-events: none; /* Prevents interactions */
            opacity: 0.5; /* Makes it look disabled */
        }
    </style>
@endpush

@section('content')
    <!--====== Know Your Carbon Footprint PART START ======-->
    <div class="carbon-footprint-sec">
        <div class="container">
            <div class="carbon-footprint-head">
                <h2 class="text-center">Your Carbon Footprint</h2>
                    <div class="carbon-footprint-info">
                        <div class="carbon-footprint-header-sec" id="otpForm">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Name:</label>
                                       <input  type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Enter your full name" required  pattern="[A-Za-z\s]{2,50}" title="Name should contain only letters and spaces (2–50 characters)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Mobile:</label>
                                        <input class="form-control form-control-sm" id="mobile"   type="tel" name="mobile" pattern="[6-9]{1}[0-9]{9}"maxlength="10" minlength="10" required placeholder="Enter 10-digit mobile number"




                                        >
                                    </div>
                                </div>
                                <div class="col-md-4 submit-btn">
                                    <button type="button" class="carbon-footprint-submit-btn" id="submit">
                                    Submit
                                    </button>
                                    {{-- <button type="button" class="carbon-footprint-submit-btn" id="sendOtpBtn">
                                        Send OTP
                                    </button> --}}
                                </div>
                            </div>
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


                        <div id="calculatorForm" class="">
                            <div class="carbon-footprint-info-sec">
                                {{-- {{dd($ques_mast)}}  --}}
                                @foreach ($ques_mast as $key => $ques)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="icon-sec">
                                                @if ($ques->id == 1)
                                                    <i class="fa-solid fa-house-chimney"></i>
                                                @elseif($ques->id == 2)
                                                    <i class="fa-solid fa-car"></i>
                                                @elseif($ques->id == 3)
                                                    <i class="fa-solid fa-bolt"></i>
                                                @elseif($ques->id == 4)
                                                    <i class="fa-solid fa-kitchen-set"></i>
                                                @endif
                                                <h4>{{ $ques->heading }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="footprint-text">
                                                <h4>
                                                    {{ $ques->question }}
                                                    {{-- @if ($ques->id == 2 || $ques->id == 3)
                                                        ({{ $subques_mast->where('ques_id', $ques->id)->first()->unit }})
                                                    @elseif($ques->id == 4)
                                                        (Number/Rupees)
                                                    @endif --}}
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row border-bottom-0 pt-2 pb-2">
                                                <div class="col-md-6">
                                                    <div class="select-form-sec disabled-overlay">
                                                        @if ($ques->id != 1)
                                                            @if ($ques->id == 2)
                                                                @for ($i = 1; $i < 4; $i++)
                                                                    <select class="form-select tot"
                                                                        id="travel_{{ $i }}">
                                                                        <option value="" disabled selected> Select</option>
                                                                        @foreach ($subques_mast->where('ques_id', $ques->id) as $sub)
                                                                            <option value="{{ $sub->emission_factor }}">
                                                                                {{ $sub->subques }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endfor
                                                            @else
                                                                <select class="form-select tot"
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
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group disabled-overlay">
                                                        @if ($ques->id == 2)
                                                            @for ($i = 1; $i < 4; $i++)
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <input type="text" class="form-control tot" id="travel_val_{{ $i }}">
                                                                    <span>&nbsp;{{ $subques_mast->where('ques_id', $ques->id)->first()->unit }}</span>
                                                                </div>
                                                            @endfor
                                                        @else
                                                            <div class="d-flex align-items-center gap-1">
                                                                <input type="text" class="form-group tot"
                                                                    @if ($ques->id == 1) 
                                                                        id="house_val"
                                                                    @elseif ($ques->id == 3)
                                                                        style="width: 130px;" id="electricity_val"
                                                                    @elseif ($ques->id == 4)
                                                                        style="width: 130px;" id="fuel_val" @endif>
                                                                    @if ($ques->id == 3)
                                                                        &nbsp;{{ $subques_mast->where('ques_id', $ques->id)->first()->unit }}
                                                                    @elseif($ques->id == 4)
                                                                        &nbsp;
                                                                        <span id="fuel_number" class="d-none">Number</span>
                                                                         <span id="fuel_inr" class="d-none">INR</span>
                                                                       
                                                                    @endif
                                                            </div>
                                                        @endif
                                                    </div>  
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row border-bottom-0 checkbox-sec">
                                    <div class="col-md-12">
                                        <input type="checkbox" name="data_confirmation"> Check the box to store your data
                                    </div>
                                </div>
                            </div>

                            <div class="calculate-sec">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="footprint-text">
                                            <h4 class="mb-0"> Total Emissions for Individual per Month (Kg CO<sub>2</sub>e)</h4>
                                    </div>
                                    </div>
                                    <div class="col-md-4 calc-btn">
                                        <button onclick="Total(this)" class="calculate-btn hexLink active" data-toggle="modal" data-target="">Calculate</button>
                                        <button class="button" id="modelShow" style="display: none;" data-toggle="modal"
                                                        data-target="#certificate"> </button>
                                    </div>
                                </div>
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
    <div class="modal fade services-popup" id="certificate" tabindex="-1" aria-labelledby="certificateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">heading text</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->

                <div class="modal-body services-modal">
                    <div class="modal-body text-center">
                        <div class="modal-body-header">
                            <h2 id="person_name"></h2>
                        </div>

                        <div class="modal-body-batch-logo">
                            <img src="{{ asset('assets-v1/img/batch-logo.png') }}" alt="Result Image" class="img-fluid">
                        </div>

                        <div class="Footprint-info">
                            <h4>Your Carbon Footprint : <span><div style="font-size: 2.3rem;" id="emissionValue"></div> </span></h4>
                        </div>

                        <div class="esg-prakrit-champion">
                            {{-- <h4 id="prakrit_msg">
                                Incredible! You are an ESG PRAKRIT CHAMPION!
                            </h4> --}}
                            <h4><span id="category"></span></h4>
                            <span id="message"></span>
                        </div>

                        <div class="Share-sec">
                            <div class="col-lg-12">
                                <div class="meterGauge-social-media">
                                    <ul>
                                        <li><a href="#"><h4>Share</h4><i class="fa-solid fa-share-from-square"></i></a></li>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                                        </li>
                                        <li>
                                            {{-- <a href="#"><i class="fa-brands fa-instagram"></i></a> --}}
                                            <a href="#"><img class="instagram-icon" src="{{ asset('assets-v1/img/instagram-icon.png') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-linkedin"  style="color: #0A66C2;"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="footer-sec">
                            <!-- <p>Information: India's average per capita GHG emission for 2023 are <br> 2.1 Tonne CO2e/capita. <br> -->
                            </p>
                            <p class="mt-1" style="font-size: 12px;"><i> <b>Disclaimer: The information above is based on self-declared data and is provided solely for the purpose of raising awareness. </i></b></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
@push('scripts')

    <script>

  $(document).ready(function() {
      $('#fuel').on('change', function() {
        var value = $(this).val();
        if (value === '44.8052656') {
          $('#fuel_number').removeClass('d-none');
          $('#fuel_inr').addClass('d-none');
        } else if (value === '.042737') {
          $('#fuel_number').addClass('d-none');
          $('#fuel_inr').removeClass('d-none');
        } else {
          $('#fuel_number').addClass('d-none');
          $('#fuel_inr').addClass('d-none');
        }
      });
    });


        // $(".individual-calculator .individual-calculator-table tbody tr td a").mouseover(function() {
        //     var value = $(this).attr('data-src');
        //     $(".award-img img").attr("src", value);
        // })



        document.getElementById("submit").addEventListener("click", function() {
            document.querySelectorAll(".disabled-overlay").forEach(function(element) {
                element.classList.remove("disabled-overlay");
            });
        });


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

            // $('#calculatorForm').show();
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
                    console.log(response);
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
            document.getElementById("emissionValue").innerHTML = tot_emiss.toFixed(2) + " Kg CO<sub>2</sub>e";

            let category = "";
            let message = "";

            if (tot_emiss >= 0 && tot_emiss <= 90) {
                category = "ESG PRAKRIT Champion";
                message = "Congratulations! Kudos to your Sustainable lifestyle.";
            } else if (tot_emiss >= 91 && tot_emiss <= 175) {
                category = "ESG PRAKRIT STEWARD";
                message = "Well Done! You are a Sustainability Steward, keep going!";
            } else if (tot_emiss >= 176 && tot_emiss <= 284) {
                category = "ESG PRAKRIT Aspirant";
                message = "Well Done Aspirant!, keep moving with Eco-consciousness.";
            } else if (tot_emiss >= 285) {
                category = "ESG PRAKRIT Warrior";
                message = "Keep Working with your efforts towards a Greener tomorrow, Warrior.";
            }

            // Display the result
            document.getElementById("category").innerText = category;
            document.getElementById("message").innerText = message;


            $("#modelShow").trigger('click');

            // Update the meter gauge with total emissions
            // updateGauge(tot_emiss);
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
