{{-- {{ dd($allt_det)}}{{ route('claim.hsn.update') }} --}}
<form action="{{ route('user.questionnaire.update') }}" id="multi_hsn_edit" role="form" method="post" class='form-horizontal'
    files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf
    @method('patch')
    {{-- @method('put') --}}
    <input type="hidden" name="ques_id" id="ques_id_view" value="">
    <input type="hidden" name="sec_id" value="{{ $user->sector_id }}">
    <input type="hidden" name="fy_id" value="{{ $fy_id }}" >
    {{-- <input type="hidden" name = "claim_id" value="{{$claimMast->id}}" id="" class="form-control form-control-sm">
    <input type="hidden" name = "app_id" value="{{$appMast->id}}" id="" class="form-control form-control-sm"> --}}

    <div class="modal fade bd-example-modal-lg" id="ViewModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <b>Questions</b>
                        {{-- <a class="btn btn-success btn-sm float-right mb-2" id="addRawFeild_view">
                            <i class="fa fa-plus"></i>Add Row</a> --}}
                    </div>
                    {{-- {{dd($allt)}} --}}
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative;">
            <span aria-hidden="true">Close[&times;]</span>
          </button> --}}
                </div>
                <div class="card">
                    <div class="card-body py-1 px-1">
                        <div class="row">
                            {{-- <input type="hidden" name="row_id" id="pop_id_view" value=""> --}}
                            {{-- <input type="hidden" name="section" id="section_data_view" value=""> --}}
                            <div class="table-responsive rounded col-md-12">
                                <table class="table table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%">Sr No.</th>
                                            <th class="text-center" style="width: 20%">Question</th>
                                            <th class="text-center" style="width: 15%">Type</th>
                                            <th class="text-center" style="width: 15%">Value</th>
                                            <th class="text-center" style="width: 5%">
                                                <button type="button" class="form-control btn-sm btn btn-success"
                                                    id="addRawFeild_view"><i class="fa fa-plus"></i>Add</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="quesview" id="popupTable_view">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-2 offset-md-5">
                        {{-- <button type="submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                class="fas fa-save"></i>Update</button> --}}
                    </div>
                    <div class="col-md-2 offset-md-3">
                        <button type="button" data-dismiss="modal" aria-label="Close"
                            class="btn-close btn btn-danger btn-sm form-control form-control-sm" aria-label="Close">
                            <i class="fas fa-window-close" aria-hidden="true"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
