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
                                    <h4 class="mb-sm-0 font-size-18">BM Wise Report</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                           
                                            <li class="breadcrumb-item active">BM Wise Report</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                       {{-- <div class="row">
                            <form action="" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                @csrf
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="call_center" name="call_center" required data-pristine-required-message="Please select a call Center" class="form-control form-select">
                                        <option value="" disabled selected>Select Call Center</option> --}}
                                        {{-- @foreach($call_centerlist as $call_list)
                                            <option value="{{ $call_list->id }}">{{ $call_list->call_center_name }}</option>
                                        @endforeach --}}
                                    {{-- </select>
                                </div>
                               
                                <div class="ms-3" style="margin-top: -13px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form> --}}
                            {{-- <a href="http://24.199.103.172/Example_LeadUpload_and_Convert_to_CSV.xlsx" download="Example_Format_CSV" class="btn btn-primary">Download Format In Excel</a> --}}
                       {{-- </div> --}}
                       <div class="row">
                            <form action="{{ route('bmWiseReportFilter') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                @csrf
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="zone" name="zone" required data-pristine-required-message="Please select a Zone
                                    " class="form-control form-select">
                                        <option value="" disabled selected>Select Zone</option>
                                        @foreach($zone as $z)
                                        @if($zone_name == $z->id)
                                        @php $selected='selected'; @endphp
                                     @else 
                                     @php $selected=''; @endphp
                                     @endif
                                        <option value="{{ $z->id }}" {{ $selected }}>
                                                {{ $z->zone_name }}
                                            </option>
                                        @endforeach
                                    </select>
                              </div>
                                {{-- <div class="form-group mb-3 custom-select">
                                    <select id="lead_status" name="lead_status" required data-pristine-required-message="Please select a Lead Status" class="form-control form-select">
                                        <option value="" disabled>Select Lead Status</option>
                                        @foreach($lead_status_list as $status_list)
                                        {{-- {{ old('lead_status') == $status_list->id ? 'selected' : '' }} --}}
                                            {{-- <option value="{{ $status_list->id }}" >
                                                {{ $status_list->lead_status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                               </div> --}}
                                <div class="ms-3" style="margin-top: -13px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div> 
                        
                        <br>
                        <br>
                        <!-- end page title -->
                        <div class="row">
                           
                           
                            <div class="col-12">
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
                                        <table id="datatable-buttons" class="table table-bordered w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>BM Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Zone</th>
                                                    <th>Hot Leads</th>
                                                    <th>Closed Leads</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                               
                                                @php $count = 1; @endphp 
                                                @foreach($bm_list as $bm)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $bm->bm_name }}</td>
                                                    <td>{{ $bm->bm_email }}</td>
                                                    <td>{{ $bm->bm_mobile }}</td>
                                                     <td>{{ $bm->zone_name->zone_name }}</td>
                                                    <td>{{ $bm->hot_count }}</td>
                                                    <td>{{ $bm->closed_count }}</td>
                                                    
                                                    
                                                     
                                                   
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
     

