@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Mobile Number') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="/verifymobile" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="otp">Your OTP</label>
                                    <input type="text" id="otp" name="otp"
                                        class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}" required>
                                    @if ($errors->has('otp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first() }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="verify" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>



                    {{ __('If you did not receive the OTP') }},
                    <form class="d-inline" method="POST" action="#">
                        @csrf
                        <button type="submit"
                            class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
