@extends('layouts.master')
<link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
<!-- <link rel="stylesheet" href="{{asset('assets/layout_css/coreui_css/coreui.min.css')}}"> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>

@section('content')

<style type="text/css">
   .form-check-input{
        width: auto!important;
        height: auto!important;
    }

    #ms1 {
        width : 50%;
    } 
 


    

</style>
<section class="bg_cover contact-us-bg_cover" style="background-image: url(assets/images/contactusesg.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
    </div>
</section>

<!--====== PAGE BANNER PART ENDS ======-->




<!--====== contact-us PART START ======-->

<section  class="contact-us gray-bg">
    <div class="container">
        <div class="row">
               <div class="row" style="margin-top:10px">
                    <div class="col-12 ">
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
        </div>
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="contact-address">
                    <div class="contact-heading">
                        <h5>Address</h5>
                        {{-- <p>IFCI Ltd.</p> --}}
                    </div>
                    <ul>
                        <li>
                            <div class="single-address">
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="cont">
                                    <p>IFCI Tower, 61 Nehru Place, New Delhi-110 019</p>
                                </div>
                            </div>
                        </li>
                      <!--   <li>
                            <div class="single-address">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="cont">
                                    <p><strong>Phone Nos :</strong></p>
                                    <p>+91 9560969186</p>
                                </div>
                            </div>
                        </li> -->
                        <li>
                            <div class="single-address">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="cont">
                                    <p><strong>Enquiry Mail :</strong></p>
                                    <p>esg@ifciltd.com</p>
                                </div>
                            </div>
                        </li>
                        {{-- <li>
                            <div class="single-address">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="cont">
                                    <p><strong>Portal Issues :</strong></p>
                                    <p>info@testmail.com</p>
                                </div>
                            </div>
                        </li> --}}
                        <!-- <li>
                            <div class="single-address">
                                <div class="icon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="cont">
                                    <p>www.yoursite.com</p>
                                    <p>www.example.com</p>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>

            </div>

            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="contact-from">
                    <div class="section-title">
                        <h5>Connect With Us</h5>
                        <!-- <h2>Get In Touch</h2> -->
                    </div>
                    <div class="main-form">
                        <form action="{{ route('inquiry') }}" id="" role="form" method="post"
                            class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                            accept-charset="utf-8">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="text" placeholder="Your name" required="required" name="name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <div class="help-block with-errors"></div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="email" placeholder="Email" required="required" name="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <div class="help-block with-errors"></div> --}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="text" placeholder="Subject" required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> --}}

                                    <div class="col-md-6" >
                                    <br />
                                    <div class=" form-group">
                                     <select id="ms1"  multiple="multiple" name="services[]" class="form-multi-select" >
                                       
                                    <option value="" disabled selected hidden>Please Select Services</sub>
                                    </option>
                                        @foreach ($services_mast as $serv)
                                            <option value="{{$serv->id}}">{{$serv->services}}</option>
                                        @endforeach
                                    </select>

                                    </div>
                                    </div>

                                   
                                           

      <!--                           <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <div class="multiselect">
                                            <div class="selectBox" >
                                                <select class="form-multi-select" name="services[]" id="ms12" multiple data-coreui-search="true" multiple="multiple">
                                                    <option value="" selected disabled>Please Select Services</option>
                                                    @foreach ($services_mast as $serv)
                                                        <option value="{{$serv->id}}">{{$serv->services}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div> -->



                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="tel" placeholder="Phone" required="required" name="mobile"   pattern="[1-9]{1}[0-9]{9}">
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <div class="help-block with-errors"></div> --}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-form form-group">
                                        <textarea placeholder="Message" required="required" name="message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="single-form animation-btn-css">
                                        <button type="submit" class="animation-btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<div class="map map-big">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3504.657077874119!2d77.25025167456943!3d28.55002538782435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3c59b2e8e17%3A0xb9d54a6d9773171e!2sIFCI%20Limited!5e0!3m2!1sen!2sin!4v1723729316342!5m2!1sen!2sin" width="100%" height="450" style="border:0;display: block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

@endsection

@push('scripts')

<!-- <script src="{{asset('js/jquery.nice-select.min.js')}}"></script> -->
<script src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<!-- <script src="{{asset('assets/layout_js/coreuijs/coreui.js')}}"></script> -->
    <script>

        $(document).ready(function() {
            // $('#multiselect').multiselect({
            //     buttonWidth: '400px'
            // });

              $('#ms1').multiselect();
        });
        // multiselect js

        // var expanded = false;

        // function showCheckboxes() {
        //     var checkboxes = document.getElementById("checkboxes");
        //     if (!expanded) {
        //         checkboxes.style.display = "block";
        //         expanded = true;
        //     } else {
        //         checkboxes.style.display = "none";
        //         expanded = false;
        //     }
        // }

    // multiselect js end

    </script>

@endpush






