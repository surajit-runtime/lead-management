@extends('frontend.layouts.main')

@section('main-container')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">CSV File Upload</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Upload ManualLeads</a></li> --}}
                                    <li class="breadcrumb-item active">Upload Manual Leads</li>
                                </ol>
                                <br>
                                <br>
                                <a href="{{ route('Manually_Adn_Page') }}"><button type="button"
                                        class="btn btn-primary">Add Lead Manually</button></a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                {{--
                            //   print_r($errors->all());
                            //   print_r($err_arr); --}}



                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4 class="card-title">Dropzone</h4>
                                <p class="card-title-desc">DropzoneJS is an open source library
                                    that provides drag’n’drop file uploads with image previews.
                                </p> --}}
                {{-- </div> --}}
                {{-- <div class="card-body">

                                <div>
                                    <form action="{{ route('importCsv') }}" class="dropzone" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="multiple">
                                        </div>
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                            </div>
                                            <h5>Drop files here or click to upload CSV.</h5>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Upload CSV</button>
                                        </div>
                                    </form>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid --> --}}

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">CSV File Upload</div>

                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if (session('err_arr') && is_array(session('err_arr')))
                                        <div class="alert alert-danger">
                                            Duplicate Data Found!! Check below table
                                        </div>
                                    @endif
                                    @if (session('mob_email_err') && is_array(session('mob_email_err')))
                                        <div class="alert alert-danger">
                                            Mobile or Email is not Vaild Check below table
                                        </div>
                                    @endif
                                    @if (session('pincode_err') && is_array(session('pincode_err')))
                                        <div class="alert alert-danger">
                                            The Lenght of Pincode is not correct. Check below table
                                        </div>
                                    @endif
                                    @if (session('state_district_err') && is_array(session('state_district_err')))
                                        <div class="alert alert-danger">
                                            Pincode does not exist.Check below table
                                        </div>
                                    @endif
                                    @if (session('first_last_name_error') && is_array(session('first_last_name_error')))
                                        <div class="alert alert-danger">
                                            First Name or Last Name not valid.Check below table
                                        </div>
                                    @endif

                                    {{-- @if (session('err_arr'))
                            @foreach (session('err_arr') as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif --}}
                                    {{-- {{ route('importCsv') }} --}}
                                    <form action="{{ route('importCsv') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="csv_file">Choose CSV File</label>
                                            <input type="file" name="csv_file" id="csv_file" class="form-control-file"
                                                accept=".csv">
                                        </div>
                                        <span class="text-danger">
                                            @error('csv_file')
                                                {{ $message }}
                                            @enderror
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
                @if (session('err_arr') && is_array(session('err_arr')))
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Duplicate Data</h4>
                                {{-- <p class="card-title-desc">The Buttons extension for DataTables
                                    provides a common set of options, API methods and styling to display
                                    buttons on a page that will interact with a DataTable. The core library
                                    provides the based framework upon which plug-ins can built.
                                </p> --}}
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons1" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            {{-- <th>User ID</th> --}}
                                            {{-- <th>Position</th> --}}
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Info</th>


                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach (session('err_arr') as $error)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                {{-- <td>{{ $error['user_id'] }}</td> --}}
                                                {{-- <td>{{ $error['position'] }}</td> --}}
                                                <td>{{ $error['first_name'] }}</td>
                                                <td>{{ $error['last_name'] }}</td>
                                                <td>{{ $error['mobile'] }}</td>
                                                <td>{{ $error['email'] }}</td>
                                                <td>
                                                    <a href="{{ route('user.details', ['id' => $error['user_id']]) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('assets/images/informations.png') }}"
                                                            alt="">
                                                    </a>
                                                    {{-- <a href="javascript:void(0);" onclick="openLinkInBackground('{{ route('user.details', ['id' => $error['user_id']]) }}')">
                                            <img src="{{ asset('assets/images/informations.png') }}" alt="">
                                        </a> --}}

                                                </td>
                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                @endif
                @if (session('mob_email_err') && is_array(session('mob_email_err')))
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Email or Mobile Error</h4>
                                {{-- <p class="card-title-desc">The Buttons extension for DataTables
                                    provides a common set of options, API methods and styling to display
                                    buttons on a page that will interact with a DataTable. The core library
                                    provides the based framework upon which plug-ins can built.
                                </p> --}}
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons2" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            {{-- <th>User ID</th> --}}
                                            {{-- <th>Position</th> --}}
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>



                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach (session('mob_email_err') as $error)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                {{-- <td>{{ $error['user_id'] }}</td> --}}
                                                {{-- <td>{{ $error['position'] }}</td> --}}
                                                <td>{{ $error['first_name'] }}</td>
                                                <td>{{ $error['last_name'] }}</td>
                                                <td>{{ $error['mobile'] }}</td>
                                                <td>{{ $error['email'] }}</td>

                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                @endif
                @if (session('pincode_err') && is_array(session('pincode_err')))
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pincode Length Invalid</h4>
                                {{-- <p class="card-title-desc">The Buttons extension for DataTables
                        provides a common set of options, API methods and styling to display
                        buttons on a page that will interact with a DataTable. The core library
                        provides the based framework upon which plug-ins can built.
                    </p> --}}
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons3" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            {{-- <th>User ID</th> --}}
                                            {{-- <th>Position</th> --}}
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Pincode</th>
                                            {{-- <th>Info</th> --}}


                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach (session('pincode_err') as $error)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                {{-- <td>{{ $error['user_id'] }}</td> --}}
                                                {{-- <td>{{ $error['position'] }}</td> --}}
                                                <td>{{ $error['first_name'] }}</td>
                                                <td>{{ $error['last_name'] }}</td>
                                                <td>{{ $error['mobile'] }}</td>
                                                <td>{{ $error['email'] }}</td>
                                                <td>{{ $error['pincode'] }}</td>
                                                {{-- <td>
                                        <a href="{{ route('user.details', ['id' => $error['user_id']]) }}" target="_blank">
                                            <img src="{{ asset('assets/images/informations.png') }}" alt="">
                                        </a> --}}
                                                {{-- <a href="javascript:void(0);" onclick="openLinkInBackground('{{ route('user.details', ['id' => $error['user_id']]) }}')">
                                            <img src="{{ asset('assets/images/informations.png') }}" alt="">
                                        </a> --}}

                                                {{-- </td> --}}
                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                @endif
                @if (session('state_district_err') && is_array(session('state_district_err')))
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pincode does not exist</h4>
                                {{-- <p class="card-title-desc">The Buttons extension for DataTables
                        provides a common set of options, API methods and styling to display
                        buttons on a page that will interact with a DataTable. The core library
                        provides the based framework upon which plug-ins can built.
                    </p> --}}
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons4" class="table table-bordered w-100">
                                    <thead>
                                        <tr>
                                            {{-- <th>User ID</th> --}}
                                            {{-- <th>Position</th> --}}
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
                                        @php $count = 1; @endphp
                                        @foreach (session('state_district_err') as $error)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                {{-- <td>{{ $error['user_id'] }}</td> --}}
                                                {{-- <td>{{ $error['position'] }}</td> --}}
                                                <td>{{ $error['first_name'] }}</td>
                                                <td>{{ $error['last_name'] }}</td>
                                                <td>{{ $error['mobile'] }}</td>
                                                <td>{{ $error['email'] }}</td>
                                                <td>{{ $error['state_name'] }}</td>
                                                <td>{{ $error['district_name'] }}</td>
                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                @endif
                @if (session('first_last_name_error') && is_array(session('first_last_name_error')))
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">First Name or Last Name Error</h4>
                                {{-- <p class="card-title-desc">The Buttons extension for DataTables
                        provides a common set of options, API methods and styling to display
                        buttons on a page that will interact with a DataTable. The core library
                        provides the based framework upon which plug-ins can built.
                    </p> --}}
                            </div>
                            <div class="card-body">
                                <table id="datatable-buttons5" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            {{-- <th>User ID</th> --}}
                                            {{-- <th>Position</th> --}}
                                            <th>S.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>



                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach (session('first_last_name_error') as $error)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                {{-- <td>{{ $error['user_id'] }}</td> --}}
                                                {{-- <td>{{ $error['position'] }}</td> --}}
                                                <td>{{ $error['first_name'] }}</td>
                                                <td>{{ $error['last_name'] }}</td>
                                                <td>{{ $error['mobile'] }}</td>
                                                <td>{{ $error['email'] }}</td>

                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                @endif
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
@endsection
