@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

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
        <style>
            .form-check-label {
                font-size: 1.1rem;
            }

            .form-check-input:checked+.form-check-label {
                color: #007bff;
                font-weight: bold;
            }

            .form-check-input:focus {
                box-shadow: none;
            }

            .Environmernt {
                color: darkgreen;
                font-weight: 800;
                font-size: 20px;
            }

            .Social {
                color: blue;
            }

            .Governance {
                color: yellowgreen;
            }

            .table tbody tr td input {
                height: auto;
            }
        </style>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('user.scoring.store') }}" id="gov_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit' files=true enctype='multipart/form-data'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" value="{{ $fy_id }}" name="fy_id">
                    <input type="hidden" value="{{ $user->id }}" name="com_id">

                    <div class="card card-outline-governance card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"
                                        style="    border-left-color: #495057;"><b>Scoring Data For
                                            FY-{{ $fys->fy }}</b></a>
                                </li>
                            </ul>
                        </div>



                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="governance" role="tabpanel"
                                    aria-labelledby="governance-tab">

                                    @foreach ($question as $key => $pillerdata)
                                        <div class="card card-outline-governance" style="    border: 3px solid #12CCCC;">
                                            <div class="card-header">
                                                <b class="{{ $key }}">{{ $key }}<b>


                                                        @foreach ($pillerdata as $key1 => $subpiller)
                                                            <div class="card card-outline-governance">
                                                                <div class="card-header">
                                                                    <h5>{{ $key1 }}<h5>


                                                                            @php
                                                                                $i = 1;
                                                                            @endphp
                                                                            @foreach ($subpiller as $key2 => $value)
                                                                                <div class="card-body p-3">
                                                                                    <table
                                                                                        class="table table-bordered table-hover table-sm table-striped"
                                                                                        id="board-table">

                                                                                        <tbody>

                                                                                            <tr>
                                                                                                <td class="text-center"
                                                                                                    style="width: 5%">
                                                                                                    {{ $i }}
                                                                                                </td>
                                                                                                <td style="width: 40%">
                                                                                                    {{ $value->question }}

                                                                                                </td>
                                                                                                <td style="width: 40%">
                                                                                                    <div class="form-check">
                                                                                                        <input
                                                                                                            type="radio"
                                                                                                            name="answer[{{ $value->id }}]"
                                                                                                            id="orange"
                                                                                                            value="1"
                                                                                                            style="       height: auto !important;">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="1">
                                                                                                            {{ $value->option1 }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input
                                                                                                            type="radio"
                                                                                                            name="answer[{{ $value->id }}]"
                                                                                                            id="orange"
                                                                                                            value="2"
                                                                                                            style="       height: auto !important;">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="1">
                                                                                                            {{ $value->option2 }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    @if ($value->option3)
                                                                                                        <div
                                                                                                            class="form-check">
                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                name="answer[{{ $value->id }}]"
                                                                                                                id="orange"
                                                                                                                value="3"
                                                                                                                style="       height: auto !important;">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="1">
                                                                                                                {{ $value->option3 }}
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    @if ($value->option4)
                                                                                                        <div
                                                                                                            class="form-check">
                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                name="answer[{{ $value->id }}]"
                                                                                                                id="orange"
                                                                                                                value="4"
                                                                                                                style="       height: auto !important;">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="1">
                                                                                                                {{ $value->option4 }}
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    @endif



                                                                                                </td>

                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                @php
                                                                                    $i++;
                                                                                @endphp
                                                                            @endforeach


                                                                </div>

                                                            </div>
                                                        @endforeach




                                            </div>

                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>

                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.scoring.index') }}" class="btn btn-warning btn-sm float-left"> <i
                                        class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-2 offset-md-3">

                                {{-- <a class="btn Custom-btn-back m-2 btn-sm form-control form-control-sm"
                        href="{{ route('user.print_preview', ['com_id'=>encrypt($user->id), 'fy_id'=>encrypt($fy_id)]) }}">
                    Print Preview</a> --}}
                                {{-- @if (!$busi_value->isEmpty()) --}}
                                <button type="submit" id="submit"
                                    class="btn btn-primary btn-sm form-control form-control-sm"><i
                                        class="fas fa-save"></i>
                                    Save As Draft</button>
                                {{-- @endif --}}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

            $(document).delegate(".board", "change", function() {
                var Id = $(this).attr('id');
                Id = Id.substring(4);
                var value_dropdown = $('#details_' + Id);

                if (this.value === "Y") {
                    value_dropdown.removeAttr('readonly');
                } else {
                    value_dropdown.attr('readonly', 'readonly');
                    value_dropdown.val('');
                }
            });

        });

        function Total(e) {
            var classNames = $(e).attr('class');
            classNames = classNames.substring(29);
            className = classNames.replace(' is-valid', '');
            // alert('d');
            var sum = 0;
            $('.' + className).each(function() {
                var value = parseFloat($(this).val()) || 0; // Convert the value to a number or default to 0
                sum += value;
            });
            $('#tot_' + className).val(sum.toFixed(2));

            // Retrieve total complaints and pending complaints
            var tot_complaints = parseFloat($('#tot_complaints').val()) || 0;
            var tot_pending_complaints = parseFloat($('#tot_pending_complaints').val()) || 0;

            // Calculate percentage and handle division by zero
            var percentage = tot_complaints > 0 ? (tot_pending_complaints / tot_complaints) * 100 : 0;

            // Set the percentage value in the respective field
            $('#complaints_percentage').val(percentage.toFixed(2));
        }
    </script>
@endpush
