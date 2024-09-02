
@extends('frontend.layouts.main')

@section('main-container')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Editable Tables</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Editable Tables</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Table Edit</h4>
                                <p class="card-title-desc">Table Edits is a lightweight jQuery plugin for making table rows editable.</p>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-editable table-nowrap align-middle table-editss">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Lead Type</th>
                                                <th>Email</th>
                                                <th>Number</th>
                                                <th>Lead Generated From</th>
                                                <th>State</th>
                                                <th>Call center</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-id="1">
                                                <td data-field="id" style="width: 80px">1</td>
                                                <td data-field="name">David McHenry</td>
                                                <td data-field="age">Enquiry</td>
                                                <td data-field="age">david.com</td>
                                                <td data-field="age">123456789</td>
                                                <td data-field="age">Insta</td>
                                                <td data-field="age">Maharastara</td>
                                                <td data-field="gender">Call Center1</td>
                                                <td style="width: 100px">
                                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr data-id="2">
                                                <td data-field="id">2</td>
                                                <td data-field="name">Frank Kirk</td>
                                                <td data-field="age">Enquiry</td>
                                                <td data-field="age">Frank.com</td>
                                                <td data-field="age">3456789</td>
                                                <td data-field="age">Facebok</td>
                                                <td data-field="age">Rajasthan</td>
                                                <td data-field="gender">Call Center2</td>
                                                <td>
                                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr data-id="3">
                                                <td data-field="id">3</td>
                                                <td data-field="name">Rafael Morales</td>
                                                <td data-field="age">Enquiry</td>
                                                <td data-field="age">Rafael.com</td>
                                                <td data-field="age">16789</td>
                                                <td data-field="age">Mannual</td>
                                                <td data-field="age">Assam</td>
                                                <td data-field="gender">Call Center3</td>
                                                <td>
                                                    <a class="btn btn-outline-secondary btn-sm edits" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr data-id="4">
                                                <td data-field="id">4</td>
                                                <td data-field="name">Mark Ellison</td>
                                                <td data-field="age">Enquiry</td>
                                                <td data-field="age">Mark.com</td>
                                                <td data-field="age">123456789</td>
                                                <td data-field="age">Website</td>
                                                <td data-field="age">Banagalore</td>
                                                <td data-field="gender">Call Center4</td>
                                                <td>
                                                    <a class="btn btn-outline-secondary btn-sm edits" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                          
                                        </tbody>
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
{{-- <script>
    $(function () {
    var pickers = {};
    $('.table-edits tr').editable({
        dropdowns: {
            gender: ['Zone1', 'Zone2', 'Zone3', 'Zone4']
        },
        edit: function (values) {
            $(".edit i", this)
                .removeClass('fa-pencil-alt')
                .addClass('fa-save')
                .attr('title', 'Save');
        },
        save: function (values) {
            var zone = values.gender;
            var row = $(this);

            $(".edit i", this)
                .removeClass('fa-save')
                .addClass('fa-pencil-alt')
                .attr('title', 'Edit');

            if (this in pickers) {
                pickers[this].destroy();
                delete pickers[this];
            }

            Swal.fire({
                title: 'Confirm Update',
                text: 'Do you want to assign this zone?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/update-zone', // Replace with your Laravel route URL
                        data: {
                            id: row.data('id'),
                            zone: zone
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Success', 'Zone updated successfully!', 'success');
                            } else {
                                Swal.fire('Error', 'Failed to update the zone!', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'An error occurred while updating the zone.', 'error');
                        }
                    });
                }
            });
        },
        cancel: function (values) {
            $(".edit i", this)
                .removeClass('fa-save')
                .addClass('fa-pencil-alt')
                .attr('title', 'Edit');

            if (this in pickers) {
                pickers[this].destroy();
                delete pickers[this];
            }
        }
    });
}); --}}


@endsection