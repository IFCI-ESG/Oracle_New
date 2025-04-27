@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
 

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           {{ $error }}
        </div>
        @endforeach

    @endif

  @if(session('success'))
   
<div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       {{ session('success') }}
    </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
           {{ session('error') }}
        </div>
    @endif

<style>

    .form-check-label {
        font-size: 1.1rem;
    }
    .form-check-input:checked + .form-check-label {
        color: #007bff;
        font-weight: bold;
    }
    .form-check-input:focus {
        box-shadow: none;
    }
    .Environmernt{
        color: darkgreen;
        font-weight: 800;
        font-size: 20px;
    }
       .Social{
        color: blue;
    }
       .Governance{
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
@section('content')
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
                            role="tab" aria-controls="social" aria-selected="true" style="    border-left-color: #495057;"><b>Scoring Data For FY-{{$fys->fy}}</b></a>
                        </li>
                    </ul>
                </div>


        <div class="card card-outline-governance">
            <div class="card-header">

   
                    <div class="card-body p-3">
                        <table class="table table-bordered table-hover table-sm table-striped" id="board-table">
                            <tbody>

                               </tbody>
                                   <tr>
                                    <td class="text-center" style="width: 5%" >
                                     <b>  OverAll Rating </b>
                                    </td>
                                    <td class="text-center" style="width: 5%" colspan="2" >
                                     <b>  {{$rating_grade}}  </b>
                                    </td>
                                </tr>
                                <tr>
                                     <td class="text-center" style="width: 5%" >
                                          <canvas id="gaugeChart" width="200" height="200">   </canvas> 
                                    </td>
                                     <td class="text-center" style="width: 5%" >
                                          <canvas id="gaugeChart1" width="200" height="200">   </canvas> 
                                    </td>
                                     <td class="text-center" style="width: 5%" >
                                         <canvas id="gaugeChart2" width="200" height="200">   </canvas> 
                                    </td>
                                </tr>
                              

                               </table>
                               </div>
                           </div>
                       </div>
          


                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="governance" role="tabpanel" aria-labelledby="governance-tab">

                            @foreach($question as $key => $pillerdata) 
                            <div class="card card-outline-governance" style="    border: 3px solid #12CCCC;">
                                <div class="card-header">
                                    <b class="{{$key}}">{{$key}}<b>


            @foreach ($pillerdata as $key1 => $subpiller)
            <div class="card card-outline-governance">
            <div class="card-header">
                <h5>{{$key1}}<h5>
                    @php
                    $i=1;
                    @endphp
                    @foreach ($subpiller as $key2 => $value)
                    <div class="card-body p-3">
                        <table class="table table-bordered table-hover table-sm table-striped" id="board-table">
                            <tbody>
                                <tr>
                                    <td class="text-center" style="width: 5%" >
                                        {{$i}}
                                    </td>
                                    <td style="width: 40%" >
                                        {{$value->question}}

                                    </td>
                                    <td style="width: 40%">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer[{{$value->id}}]" id="" style="       height: auto !important;" value="1"  @if($value->ans==1) checked @endif >
                                            <label class="form-check-label" for="1">
                                                {{$value->option1}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer[{{$value->id}}]" id="" style="       height: auto !important;" value="2"

                                            @if($value->ans==2) checked @endif
                                            >
                                            <label class="form-check-label" for="1">
                                                {{$value->option2}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer[{{$value->id}}]" id=""  style="       height: auto !important;" value="3">
                                            <label class="form-check-label" for="1"  @if($value->ans==3) checked @endif>
                                                {{$value->option3}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer[{{$value->id}}]" id="" style="       height: auto !important;" value="4"  @if($value->ans==4) checked @endif>
                                            <label class="form-check-label" for="1">
                                                {{$value->option4}}
                                            </label>
                                        </div>
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
                                class="btn Custom-btn-back btn-sm float-left"> <i
                                class="fas fa-arrow-left"></i> Back </a>
                            </div>

          
                    </div>
                    <!-- /.card -->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<script>


    var config = {
      type: 'doughnut',
      data: {
        labels: ['Value', 'Remaining'],
        datasets: [{
          data: [{{$environment_esg_score}}, 10-{{$environment_esg_score}}],  // 75% for value, 25% for remaining
          backgroundColor: ['#4caf50', '#e0e0e0'],  // Green for value, gray for remaining
          borderWidth: 0,
        }]
      },
      options: {
        circumference: 180,  // Half-circle (180 degrees)
        rotation: -90,       // Start from the right side
        cutout: '80%',       // Adjust this value to control the thickness of the gauge
        responsive: true,
        elements: {
          arc: {
            borderWidth: 0  // No border for the arc
          }
        },
        animation: {
          animateRotate: true,  // Enable rotation animation
          animateScale: true    // Enable scale animation
        }, 
        plugins: {
          // Custom plugin to draw text in the center
          tooltip: {
            enabled: false // Disable tooltip
          },
          legend: {
             position: 'top',
            display: true // Hide legend
          },
        title: {
        display: true,
        text: 'Environmernt Score Chart'
         }
        },

      }
    };

    // Get the canvas context and create the chart
    var chartCtx = document.getElementById('gaugeChart').getContext('2d');
    const gaugeChart = new Chart(chartCtx, config);
   
    var config_s = {
      type: 'doughnut',
      data: {
        labels: ['Value', 'Remaining'],
        datasets: [{
          data: [{{$social_esg_score}}, 10-{{$social_esg_score}}],  // 75% for value, 25% for remaining
          backgroundColor: ['#4caf50', '#e0e0e0'],  // Green for value, gray for remaining
          borderWidth: 0,
        }]
      },
      options: {
        circumference: 180,  // Half-circle (180 degrees)
        rotation: -90,       // Start from the right side
        cutout: '80%',       // Adjust this value to control the thickness of the gauge
        responsive: true,
        elements: {
          arc: {
            borderWidth: 0  // No border for the arc
          }
        },
        animation: {
          animateRotate: true,  // Enable rotation animation
          animateScale: true    // Enable scale animation
        }, 
        plugins: {
          // Custom plugin to draw text in the center
          tooltip: {
            enabled: false // Disable tooltip
          },
          legend: {
             position: 'top',
            display: true // Hide legend
          },
        title: {
        display: true,
        text: 'Social Score Chart'
         }
        },

      }
    };

    // Get the canvas context and create the chart
    var chartCtx_s = document.getElementById('gaugeChart1').getContext('2d');
    const gaugeChart_s = new Chart(chartCtx_s, config_s);

 

        var g_config = {
      type: 'doughnut',
      data: {
        labels: ['Value', 'Remaining'],
        datasets: [{
          data: [ {{$governance_esg_score}}, 10-{{$governance_esg_score}}],  // 75% for value, 25% for remaining
          backgroundColor: ['#4caf50', '#e0e0e0'],  // Green for value, gray for remaining
          borderWidth: 0,
        }]
      },
      options: {
        circumference: 180,  // Half-circle (180 degrees)
        rotation: -90,       // Start from the right side
        cutout: '80%',       // Adjust this value to control the thickness of the gauge
        responsive: true,
        elements: {
          arc: {
            borderWidth: 0  // No border for the arc
          }
        },
        animation: {
          animateRotate: true,  // Enable rotation animation
          animateScale: true    // Enable scale animation
        }, 
        plugins: {
          // Custom plugin to draw text in the center
          tooltip: {
            enabled: true // Disable tooltip
          },
          legend: {
             position: 'top',
            display: true // Hide legend
          },
        title: {
        display: true,
        text: 'Governance Score Chart'
         }
        },

      }
    };

    // Get the canvas context and create the chart
    var chartCtx_g = document.getElementById('gaugeChart2').getContext('2d');
    const gaugeChart1 = new Chart(chartCtx_g, g_config);
  </script>

@endpush

