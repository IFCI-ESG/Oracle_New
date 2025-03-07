<form action="{{ route('user.questionnaire.store') }}" id="user_store" role="form" method="post" class='form-horizontal pop_prevent_multiple_submit'
    files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf
    {{-- {{dd($allt->scheme_id)}}   {{route('claim.hsn')}} --}}
    {{-- access dynamic id and name from blade file  --}}
    <input type="hidden" name="seg_id" id="seg_id" value="">
    <input type="hidden" name="sec_id" value="{{ $user->sector_id }}">
    <input type="hidden" name="fy_id" value="{{ $fy_id }}" >
    {{-- <input type="hidden" name="section" id="section_data" value=""> --}}
    {{-- end  --}}


    <div class="modal fade bd-example-modal-xl" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <div style="border:none; font-weight: bold; font-size:1rem;" id="part_name"
                                class="form-control form-control-sm part_name"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body py-1 px-1">
                        <div class="row">
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
                                    <tbody id="popupTable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-2 offset-md-5">
                        <button type="submit" id="pop_submit" class="btn btn-primary btn-sm form-control form-control-sm Custom-btn"><i
                                class="fas fa-save"></i>&nbsp;&nbsp;Save as Draft</button>
                    </div>
                    <div class="col-md-2 offset-md-3">
                        <button type="button" data-dismiss="modal" aria-label="Close" id="pop_close"
                            class="btn-close btn btn-danger btn-sm form-control form-control-sm"
                             aria-label="Close">
                            <i class="fas fa-window-close" aria-hidden="true"></i>&nbsp;&nbsp; Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
