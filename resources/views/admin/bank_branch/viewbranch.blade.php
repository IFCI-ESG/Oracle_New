@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <div class="card border-primary mt-4">
                    <div class="card card-success card-outline shadow p-2">
                        <b>Branch Details</b>
                    </div>
                    <div class="card border-primary m-2 mt-0">
                        <div class="card-body">
                            <table class="table table-sm table-striped table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="table-success">
                                        <th style="width: 8%">S.No</th>
                                        <th style="width: 32%">Particulars</th>
                                        <th style="width: 60%">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <th>IFSC Code <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="ifsc_code" name="ifsc_code"
                                                value="{{ $bank_details->ifsc_code }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <th>Branch Name <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="branch_name" name="branch_name"
                                                value="{{ $bank_details->name }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <th>MICR <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="micr_code" name="micr_code"
                                                value="{{ $bank_details->micr_code }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <th>Address <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="full_address" name="full_address"
                                                value="{{ $bank_details->full_address }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <th>Pincode <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="number" id="pincode" name="pincode"
                                                value="{{ $bank_details->pincode }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <th>State <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="state" name="state"
                                                value="{{ $bank_details->state }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7.</td>
                                        <th>District <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="district" name="district"
                                                value="{{ $bank_details->district }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8.</td>
                                        <th>Email <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="email" id="email" name="email"
                                                value="{{ $bank_details->email }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9.</td>
                                        <th>Contact Person <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="contact_person" name="contact_person"
                                                value="{{ $bank_details->contact_person }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10.</td>
                                        <th>Designation <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="text" id="designation" name="designation"
                                                value="{{ $bank_details->designation }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11.</td>
                                        <th>Mobile <span style="color: red;">*</span></th>
                                        <td>
                                            <input type="tel" id="mobile" name="mobile"
                                                value="{{ $bank_details->mobile }}"
                                                class="form-control form-control-sm" style="width: 50%"
                                                readonly />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 mb-4">
                        <a href="{{ route('admin.bank_branch.index') }}"
                            class="btn btn-secondary btn-sm form-control form-control-sm p-2">
                            <em class="fas fa-arrow-left"></em> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endsection
