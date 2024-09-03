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
                        <h4 class="mb-sm-0 font-size-18">Make Campaign</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Campaigns</a></li>
                                <li class="breadcrumb-item active">Create Campaign</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Start Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('storeCampaign') }}" method="POST">
                                @csrf

                                <!-- Audience Dropdown -->
                                <div class="form-group mb-3">
                                    <label for="audience">Select Audience:</label>
                                    <select id="audience" name="audience" class="form-control form-select" required>
                                        <option value="" disabled selected>Select Audience</option>
                                        @foreach($audiences as $audience)
                                            <option value="{{ $audience->id }}">{{ $audience->audience_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Channel Selection -->
                                <div class="form-group mb-3">
                                    <label>Channel:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="channel" id="channelEmail" value="email" required>
                                        <label class="form-check-label" for="channelEmail">Email</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="channel" id="channelWhatsapp" value="whatsapp">
                                        <label class="form-check-label" for="channelWhatsapp">Whatsapp</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="channel" id="channelSms" value="sms">
                                        <label class="form-check-label" for="channelSms">SMS</label>
                                    </div>
                                </div>

                                <!-- Date Selection -->
                                <div class="form-group mb-3">
                                    <label for="date">Date:</label>
                                    <input type="date" id="date" name="date" class="form-control" min="{{ \Carbon\Carbon::now()->addDay()->toDateString() }}" required>
                                </div>

                                <!-- Template Heading -->
                                <h5 class="mb-3">Template</h5>

                                <!-- Subject Input -->
                                <div class="form-group mb-3">
                                    <label for="subject">Subject:</label>
                                    <input type="text" id="subject" name="subject" class="form-control" required>
                                </div>

                                <!-- Body Textarea -->
                                <div class="form-group mb-3">
                                    <label for="body">Body:</label>
                                    <textarea id="body" name="body" class="form-control" rows="5" required></textarea>
                                </div>

                                <!-- Save and Publish Buttons -->
                                <div class="form-group mb-3">
                                    <button type="submit" name="action" value="save" class="btn btn-primary">Save Drop</button>
                                    <button type="submit" name="action" value="publish" class="btn btn-success">Publish</button>
                                </div>
                            </form>
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

@endsection
