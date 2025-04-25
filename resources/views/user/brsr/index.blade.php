@extends('layouts.user_vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
    @vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')

<!-- Modal for Section Selection -->
<div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="sectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sectionModalLabel"><i>Select Section</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th><i>Section</i></th>
                            <th><i>Action</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" data-section="A">
                            <td style="color:green;"><i>SECTION A (GENERAL DISCLOSURES)</i></td>
                            <td>
                                <button class="btn btn-primary btn-sm sectionAButton" id="sectionA"><i>Create</i></button>
                            </td>
                        </tr>
                        <tr class="text-center" data-section="B">
                            <td style="color:green;"><i>SECTION B (MANAGEMENT AND PROCESS DISCLOSURES)</i></td>
                            <td>
                                <button class="btn btn-primary btn-sm sectionBButton" id="sectionB"><i>Create</i></button>
                            </td>
                        </tr>
                        <tr class="text-center" data-section="C">
                            <td style="color:green;"><i>SECTION C (PRINCIPLE WISE PERFORMANCE DISCLOSURE)</i></td>
                            <td></td> 
                        </tr>
                        <tr class="text-center" data-section="C">
                            <td style="color:blue;"><i>PRINCIPLE 1</i></td>
                            <td>
                                <button class="btn btn-primary btn-sm sectionCButton" id="sectionP1"><i>Create</i></button>
                            </td>
                        </tr>
                        <tr class="text-center" data-section="C">
                            <td style="color:blue;"><i>PRINCIPLE 2</i></td>
                            <td>
                                <button class="btn btn-primary btn-sm sectionCButton" id="sectionP2"><i>Create</i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid">
    @include('layouts.shared.page-title', ['title' => 'BRSR', 'subtitle' => 'BRSR'])

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

    <div class="row">
        <div class="col-lg-10 offset-md-1">
            <div class="card card-success card-outline mt-3 ml-2" style="box-shadow: 0 4px 10px 0 rgba(182, 233, 152, 0.474), 0 5px 20px 0 rgba(182, 233, 152, 0.474);">
                <div class="card-header">
                    <b>Selection of Financial Year </b>
                </div>
                <div class="card border-primary">
                    <div class="card-body p-1 m-2">
                        <div class="row">
                            <div class="table-responsive rounded col-md-12">
                                <table class="table table-bordered table-hover table-sm table-striped" id="appTable" style="width: 100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="">Sr No.</th>
                                            <th class="">Financial Year</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($fys->where('status', '1') as $key => $fy)
                                    @php
                                      $brsrMastItem = \App\Models\BrsrMast::where('fy_id', $fy->id)->where('com_id', Auth::id())->first();
                                    @endphp
                                 
                                         <tr>
                                                <td class="text-center" style="font-size: 1rem"><b>{{ $key + 1 }}</b></td>
                                                <td class="text-center" style="font-size: 1rem">{{ $fy->fy }}</td>
                                                <td class="text-center">
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sectionModal" 
                                                  onclick="setFyId('{{ encrypt($fy->id) }}', '{{ $fy->fy }}', '{{ $fy->id }}', '{{ $brsrMastItem ? encrypt($brsrMastItem->id) : '' }}')">
                                                Create
                                                </button>


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
   
    let fyId = null;
    let mastid = null;
    let brsrValue = @json($brsr_value);
    let brsrValue1 = @json($brsr_sectionb);
    let brsrValue2 = @json($brsr_sectionp1);    
    let brsrValue3 = @json($brsr_sectionp2); 
    let fyData = @json($fys);  
    
    function setFyId(id, fy, ids,mastId) {
        fyId = id;
        fyid = ids;
        fyValue = fy;
        mastid = mastId;
      

    console.log("Mast ID:", mastId);
       
        document.getElementById('sectionModalLabel').innerHTML = `Select Section for FY: ${fyValue}`;
        console.log("Selected FY ID:", fyId);
        console.log("brsrValue:", brsrValue);
        
        const fyExists = brsrValue.some(item => {
            console.log("Checking if item.fy_id:", item.fy_id, "matches fyId:", fyId);
            return item.fy_id == fyid;   
        });

        const fyExists1 = brsrValue1.some(item => {
            console.log("Checking if item.fy_id:", item.fy_id, "matches fyId:", fyId);
            return item.fy_id == fyid;   
        });

        const fyExists3 = brsrValue2.some(item => {
            console.log("Checking if item.fy_id:", item.fy_id, "matches fyId:", fyId);
            return item.fy_id == fyid;   
        });

        const fyExists4 = brsrValue3.some(item => {
            console.log("Checking if item.fy_id:", item.fy_id, "matches fyId:", fyId);
            return item.fy_id == fyid;   
        });

        console.log("fyExists:", fyExists);
        updateSectionButtons(fyExists,fyExists1,fyExists3,fyExists4);
    }

    function updateSectionButtons(fyExists,fyExists1,fyExists3,fyExists4) {
        
        const sectionAButton = document.getElementById('sectionA');
        if (fyExists) {
            sectionAButton.innerHTML = '<i>Edit</i>';
            sectionAButton.classList.remove('btn-primary');
            sectionAButton.classList.add('btn-warning');
        } else {
            sectionAButton.innerHTML = '<i>Create</i>';
            sectionAButton.classList.remove('btn-warning');
            sectionAButton.classList.add('btn-primary');
        }

       const sectionBButton = document.getElementById('sectionB');
        if (fyExists1) {
            sectionBButton.innerHTML = '<i>Edit</i>';
            sectionBButton.classList.remove('btn-primary');
            sectionBButton.classList.add('btn-warning');
        } else {
            sectionBButton.innerHTML = '<i>Create</i>';
            sectionBButton.classList.remove('btn-warning');
            sectionBButton.classList.add('btn-primary');
        }

        const sectionCButton = document.getElementById('sectionP1');
        if (fyExists3) {
            sectionCButton.innerHTML = '<i>Edit</i>';
            sectionCButton.classList.remove('btn-primary');
            sectionCButton.classList.add('btn-warning');
        } else {
            sectionCButton.innerHTML = '<i>Create</i>';
            sectionCButton.classList.remove('btn-warning');
            sectionCButton.classList.add('btn-primary');
        }

        const sectionP2Button = document.getElementById('sectionP2');
        if (fyExists4) {
            sectionP2Button.innerHTML = '<i>Edit</i>';
            sectionP2Button.classList.remove('btn-primary');
            sectionP2Button.classList.add('btn-warning');
        } else {
            sectionP2Button.innerHTML = '<i>Create</i>';
            sectionP2Button.classList.remove('btn-warning');
            sectionP2Button.classList.add('btn-primary');
        }
    }
    
    document.getElementById('sectionA').addEventListener('click', function() {
    if (fyId) {
         
        if (brsrValue.some(item => item.fy_id == fyid)) {
          
           window.location.href = `/user/brsr/sectionAedit/${mastid}`;
          
        } else {
            window.location.href = `/user/brsr/sectionAcreate/${fyId}`;
        }
    }
   });

    document.getElementById('sectionB').addEventListener('click', function() {
        if (fyId) {
            if (brsrValue1.some(item => item.fy_id == fyid)) {
                
                window.location.href = `/user/brsr/sectionBedit/${mastid}`;
            } 
            else {
               
                window.location.href = `/user/brsr/sectionBcreate/${fyId}`;
           }
       }
    });

    document.getElementById('sectionP1').addEventListener('click', function() {
        if (fyId) {
            if (brsrValue2.some(item => item.fy_id == fyid)) {
                window.location.href = `/user/brsr/sectionP1edit/${mastid }`;
            } else {
                window.location.href = `/user/brsr/sectionP1create/${fyId}`;
            }
        }
    });

    document.getElementById('sectionP2').addEventListener('click', function() {
        if (fyId) {
            if (brsrValue3.some(item => item.fy_id == fyid)) {
                window.location.href = `/user/brsr/sectionP2edit/${mastid }`;
            } else {
                window.location.href = `/user/brsr/sectionP2create/${fyId}`;
            }
        }
    });
</script>

@endpush