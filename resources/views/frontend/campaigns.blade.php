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
                            <h4 class="mb-sm-0 font-size-18">{{ $heading }}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Campaigns</a></li>
                                    <li class="breadcrumb-item active">{{ $heading }}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Start filter form -->
                @if ($showFilter)
                    <div class="row align-items-center justify-content-between">

                        <form action="{{ route('allCampaignsFilter') }}" method="GET" class="d-flex align-items-center w-auto">
                            @csrf
                            <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                <select id="campaign_flag" name="campaign_flag" class="form-control form-select">
                                    <option value="" disabled selected>Select Campaign Status</option>
                                    <option value="0" {{ request('campaign_flag') == '0' ? 'selected' : '' }}>Draft
                                    </option>
                                    <option value="1" {{ request('campaign_flag') == '1' ? 'selected' : '' }}>Published
                                    </option>
                                    <option value="2" {{ request('campaign_flag') == '2' ? 'selected' : '' }}>Sent
                                    </option>
                                </select>
                            </div>
                            <div class="ms-3" style="margin-top: -13px;">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                        <div class="w-auto mb-auto">
                            <a href="{{route('campaignPage')}}" id="create-campaign" class="btn btn-primary">Create
                                Campaigns</a>

                        </div>
                    </div>
                @endif
                <!-- End filter form -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>SR No</th>
                                            <th>Campaign Name</th>
                                            <th>Audience Name</th>
                                            <th>Channel</th>
                                            <th>Subject</th>
                                            <th>Body</th>
                                            <th>Flag</th>
                                            <th>Date</th>
                                            <th>Actions</th> <!-- Add Actions column -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach ($campaigns as $campaign)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $campaign->campaign_name }}</td>
                                                <td>{{ $campaign->audience->audience_name }}</td>
                                                <td>{{ ucfirst($campaign->channel) }}</td>
                                                <td>{{ $campaign->subject }}</td>
                                                <td>{!! $campaign->body !!}</td>
                                                <td>
                                                    @switch($campaign->flag)
                                                        @case(0)
                                                            Draft
                                                        @break

                                                        @case(1)
                                                            Published
                                                        @break

                                                        @case(2)
                                                            Sent
                                                        @break

                                                        @default
                                                            Unknown
                                                    @endswitch
                                                </td>
                                                <td>{{ $campaign->date->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    <!-- Add Edit Button -->
                                                    <a href="{{ route('editCampaign', $campaign->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <script>
                                    $(document).ready(function() {
                                        // Initialize DataTable
                                        var table = $('#datatable-buttons').DataTable({
                                            lengthChange: true,
                                        });
                                        console.log('jQuery version:', $.fn.jquery);
                                        console.log('DataTables version:', $.fn.dataTable);

                                        table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

                                        $(".dataTables_length select").addClass('form-select form-select-sm');
                                        $('#datatable-buttons').removeClass('dtr-inline');
                                    });
                                </script>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div><!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
@endsection
