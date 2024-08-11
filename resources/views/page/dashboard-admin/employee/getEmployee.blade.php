@extends('layouts.admin.app')

@section('title', 'List of Employee')

@section('content')

<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('layouts.admin.nav')
            <div class="container mt-5 mb-5">
                <h2 class="text-danger" style="font-family: 'Arial', sans-serif; font-weight:bold;">User</h2>
                <div id="error-messages" class="alert alert-danger" style="display: none;"></div>
                <div class="table-responsive">
                    <div class="mb-3">
                        <a href="{{ url('/admin/employee/add') }}" class="btn btn-primary">Add User</a>
                    </div>
                    <table id="employeeTable" class="table table-striped table-bordered">
                        <thead class="bg-success text-white">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="action-column">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Custom JS for employee management -->
    <script src="{{ asset('assets/js/admin/employee/getEmployee.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>
    <script src="{{asset('assets/js/userDetails.js')}}"></script>
    <!-- Custom scripts for logout -->
    <script src="{{ asset('assets/js/logout.js') }}"></script>
</div>
@endsection