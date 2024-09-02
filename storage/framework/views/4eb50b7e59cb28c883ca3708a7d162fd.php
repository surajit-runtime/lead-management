

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
                                    <h4 class="mb-sm-0 font-size-18">Report</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                           
                                            <li class="breadcrumb-item active">Report</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                       <div class="row">
                            <form action="<?php echo e(route('currentReportFilter')); ?>" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                <?php echo csrf_field(); ?>
                               
                                <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                                    <select id="call_center" name="call_center" required data-pristine-required-message="Please select a Call Center" class="form-control form-select">
                                        <option value="" disabled selected>Select Call Center</option>
                                        <?php $__currentLoopData = $call_centerlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($call_center_id == $cl->id): ?>
                                               <?php $selected='selected'; ?>
                                            <?php else: ?> 
                                            <?php $selected=''; ?>
                                            <?php endif; ?>
                                            <option value="<?php echo e($cl->id); ?>" <?php echo e($selected); ?>>
                                                <?php echo e($cl->call_center_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3" style="margin-right: 20px;">
                                    <input class="form-control" type="month" value="<?php echo e($currentYear); ?>-<?php echo e($currentMonth); ?>" id="example-month-input" name="month_year">
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
                                                    
                                                    <th>Month</th>
                                                    <th>Call Center</th>
                                                    <th>Total Leads</th>
                                                    <th>Hot Leads</th>
                                                    <th>Nuturing Leads</th>
                                                    <th>Dead Leads</th>
                                                   
                                                    <th>Pending Leads</th>
                                                    <th>Closed Leads</th>

                                                    
                                                    
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php $__currentLoopData = $monthlyLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mL): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <tr>
                                                    <td><?php echo e(date('F', mktime(0, 0, 0, $mL->month, 1))); ?>-<?php echo e($currentYear); ?></td>
                                                    <td><?php echo e($mL->call_center_name); ?></td>
                                                <td><?php echo e($mL->total_lead_count); ?></td>
                                                <td><?php echo e($mL->hot_lead_count); ?></td>
                                                <td><?php echo e($mL->nurturing_lead_count); ?></td>
                                                <td><?php echo e($mL->dead_lead_count); ?></td>
                                                
                                                <td><?php echo e($mL->pending_leads_count); ?></td>
                                                <td><?php echo e($mL->close_lead_count); ?></td>
                                                
                                            </tr>
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




$(document).ready(function () {
  $('#datatable').DataTable();

  // Buttons examples
  var table = $('#datatable-buttons').DataTable({
    lengthChange: true,
    dom: 'Bfrtip',
    "order": [],
    buttons: [
      {
        extend: 'excel',
        filename: 'Lead Management System',
        messageTop: 'Month Wise Report',
        // Access the 'text' property of the object
        customize: function ( xlsx ){
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
               
                // // jQuery selector to add a border
        //    $('row c', sheet).attr('s', '25');
        $('row:nth-child(n+3) c', sheet).attr('s', '25');
        // $('row c[r^="A1+G1"]', sheet).attr( 's', '51' );
        $('row:nth-child(1) c', sheet).attr('s', '47');
        $('row:nth-child(2) c', sheet).attr('s', '42');   
        $('row:nth-child(3) c', sheet).attr('s', '32');    
      
       
           
            },
           
      },
      
      'pdf',
    ],
  
  });

  table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

  $(".dataTables_length select").addClass('form-select form-select-sm');
  table.removeClass('dtr-inline');


  
});


;




</script>

<?php $__env->stopSection(); ?>        
     


<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\suraj\Downloads\Lead management\resources\views/frontend/reports.blade.php ENDPATH**/ ?>