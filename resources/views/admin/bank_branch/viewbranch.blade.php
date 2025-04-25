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
                                <tbody>
                                    <tr class="table-success">
                                        <th class="text-center p-2" style="width: 5%">Sr.No.</th>
                                        <th class="text-center p-2" style="width: 25%">Particulars</th>
                                        <th class="text-center p-2" style="width: 40%">Value</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">1.</th>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">Branch Name <span style="color: red;">*</span></th>
                                        <td class="d-flex flex-row-reverse justify-content-between gap-2">
                                            <input type="text" id="branch_name" name="branch_name"
                                                value="{{ $bank_details->name }}"
                                                class="form-control form-control-sm text-right" style="max-width: 286px;width:100%;"
                                                placeholder="Enter Branch Name" disabled />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;font-weight: 700;">(Branch
                                                Name - Special Characters And Integers Are Not Allowed)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">2.</th>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">Email <span style="color: red;">*</span></th>
                                        <td class="d-flex flex-row-reverse justify-content-between gap-2">
                                            <input type="email" id="email" name="email"
                                                value="{{ $bank_details->email }}"
                                                class="form-control form-control-sm text-right p-2" style="max-width: 286px;width:100%;"
                                                placeholder="example@domain.com" disabled />
                                            <div id="email-error-message"
                                                style="color: red; display: none; font-size: 0.9rem;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">3.</th>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">Contact Person <span style="color: red;">*</span>
                                        </th>
                                        <td class="d-flex flex-row-reverse justify-content-between gap-2">
                                            <input type="text" id="contact_person" name="contact_person"
                                                value="{{ $bank_details->contact_person }}"
                                                class="form-control form-control-sm text-right" style="max-width: 286px;width:100%;"
                                                placeholder="Enter Contact Person" disabled />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;font-weight: 700;">(Contact
                                                Person - Special Characters And Integers Are Not Allowed)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">4.</th>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">Designation <span style="color: red;">*</span>
                                        </th>
                                        <td class="d-flex flex-row-reverse justify-content-between gap-2">
                                            <input type="text" id="designation" name="designation"
                                                value="{{ $bank_details->designation }}"
                                                class="form-control form-control-sm text-right" style="max-width: 286px;width:100%;"
                                                placeholder="Enter Designation" />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;font-weight: 700;">(Designation
                                                - Special Characters And Integers Are Not Allowed)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">5.</th>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">Mobile <span style="color: red;">*</span> </th>
                                        <td class="d-flex flex-row-reverse justify-content-between gap-2">
                                            <input type="tel" id="mobile" name="mobile"
                                                value="{{ $bank_details->mobile }}"
                                                class="form-control form-control-sm text-right" style="max-width: 286px;width:100%;"
                                                placeholder="Enter 10 digit mobile number" disabled />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;font-weight: 700;">(Please
                                                enter a valid 10-digit Mobile Number)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">6.</th>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">IFSC Code <span style="color: red;">*</span></th>
                                        <td class="d-flex flex-row-reverse justify-content-between gap-2">
                                            <input type="text" id="ifsc_code" name="ifsc_code"
                                                value="{{ $bank_details->ifsc_code }}"
                                                class="form-control form-control-sm text-right" style="max-width: 286px;width:100%;"
                                                placeholder="Enter IFSC Code" disabled maxlength="11" />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;font-weight: 700;">(Please
                                                enter a valid 11-character IFSC Code)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">7.</th>
                                        <th class="text-center align-middle" style="font-size: 0.9rem">Pincode <span style="color: red;">*</span></th>
                                        <td class="d-flex flex-row-reverse justify-content-between gap-2">
                                            <input type="number" id="pincode" name="pincode"
                                                value="{{ $bank_details->pincode }}"
                                                class="form-control form-control-sm text-right p-2" style="max-width: 286px;width:100%;"
                                                placeholder="Enter Pincode" disabled minlength="6" maxlength="6" />
                                            <span
                                                style="color: #888; font-size: 0.8rem; display: block; margin-top: 5px;font-weight: 700;">(Please
                                                enter a valid 6-digit Pincode)</span>
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
