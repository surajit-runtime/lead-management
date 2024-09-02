@extends('frontend.layouts.main')

@section('main-container')
<style>

</style>

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
                            <h4 class="mb-sm-0 font-size-18"><a href="{{ route('fetchStateList') }}"> <button type="button" class="btn btn-dark waves-effect waves-light">Back</button></a></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">State List</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Add State</a></li>
                                
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @if (\Session::has('error'))
                        <div class="alert alert-danger" style="width: 50%; text-align: center; margin-left: 24%;">
                            <strong>{{ \Session::get('error') }}</strong>
                        </div>
                @endif
                @if (\Session::has('success'))
                        <div class="alert alert-success" style="width: 50%; text-align: center; margin-left: 24%;">
                            <strong>{{ \Session::get('success') }}</strong>
                        </div>
                @endif 
{{-- @php
    print_r($errors->all());
@endphp --}}
    {{-- <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <!-- Card Header -->
                <!-- ... (Your card header content) ... -->

                <div class="card-body">
                    <form id="pristine-valid-example"  method="post" action="{{ route('store') }}">
                        <!-- Form Fields -->
                        @csrf
                        <div class="row">
                            <!-- First Name and Last Name -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>State Name</label>
                                    <input type="text" required data-pristine-required-message="Please Enter a State Name" class="form-control" placeholder="State name" name='state_name' />
                                </div>
                            </div>
                            

                         
                         
                           

                            <!-- Zone and Status -->
                            <div class="col-md-6">
                                <div class="form-group mb-3 custom-select">
                                    <label for="zone">Zone</label>
                                    <select id="zone" name="zone_id" required data-pristine-required-message="Please select a Zone" class="form-control form-select" >
                                        <option value="" disabled selected>Select Zone </option>
                                        @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->zone_name }}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                            </div>
                           
                        </div>

                     
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Save State</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <!-- Card Header -->
  
                <div class="card-body">
                    <form id="pristine-valid-example" method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>State Name</label>
                                    <input type="text" required data-pristine-required-message="Please Enter a State Name" class="form-control" placeholder="State name" name='state_name' />
                                </div>
                                <span class="text-danger">
                                    @error('last_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Zone and Status -->
                            <div class="col-md-6">
                                <div class="form-group mb-3 custom-select">
                                    <label for="zone">Zone</label>
                                    <select id="zone" name="zone_id" required data-pristine-required-message="Please select a Zone" class="form-control form-select" >
                                        <option value="" disabled selected>Select Zone </option>
                                        @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->zone_name }}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('last_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
   
                        </div>
                 
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save State</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
                
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


      
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<!-- END layout-wrapper -->
<script src="{{ asset('assets/libs/pristinejs/pristine.min.js') }}"></script>
<!-- form validation -->
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>


@endsection