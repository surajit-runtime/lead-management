@extends('frontend.layouts.main')

@section('main-container')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Add Lead Manually</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Upload Manual Leads</a></li>
                                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Upload ManualLeads</a></li> --}}
                                    <li class="breadcrumb-item active">Add Lead Manually</li>
                                </ol>
                                <br>
                                <br>
                               
                            </div>

                        </div>
                    </div>
                </div>
                @if (\Session::has('error'))
                <div class="alert alert-danger" style="width: 50%; text-align: center; margin-left: 24%;">
                    <strong>{{ \Session::get('error') }}</strong>
                </div>
        @endif
        @if (\Session::has('success'))
                <div class="alert alert-success" style="width: 50%; text-align: center; margin-left: 24%;">
                    <strong>{{ \Session::get('success') }}</strong>
                </div>
        @endif 
                <!-- end page title -->
               
                       {{-- @php
                              print_r($errors->all());
                            
                      @endphp         --}}
                         

                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4 class="card-title">Dropzone</h4>
                                <p class="card-title-desc">DropzoneJS is an open source library
                                    that provides drag’n’drop file uploads with image previews.
                                </p> --}}
                            {{-- </div> --}}
                            {{-- <div class="card-body">

                                <div>
                                    <form action="{{ route('importCsv') }}" class="dropzone" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="multiple">
                                        </div>
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                            </div>
                                            <h5>Drop files here or click to upload CSV.</h5>
                                        </div>
                                    
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Upload CSV</button>
                                        </div>
                                    </form>
                                    
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid --> --}}
            
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <!-- Card Header -->
      
                    <div class="card-body">
                        <form id="pristine-valid-example" method="post" action="{{ route('storeLeadManually') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="first_name" placeholder="Enter First name" name="first_name"  />
                                    </div>
                                    <span class="text-danger">
                                        @error('first_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" />
                                    </div>
                                    <span class="text-danger">
                                        @error('last_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State<sup style="color:red;">*</sup></label>
                                        <select id="state" name="state_id" required class="form-select">
                                            <option value="" disabled selected>Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger">
                                        @error('state_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="district" class="form-label">District<sup style="color:red;">*</sup></label>
                                        <select id="district" name="district_id" required class="form-select">
                                            <option value="" disabled selected>Select District</option>
                                            @foreach($district_list as $dl)
                                                <option value="{{ $dl->id }}">{{ $dl->city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger">
                                        @error('district_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                               --}}
                               {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State<sup style="color:red;">*</sup></label>
                                    <select id="state" name="state_id" required class="form-select" onchange="fetchDistricts()">
                                        <option value="" disabled selected>Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('state_id')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="district" class="form-label">District<sup style="color:red;">*</sup></label>
                                    <select id="district" name="district_id" required class="form-select">
                                        <option value="" disabled selected>Select District</option>
                                        @foreach($district_list as $dl)
                                            <option value="{{ $dl->id }}">{{ $dl->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('district_id')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> --}}
                            
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="created_from" class="form-label">Lead Source<sup style="color:red;">*</sup></label>
                                        <select id="created_from" name="created_from" required class="form-select">
                                            <option value="" disabled selected>Select Lead Source</option>
                                          
                                                <option value="Instagram">Instagram</option>
                                                <option value="Website">Website</option>
                                                <option value="Facebook">Facebook</option>
                                               
                                           
                                        </select>
                                    </div>
                                    <span class="text-danger">
                                        @error('created_from')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                           
        
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<sup style="color:red;">*</sup></label>
                                        <input type="email" required class="form-control" id="email" placeholder="Enter your Email" name="email" />
                                    </div>
                                    <span class="text-danger">
                                        @error('email')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile Number<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="mobile" placeholder="Enter Mobile Number" name="mobile" maxlength="10" pattern="[0-9]*" inputmode="numeric" />
                                    </div>
                                    
                                    <span class="text-danger">
                                        @error('mobile')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pincode" class="form-label">Pincode<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="pincode" placeholder="Enter Pincode" name="pincode" maxlength="6" pattern="[0-9]*" inputmode="numeric" />
                                    </div>
                                    
                                    <span class="text-danger">
                                        @error('pincode')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                              
        
                              
                            </div>
 
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            
                        </form>
                       <a href="{{ route('manualLeadUpPage') }}"> <button type="button" class="btn btn-dark">Back</button></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>


       
    
        

    </div>
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script>
    function fetchDistricts() {
        var stateId = document.getElementById('state').value;

        // Make an Ajax request to fetch districts based on the selected state
        $.ajax({
            type: 'GET',
            url: 'fetch-districts', // Update this route to the actual route in your routes file
            data: {
                stateId: stateId,
        },
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success: function(data) {
                // Update the district options based on the response
                var districtSelect = document.getElementById('district');
                districtSelect.innerHTML = '<option value="" disabled selected>Select District</option>';
                data.forEach(function(district) {
                    var option = document.createElement('option');
                    option.value = district.id;
                    option.text = district.city;
                    districtSelect.add(option);
                });
            },
            error: function(error) {
                console.log('Error fetching districts:', error);
            }
        });
    }
</script>
@endsection
