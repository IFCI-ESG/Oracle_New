@extends('layouts.master_march')

@section('title')
    ESG Prakrit
@endsection




@section('content')


    <!-- connect-us-hero-sec -->
    <div class="connect-us-hero-sec">
        <img src="{{asset('assets-v1/img/logo/ESG-Prakrit.png')}}" alt="ESG Logo">
    </div>
    <!-- connect-us-hero-sec end -->

   
    <div class="address-section">
            <div class="container">
               <div class="row justify-content-end" style="margin-top:10px">
                    <div class="col-md-6">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div>
        
   
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="address-sec">
                        <h2>Address</h2>
                        <div class="address-info">
                            <p><i class="fa-solid fa-location-dot"></i>IFCI Tower,61 Nehru Place, New Delhi-110 019.</p>
                            <p><i class="fa-solid fa-phone-volume"></i>+91 9560969186</p>
                            <p><i class="fa-regular fa-envelope"></i>esg@ifciltd.com</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="connect-info">
                        <h2>To know more about ESG PRAKRIT, Please share your contact details.</h2>
                                 <form action="{{ route('inquiry') }}" id="" role="form" method="post"
                            class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                            accept-charset="utf-8">
                            @csrf                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Full Name"  required="required" name="name" value="{{ old('name') }}">
                                          @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email"  required="required" name="email" value="{{ old('email') }}">
                                         @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6" >
                                  <div class="mt-0">
                                    <select class="selectpicker" placeholder="Please Select Services" multiple  name="services[]" aria-label="Default select example" data-live-search="true">
                                      
                                    @foreach ($services_mast as $serv)
                                    <option value="{{ $serv->id }}" {{ (collect(old('services'))->contains($serv->id)) ? 'selected' : '' }}>
                                    {{ $serv->services }}
                                    </option>
                                    @endforeach


                                    </select>
                                  </div>


                                  </div>
              
                                  
                              
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" placeholder="Phone Number"  name="mobile"   pattern="[1-9]{1}[0-9]{9}" maxlength="10"  value="{{ old('mobile') }}">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message" name="message"> {{ old('message') }}</textarea>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="submit-btn-sec">
                                        <button type="submit" class="submit-btn" >Submit</button>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('assets/layout_css/coreui_css/coreui.min.css')}}"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
    
    
    <link rel="stylesheet" href="{{asset('assets-v1/css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
    



    <script src="{{asset('assets-v1/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>` --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

    {{-- <script src="{{asset('js/bootstrap-multiselect.js')}}"></script> --}}
    {{-- <script src="{{asset('js/bootstrap.bundle.js')}}"></script> --}}

<!-- Connect With Us js -->


@endsection
