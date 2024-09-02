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
                            <h4 class="mb-sm-0 font-size-18"><a href="{{ route('addManagerPage') }}"> <button type="button"
                                        class="btn btn-dark waves-effect waves-light">Back</button></a></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Add Manager</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Add Manager/Sales Exec</a>
                                    </li>

                                    <li class="breadcrumb-item active">Create</li>
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
                {{-- <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <!-- Card Header -->
                <!-- ... (Your card header content) ... -->

                <div class="card-body">
                    <form id="pristine-valid-example"  method="post" action="{{ route('store') }}">
                        <!-- Form Fields -->
                        @csrf
                        <div class="row">
                            <!-- First Name and Last Name -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>First Name</label>
                                    <input type="text" required data-pristine-required-message="Please Enter a First Name" class="form-control" placeholder="First name" name='first_name' />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Last Name</label>
                                    <input type="text" required data-pristine-required-message="Please Enter Last Name" class="form-control" placeholder="Enter Last Name"  name='last_name' />
                                </div>
                            </div>

                            <!-- State and Role -->
                            <div class="col-md-6">
                                <div class="form-group mb-3 custom-select">
                                    <label for="state">State</label>
                                    <select id="state" name="state_id" required data-pristine-required-message="Please select a State" class="form-control form-select">
                                        <option value="" disabled selected>Select State </option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 custom-select">
                                    <label for="role">Role</label>
                                    <select id="role" name="role_id" required data-pristine-required-message="Please select a Role" class="form-control form-select">

                                        <option value="" disabled selected>Select Role </option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <!-- Zone and Status -->
                            <div class="col-md-6">
                                <div class="form-group mb-3 custom-select">
                                    <label for="zone">Zone</label>
                                    <select id="zone" name="zone_id" required data-pristine-required-message="Please select a Zone" class="form-control form-select" >
                                        <option value="" disabled selected>Select Zone </option>
                                        @foreach ($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->zone_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 custom-select">
                                    <label for="stat">Status</label>
                                    <select id="stat" name="stat_id" required data-pristine-required-message="Please select a status" class="form-control form-select">
                                        <option value="" disabled selected>Select status </option>
                                        <option value="0">Disable</option>
                                        <option value="1">Enable</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Email and Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" required data-pristine-required-message="Please Enter an Email" class="form-control" placeholder="Enter your Email" name="email"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Mobile Number</label>
                                    <input type="text" required data-pristine-required-message="Please Enter Mobile Number" class="form-control" placeholder="Enter Mobile Number"  name="mobile"/>
                                </div>
                            </div>

                            <!-- Password and Retype Password -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Password (required)</label>
                                    <input type="password" id="pwd" required class="form-control" placeholder="Enter your password" name="password"/>
                                    <div class="invalid-feedback" data-error="password" style="display: none;">
                                        Please enter a valid password with at least 8 characters, including one uppercase letter, one lowercase letter, and one number.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Retype password</label>
                                    <input type="password" data-pristine-equals="#pwd" data-pristine-equals-message="Passwords don't match" class="form-control" placeholder="Re-Enter your password"/>
                                </div>
                            </div>

                            <!-- Address and Image -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Address</label>
                                    <textarea  class="form-control" placeholder="Enter Address" name="address"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Image</label>
                                    <input type="file" class="form-control" accept="image/*" name="profile_image">
                                </div>
                            </div>
                        </div>

                        <!-- Checkbox and Submit Button -->
                        <div class="form-group form-check">
                            <input id="term-check01" type="checkbox" class="form-check-input" name="login_enable" />
                            <label class="form-check-label" for="term-check01">Check to enable Login for this User</label><br/>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <!-- Card Header -->

                            <div class="card-body">
                                <form id="pristine-valid-example" method="post" action="{{ route('store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name<sup
                                                        style="color:red;">*</sup></label>
                                                <input type="text" required class="form-control" id="first_name"
                                                    placeholder="First name" name="first_name" />
                                            </div>
                                            <span class="text-danger">
                                                @error('first_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name<sup
                                                        style="color:red;">*</sup></label>
                                                <input type="text" required class="form-control" id="last_name"
                                                    placeholder="Enter Last Name" name="last_name" />
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
                                        <option value="" disabled selected>Select State</option>
                                        @foreach ($states as $state)
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
                                        <div class="col-md-6" id="Role_div">
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role<sup
                                                        style="color:red;">*</sup></label>
                                                <select id="role" name="role_id" required class="form-select">
                                                    <option value="" disabled selected>Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('role_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="col-md-6" id="callcenter_div">
                                            <div class="mb-3">
                                                <label for="zone" class="form-label">Call Center<sup
                                                        style="color:red;">*</sup></label>
                                                <select id="zone" name="zone_id" class="form-select">
                                                    <option value="" disabled selected>Select Call Center</option>
                                                    @foreach ($zones as $zone)
                                                        <option value="{{ $zone->id }}">{{ $zone->call_center_name }}
                                                        </option>
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
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="0">Disable</option>
                                        <option value="1">Enable</option>
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
                                                <label for="email" class="form-label">Email<sup
                                                        style="color:red;">*</sup></label>
                                                <input type="email" required class="form-control" id="email"
                                                    placeholder="Enter your Email" name="email" />
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
                                    <input type="text" required class="form-control" id="mobile" placeholder="Enter Mobile Number" name="mobile" maxlength="10" pattern="[0-9]*" inputmode="numeric" />
                                </div>

                                <span class="text-danger">
                                    @error('mobile')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> --}}

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password (required)<sup
                                                        style="color:red;">*</sup></label>
                                                <input type="password" required class="form-control" id="password"
                                                    placeholder="Enter your password" name="password" autocomplete="off"
                                                    autocomplete="false" minlength="8" />
                                                <div id="password-strength" class="text-danger"></div>
                                                <!-- New element for password strength -->
                                            </div>
                                            <span class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Retype password<sup
                                                        style="color:red;">*</sup></label>
                                                <input type="password" required class="form-control"
                                                    id="password_confirmation" placeholder="Re-Enter your password"
                                                    name="cpassword" autocomplete="off" autocomplete="false"
                                                    minlength="8" />
                                            </div>
                                            <div id="password-match-message" class="text-danger"></div>
                                            <span class="text-danger">
                                                @error('cpassword')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" placeholder="Enter Address" name="address"></textarea>
                                </div>
                                <span class="text-danger">
                                    @error('address')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="profile_image" class="form-label">Image<sup
                                                        style="color:red;">*</sup></label>
                                                <input type="file" class="form-control" id="profile_image"
                                                    name="profile_image" />
                                            </div>
                                            <span class="text-danger">
                                                @error('profile_image')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    {{-- <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="login_enable" name="login_enable" value="1">
                            <label class="form-check-label" for="login_enable">Check to enable Login for this User</label>
                        </div>
                        <span class="text-danger">
                            @error('login_enable')
                            {{ $message }}
                            @enderror
                        </span> --}}


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initially hide the reminder input

            var CallCenterdiv = document.getElementById('callcenter_div');
            CallCenterdiv.style.display = 'none';
            var RoleDiv = document.getElementById('role');
            RoleDiv.addEventListener('change', function() {
                var Role = RoleDiv.value;


                if (Role == 3) {
                    CallCenterdiv.style.display = 'block';
                } else {
                    CallCenterdiv.style.display = 'none';
                }
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to validate password strength
            function validatePasswordStrength(password) {
                // Define your password strength criteria here
                var strengthRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{8,}$/;
                return strengthRegex.test(password);
            }

            // Function to validate password and confirm password match
            function validatePasswordMatch() {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('password_confirmation').value;
                var matchMessage = document.getElementById('password-match-message');

                if (password !== confirmPassword) {
                    matchMessage.innerText = 'Password and confirm password do not match';
                    matchMessage.classList.add('text-danger');
                    return false;
                } else {
                    matchMessage.innerText = ''; // Clear the message if passwords match
                    matchMessage.classList.remove('text-danger');
                    return true;
                }
            }

            // Add event listeners to password and confirm password fields
            document.getElementById('password').addEventListener('input', function() {
                var password = this.value;
                var strengthIndicator = document.getElementById('password-strength');

                // Define password criteria
                var criteria = [];
                if (password.length < 8) {
                    criteria.push('At least 8 characters');
                }
                if (!password.match(/[a-z]/)) {
                    criteria.push('At least one lowercase letter');
                }
                if (!password.match(/[A-Z]/)) {
                    criteria.push('At least one uppercase letter');
                }
                if (!password.match(/\d/)) {
                    criteria.push('At least one digit');
                }
                if (!password.match(/[!@#$%^&*()]/)) {
                    criteria.push('At least one special character');
                }

                // Update strength indicator
                var suggestions = '';
                if (criteria.length === 0) {
                    strengthIndicator.innerHTML = 'Password is Strong';
                    strengthIndicator.classList.remove('text-danger');
                    strengthIndicator.classList.add('text-success');
                } else {
                    //alert('hi');
                    strengthIndicator.classList.add('text-danger');
                    strengthIndicator.classList.remove('text-success');
                    suggestions = '<ul>';
                    criteria.forEach(function(criterion) {
                        suggestions += '<li>' + criterion + '</li>';
                        // if (password !== '' && password.match(new RegExp(criterion.split(' ')[2]))) {
                        //     suggestions += ' style="color: green;"';


                        // }
                        //suggestions += ;
                    });
                    suggestions += '</ul>';
                    strengthIndicator.innerHTML = suggestions;
                }
            });

            document.getElementById('password_confirmation').addEventListener('input', function() {
                validatePasswordMatch();
            });

            // Validate password and confirm password on form submission
            document.getElementById('myForm').addEventListener('submit', function(event) {
                if (!validatePasswordMatch()) {
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
@endsection
