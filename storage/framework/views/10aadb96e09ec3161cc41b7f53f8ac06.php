<?php $__env->startSection('main-container'); ?>


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">CSV File Upload</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                                    
                                    <li class="breadcrumb-item active">Upload Manual Leads</li>
                                </ol>
                                <br>
                                <br>
                                <a href="<?php echo e(route('Manually_Adn_Page')); ?>"><button type="button"
                                        class="btn btn-primary">Add Lead Manually</button></a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                



                
                
                

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">CSV File Upload</div>

                                <div class="card-body">
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php if(session('error')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session('error')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('err_arr') && is_array(session('err_arr'))): ?>
                                        <div class="alert alert-danger">
                                            Duplicate Data Found!! Check below table
                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('mob_email_err') && is_array(session('mob_email_err'))): ?>
                                        <div class="alert alert-danger">
                                            Mobile or Email is not Vaild Check below table
                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('pincode_err') && is_array(session('pincode_err'))): ?>
                                        <div class="alert alert-danger">
                                            The Lenght of Pincode is not correct. Check below table
                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('state_district_err') && is_array(session('state_district_err'))): ?>
                                        <div class="alert alert-danger">
                                            Pincode does not exist.Check below table
                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('first_last_name_error') && is_array(session('first_last_name_error'))): ?>
                                        <div class="alert alert-danger">
                                            First Name or Last Name not valid.Check below table
                                        </div>
                                    <?php endif; ?>

                                    
                                    
                                    <form action="<?php echo e(route('importCsv')); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="csv_file">Choose CSV File</label>
                                            <input type="file" name="csv_file" id="csv_file" class="form-control-file"
                                                accept=".csv">
                                        </div>
                                        <span class="text-danger">
                                            <?php $__errorArgs = ['csv_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <?php echo e($message); ?>

                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </span>
                                        <br>
                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary">Upload in CSV</button>
                                    </form>
                                    <a href="https://staging.tubesleadhub.com/Example_leadUpload_and_convert_to_CSV(1).xlsx"
                                        download="Example_Format_Excel_convert_to_csv" class="btn btn-primary">Download
                                        Format In Excel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <br>
                <br>
                <br>
                <br>
                <br>
                <?php if(session('err_arr') && is_array(session('err_arr'))): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Duplicate Data</h4>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons1" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            
                                            
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Info</th>


                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = session('err_arr'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                
                                                
                                                <td><?php echo e($error['first_name']); ?></td>
                                                <td><?php echo e($error['last_name']); ?></td>
                                                <td><?php echo e($error['mobile']); ?></td>
                                                <td><?php echo e($error['email']); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('user.details', ['id' => $error['user_id']])); ?>"
                                                        target="_blank">
                                                        <img src="<?php echo e(asset('assets/images/informations.png')); ?>"
                                                            alt="">
                                                    </a>
                                                    

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
                <?php endif; ?>
                <?php if(session('mob_email_err') && is_array(session('mob_email_err'))): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Email or Mobile Error</h4>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons2" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            
                                            
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>



                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = session('mob_email_err'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                
                                                
                                                <td><?php echo e($error['first_name']); ?></td>
                                                <td><?php echo e($error['last_name']); ?></td>
                                                <td><?php echo e($error['mobile']); ?></td>
                                                <td><?php echo e($error['email']); ?></td>

                                            </tr>
                                            <?php $count++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                <?php endif; ?>
                <?php if(session('pincode_err') && is_array(session('pincode_err'))): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pincode Length Invalid</h4>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons3" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            
                                            
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Pincode</th>
                                            


                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = session('pincode_err'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                
                                                
                                                <td><?php echo e($error['first_name']); ?></td>
                                                <td><?php echo e($error['last_name']); ?></td>
                                                <td><?php echo e($error['mobile']); ?></td>
                                                <td><?php echo e($error['email']); ?></td>
                                                <td><?php echo e($error['pincode']); ?></td>
                                                
                                                

                                                
                                            </tr>
                                            <?php $count++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                <?php endif; ?>
                <?php if(session('state_district_err') && is_array(session('state_district_err'))): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pincode does not exist</h4>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons4" class="table table-bordered w-100">
                                    <thead>
                                        <tr>
                                            
                                            
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>State</th>
                                            <th>District</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = session('state_district_err'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                
                                                
                                                <td><?php echo e($error['first_name']); ?></td>
                                                <td><?php echo e($error['last_name']); ?></td>
                                                <td><?php echo e($error['mobile']); ?></td>
                                                <td><?php echo e($error['email']); ?></td>
                                                <td><?php echo e($error['state_name']); ?></td>
                                                <td><?php echo e($error['district_name']); ?></td>
                                            </tr>
                                            <?php $count++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                <?php endif; ?>
                <?php if(session('first_last_name_error') && is_array(session('first_last_name_error'))): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">First Name or Last Name Error</h4>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons5" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            
                                            
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>



                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = session('first_last_name_error'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                
                                                
                                                <td><?php echo e($error['first_name']); ?></td>
                                                <td><?php echo e($error['last_name']); ?></td>
                                                <td><?php echo e($error['mobile']); ?></td>
                                                <td><?php echo e($error['email']); ?></td>

                                            </tr>
                                            <?php $count++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                <?php endif; ?>
            </div>
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
            var table = $('#datatable-buttons1').DataTable({
                lengthChange: true,
                buttons1: [{
                        extend: 'excel',
                        filename: 'Lead Management System',

                    },
                    'pdf'
                ]
            });
            var table1 = $('#datatable-buttons2').DataTable({
                lengthChange: true,
                buttons2: [{
                        extend: 'excel',
                        filename: 'Lead Management System',

                    },
                    'pdf'
                ]
            });
            var table2 = $('#datatable-buttons3').DataTable({
                lengthChange: true,
                buttons3: [{
                        extend: 'excel',
                        filename: 'Lead Management System',

                    },
                    'pdf'
                ]
            });
            var table3 = $('#datatable-buttons4').DataTable({
                lengthChange: true,
                buttons4: [{
                        extend: 'excel',
                        filename: 'Lead Management System',

                    },
                    'pdf'
                ]
            });
            var table4 = $('#datatable-buttons5').DataTable({
                lengthChange: true,
                buttons4: [{
                        extend: 'excel',
                        filename: 'Lead Management System',

                    },
                    'pdf'
                ]
            });
            table.buttons1().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            table1.buttons2().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            table2.buttons3().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            table3.buttons4().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            table3.buttons5().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');



            $(".dataTables_length select").addClass('form-select form-select-sm');
            table.removeClass('dtr-inline');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\suraj\Downloads\Lead management\resources\views/frontend/manualLeadsUpload.blade.php ENDPATH**/ ?>