@extends('frontend.layouts.main')

@section('main-container')
<style>
    .status-indicators {
        display: grid;
        grid-template-columns: auto auto auto;
        justify-content: center;
        margin-bottom: 10px;
        grid-gap: 10px; /* Adjust as needed */
    }

    .grid-item {
        display: flex;
        align-items: center;
        margin-left: 24px;

    }
</style>
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
                                    <h4 class="mb-sm-0 font-size-18">Nurturing Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Leads</a></li>
                                            <li class="breadcrumb-item active">Nurturing Leads</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="status-indicators">
                                <div class="grid-item"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-info"></i>Present Day Calls</div>
                                <div class="grid-item"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-black"></i>Upcoming Calls</div>
                                <div class="grid-item"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-danger"></i>Due Date Calls</div>
                            </div>
                        </div>
                        
                  
                        <div class="row">
                            @if (\Session::has('error'))
                            <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                <i class="mdi mdi-block-helper label-icon"></i><strong>{{ \Session::get('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @elseif (\Session::has('success'))
                            <div class="card-body">
                                <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                    <i class="mdi mdi-check-all label-icon"></i><strong>{{ \Session::get('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-2">
                               
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
                                            <strong style="display: block; font-size: 24px;">{{ $nurturing_lead_count }}</strong>
                                            <p style="margin-bottom: 0;">Nurturing Leads</p>
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
                            @php
                            use Carbon\Carbon;
                            @endphp
                           
                            <div class="col-lg-10">
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
                                                    
                                                    <th>Lead Type</th>
                                                    <th>Lead Data</th>
                                                    <th>Next Date Call</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                                @php $count = 1; @endphp 
                                                @foreach($nuturing_leads as $nt)
                                                @php
                                                    $currentDate = Carbon::now()->format('d-F-Y');
                                                    $next_date_call_carb = Carbon::parse($nt->next_date_call)->format('d-F-Y');
                                                    $dateClass = $next_date_call_carb == $currentDate ? 'text-info' : (Carbon::parse($nt->next_date_call)->isPast() ? 'text-danger' : 'text-black');
                                                @endphp
                                                <tr class="{{ $dateClass }}">
                                                    <td>{{ $count }}</td>
                                                   
                                                    <td>{{ $nt->first_name }}</td>
                                                    <td>{{ $nt->last_name }}</td>
                                                    <td>{{ $nt->lead_ty_name }}</td>
                                                    <td>{{ substr($nt->lead_data, 0, 11) }}..</td>
                                                    
                                                <td >{{ $next_date_call_carb }}</td>
                                                    <td style="cursor: grab;"> 
                                                        {{-- <img src="{{ asset('assets/images/resume.png') }}" alt="Image" id="sa-warning" class="clickable-image" style="height: 37px;"> --}}
                                                        <img src="{{ asset('assets/images/resume.png') }}" alt="Image" class="clickable-image sa-warning" style="height: 37px;" data-id="{{ $nt->id }}" data-count="{{ $count }}">
                                                        <a href="nurturing_lead_detail/{{ $nt->id }}" > <img src="{{ asset('assets/images/informations.png') }}" alt=""style="height: 31px; margin-left:15px;"> </a>
{{-- 
                                                       <a href=""> <img src="{{ asset('assets/images/resume.png') }}" alt=""class="btn btn-primary btn-sm waves-effect waves-light" id="sa-warning"></a>
                                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-warning">Click me</button> --}}
                                                        
                                                    </td>
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
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
               
            </div>
            <!-- end main content-->

    </div>
        <!-- END layout-wrapper -->
        {{-- <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('assets/js/pages/sweetalert.init.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script> --}}
<script>
//    document.getElementById("sa-warning").addEventListener("click", function() {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You want to resume the call!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#2ab57d",
//         cancelButtonColor: "#fd625e",
//         confirmButtonText: "Yes"
//     }).then(function (result) {
//         if (result.value) {
//             // Redirect to the Laravel route when the user confirms
//             window.location.href = "{{ route('resumecallpage') }}";
//         }
//     });
// });
// document.getElementById("sa-warning").addEventListener("click", function() {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You want to resume the call!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#2ab57d",
//         cancelButtonColor: "#fd625e",
//         confirmButtonText: "Yes"
//     }).then(function (result) {
//         if (result.value) {
//             // Redirect to the Laravel route when the user confirms
//             window.location.href = "{{ route('resumecallpage') }}";
//         }
//     });
// });

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

var elements = document.getElementsByClassName("sa-warning");

// Loop through all elements and attach the event listener
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener("click", function() {
        var id = this.getAttribute("data-id");
         var count = this.getAttribute("data-count");
       
        Swal.fire({
            title: "Are you sure?",
            text: "You want to resume the call!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "Yes"
        }).then(function (result) {
            if (result.value) {
                // Redirect to the Laravel route when the user confirms
                window.location.href = "{{ route('resumecallpage') }}?id=" + id + "&count=" + count;
            }
        });
    });
}


</script>
@endsection        
     

