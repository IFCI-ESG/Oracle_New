@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])
@section('css')
    @vite('node_modules/dropify/dist/css/dropify.min.css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'
    ])
    <style>
        .profile-wrapper {
            padding: 15px 0;
            height: calc(100vh - 120px);
            display: flex;
            flex-direction: column;
        }
        .profile-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0,0,0,0.07);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .profile-banner {
            position: relative;
            background: linear-gradient(60deg, #2EC9B1 0%, #1A7D64 100%);
            height: 130px;
            overflow: hidden;
        }
        .banner-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .profile-main {
            position: relative;
            z-index: 10;
            display: flex;
            margin-top: -55px;
            padding: 0 30px;
        }
        .profile-image {
            flex-shrink: 0;
            margin-right: 20px;
        }
        .profile-photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background: white;
            object-fit: contain;
        }
        .profile-info {
            padding-top: 60px;
            flex-grow: 1;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .profile-identity h2 {
            margin: 0 0 5px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }
        .profile-identity p {
            color: #666;
            margin: 0;
            font-size: 15px;
        }
        .edit-button {
            background: #2EC9B1;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 3px 10px rgba(46, 201, 177, 0.2);
        }
        .edit-button:hover {
            transform: translateY(-2px);
            background: #1A7D64;
            box-shadow: 0 6px 15px rgba(46, 201, 177, 0.3);
        }
        .profile-content {
            flex-grow: 1;
            padding: 20px 30px 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            align-content: start;
        }
        .info-card {
            background: #f8f9fa;
            padding: 16px;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }
        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #2EC9B1;
        }
        .services-card {
            grid-column: span 3;
            background: linear-gradient(to right, #f8f9fa, #fff);
            padding: 20px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
            border-left: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }
        .services-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .services-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .services-icon {
            background: #2EC9B1;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            box-shadow: 0 4px 10px rgba(46, 201, 177, 0.3);
        }
        .services-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .services-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
            max-height: 180px;
            overflow-y: auto;
            padding-right: 5px;
        }
        .services-list::-webkit-scrollbar {
            width: 6px;
        }
        .services-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .services-list::-webkit-scrollbar-thumb {
            background: #2EC9B1;
            border-radius: 3px;
        }
        .services-list::-webkit-scrollbar-thumb:hover {
            background: #1A7D64;
        }
        .service-item {
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #444;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            transition: all 0.2s;
            border-left: 3px solid #2EC9B1;
            margin: 0;
        }
        .service-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background: #f8f9fa;
        }
        .service-item i {
            color: #2EC9B1;
            margin-right: 8px;
            font-size: 14px;
            flex-shrink: 0;
        }
        .service-item span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .services-count {
            background: #e8f7f4;
            color: #2EC9B1;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }
        .info-label {
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 6px;
        }
        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            word-break: break-word;
        }
        .alert {
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            animation: fadeInDown 0.5s ease-out;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }
    </style>
@endsection

@section('content')
 
@if (session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert" id="successAlert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
             {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert" id="failAlert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
 @endif
 
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Start Content-->
    <div class="container-fluid profile-wrapper">
        <div class="profile-container">
            <!-- Banner Section -->
            <div class="profile-banner">
                <div class="banner-pattern"></div>
            </div>
            
            <!-- Main Profile Section -->
            <div class="profile-main">
                <div class="profile-image">
                    @php
                        $imagePath = auth()->user()->image;
                    @endphp
                    
                    @if ($imagePath)
                        <img src="{{ asset('storage/' . $imagePath) }}" alt="User Profile" class="profile-photo">
                    @else
                        <img src="{{ asset('assets-v1/img/profile-pic/bank-profile-img.png') }}" alt="User Profile" class="profile-photo">
                    @endif
                </div>
                
                <div class="profile-info">
                    <div class="profile-identity">
                        <h2>{{ $users->name ?? auth()->user()->name }}</h2>
                        <p>{{ $users->designation ?? 'Senior Software Developer' }}</p>
                    </div>
                    
                    @if (isset($users))
                    <button class="edit-button" data-toggle="modal" data-target="#editProfileModal" onclick="setEditId({{ $users->id }})">
                        <i class="fa fa-edit me-1"></i> Edit Profile
                    </button>
                    @endif
                </div>
            </div>
            
            <!-- Profile Content -->
            <div class="profile-content">
                <div class="info-card">
                    <div class="info-label">IFSC Code</div>
                    <div class="info-value">{{ $users->ifsc_code ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">PAN</div>
                    <div class="info-value">{{ $users->pan ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Contact Person</div>
                    <div class="info-value">{{ $users->contact_person ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $users->email ?? 'NA' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Mobile</div>
                    <div class="info-value">{{ $users->mobile ?? 'NA' }}</div>
                </div>
                
                @if (Auth::user()->hasRole('Admin'))
                <div class="services-card">
                    <div class="services-header">
                        <div class="services-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h4 class="services-title">
                            ESG Services
                            @php
                                $services = isset($servicesString) ? explode(', ', $servicesString) : [];
                                $serviceCount = count($services);
                            @endphp
                            <span class="services-count">{{ $serviceCount }} Service{{ $serviceCount != 1 ? 's' : '' }}</span>
                        </h4>
                    </div>
                    
                    <div class="services-list">
                        @if($serviceCount > 0)
                            @foreach($services as $service)
                                <div class="service-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $service }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="service-item">
                                <i class="fas fa-info-circle"></i>
                                <span>No services selected</span>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
   <!-- Modal for Editing Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModal">Update Profile</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ route('admin.user.dataupdate') }}">
                        @csrf
                        <input type="hidden" name="id" id="editId" value="{{ isset($users) ? $users->id : '' }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="ifsc_code" style="color:black;">IFSC Code</label>
                                <input type="text" name="ifsc_code" class="form-control" id="ifsc_code" value="{{ isset($users) ? $users->ifsc_code : 'NA' }}" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" style="color:black;">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ isset($users) ? $users->name : 'NA' }}" required readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email" style="color:black;">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ isset($users) ? $users->email : 'NA'}}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mobile" style="color:black;">Mobile</label>
                                <input type="text" name="mobile" class="form-control" id="mobile" value="{{ isset($users) ? $users->mobile : 'NA' }}" required>
                            </div>

                            @if (Auth::user()->hasRole('Admin'))
                            <div class="col-md-6 mb-3">
                                <label for="pan" style="color:black;">PAN</label>
                                <input type="text" name="pan" class="form-control" id="pan" value="{{ isset($users) ? $users->pan : 'NA' }}" required>
                            </div>
                            @else 
                            <div class="col-md-6 mb-3">
                                <label for="pan" style="color:black;">PAN</label>
                                <input type="text" name="pan" class="form-control" id="pan" value="{{ isset($users) ? $users->pan : 'NA' }}">
                            </div>
                            @endif
                        </div>
                             
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_person" style="color:black;">Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ isset($users) ? $users->contact_person : 'NA' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="designation" style="color:black;">Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation" value="{{ isset($users) ? $users->designation : 'NA' }}" required>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Update Profile</button>
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

