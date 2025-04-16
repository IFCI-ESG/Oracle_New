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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card border-success m-2">
                    <div class="card card-success card-outline shadow p-1">
                        <b>Bank Details</b>
                    </div>
                    <input type="hidden" value="{{ $bank_details->id }}" name="user_id">
                    <div class="card border-primary m-2">
                        <div class="card-body mt-4">
                            <table class="table table-sm table-striped table-hover">
                                <tbody>
                                    <tr class="table-success">
                                        <th class="text-center" style="width: 20%">S.No</th>
                                        <th class="text-center" style="width: 30%">Particulars</th>
                                        <th class="text-center" style="width: 40%">Value</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">1.</th>
                                        <th style="font-size: 0.9rem">Bank Name</th>
                                        <td>
                                            <input type="text" id="bank_name" name="bank_name" value="{{$bank_details->name}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">2.</th>
                                        <th style="font-size: 0.9rem">PAN</th>
                                        <td>
                                            <input type="text" id="pan" name="pan" value="{{$bank_details->pan}}"
                                                class="form-control form-control-sm text-right" style="width:50%; background-color: #f0f0f0; color: #333;" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">3.</th>
                                        <th style="font-size: 0.9rem">License Key</th>
                                        <td>
                                            <input type="text" id="license_key" name="license_key" value="{{$bank_details->license_key}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">4.</th>
                                        <th style="font-size: 0.9rem">Valid From</th>
                                        <td>
                                            <input type="date" id="valid_from" name="valid_from" value="{{$bank_details->valid_from}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">5.</th>
                                        <th style="font-size: 0.9rem">Valid To</th>
                                        <td>
                                            <input type="date" id="valid_to" name="valid_to" value="{{$bank_details->valid_to}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">6.</th>
                                        <th style="font-size: 0.9rem">Email</th>
                                        <td>
                                            <input type="email" id="email" name="email" value="{{$bank_details->email}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">7.</th>
                                        <th style="font-size: 0.9rem">Contact Person</th>
                                        <td>
                                            <input type="text" id="contact_person" name="contact_person" value="{{$bank_details->contact_person}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">8.</th>
                                        <th style="font-size: 0.9rem">Designation</th>
                                        <td>
                                            <input type="text" id="designation" name="designation" value="{{$bank_details->designation}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                     <th class="text-center" style="font-size: 0.9rem">9.</th>
                                        <th style="font-size: 0.9rem">
                                          Type of Sector <span style="color: red;">*</span>
                                      </th>
                                        <td>
                                         <select id="bank_sector_type" name="bank_sector_type" class="form-control form-control-sm" style="width:50%" required>
                                            <option value="" disabled selected>Select Sector Type</option>
                                             <option value="public" {{ old('bank_sector_type', $bank_details->bank_sector_type) == 'public' ? 'selected' : '' }}>Public</option>
                                             <option value="private" {{ old('bank_sector_type', $bank_details->bank_sector_type) == 'private' ? 'selected' : '' }}>Private</option>
                                          </select>
                                     </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">10.</th>
                                        <th style="font-size: 0.9rem">Mobile</th>
                                        <td>
                                            <input type="tel" id="mobile" name="mobile" value="{{$bank_details->mobile}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">11.</th>
                                        <th style="font-size: 0.9rem">Alternate Mobile</th>
                                        <td>
                                            <input type="number" id="altr_mobile" name="altr_mobile" value="{{$bank_details->altr_mobile}}"
                                                class="form-control form-control-sm text-right" style="width:50%" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size: 0.9rem">12.</th>
                                        <th style="font-size: 0.9rem">Purpose</th>
                                        <td colspan="2">
                                            <table>
                                                <tbody>
                                                    @foreach ($services as $key => $serve)
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <label for="environment" style="font-size: 0.9rem">{{$serve->services}} </label>&nbsp;&nbsp;
                                                            </td>
                                                            <td class="text-center" style="width: 50%;">
                                                                <input type="checkbox" class="services margin-right" id="service_{{ $serve->id }}" name="services[]" value="{{$serve->id}}" {{ in_array($serve->id, $storedServices) ? 'checked' : '' }} disabled>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <a href="{{ route('admin.new_admin.index') }}"
                            class="btn btn-secondary btn-sm form-control form-control-sm">
                            <em class="fas fa-arrow-left"></em> Back
                        </a>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
@endsection
