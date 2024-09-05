

<?php $__env->startSection('main-container'); ?>


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
                            <h4 class="mb-sm-0 font-size-18">Manager Info</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                                    <li class="breadcrumb-item active">Add Manager</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="text-right"style="text-align: end;">
                    <a href="<?php echo e(route('createMangePage')); ?>">
                    <button type="button" class="btn btn-primary waves-effect waves-light">+ Add Manager/Sales Exe</button>
                </a>
                </div>
                <br>
                <br>
                <br>
                <?php if(\Session::has('error')): ?>
                <div class="alert alert-danger" style="width: 50%; text-align: center; margin-left: 24%;">
                    <strong><?php echo e(\Session::get('error')); ?></strong>
                </div>
        <?php endif; ?>
        <?php if(\Session::has('success')): ?>
                <div class="alert alert-success" style="width: 50%; text-align: center; margin-left: 24%;">
                    <strong><?php echo e(\Session::get('success')); ?></strong>
                </div>
        <?php endif; ?> 
                <div class="row">
                    <?php $__currentLoopData = $userslists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                   
                    <div class="col-xl-3 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="dropdown text-end">
                                    <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                      <i class="bx bx-dots-horizontal-rounded"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="user/<?php echo e($ul->id); ?>/edit">Edit</a>
                                        
                                        <a class="dropdown-item" href="user/<?php echo e($ul->id); ?>/delete"onclick="return confirm('Are you sure you want to delete this user?');">Remove</a>
                                    </div>
                                </div>
                                
                                <div class="mx-auto mb-4">
                                    <img src="images1/<?php echo e($ul->profile_image); ?>" alt="" class="avatar-xl rounded-circle img-thumbnail">
                                </div>
                                <h5 class="font-size-16 mb-1"><?php echo e($ul->first_name); ?> <?php echo e($ul->last_name); ?></h5>
                                <p class="text-muted mb-2"><?php echo e($ul->role->role_name); ?></p>
                                <?php if($ul->role_id == 3): ?>
                                <p class="text-muted mb-2"><?php echo e($ul->zone_id->call_center_name); ?></p>
                                <?php else: ?>
                                <p class="text-muted mb-2"> <br></p>
                                
                                <span></span>
                                <?php endif; ?>
                            </div>

                            
                        </div>
                        <!-- end card -->
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- end col -->
                  
               
                    
                </div>
                
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


      
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/manager_info.blade.php ENDPATH**/ ?>