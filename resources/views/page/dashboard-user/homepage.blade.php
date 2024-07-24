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
            <div class="d-flex text-center p-1 pt-0" style="margin: 5px;">
                <form>
                    <div class="d-flex align-items-center">
                        <div class="me-2">
                            <input type="date" class="form-control d-inline" id="inputDate" placeholder="Input Date" style="width: 212px;">
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <label for="timeStart" class="form-label" style="font-weight: bold;">Start Time</label>
                                <input type="time" class="form-control d-inline" id="timeStart" style="width: 212px;">
                            </div>
                            <div class="me-2">
                                <label for="timeEnd" class="form-label" style="font-weight: bold;">End Time</label>
                                <input type="time" class="form-control d-inline" id="timeEnd" style="width: 212px;">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="searchButton"">Search</button>
                    </div>
                </form>
            </div>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class=" d-flex text-center p-1 pt-0">
                            <!-- Content-1 -->
                            @include('layouts.user.side-content')
                            <!-- Content-2 -->
                            <!-- Header -->
                            @include('layouts.user.chart')
                    </div>
                    <!-- End of Main Content -->
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
        <script src="{{asset('assets/js/chooseWell.js')}}"></script>
        <script src="{{asset('assets/js/logout.js')}}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </div>
    @endsection