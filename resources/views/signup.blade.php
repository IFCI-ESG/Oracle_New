@extends('layouts.master')
<link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
@section('content')

<style type="text/css">
   .form-check-input{
        width: auto!important;
        height: auto!important;
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
                <div class="col-12">
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
            <div class="col-lg-12 col-md-12 col-sm-8">
                <div class="contact-from">
                    <div class="section-title">
                        <h5>Sign Up</h5>
                    </div>
                    <div class="main-form">
                        <form action="{{ route('signup') }}" id="" role="form" method="post"
                            class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                            accept-charset="utf-8">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                      <label for="name">
                                          Name <span style="color: red;">*</span>
                                         </label>
                                        <input type="text" placeholder="Your Name" required="required" name="name" 
                                               value="{{ old('name') }}" pattern="^[A-Za-z\s]+$" title="Name should only contain letters and spaces">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                    <label for="organization">
                                          Organization <span style="color: red;">*</span>
                                         </label>
                                        <input type="text" placeholder="Your Organization Name" required="required" name="organization" 
                                               value="{{ old('organization') }}" pattern="^[A-Za-z\s]+$" title="Organization name should only contain letters and spaces">
                                        @error('organization')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <label for="email">
                                          Email <span style="color: red;">*</span>
                                         </label>
                                      <input type="email" id="email" placeholder="Your Email" required="required" name="email" value="{{ old('email') }}">
                                         @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                    <label for="mobile">
                                          Mobile Number <span style="color: red;">*</span>
                                         </label>
                                        <input type="text" placeholder="Your Mobile Number" required="required" name="mobile" 
                                               value="{{ old('mobile') }}" pattern="^\d{10}$" title="Mobile number must be exactly 10 digits">
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                    <label for="pan">
                                          PAN Number <span style="color: red;">*</span>
                                         </label>
                                        <input type="text" placeholder="Your PAN Number" required="required" name="pan" 
                                               value="{{ old('pan') }}" pattern="^[A-Z0-9]{10}$" title="PAN Number should be 10 uppercase letters and numbers only">
                                        @error('pan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                    <label for="designation">
                                          Designation <span style="color: red;">*</span>
                                         </label>
                                        <input type="text" placeholder="Your Designation" required="required" name="designation" 
                                               value="{{ old('designation') }}" pattern="^[A-Za-z\s]+$" title="Designation should only contain letters and spaces">
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-form form-group">
                                      <label for="cin">
                                          CIN Number <span style="color: red;">*</span>
                                         </label>
                                        <input type="text" placeholder="Your CIN Number" required="required" name="cin" 
                                               value="{{ old('cin') }}" pattern="^[A-Za-z0-9]+$" title="CIN Number should be alphanumeric">
                                        @error('cin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                    <label for="address">
                                          Address <span style="color: red;">*</span>
                                         </label>
                                        <textarea placeholder="Your Address" required="required" name="address">{{ old('address') }}</textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                    <label for="remarks">
                                          Remarks
                                         </label>
                                        <textarea placeholder="Any Remarks" name="remarks">{{ old('remarks') }}</textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <p class="form-message"></p>
                                <div class="col-md-12 text-center">
                                  <div class="single-form animation-btn-css">
                                     <button type="submit" class="animation-btn">
                                       <i class="fas fa-user-plus"></i> Register
                                     </button>
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

@endsection
