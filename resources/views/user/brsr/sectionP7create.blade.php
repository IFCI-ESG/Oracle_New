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
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           {{ $error }}
        </div>
        @endforeach

    @endif

  @if(session('success'))

<div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       {{ session('success') }}
    </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
           {{ session('error') }}
        </div>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('user.brsr.sectionp7store') }}" id="social_store" role="form" method="post"
                    class='form-horizontal prevent_multiple_submit'
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" value="{{ $fy_id }}" name="fy_id">
                    <input type="hidden" value="{{ $user->id }}" name="com_id">
                    @if (isset($social_mast->id))
                        <input type="hidden" value="{{ $social_mast->id }}" name="brsr_mast_id">
                    @endif

                    <div class="card card-success card-outline card-tabs shadow-lg">
                        <div class="card-header p-0 pt-3 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="social-tab" data-toggle="pill" href="#social"
                                        role="tab" aria-controls="social" aria-selected="true"><b>BRSR Section C (PRINCIPLE WISE PERFORMANCE DISCLOSURE - PRINCIPLE 7) Data For FY-{{$fys->fy}}</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="social" role="tabpanel" aria-labelledby="social-tab">
                      
                                <div class="card card-success card-outline mt-4">
                                  <div class="card-header">
                                     <b>PRINCIPLE 7 Businesses, when engaging in influencing public and 
                                        regulatory policy, should do so in a manner that is responsible and transparent </b> <br /><br />
                                     <b>Essential Indicators</b> <br /><br />
                                     <b>1. a. Number of affiliations with trade and industry chambers/ associations.</b>
                                  </div>
                                  <div class="card-body p-1">
                                    <textarea class="form-control form-control-sm" name="additionals1[1][text_a]" placeholder="" rows="6"></textarea>
                                  </div>
                              </div>
 
                        <div class="card card-success card-outline mt-4">
                          <div class="card-header">
                           <b>b. List the top 10 trade and industry chambers/ associations (determined based on the
                           total members of such body) the entity is a member of/ affiliated to.</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Name of the trade and industry chambers/associations </th>
                      <th style="width: 30%" class="text-center">Reach of trade and industry chambers/ associations (State/National)</th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows1">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn1"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>

      <div class="card card-success card-outline mt-4">
                         <div class="card-header">
                         <b>2. Provide details of corrective action taken or underway on any issues related to anticompetitive conduct by the entity, based on adverse orders from regulatory authorities. </b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 30%" class="text-center">Name of authority</th>
                      <th style="width: 30%" class="text-center">Brief of the case</th>
                      <th style="width: 30%" class="text-center">Corrective action taken</th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows2">
                <tr>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                  </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn2"><i class="fas fa-plus"></i>Add</button>
        </div>
      </div>
        
            <div class="card card-success card-outline mt-4">
                         <div class="card-header">
                         <b> Leadership Indicators </b> <br /> <br />
                         <b>1. Details of public policy positions advocated by the entity:</b>
                        </div>
                       <div class="card-body p-3">
                       <table class="table table-bordered table-hover table-sm table-striped" id="additional_data_table">
                      <thead>
                      <tr class="text-center table-success">
                      <th style="width: 10%" class="text-center">S.No</th>
                      <th style="width: 30%" class="text-center">Public policy advocated</th>
                      <th style="width: 30%" class="text-center">Method resorted for such advocacy</th>
                      <th style="width: 30%" class="text-center">Whether information available in public domain? (Yes/No)</th>
                      <th style="width: 30%" class="text-center">Frequency of Review by Board (Annually/Half yearly/Quarterly/Others –please specify)</th>
                      <th style="width: 30%" class="text-center">Web Link, if available</th>
                      <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
               <tbody id="additional_data_rows3">
                <tr>
                  <td class="text-center">1</td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_c]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_d]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                  <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[1][text_e]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                   <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                   </td>
             </tr>
          </tbody>
          </table>
          <button type="button" class="btn btn-success btn-sm" id="add_row_btn3"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>
        </div>
                             </div>
                            </div>
                        </div>


                        <div class="row pb-2 mt-2">
                            <div class="col-md-2 ml-4">
                                <a href="{{ route('user.brsr.index') }}"
                                class="btn btn-warning btn-sm float-left"> <i
                                    class="fas fa-arrow-left"></i> Back </a>
                            </div>

                            <div class="col-md-2 offset-md-3">
                             <button type="submit" id="submit" class="btn btn-primary btn-sm form-control form-control-sm"><i
                                            class="fas fa-save"></i>
                                        Submit</button>
                              
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
     

@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\SocialRequest', '#social_store') !!}
    @include('partials.js.prevent_multiple_submit')

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn1').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td class="text-center">${rowCount}</td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_a]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals2[${rowCount}][text_b]" style=" overflow:hidden; resize:none;"  oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows1').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows1 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn2').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals3[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                     </td>
                </tr>
            `;
            $('#additional_data_rows2').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows2 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        let rowCount = 1;  
        $('#add_row_btn3').click(function() {
            rowCount++;
            let newRow = `
                <tr>
                     <td class="text-center">${rowCount}</td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_a]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_b]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_c]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_d]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td><textarea class="form-control form-control-sm auto-grow" name="additionals4[${rowCount}][text_e]" style=" overflow:hidden; resize:none;" oninput="autoResize(this)"></textarea></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $('#additional_data_rows3').append(newRow);  
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();  
            rowCount--;
            $('#additional_data_rows3 tr').each(function(index) {
                $(this).find('td:first').text(index + 1);  
            });
            
        });
    });
</script>
<script>
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px'; 
    }
    
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.auto-grow').forEach(autoResize);
    });
</script>

@endpush
@endsection