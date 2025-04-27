@extends('layouts.admin.master')

@section('title')
Applicant - {{ $userDetails->name }}
@endsection

@push('styles')
<link href="{{ asset('css/app/application.css') }}" rel="stylesheet">
<link href="{{ asset('css/app/progress.css') }}" rel="stylesheet">
@endpush


@section('content')
{{-- Error Messages --}}
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.
    <br>
    <br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- Content Starts --}}
<div class="row">
    <div class="col-lg-12">
        <form  action="{{ route('admin.users.updateAuthorization',$userDetails->id) }}" id="auth-create" role="form" method="post"
            class='form-horizontal' files=true enctype='multipart/form-data' accept-charset="utf-8">
            @csrf
            <input type="hidden" value="{{$userDetails->id}}" name="user_id" id="user_id">
            <div class="row py-4">
                <div class="col-md-12">
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <strong>Brief Particulars of the Company</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover">
                                <caption></caption>
                                <tbody>
                                    <tr>
                                        <th class="w-50">Name of the Organization</th>
                                        <td>{{$userDetails->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>PAN</th>
                                        <td>{{$userDetails->pan}}</td>
                                    </tr>
                                    <tr>
                                        <th>Registered Office Address</th>
                                        <td>{{$userDetails->off_add}}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{$userDetails->off_city}}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td>{{$userDetails->off_state}}</td>
                                    </tr>
                                    <tr>
                                        <th>Pin Code</th>
                                        <td>{{ $userDetails->off_pin}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-primary">
                        <div class="card-header bg-gradient-info">
                            <strong>Authorization Change</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm table-bordered table-hover">
                                        <caption></caption>
                                        <tr>
                                            <th>Name</th>
                                            <td><input type="text" id="contact_person" name="contact_person" class="form-control form-control-sm" value="{{$userDetails->contact_person}}" ></td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td><input type="text" id="designation" name="designation" class="form-control form-control-sm" value="{{$userDetails->designation}}" ></td>
                                        </tr>
                                        <tr>
                                            <th>Contact Number</th>
                                            <td><input type="text" maxlength="10" id="mobile" name="mobile" class="form-control form-control-sm" value="{{$userDetails->mobile}}" ></td>
                                        </tr>
                                        <tr>
                                            <th>E-Mail</th>
                                            <td><input type="email" id="email" name="email" class="form-control form-control-sm" value="{{$userDetails->email}}" ></td>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle;">Registered Office Address</th>
                                            <td><textarea class="form-control" name="off_add" required>{{ $userDetails->off_add }}</textarea></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="table table-sm table-bordered table-hover">
                                                    <tr class="table-primary">
                                                        <th class="text-center">State</th>
                                                        <th class="text-center">City</th>
                                                        <th class="text-center">Pincode</th>
                                                    </tr>
                                                    <td>
                                                        <select id="off_state"  name="off_state" 
                                                            class="form-control form-control-sm">
                                                            <option value="" disabled>Select</option>
                                                            @foreach ($states as $key2 => $value)
                                                                <option value="{{ $key2 }}" @if($userDetails->off_state==$value) selected @endif>{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('state')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select id="off_city" name="off_city"
                                                            class="form-control form-control-sm">
                                                            <option value="" disabled>Select</option>
                                                                @foreach($city as $kcity => $vcity)
                                                                <option value="{{ $vcity->city }}" @if($userDetails->off_city==$vcity->city) selected @endif>{{ $vcity->city}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('city')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" name="off_pin" id="off_pin"class="form-control name_list" value="{{$userDetails->off_pin}}"/>
                                                    </td>
                                                </table>
                                            </td>    
                                        </tr>
                                        <tr>
                                            <th>Authorize Signatory Approval Letter</th>
                                            <td><input accept=".pdf" type="file" id="authorizationLetter" name="authorizationLetter" class="form-control form-control-sm" value="" ></td>
                                        </tr>                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                @if(!Auth::user()->hasRole('ViewOnlyUser'))
                <div class="col-2 offset-md-5">
                    <button type="submit" class="btn btn-primary btn-sm form-control form-control-sm">
                        <em class="fas fa-save"></em> Submit</button>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-primary">
                        <div class="card-header bg-gradient-info">
                            <strong>Authorized Signatory Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Designation</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">E-Mail</th>
                                                <th class="text-center">Update By Email</th>
                                                <th class="text-center">Time</th>
                                                <th class="text-center">Approval Letter</th>
                                            </tr>
                                            @if(isset($authPersons))
                                                @if(count($authPersons)>0)
                                                    @foreach ($authPersons as $ke=>$va)
                                                        <tr>
                                                            <td class="text-center"><strong>OLD</strong></td>
                                                            <td class="text-center">{{isset($va->old_contact_person)? $va->old_contact_person:''}}</td>
                                                            <td class="text-center">{{isset($va->old_designation) ? $va->old_designation:''}}</td>
                                                            <td class="text-center">{{isset($va->old_mobile) ? $va->old_mobile:''}}</td>
                                                            <td class="text-center">{{isset($va->old_email) ? $va->old_email:''}}</td>
                                                            <td rowspan="2" class="text-center">{{isset($va->admin_email) ? $va->admin_email:''}}</td>
                                                            <td rowspan="2" class="text-center">{{isset($va->created_at) ? $va->created_at:''}}</td>
                                                            <td rowspan="2" class="text-center">
                                                                <a class="btn btn-sm bg-success" href='{{route('admin.users.downloadAuthorizationLetter', encrypt($va->upload_id[0]))}}'>Download</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>NEW</strong></td>
                                                            <td class="text-center">{{isset($va->new_contact_person) ? $va->new_contact_person:''}}</td>
                                                            <td class="text-center">{{isset($va->new_designation) ? $va->new_designation:''}}</td>
                                                            <td class="text-center">{{isset($va->new_mobile) ? $va->new_mobile:''}}</td>
                                                            <td class="text-center">{{isset($va->new_email) ? $va->new_email:''}}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                     <tr>
                                                        <td colspan="6" style="color: red">No data found!</td>
                                                     </tr>   
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#off_state').on('change', function () {
            var state = $(this).val();
            if (state) {
                $.ajax({
                    url: '/admin/cities/' + state,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#off_city').empty();
                        $('#off_pin').val('');
                        $('#off_city').append(
                            '<option value="">Please Choose..</option>');
                        $.each(data, function (key, value) {
                            $('#off_city').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#off_city').empty();
            }
        });

        $('#off_pin').keyup(function (e) {
            var pincode = $(this).val();
            if (pincode.length == 6 && $.isNumeric(pincode)) {
                var city = $('#off_city').val();
                var req = '/admin/pincodes/' + city;
                $.getJSON(req, null, function (data) {
                    if ($.inArray(pincode, data) != -1) {
                        console.log(pincode);
                    } else {
                        alert('Pincode Incorrect!');
                        $('#corp_pin').val('');
                    }
                });
            };
        });
    })
</script>
{!! JsValidator::formRequest('App\Http\Requests\Admin\AuthSignatoryRequest','#auth-create') !!}
@endpush
