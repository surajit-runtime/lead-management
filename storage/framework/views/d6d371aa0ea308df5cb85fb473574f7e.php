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
                            <h4 class="mb-sm-0 font-size-18">All Campaigns</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Campaigns</a></li>
                                    <li class="breadcrumb-item active">All Campaigns</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>SR No</th>
                                            <th>Campaign Name</th>
                                            <th>Audience Name</th>
                                            <th>Channel</th>
                                            <th>Subject</th>
                                            <th>Body</th>
                                            <th>Flag</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($count++); ?></td>
                                                <td><?php echo e($campaign->campaign_name); ?></td>
                                                <td><?php echo e($campaign->audience->audience_name); ?></td>
                                                <td><?php echo e(ucfirst($campaign->channel)); ?></td>
                                                <td><?php echo e($campaign->subject); ?></td>
                                                <td><?php echo e($campaign->body); ?></td>
                                                <td>
                                                    <?php switch($campaign->flag):
                                                        case (0): ?>
                                                            Draft
                                                            <?php break; ?>
                                                        <?php case (1): ?>
                                                            Published
                                                            <?php break; ?>
                                                        <?php case (2): ?>
                                                            Sent Now
                                                            <?php break; ?>
                                                        <?php default: ?>
                                                            Unknown
                                                    <?php endswitch; ?>
                                                </td>
                                                <td><?php echo e($campaign->date->format('Y-m-d H:i:s')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                                <script>
                                    $(document).ready(function() {
                                        // Initialize DataTable
                                        var table = $('#datatable-buttons').DataTable({
                                            lengthChange: true,
                                        });
                                        console.log('jQuery version:', $.fn.jquery);
                                        console.log('DataTables version:', $.fn.dataTable);

                                        table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

                                        $(".dataTables_length select").addClass('form-select form-select-sm');
                                        $('#datatable-buttons').removeClass('dtr-inline');
                                    });
                                </script>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div><!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/campaigns.blade.php ENDPATH**/ ?>