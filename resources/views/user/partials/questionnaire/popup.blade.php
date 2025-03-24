<form action="{{ route('user.questionnaire.docstore') }}" id="doc_create" role="form" method="post" class='form-horizontal' files=true enctype='multipart/form-data' accept-charset="utf-8">
    @csrf
      {{-- {{dd($allt->scheme_id)}} --}}
                {{-- access dynamic id and name from blade file  --}}
                <input type="hidden" name="part_id" id="pop_id" value="">
                {{-- <input type="hidden" name="row_id" id="row_id" value=""> --}}
                {{-- <input type="hidden" name="section" id="section_data" value=""> --}}
                                {{-- end  --}}

<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="card">
    <div class="card-header bg-gradient-info">
        <b>Upload Documents</b>
    </div>
</div>

<div class="card">
    <div class="card-body py-1 px-1">
        <div class="row">
            <div class="table-responsive rounded col-md-12">
                <table class="table table-bordered table-hover table-sm" >
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 15%">Particulars</th>
                            <th class="text-center" style="width: 20%">Upload</th>
                            
                        </tr>
                    </thead>
                    <tbody id="popupTable">
                      
                        <tr id="row1">
                            <td>
                                <input class="form-control form-control-sm" readonly type="text" name="pop_value" id="pop_value" value="">
                            </td>
                            <td>
                                <input type="file" name="doc" class="form-control form-control-sm">
                            </td>
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
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn-close btn btn-danger btn-sm form-control form-control-sm" data_ca_id="" aria-label="Close">
            <i class="fas fa-window-close" aria-hidden="true"></i> Close</button>
    </div>
</div>
</div>
</div>
</div>
</form>


@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\QuestionaireDocRequest', '#doc_create') !!}
@endpush

