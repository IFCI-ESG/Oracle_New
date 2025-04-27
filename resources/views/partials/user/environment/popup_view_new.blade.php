{{-- {{ dd($allt_det)}}{{ route('claim.hsn.update') }} --}}
<form action="{{ route('user.questionnaire.update') }}" id="user_update" role="form" method="post" class='form-horizontal pop_view_prevent_multiple_submit'
    files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf
    @method('patch')
    {{-- @method('put') --}}
    <input type="hidden" name="head_id" id="ques_id_view" value="">
    <input type="hidden" name="sec_id" value="{{ $user->sector_id }}">
    <input type="hidden" name="fy_id" value="{{ $fy_id }}" >
    {{-- <input type="hidden" name = "claim_id" value="{{$claimMast->id}}" id="" class="form-control form-control-sm">
    <input type="hidden" name = "app_id" value="{{$appMast->id}}" id="" class="form-control form-control-sm"> --}}

    <div class="modal fade bd-example-modal-lg" id="ViewModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <div style="border:none; font-weight: bold; font-size:1rem;" id="part_name"
                                class="form-control form-control-sm part_name"></div>
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
                                <table class="table table-bordered  table-sm table-striped">
                                    <thead>
                                        <tr class="text-center table-success">
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Value</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Data Source</th>
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
                        <button type="submit" id="popview_submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                class="fas fa-save"></i>&nbsp;&nbsp; Update</button>
                    </div>
                    <div class="col-md-2 offset-md-3">
                        <button type="button" data-dismiss="modal" aria-label="Close" id="pop_view_close"
                            class="btn-close btn btn-danger btn-sm form-control form-control-sm" aria-label="Close">
                            <i class="fas fa-window-close" aria-hidden="true"></i> &nbsp;&nbsp;Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
