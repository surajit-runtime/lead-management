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
                        <h4 class="mb-sm-0 font-size-18">Audience - {{ $audience->audience_name }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Audiences</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('audience.leads', $audience->id) }}">{{ $audience->audience_name }}</a></li>
                                <li class="breadcrumb-item active">Leads</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Lead Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($leads as $lead)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $lead->first_name }} {{ $lead->last_name }}</td>
                                            <td>{{ $lead->mobile }}</td>
                                            <td>{{ $lead->email }}</td>
                                            <td>
                                                <form action="{{ route('audience.leads.remove', [$audience->id, $lead->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </td>
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
        $('.table').DataTable({
            lengthChange: true,
        });
    });
</script>
@endsection
