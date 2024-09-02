@extends('frontend.layouts.main')

@section('main-container')


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
                            <h4 class="mb-sm-0 font-size-18">Manager Info</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                                    <li class="breadcrumb-item active">Add Manager</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="text-right"style="text-align: end;">
                    <a href="{{ route('createMangePage') }}">
                    <button type="button" class="btn btn-primary waves-effect waves-light">+ Add Manager/Sales Exe</button>
                </a>
                </div>
                <br>
                <br>
                <br>
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
                <div class="row">
                    @foreach ($userslists as $ul )
                        
                   
                    <div class="col-xl-3 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="dropdown text-end">
                                    <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                      <i class="bx bx-dots-horizontal-rounded"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="user/{{ $ul->id }}/edit">Edit</a>
                                        
                                        <a class="dropdown-item" href="user/{{ $ul->id }}/delete"onclick="return confirm('Are you sure you want to delete this user?');">Remove</a>
                                    </div>
                                </div>
                                
                                <div class="mx-auto mb-4">
                                    <img src="images1/{{ $ul->profile_image }}" alt="" class="avatar-xl rounded-circle img-thumbnail">
                                </div>
                                <h5 class="font-size-16 mb-1">{{ $ul->first_name }} {{ $ul->last_name }}</h5>
                                <p class="text-muted mb-2">{{ $ul->role->role_name }}</p>
                                @if($ul->role_id == 3)
                                <p class="text-muted mb-2">{{ $ul->zone_id->call_center_name }}</p>
                                @else
                                <p class="text-muted mb-2"> <br></p>
                                
                                <span></span>
                                @endif
                            </div>

                            {{-- <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-light text-truncate"><i class="uil uil-user me-1"></i> Profile</button>
                                <button type="button" class="btn btn-outline-light text-truncate"><i class="uil uil-envelope-alt me-1"></i> Message</button>

                            </div> --}}
                        </div>
                        <!-- end card -->
                    </div>
                    @endforeach
                    <!-- end col -->
                  
               
                    
                </div>
                
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


      
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


@endsection