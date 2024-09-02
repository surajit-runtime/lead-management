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
                                    <h4 class="mb-sm-0 font-size-18">BM-Distributor List</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">BM-Distributor List</a></li>
                                           
                                            <li class="breadcrumb-item active">BM-Distributor List</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        {{-- <div class="text-right"style="text-align: end;">
                            <a href="{{ route('createState') }}">
                            <button type="button" class="btn btn-primary waves-effect waves-light">+ Add State</button>
                        </a>
                        </div> --}}
                        <br>
                        <br>
                        <br>
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
                        <div class="row">
                           
                           
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
                                        <table id="datatable-buttons" class="table table-bordered w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Distributor Name</th>
                                                    <th>BM Name</th>
                                                    <th>BM Email</th>
                                                    <th>BM Mobile Number</th>
                                                    <th>Action</th>
                                                
                                                   
                                                    
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                                @php $count = 1; @endphp 
                                              @foreach($bm_list_fetch as $bm_l)
                                                <tr>
                                                    
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $bm_l->distributor_name }}</td>
                                                    <td>{{ $bm_l->bm_name }}</td>
                                                    <td>{{ $bm_l->bm_email}}</td>
                                                    <td>{{ $bm_l->bm_mobile}}</td>
                                                  <td><a href="bm_edit/{{ $bm_l->id }}" > <img src="{{ asset('assets/images/edit.png') }}" alt=""style="height: 31px;"> </a></td>
                                                    
                                                  
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
            // table.removeClass('dtr-inline');
        });
        
        
        
        // Get all elements with the class name "sa-warning"
        // var elements = document.getElementsByClassName("sa-warning");
        
        // // Loop through all elements and attach the event listener
        // for (var i = 0; i < elements.length; i++) {
        //     elements[i].addEventListener("click", function() {
        //         var id = this.getAttribute("data-id");
        //         var count = this.getAttribute("data-count");
               
        //         Swal.fire({
        //             title: "Are you sure?",
        //             text: "You want to make call to this Hot Lead!",
        //             icon: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#2ab57d",
        //             cancelButtonColor: "#fd625e",
        //             confirmButtonText: "Yes"
        //         }).then(function (result) {
        //             if (result.value) {
        //                 // Redirect to the Laravel route when the user confirms
        //                 // alert(id);
        //                 window.location.href = "{{ route('hot_Lead_Call_Page') }}?id=" + id + "&count=" + count;
        //             }
        //         });
        //     });
        // }
        
        </script>
@endsection        
     

