<?php $__env->startSection('main-container'); ?>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container px-4 mx-auto">
                <div class="p-6 m-20 bg-white rounded shadow" style="background-color: #f3f4f6;"> <!-- Example: Tailwind's gray-100 -->
                    <?php echo $chart->container(); ?>

                </div>
            </div>
            <script src="<?php echo e($chart->cdn()); ?>"></script>
            <?php echo e($chart->script()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/charts/index.blade.php ENDPATH**/ ?>