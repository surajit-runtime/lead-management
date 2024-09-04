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
                        <h4 class="mb-sm-0 font-size-18">All Audiences</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Audiences</a></li>
                                <li class="breadcrumb-item active">All Audiences</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Add any filters or forms if needed -->
            </div>

            <br>
            <br>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Audience Name</th>
                                        <th>Lead IDs</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($audiences as $audience)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $audience->audience_name }}</td>
                                            <td>
                                                {{-- Display lead IDs --}}
                                                @php
                                                    $leadIds = json_decode($audience->lead_ids);
                                                    echo is_array($leadIds) ? implode(', ', $leadIds) : 'No Leads';
                                                @endphp
                                            </td>
                                            <td>{{ $audience->created_at }}</td>
                                            <td>{{ $audience->updated_at }}</td>
                                        </tr>
                                        @php $count++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div><!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content -->

<script>
    $(document).ready(function() {
        $('#datatable-buttons').DataTable({
            lengthChange: true,
            // buttons: ['excel', 'pdf']
        }).buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        $(".dataTables_length select").addClass('form-select form-select-sm');
    });
</script>
@endsection
