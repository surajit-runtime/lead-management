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
                            <h4 class="mb-sm-0 font-size-18">User's Correct Data </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Upload ManualLeads</a></li>
                                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Upload ManualLeads</a></li> --}}
                                    <li class="breadcrumb-item active">User's Correct Data</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card bg-info border-info text-white-100">
                                <div class="card-body">
                                    <h5 class="mb-3 text-white">Duplicate Data's User Correct Data</h5>
                                    <p class="card-text">
                                        <p><strong>First Name :</strong> {{ $userdetail->first_name }}</p>
                                        <hr>
                                        <p><strong>Last Name :</strong> {{ $userdetail->last_name }}</p>
                                        <hr>
                                        <p><strong>Lead Created from :</strong> {{ $userdetail->created_from }}</p>
                                        <hr>
                                        <p><strong>Lead Created On :</strong> {{ $userdetail->lead_date }}</p>
                                        <hr>
                                        <p><strong>State :</strong> {{ $state_nm->state_name }} </p>
                                        <hr>
                                        <p><strong>Email :</strong> {{ $userdetail->email }} </p>
                                        <hr>
                                        <p><strong>Mobile No :</strong> {{ $userdetail->mobile }}</p>
                                        <hr>
                                        <p><strong>Lead Status :</strong> {{ $lead_status_name->lead_status_name }}</p>
                                        <hr>
                                        <p><strong>Lead Type :</strong> {{ $lead_type_name->lead_type_name }}</p>
                                        <hr>
                                        <p><strong>BM Name :</strong> {{ $Bm_name->bm_name }}</p>
                                        <hr>
                                        <p><strong>Distributor Name :</strong> {{ $userdetail->executive_id_assign_to }}</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        
       
    </div>
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


@endsection
