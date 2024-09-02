

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
                            <h4 class="mb-sm-0 font-size-18">Add Lead Manually</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Upload Manual Leads</a></li>
                                    
                                    <li class="breadcrumb-item active">Add Lead Manually</li>
                                </ol>
                                <br>
                                <br>
                               
                            </div>

                        </div>
                    </div>
                </div>
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
                <!-- end page title -->
               
                       
                         

                
                            
                            
            
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <!-- Card Header -->
      
                    <div class="card-body">
                        <form id="pristine-valid-example" method="post" action="<?php echo e(route('storeLeadManually')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="first_name" placeholder="Enter First name" name="first_name"  />
                                    </div>
                                    <span class="text-danger">
                                        <?php $__errorArgs = ['first_name'];
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" />
                                    </div>
                                    <span class="text-danger">
                                        <?php $__errorArgs = ['last_name'];
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
                                </div>
                                
                                
                               
                            
                            
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="created_from" class="form-label">Lead Source<sup style="color:red;">*</sup></label>
                                        <select id="created_from" name="created_from" required class="form-select">
                                            <option value="" disabled selected>Select Lead Source</option>
                                          
                                                <option value="Instagram">Instagram</option>
                                                <option value="Website">Website</option>
                                                <option value="Facebook">Facebook</option>
                                               
                                           
                                        </select>
                                    </div>
                                    <span class="text-danger">
                                        <?php $__errorArgs = ['created_from'];
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
                                </div>
                                
                           
        
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<sup style="color:red;">*</sup></label>
                                        <input type="email" required class="form-control" id="email" placeholder="Enter your Email" name="email" />
                                    </div>
                                    <span class="text-danger">
                                        <?php $__errorArgs = ['email'];
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile Number<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="mobile" placeholder="Enter Mobile Number" name="mobile" maxlength="10" pattern="[0-9]*" inputmode="numeric" />
                                    </div>
                                    
                                    <span class="text-danger">
                                        <?php $__errorArgs = ['mobile'];
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pincode" class="form-label">Pincode<sup style="color:red;">*</sup></label>
                                        <input type="text" required class="form-control" id="pincode" placeholder="Enter Pincode" name="pincode" maxlength="6" pattern="[0-9]*" inputmode="numeric" />
                                    </div>
                                    
                                    <span class="text-danger">
                                        <?php $__errorArgs = ['pincode'];
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
                                </div>
                              
        
                              
                            </div>
 
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            
                        </form>
                       <a href="<?php echo e(route('manualLeadUpPage')); ?>"> <button type="button" class="btn btn-dark">Back</button></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>


       
    
        

    </div>
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script>
    function fetchDistricts() {
        var stateId = document.getElementById('state').value;

        // Make an Ajax request to fetch districts based on the selected state
        $.ajax({
            type: 'GET',
            url: 'fetch-districts', // Update this route to the actual route in your routes file
            data: {
                stateId: stateId,
        },
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success: function(data) {
                // Update the district options based on the response
                var districtSelect = document.getElementById('district');
                districtSelect.innerHTML = '<option value="" disabled selected>Select District</option>';
                data.forEach(function(district) {
                    var option = document.createElement('option');
                    option.value = district.id;
                    option.text = district.city;
                    districtSelect.add(option);
                });
            },
            error: function(error) {
                console.log('Error fetching districts:', error);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/addLeadManually.blade.php ENDPATH**/ ?>