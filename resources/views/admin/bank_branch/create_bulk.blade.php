@extends('layouts.vertical', ['title' => 'File Uploads | Dropzone | Dropify'])

@section('css')
    @vite('node_modules/dropify/dist/css/dropify.min.css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'
    ])
@endsection

@section('content')
<style type="text/css">
    thead, tbody, tfoot, tr, td, th {
        border-style: none!important;
    }
   
    .highlight-duplicate {
        background-color: #f8d7da !important;
    }
</style>


    <!-- Start Content-->
    <div class="container-fluid mt-4">

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
            <div class="col-12">
                <div class="card">
                    <div class="position-absolute top-0 end-0 p-2">
                        <a href="{{ asset('csv_sample/Branch_upload_sample.csv') }}">  
                            <button class="btn btn-secondary mt-2"> <i class="bi bi-download"></i> Sample File </button> 
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="header-title">Branch List File Upload </h4>
                        <p class="sub-header">
                            Upload Your Branches with valid IFSC Code
                        </p>
                        <form action="{{ route('admin.bank_branch_bulk.bulk_store') }}" role="form" method="post" class='prevent_multiple_submit-upload' files=true enctype='multipart/form-data' accept-charset="utf-8">
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
                                            {{-- <input type="hidden" name="file" class="form-control" /> --}}
                                            <button type="submit" class="btn btn-primary activebtnbg btn-sm form-control form-control-sm p-2 mt-3">
                                                Upload
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                      
                        </form>

                        <!-- Preview -->
                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                        
                 <div class="row mb-1">
                    <div class="col-md-2 offset-md-0">
                        <a href="{{ route('admin.bank_branch.index') }}" class="btn btn-secondary activebtnbg p-2 btn-sm form-control form-control-sm">
                            <em class="fas fa-arrow-left"></em> Back
                        </a>
         </div>
     </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->
        </div>
        <!-- end row -->

  <!-- Modal Structure -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" name="id" id="editId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editName" class="form-label" style="color:black;">Branch Name</label>
                            <input type="text" class="form-control" id="editName" name="name" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editEmail" class="form-label" style="color:black;">Email</label>
                            <input type="text" class="form-control" id="editEmail" name="email" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editMobile" class="form-label" style="color:black;">Mobile <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editMobile" name="mobile" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editIfsc" class="form-label" style="color:black;">IFSC Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editIfsc" name="ifsc_code" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editContactPerson" class="form-label" style="color:black;">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editContactPerson" name="contact_person" required>
                        </div>
                       
                      <div class="col-md-6 mb-3">
                            <label for="editDesignation" class="form-label" style="color:black;">Designation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editDesignation" name="designation" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-3">
                           <label for="editPincode" class="form-label" style="color:black;">PIN Code <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" id="editPincode" name="pincode" required>
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
    
    <!--Branch Temp List Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border-primary mt-3">
                    <div class="card card-success card-outline shadow p-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Branch Temp List</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                @csrf
                                 <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedBtn">
                                    <i class="fas fa-trash-alt"></i> Delete All Branch List
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="branchTable" class="table table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Branch Name</th>
                                        <th>Email</th>
                                        <th>IFSC Code</th>
                                        <th>PIN Code</th>
                                        <th>Contact Person</th>
                                        <th>Designation</th>
                                        <th>Mobile</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($branchDetails as $key => $branch)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $branch->name }}</td>
                                        <td>{{ $branch->email }}</td>
                                        <td>{{ $branch->ifsc_code }}</td>
                                        <td>{{ $branch->pincode }}</td>
                                        <td>{{ $branch->contact_person }}</td>
                                        <td>{{ $branch->designation }}</td>
                                        <td>{{ $branch->mobile }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm edit-btn" 
                                                    data-id="{{ $branch->id }}"
                                                    data-name="{{ $branch->name }}"
                                                    data-email="{{ $branch->email }}"
                                                    data-ifsc="{{ $branch->ifsc_code }}"
                                                    data-pincode="{{ $branch->pincode }}"
                                                    data-contact="{{ $branch->contact_person }}"
                                                    data-designation="{{ $branch->designation }}"
                                                    data-mobile="{{ $branch->mobile }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $branch->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                     <div class="d-flex justify-content-center">
                                     @if (((!$duplicatemobileCount) && ($duplicatemobileCount == 0))  && ((!$duplicateIfscCount) && ($duplicateIfscCount == 0))) 
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
    @vite(['resources/js/pages/form-fileuploads.init.js'])
      @vite(['resources/js/pages/dashboard-4.init.js', 'resources/js/pages/datatables.init.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
   $(document).ready(function() {
     function checkColumnCount() {
        var headerColumnCount = $('#branchTable thead tr th').length;
        var bodyColumnCount = $('#branchTable tbody tr:first td').length;
        return headerColumnCount === bodyColumnCount;
     }

     if (!$.fn.dataTable.isDataTable('#branchTable')) {
        if (checkColumnCount()) {
            $('#branchTable').DataTable({
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
    
    var ifscCodes = {};
    var mobileNumbers = {};
    $('#branchTable tbody tr').each(function() {
        var ifsc_code = $(this).find('td').eq(3).text().trim(); 
        var mobile = $(this).find('td').eq(7).text().trim();  
        ifscCodes[ifsc_code] = (ifscCodes[ifsc_code] || 0) + 1;
        mobileNumbers[mobile] = (mobileNumbers[mobile] || 0) + 1;
    });

    $('#branchTable tbody tr').each(function() {
        var ifsc_code = $(this).find('td').eq(3).text().trim(); 
        var mobile = $(this).find('td').eq(7).text().trim();  
        if (ifscCodes[ifsc_code] > 1 || mobileNumbers[mobile] > 1 ) {
            $(this).addClass('highlight-duplicate');
        }
    });
});
</script>

<script>
 $('#deleteSelectedBtn').click(function() {
    Swal.fire({
        title: "Are you sure want to Delete All Branches?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete all!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('admin.bank_branch.delete') }}",   
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
                            window.location.reload();  
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
                url: "{{ route('admin.bank_branch.branch_temp_row_delete', '') }}/" + row_id,
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
    var name = row.find('td').eq(1).text().trim();
    var email = row.find('td').eq(2).text().trim();
    var ifsc_code = row.find('td').eq(3).text().trim();
    var pincode = row.find('td').eq(4).text().trim();
    var contact_person = row.find('td').eq(5).text().trim();
    var designation = row.find('td').eq(6).text().trim();
    var mobile = row.find('td').eq(7).text().trim();
 
    $('#editId').val(id);
    $('#editName').val(name);
    $('#editEmail').val(email);
    $('#editIfsc').val(ifsc_code);
    $('#editPincode').val(pincode);
    $('#editContactPerson').val(contact_person);
    $('#editDesignation').val(designation);
    $('#editMobile').val(mobile);
    
    $('#editModal').modal('show');
});

$('#editForm').on('submit', function(e) { 
    e.preventDefault();
    
    var formData = $(this).serialize();
    console.log(formData);  
    $.ajax({
        url: "{{ route('admin.bank_branch.updatebranch') }}",
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
                    'Mobile Number Or IFSC Code already Exists. Please use different Mobile or IFSC Code',
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
                url: "{{ route('admin.bank_branch.finalsubmit') }}",   
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

