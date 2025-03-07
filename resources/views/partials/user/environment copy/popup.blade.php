<form action="{{ route('user.questionnaire.store') }}" id="multi_hsn" role="form" method="post" class='form-horizontal'
    files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf
    {{-- {{dd($allt->scheme_id)}}   {{route('claim.hsn')}} --}}
    {{-- access dynamic id and name from blade file  --}}
    <input type="hidden" name="ques_id" id="ques_id" value="">
    <input type="hidden" name="sec_id" value="{{ $user->sector_id }}">
    <input type="hidden" name="fy_id" value="{{ $fy_id }}" >
    {{-- <input type="hidden" name="section" id="section_data" value=""> --}}
    {{-- end  --}}


    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <b>Question</b>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body py-1 px-1">
                        <div class="row">
                            <div class="table-responsive rounded col-md-12">
                                <table class="table  table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%">Sr No.</th>
                                            <th class="text-center" style="width: 20%">Question</th>
                                            <th class="text-center" style="width: 15%">Type</th>
                                            <th class="text-center" style="width: 15%">Value</th>
                                            <th class="text-center" style="width: 5%">
                                                <button type="button" class="form-control btn-sm btn btn-success"
                                                    id="addRawFeild"><i class="fa fa-plus"></i>Add</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="popupTable">
                                        @php
                                            $sn = 1;
                                        @endphp
                                        {{-- {{dd($ques->id)}} --}}
                                        <tr id="row1">
                                            {{-- <input type="text" name="row_id"  id="row_id" value=""> --}}
                                            <td class="text-center">1</td>
                                            <td>
                                                <div style="border:none; font-weight: bold;" id="part_name"
                                                    class="form-control form-control-sm part_name"></div>
                                                {{-- <input type="text" disabled id="part_name" class="form-control form-control-sm part_name"> --}}
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm select" name="ques[0][type]" id="">
                                                    <option value="" disabled selected>Select</option>
                                                    @foreach ($drop_mast as $drop)
                                                        <option class="drop Ab_{{ $drop->ques_id }}"
                                                            value="{{ $drop->id }}">{{ $drop->particular }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" id=""
                                                    class="form-control form-control-sm" name="ques[0][value]">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-2 offset-md-5">
                        <button type="submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                class="fas fa-save"></i>Save as Draft</button>
                    </div>
                    <div class="col-md-2 offset-md-3">
                        <button type="button" data-dismiss="modal" aria-label="Close"
                            class="btn-close btn btn-danger btn-sm form-control form-control-sm"
                            data_ca_id={{ $sn }} aria-label="Close">
                            <i class="fas fa-window-close" aria-hidden="true"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
