@extends('layouts.admin.master')
@section('title')
    Add Borrower
@endsection
@push('styles')
    <link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
    <style>
        input[type="file"] {
            padding: 1px;
        }
    </style>
@endpush
@section('content')
    <div class="container  py-4 px-2 col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- <form action="{{ route('admin.user.update') }}" id="user_create" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}

                    <div id="result"></div>
                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Borrower's Details</b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Company Name</th>
                                            <td><input type="text" id="comp_name" name="comp_name"
                                                    value="{{ $user->name }}" class="form-control form-control-sm"
                                                    readonly>
                                                @error('comp_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>CIN</th>
                                            <td><input type="text" id="cin" name="cin"
                                                    value="{{ $user->cin_llpin }}" class="form-control form-control-sm"
                                                    readonly>
                                                @error('cin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PAN</th>
                                            <td><input type="text" id="pan" name="pan"
                                                    value="{{ $user->pan }}" class="form-control form-control-sm"
                                                    readonly>
                                                @error('pan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="reg_off_add"
                                                            class="col-form-label col-form-label-sm">Registered Address
                                                        </label>
                                                        <textarea name="reg_address" class="form-control form-control-sm" readonly placeholder="Registered office address">{{ $user->reg_off_add }}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_pin"
                                                            class="col-form-label col-form-label-sm">Pincode</label>
                                                        <input type="number" name="pincode" readonly
                                                            class="form-control form-control-sm"
                                                            value="{{ $user->reg_off_pin }}">

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_state"
                                                            class="col-form-label col-form-label-sm">State</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="state" id="regAddState"
                                                            value="{{ $user->reg_off_state }}" readonly>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="reg_off_city"
                                                            class="col-form-label col-form-label-sm">City</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="city" id="regAddState"
                                                            value="{{ $user->reg_off_city }}" readonly>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Borrower's Details</b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        <tr>
                                        <tr>
                                            <th>Email</th>
                                            <td colspan="2"><input type="text" id="email" name="email" disabled
                                                    value="{{ $user->email }}" class="form-control form-control-sm">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person</th>
                                            <td colspan="2"><input type="text" id="auth_name" name="auth_name"
                                                    class="form-control form-control-sm" disabled
                                                    value="{{ $user->contact_person }}">
                                                @error('auth_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td colspan="2"><input type="text" id="designation" name="designation" disabled
                                                    class="form-control form-control-sm" value="{{ $user->designation }}">
                                                @error('designation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td colspan="2"><input type="text" id="mobile" name="mobile" disabled
                                                    class="form-control form-control-sm" value="{{ $user->mobile }}">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <th>Sector</th>
                                        <td colspan="2">
                                            <input type="text"  disabled
                                                    class="form-control form-control-sm" value="{{ $sector->where('id',$user->sector_id)->first()->name }}">

                                        </td>
                                        </tr>
                                        <tr>
                                            <th>Bank Zone</th>
                                            <td colspan="2">
                                                <input type="text"  disabled
                                                    class="form-control form-control-sm" value="{{ $user->zone }}">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Purpose</th>
                                            <td colspan="2">
                                                @if(in_array('E', $user->purpose))
                                                    <label for="environment"
                                                        style="font-size: 0.9rem">Environment:</label>&nbsp;&nbsp;
                                                    <input type="checkbox" id="environment" name="categories[]"
                                                        value="E" disabled
                                                        {{ in_array('E', $user->purpose ?? []) ? 'checked' : '' }}>
                                                    <br>
                                                @endif
                                                @if(in_array('S', $user->purpose))
                                                    <label for="social"
                                                        style="font-size: 0.9rem">Social:</label>&nbsp;&nbsp;
                                                    <input type="checkbox" id="social" name="categories[]" value="S" disabled
                                                        {{ in_array('S', $user->purpose ?? []) ? 'checked' : '' }}>
                                                    <br>
                                                @endif
                                                @if(in_array('G', $user->purpose))
                                                    <label for="governance"
                                                        style="font-size: 0.9rem">Governance:</label>&nbsp;&nbsp;
                                                    <input type="checkbox" id="governance" name="categories[]"
                                                        value="G" disabled
                                                        {{ in_array('G', $user->purpose ?? []) ? 'checked' : '' }}>
                                                @endif

                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Rating</th>
                                            <td colspan="2"><input type="text" id="rating" name="rating"
                                                    min="0" class="form-control form-control-sm" disabled
                                                    value="{{ $user->rating }}">
                                                @error('rating')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rating Date</th>
                                            <td colspan="2"><input type="date" id="rating_date" name="rating_date"
                                                    min="0" class="form-control form-control-sm" disabled
                                                    value="{{ $user->rating_date }}">
                                                @error('rating_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rating Agency</th>
                                            <td colspan="2"><input type="text" id="rating_agency"
                                                    name="rating_agency" min="0"disabled
                                                    class="form-control form-control-sm"
                                                    value="{{ $user->rating_agency }}">
                                                @error('rating_agency')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary m-2" id="result">
                        <div class="card card-success card-outline shadow p-1">
                            <b>Financial Year Wise Details (In Crores) <i class="fa fa-edit"></i></b>
                        </div>

                        <div class="card border-primary m-2">
                            <div class="card-body">
                                <table class="table table-sm table-striped table-hover">
                                    <tbody>
                                        @foreach ($financial as $key=>$fin)
                                        <tr>
                                            <th colspan="2" class="text-center">
                                                {{-- FY- {{$jdecode->data->financials[0]->year}} --}}
                                                FY {{$fin->fy}}
                                                <input type="hidden" id="fy[0][fy]" name="fy[{{$key}}][row_id]" value="{{$fin->id}}">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Borrowings </th>
                                            <td colspan="2"><input type="number" id="borrowings"
                                                    name="fy[{{$key}}][borrowings]" min="0"
                                                    class="form-control form-control-sm text-right" step="0.01" disabled
                                                    value="{{ number_format($fin->borrowings, 2) }}">
                                                @error('borrowings')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bank Exposure(As on 31 March)</th>

                                            <td><input type="number" id="bank_exposure" name="fy[{{$key}}][bank_exposure]"
                                                    class="form-control form-control-sm text-right" min="0" step="0.01" disabled
                                                    value="{{ number_format($fin->bank_exposure, 2) }}">
                                                @error('bank_exposure')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Total Equity (Net Worth)</th>

                                            <td><input type="number" id="total_equity" name="fy[{{$key}}][total_equity]" step="0.01" disabled
                                                    min="0" class="form-control form-control-sm text-right"
                                                    value="{{ number_format($fin->total_equity, 2) }}">
                                                @error('total_equity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Net Revenue </th>
                                            <td><input type="number" id="net_revenue" name="fy[{{$key}}][net_revenue]" min="0"
                                                    class="form-control form-control-sm text-right" step="0.01" disabled
                                                    value="{{ number_format($fin->net_revenue, 2) }}">
                                                @error('net_revenue')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Profit After Tax </th>
                                            <td><input type="number" id="profit_after_tax" name="fy[{{$key}}][profit_after_tax]"
                                                    min="0" class="form-control form-control-sm text-right" step="0.01" disabled
                                                    value="{{ number_format($fin->profit_after_tax, 2) }}">
                                                @error('profit_after_tax')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row pb-3">
                        <a href="{{ route('admin.user.index') }}"
                            class="btn btn-warning btn-sm float-left col-1 ml-2"> <i class="fas fa-arrow-left"></i>
                            Back </a>


                {{-- </form> --}}


            </div>
        </div>
    </div>
    </div>
@endsection

