@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite('node_modules/dropify/dist/css/dropify.min.css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'
    ])
@endsection

@section('content')
    <!-- Start Content-->
    <style>
    .highlight-duplicate {
        background-color: #f8d7da !important;
    }
    </style>

    <div class="container-fluid">
      
      @include('layouts.shared.page-title', ['title' => 'Bulk Upload Company', 'subtitle' => 'Forms'])
       @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('error') }}
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="position-absolute top-0 end-0 p-2 mt-2">
                      @if (Auth::user()->hasRole('Admin'))
                           <a href="{{ asset('csv_sample/corp_upload_sample.csv') }}">
                             <button class="btn btn-secondary">
                                <i class="bi bi-download"></i> Sample File
                            </button>
                           </a>
                        @elseif(Auth::user()->hasRole('SubAdmin'))
                            <a href="{{ asset('csv_sample/branch_corp_upload_sample.csv') }}">
                             <button class="btn btn-secondary">
                                <i class="bi bi-download"></i> Sample File
                            </button>
                           </a>
                        @endif
                      
                        <a href="{{ asset('csv_sample/sector_manual.csv') }}">
                            <button class="btn btn-secondary">
                                <i class="bi bi-download"></i> Sector Help Manual File
                            </button>
                        </a>
                        <a href="{{ asset('csv_sample/company_type_manual.csv') }}">
                            <button class="btn btn-secondary">
                                <i class="bi bi-download"></i> Company Type Help Manual File
                            </button>
                        </a>
                        <a href="{{ asset('csv_sample/class_type_manual.csv') }}">
                            <button class="btn btn-secondary">
                                <i class="bi bi-download"></i> Class Type Help Manual File
                            </button>
                        </a>
                        
                    </div>
                    <div class="card-body">
                        <h4 class="header-title d-inline-block mt-2">Exposure File Upload</h4>
                        <p class="sub-header mt-2">
                            Please Upload Your Exposure List with valid IFSC code.
                        </p>
                        <form action="{{ route('admin.user.bulk.company.store') }}" role="form" method="post" class='prevent_multiple_submit-upload' files=true enctype='multipart/form-data' accept-charset="utf-8">
                            @csrf
                            <table class="table">
                                <tbody style="border-style: hidden;">
                                    <tr>
                                        <td>
                                            <span class="file-btn mb-1 d-inline-block"> Upload Data</span>
                                            <span class="file-msg mb-1 d-inline-block">or drag and drop files here</span>
                                            <input type="file" id="file" name="file" class="form-control file-input">
                                            @error('pan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="text-right">
                                            <button type="submit" class="btn btn-primary activebtnbg  btn-sm form-control form-control-sm mt-3 p-2">
                                                Upload
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-md-2 offset-md-0">
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary activebtnbg  btn-sm form-control form-control-sm p-2">
                    <em class="fas fa-arrow-left"></em> Back
                </a>
            </div>
        </div>

        <!-- Modal Structure -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" name="id" id="editId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editIfscCode" class="form-label" style="color:black;">IFSC Code <span class="text-danger">*</span></label>
                            <select class="form-control" id="editIfscCode" name="ifsc_code" required>
                                <option value="">Select IFSC Code</option>
                                @foreach($ifscCodes as $ifscCode)
                                    <option value="{{ $ifscCode }}">{{ $ifscCode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editName" class="form-label" style="color:black;">Company Name</label>
                            <input type="text" class="form-control" id="editName" name="name" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editMobile" class="form-label" style="color:black;">Mobile <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editMobile" name="mobile" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editPan" class="form-label" style="color:black;">PAN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editPan" name="pan" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editContactPerson" class="form-label" style="color:black;">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editContactPerson" name="contact_person" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editSector" class="form-label" style="color:black;">Sector <span class="text-danger">*</span></label>
                            <select class="form-control" id="editSector" name="sector_id" required>
                                <option value=" ">Select Sector</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editZone" class="form-label" style="color:black;">Zone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editZone" name="zone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCompanytype" class="form-label" style="color:black;">Company Type <span class="text-danger">*</span></label>
                            <select class="form-control" id="editCompanytype" name="comp_type_id" required>
                                <option value="">Select Company Type</option>
                                @foreach($company_types as $company_type)
                                    <option value="{{ $company_type->id}}">{{ $company_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-md-12 mb-3">
                            <label for="editClasstype" class="form-label" style="color:black;">Class Type <span class="text-danger">*</span></label>
                            <select class="form-control" id="editClasstype" name="class_type_id" required>
                                <option value="">Select Class Type</option>
                                @foreach($class_types as $class_type)
                                    <option value="{{ $class_type->id}}">{{ $class_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                     </div>
                    
                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
   <!-- Corporate Exposure List Section -->
<div class="row mt-4">
  <div class="col-md-12">
                <div class="card border-primary mt-3">
                    <div class="card card-success card-outline shadow p-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 p-2 textcolor">Corporate Exposure Temp List</h5>
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="row mb-3">
                        <div class="col-md-12">
                        @csrf
                         <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedBtn">
                            <i class="fas fa-trash-alt"></i>  Delete All Exposure List
                         </button>
                        </div>
                      </div>

                        <div class="table-responsive">
                            <table id="companyTable" class="table table-sm  table-hover">
                                <thead>
                                    <tr class="tablebgcolor text-center" style="font-size: 0.8rem; height: 40px;">
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Sr. No</th>
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">IFSC Code</th>
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Company Name</th>
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Mobile</th>
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">PAN</th>
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Contact Person</th>
                                        <th class="d-none textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Sector</th>
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Zone</th>
                                        <th class="d-none textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Company Type</th>
                                        <th class="d-none textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Class Type</th>
                                        <th class="border textcolor" style="padding: 8px 5px; text-align: center; vertical-align: middle;">Actions</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userDetails as $key => $user)
                                        <tr>
                                        <input type="hidden" value="{{$user->id}}" name="area[{{$key}}][row_id]">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">

                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $user->ifsc_code }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->mobile }}</td>
                                            <td class="text-center">{{ $user->pan }}</td>
                                            <td class="text-center">{{ $user->contact_person }}</td>
                                            <td class="text-center d-none">{{ $user->sector_name }}</td>
                                            <td class="text-center">{{ $user->zone }}</td>
                                            <td class="text-center d-none">{{ $user->company_type }}</td>
                                            <td class="text-center d-none">{{ $user->class_type }}</td>
                                            
                                            <td class="text-center">
                                            @csrf
                                            <a href="javascript:void(0)" class="btn Custom-btn-edit btn-sm btn-primary btn-custom-edit" title="Edit" data-id="{{ $user->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                             <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteRow({{$user->id}})">
                                                <i class="far fa-trash-alt"></i>
                                             </a>
                                           </td>
                                         </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                            <div class="row mb-3">
                        <div class="col-md-12">
                        @csrf
                        <div class="d-flex justify-content-center">
                        <div class="d-flex justify-content-center">
                        
                         @if (((!$duplicatemobileCount) && ($duplicatemobileCount == 0))  && ((!$duplicatepanCount) && ($duplicatepanCount == 0))) 
                         <button type="button" class="btn btn-secondary btn-sm" id="finalSubmitBtn">
                          <i class="fas fa-check"></i> Final Submit
                         </button>
                         @endif
                        </div>
                       </div>
                      </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->
@endsection

@section('script')
    @vite(['resources/js/pages/dashboard-4.init.js', 'resources/js/pages/datatables.init.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Function to check column count
        function checkColumnCount() {
            var headerColumnCount = $('#companyTable thead tr th').length;
            var bodyColumnCount = $('#companyTable tbody tr:first td').length;
            return headerColumnCount === bodyColumnCount;
        }

        if (!$.fn.dataTable.isDataTable('#companyTable')) {
            if (checkColumnCount()) {
                $('#companyTable').DataTable({
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true
                });
            } else {
                console.error("DataTable Error: Column count mismatch between header and rows.");
            }
        }
        
        var mobileNumbers = {};
        var panNumbers = {};

       
        $('#companyTable tbody tr').each(function() {
            var mobile = $(this).find('td').eq(3).text().trim(); 
            var pan = $(this).find('td').eq(4).text().trim();  
            mobileNumbers[mobile] = (mobileNumbers[mobile] || 0) + 1;
            panNumbers[pan] = (panNumbers[pan] || 0) + 1;
        });

      $('#companyTable tbody tr').each(function() {
            var mobile = $(this).find('td').eq(3).text().trim(); 
            var pan = $(this).find('td').eq(4).text().trim();  
            if (mobileNumbers[mobile] > 1 || panNumbers[pan] > 1) {
                $(this).addClass('highlight-duplicate'); 
            }
        });


    });
</script>
 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteRow(row_id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "{{ route('admin.user.row.company_temp_row_delete', '') }}/" + row_id,

                success: function(data) {
                    if (data === true) {
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        ).then(() => {
                           
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Not Deleted!',
                            'Your record could not be deleted.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Something went wrong, please try again.',
                        'error'
                    );
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Your record is safe!',
                'info'
            );
        }
    });
}
</script>

<script>
  $(document).on('click', '.btn-custom-edit', function() {
    var row = $(this).closest('tr');

    $('#editForm')[0].reset();   

    var id = $(this).data('id');  
    var ifsc_code = row.find('td').eq(1).text().trim();
    var name = row.find('td').eq(2).text().trim();
    var mobile = row.find('td').eq(3).text().trim();
    var pan = row.find('td').eq(4).text().trim();
    var contactPerson = row.find('td').eq(5).text().trim();
    var sector = row.find('td').eq(6).text().trim();
    console.log(sector);
    var zone = row.find('td').eq(7).text().trim();
    var companytype = row.find('td').eq(8).text().trim();
    var classtype = row.find('td').eq(9).text().trim();

    $('#editId').val(id);
    $('#editIfscCode').val(ifsc_code);
    $('#editName').val(name);
    $('#editMobile').val(mobile);
    $('#editPan').val(pan);
    $('#editContactPerson').val(contactPerson);
    $('#editSector').val(sector);
    $('#editZone').val(zone);
    $('#editCompanytype').val(companytype);
    $('#editClasstype').val(classtype);

    // Show the modal
    $('#editModal').modal('show');
});

$('#editForm').on('submit', function(e) {
    e.preventDefault();

  
    var formData = $(this).serialize();
    console.log(formData);  

    $.ajax({
        url: "{{ route('admin.user.bulk.company.update') }}",
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log(response);
            if(response.success) {
                Swal.fire(
                    'Updated!',
                    'Your record has been updated.',
                    'success'
                ).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire(
                    'Error!',
                    'Mobile Number Or PAN already Exists On different Bank. Please use different Mobile or PAN',
                    'error'
                );
            }
        },
        error: function(xhr, status, error) {
            Swal.fire(
                'Error!',
                'Something went wrong. Please try again later.',
                'error'
            );
        }
    });
});

</script>

<script>
 $('#deleteSelectedBtn').click(function() {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete all!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('admin.user.bulk.company.delete') }}",   
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"   
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            'All records have been deleted.',
                            'success'
                        ).then(() => {
                            window.location.reload();  // Reload the page after deletion
                        });
                    } else {
                        Swal.fire(
                            'Not Deleted!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Something went wrong, please try again.',
                        'error'
                    );
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Your records are safe!',
                'info'
            );
        }
    });
});

</script>

<script>
 $('#finalSubmitBtn').click(function() {
    Swal.fire({
        title: "Are you sure want to Submit?",
        text: "You won't be able to revert this!",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: 'Yes, Submit all!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('admin.user.bulk.company.finalsubmit') }}",   
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"   
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Submitted!',
                            'All records have been Submitted. It will be displayed in Dashboard after 24 Hours!',
                            'success'
                        ).then(() => {
                            window.location.reload();  
                        });
                    } else {
                        Swal.fire(
                            'Not Submitted!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Something went wrong, please try again.',
                        'error'
                    );
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Your records are not submitted!',
                'info'
            );
        }
    });
});

</script>
 
@endsection
