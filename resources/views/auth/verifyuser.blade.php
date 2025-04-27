@extends('layouts.app', ['title' => 'ESG PRAKRIT'])



@section('content')
    <!-- Start Content-->
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User status</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>Account Activation status:
                        @if(Auth::user()->isactive == 'Y')
                        <span class="text-success">ACTIVATED</span>
                        @else
                        <span class="text-danger">NOT ACTIVATED</span>
                        <p>Please wait for your Account Activation before proceeding.</p>
                        <p> Please read following information carefully :-</p>
                        <ul>
                            <li>
                                <p><b>Applicant has to verify E-Mail and Mobile provided during registration</b></p>
                            </li>

                        </ul>
                        @endif
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
