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
                            <h4 class="mb-sm-0 font-size-18">Resume Call</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Nurturing Leads</a></li>
                                    <li class="breadcrumb-item active">Resume Call</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
{{-- @php
print_r($errors->all());
@endphp --}}
                
                <div class="row">
                    <div class="col-lg-3">
                       
                        <div class="card">
                 
                         <div class="card-body">
                            <div class="clock">
                                <img src="{{ asset('assets/images/clock2.png') }}" alt=""style="height: 44px;">
                                <span id="hours">00</span>:
                                <span id="minutes">00</span>:
                                <span id="seconds">00</span>
                            </div>
                       <hr>
                       <div>
                        <strong>
                            Lead Number
                        </strong>
                        <p>1/1</p>
                       </div>
                       <div>
                        <strong>
                           Called Times
                        </strong>
                        <p>{{ $call_count->call_count }} times</p>
                       </div>
                       <div>
                        <strong>
                           Lead Created
                        </strong>
                        @php
                        $date = date('d-m-Y', strtotime($lead_details_nurturing->lead_date)); // Retrieves the date in Y-m-d format
                        $time = date('H:i:s', strtotime($lead_details_nurturing->lead_date));
                        @endphp
                        <p>on {{ $date }} at {{ $time }}</p>
                 
                       </div>
                       <div>
                        <strong>
                        Lead Generated From
                        </strong>
                        <p>{{ $lead_details_nurturing->created_from }}</p>
                       </div>
                       <div>
                        <strong>
                           Call Duration
                        </strong>
                        <p>{{ $call_count->total_duration }}</p>
                       </div>
                        </div>
                        
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                   
                    <div class="col-6">
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
                                {{-- <form id="pristine-valid-example" novalidate method=""> --}}
                                    <form id="pristine-valid-example" novalidate method="post" action="{{ route('updateNurturingLead') }}">
                                    @csrf
                                   
                                    {{-- <input type="hidden" /> --}}
                                    <input type="hidden" name="lead_id" value="{{ $lead_details_nurturing->id }}">
                                    <input type="hidden" id="formattedTimeInput" name="formattedTime" value="00:00:00">
                                    <div class="row">
                                        
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>First Name</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a Last Name" class="form-control" placeholder="First name" value="{{ $lead_details_nurturing->first_name }}" name="first_name"/>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Last Name</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a Last Name" class="form-control" placeholder="Last name"  value="{{ $lead_details_nurturing->last_name }}" name="last_name"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3 custom-select">
                                                <label for="lead_status">Lead Status</label>
                                                <select id="lead_status" name="lead_status" required data-pristine-required-message="Please select a Lead Status" class="form-control form-select">
                                                    <option value="" disabled selected>Select Lead Status</option>
                                                    @foreach($lead_status_list as $status_list)
                                                    <option value="{{ $status_list->id }}">{{ $status_list->lead_status_name }}</option>
                                                    <option value="{{$status_list->id }}" {{ $lead_details_nurturing->lead_status_id == $status_list->id ? 'selected' : '' }}>
                                                        {{ $status_list->lead_status_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> 
                                        
                                            
                                            
                                        
                                        <div class="col-xl-6 col-md-6">
                                            <div class="form-group mb-3 custom-select">
                                                <label for="executive_name">Executive</label>
                                                <select id="executive_name" name="executive_name" required data-pristine-required-message="Please select an Executive Name" class="form-control form-select">
                                                    <option value="" disabled selected>Select Executive</option>
                                                    <option value="1" {{ $lead_details_nurturing->executive_id_assign_to == 1 ? 'selected' : '' }}>Ramesh</option>
                                                    <option value="2" {{ $lead_details_nurturing->executive_id_assign_to == 2 ? 'selected' : '' }}>Vaibhav</option>
                                                    <option value="3" {{ $lead_details_nurturing->executive_id_assign_to == 3 ? 'selected' : '' }}>Murtaza</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3 custom-select">
                                                <label for="lead_type">Lead type</label>
                                                <select id="lead_type" name="lead_type" required data-pristine-required-message="Please select a Lead Type" class="form-control form-select">
                                                    <option value="" disabled selected>Select Lead Type</option>
                                                    @foreach($lead_type_list as $lead_list)
                                                   
                                                    {{-- <option value="{{ $lead_list->id }}">{{ $lead_list->lead_type_name }}</option> --}}
                                                    <option value="{{ $lead_list->id }}" {{ $lead_details_nurturing->lead_type_id == $lead_list->id ? 'selected' : '' }}>
                                                        {{ $lead_list->lead_type_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" required data-pristine-required-message="Please Enter an Email" class="form-control" placeholder="Enter your Email" value="{{ $lead_details_nurturing->email }}" name="email"/>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="example-datetime-local-input" class="form-label">Set Date & Time for remainder</label>
                                                <input class="form-control" type="datetime-local" id="example-datetime-local-input" name="reminder_set">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Mobile Number</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a Mobile Number" class="form-control" placeholder="Mobile Number" value="{{ $lead_details_nurturing->mobile }}" name="mobile"/>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Notes</label>
                                                <textarea type="text" required data-pristine-required-message="Please Enter a Notes" class="form-control" placeholder="Enter notes" name="lead_data">{{ $lead_details_nurturing->lead_data }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end row -->
                                
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" onclick="submitForm()">Save</button>
                                    
                                </form>
                                <a href="{{ route('nuturingLeadPage') }}"><button type="button" class="btn btn-primary" style="margin-left: 5px;">Back</button></a>
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
                                                <p class="call-time">{{$lead_log->call_description  }}</p>
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                               
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
<script src="{{ asset('assets/libs/pristinejs/pristine.min.js') }}"></script>
<!-- form validation -->
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
<script>
const formattedTimeElement = document.getElementById("formattedTimeInput");

const hoursElement = document.getElementById("hours");
const minutesElement = document.getElementById("minutes");
const secondsElement = document.getElementById("seconds");

let hours = 0;
let minutes = 0;
let seconds = 0;

function updateClock() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
  
    hoursElement.textContent = hours.toString().padStart(2, '0');
    minutesElement.textContent = minutes.toString().padStart(2, '0');
    secondsElement.textContent = seconds.toString().padStart(2, '0');

    // Update the hidden input fields with the new values
    const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

// Update the hidden input field with the formatted time
formattedTimeElement.value = formattedTime;
}

setInterval(updateClock, 1000); // Update the clock every second

// Function to submit the form
function submitForm() {
    // You can add further processing before form submission if needed
    document.getElementById("pristine-valid-example").submit(); // Submit the form
}

function getCurrentDateTime() {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0'); // January is 0
    const day = now.getDate().toString().padStart(2, '0');
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
   
    
    return `${year}-${month}-${day} ${hours}:${minutes}`;
}

// Set the value of the input to the current date and time
document.getElementById('example-datetime-local-input').value = getCurrentDateTime();

</script>


@endsection        
     