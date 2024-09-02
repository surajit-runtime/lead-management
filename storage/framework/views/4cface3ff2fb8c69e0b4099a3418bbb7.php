

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
                                    <h4 class="mb-sm-0 font-size-18">All Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Lead Status </a></li>
                                           
                                            <li class="breadcrumb-item active">All Leads</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                       <div class="row">
                            <form action="<?php echo e(route('allLeadAdminShowPageRequest')); ?>" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                <?php echo csrf_field(); ?>
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="call_center" name="call_center" required data-pristine-required-message="Please select a call Center" class="form-control form-select">
                                        <option value="" disabled selected>Select Call Center</option>
                                        <?php $__currentLoopData = $call_centerlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($call_center == $call_list->id): ?>
                                        <?php $selected='selected'; ?>
                                     <?php else: ?> 
                                     <?php $selected=''; ?>
                                     <?php endif; ?>
                                            <option value="<?php echo e($call_list->id); ?>" <?php echo e($selected); ?>><?php echo e($call_list->call_center_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 custom-select">
                                    <select id="lead_status" name="lead_status" required data-pristine-required-message="Please select a Lead Status" class="form-control form-select">
                                        <option value="" disabled selected>Select Lead Status</option>
                                        <?php $__currentLoopData = $lead_status_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($lead_status == $status_list->id): ?>
                                        <?php $selected='selected'; ?>
                                     <?php else: ?> 
                                     <?php $selected=''; ?>
                                     <?php endif; ?>
                                            <option value="<?php echo e($status_list->id); ?>"  <?php echo e($selected); ?>><?php echo e($status_list->lead_status_name); ?></option>
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
                                        <table id="datatable-buttons" class="table table-bordered  dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>First Name</th>
                                                    <th>Second Name</th>
                                                    <th>Call Center</th>
                                                     <th>Lead Status</th>
                                                     <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>BM Name</th>
                                                    <th>BM Mobile</th> 
                                                    <th>Distributor Name</th>
                                                    <th>BM Email</th>
                                                    
                                                                                        
                                                    <th>Zone Name</th>
                                                    
                                                    <th>Lead Type</th>
                                                   
                                                    <th>Lead Data</th>
                                                    <th>Hot Call Count</th>
                                                    <th>Nurturing Call Count</th>
                                                    <th>Did Not Pick Count</th>
                                                    <th>Lead In System Count</th>
                                                    <th>Distributor Days Count</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                                <?php $count = 1; ?> 
                                                <?php $__currentLoopData = $leadlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($count); ?></td>
                                                            <td><?php echo e($ll->first_name); ?></td>
                                                            <td><?php echo e($ll->last_name); ?></td>
                                                           
                                                             <td><?php echo e($ll->call_center_name->call_center_name); ?></td>
                                                             <td><?php echo e($ll->lead_status_name->lead_status_name); ?></td>
                                                             <td><?php echo e($ll->mobile); ?></td>
                                                             <td><?php echo e($ll->email); ?></td>
                                                            
                                                            <?php if(isset($ll->BM_name)): ?>
                                                                <td><?php echo e($ll->BM_name->bm_name); ?></td>
                                                                <td><?php echo e($ll->BM_name->bm_mobile); ?></td>
                                                                <td><?php echo e($ll->BM_name->distributor_name); ?></td>
                                                                <td><?php echo e($ll->BM_name->bm_email); ?></td>
                                                            <?php else: ?>
                                                                
                                                                <td>BM Name not available</td>
                                                                <td>BM Mobile not available</td>
                                                                <td>Distributor Name  not available</td>
                                                                <td>BM Email not available</td>
                                                            <?php endif; ?>

                                                            <?php
                                                                $zone_name = $ll->zone_id ? $ll->zone_id->zone_name : "No Zone";
                                                            ?>
                                                           
                                                            <td><?php echo e($zone_name); ?></td>
                                                           
                                                            <td><?php echo e($ll->lead_type_name->lead_type_name); ?></td>
                                                            
                                                            <td><?php echo e($ll->lead_data); ?></td>
                                                            <td><?php echo e($ll->reprt->hot_count); ?></td>
                                                            <td><?php echo e($ll->reprt->nurturing_count); ?></td>
                                                            <td><?php echo e($ll->reprt->did_not_pick_count); ?></td>
                                                            <td><?php echo e($ll->reprt->lead_days_count); ?></td>
                                                            <td><?php echo e($ll->reprt->distributor_days_count); ?></td>
                                                            
                                                            
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
     


<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\suraj\Downloads\Lead management\resources\views/frontend/allLeadsAdminShow.blade.php ENDPATH**/ ?>