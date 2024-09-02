@extends('frontend.layouts.main')

@section('main-container')
    <style>
        .chk {
            width: 21px;
            height: 21px;
        }

        .hidden {
            display: none;
        }
    </style>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Leads Assignment Table</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Leads Assignment</a></li>
                                    {{-- <li class="breadcrumb-item active">Editable Tables</li> --}}
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @php
                    $c_list = [];
                    foreach ($call_center_list as $center_list) {
                        $c_list[] = $center_list->call_center_name;
                    }

                @endphp

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Leads Assignment</h4>
                                <div class="row leadaction hidden">
                                    <div class="col-12">
                                        <div class="row ">
                                            <div class="col-4">
                                                <select name="centerid" class="form-select" id="centerid">
                                                    <option value="">Select Call Center</option>
                                                    <option value="1">Call center1</option>
                                                    <option value="2">Call center2</option>
                                                    <option value="3">Call center3</option>
                                                    <option value="4">Call center4</option>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="" id="selectedid" value="">
                                                <button class="btn btn-primary" id="asign">assign Center</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="card-body">
                                        <div>

                                          <img src="{{ asset('assets/images/customer-support.png') }}" alt="" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" style="height: 42px;">

                                            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bulk Assignment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" id="hidden-ids" name="ids" value="">
                                                            <form action="">
                                                                @csrf
                                                                <input type="text">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Assign Lead</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                {{-- <p class="card-title-desc">Table Edits is a lightweight jQuery plugin for making table rows editable.</p> --}}
                            </div>
                            <div class="card-body">

                                <div class="table-responsive" id="tbl-leadassign">
                                    <table class="table table-editable table-nowrap align-middle table-edits">
                                        <thead>
                                            <tr>
                                                <th>
                                                    @if (count($leadlist) > 0)
                                                        <input type="checkbox" id="leadallselect" />
                                                    @endif
                                                </th>
                                                <th>S.No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>

                                                <th>Email</th>
                                                <th>Number</th>
                                                <th>Lead Source</th>
                                                <th>State</th>
                                                <th>Zone</th>
                                                <th>Pincode</th>
                                                <th>Call Center</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody> <!-- Start tbody here, outside of the foreach loop -->
                                            @php $count = 1; @endphp
                                            @foreach ($leadlist as $l)
                                                <tr data-id="{{ $l->id }}" id="rowsno-{{ $l->id }}">
                                                    <td align="left"><input type="checkbox" value="{{ $l->id }}"
                                                            name="leadid[]" class="leadcheckbox" /></td>
                                                    <td style="width: 80px">{{ $count }}</td>
                                                    <td>{{ $l->first_name }}</td>
                                                    <td>{{ $l->last_name }}</td>

                                                    <td>{{ $l->email }}</td>
                                                    <td>{{ $l->mobile }}</td>
                                                    <td>{{ $l->created_from }}</td>
                                                    @php
                                                        // if($l->lead_state->state_name)
                                                    @endphp
                                                    <td>{{ $l->lead_state->state_name }}</td>
                                                    <td>{{ $l->zone->zone_name }}</td>
                                                    <td>{{ $l->pincode }}</td>
                                                    <td data-field="zone">Select Call Center</td>
                                                    <td style="width: 100px">
                                                        <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <a class="btn btn-outline-secondary btn-sm delete" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php $count++; @endphp
                                            @endforeach
                                        </tbody> <!-- End tbody here, outside of the foreach loop -->
                                    </table>

                                </div>

                            </div>

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <script>
        // $(document).ready(function() {
        //     // Array to hold selected IDs
        //     var selectedIDs = [];

        //     // When individual checkbox is checked/unchecked
        //     $('.editor-active').on('change', function() {
        //         var id = $(this).val();

        //         if ($(this).is(':checked')) {
        //             selectedIDs.push(id); // Add ID to the selectedIDs array
        //         } else {
        //             var index = selectedIDs.indexOf(id);
        //             if (index > -1) {
        //                 selectedIDs.splice(index, 1); // Remove ID from the array
        //             }
        //         }
        //     });

        //     // When "Select All" checkbox is clicked
        //     $('#select-all').on('change', function() {
        //         $('.editor-active').prop('checked', $(this).prop('checked')); // Check/Uncheck all checkboxes

        //         if ($(this).is(':checked')) {
        //             // Add all IDs to the selectedIDs array
        //             selectedIDs = $('.editor-active').map(function() {
        //                 return this.value; // Collect values directly, not the jQuery object
        //             }).get();
        //         } else {
        //             selectedIDs = []; // Clear the selected IDs array
        //         }
        //     });

        //     // Pass the selected IDs to your modal or form for further processing
        //     $('#yourModalID').on('shown.bs.modal', function() {
        //         // Use selectedIDs to perform any necessary actions, e.g., sending data to your backend
        //         // For example, setting the value of an input field in the modal with the collected IDs
        //         $('#hidden-ids').val(selectedIDs.join(',')); // Assuming it's an input field
        //     });
        // });
    </script>

    <script>
        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            var row = $(this).closest('tr');
            var id = row.data('id');

            Swal.fire({
                title: 'Confirm Delete',
                text: 'Do you want to delete this lead?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'delet-lead', // Replace with your Laravel route URL
                        data: {
                            id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                $("#rowsno-" + id).css({
                                    "display": "none"
                                });
                                Swal.fire('Success', 'Lead deleted successfully!', 'success');
                            } else {
                                Swal.fire('Error', 'Failed to delete lead!', 'error');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var errorMessage = 'An error occurred while deleting the lead.';
                            if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                                errorMessage = jqXHR.responseJSON.error;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            });
        });
    </script>
@endsection
