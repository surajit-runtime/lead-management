@extends('frontend.layouts.main')

@section('main-container')

    <div class="main-content">
       

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">BM-Distributor List</a></li>
                                    <li class="breadcrumb-item active">{{ $bm_detail->distributor_name }} - {{ $bm_detail->bm_name }} Detail</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
             
                
                <div class="row" style="justify-content: center;">
                    @if (\Session::has('error'))
                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                        <i class="mdi mdi-block-helper label-icon"></i><strong>{{ \Session::get('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (\Session::has('success'))
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                            <i class="mdi mdi-check-all label-icon"></i><strong>{{ \Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                   
                 
                    <div class="col-9">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4 class="card-title">Buttons example</h4>
                                <p class="card-title-desc">The Buttons extension for DataTables
                                    provides a common set of options, API methods and styling to display
                                    buttons on a page that will interact with a DataTable. The core library
                                    provides the based framework upon which plug-ins can built.
                                </p>
                            </div> --}}
                            <div class="card-body">
                                <div>
                                   <strong style="font-size: 1.5rem">{{ $bm_detail->distributor_name }} - {{ $bm_detail->bm_name }} Detail</strong>
                                </div>
                              <hr>
                              <div>
                                <form id="pristine-valid-example" novalidate method="post" action="/bm_dist_detail/{{ $bm_detail->id }}/update">
                                    @csrf
                                    @method('PUT')
                                    {{-- <input type="hidden" name="distributor_id" value="{{ $bm_detail->id }}"> --}}
                                    <div class="row">
                                        
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>Distributor Name</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a Distributor Name" class="form-control" placeholder="Distributor Name" value="{{ $bm_detail->distributor_name }}" name="distributor_name" />
                                            </div>
                                            <span class="text-danger">
                                                @error('distributor_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>BM Name</label>
                                                <input type="text" required data-pristine-required-message="Please Enter a BM Name" class="form-control" placeholder="BM name"  value="{{ $bm_detail->bm_name }}" name="bm_name"/>
                                            </div>
                                            <span class="text-danger">
                                                @error('bm_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        
                                     
                                        
                                        
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>BM Mobile </label>
                                                <input type="text" required data-pristine-required-message="Please Enter BM Mobile" class="form-control" placeholder="BM Mobile"  value="{{ $bm_detail->bm_mobile}}" name="bm_mobile" />
                                            </div>
                                            <span class="text-danger">
                                                @error('bm_mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-xl-6 col-md-6"> <!-- Change the column width to 6 to have two fields in a row -->
                                            <div class="form-group mb-3">
                                                <label>BM Email</label>
                                                <input type="text" required data-pristine-required-message="Please Enter BM email" class="form-control" placeholder="BM Email"  value="{{ $bm_detail->bm_email}}" name="bm_email" />
                                            </div>
                                            <span class="text-danger">
                                                @error('bm_email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        
                                        
                                        <div class="form-group text-center">
                                            
                                            <button type="submit" class="btn btn-primary" style="margin-left: 5px;">Submit</button>
     
                                </form>
                                <a href="{{ route('fetchBmList') }}"><button type="button" class="btn btn-dark waves-effect waves-light" style="margin-left: 5px;">Back</button></a>
                            </div>
                                   
                                    
                        </div>
                              </div>
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
<!-- END layout-wrapper -->
<script src="{{ asset('assets/libs/pristinejs/pristine.min.js') }}"></script>
<!-- form validation -->
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>


@endsection        
     