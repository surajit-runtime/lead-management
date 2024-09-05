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
<html lang="<?php echo e($lang); ?>">



<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tata Structura Lead Management System" name="description" />
    <meta content="Huddlers" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/tata1.png')); ?>">
    <!-- preloader css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/preloader.min.css')); ?>" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/libs/flatpickr/flatpickr.min.css')); ?>" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- DataTables -->
        <link href="<?php echo e(asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo e(asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/libs/dropzone/min/dropzone.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        
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

            window.location.href = "<?php echo e(route('logout')); ?>";
        }
    }


</script>

<style>
    .chart-container {
        height: 300px; /* Ensure all charts have the same height */
        margin-bottom: 30px; /* Space between charts */
    }
</style>

</head>

<body>
    <div id="layout-wrapper">
        <!--start header-->
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <?php if(session()->has('userdata') && session('userdata')->role_id === 1 ||session()->has('userdata') && session('userdata')->role_id === 2
                        ||session()->has('userdata') && session('userdata')->role_id === 5): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="logo logo-dark">
                            <?php else: ?>
                            <a href="<?php echo e(route('Zonedashboard')); ?>" class="logo logo-dark">
                        <?php endif; ?>
                            <span class="logo-sm">
                                <img src="<?php echo e(asset('assets/images/logo_tata.png')); ?>" alt="" height="15">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo e(asset('assets/images/logo_tata.png')); ?>" alt="" height="20"> <span
                                    class="logo-txt" style="font-size: 10px"><strong>Lead Management System</strong> </span>
                            </span>
                        </a>
                        <?php if(session()->has('userdata') && session('userdata')->role_id === 1 ||session()->has('userdata') && session('userdata')->role_id === 2
                        ||session()->has('userdata') && session('userdata')->role_id === 5): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="logo logo-light">
                            <?php else: ?>
                            <a href="<?php echo e(route('Zonedashboard')); ?>" class="logo logo-light">
                        <?php endif; ?>
                            <span class="logo-sm">
                                <img src="<?php echo e(asset('assets/images/logo_tata.png')); ?>" alt="" height="15">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo e(asset('assets/images/logo_tata.png')); ?>" alt="" height="20"> <span
                                    class="logo-txt" style="font-size: 10px"><strong>Lead Management System</strong> </span>
                            </span>
                        </a>
                    </div>

                    
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <div class="d-flex">
                        <?php if(\Session::has('warning')): ?>
                        <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                            <i class="mdi mdi-alert-outline label-icon"></i><strong><?php echo e(\Session::get('warning')); ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- App Search-->
                    <?php
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


                ?>
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            
                                    <?php if(session()->has('userdata') && session('userdata')->role_id === 1): ?>
                                  <strong style="font-size: 2rem;"><?php echo e($role_name->role_name); ?></strong>
                                    <?php elseif(session()->has('userdata') && session('userdata')->role_id === 2): ?>
                                    <strong style="font-size: 2rem;"> <?php echo e($role_name->role_name); ?></strong>
                                    <?php elseif(session()->has('userdata') && session('userdata')->role_id === 5): ?>
                                    <strong style="font-size: 2rem;"> <?php echo e($role_name->role_name); ?></strong>
                                    <?php else: ?>
                                    <strong style="font-size: 2rem;"><?php echo e($zone_name->call_center_name); ?></strong>
                                    <?php endif; ?>
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
                                        <input type="text" class="form-control" placeholder="<?php echo e($language['Search']); ?>" aria-label="Search Result">

                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                 <div class="dropdown d-none d-sm-inline-block">
                       
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        
                    </div>
                   <?php if( session()->has('userdata') && session('userdata')->role_id === 3): ?>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon position-relative"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i data-feather="bell" class="icon-lg"></i>
                            <span class="badge bg-danger rounded-pill"><?php echo e($leads->count()); ?></span>
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
                                    
                                </div>
                            </div>

                            <div data-simplebar style="max-height: 230px;">
                                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('nuturingLeadPage')); ?>" class="text-reset notification-item">

                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                          <h6 class="mb-1">
                                            <i class="fas fa-caret-right"></i>   <?php echo e($l->first_name); ?> <?php echo e($l->last_name); ?>


                                            </h6>
                                            <?php
                                            $lead_t_name = DB::table('tbl_lead_type')
                                                            ->select('lead_type_name')
                                                            ->where('id', $l->lead_type_id)
                                                            ->first();
                                            ?>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">
                                                    <i class=" fas fa-circle" style="font-size: 7px;"></i> <?php echo e($lead_t_name->lead_type_name); ?>

                                                </p>
                                                <p class="mb-1">
                                                    <i class="fas fa-circle" style="font-size: 7px;"></i> <?php echo e($l->lead_data); ?>

                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <hr>
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0" style="color: blue">
                                        Upcoming  Nuturing Leads


                                        </h6>
                                    </div>
                                    
                                </div>
                            </div>

                            <div data-simplebar style="max-height: 230px;">
                                    <?php $__currentLoopData = $upcoming_leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $up_l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-flex">
                                        <div class="flex-grow-1"style="padding: 18px;">
                                        <h6 class="mb-1">
                                            <i class="fas fa-caret-right"></i> <?php echo e($up_l->first_name); ?> <?php echo e($up_l->last_name); ?>


                                            </h6>
                                            <?php
                                            $lead_t_name = DB::table('tbl_lead_type')
                                                            ->select('lead_type_name')
                                                            ->where('id', $up_l->lead_type_id)
                                                            ->first();
                                            ?>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1">
                                                    <i class=" fas fa-circle" style="font-size: 7px;"></i> <?php echo e($lead_t_name->lead_type_name); ?>

                                                </p>

                                                <p class="mb-1">
                                                    <i class=" fas fa-circle" style="font-size: 7px;"></i> <?php echo e($up_l->lead_data); ?>

                                                </p>


                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                        </div>
                    </div>
<?php endif; ?>
                    <div class="dropdown d-inline-block">
                        
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button"
                            class="btn header-item topbar-light bg-light-subtle border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <?php if(session()->has('userdata') && session('userdata')->role_id === 1): ?>
                                <img class="rounded-circle header-profile-user" src="/images1/<?php echo e(Session::get('userdata')->profile_image); ?>" alt="Profile Image">
                                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 2): ?>
                                <img class="rounded-circle header-profile-user" src="/images1/<?php echo e(Session::get('userdata')->profile_image); ?>" alt="Profile Image">
                                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 3): ?>
                                <img class="rounded-circle header-profile-user" src="/images1/<?php echo e(Session::get('userdata')->profile_image); ?>" alt="Profile Image">
                                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 5): ?>
                                <img class="rounded-circle header-profile-user" src="/images1/<?php echo e(Session::get('userdata')->profile_image); ?>" alt="Profile Image">
                            <?php endif; ?>


                            <span class="d-none d-xl-inline-block ms-1 fw-medium">
                                <?php if(session()->has('userdata') && session('userdata')->role_id === 1): ?>
                                <?php echo e(Session::get('userdata')->first_name); ?>

                                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 2): ?>
                                <?php echo e(Session::get('userdata')->first_name); ?>

                                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 3): ?>
                                <?php echo e(Session::get('userdata')->first_name); ?>

                                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 5): ?>
                                <?php echo e(Session::get('userdata')->first_name); ?>

                             <?php endif; ?>
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"><i
                                    class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                                <?php echo e($language["Logout"]); ?>

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
                <li class="menu-title" data-key="t-menu"><?php echo e($language["Menu"]); ?></li>
                <?php if(session()->has('userdata') && session('userdata')->role_id === 1): ?>
                <li>
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard"><?php echo e($language["Dashboard"]); ?></span>
                    </a>
                </li>
                
                <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Admin Or Manager</li>
                <li>
                    <a href="<?php echo e(route('leadAssignAdminPage')); ?>">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">Lead Assignment</span>
                    </a>

                </li>
                <li class="menu-title mt-2" data-key="t-components">ALL New Leads For Call Center</li>
                

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-headset"></i>
                        <span data-key="t-authentication">Call Center Wise Leads</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('callCenter_1_page')); ?>" data-key="t-login">Call Center 1 </a></li>
                        <li><a href="<?php echo e(route('callCenter_2_page')); ?>" data-key="t-register">Call Center 2</a></li>
                        <li><a href="<?php echo e(route('callCenter_3_page')); ?>" data-key="t-recover-password">Call Center 3</a></li>
                        <li><a href="<?php echo e(route('callCenter_4_page')); ?>" data-key="t-lock-screen">Call Center 4</a></li>
                         
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

                                <li><a href="<?php echo e(route('allLeadAdminShowPage')); ?>" data-key="t-level-2-1">All Leads</a></li>
                                
                                

                        </li>

                    </ul>
                </li>
                

                
                    
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa fa-cog"></i>
                        <span data-key="t-authentication">Manage</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('addManagerPage')); ?>" data-key="t-login">Add Manager</a></li>
                        <li><a href="<?php echo e(route('manualLeadUpPage')); ?>" data-key="t-register">Upload Manual Leads</a></li>
                        
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa fa-file"></i>
                        <span data-key="t-email">Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="<?php echo e(route('reportPage')); ?>" data-key="t-lock-screen">Report</a></li>
                        <li><a href="<?php echo e(route('bmWiseReportpage')); ?>" data-key="t-confirm-mail">Report BM wise</a></li>
                        <li><a href="<?php echo e(route('reportZonePage')); ?>" data-key="t-two-step-verification">Report Zone Wise</a></li>

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
                                <li><a href="<?php echo e(route('handleLeadList')); ?>" data-key="">All Leads</a></li>
                                <li><a href="<?php echo e(route('handleAudience')); ?>" data-key="">Audience</a></li>
                            </ul>
                        </li>

                        <!-- Campaign Dropdown -->
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" data-key="">Campaign</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?php echo e(route('campaignPage')); ?>" data-key="">Create Campaigns</a></li>
                                <li><a href="<?php echo e(route('allCampaign')); ?>" data-key="">All Campaigns</a></li>
                                <li><a href="<?php echo e(route('campaignDrafts')); ?>" data-key="">Draft Campaigns</a></li>
                                <li><a href="<?php echo e(route('publishCampaigns')); ?>" data-key="">Published Campaigns</a></li>
                                <li><a href="<?php echo e(route('sentCampaigns')); ?>" data-key="">Sent Campaigns</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                
                

                

                

                



                

                

                

                

                

                

                


                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 2): ?>
                <li>
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard"><?php echo e($language["Dashboard"]); ?></span>
                    </a>
                </li>
                
                <li class="menu-title mt-2" data-key="t-components">ALL New Leads Call Center</li>
                <li>
                    <a href="<?php echo e(route('allLeadsCallCenterPage')); ?>">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">New Leads</span>
                    </a>

                </li>
                <li class="menu-title mt-2" data-key="t-components">Leads Assignment By Admin Or Manager</li>
                <li>
                    <a href="<?php echo e(route('leadAssignAdminPage')); ?>">
                        <i class="fa fa-tasks"></i>
                        <span data-key="t-dashboard">Lead Assignment</span>
                    </a>

                </li>
                


                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 5): ?>
                <li>
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard"><?php echo e($language["Dashboard"]); ?></span>
                    </a>
                </li>
                
                
                <li>
                    <a href="<?php echo e(route('fetchStateList')); ?>">
                        <i class="fa fa-list"></i>
                        <span data-key="t-maps">State List</span>
                    </a>

                </li>
                
                <li>
                    <a href="<?php echo e(route('fetchDistrictList')); ?>">
                        <i class="fa fa-list"></i>
                        <span data-key="t-lock-screen">District List</span>
                    </a>

                </li>

                <li>
                    <a href="<?php echo e(route('fetchBmList')); ?>">
                        <i class="fa fa-list"></i>
                        <span data-key="t-two-step-verification">BM-Distributor List</span>
                    </a>

                </li>
                

                <?php elseif(session()->has('userdata') && session('userdata')->role_id === 3): ?>
                <li>
                    <a href="<?php echo e(route('Zonedashboard')); ?>">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard"><?php echo e($language["Dashboard"]); ?></span>
                    </a>
                </li>
                
                <li class="menu-title mt-2" data-key="t-components">ALL New Leads Call Center</li>
                <li>
                    <a href="<?php echo e(route('allLeadsCallCenterPage')); ?>">
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
                        <li><a href="<?php echo e(route('hotLeadPage')); ?>" data-key="t-login">Hot Leads</a></li>
                        <li><a href="<?php echo e(route('nuturingLeadPage')); ?>" data-key="t-register">Nurturing Leads</a></li>
                        <li><a href="<?php echo e(route('deadLeadPage')); ?>" data-key="t-recover-password">Dead Leads</a></li>
                        <li><a href="<?php echo e(route('closeLeadPage')); ?>" data-key="t-lock-screen">Close Leads</a></li>
                        
                    </ul>
                </li>
                <?php endif; ?>
            </ul>

            
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/layouts/header.blade.php ENDPATH**/ ?>