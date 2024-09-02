

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
                                    <h4 class="mb-sm-0 font-size-18">BM Wise Report</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                           
                                            <li class="breadcrumb-item active">BM Wise Report</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                       
                                        
                                    
                            
                       
                       <div class="row">
                            <form action="<?php echo e(route('bmWiseReportFilter')); ?>" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                <?php echo csrf_field(); ?>
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="zone" name="zone" required data-pristine-required-message="Please select a Zone
                                    " class="form-control form-select">
                                        <option value="" disabled selected>Select Zone</option>
                                        <?php $__currentLoopData = $zone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($zone_name == $z->id): ?>
                                        <?php $selected='selected'; ?>
                                     <?php else: ?> 
                                     <?php $selected=''; ?>
                                     <?php endif; ?>
                                        <option value="<?php echo e($z->id); ?>" <?php echo e($selected); ?>>
                                                <?php echo e($z->zone_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                              </div>
                                
                                            
                                <div class="ms-3" style="margin-top: -13px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div> 
                        
                        <br>
                        <br>
                        <!-- end page title -->
                        <div class="row">
                           
                           
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>BM Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Zone</th>
                                                    <th>Hot Leads</th>
                                                    <th>Closed Leads</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                               
                                                <?php $count = 1; ?> 
                                                <?php $__currentLoopData = $bm_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($count); ?></td>
                                                    <td><?php echo e($bm->bm_name); ?></td>
                                                    <td><?php echo e($bm->bm_email); ?></td>
                                                    <td><?php echo e($bm->bm_mobile); ?></td>
                                                     <td><?php echo e($bm->zone_name->zone_name); ?></td>
                                                    <td><?php echo e($bm->hot_count); ?></td>
                                                    <td><?php echo e($bm->closed_count); ?></td>
                                                    
                                                    
                                                     
                                                   
                                                </tr>
                                                <?php $count++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                          </tbody>
                                        </table>
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
<script>
    $(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: true,
        buttons: ['excel', 'pdf']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $(".dataTables_length select").addClass('form-select form-select-sm');
    table.removeClass('dtr-inline');
});
</script>
<?php $__env->stopSection(); ?>        
     


<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\suraj\Downloads\Lead management\resources\views/frontend/report_BM_wise.blade.php ENDPATH**/ ?>