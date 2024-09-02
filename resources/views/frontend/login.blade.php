<!doctype html>
<html lang="en">

<head>

   
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tata Structura Lead Management System" name="description"/>
    <meta content="Huddlers" name="author"/>
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
                                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <!-- end carouselIndicators -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">"I don't believe in work-life balance. 
                                                    I believe in work-life integration. Make your work and life meaningful and fulfilling, and they will complement each other."
                                                </h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                      <div class="flex-shrink-0">
                                                            {{-- <img src="{{ asset('assets/images/ratan_sir.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="..."> --}}
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

                                                <h4 class="mt-4 fw-medium lh-base text-white">"Your competition is not other people but the time you kill, the ill will you create, the knowledge you neglect to learn, the connections you fail to build, 
                                                    the health you sacrifice along the path, your inability to generate ideas, the people around you who don't support and love your efforts, and whatever god you curse for your bad luck."</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            {{-- <img src="{{ asset('assets/images/users/ratan_sir.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="..."> --}}
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

                                                <h4 class="mt-4 fw-medium lh-base text-white">"Never underestimate the power of kindness, 
                                                    empathy, and compassion in your interactions with others."</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        {{-- <img src="{{ asset('assets/images/users/ratan_sir.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="..."> --}}
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
                                    <img src="assets/images/logo_tata.png" alt="" height="28"style="height: 69px;"> 
                                    <br>
                                    <br>
                                    <span class="logo-txt" style="font-size: 1rem"><strong>Lead Management System</strong></span>
                                </a>
                               
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue.</p>
                                </div>
                                @if (\Session::has('error'))
                                <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                    <i class="mdi mdi-block-helper label-icon"></i><strong>{{ \Session::get('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @elseif (\Session::has('successChangepass'))
                                <div class="card-body">
                                    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="mdi mdi-check-all label-icon"></i><strong>{{ \Session::get('successChangepass') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                @elseif (\Session::has('OTPlogin'))
                                <div class="card-body">
                                    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="mdi mdi-check-all label-icon"></i><strong>{{ \Session::get('OTPlogin') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                               
                                    
                                </div>
                                @endif
                              
                                <form class="custom-form mt-4 pt-2" action="{{ route('checklogin') }}" method="post" id="loginForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="{{ old('username', Cache::get('email', '')) }}"autocomplete="off">
                                        <span class="text-danger">
                                            @error('username')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="mb-3 ">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="{{ route('reset_pass') }}" class="text-muted">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        </div>
                                        
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password" name="password" value="{{ old('password', Cache::get('password', '')) }}" aria-label="Password" aria-describedby="password-addon" autocomplete="off">
                                            <span class="text-danger"></span>
                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            <span class="text-danger">
                                                @error('password')
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                        
                                        
                                    
                                    <br>
                                    <div class="mb-3 captcha">
                                        <span>{!! App\Http\Controllers\LoginController::generateCaptcha(config('captcha.default.type')) !!}</span>
                                        <button type="button" class="btn btn-danger reload" id="reload">↻</button>
                                    </div>
                                    <div class="mb-3">
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check" name="rememberme">
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </form>
                               
                                <form class="mt-4" action="{{ route('loginOtpVerfiy') }}" method="post" id="otpForm" style="display: none" >

                                    @csrf
                                    {{-- echo (!empty($useremail_err)) ? 'has-error' : '';  in div class="mb-3 show errror message here"--}}
                                    <div class="mb-3 "> 
                                        <input type="hidden" name="hidden_email" value="{{ Session::get('email') }}">

                                        <label class="form-label">OTP</label>
                                        <input type="text" class="form-control" id="otp" placeholder="Enter OTP" name="otp">
                                        <span class="text-danger">
                                            @error('otp')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="mb-3 mt-4">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type='submit' name='submit' value='Submit'>Verify OTP</button>
                                    </div>
                                </form>

                                {{-- <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                               </div> --}}
                            </div>
                 
                            {{-- <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script>Crafted by Huddlers</p>
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
<script>
    // Function to hide OTP form and show login form
    function showLoginForm() {
        document.getElementById('otpForm').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
    }

    // Function to show OTP form and hide login form
    function showOTPForm() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('otpForm').style.display = 'block';
    }

    // Check if OTP was sent successfully and then show OTP form
    @if(\Session::has('OTPlogin'))
        showOTPForm();
    @else
        showLoginForm(); // If OTP was not sent, show the login form
    @endif
</script>

<script type="text/javascript">
    $('#reload').click(function() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
</body>

</html>