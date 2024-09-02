

<?php $__env->startSection('main-container'); ?>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Lead Management System</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

               
                <!-- end page title -->
                <?php if(session()->has('userdata') && session('userdata')->role_id === 1 ||session()->has('userdata') && session('userdata')->role_id === 2): ?>
                <?php if($unassigned_count > 0): ?>
                
                <a href="<?php echo e(route('leadAssignAdminPage')); ?>">
                <div class="row">
                    <div class="col-12">
                            <div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert">
                                <i class="mdi mdi-alert-circle-outline label-icon"></i><strong>You have <?php echo e($unassigned_count); ?> new Lead(s) , kindly assign it to the Call centers.</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> 
                    </div>
                </div>  
            </a> 
               <?php endif; ?>  
               <?php endif; ?>
               <br>
               <br>
               <?php
        
       
               $defaultData_admin = array_fill(0, 12, 0);

               // Fill the defaultData array with actual counts for the months that have data
               foreach ($hot_lead_month_wise_countArray as $count) {
                   $defaultData_admin[$count->month - 1] = $count->count;
               } 
               $default_data_nurturing_admin = array_fill(0, 12, 0);
               foreach ($nurturing_lead_month_wise_count as $count) {
                   $default_data_nurturing_admin[$count->month - 1] = $count->count;
               } 
               
               $default_data_dead_admin = array_fill(0, 12, 0);
               foreach ($dead_lead_month_wise_countArray as $count) {
                   $default_data_dead_admin[$count->month - 1] = $count->count;
               } 
               $default_data_closed_admin = array_fill(0, 12, 0);
               foreach ($closed_lead_month_wise_countArray as $count) {
                   $default_data_closed_admin[$count->month - 1] = $count->count;
               } 
               
               $default_data_fb_admin = array_fill(0, 12, 0);
               foreach ($fb_month_wise_countArray as $count) {
                   $default_data_fb_admin[$count->month - 1] = $count->count;
               } 
               
               $default_data_insta_admin = array_fill(0, 12, 0);
               foreach ($insta_month_wise_countArray as $count) {
                   $default_data_insta_admin[$count->month - 1] = $count->count;
               } 
               
               $default_data_web_admin = array_fill(0, 12, 0);
               foreach ($web_month_wise_countArray as $count) {
                   $default_data_web_admin[$count->month - 1] = $count->count;
               } 
               
               $default_data_manual_admin = array_fill(0, 12, 0);
               foreach ($manual_month_wise_countArray as $count) {
                   $default_data_manual_admin[$count->month - 1] = $count->count;
               } 
       ?>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Total Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($total_leads); ?>">0</span>
                                        </h4>
                                    </div>

                                    
                                </div>
                                
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Hot Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($hot_leads_count); ?>">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        
                                        
                                        <div id="mini-chart9" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Nurturing Lead</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($nurturing_lead_count); ?>">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart10" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Dead Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($dead_lead_count); ?>">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart11" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->    
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Closed Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($closed_lead_count); ?>">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart18" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->  
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Unassigned Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($unassigned_count); ?>">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    
                                </div>
                            </div><!-- end card body -->
                           
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Pending Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($pending_leads_count); ?>">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    
                                </div>
                            </div><!-- end card body -->
                           
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Facebook Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($fb_count); ?>">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart12" data-colors='["#5156be"]' class="apex-charts mb-3"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Instagram Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($insta_count); ?>">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart13" data-colors='["#5156be"]' class="apex-charts mb-3"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Manual Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($manual_lead_count); ?>">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart14" data-colors='["#5156be"]' class="apex-charts mb-3"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text">Website Leads</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo e($web_count); ?>">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart15" data-colors='["#5156be"]' class="apex-charts mb-3"></div>
                                        <span class="ms-1 text-muted font-size-8"style="font-size: 11px;">Monthly Data of <?php echo e($currentYear); ?></span>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row-->

                

                
                <!-- end row-->


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->

</div>


    </div>
    <!-- JAVASCRIPT -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/dashboard.blade.php ENDPATH**/ ?>