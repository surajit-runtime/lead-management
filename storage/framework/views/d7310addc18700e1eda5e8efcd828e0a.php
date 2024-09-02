

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
                                    <h4 class="mb-sm-0 font-size-18">New Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Call Center Wise Leads</a></li>
                                            <li class="breadcrumb-item active">Call Center 2</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <?php if(\Session::has('error')): ?>
                            <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                <i class="mdi mdi-block-helper label-icon"></i><strong><?php echo e(\Session::get('error')); ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php elseif(\Session::has('success')): ?>
                            <div class="card-body">
                                <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                    <i class="mdi mdi-check-all label-icon"></i><strong><?php echo e(\Session::get('success')); ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                           
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
        
        
                                            <tbody>
                                                <?php $count = 1; ?> 
                                                <?php $__currentLoopData = $callCenter_zone_wise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cl_cntr_zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($count); ?></td>
                                                    <td><?php echo e($cl_cntr_zone->first_name); ?></td>
                                                    <td><?php echo e($cl_cntr_zone->last_name); ?></td>
                                                    <td><?php echo e($cl_cntr_zone->mobile); ?></td>
                                                    <td><?php echo e($cl_cntr_zone->email); ?></td>
                                                    <td style="cursor: grab;"> 
                                                        <img src="<?php echo e(asset('assets/images/resume.png')); ?>" alt="Image" class="clickable-image sa-warning" style="height: 37px;" data-id="<?php echo e($cl_cntr_zone->id); ?>" data-count="<?php echo e($count); ?>">
                                                    </td>
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
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
               
            </div>
            <!-- end main content-->

    </div>
        <!-- END layout-wrapper -->
        
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



// Get all elements with the class name "sa-warning"
var elements = document.getElementsByClassName("sa-warning");

// Loop through all elements and attach the event listener
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener("click", function() {
        var id = this.getAttribute("data-id");
        var count = this.getAttribute("data-count");
       
        Swal.fire({
            title: "Are you sure?",
            text: "You want to make a new call!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "Yes"
        }).then(function (result) {
            if (result.value) {
                // Redirect to the Laravel route when the user confirms
                window.location.href = "<?php echo e(route('newCallPage')); ?>?id=" + id + "&count=" + count;
            }
        });
    });
}

</script>
<?php $__env->stopSection(); ?>        
     


<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\suraj\Downloads\Lead management\resources\views/frontend/callcenter2_admin_only.blade.php ENDPATH**/ ?>