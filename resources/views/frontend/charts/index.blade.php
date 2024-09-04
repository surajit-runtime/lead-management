@extends('frontend.layouts.main')

@section('main-container')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container px-4 mx-auto">
                <div class="p-6 m-20 bg-white rounded shadow" style="background-color: #f3f4f6;"> <!-- Example: Tailwind's gray-100 -->
                    {!! $chart->container() !!}
                </div>
            </div>
            <script src="{{ $chart->cdn() }}"></script>
            {{ $chart->script() }}
        </div>
    </div>
@endsection
