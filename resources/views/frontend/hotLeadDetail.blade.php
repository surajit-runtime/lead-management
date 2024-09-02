@extends('frontend.layouts.main')

@section('main-container')
<style>


    .clock {
        font-size: 2rem;
        font-weight: bold;
        margin: auto;
        text-align: center;
    }

/* Add your custom CSS styles here */

.call-log {
    margin-top: 10px;
}

.timeline {
    /* border-left: 2px solid #007BFF; */
 
    position: relative;
} 

.call-item {
    display: flex;
    margin-bottom: 20px;
}

.call-icon {
    flex: 1;
    text-align: center;
}

.call-icon i {
    font-size: 24px;
    color: #007BFF;
}

.call-details {
    flex: 5;
    /* padding-left: 10px; */
}

.call-type {
    font-weight: bold;
    margin: 0;
}

.call-time {
    color: #777;
    margin: 5px 0;
}

.call-number {
    margin: 0;
}

/* Add your custom CSS styles here */



/* Add your custom CSS styles here */


    </style>
    <div class="main-content">
       

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Hot Lead Information</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hot Leads</a></li>
                                    <li class="breadcrumb-item active">Hot Lead Information</li>
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
                   
                   @if($lead_log_detail->isEmpty())
                    <div class="col-12">
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
                                <div>
                                   <strong style="font-size: 1.5rem">Hot Lead Details</strong>
                                </div>
                              <hr>
                              <div>
                                <form id="pristine-valid-example" novalidate method="">
        
                                    <div class="row">
                                        
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>First Name</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a Last Name" class="form-control" placeholder="First name" value="{{ $hot_lead_detail->first_name }}" name="first_name" disabled/>
                                            </div>
                                            <span class="text-danger">
                                                @error('first_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Last Name</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a Last Name" class="form-control" placeholder="Last name"  value="{{ $hot_lead_detail->last_name }}" name="last_name"disabled/>
                                            </div>
                                            <span class="text-danger">
                                                @error('last_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        
                                     
                                        
                                        
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Lead Status</label>
                                                <input type="text" required data-pristine-required-message="Please Enter Lead Status" class="form-control" placeholder="Lead Status"  value="{{ $hot_lead_status_name->lead_status_name}}" name="state_id" disabled/>
                                            </div>
                                            {{-- <span class="text-danger">
                                                @error('mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span> --}}
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Lead Type</label>
                                                <input type="text" required data-pristine-required-message="Please Enter Lead Type" class="form-control" placeholder="Lead Type"  value="{{ $hot_lead_type_name->lead_type_name}}" name="state_id" disabled/>
                                            </div>
                                            {{-- <span class="text-danger">
                                                @error('mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span> --}}
                                        </div>
                                        
                                        {{-- <div class="col-xl-6 col-md-6" id="SalesDiv"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3 custom-select">
                                                <label for="executive_name">Executive</label>
                                                <select id="executive_name" name="executive_name" required data-pristine-required-message="Please select a Executive Name" class="form-control form-select">
                                                    <option value="" disabled selected>Select Executive </option>
                                                    <option value="1">Ramesh</option>
                                                    <option value="2">Vaibhav</option>
                                                    <option value="3">Murtaza</option>
                                                   
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('executive_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            
                                            
                                            
                                        </div> --}}
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" required data-pristine-required-message="Please Enter an Email" class="form-control" placeholder="Enter your Email" value="{{ $hot_lead_detail->email }}" name="email" disabled/>
                                            </div>
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Mobile Number</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a Mobile Number" class="form-control" placeholder="Mobile Number"  value="{{ $hot_lead_detail->mobile }}" name="mobile" disabled/>
                                            </div>
                                            <span class="text-danger">
                                                @error('mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>State</label>
                                                <input type="text" required data-pristine-required-message="Please Enter your State" class="form-control" placeholder="State"  value="{{ $hot_lead_detail->lead_state->state_name }}" name="state_id" disabled/>
                                            </div>
                                            {{-- <span class="text-danger">
                                                @error('mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span> --}}
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>District</label>
                                                <input type="text" required data-pristine-required-message="Please Enter your District" class="form-control" placeholder="District"  value="{{ $hot_lead_detail->lead_district->city }}" name="district_id" disabled/>
                                            </div>
                                            {{-- <span class="text-danger">
                                                @error('mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span> --}}
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Pincode</label>
                                                <input type="text" required data-pristine-required-message="Please Enter Pincode" class="form-control" placeholder="Pincode"  value="{{ $hot_lead_detail->pincode }}" name="pincode" disabled/>
                                            </div>
                                            {{-- <span class="text-danger">
                                                @error('mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span> --}}
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Call Details</label>
                                                <textarea type="text" required data-pristine-required-message="Please Enter a Notes" class="form-control" placeholder="Enter Call Details" name="lead_data" disabled>{{ $hot_lead_detail->lead_data}}</textarea>
                                            </div>
                                            <span class="text-danger">
                                                @error('lead_data')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        
                                    </div>
                                    <!-- end row -->
                                
                                    
                                    
                                       
                                </form>
                                <div class="form-group text-center">
                                    <a href="{{ route('hotLeadPage') }}">
                                        <button type="button" class="btn btn-primary" style="margin-left: 5px;">Back</button>
                                    </a>
                                </div>
                                
                              </div>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
@else
<div class="col-9">
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
            <div>
               <strong style="font-size: 1.5rem"> Lead Details</strong>
            </div>
          <hr>
          <div>
            <form id="pristine-valid-example" novalidate method="">
                
                {{-- <input type="hidden" /> --}}
                <input type="hidden" name="lead_id" value="{{ $hot_lead_detail->id }}">
      

            

                <div class="row">
                    
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>First Name</label>
                            <input type="text" required data-pristine-required-message="Please Enter a Last Name" class="form-control" placeholder="First name" value="{{ $hot_lead_detail->first_name }}" name="first_name" disabled/>
                        </div>
                        <span class="text-danger">
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>Last Name</label>
                            <input type="text" required data-pristine-required-message="Please Enter a Last Name" class="form-control" placeholder="Last name"  value="{{ $hot_lead_detail->last_name }}" name="last_name" disabled/>
                        </div>
                        <span class="text-danger">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>Lead Status</label>
                            <input type="text" required data-pristine-required-message="Please Enter Lead Status" class="form-control" placeholder="Lead Status"  value="{{ $hot_lead_status_name->lead_status_name}}" name="state_id" disabled/>
                        </div>
                        {{-- <span class="text-danger">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span> --}}
                    </div>
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>Lead Type</label>
                            <input type="text" required data-pristine-required-message="Please Enter Lead Type" class="form-control" placeholder="Lead Type"  value="{{ $hot_lead_type_name->lead_type_name}}" name="state_id" disabled/>
                        </div>
                        {{-- <span class="text-danger">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span> --}}
                    </div>
                        
                    
                    {{-- <div class="col-xl-6 col-md-6" id="SalesDiv"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3 custom-select">
                            <label for="executive_name">Executive</label>
                            <select id="executive_name" name="executive_name" required data-pristine-required-message="Please select a Executive Name" class="form-control form-select">
                                <option value="" disabled selected>Select Executive </option>
                                <option value="1">Ramesh</option>
                                <option value="2">Vaibhav</option>
                                <option value="3">Murtaza</option>
                               
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('executive_name')
                                {{ $message }}
                            @enderror
                        </span>
                        
                        
                        
                    </div> --}}
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" required data-pristine-required-message="Please Enter an Email" class="form-control" placeholder="Enter your Email" value="{{ $hot_lead_detail->email }}" name="email" disabled/>
                        </div>
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>Mobile Number</label>
                            <input type="text" required data-pristine-required-message="Please Enter a Mobile Number" class="form-control" placeholder="Mobile Number"  value="{{ $hot_lead_detail->mobile }}" name="mobile" disabled/>
                        </div>
                        <span class="text-danger">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>State</label>
                            <input type="text" required data-pristine-required-message="Please Enter your State" class="form-control" placeholder="State"  value="{{ $hot_lead_detail->lead_state->state_name }}" name="state_id" disabled/>
                        </div>
                        {{-- <span class="text-danger">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span> --}}
                    </div>
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>District</label>
                            <input type="text" required data-pristine-required-message="Please Enter your District" class="form-control" placeholder="District"  value="{{ $hot_lead_detail->lead_district->city }}" name="district_id" disabled/>
                        </div>
                        {{-- <span class="text-danger">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span> --}}
                    </div>
                    <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                        <div class="form-group mb-3">
                            <label>Pincode</label>
                            <input type="text" required data-pristine-required-message="Please Enter Pincode" class="form-control" placeholder="Pincode"  value="{{ $hot_lead_detail->pincode }}" name="pincode" disabled/>
                        </div>
                        {{-- <span class="text-danger">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span> --}}
                    </div>
                  
                    
                </div>
                <!-- end row -->
            
                
               
                  
                    {{-- <button type="button" class="btn btn-danger" id="callNotReceivedBtn" data-id="{{ $hot_lead_detail->id }}">Call not received</button> --}}
            </form>
            <div class="form-group text-center">
                <a href="{{ route('hotLeadPage') }}">
                    <button type="button" class="btn btn-primary" style="margin-left: 5px;">Back</button>
                </a>
            </div>
            
          </div>
        </div>
    </div>
    <!-- end cardaa -->
</div> <!-- end col -->

                   <div class="col-3">
                        <div class="card" style="overflow-y: scroll; height:500px;">
                          <div class="card-header">
                                <h4 class="card-title">Lead Call History</h4>
                               
                            </div>
                         
                            <div class="card-body" >
                                <div class="call-log">
                                    <div class="timeline">
                                        @foreach($lead_log_detail as $lead_log)
                                        <div class="call-item">
                                            <div class="call-icon">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                           
                                            @php
                                                $lead_date = date('d-m-Y', strtotime($lead_log->lead_action_dates)); // Retrieves the date in Y-m-d format
                                                $lead_time = date('H:i:s', strtotime($lead_log->lead_action_dates));
                                             @endphp
                                            <div class="call-details">
                                                <p class="call-type">Call on {{ $lead_date }} on {{ $lead_time }}</p>
                                                <p class="call-time"><strong>Lead Status: </strong>  {{$lead_log->lead_status_name->lead_status_name  }}</p>
                                                <p class="call-time"><strong>Call Description: </strong>{{$lead_log->call_description  }}</p>
                                                
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->

                    @endif
            </div><!-- end col -->
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


 
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script src="{{ asset('assets/libs/pristinejs/pristine.min.js') }}"></script>
<!-- form validation -->
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>


@endsection        
     