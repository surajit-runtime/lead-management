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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Leads</a></li>

                                    <li class="breadcrumb-item active">Hot Leads</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-2">

                        <div class="card">
                            <br>
                            <p style="margin-left:10px;"><strong> Lead Details</strong></p>
                            <div class="card-body">
                                <div style="display: flex; align-items: flex-end; height:50px;">
                                    <img src="{{ asset('assets/images/active.png') }}" alt=""
                                        style="margin-right: 10px;">
                                    <div>
                                        <strong style="display: block; font-size: 24px;">{{ $hot_leads_count }}</strong>
                                        <p style="margin-bottom: 0;">Hot Leads</p>
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
                                    <img src="{{ asset('assets/images/total.png') }}" alt=""
                                        style="margin-right: 10px;height: 58px;">
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
                                <table id="datatable-buttons" class="table table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Second Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Lead Type</th>
                                            <th>Lead Data</th>
                                            <th style="width: 87px;">Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach ($hot_leads as $ht)
                                            <tr>

                                                <td>{{ $count }}</td>
                                                <td>{{ $ht->first_name }}</td>
                                                <td>{{ $ht->last_name }}</td>
                                                <td>{{ $ht->mobile }}</td>
                                                <td>{{ $ht->email }}</td>
                                                <td>{{ $ht->lead_ty_name }}</td>
                                                <td>{{ substr($ht->lead_data, 0, 20) }}..</td>
                                                <td style="cursor: grab;">
                                                    <img src="{{ asset('assets/images/resume.png') }}" alt="Image"
                                                        class="clickable-image sa-warning" style="height: 37px;"
                                                        data-id="{{ $ht->id }}" data-count="{{ $count }}">
                                                    <a href="lead_detail/{{ $ht->id }}"> <img
                                                            src="{{ asset('assets/images/informations.png') }}"
                                                            alt=""style="height: 31px;"> </a>
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
        var elements = document.getElementsByClassName("sa-warning");

        // Loop through all elements and attach the event listener
        for (var i = 0; i < elements.length; i++) {
            elements[i].addEventListener("click", function() {
                var id = this.getAttribute("data-id");
                var count = this.getAttribute("data-count");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to make call to this Hot Lead!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#2ab57d",
                    cancelButtonColor: "#fd625e",
                    confirmButtonText: "Yes"
                }).then(function(result) {
                    if (result.value) {
                        // Redirect to the Laravel route when the user confirms
                        // alert(id);
                        window.location.href = "{{ route('hot_Lead_Call_Page') }}?id=" + id + "&count=" +
                            count;
                    }
                });
            });
        }
    </script>
@endsection
