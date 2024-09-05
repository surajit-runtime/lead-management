<?php $__env->startSection('main-container'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><a href="<?php echo e(route('handleAudience')); ?>" class="text-dark">Audience</a> - <?php echo e($audience->audience_name); ?></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('handleAudience')); ?>">Audiences</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('audience.leads', $audience->id)); ?>"><?php echo e($audience->audience_name); ?></a></li>
                                <li class="breadcrumb-item active">Leads</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if(session('status')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>

                            <!-- Move the "Remove Selected Leads" button to the top -->
                            <form action="<?php echo e(route('audience.leads.remove-multiple', $audience->id)); ?>" method="POST" id="removeLeadsForm">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-danger mb-2">Remove Selected Leads</button>

                                <table class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>S.No</th>
                                            <th>Lead Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input type="checkbox" name="lead_ids[]" value="<?php echo e($lead->id); ?>" class="lead-checkbox"></td>
                                                <td><?php echo e($count); ?></td>
                                                <td><?php echo e($lead->first_name); ?> <?php echo e($lead->last_name); ?></td>
                                                <td><?php echo e($lead->mobile); ?></td>
                                                <td><?php echo e($lead->email); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('audience.leads.remove', [$audience->id, $lead->id])); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $count++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- End card -->
                </div> <!-- End col -->
            </div><!-- End row -->

        </div> <!-- Container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- End main content -->

<script>
    $(document).ready(function() {
        const leadCheckboxes = $('.lead-checkbox');
        const selectAllCheckbox = $('#select-all');

        // Initialize DataTable
        $('.table').DataTable({
            lengthChange: true,
        });

        // Select all checkboxes when "Select All" checkbox is clicked
        selectAllCheckbox.click(function() {
            leadCheckboxes.prop('checked', this.checked);
        });

        // Update "Select All" checkbox based on individual checkbox selection
        leadCheckboxes.click(function() {
            if (leadCheckboxes.length === $('.lead-checkbox:checked').length) {
                selectAllCheckbox.prop('checked', true); // All checkboxes are selected
            } else {
                selectAllCheckbox.prop('checked', false); // Not all checkboxes are selected
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/audience-leads.blade.php ENDPATH**/ ?>