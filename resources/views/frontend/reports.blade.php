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
                                    <h4 class="mb-sm-0 font-size-18">Report</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                           
                                            <li class="breadcrumb-item active">Report</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- required data-pristine-required-message="Please select a call Center"  --}}
                       <div class="row">
                            <form action="{{ route('currentReportFilter') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                @csrf
                               
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="call_center" name="call_center" required data-pristine-required-message="Please select a Call Center" class="form-control form-select">
                                        <option value="" disabled selected>Select Call Center</option>
                                        @foreach($call_centerlist as $cl)
                                            @if($call_center_id == $cl->id)
                                               @php $selected='selected'; @endphp
                                            @else 
                                            @php $selected=''; @endphp
                                            @endif
                                            <option value="{{ $cl->id }}" {{ $selected }}>
                                                {{ $cl->call_center_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3" style="margin-right: 20px;">
                                    <input class="form-control" type="month" value="{{ $currentYear }}-{{ $currentMonth }}" id="example-month-input" name="month_year">
                                </div>
                                
                                {{-- {{ $currentMonth }} --}}
                                
                                {{-- <div class="form-group mb-3 custom-select">
                                    <select id="lead_status" name="lead_status" required data-pristine-required-message="Please select a Lead Status" class="form-control form-select">
                                        <option value="" disabled selected>Select Lead Status</option>
                                        @foreach($lead_status_list as $status_list)
                                            <option value="{{ $status_list->id }}">{{ $status_list->lead_status_name }}</option>
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
                                                    {{-- <th>S.No</th> --}}
                                                    <th>Month</th>
                                                    <th>Call Center</th>
                                                    <th>Total Leads</th>
                                                    <th>Hot Leads</th>
                                                    <th>Nuturing Leads</th>
                                                    <th>Dead Leads</th>
                                                   
                                                    <th>Pending Leads</th>
                                                    <th>Closed Leads</th>

                                                    {{-- <th>Manual Leads</th> --}}
                                                    {{-- <th>State</th> --}}
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach($monthlyLeads as $mL)
                                                {{-- <td></td> --}}
                                                <tr>
                                                    <td>{{ date('F', mktime(0, 0, 0, $mL->month, 1)) }}-{{ $currentYear }}</td>
                                                    <td>{{ $mL->call_center_name }}</td>
                                                <td>{{ $mL->total_lead_count }}</td>
                                                <td>{{ $mL->hot_lead_count }}</td>
                                                <td>{{ $mL->nurturing_lead_count }}</td>
                                                <td>{{ $mL->dead_lead_count }}</td>
                                                
                                                <td>{{ $mL->pending_leads_count }}</td>
                                                <td>{{ $mL->close_lead_count }}</td>
                                                {{-- <td></td> --}}
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
    
   
<script>




$(document).ready(function () {
  $('#datatable').DataTable();

  // Buttons examples
  var table = $('#datatable-buttons').DataTable({
    lengthChange: true,
    dom: 'Bfrtip',
    "order": [],
    buttons: [
      {
        extend: 'excel',
        filename: 'Lead Management System',
        messageTop: 'Month Wise Report',
        // Access the 'text' property of the object
        customize: function ( xlsx ){
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
               
                // // jQuery selector to add a border
        //    $('row c', sheet).attr('s', '25');
        $('row:nth-child(n+3) c', sheet).attr('s', '25');
        // $('row c[r^="A1+G1"]', sheet).attr( 's', '51' );
        $('row:nth-child(1) c', sheet).attr('s', '47');
        $('row:nth-child(2) c', sheet).attr('s', '42');   
        $('row:nth-child(3) c', sheet).attr('s', '32');    
      
       
           
            },
           
      },
      
      'pdf',
    ],
  
  });

  table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

  $(".dataTables_length select").addClass('form-select form-select-sm');
  table.removeClass('dtr-inline');


  
});


;




</script>

@endsection        
     

