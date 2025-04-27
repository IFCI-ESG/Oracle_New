@extends('layouts.admin.master')

@section('title')
Edit Address
@endsection

@push('styles')
<link href="{{ asset('css/app/preview.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <form  action="{{ route('admin.users.updateCorpAddress',$appMast->id) }}" id="auth-create" role="form" method="post"
            class='form-horizontal' files=true enctype='multipart/form-data' accept-charset="utf-8">
            @csrf
            <div class="row">
                <div class="col-md-12" id="complete_form">

                    <div class="card border-primary mt-2" id="comp">
                        <div class="card-header bg-gradient-info p-1">
                            Applicant / Company Details
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th style="width: 25%" class="pl-4">Company Name
                                            </th>
                                            <td style="width: 74%">{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Incorporation</th>
                                            <td>{{ date('d/m/Y',strtotime($app->doi)) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>CIN</th>
                                            <td>{{ $user->cin_llpin }}</td>
                                        </tr>
                                        <tr>
                                            <th>PAN</th>
                                            <td>{{ $user->pan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Application No</th>
                                            <td>{{ $appMast->app_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>Target Segment</th>
                                            <td> {{ $segs_name }} </td>
                                        </tr>
                                        
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle;">Corporate Office Address</th>
                                            <td><textarea class="form-control" name="corporate_address" required>{{ $app->corp_add }}</textarea></td>
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
                                                        <select id="corp_state"  name="corp_state" 
                                                            class="form-control form-control-sm">
                                                            <option value="" disabled>Select</option>
                                                            @foreach ($states as $key2 => $value)
                                                                <option value="{{ $key2 }}" @if($app->corp_state==$value) selected @endif>{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('state')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select id="corp_city" name="corp_city"
                                                            class="form-control form-control-sm">
                                                            <option value="" disabled>Select</option>
                                                                @foreach($city as $kcity => $vcity)
                                                                <option value="{{ $vcity->city }}" @if($app->corp_city==$vcity->city) selected @endif>{{ $vcity->city}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('city')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" name="corp_pin" id="corp_pin"class="form-control name_list" value="{{$app->corp_pin}}"/>
                                                    </td>
                                                </table>
                                            </td> 
                                            <tr>
                                                <th>Authorize Signatory Approval Letter</th>
                                                <td><input accept=".pdf" type="file" id="appCorprateAddress" name="appCorprateAddress" class="form-control form-control-sm" value="" required></td>
                                            </tr>    
                                        </tr>
                                    </tbody>
                                </table>        
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pb-2">
                <div class="col-md-2 offset-md-5">
                    <button
                        class="btn btn-primary btn-sm form-control form-control-sm"
                        id="finalSubmit"><i class="fas fa-save"></i> Submit</button>
                </div>
            </div>
        </form>    
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
            <div class="card-header bg-gradient-info p-1">
                Corporate Office Address
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-bordered table-hover">
                            <tbody>
                                <tr class="table-primary">
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Company Name</th>
                                    <th class="text-center">Application No</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">State</th>
                                    <th class="text-center">City</th>
                                    <th class="text-center">Pincode</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Approval Letter</th>
                                </tr>
                                @if(isset($corprateAddress))
                                    @if(count($corprateAddress)>0)
                                        @foreach ($corprateAddress as $ke=>$va)
                                            <tr>
                                                <td class="text-center"><strong>New</strong></td>
                                                <td class="text-center" rowspan="2">{{$user->name}}</td>
                                                <td class="text-center" rowspan="2">{{$appMast->app_no}}</td>
                                                <td class="text-center">{{$va->new_crop_add}}</td>
                                                <td class="text-center">{{$va->new_crop_state}}</td>
                                                <td class="text-center">{{$va->new_crop_city}}</td>
                                                <td  class="text-center">{{$va->new_crop_pincode}}</td>
                                                <td rowspan="2" class="text-center">{{isset($va->created_at) ? $va->created_at:''}}</td>
                                                <td rowspan="2" class="text-center">
                                                    <a class="btn btn-sm bg-success" href='{{route('admin.users.downloadAuthorizationLetter', encrypt($va->upload_id[0]))}}'>Download</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><strong>OLD</strong></td>
                                                <td class="text-center">{{$va->old_crop_add}}</td>
                                                <td class="text-center">{{$va->old_crop_state}}</td>
                                                <td class="text-center">{{$va->old_crop_city}}</td>
                                                <td class="text-center">{{$va->old_crop_pincode}}</td>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#corp_state').on('change', function () {
            var state = $(this).val();
            if (state) {
                $.ajax({
                    url: '/admin/cities/' + state,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#corp_city').empty();
                        $('#corp_pin').val('');
                        $('#corp_city').append(
                            '<option value="">Please Choose..</option>');
                        $.each(data, function (key, value) {
                            $('#corp_city').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#corp_city').empty();
            }
        });

        $('#corp_pin').keyup(function (e) {
            var pincode = $(this).val();
            if (pincode.length == 6 && $.isNumeric(pincode)) {
                var city = $('#corp_city').val();
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
@endpush


