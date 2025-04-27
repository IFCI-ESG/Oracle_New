@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.shared.page-title' , ['title' => 'Climate Risk','subtitle' => 'Environment'])

        <style>
            .risk-container {
                background-color: #f8f9fa;
                padding: 20px;
            }
            
            .risk-heading {
                margin-bottom: 30px;
                color: #333;
                font-size: 24px;
            }
            
            .risk-image {
                width: 100%;
                height: 300px;
                object-fit: cover;
                margin-bottom: 20px;
                border: 1px solid #e0e0e0;
            }
            
            .risk-button {
                display: inline-block;
                background-color: #2e7d32;
                color: white;
                text-align: center;
                padding: 10px 15px;
                border-radius: 4px;
                text-decoration: none;
                width: 200px;
                margin: 0 auto;
                font-weight: 500;
            }
            
            .risk-button:hover {
                background-color: #1b5e20;
                color: white;
                text-decoration: none;
            }
            
            .back-button {
                display: inline-flex;
                align-items: center;
                color: #6c757d;
                background-color: #e2e6ea;
                padding: 8px 20px;
                border-radius: 4px;
                text-decoration: none;
                margin-top: 30px;
            }
            
            .back-button:hover {
                background-color: #d3d9df;
                color: #5a6268;
                text-decoration: none;
            }
            
            .back-button i {
                margin-right: 8px;
            }
            
            .text-center {
                text-align: center;
            }
        </style>

        <div class="risk-container">
            <div class="row">
                <div class="col-12">
                    <h2 class="risk-heading">Risk</h2>
                </div>
            </div>
            
            <div class="row">
                <!-- Physical Risk -->
                <div class="col-md-6 mb-4">
                    <img src="../asset/images/dashboard-img/thematic-physical.jpg" alt="Physical Risk" class="risk-image">
                    <div class="text-center">
                        <a href="{{ route('user.physical.index') }}" class="risk-button">Physical Risk</a>
                    </div>
                </div>
                
                <!-- Transition Risk -->
                <div class="col-md-6 mb-4">
                    <img src="../asset/images/dashboard-img/thematic-transition.jpg" alt="Transition Risk" class="risk-image">
                    <div class="text-center">
                        <a href="{{ route('user.transition.index') }}" class="risk-button">Transition Risk</a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('user.climate') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
@endpush
