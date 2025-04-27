@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])
@section('css')
    @vite('node_modules/dropify/dist/css/dropify.min.css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'
    ])
@endsection


<link rel="stylesheet" href="css/custom.css">

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert" id="successAlert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
             {{ session('success') }}
    </div>
@elseif(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert" id="failAlert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                {{ session('error') }}  
            </div>
 @endif
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Start Content-->
    <div class="container-fluid">
    
    <div class="content">
        <div class="container-fluid ">
            <div class="user_home">
                <div class="container ">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="shadow-div card-body h-100">
                                <div class="row align-items-center h-100">
                                    <div class="col-sm-4 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="user-profile-sec">
                                                <img src="{{ asset('images/company_image.png') }}" class="img-radius img-thumbnail rounded bg-white"
                                                    alt="User-Profile-Image" height="150">
                                            </div>
                                            @if (isset($corp_users))
                                                <h4 class="profile-username text-center">{{ $corp_users->name }}</h4>
                                                <p class="text-dark text-center"> {{ $corp_users->cin_llpin }}</p>
                                           
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="card-block d-flex flex-column">
                                            @if (isset($corp_users))
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-4 border">
                                                        <h4 class="mb-2 h4">Sector</h4>
                                                    </div>
                                                    <div class="col-sm-6 border">
                                                        <h3 class="mb-2 h4">{{ $corp_users->sector_name_org }}

                                      @php

                                    $sectorclass = ($corp_users->sector_id == 21) ? $corp_users->sector_name : '';
                                    @endphp
                                    @if($sectorclass)
                                    ({{$sectorclass}})
                                    @endif


                                                         </h3>
                                                    </div>
                                                </div>


                                                
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-4 border">
                                                        <h4 class="mb-2 h4">Segment</h4>
                                                    </div>
                                                    <div class="col-sm-6 border">
                                                        <h3 class="mb-2 h4">{{ $corp_users->com_type }}</h3>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-sm-4 border">
                                                        <h4 class="mb-2 h4">Authorized Signatory</h4>
                                                    </div>
                                                    <div class="col-sm-6 border">
                                                        <h3 class="mb-2 h4">{{ $corp_users->contact_person }}</h3>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-sm-4 border">
                                                        <h4 class="mb-2 h4">Designation</h4>
                                                    </div>
                                                    <div class="col-sm-6 border">
                                                        <h3 class="mb-2 h4">{{ $corp_users->designation }}</h3>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-sm-4 border">
                                                        <h4 class="mb-2 h4">Email</h4>
                                                    </div>
                                                    <div class="col-sm-6 border">
                                                        <h3 class="mb-2 h4 text-break">{{ $corp_users->email }}</h3>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-sm-4 border">
                                                        <h4 class="mb-2 h4">Mobile</h4>
                                                    </div>
                                                    <div class="col-sm-6 border">
                                                        <h3 class="mb-2 h4">{{ $corp_users->mobile }}</h3>
                                                    </div>
                                                </div>
                                            
                                            @endif
                                            
                                        </div>
                                         
                                        <!-- Center the Edit button -->
                                        <div class="text-center mt-4">
                                            @if (isset($corp_users))
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal" onclick="setEditId({{ $corp_users->id }})">   
                                                <span class="menu-icon"><i class="fa fa-edit"></i></span> Edit Profile
                                             </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModal">Update Profile</h5>
                <!-- Close Button -->
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editForm" method="POST" action="{{ route('users.update2') }}">
             @csrf
            <input type="hidden" name="id" id="editId" value="{{ isset($corp_users) ? $corp_users->id : '' }}">
   
     @if (isset($corp_users))
     <div class="row">
       <div class="col-md-12 mb-3">
            <label for="name" style="color:black;">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{  $corp_users->name  }}" required readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="email" style="color:black;">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $corp_users->email  }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="mobile" style="color:black;">Mobile</label>
            <input type="text" name="mobile" class="form-control" id="mobile" value="{{  $corp_users->mobile  }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="designation" style="color:black;">Designation</label>
            <input type="text" name="designation" class="form-control" id="designation" value="{{  $corp_users->designation }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="contact_person" style="color:black;">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ $corp_users->contact_person  }}" required>
        </div>
    </div>
    @endif
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>

 <script>
    function setEditId(userId) {
        document.getElementById('editId').value = userId;
    }
</script>

<script>
    setTimeout(function() {
        var alert = document.getElementById('successAlert');
        if (alert) {
            var closeButton = alert.querySelector('.btn-close');
            closeButton.click();  
        }
    }, 2000);  
</script>
<script>
    setTimeout(function() {
        var alert = document.getElementById('failAlert');
        if (alert) {
            var closeButton = alert.querySelector('.btn-close');
            closeButton.click();  
        }
    }, 2000);  
</script>

@endsection
