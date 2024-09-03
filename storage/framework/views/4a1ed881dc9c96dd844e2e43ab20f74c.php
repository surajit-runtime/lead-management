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
                    <form action="<?php echo e(route('filteredAllLeadList')); ?>" method="POST" enctype="multipart/form-data"
                        class="d-flex align-items-center">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                            <select id="call_center" name="call_center" required
                                data-pristine-required-message="Please select a call Center"
                                class="form-control form-select">
                                <option value="" disabled selected>Select Call Center</option>
                                <?php $__currentLoopData = $call_centerlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($call_center == $call_list->id): ?>
                                        <?php $selected='selected'; ?>
                                    <?php else: ?>
                                        <?php $selected=''; ?>
                                    <?php endif; ?>
                                    <option value="<?php echo e($call_list->id); ?>" <?php echo e($selected); ?>>
                                        <?php echo e($call_list->call_center_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                            <select id="lead_status" name="lead_status" required
                                data-pristine-required-message="Please select a Lead Status"
                                class="form-control form-select">
                                <option value="" disabled selected>Select Lead Status</option>
                                <?php $__currentLoopData = $lead_status_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($lead_status == $status_list->id): ?>
                                        <?php $selected='selected'; ?>
                                    <?php else: ?>
                                        <?php $selected=''; ?>
                                    <?php endif; ?>
                                    <option value="<?php echo e($status_list->id); ?>" <?php echo e($selected); ?>>
                                        <?php echo e($status_list->lead_status_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 custom-select" style="margin-right: 20px;">
                            <select id="lead_type" name="lead_type" required
                                data-pristine-required-message="Please select a Lead Type" class="form-control form-select">
                                <option value="" disabled selected>Select Lead Type</option>
                                <?php $__currentLoopData = $lead_type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $selected = ($lead_type == $type_list->id) ? 'selected' : ''; ?>
                                    <option value="<?php echo e($type_list->id); ?>" <?php echo e($selected); ?>>
                                        <?php echo e($type_list->lead_type_name); ?>

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
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th> <!-- Universal checkbox -->
                                            <th>First Name</th>
                                            <th>Second Name</th>
                                            <th>Call Center</th>
                                            <th>Lead Status</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>BM Name</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = $leadlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input type="checkbox" class="select-row" value="<?php echo e($ll->id); ?>">
                                                </td> <!-- Row checkbox -->
                                                <td><?php echo e($ll->first_name); ?></td>
                                                <td><?php echo e($ll->last_name); ?></td>
                                                <td><?php echo e($ll->call_center_name->call_center_name); ?></td>
                                                <td><?php echo e($ll->lead_status_name->lead_status_name); ?></td>
                                                <td><?php echo e($ll->mobile); ?></td>
                                                <td><?php echo e($ll->email); ?></td>
                                                <?php if(isset($ll->BM_name)): ?>
                                                    <td><?php echo e($ll->BM_name->bm_name); ?></td>
                                                <?php else: ?>
                                                    <td>BM Name not available</td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php
                                                $count++;
                                                Log::info('Processing lead', ['lead_id' => $ll->id]);
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <button id="create-campaign" style="float: right;" class="btn btn-primary mt-3">Create
                                    Audience</button>
                                    <div class="modal fade" id="campaignModal" tabindex="-1" aria-labelledby="campaignModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="display: flex; align-items: center; min-height: calc(100% - 1.75rem);">
                                            <div class="modal-content">
                                                <div class="modal-header">  
                                                    <h5 class="modal-title" id="campaignModalLabel">Create Audience</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="campaign-form">
                                                        <div class="mb-3">
                                                            <label for="audience-name" class="form-label">Audience Name</label>
                                                            <input type="text" class="form-control" id="audience-name" name="audience_name" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <script>
                                    // Handle select all checkbox
                                    $('#select-all').on('click', function() {
                                        $('.select-row').prop('checked', this.checked);
                                        console.log("Select all checkbox clicked");

                                    });

                                    // Handle individual checkbox click
                                    $('.select-row').on('click', function() {

                                        console.log("Individual Select checkbox clicked");
                                        if ($('.select-row:checked').length === $('.select-row').length) {
                                            $('#select-all').prop('checked', true);
                                        } else {
                                            $('#select-all').prop('checked', false);
                                        }
                                    });
                                </script>

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
            // Initialize DataTable
            var table = $('#datatable-buttons').DataTable({
                lengthChange: true,
            });
            console.log('jQuery version:', $.fn.jquery);
            console.log('DataTables version:', $.fn.dataTable);

            table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

            $(".dataTables_length select").addClass('form-select form-select-sm');
            $('#datatable-buttons').removeClass('dtr-inline');

            $('#create-campaign').on('click', function() {
                $('#campaignModal').modal('show');
            });

            $('#campaign-form').on('submit', function(event) {
                event.preventDefault();
                var audienceName = $('#audience-name').val();

                // Trim and capitalize the audience name
                audienceName = audienceName.trim().toUpperCase();

                console.log(audienceName);

                // Collect selected lead IDs
                var selectedLeads = [];
                $('.select-row:checked').each(function() {
                    selectedLeads.push($(this).val());
                });

                if (selectedLeads.length === 0) {
                    alert('Please select at least one lead.');
                    return;
                }

                // Send AJAX request to the server
                $.ajax({
                    url: '<?php echo e(route('createCampaign')); ?>', // Change this to your route
                    method: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        audience_name: audienceName,
                        lead_ids: selectedLeads // Send as array
                    },
                    success: function(response) {
                        alert('Campaign created successfully.');
                        $('#campaignModal').modal('hide');

                        // Reset the form and uncheck all checkboxes
                        $('#campaign-form')[0].reset();
                        $('.select-row').prop('checked', false);
                        $('#audience-name').val(''); // Clear the audience name field
                    },
                    error: function(xhr) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/leadList.blade.php ENDPATH**/ ?>