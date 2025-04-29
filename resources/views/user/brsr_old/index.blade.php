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
    
                <!-- BRSR section tab -->

                <section class="BRSR-tab-sec">
                    <div class="container">
                    <div class="top-tabs-container">
                      <label for="main-tab-1">BRSR Section A</label>
                      <label for="#">BRSR Section B</label>
                      <label for="#">BRSR Section C</label>
                    </div>
                  
                    <!-- Tab Container 1 -->
                    <input class="tab-radio" id="main-tab-1" name="main-group" type="radio" checked="checked"/>
                    <div class="tab-content">
                        <div class="sub-tabs-container">
                            <label for="sub-tab-1" class="sub-color1">I. Details of the listed entity</label>
                            <label for="sub-tab-2" class="sub-color2">II. Products/services</label>
                            <label for="sub-tab-3" class="sub-color3">III. Operations</label>
                            <label for="sub-tab-4" class="sub-color4">IV. Employees </label>
                        </div>
                            <!-- Sub Tab -->
                            <input class="tab-radio" id="sub-tab-1" name="sub-group" type="radio" checked="checked">
                            <div class="sub-tab-content">
                            <!-- section 1 table -->
                            <section class="table-sec">
                                    <div class="container-fluid">
                                        <div class="table-sec-info">
                                            <h1>BUSINESS RESPONSIBILITY & SUSTAINABILITY REPORTING FORMAT</h1>
                                            <h2>SECTION A: GENERAL DISCLOSURES</h2>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <caption> I. Details of the listed entity</caption>
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td class="sec-a-sNo">1</td>
                                                            <td class="sec-a-info">Corporate Identity Number (CIN) of the Listed Entity</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Corporate Identity Number (CIN)' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">2</td>
                                                            <td class="sec-a-info">Name of the Listed Entity</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Name of the Listed Entity' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">3</td>
                                                            <td class="sec-a-info">Year of incorporation</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Year of incorporation' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">4</td>
                                                            <td class="sec-a-info">Registered office address</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Registered office address' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">5</td>
                                                            <td class="sec-a-info">Corporate address </td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Corporate address' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">6</td>
                                                            <td class="sec-a-info">E-mail</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your E-mail' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">7</td>
                                                            <td class="sec-a-info">Telephone</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Telephone' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">8</td>
                                                            <td class="sec-a-info">Website</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Website' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">9</td>
                                                            <td class="sec-a-info">Financial year for which reporting is being done</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Financial year for which reporting is being done' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">10</td>
                                                            <td class="sec-a-info">Name of the Stock Exchange(s) where shares are listed</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Name of the Stock Exchange(s) where shares are listed' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">11</td>
                                                            <td class="sec-a-info">Paid-up Capital</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Paid-up Capital' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">12</td>
                                                            <td class="sec-a-info">Name and contact details (telephone, email address) of the person who may be contacted in case of any queries on the BRSR report</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Name and contact details (telephone, email address)' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">13</td>
                                                            <td class="sec-a-info">Reporting boundary - Are the disclosures under this report made on a standalone basis (i.e. only for the entity) or on a consolidated basis (i.e. for the entity and all the entities which form a part of its consolidated financial statements, taken together).</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Reporting boundary' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">14</td>
                                                            <td class="sec-a-info"> Name of assurance provider</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Name of assurance provider' class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">15</td>
                                                            <td class="sec-a-info"> Type of assurance obtained</td>
                                                            <td>
                                                                <input type="text"  placeholder='Enter Your Type of assurance obtained' class="form-control"/>
                                                            </td>
                                                        </tr>
                                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                            <!-- section 1 table end -->
                            </div>
                            <!-- Sub Tab end -->
        
        
                            <!-- Sub Tab -->
                            <input class="tab-radio" id="sub-tab-2" name="sub-group" type="radio">
                            <div class="sub-tab-content">
                                <!-- section 2 table -->
                                <section class="table-sec">
                                    <div class="container-fluid">
                                        <div class="table-sec-info">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <caption> II. Products/services</caption>
                                                    
                                                    <thead>
                                                        <tr class="table-success">
                                                            <td class="sec-a-sNo">16</td>
                                                            <td class="sec-a-info" colspan="3">Details of business activities (accounting for 90% of the turnover):</td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Description of Main Activity </th>
                                                            <th>Description of Business Activity</th>
                                                            <th>% of Turnover of the entity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="sec-a-sNo">1</td>
                                                            <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">2</td>
                                                            <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">3</td>
                                                            <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        </tr>
                                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- section 2 table end -->
        
                                <!-- section 3 table -->
                                <section class="table-sec">
                                    <div class="container-fluid">
                                        <div class="table-sec-info">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                
                                                    <thead>
                                                        <tr class="table-success">
                                                            <td class="sec-a-sNo">17</td>
                                                            <td class="sec-a-info" colspan="3">Products/Services sold by the entity (accounting for 90% of the entity’s Turnover):</td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Product/Service </th>
                                                            <th>NIC Code</th>
                                                            <th>% of total Turnover contributed</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="sec-a-sNo">1</td>
                                                            <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">2</td>
                                                            <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="sec-a-sNo">3</td>
                                                            <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                            <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        </tr>
                                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- section 3 table end -->
                            </div>
                            <!-- Sub Tab end -->
                    
        
        
                            <!-- Sub Tab -->
                            <input class="tab-radio" id="sub-tab-3" name="sub-group" type="radio">
                            <div class="sub-tab-content">
                                <!-- section 4 table -->
                                <section class="table-sec">
                                <div class="container-fluid">
                                    <div class="table-sec-info">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <caption> III. Operations</caption>
                                                
                                                <thead>
                                                    <tr class="table-success">
                                                        <td class="sec-a-sNo">18</td>
                                                        <td class="sec-a-info" colspan="3">Number of locations where plants and/or operations/offices of the entity are situated:</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Location</th>
                                                        <th>Number of plants</th>
                                                        <th>Number of offices</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="sec-a-sNo">National</td>
                                                        <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="sec-a-sNo">International</td>
                                                        <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                    </tr>
        
                                                    <tr class="table-success sec-tab-19">
                                                        <td class="sec-a-sNo">19</td>
                                                        <td class="sec-a-info" colspan="3">Markets served by the entity:</td>
                                                    </tr>
                                                    <tr class="table-info sec-tab-19">
                                                        <td class="sec-a-sNo">a.</td>
                                                        <td class="sec-a-info" colspan="3"> Number of locations</td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">Locations</th>
                                                        <th colspan="2">Number</th>
                                                    </tr>
        
                                                    <tr>
                                                        <td class="sec-a-sNo text-left" colspan="2">National (No. of States)</td>
                                                        <td class="sec-a-info text-left" colspan="2"><input type="text"  placeholder='' class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="sec-a-sNo text-left" colspan="2">International (No. of Countries)</td>
                                                        <td class="sec-a-info" colspan="2"><input type="text"  placeholder='' class="form-control"/></td>
                                                    </tr>
        
        
                                                    <tr class="table-info sec-tab-19">
                                                        <td class="sec-a-sNo">b.</td>
                                                        <td class="sec-a-info" colspan="3"> What is the contribution of exports as a percentage of the total turnover of the entity?</td>
                                                    </tr>
                                                    <tr class="table-info sec-tab-19">
                                                        <td class="sec-a-sNo">c.</td>
                                                        <td class="sec-a-info" colspan="3"> A brief on types of customers</td>
                                                    </tr>
                                                    
                                        
                                                </tbody>
                                                
        
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </section>
                                <!-- section 4 table end -->
                            </div>
                             <!-- Sub Tab end -->
        
                             <!-- Sub Tab -->
                            <input class="tab-radio" id="sub-tab-4" name="sub-group" type="radio">
                            <div class="sub-tab-content">
                                <!-- section 5 table -->
                                <section class="table-sec">
                                <div class="container-fluid">
                                    <div class="table-sec-info">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <caption> IV. Employees</caption>
                                                
                                                <thead>
                                                    <tr class="table-success">
                                                        <td class="sec-a-sNo">20</td>
                                                        <td class="sec-a-info" colspan="3">Details as at the end of Financial Year:</td>
                                                        
                                                    </tr>
                                                    <tr class="table-info sec-tab-19">
                                                        <td class="sec-a-sNo">a.</td>
                                                        <td class="sec-a-info" colspan="3">  Employees and workers (including differently abled):</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Number of plants</th>
                                                        <th>Number of offices</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="sec-a-sNo">National</td>
                                                        <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="sec-a-sNo">International</td>
                                                        <td class="sec-a-info"><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                        <td><input type="text"  placeholder='' class="form-control"/></td>
                                                    </tr>
                                                </tbody>
                                                
        
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </section>
                                <!-- section 5 table end -->
                            </div>
                             <!-- Sub Tab end -->
        
        
                    </div>
                    <!-- tab-content end -->
        
        
        
        
                  
                    <!-- Tab Container 2 -->
                    <input class="tab-radio" id="main-tab-2" name="main-group" type="radio"/>
                    <div class="tab-content">
                      <div class="sub-tabs-container">
                        <label for="sub-tab2-1">Sub-Tab 3</label>
                        <label for="sub-tab2-2">Sub-Tab 4</label>
                      </div>
                      <!-- Sub Tab -->
                      <input class="tab-radio" id="sub-tab2-1" name="sub-group2" type="radio" checked="checked">
                      <div class="sub-tab-content">
                        <h1>Sub-Tab 3</h1>
                        <p>Lorem ipsum dolor sit amet consectetur </p>
                        <ul>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                        </ul>
                      </div>
                      <!-- Sub Tab -->
                      <input class="tab-radio" id="sub-tab2-2" name="sub-group2" type="radio">
                      <div class="sub-tab-content">
                        <h1>Sub-Tab 4</h1>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                        <ul>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                        </ul>
                      </div>
                    </div>
                  
                    <!-- Tab Container 3 -->
                    <input class="tab-radio" id="main-tab-3" name="main-group" type="radio"/>
                    <div class="tab-content">
                      <div class="sub-tabs-container">
                        <label for="sub-tab3-1">Sub-Tab 5</label>
                        <label for="sub-tab3-2">Sub-Tab 6</label>
                      </div>
                      <!-- Sub Tab -->
                      <input class="tab-radio" id="sub-tab3-1" name="sub-group3" type="radio" checked="checked">
                      <div class="sub-tab-content">
                        <h1>Sub-Tab 5</h1>
                        <p>Lorem ipsum dolor sit amet consectetur </p>
                        <ul>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                        </ul>
                      </div>
                      <!-- Sub Tab -->
                      <input class="tab-radio" id="sub-tab3-2" name="sub-group3" type="radio">
                      <div class="sub-tab-content">
                        <h1>Sub-Tab 6</h1>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                        <ul>
                          <li>Lorem ipsum dolor sit amet.</li>
                          <li>Lorem ipsum dolor sit amet.</li>
                          <li>Lorem ipsum dolor sit amet.</li>
                          <li>Lorem ipsum dolor sit amet.</li>
                        </ul>
                      </div>
                    </div>
                  
                    </div>
                  </section>
                  
                <!-- BRSR section tab end -->

@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\User\QuestionaireRequest', '#questions') !!}
    @include('partials.js.prevent_multiple_submit')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
