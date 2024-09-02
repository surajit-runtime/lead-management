@extends('frontend.layouts.main')

@section('main-container')
<style>

</style>

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
                            <h4 class="mb-sm-0 font-size-18"><a href="{{ route('addManagerPage') }}"> <button type="button" class="btn btn-dark waves-effect waves-light">Back</button></a></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Add Manager</a></li>

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Edit {{ $user_details->first_name }} {{ $user_details->last_name }}</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
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
{{-- @php
    print_r($errors->all());
@endphp --}}
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <!-- Card Header -->

            <div class="card-body">
                <form id="pristine-valid-example" method="post" action="/user/{{ $user_details->id }}/update" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name<sup style="color:red;">*</sup></label>
                                <input type="text" required class="form-control" id="first_name" placeholder="First name" name="first_name"  value="{{ old('first_name',$user_details->first_name) }}"/>
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
                                <input type="text" required class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name"  value="{{ old('last_name',$user_details->last_name) }}"/>
                            </div>
                            <span class="text-danger">
                                @error('last_name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <select id="state" name="state_id" required class="form-select">
                                    <option value="" disabled>Select State</option>
                                    @foreach($states as $state)
                                        {{-- <option value="{{ $state->id }}" {{ $state->id == $user_details->state_id ? 'selected' : '' }}>{{ $state->state_name }}</option> 
                                        <option value="{{ $state->id }}" {{ old('state_id', $user_details->state_id) == $state->id ? 'selected' : '' }}>{{ $state->state_name }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('state_id')
                                {{ $message }}
                                @enderror
                            </span>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role" class="form-label">Role<sup style="color:red;">*</sup></label>
                                <select id="role" name="role_id" required class="form-select">
                                    <option value="" disabled>Select Role</option>
                                    @foreach($roles as $role)
                                        {{-- <option value="{{ $role->id }}" {{ $role->id == $user_details->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option> --}}
                                        <option value="{{ $role->id }}" {{ old('role_id', $user_details->role_id) == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('role_id')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        
                        <div class="col-md-6"  id="callcenter_div">
                            <div class="mb-3">
                                <label for="zone" class="form-label">Call Center<sup style="color:red;">*</sup></label>
                                <select id="zone" name="zone_id"  class="form-select">
                                    <option value="" disabled>Select Call Center</option>
                                    @foreach($zones as $zone)
                                        {{-- <option value="{{ $zone->id }}" {{ $zone->id == $user_details->zone_id ? 'selected' : '' }}>{{ $zone->zone_name }}</option> --}}
                                        <option value="{{ $zone->id }}" {{ old('zone_id', $user_details->zone_id) == $zone->id ? 'selected' : '' }}>{{ $zone->call_center_name }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('zone_id')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stat" class="form-label">Status</label>
                                <select id="stat" name="status" required class="form-select">
                                    <option value="" disabled>Select Status</option>
                                    <option value="0" {{ old('status',$user_details->status) == 0 ? 'selected' : '' }}>Disable</option>
                                    <option value="1" {{ old('status',$user_details->status) == 1 ? 'selected' : '' }}>Enable</option>
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('status')
                                {{ $message }}
                                @enderror
                            </span>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email<sup style="color:red;">*</sup></label>
                                <input type="email" required class="form-control" id="email" placeholder="Enter your Email" name="email" value="{{ old('email',$user_details->email) }}"/>
                            </div>
                            <span class="text-danger">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input type="text" required class="form-control" id="mobile" placeholder="Enter Mobile Number" name="mobile" maxlength="10" pattern="[0-9]*" inputmode="numeric" value="{{ old('mobile',$user_details->mobile) }}"/>
                            </div>
                            
                            <span class="text-danger">
                                @error('mobile')
                                {{ $message }}
                                @enderror
                            </span>
                        </div> --}}

                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (required)</label>
                                <input type="password" required class="form-control" id="password" placeholder="Enter your password" name="password" />
                            </div>
                            <span class="text-danger">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Retype password</label>
                                <input type="password" required class="form-control" id="password_confirmation" placeholder="Re-Enter your password" name="cpassword"/>
                            </div>
                            <span class="text-danger">
                                @error('cpassword')
                                {{ $message }}
                                @enderror
                            </span>
                        </div> --}}

                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" placeholder="Enter Address" name="address">{{ old('address',$user_details->address) }}</textarea>
                            </div>
                            <span class="text-danger">
                                @error('address')
                                {{ $message }}
                                @enderror
                            </span>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image" />
                            </div>
                            <br>
                            <input type="hidden" name="profile_image" value="{{$user_details->profile_image}}">
                            <img src="/images1/{{$user_details->profile_image}}" alt="" style="width: 50px; height: 50px;">
                            <span class="text-danger">
                                @error('profile_image')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    
                    {{-- <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="login_enable" name="login_enable" value="1" {{ $user_details->login_enable == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="login_enable">Check to enable Login for this User</label>
                    </div>
                    <span class="text-danger">
                        @error('login_enable')
                        {{ $message }}
                        @enderror
                    </span> --}}
                    
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    
                
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


      
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<!-- END layout-wrapper -->
<script src="{{ asset('assets/libs/pristinejs/pristine.min.js') }}"></script>
<!-- form validation -->
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initially hide the reminder input
        var CallCenterdiv = document.getElementById('callcenter_div');
        CallCenterdiv.style.display = 'none';

        var RoleDiv = document.getElementById('role');
        RoleDiv.addEventListener('change', function () {
            var Role = RoleDiv.value;
            
            if (Role == 3) {
                CallCenterdiv.style.display = 'block';
            } else {
                CallCenterdiv.style.display = 'none';
            }
        });

        // Set the default value and manually trigger the change event
        RoleDiv.value = 3;
        var event = new Event('change');
        RoleDiv.dispatchEvent(event);
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var RoleDiv = document.getElementById('role');
        var CallCenterdiv = document.getElementById('callcenter_div');

        RoleDiv.addEventListener('change', function () {
            var Role = RoleDiv.value;
            
            if (Role == 3) {
                CallCenterdiv.style.display = 'block';
            } else {
                CallCenterdiv.style.display = 'none';
            }
        });

        // Manually trigger the change event on page load
        RoleDiv.dispatchEvent(new Event('change'));
    });
</script>


@endsection