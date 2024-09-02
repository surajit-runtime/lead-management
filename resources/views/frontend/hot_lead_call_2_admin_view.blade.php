@extends('frontend.layouts.main')

@section('main-container')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Hot Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Lead Status</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Call Center 2</a></li>
                                            <li class="breadcrumb-item active">Hot Leads</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-lg-3">
                               
                                <div class="card">
                                    <br>
                                 <p style="margin-left:10px;"><strong> Lead Details</strong></p> 
                                 <div class="card-body">
                                    <div style="display: flex; align-items: flex-end; height:50px;">
                                        <img src="{{ asset('assets/images/active.png') }}" alt="" style="margin-right: 10px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">6</strong>
                                            <p style="margin-bottom: 0;">Active Leads</p>
                                        </div>
                                    </div>
                                    {{-- <div style="display: flex;align-items: flex-end;height: 83px; ">
                                        <img src="{{ asset('assets/images/pending.png') }}" alt="" style="margin-right: 10px;height: 58px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">10</strong>
                                            <p style="margin-bottom: 0;">Pending Leads</p>
                                        </div>
                                    </div> --}}
                                    <div style="display: flex;align-items: flex-end;height: 83px; ">
                                        <img src="{{ asset('assets/images/total.png') }}" alt="" style="margin-right: 10px;height: 58px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">10000</strong>
                                            <p style="margin-bottom: 0;">Total Leads</p>
                                        </div>
                                    </div>
                                    {{-- <div style="display: flex;align-items: flex-end;height: 83px; ">
                                        <img src="{{ asset('assets/images/complete.png') }}" alt="" style="margin-right: 10px;height: 58px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">100</strong>
                                            <p style="margin-bottom: 0;">Completed Leads</p>
                                        </div>
                                    </div> --}}
                                    {{-- <div style="display: flex;align-items: flex-end;height: 83px; ">
                                        <img src="{{ asset('assets/images/callsmade.png') }}" alt="" style="margin-right: 10px;height: 58px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">180</strong>
                                            <p style="margin-bottom: 0;">Calls</p>
                                        </div>
                                    </div> --}}
                               
                                </div>
                                
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                           
                            <div class="col-9">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <h4 class="card-title">Buttons example</h4>
                                        <p class="card-title-desc">The Buttons extension for DataTables
                                            provides a common set of options, API methods and styling to display
                                            buttons on a page that will interact with a DataTable. The core library
                                            provides the based framework upon which plug-ins can built.
                                        </p>
                                    </div> --}}
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Second Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Lead Type</th>
                                                    <th>Lead Data</th>
                                                    
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                                @foreach($hot_leads as $ht)
                                                <tr>
                                                    <td>{{ $ht->first_name }}</td>
                                                    <td>{{ $ht->last_name }}</td>
                                                    <td>{{ $ht->mobile }}</td>
                                                    <td>{{ $ht->email }}</td>
                                                    <td>{{ $ht->lead_ty_name }}</td>
                                                    <td>{{ $ht->lead_data }}</td>
                                                  
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end cardaa -->
                            </div> <!-- end col -->
                    </div><!-- end col -->
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
               
            </div>
            <!-- end main content-->

    </div>
        <!-- END layout-wrapper -->

@endsection        
     

