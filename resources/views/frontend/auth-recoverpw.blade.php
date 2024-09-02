<!doctype html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tata Structura Lead Management System" name="description" />
    <meta content="Huddlers" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/tata1.png') }}">
    <title>Login</title>
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                    <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div
                                            class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="0" class="active" aria-current="true"
                                                aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <!-- end carouselIndicators -->
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">"I don't believe in
                                                        work-life balance.
                                                        I believe in work-life integration. Make your work and life
                                                        meaningful and fulfilling, and they will complement each other."
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                {{-- <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="..."> --}}
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">- Ratan Tata
                                                                </h5>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">"Your competition is
                                                        not other people but the time you kill, the ill will you create,
                                                        the knowledge you neglect to learn, the connections you fail to
                                                        build,
                                                        the health you sacrifice along the path, your inability to
                                                        generate ideas, the people around you who don't support and love
                                                        your efforts, and whatever god you curse for your bad luck."
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                {{-- <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="..."> --}}
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">- Ratan Tata
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">"Never underestimate
                                                        the power of kindness,
                                                        empathy, and compassion in your interactions with others."</h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            {{-- <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="..."> --}}
                                                            <div class="flex-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">- Ratan Tata</h5>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end carousel-inner -->
                                    </div>
                                    <!-- end review carousel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="{{ route('index') }}" class="d-block auth-logo">
                                        <img src="assets/images/logo_tata.png" alt=""
                                            height="28"style="height: 69px;">
                                        <br>
                                        <br>
                                        <span class="logo-txt" style="font-size: 2rem"><strong>Lead Management
                                                System</strong></span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Reset Password</h5>
                                        <p class="text-muted mt-2">Reset Password with Us.</p>
                                    </div>

                                    {{-- <div class="alert alert-success text-center my-4" role="alert">

                                    </div> --}}
                                    @if (\Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                            role="alert">
                                            <i
                                                class="mdi mdi-block-helper label-icon"></i><strong>{{ \Session::get('error') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @elseif (\Session::has('sendotpsuccess'))
                                        <div class="card-body">
                                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                                role="alert">
                                                <i
                                                    class="mdi mdi-check-all label-icon"></i><strong>{{ \Session::get('sendotpsuccess') }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @elseif (\Session::has('successotp'))
                                        <div class="card-body">
                                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                                role="alert">
                                                <i
                                                    class="mdi mdi-check-all label-icon"></i><strong>{{ \Session::get('successotp') }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif


                                    <form class="mt-4" action="{{ route('generateOTP') }}" method="post"
                                        id="emailForm">
                                        @csrf
                                        {{-- echo (!empty($useremail_err)) ? 'has-error' : '';  in div class="mb-3 show errror message here" --}}
                                        <div class="mb-3 ">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email"
                                                placeholder="Enter email" name="username"autocomplete="off">
                                            <span class="text-danger">
                                                @error('username')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type='submit' name='submit' value='Submit'>Send OTP</button>
                                        </div>
                                    </form>

                                    <form class="mt-4" action="{{ route('otpverify') }}" method="post"
                                        id="otpForm" style="display: none;">

                                        @csrf
                                        {{-- echo (!empty($useremail_err)) ? 'has-error' : '';  in div class="mb-3 show errror message here" --}}
                                        <div class="mb-3 ">
                                            <input type="hidden" name="hidden_email"
                                                value="{{ Session::get('email') }}">

                                            <label class="form-label">OTP</label>
                                            <input type="text" class="form-control" id="otp"
                                                placeholder="Enter OTP" name="otp">
                                            <span class="text-danger">
                                                @error('otp')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type='submit' name='submit' value='Submit'>Verify OTP</button>
                                        </div>
                                    </form>
                                    <form class="mt-4" action="{{ route('updatpass') }}" method="post"
                                        id="PasswordForm" style="display: none;">

                                        @csrf
                                        {{-- echo (!empty($useremail_err)) ? 'has-error' : '';  in div class="mb-3 show errror message here" --}}
                                        <input type="hidden" name="hidden_email"
                                            value="{{ Session::get('email') }}">
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control"
                                                placeholder="Enter New password" name="password"aria-label="Password"
                                                aria-describedby="password-addon"autocomplete="off" id="password"
                                                minlength="8">



                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>

                                            <span class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div id="password-strength" class="text-danger"></div>
                                        <br>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control"
                                                placeholder="Enter Confirm New password"
                                                name="cpassword"aria-label="Password"
                                                aria-describedby="password-addon"autocomplete="off"
                                                id="password_confirmation" minlength="8">

                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                            <span class="text-danger">
                                                @error('cpassword')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div id="password-match-message" class="text-danger"></div>
                                        <div class="mb-3 mt-4">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type='submit' name='submit' value='Submit'>Password Change</button>
                                        </div>
                                    </form>


                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Remember It ? <a href="{{ route('index') }}"
                                                class="text-primary fw-semibold"> Sign In </a> </p>
                                    </div>
                                </div>
                                {{-- <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> Crafted by Huddlers</p>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
    <script>
        // Function to hide email form and show OTP form
        function showOTPForm() {
            document.getElementById('emailForm').style.display = 'none';
            document.getElementById('otpForm').style.display = 'block';
        }

        // Check if OTP was sent successfully and then show OTP form
        @if (session('sendotpsuccess'))
            showOTPForm();
        @endif

        function showPasswordForm() {
            document.getElementById('emailForm').style.display = 'none';
            document.getElementById('otpForm').style.display = 'none';
            document.getElementById('PasswordForm').style.display = 'block';
        }

        // Check if OTP was sent successfully and then show password change form
        @if (session('successotp'))
            showPasswordForm();
        @endif
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

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
    <!-- password addon init -->
    <script src="{{ asset('assets/js/pages/pass-addon.init.js') }}"></script>

</body>

</html>
