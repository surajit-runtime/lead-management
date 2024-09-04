<?php
// include language configuration file based on selected language
$lang = "en";
if (isset($_GET['lang'])) {
   $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
}
if( isset( $_SESSION['lang'] ) ) {
    $lang = $_SESSION['lang'];
}else {
    $lang = "en";
}

require_once ("./assets/lang/" . $lang . ".php");

?>


<!DOCTYPE html>
<html lang="{{ $lang }}">



<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tata Structura Lead Management System" name="description" />
    <meta content="Huddlers" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/tata1.png') }}">
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- DataTables -->
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css"> --}}
        {{-- <!-- Bootstrap CSS (add the appropriate version) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">



<!-- Bootstrap JS (add the appropriate version) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}
<script>
    var idleTime = 27; // Set the idle time in minutes
    var lastActivityTime = new Date();

    $(document).ready(function () {
        // Update last activity time on mouse movement or key press
        $(document).mousemove(function (e) {
            lastActivityTime = new Date();
        });

        $(document).keydown(function (e) {
            lastActivityTime = new Date();
        });

        // Check user activity periodically
        setInterval(checkUserActivity, 60000); // Check every 1 minute
    });

    function checkUserActivity() {
        var currentTime = new Date();
        var idleDuration = (currentTime - lastActivityTime) / 1000 / 60; // Convert milliseconds to minutes
// console.log(idleDuration);
        if (idleDuration > idleTime) {
            // Redirect to logout route or perform logout action

            window.location.href = "{{ route('logout') }}";
        }
    }


</script>

</head>

<body>
    <div id="layout-wrapper">
        <!--start header-->
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        @if (session()->has('userdata') && session('userdata')->role_id === 1 ||session()->has('userdata') && session('userdata')->role_id === 2
                        ||session()->has('userdata') && session('userdata')->role_id === 5)
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            @else
                            <a href="{{ route('Zonedashboard') }}" class="logo logo-dark">
                        @endif
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo_tata.png') }}" alt="" height="15">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo_tata.png') }}" alt="" height="20"> <span
                                    class="logo-txt" style="font-size: 10px"><strong>Lead Management System</strong> </span>
                            </span>
                        </a>
                        @if (session()->has('userdata') && session('userdata')->role_id === 1 ||session()->has('userdata') && session('userdata')->role_id === 2
                        ||session()->has('userdata') && session('userdata')->role_id === 5)
                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            @else
                            <a href="{{ route('Zonedashboard') }}" class="logo logo-light">
                        @endif
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo_tata.png') }}" alt="" height="15">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo_tata.png') }}" alt="" height="20"> <span
                                    class="logo-txt" style="font-size: 10px"><strong>Lead Management System</strong> </span>
                            </span>
                        </a>
                    </div>

                    {{-- <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                        data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button> --}}
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <div class="d-flex">
                        @if (\Session::has('warning'))
                        <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                            <i class="mdi mdi-alert-outline label-icon"></i><strong>{{ \Session::get('warning') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>

                    <!-- App Search-->
                    @php
                    // use Illuminate\Support\Facades\DB;
                    use Carbon\Carbon;

                    $today = Carbon::now();
                    $zone_name = DB::table('tbl_callCenter')->where('id',Session::get('userdata')->zone_id)->select('call_center_name')->first();
                    $role_name = DB::table('tbl_roles')->where('id',Session::get('userdata')->role_id)->select('role_name')->first();
                    $zone_wise = Session::get('userdata')->zone_id;
                    $leads = DB::table('tbl_lead')
                        ->where('callcenter_id', $zone_wise)
                        ->where('lead_status_id', 2)
                        ->whereDate('next_date_call', '=', $today)
                        ->select('id','first_name', 'last_name', 'lead_data','lead_type_id')
                        ->take(3)
                        ->get();
                        $upcoming_leads = DB::table('tbl_lead')
                            ->where('callcenter_id', $zone_wise)
                            ->where('lead_status_id', 2)
                            ->whereDate('next_date_call', '>', $today)
                            ->select('id', 'first_name', 'last_name', 'lead_data','lead_type_id')
                            ->orderBy('next_date_call')  // Optional: You can order the results by next_date_call
                            ->take(3)
                            ->get();


                @endphp
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            {{-- <input type="text" class="form-control" placeholder=" {{ $language['Search'] }}">
                            <button class="btn btn-primary" type="button"><i
                                    class="bx bx-search-alt align-middle"></i></button> --}}
                                    @if (session()->has('userdata') && session('userdata')->role_id === 1)
                                  <strong style="font-size: 2rem;">{{ $role_name->role_name }}</strong>
                                    @elseif(session()->has('userdata') && session('userdata')->role_id === 2)
                                    <strong style="font-size: 2rem;"> {{ $role_name->role_name }}</strong>
                                    @elseif(session()->has('userdata') && session('userdata')->role_id === 5)
                                    <strong style="font-size: 2rem;"> {{ $role_name->role_name }}</strong>
                                    @else
                                    <strong style="font-size: 2rem;">{{ $zone_name->call_center_name }}</strong>
                                    @endif
                        </div>
                    </form>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="{{ $language['Search'] }}" aria-label="Search Result">

                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                 <div class="dropdown d-none d-sm-inline-block">
                       {{--      <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">

                           @if ($lang == 'en')
                                <img class="me-2" src="{{ asset('assets/images/flags/us.jpg') }}" alt="Header Language" height="16">

                           @elseif ($lang == 'es')
                                <img class="me-2" src="{{ asset('assets/images/flags/spain.jpg') }}" alt="Header Language" height="16">

                           @elseif ($lang == 'de')
                                <img class="me-2" src="{{ asset('assets/images/flags/germany.jpg') }}" alt="Header Language" height="16">

                           @elseif ($lang == 'it')
                                <img class="me-2" src="{{ asset('assets/images/flags/italy.jpg') }}" alt="Header Language" height="16">

                           @elseif ($lang == 'ru')
                                <img class="me-2" src="{{ asset('assets/images/flags/russia.jpg') }}" alt="Header Language" height="16">
                            @endif


                        </button>
                       <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="?lang=en" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12"> <span
                                    class="align-middle"> English </span>
                            </a>

                           <!-- item-->
                            <a href="?lang=de" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/images/flags/germany.jpg') }}" alt="user-image" class="me-1" height="12">
                                <span class="align-middle"> German </span>
                            </a>

                            <!-- item-->
                            <a href="?lang=it" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/images/flags/italy.jpg') }}" alt="user-image" class="me-1" height="12">
                                <span class="align-middle"> Italian </span>
                            </a>

                            <!-- item-->
                            <a href="?lang=es" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/images/flags/spain.jpg') }}" alt="user-image" class="me-1" height="12">
                                <span class="align-middle"> Spanish </span>
                            </a>

                            <!-- item-->
                            <a href="?lang=ru" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/images/flags/russia.jpg') }}" alt="user-image" class="me-1" height="12">
                                <span class="align-middle"> Russian </span>
                            </a>

                        </div> --}}
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        {{-- <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i data-feather="grid" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="p-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/github.png') }}" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/bitbucket.png') }}" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/dribbble.png') }}" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/dropbox.png') }}" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/mail_chimp.png') }}" alt="mail_chimp">
                                            <span>Mail Chimp</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/slack.png') }}" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                   @if( session()->has('userdata') && session('userdata')->role_id === 3)
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon position-relative"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i data-feather="bell" class="icon-lg"></i>
                            <span class="badge bg-danger rounded-pill">{{ $leads->count()}}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 text-warning">
                                         Notifications for Today's Nurturing Leads


                                        </h6>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <a href="#!" class="small text-reset text-decoration-underline">
                                      ({{ $leads->count()}})

                                        </a>
                                    </div> --}}
                                </div>
                            </div>

                            <div data-simplebar style="max-height: 230px;">
                                @foreach($leads as $l)
                                <a href="{{ route('nuturingLeadPage') }}" class="text-reset notification-item">

                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                          <h6 class="mb-1">
                                            <i class="fas fa-caret-right"></i>   {{ $l->first_name }} {{ $l->last_name }}

                                            </h6>
                                            @php
                                            $lead_t_name = DB::table('tbl_lead_type')
                                                            ->select('lead_type_name')
                                                            ->where('id', $l->lead_type_id)
                                                            ->first();
                                            @endphp
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">
                                                    <i class=" fas fa-circle" style="font-size: 7px;"></i> {{ $lead_t_name->lead_type_name }}
                                                </p>
                                                <p class="mb-1">
                                                    <i class="fas fa-circle" style="font-size: 7px;"></i> {{ $l->lead_data }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach

                            </div>
                            <hr>
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0" style="color: blue">
                                        Upcoming  Nuturing Leads


                                        </h6>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <a href="#!" class="small text-reset text-decoration-underline">
                                      ({{ $leads->count()}})

                                        </a>
                                    </div> --}}
                                </div>
                            </div>

                            <div data-simplebar style="max-height: 230px;">
                                    @foreach($upcoming_leads as $up_l)
                                    <div class="d-flex">
                                        <div class="flex-grow-1"style="padding: 18px;">
                                        <h6 class="mb-1">
                                            <i class="fas fa-caret-right"></i> {{ $up_l->first_name }} {{ $up_l->last_name }}

                                            </h6>
                                            @php
                                            $lead_t_name = DB::table('tbl_lead_type')
                                                            ->select('lead_type_name')
                                                            ->where('id', $up_l->lead_type_id)
                                                            ->first();
                                            @endphp
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">
                                                    <i class=" fas fa-circle" style="font-size: 7px;"></i> {{ $lead_t_name->lead_type_name }}
                                                </p>

                                                <p class="mb-1">
                                                    <i class=" fas fa-circle" style="font-size: 7px;"></i> {{ $up_l->lead_data }}
                                                </p>


                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                            {{-- <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span>

                                      {{  $language["View_More"]}}

                                    </span>
                                </a>
                            </div> --}}
                        </div>
                    </div>
@endif
                    <div class="dropdown d-inline-block">
                        {{-- <button type="button" class="btn header-item right-bar-toggle me-2">
                            <i data-feather="settings" class="icon-lg"></i>
                        </button> --}}
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button"
                            class="btn header-item topbar-light bg-light-subtle border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            @if (session()->has('userdata') && session('userdata')->role_id === 1)
                                <img class="rounded-circle header-profile-user" src="/images1/{{ Session::get('userdata')->profile_image }}" alt="Profile Image">
                                @elseif(session()->has('userdata') && session('userdata')->role_id === 2)
                                <img class="rounded-circle header-profile-user" src="/images1/{{ Session::get('userdata')->profile_image }}" alt="Profile Image">
                                @elseif(session()->has('userdata') && session('userdata')->role_id === 3)
                                <img class="rounded-circle header-profile-user" src="/images1/{{ Session::get('userdata')->profile_image }}" alt="Profile Image">
                                @elseif(session()->has('userdata') && session('userdata')->role_id === 5)
                                <img class="rounded-circle header-profile-user" src="/images1/{{ Session::get('userdata')->profile_image }}" alt="Profile Image">
                            @endif


                            <span class="d-none d-xl-inline-block ms-1 fw-medium">
                                @if (session()->has('userdata') && session('userdata')->role_id === 1)
                                {{ Session::get('userdata')->first_name}}
                                @elseif(session()->has('userdata') && session('userdata')->role_id === 2)
                                {{ Session::get('userdata')->first_name}}
                                @elseif(session()->has('userdata') && session('userdata')->role_id === 3)
                                {{ Session::get('userdata')->first_name}}
                                @elseif(session()->has('userdata') && session('userdata')->role_id === 5)
                                {{ Session::get('userdata')->first_name}}
                             @endif
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            {{-- <a class="dropdown-item" href="apps-contacts-profile.php"><i
                                    class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>
                                   {{ $language["Profile"]}}

                            </a>
                            <a class="dropdown-item" href="auth-lock-screen.php"><i
                                    class="mdi mdi-lock font-size-16 align-middle me-1"></i>
                                {{ $language["Lock_screen"]}}
                            </a>
                            <div class="dropdown-divider"></div> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"><i
                                    class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                                {{ $language["Logout"]}}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        {{-- <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{ route('dashboard') }}" id="topnav-dashboard"
                                    role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">
                                       {{   $language["Dashboard"]}}
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement"
                                    role="button">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-elements">
                                       {{   $language["Elements"]}}
                                    </span>
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                                    aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div>
                                                    <div class="menu-title">
                                                       {{   $language["Elements"]}}
                                                    </div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-5">
                                                            <div>
                                                                <a href="ui-alerts.php" class="dropdown-item"
                                                                    data-key="t-alerts">
                                                                   {{   $language["Alerts"]}}
                                                                </a>
                                                                <a href="ui-buttons.php" class="dropdown-item"
                                                                    data-key="t-buttons">
                                                                   {{   $language["Buttons"]}}
                                                                </a>
                                                                <a href="ui-cards.php" class="dropdown-item"
                                                                    data-key="t-cards">
                                                                   {{   $language["Cards"]}}
                                                                </a>
                                                                <a href="ui-carousel.php" class="dropdown-item"
                                                                    data-key="t-carousel">
                                                                   {{   $language["Carousel"]}}
                                                                </a>
                                                                <a href="ui-dropdowns.php" class="dropdown-item"
                                                                    data-key="t-dropdowns">
                                                                   {{   $language["Dropdowns"]}}
                                                                </a>
                                                                <a href="ui-grid.php" class="dropdown-item"
                                                                    data-key="t-grid">
                                                                   {{   $language["Grid"]}}
                                                                </a>
                                                                <a href="ui-images.php" class="dropdown-item"
                                                                    data-key="t-images">
                                                                   {{   $language["Images"]}}
                                                                </a>
                                                                <a href="ui-modals.php" class="dropdown-item"
                                                                    data-key="t-modals">
                                                                   {{   $language["Modals"]}}
                                                                </a>
                                                                <a href="ui-offcanvas.php" class="dropdown-item"
                                                                    data-key="t-offcanvas">
                                                                   {{   $language["Offcanvas"]}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div>
                                                                <a href="ui-progressbars.php" class="dropdown-item"
                                                                    data-key="t-progress-bars">
                                                                   {{   $language["Progress_Bars"]}}
                                                                </a>
                                                                <a href="ui-placeholders.php" class="dropdown-item"
                                                                    data-key="t-progress-bars">Placeholders</a>
                                                                <a href="ui-tabs-accordions.php" class="dropdown-item"
                                                                    data-key="t-tabs-accordions">
                                                                   {{   $language["Tabs_n_Accordions"]}}
                                                                </a>
                                                                <a href="ui-typography.php" class="dropdown-item"
                                                                    data-key="t-typography">
                                                                   {{   $language["Typography"]}}
                                                                </a>
                                                                <a href="ui-toasts.php" class="dropdown-item"
                                                                    data-key="t-toasts">Toasts</a>
                                                                <a href="ui-video.php" class="dropdown-item"
                                                                    data-key="t-video">
                                                                   {{   $language["Video"]}}
                                                                </a>
                                                                <a href="ui-general.php" class="dropdown-item"
                                                                    data-key="t-general">
                                                                   {{   $language["General"]}}
                                                                </a>
                                                                <a href="ui-colors.php" class="dropdown-item"
                                                                    data-key="t-colors">
                                                                   {{   $language["Colors"]}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div>
                                                    <div class="menu-title">
                                                       {{   $language["Extended"]}}
                                                    </div>
                                                    <div>
                                                        <a href="extended-lightbox.php" class="dropdown-item"
                                                            data-key="t-lightbox">
                                                           {{   $language["Lightbox"]}}
                                                        </a>
                                                        <a href="extended-rangeslider.php" class="dropdown-item"
                                                            data-key="t-range-slider">
                                                           {{   $language["Range_Slider"]}}
                                                        </a>
                                                        <a href="extended-sweet-alert.php" class="dropdown-item"
                                                            data-key="t-sweet-alert">
                                                           {{   $language["SweetAlert_2"]}}
                                                        </a>
                                                        <a href="extended-session-timeout.php" class="dropdown-item"
                                                            data-key="t-session-timeout">
                                                           {{   $language["Session_Timeout"]}}
                                                        </a>
                                                        <a href="extended-rating.php" class="dropdown-item"
                                                            data-key="t-rating">
                                                           {{   $language["Rating"]}}
                                                        </a>
                                                        <a href="extended-notifications.php" class="dropdown-item"
                                                            data-key="t-notifications">
                                                           {{   $language["Notifications"]}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i data-feather="grid"></i><span data-key="t-apps">
                                       {{   $language["Apps"]}}
                                    </span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="apps-calendar.php" class="dropdown-item" data-key="t-calendar">
                                       {{   $language["Calendar"]}}
                                    </a>
                                    <a href="apps-chat.php" class="dropdown-item" data-key="t-chat">
                                       {{   $language["Chat"]}}
                                    </a>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                            role="button">
                                            <span data-key="t-email">
                                               {{   $language["Email"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="apps-email-inbox.php" class="dropdown-item" data-key="t-inbox">
                                               {{   $language["Inbox"]}}
                                            </a>
                                            <a href="apps-email-read.php" class="dropdown-item" data-key="t-read-email">
                                               {{   $language["Read_Email"]}}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice"
                                            role="button">
                                            <span data-key="t-invoices">
                                               {{   $language["Invoices"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                            <a href="apps-invoices-list.php" class="dropdown-item"
                                                data-key="t-invoice-list">
                                               {{   $language["Invoice_List"]}}
                                            </a>
                                            <a href="apps-invoices-detail.php" class="dropdown-item"
                                                data-key="t-invoice-detail">
                                               {{   $language["Invoice_Detail"]}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact"
                                            role="button">
                                            <span data-key="t-contacts">
                                               {{   $language["Contacts"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                            <a href="apps-contacts-grid.php" class="dropdown-item"
                                                data-key="t-user-grid">
                                               {{   $language["User_Grid"]}}
                                            </a>
                                            <a href="apps-contacts-list.php" class="dropdown-item"
                                                data-key="t-user-list">
                                               {{   $language["User_List"]}}
                                            </a>
                                            <a href="apps-contacts-profile.php" class="dropdown-item"
                                                data-key="t-profile">
                                               {{   $language["Profile"]}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle d-flex justify-content-between align-items-center"
                                            href="#" id="topnav-contact" role="button">
                                            <span data-key="t-blog" class="">
                                               {{   $language["Blog"]}}
                                            </span>
                                            <span class="badge bg-danger-subtle text-danger">
                                               {{   $language["New"]}}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                            <a href="apps-blog-grid.php" class="dropdown-item" data-key="t-blog-grid">
                                               {{   $language["Blog_Grid"]}}
                                            </a>
                                            <a href="apps-blog-list.php" class="dropdown-item" data-key="t-blog-list">
                                               {{   $language["Blog_List"]}}
                                            </a>
                                            <a href="apps-blog-detail.php" class="dropdown-item"
                                                data-key="t-blog-details">
                                               {{   $language["Blog_Details"]}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components"
                                    role="button">
                                    <i data-feather="box"></i><span data-key="t-components">
                                       {{   $language["Components"]}}
                                    </span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                            role="button">
                                            <span data-key="t-forms">
                                               {{   $language["Forms"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="form-elements.php" class="dropdown-item"
                                                data-key="t-form-elements">
                                               {{   $language["Basic_Elements"]}}
                                            </a>
                                            <a href="form-validation.php" class="dropdown-item"
                                                data-key="t-form-validation">
                                               {{   $language["Validation"]}}
                                            </a>
                                            <a href="form-advanced.php" class="dropdown-item"
                                                data-key="t-form-advanced">
                                               {{   $language["Advanced_Plugins"]}}
                                            </a>
                                            <a href="form-editors.php" class="dropdown-item" data-key="t-form-editors">
                                               {{   $language["Editors"]}}
                                            </a>
                                            <a href="form-uploads.php" class="dropdown-item" data-key="t-form-upload">
                                               {{   $language["File_Upload"]}}
                                            </a>
                                            <a href="form-wizard.php" class="dropdown-item" data-key="t-form-wizard">
                                               {{   $language["Wizard"]}}
                                            </a>
                                            <a href="form-mask.php" class="dropdown-item" data-key="t-form-mask">
                                               {{   $language["Mask"]}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                            role="button">
                                            <span data-key="t-tables">
                                               {{   $language["Tables"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-table">
                                            <a href="tables-basic.php" class="dropdown-item" data-key="t-basic-tables">
                                               {{   $language["Bootstrap_Basic"]}}
                                            </a>
                                            <a href="tables-datatable.php" class="dropdown-item"
                                                data-key="t-data-tables">
                                               {{   $language["DataTables"]}}
                                            </a>
                                            <a href="tables-responsive.php" class="dropdown-item"
                                                data-key="t-responsive-table">
                                               {{   $language["Responsive"]}}
                                            </a>
                                            <a href="tables-editable.php" class="dropdown-item"
                                                data-key="t-editable-table">
                                               {{   $language["Editable"]}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                            role="button">
                                            <span data-key="t-charts">
                                               {{   $language["Charts"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                            <a href="charts-apex.php" class="dropdown-item" data-key="t-apex-charts">
                                               {{   $language["Apexcharts"]}}
                                            </a>
                                            <a href="charts-echart.php" class="dropdown-item" data-key="t-e-charts">
                                               {{   $language["Echarts"]}}
                                            </a>
                                            <a href="charts-chartjs.php" class="dropdown-item"
                                                data-key="t-chartjs-charts">
                                               {{   $language["Chartjs"]}}
                                            </a>
                                            <a href="charts-knob.php" class="dropdown-item" data-key="t-knob-charts">
                                               {{   $language["Jquery_Knob"]}}
                                            </a>
                                            <a href="charts-sparkline.php" class="dropdown-item"
                                                data-key="t-sparkline-charts">
                                               {{   $language["Sparkline"]}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                            role="button">
                                            <span data-key="t-icons">
                                               {{   $language["Icons"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                            <a href="icons-boxicons.php" class="dropdown-item" data-key="t-boxicons">
                                               {{   $language["Boxicons"]}}
                                            </a>
                                            <a href="icons-materialdesign.php" class="dropdown-item"
                                                data-key="t-material-design">
                                               {{   $language["Material_Design"]}}
                                            </a>
                                            <a href="icons-dripicons.php" class="dropdown-item" data-key="t-dripicons">
                                               {{   $language["Dripicons"]}}
                                            </a>
                                            <a href="icons-fontawesome.php" class="dropdown-item"
                                                data-key="t-font-awesome">
                                               {{   $language["Font_Awesome_5"]}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                            role="button">
                                            <span data-key="t-maps">
                                               {{   $language["Maps"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-map">
                                            <a href="maps-google.php" class="dropdown-item" data-key="t-g-maps">
                                               {{   $language["Google"]}}
                                            </a>
                                            <a href="maps-vector.php" class="dropdown-item" data-key="t-v-maps">
                                               {{   $language["Vector"]}}
                                            </a>
                                            <a href="maps-leaflet.php" class="dropdown-item" data-key="t-l-maps">
                                               {{   $language["Leaflet"]}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                    <i data-feather="file-text"></i><span data-key="t-extra-pages">
                                       {{   $language["Extra_pages"]}}
                                    </span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                            role="button">
                                            <span data-key="t-authentication">
                                               {{   $language["Authentication"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                            <a href="pages-login.php" class="dropdown-item" data-key="t-login">
                                               {{   $language["Login"]}}
                                            </a>
                                            <a href="pages-register.php" class="dropdown-item" data-key="t-register">
                                               {{   $language["Register"]}}
                                            </a>
                                            <a href="pages-recoverpw.php" class="dropdown-item"
                                                data-key="t-recover-password">
                                               {{   $language["Recover_Password"]}}
                                            </a>
                                            <a href="auth-lock-screen.php" class="dropdown-item"
                                                data-key="t-lock-screen">
                                               {{   $language["Lock_Screen"]}}
                                            </a>
                                            <a href="auth-confirm-mail.php" class="dropdown-item"
                                                data-key="t-confirm-mail">
                                               {{   $language["Confirm_Mail"]}}
                                            </a>
                                            <a href="auth-email-verification.php" class="dropdown-item"
                                                data-key="t-email-verification">
                                               {{   $language["Email_Verification"]}}
                                            </a>
                                            <a href="auth-two-step-verification.php" class="dropdown-item"
                                                data-key="t-two-step-verification">
                                               {{   $language["Two_Step_Verification"]}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                            role="button">
                                            <span data-key="t-utility">
                                               {{   $language["Utility"]}}
                                            </span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                            <a href="pages-starter.php" class="dropdown-item" data-key="t-starter-page">
                                               {{   $language["Starter_Page"]}}
                                            </a>
                                            <a href="pages-maintenance.php" class="dropdown-item"
                                                data-key="t-maintenance">
                                               {{   $language["Maintenance"]}}
                                            </a>
                                            <a href="pages-comingsoon.php" class="dropdown-item"
                                                data-key="t-coming-soon">
                                               {{   $language["Coming_Soon"]}}
                                            </a>
                                            <a href="pages-timeline.php" class="dropdown-item" data-key="t-timeline">
                                               {{   $language["Timeline"]}}
                                            </a>
                                            <a href="pages-faqs.php" class="dropdown-item" data-key="t-faqs">
                                               {{   $language["FAQs"]}}
                                            </a>
                                            <a href="pages-pricing.php" class="dropdown-item" data-key="t-pricing">
                                               {{   $language["Pricing"]}}
                                            </a>
                                            <a href="pages-404.php" class="dropdown-item" data-key="t-error-404">
                                               {{   $language["Error_404"]}}
                                            </a>
                                            <a href="pages-500.php" class="dropdown-item" data-key="t-error-500">
                                               {{   $language["Error_500"]}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="layouts-horizontal.php"
                                    role="button">
                                    <i data-feather="layout"></i><span data-key="t-horizontal">
                                       {{   $language["Horizontal"]}}
                                    </span>
                                </a>
                            </li>

                        </ul> --}}
                    </div>
                </nav>
            </div>
        </div>

        <!--end header-->
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">{{   $language["Menu"]}}</li>
                @if (session()->has('userdata') && session('userdata')->role_id === 1)
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard">{{   $language["Dashboard"]}}</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('productpage') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Leads</span>
                    </a>
                </li> --}}
                <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Admin Or Manager</li>
                <li>
                    <a href="{{ route('leadAssignAdminPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">Lead Assignment</span>
                    </a>

                </li>
                <li class="menu-title mt-2" data-key="t-components">ALL New Leads For Call Center</li>
                {{-- <li>
                    <a href="{{ route('allLeadsCallCenterPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">New Leads</span>
                    </a>

                </li>  --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-headset"></i>
                        <span data-key="t-authentication">Call Center Wise Leads</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('callCenter_1_page') }}" data-key="t-login">Call Center 1 </a></li>
                        <li><a href="{{ route('callCenter_2_page') }}" data-key="t-register">Call Center 2</a></li>
                        <li><a href="{{ route('callCenter_3_page') }}" data-key="t-recover-password">Call Center 3</a></li>
                        <li><a href="{{ route('callCenter_4_page') }}" data-key="t-lock-screen">Call Center 4</a></li>
                         {{--<li><a href="auth-confirm-mail.php" data-key="t-confirm-mail">{{   $language["Confirm_Mail"]}}</a></li>
                        <li><a href="auth-email-verification.php" data-key="t-email-verification">{{   $language["Email_Verification"]}}</a></li>
                        <li><a href="auth-two-step-verification.php" data-key="t-two-step-verification">{{   $language["Two_Step_Verification"]}}</a></li> --}}
                    </ul>
                </li>


                <li class="menu-title mt-2" data-key="t-components">Leads Status Filter Call Center & Lead Status Wise</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-check"></i>
                        <span data-key="t-multi-level">Lead Status </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">

                        <li>

                                <li><a href="{{ route('allLeadAdminShowPage') }}" data-key="t-level-2-1">All Leads</a></li>
                                {{-- <li><a href="javascript: void(0);" data-key="t-level-2-2">Nurturing Leads</a></li> --}}
                                {{-- <li><a href="javascript: void(0);" data-key="t-level-2-3">Dead Leads</a></li> --}}

                        </li>

                    </ul>
                </li>
                {{-- <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Manager</li>
                <li>
                    <a href="{{ route('leadAssignManagerPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">Lead Assignment Manager</span>
                    </a>

                </li>  --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-bullhorn"></i>
                        <span data-key="t-authentication">Leads</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('hotLeadPage') }}" data-key="t-login">Hot Leads</a></li>
                        <li><a href="{{ route('nuturingLeadPage') }}" data-key="t-register">Nurturing Leads</a></li>
                        <li><a href="{{ route('deadLeadPage') }}" data-key="t-recover-password">Dead Leads</a></li>
                        {{-- <li><a href="auth-lock-screen.php" data-key="t-lock-screen">{{   $language["Lock_Screen"]}}</a></li>
                        <li><a href="auth-confirm-mail.php" data-key="t-confirm-mail">{{   $language["Confirm_Mail"]}}</a></li>
                        <li><a href="auth-email-verification.php" data-key="t-email-verification">{{   $language["Email_Verification"]}}</a></li>
                        <li><a href="auth-two-step-verification.php" data-key="t-two-step-verification">{{   $language["Two_Step_Verification"]}}</a></li> --}}
                    {{-- </ul>
                </li> --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa fa-cog"></i>
                        <span data-key="t-authentication">Manage</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('addManagerPage') }}" data-key="t-login">Add Manager</a></li>
                        <li><a href="{{ route('manualLeadUpPage') }}" data-key="t-register">Upload Manual Leads</a></li>
                        {{-- <li><a href="{{ route('deadLeadPage') }}" data-key="t-recover-password">Dead Leads</a></li> --}}
                        {{-- <li><a href="auth-lock-screen.php" data-key="t-lock-screen">{{   $language["Lock_Screen"]}}</a></li>
                        <li><a href="auth-confirm-mail.php" data-key="t-confirm-mail">{{   $language["Confirm_Mail"]}}</a></li>
                        <li><a href="auth-email-verification.php" data-key="t-email-verification">{{   $language["Email_Verification"]}}</a></li>
                        <li><a href="auth-two-step-verification.php" data-key="t-two-step-verification">{{   $language["Two_Step_Verification"]}}</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa fa-file"></i>
                        <span data-key="t-email">Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ route('reportPage') }}" data-key="t-lock-screen">Report</a></li>
                        <li><a href="{{ route('bmWiseReportpage') }}" data-key="t-confirm-mail">Report BM wise</a></li>
                        <li><a href="{{ route('reportZonePage') }}" data-key="t-two-step-verification">Report Zone Wise</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa fa-lock"></i>
                        <span data-key="">Market Auth Module</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <!-- Audience Dropdown -->
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" data-key="">Audience</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('handleLeadList') }}" data-key="">All Leads</a></li>
                                <li><a href="{{ route('handleAudience') }}" data-key="">Audience</a></li>
                            </ul>
                        </li>

                        <!-- Campaign Dropdown -->
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" data-key="">Campaign</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('campaignPage') }}" data-key="">Create Campaigns</a></li>
                                <li><a href="{{ route('allCampaign') }}" data-key="">All Campaigns</a></li>
                                <li><a href="{{ route('campaignDrafts') }}" data-key="">Draft Campaigns</a></li>
                                <li><a href="{{ route('publishCampaigns') }}" data-key="">Published Campaigns</a></li>
                                <li><a href="{{ route('sentCampaigns') }}" data-key="">Sent Campaigns</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                {{-- <li>
                    <a href="{{ route('reportPage') }}">
                        <i class="fas fa-file"></i>
                        <span data-key="t-dashboard">Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('bmWiseReportpage') }}">
                        <i class="fas fa-file"></i>
                        <span data-key="t-dashboard">Report BM wise</span>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">{{   $language["Apps"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="apps-calendar.php">
                                <span data-key="t-calendar">{{   $language["Calendar"]}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-chat.php">
                                <span data-key="t-chat">{{   $language["Chat"]}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-email">{{   $language["Email"]}}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-email-inbox.php" data-key="t-inbox">{{   $language["Inbox"]}}</a></li>
                                <li><a href="apps-email-read.php" data-key="t-read-email">{{   $language["Read_Email"]}}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices">{{   $language["Invoices"]}}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-invoices-list.php" data-key="t-invoice-list">{{   $language["Invoice_List"]}}</a></li>
                                <li><a href="apps-invoices-detail.php" data-key="t-invoice-detail">{{   $language["Invoice_Detail"]}}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-contacts">{{   $language["Contacts"]}}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-contacts-grid.php" data-key="t-user-grid">{{   $language["User_Grid"]}}</a></li>
                                <li><a href="apps-contacts-list.php" data-key="t-user-list">{{   $language["User_List"]}}</a></li>
                                <li><a href="apps-contacts-profile.php" data-key="t-profile">{{   $language["Profile"]}}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="">
                                <span data-key="t-blog">{{   $language["Blog"]}}</span>
                                <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">{{   $language["New"]}}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-blog-grid.php" data-key="t-blog-grid">{{   $language["Blog_Grid"]}}</a></li>
                                <li><a href="apps-blog-list.php" data-key="t-blog-list">{{   $language["Blog_List"]}}</a></li>
                                <li><a href="apps-blog-detail.php" data-key="t-blog-details">{{   $language["Blog_Details"]}}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">{{   $language["Authentication"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-login.php" data-key="t-login">{{   $language["Login"]}}</a></li>
                        <li><a href="pages-register.php" data-key="t-register">{{   $language["Register"]}}</a></li>
                        <li><a href="pages-recoverpw.php" data-key="t-recover-password">{{   $language["Recover_Password"]}}</a></li>
                        <li><a href="auth-lock-screen.php" data-key="t-lock-screen">{{   $language["Lock_Screen"]}}</a></li>
                        <li><a href="auth-confirm-mail.php" data-key="t-confirm-mail">{{   $language["Confirm_Mail"]}}</a></li>
                        <li><a href="auth-email-verification.php" data-key="t-email-verification">{{   $language["Email_Verification"]}}</a></li>
                        <li><a href="auth-two-step-verification.php" data-key="t-two-step-verification">{{   $language["Two_Step_Verification"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">{{   $language["Pages"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.php" data-key="t-starter-page">{{   $language["Starter_Page"]}} </a></li>
                        <li><a href="pages-maintenance.php" data-key="t-maintenance">{{   $language["Maintenance"]}}</a></li>
                        <li><a href="pages-comingsoon.php" data-key="t-coming-soon">{{   $language["Coming_Soon"]}}</a></li>
                        <li><a href="pages-timeline.php" data-key="t-timeline">{{   $language["Timeline"]}}</a></li>
                        <li><a href="pages-faqs.php" data-key="t-faqs">{{   $language["FAQs"]}}</a></li>
                        <li><a href="pages-pricing.php" data-key="t-pricing">{{   $language["Pricing"]}}</a></li>
                        <li><a href="pages-404.php" data-key="t-error-404">{{   $language["Error_404"]}}</a></li>
                        <li><a href="pages-500.php" data-key="t-error-500">{{   $language["Error_500"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="layouts-horizontal.php">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal">{{   $language["Horizontal"]}}</span>
                    </a>
                </li> --}}



                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-components">{{   $language["Components"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts.php" data-key="t-alerts">{{   $language["Alerts"]}}</a></li>
                        <li><a href="ui-buttons.php" data-key="t-buttons">{{   $language["Buttons"]}}</a></li>
                        <li><a href="ui-cards.php" data-key="t-cards">{{   $language["Cards"]}}</a></li>
                        <li><a href="ui-carousel.php" data-key="t-carousel">{{   $language["Carousel"]}}</a></li>
                        <li><a href="ui-dropdowns.php" data-key="t-dropdowns">{{   $language["Dropdowns"]}}</a></li>
                        <li><a href="ui-grid.php" data-key="t-grid">{{   $language["Grid"]}}</a></li>
                        <li><a href="ui-images.php" data-key="t-images">{{   $language["Images"]}}</a></li>
                        <li><a href="ui-modals.php" data-key="t-modals">{{   $language["Modals"]}}</a></li>
                        <li><a href="ui-offcanvas.php" data-key="t-offcanvas">{{   $language["Offcanvas"]}}</a></li>
                        <li><a href="ui-progressbars.php" data-key="t-progress-bars">{{   $language["Progress_Bars"]}}</a></li>
                        <li><a href="ui-tabs-accordions.php" data-key="t-tabs-accordions">{{   $language["Tabs_n_Accordions"]}}</a></li>
                        <li><a href="ui-typography.php" data-key="t-typography">{{   $language["Typography"]}}</a></li>
                        <li><a href="ui-video.php" data-key="t-video">{{   $language["Video"]}}</a></li>
                        <li><a href="ui-general.php" data-key="t-general">{{   $language["General"]}}</a></li>
                        <li><a href="ui-colors.php" data-key="t-colors">{{   $language["Colors"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="gift"></i>
                        <span data-key="t-ui-elements">{{   $language["Extended"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="extended-lightbox.php" data-key="t-lightbox">{{   $language["Lightbox"]}}</a></li>
                        <li><a href="extended-rangeslider.php" data-key="t-range-slider">{{   $language["Range_Slider"]}}</a></li>
                        <li><a href="extended-sweet-alert.php" data-key="t-sweet-alert">{{   $language["SweetAlert_2"]}}</a></li>
                        <li><a href="extended-session-timeout.php" data-key="t-session-timeout">{{   $language["Session_Timeout"]}}</a></li>
                        <li><a href="extended-rating.php" data-key="t-rating">{{   $language["Rating"]}}</a></li>
                        <li><a href="extended-notifications.php" data-key="t-notifications">{{   $language["Notifications"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i data-feather="box"></i>
                        <span class="badge rounded-pill badge-soft-danger  text-danger float-end">7</span>
                        <span data-key="t-forms">{{   $language["Forms"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.php" data-key="t-form-elements">{{   $language["Basic_Elements"]}}</a></li>
                        <li><a href="form-validation.php" data-key="t-form-validation">{{   $language["Validation"]}}</a></li>
                        <li><a href="form-advanced.php" data-key="t-form-advanced">{{   $language["Advanced_Plugins"]}}</a></li>
                        <li><a href="form-editors.php" data-key="t-form-editors">{{   $language["Editors"]}}</a></li>
                        <li><a href="form-uploads.php" data-key="t-form-upload">{{   $language["File_Upload"]}}</a></li>
                        <li><a href="form-wizard.php" data-key="t-form-wizard">{{   $language["Wizard"]}}</a></li>
                        <li><a href="form-mask.php" data-key="t-form-mask">{{   $language["Mask"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables">{{   $language["Tables"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic.php" data-key="t-basic-tables">{{   $language["Bootstrap_Basic"]}}</a></li>
                        <li><a href="tables-datatable.php" data-key="t-data-tables">{{   $language["DataTables"]}}</a></li>
                        <li><a href="tables-responsive.php" data-key="t-responsive-table">{{   $language["Responsive"]}}</a></li>
                        <li><a href="tables-editable.php" data-key="t-editable-table">{{   $language["Editable"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-charts">{{   $language["Charts"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex.php" data-key="t-apex-charts">{{   $language["Apexcharts"]}}</a></li>
                        <li><a href="charts-echart.php" data-key="t-e-charts">{{   $language["Echarts"]}}</a></li>
                        <li><a href="charts-chartjs.php" data-key="t-chartjs-charts">{{   $language["Chartjs"]}}</a></li>
                        <li><a href="charts-knob.php" data-key="t-knob-charts">{{   $language["Jquery_Knob"]}}</a></li>
                        <li><a href="charts-sparkline.php" data-key="t-sparkline-charts">{{   $language["Sparkline"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">{{   $language["Icons"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-boxicons.php" data-key="t-boxicons">{{   $language["Boxicons"]}}</a></li>
                        <li><a href="icons-materialdesign.php" data-key="t-material-design">{{   $language["Material_Design"]}}</a></li>
                        <li><a href="icons-dripicons.php" data-key="t-dripicons">{{   $language["Dripicons"]}}</a></li>
                        <li><a href="icons-fontawesome.php" data-key="t-font-awesome">{{   $language["Font_Awesome_5"]}}</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="map"></i>
                        <span data-key="t-maps">{{   $language["Maps"]}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google.php" data-key="t-g-maps">{{   $language["Google"]}}</a></li>
                        <li><a href="maps-vector.php" data-key="t-v-maps">{{   $language["Vector"]}}</a></li>
                        <li><a href="maps-leaflet.php" data-key="t-l-maps">{{   $language["Leaflet"]}}</a></li>
                    </ul>
                </li> --}}


                @elseif (session()->has('userdata') && session('userdata')->role_id === 2)
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard">{{   $language["Dashboard"]}}</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('productpage') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Leads</span>
                    </a>
                </li> --}}
                <li class="menu-title mt-2" data-key="t-components">ALL New Leads Call Center</li>
                <li>
                    <a href="{{ route('allLeadsCallCenterPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">New Leads</span>
                    </a>

                </li>
                <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Admin Or Manager</li>
                <li>
                    <a href="{{ route('leadAssignAdminPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">Lead Assignment</span>
                    </a>

                </li>
                {{-- <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Manager</li>
                <li>
                    <a href="{{ route('leadAssignManagerPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">Lead Assignment Manager</span>
                    </a>

                </li>  --}}


                @elseif (session()->has('userdata') && session('userdata')->role_id === 5)
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard">{{   $language["Dashboard"]}}</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('productpage') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Leads</span>
                    </a>
                </li> --}}
                {{-- <li class="menu-title mt-2" data-key="t-components">ALL New Leads Call Center</li> --}}
                <li>
                    <a href="{{ route('fetchStateList') }}">
                        <i class="fa fa-list"></i>
                        <span data-key="t-maps">State List</span>
                    </a>

                </li>
                {{-- <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Admin Or Manager</li> --}}
                <li>
                    <a href="{{ route('fetchDistrictList') }}">
                        <i class="fa fa-list"></i>
                        <span data-key="t-lock-screen">District List</span>
                    </a>

                </li>

                <li>
                    <a href="{{ route('fetchBmList') }}">
                        <i class="fa fa-list"></i>
                        <span data-key="t-two-step-verification">BM-Distributor List</span>
                    </a>

                </li>
                {{-- <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Manager</li>
                <li>
                    <a href="{{ route('leadAssignManagerPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">Lead Assignment Manager</span>
                    </a>

                </li>  --}}

                @elseif (session()->has('userdata') && session('userdata')->role_id === 3)
                <li>
                    <a href="{{ route('Zonedashboard') }}">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard">{{   $language["Dashboard"]}}</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('productpage') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Leads</span>
                    </a>
                </li> --}}
                <li class="menu-title mt-2" data-key="t-components">ALL New Leads Call Center</li>
                <li>
                    <a href="{{ route('allLeadsCallCenterPage') }}">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">New Leads</span>
                    </a>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-bullhorn"></i>
                        <span data-key="t-authentication">Leads</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('hotLeadPage') }}" data-key="t-login">Hot Leads</a></li>
                        <li><a href="{{ route('nuturingLeadPage') }}" data-key="t-register">Nurturing Leads</a></li>
                        <li><a href="{{ route('deadLeadPage') }}" data-key="t-recover-password">Dead Leads</a></li>
                        <li><a href="{{ route('closeLeadPage') }}" data-key="t-lock-screen">Close Leads</a></li>
                        {{-- <li><a href="auth-lock-screen.php" data-key="t-lock-screen">{{   $language["Lock_Screen"]}}</a></li>
                        <li><a href="auth-confirm-mail.php" data-key="t-confirm-mail">{{   $language["Confirm_Mail"]}}</a></li>
                        <li><a href="auth-email-verification.php" data-key="t-email-verification">{{   $language["Email_Verification"]}}</a></li>
                        <li><a href="auth-two-step-verification.php" data-key="t-two-step-verification">{{   $language["Two_Step_Verification"]}}</a></li> --}}
                    </ul>
                </li>
                @endif
            </ul>

            {{-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">{{   $language["Unlimited_Access"]}}</h5>
                        <p class="font-size-13">{{   $language["Upgrade_your_plan_from_a_Free_trial,_to_select_‘Business_Plan’"]}}.</p>
                        <a href="#!" class="btn btn-primary mt-2">{{   $language["Upgrade_Now"]}}</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
