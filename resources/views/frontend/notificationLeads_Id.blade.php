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
                                    <h4 class="mb-sm-0 font-size-18"></h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Notifications</a></li>
                                            <li class="breadcrumb-item active">Nurturing Leads</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

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
                           
                           
                            <div class="col-lg-12">
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
                                               
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                   
                                                    <td>{{ $nuturing_leads->first_name }}</td>
                                                    <td>{{ $nuturing_leads->last_name }}</td>
                                                    <td>{{ $nuturing_leads->lead_name }}</td>
                                                    <td>{{ substr($nuturing_leads->lead_data, 0, 11) }}..</td>
                                                    <td>{{ $nuturing_leads->next_date_call }}</td>
                                                    <td style="cursor: grab;"> 
                                                        {{-- <img src="{{ asset('assets/images/resume.png') }}" alt="Image" id="sa-warning" class="clickable-image" style="height: 37px;"> --}}
                                                        <img src="{{ asset('assets/images/resume.png') }}" alt="Image" class="clickable-image sa-warning" style="height: 37px;" data-id="{{ $nuturing_leads->id }}">
{{-- 
                                                       <a href=""> <img src="{{ asset('assets/images/resume.png') }}" alt=""class="btn btn-primary btn-sm waves-effect waves-light" id="sa-warning"></a>
                                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-warning">Click me</button> --}}
                                                        
                                                    </td>
                                                </tr>
                                                
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

var elements = document.getElementsByClassName("sa-warning");

// Loop through all elements and attach the event listener
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener("click", function() {
        var id = this.getAttribute("data-id");
        // var count = this.getAttribute("data-count");
       
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
                window.location.href = "{{ route('resumecallpage') }}?id=" + id;
            }
        });
    });
}


</script>
@endsection        
     

