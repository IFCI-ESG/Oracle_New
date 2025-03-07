@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')

    <div class="container-fluid mt-4">

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
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="user-add-sec">
                <form action="{{ route('admin.user.apidata') }}" id="user_create" role="form" method="get" class="prevent_multiple_submit_details" files="true" enctype="multipart/form-data" accept-charset="utf-8">
    @csrf

    <div class="card border-primary">
        <div class="card card-success card-outline shadow p-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 textcolor">Add Exposure</h5>
            </div>
        </div>


        <div class="card-body m-4 m-4 mt-0 pt-0">
            {{-- <h3 class="text-center ms-4">Add Exposure</h3> --}}
            <table class="table table-sm">
                <tbody style="border-style: hidden!important;">
                @if (Auth::user()->hasRole('Admin'))
                <tr>
                                        <th class="company-head">IFSC Code <span class="text-danger">*</span></th>
                                        <td>
                                            
                                            <select id="ifsc_code" name="ifsc_code" class="form-control" required oninput="fetchBranchDetails()">
                                                <option value="">Select IFSC Code </option>
                                                @foreach($ifsc_codes as $ifsc_code)
                                                <option value="{{  $ifsc_code->ifsc_code }}"> {{ auth()->user()->id == $ifsc_code->id ? $ifsc_code->ifsc_code . ' (Head Office)' : $ifsc_code->ifsc_code  }}</option>

                                                @endforeach
                                            </select>
                                            @error('ifsc_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr style="border-style: hidden!important;">
                                        <th class="company-head">Branch Name</th>
                                        <td>
                                            <input type="text" id="branch_name" name="branch_name" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    <tr style="border-style: hidden!important;">
                                        <th class="company-head">Branch Address</th>
                                        <td>
                                            <input type="text" id="full_address" name="full_address" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    @endif
                                 <tr style="border-style: hidden!important;">
                                    <th class="company-head">PAN of the Customer <span class="text-danger">*</span></th>
                                 <td>
                                 <input type="text" id="pan" name="pan" class="form-control">
                                     @error('pan')
                                        <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </td>
                         </tr>
                         <th class="company-head"> </th>
                            <td  class="text-left">  
                            <button type="submit" id="details" class="btn activebtnbg company-btn btn-primary p-2 btn-sm" style="width: auto;">
                             <em class="fa fa-search"></em>&nbsp;&nbsp; Get Details
                            </button>

                            </td>


                     
                </tbody>
            </table>
           </div>
       
        </div>
         
</form>
         </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        <script>
            $(document).ready(function () {
                console.log('testing');
                const btn1 = document.getElementById("details");
    
                $('.prevent_multiple_submit_details').on('submit', function(event) {
                    // event.preventDefault();
    
                    $('#det').html('<div class="offset-md-4 msg1"><span class="text-danger text-sm text-center">Please wait while your request is being processed. &nbsp&nbsp&nbsp<i class="fa fa-spinner fa-spin" style="font-size:24px;color:black"></i></span></div>');
    
                    btn1.disabled = true;
                    setTimeout(function() {
                        btn1.disabled = false;
                    }, 1000 * 20);  // 20 seconds
    
                    // Hide the loading message after 20 seconds
                    setTimeout(function() {
                        $(".msg1").fadeOut();
                    }, 1000 * 20);  // 20 seconds
                });
            });
        </script>
         <script>
        $(document).ready(function () {
             
            window.fetchBranchDetails = function() {
                var ifsc_code = $('#ifsc_code').val(); 
                console.log('Selected IFSC Code:', ifsc_code);
    
                if (ifsc_code) {
                   
                    $.ajax({
                        url: '{{ route('admin.user.getBranchDetails') }}',  
                        method: 'GET',
                        data: { ifsc_code: ifsc_code },
                        success: function(response) {
                            
                            if (response.name && response.full_address) {
                                $('#branch_name').val(response.name);
                                $('#full_address').val(response.full_address);
                            } else {
                                alert('Branch details not found!');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('AJAX Error:', status, error);
                            alert('Unable to fetch branch details.');
                        }
                    });
                }
            };
        });
    </script>
       @endsection
 