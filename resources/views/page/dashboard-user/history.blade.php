@extends('layouts.user.app')

@section('title', 'History of Well')

@section('content')

<div id="wrapper" class="font-custom">
    @include('layouts.user.sidebar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            @include('layouts.user.nav')

            <!-- Search Form -->
            <div class="d-flex flex-column flex-md-row align-items-center p-1 pt-0" style="margin: 5px;">
                <form>
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <div class="me-2 mt-2">
                            <label for="inputDate" class="form-label mb-0" style="font-weight: bold;">Date</label>
                            <input type="date" class="form-control d-inline" id="inputDate" placeholder="Input Date">
                        </div>
                        <div class="me-2 mt-2">
                            <label for="timeStart" class="form-label mb-0" style="font-weight: bold;">Start Time</label>
                            <input type="time" class="form-control d-inline" id="timeStart">
                        </div>
                        <div class="me-2 mt-2">
                            <label for="timeEnd" class="form-label mb-0" style="font-weight: bold;">End Time</label>
                            <input type="time" class="form-control d-inline" id="timeEnd">
                        </div>
                        <button type="button" class="btn btn-primary mt-4" id="searchButton">Search</button>
                    </div>
                </form>
                <button type="button" class="btn btn-success mt-4 ms-2" id="downloadCsvButton">Download CSV</button>
            </div>

            <!-- Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Content-1 -->
                    <div class="col-lg-2 col-md-3 col-sm-12 p-1 pt-0">
                        @include('layouts.user.side-content')
                    </div>

                    <!-- Content-2 -->
                    <div class="col-lg-10 col-md-9 col-sm-12 p-1 pt-0">
                        @include('layouts.user.chart')
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('import/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('import/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('import/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('import/assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('import/assets/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('import/assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('import/assets/js/demo/chart-pie-demo.js')}}"></script>
    <script type="module" src="{{asset('assets/js/history-data.js')}}"></script>
    <script src="{{asset('assets/js/userDetails.js')}}"></script>
    <script src="{{asset('assets/js/chooseWell.js')}}"></script>
    <script src="{{asset('assets/js/logout.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</div>
@endsection