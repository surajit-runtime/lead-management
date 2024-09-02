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
                                    <h4 class="mb-sm-0 font-size-18">Close Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Leads</a></li>
                                            <li class="breadcrumb-item active">Close Leads</li>
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
                                    {{-- <div style="display: flex; align-items: flex-end; height:50px;">
                                        <img src="{{ asset('assets/images/active.png') }}" alt="" style="margin-right: 10px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">6</strong>
                                            <p style="margin-bottom: 0;">Active Leads</p>
                                        </div>
                                    </div> --}}
                                    <div style="display: flex;align-items: flex-end;height: 83px; ">
                                        <img src="{{ asset('assets/images/pending.png') }}" alt="" style="margin-right: 10px;height: 58px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">{{ $close_lead_count }}</strong>
                                            <p style="margin-bottom: 0;">Dead Leads</p>
                                        </div>
                                    </div>
                                    <div style="display: flex;align-items: flex-end;height: 83px; ">
                                        <img src="{{ asset('assets/images/total.png') }}" alt="" style="margin-right: 10px;height: 58px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">{{ $total_leads_count }}</strong>
                                            <p style="margin-bottom: 0;">Total Leads</p>
                                        </div>
                                    </div>
                                    {{-- <div style="display: flex;align-items: flex-end;height: 83px; ">
                                        <img src="{{ asset('assets/images/complete.png') }}" alt="" style="margin-right: 10px;height: 58px;">
                                        <div>
                                            <strong style="display: block; font-size: 24px;">100</strong>
                                            <p style="margin-bottom: 0;">Completed Leads</p>
                                        </div>
                                    </div>
                                    <div style="display: flex;align-items: flex-end;height: 83px; ">
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
                                                    <th>S.No</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Lead Type</th>
                                                    <th>Lead Data</th>
                                                    
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                                @php $count = 1; @endphp 
                                                @foreach($close_lead as $cl)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $cl->first_name }}</td>
                                                    <td>{{ $cl->last_name }}</td>
                                                    <td>{{ $cl->mobile }}</td>
                                                    <td>{{ $cl->email }}</td>
                                                    <td>{{ $cl->lead_ty_name }}</td>
                                                    <td>{{ $cl->lead_data }}</td>
                                                  
                                                </tr>
                                                @php $count++; @endphp
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
        <script>
            $(document).ready(function() {
            $('#datatable').DataTable();
        
            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: true,
                buttons: ['excel', 'pdf']
            });
        
            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        
            $(".dataTables_length select").addClass('form-select form-select-sm');
            table.removeClass('dtr-inline');
        });
        </script>
@endsection        
     

