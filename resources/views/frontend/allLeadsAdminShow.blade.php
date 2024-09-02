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
                                    <h4 class="mb-sm-0 font-size-18">All Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Lead Status </a></li>
                                           
                                            <li class="breadcrumb-item active">All Leads</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                       <div class="row">
                            <form action="{{ route('allLeadAdminShowPageRequest') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                @csrf
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="call_center" name="call_center" required data-pristine-required-message="Please select a call Center" class="form-control form-select">
                                        <option value="" disabled selected>Select Call Center</option>
                                        @foreach($call_centerlist as $call_list)
                                        @if($call_center == $call_list->id)
                                        @php $selected='selected'; @endphp
                                     @else 
                                     @php $selected=''; @endphp
                                     @endif
                                            <option value="{{ $call_list->id }}" {{ $selected }}>{{ $call_list->call_center_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 custom-select">
                                    <select id="lead_status" name="lead_status" required data-pristine-required-message="Please select a Lead Status" class="form-control form-select">
                                        <option value="" disabled selected>Select Lead Status</option>
                                        @foreach($lead_status_list as $status_list)
                                        @if($lead_status == $status_list->id)
                                        @php $selected='selected'; @endphp
                                     @else 
                                     @php $selected=''; @endphp
                                     @endif
                                            <option value="{{ $status_list->id }}"  {{ $selected }}>{{ $status_list->lead_status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ms-3" style="margin-top: -13px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                            {{-- <a href="http://24.199.103.172/Example_LeadUpload_and_Convert_to_CSV.xlsx" download="Example_Format_CSV" class="btn btn-primary">Download Format In Excel</a> --}}
                       </div>
                        {{-- <div class="row">
                            <form action="{{ route('allLeadAdminShowPageRequest') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                @csrf
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="call_center" name="call_center" required data-pristine-required-message="Please select a Call Center" class="form-control form-select">
                                        <option value="" disabled>Select Call Center</option>
                                        @foreach($call_centerlist as $call_list)
                                        {{-- {{ old('call_center') == $call_list->id ? 'selected' : '' }} --}}
                                            {{-- <option value="{{ $call_list->id }}" >
                                                {{ $call_list->call_center_name }}
                                            </option>
                                        @endforeach
                                    </select>
                              </div>
                                <div class="form-group mb-3 custom-select">
                                    <select id="lead_status" name="lead_status" required data-pristine-required-message="Please select a Lead Status" class="form-control form-select">
                                        <option value="" disabled>Select Lead Status</option>
                                        @foreach($lead_status_list as $status_list)
                                        {{-- {{ old('lead_status') == $status_list->id ? 'selected' : '' }} --}}
                                            {{-- <option value="{{ $status_list->id }}" >
                                                {{ $status_list->lead_status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                               </div>
                                <div class="ms-3" style="margin-top: -13px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div> --}} 
                        
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
                                        <table id="datatable-buttons" class="table table-bordered  dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>First Name</th>
                                                    <th>Second Name</th>
                                                    <th>Call Center</th>
                                                     <th>Lead Status</th>
                                                     <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>BM Name</th>
                                                    <th>BM Mobile</th> 
                                                    <th>Distributor Name</th>
                                                    <th>BM Email</th>
                                                    
                                                                                        
                                                    <th>Zone Name</th>
                                                    
                                                    <th>Lead Type</th>
                                                   
                                                    <th>Lead Data</th>
                                                    <th>Hot Call Count</th>
                                                    <th>Nurturing Call Count</th>
                                                    <th>Did Not Pick Count</th>
                                                    <th>Lead In System Count</th>
                                                    <th>Distributor Days Count</th>
                                                    {{-- <th>Call Count</th> --}}
                                                    {{-- <th>Call Duration</th> --}}
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                                @php $count = 1; @endphp 
                                                @foreach($leadlists as $ll)
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $ll->first_name }}</td>
                                                            <td>{{ $ll->last_name }}</td>
                                                           
                                                             <td>{{ $ll->call_center_name->call_center_name }}</td>
                                                             <td>{{ $ll->lead_status_name->lead_status_name }}</td>
                                                             <td>{{ $ll->mobile }}</td>
                                                             <td>{{ $ll->email }}</td>
                                                            {{-- Check if BM_name is present before accessing its properties --}}
                                                            @if(isset($ll->BM_name))
                                                                <td>{{ $ll->BM_name->bm_name }}</td>
                                                                <td>{{ $ll->BM_name->bm_mobile }}</td>
                                                                <td>{{ $ll->BM_name->distributor_name }}</td>
                                                                <td>{{ $ll->BM_name->bm_email }}</td>
                                                            @else
                                                                {{-- Handle the case where BM_name is not present --}}
                                                                <td>BM Name not available</td>
                                                                <td>BM Mobile not available</td>
                                                                <td>Distributor Name  not available</td>
                                                                <td>BM Email not available</td>
                                                            @endif

                                                            @php
                                                                $zone_name = $ll->zone_id ? $ll->zone_id->zone_name : "No Zone";
                                                            @endphp
                                                           
                                                            <td>{{ $zone_name }}</td>
                                                           
                                                            <td>{{ $ll->lead_type_name->lead_type_name }}</td>
                                                            
                                                            <td>{{ $ll->lead_data }}</td>
                                                            <td>{{ $ll->reprt->hot_count }}</td>
                                                            <td>{{ $ll->reprt->nurturing_count }}</td>
                                                            <td>{{ $ll->reprt->did_not_pick_count }}</td>
                                                            <td>{{ $ll->reprt->lead_days_count }}</td>
                                                            <td>{{ $ll->reprt->distributor_days_count }}</td>
                                                            {{-- <td>{{ $ll->call_details->call_count }}</td> --}}
                                                            {{-- <td>{{ $ll->call_details->total_duration }}</td> --}}
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
     

