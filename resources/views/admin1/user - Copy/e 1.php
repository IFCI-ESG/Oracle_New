@extends('layouts.user.dashboard-master')
@section('title')
Add Questionnaire
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
            <div class="col-md-12">
                <form action="{{ route('user.questionnaire.store') }}" id="bankDetails_create" role="form" method="post"
                    class='prevent_multiple_submit' files=true enctype='multipart/form-data' accept-charset="utf-8">
                    @csrf
                    <div class="card border-primary m-2">
                        <div class="card-header bg-gradient-info p-1">
                            <b>Questionnaire</b>
                        </div>

                        <div class="card border-primary m-2">

                            <div class="card-body mt-4">
                                <table class="table table-sm table-bordered table-hover">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Particulars</th>
                                            <th class="text-center">Detail</th>
                                        </tr>
                                       @php
                                           $s_no = 1;
                                       @endphp
                                        @foreach ($questionnaire as $key => $part)
                                        <tr>
                                            <th>{{$s_no}}</th>
                                            <td>{{$part->particular}}
                                            <input type="hidden" value="{{ $part->id }}"
                                                name="part[{{ $key }}][part_id]">
                                            </td>
                                            <td>
                                                <input type="{{$part->data_type}}" id="" required  name="part[{{ $key }}][value]"
                                                    class="form-control form-control-sm text-right" style="width:50%">
                                            </td>
                                        </tr>
                                        @php
                                            $s_no++;
                                        @endphp
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">
                       
                        <div class="col-md-2 offset-md-4">
                            <button type="submit" id="submit"
                                class="btn btn-primary btn-sm form-control form-control-sm form-control form-control-sm-sm">
                                <em class="fas fa-save"></em> Save
                            </button>
                        </div>
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\User\Claims\ClaimS5BankDetailsRequest', '#bankDetails_create') !!} --}}
    {{-- @include('user.partials.js.prevent_multiple_submit') --}}
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
