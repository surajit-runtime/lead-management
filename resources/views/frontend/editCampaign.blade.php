@extends('frontend.layouts.main')

@section('main-container')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Campaign</h4>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Campaigns</a></li>
                                <li class="breadcrumb-item active">Edit Campaign</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('updateCampaign', $campaign->id) }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="campaign_name">Campaign Name:</label>
                                    <input type="text" id="campaign_name" name="campaign_name" class="form-control"
                                        value="{{ $campaign->campaign_name }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="audience">Select Audience:</label>
                                    <select id="audience" name="audience" class="form-control form-select" required>
                                        <option value="" disabled>Select Audience</option>
                                        @foreach ($audiences as $audience)
                                            <option value="{{ $audience->id }}" {{ $campaign->audience_id == $audience->id ? 'selected' : '' }}>{{ $audience->audience_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Channel:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="channel" value="email"
                                            {{ $campaign->channel == 'email' ? 'checked' : '' }} required>
                                        <label class="form-check-label">Email</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="channel" value="whatsapp"
                                            {{ $campaign->channel == 'whatsapp' ? 'checked' : '' }}>
                                        <label class="form-check-label">Whatsapp</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="channel" value="sms"
                                            {{ $campaign->channel == 'sms' ? 'checked' : '' }}>
                                        <label class="form-check-label">SMS</label>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="date">Date and Time:</label>
                                    <input type="datetime-local" id="date" name="date" class="form-control"
                                        value="{{ $campaign->date->format('Y-m-d\TH:i') }}" required>
                                </div>

                                <h5 class="mb-3">Template</h5>

                                <div class="form-group mb-3">
                                    <label for="subject">Subject:</label>
                                    <input type="text" id="subject" name="subject" class="form-control"
                                        value="{{ $campaign->subject }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="body">Body:</label>
                                    <textarea id="body" name="body" class="form-control" rows="5"
                                        required>{{ $campaign->body }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" name="action" value="draft" class="btn btn-primary">Save
                                        Draft</button>
                                    <button type="submit" name="action" value="publish" class="btn btn-success">Publish</button>
                                    <button type="submit" name="action" value="send" class="btn btn-danger">Send Now</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
</div>
@endsection
