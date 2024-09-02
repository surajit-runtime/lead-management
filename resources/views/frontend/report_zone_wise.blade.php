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
                                    <h4 class="mb-sm-0 font-size-18">Report Zone Wise</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                           
                                            <li class="breadcrumb-item active">Report Zone Wise</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- required data-pristine-required-message="Please select a call Center"  --}}
                       <div class="row">
                            <form action="{{ route('reportZonePageFilter') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                @csrf
                               
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="zone" name="zone" required data-pristine-required-message="Please select a Zone" class="form-control form-select">
                                        <option value="" disabled selected>Select Zone</option>
                                        @php $selected=''; @endphp
                                      @foreach($zone_nm as $z)
                                            @if($zone == $z->id)
                                               @php $selected='selected'; @endphp
                                            @else 
                                            @php $selected=''; @endphp
                                            @endif
                                            {{-- {{ $selected }} --}}
                                            <option value="{{ $z->id }}"{{ $selected }} >
                                                {{ $z->zone_name }}
                                            </option>
                                            
                                        @endforeach 
                                        @if(($selected=='') && ($zone==0))
                                        @php $selected='selected'; @endphp
                                        @endif
                                        <option value="0" {{ $selected }}>
                                            No Zone
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3" style="margin-right: 20px;">
                                    <select class="form-control" id="yearDropdown" name="year"></select>   
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
                                                    <th>Zone</th>
                                                  <th>Year</th>
                                                    <th>Total Leads</th>
                                                    <th>Hot Leads</th>
                                                    <th>Nuturing Leads</th>
                                                    <th>Dead Leads</th>
                                                   
                                                    <th>Pending Leads</th>
                                                    <th>Closed Leads</th>
                                                    <th>Unassigned Leads</th>
                                                    {{-- <th>Manual Leads</th> --}}
                                                    {{-- <th>State</th> --}}
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach($zoneLeads as $zl)
                                                
                                                <tr>
                                                    @if($zl->zone_name == '')
                                                    <td>No Zone</td>
                                                    @else
                                                    <td>{{ $zl->zone_name }}</td>
                                                    @endif
                                                    <th>{{ $zl->year }}</th>
                                                    <td>{{ $zl->total_lead_count }}</td>
                                                    <td>{{ $zl->hot_lead_count }}</td>
                                                    <td>{{ $zl->nurturing_lead_count }}</td>
                                                    <td>{{ $zl->dead_lead_count }}</td>
                                                    <td>{{ $zl->pending_leads_count }}</td>
                                                    <td>{{ $zl->close_lead_count }}</td>
                                                    <td>{{ $zl->unassigned_leads_count }}</td>
                                                    
                                                   
                                               
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
    // Populate the year dropdown with options
    var currentYear = new Date().getFullYear();
    var startYear = currentYear - 30; // Adjust the range as needed
    var endYear = currentYear + 30;

    var yearDropdown = document.getElementById("yearDropdown");

    for (var year = startYear; year <= endYear; year++) {
        var option = document.createElement("option");
        option.text = option.value = year;

        // Set the current year as the default selected value
        if (year === currentYear) {
            option.selected = true;
        }

        yearDropdown.add(option);
    }


</script>

@endsection        
     

