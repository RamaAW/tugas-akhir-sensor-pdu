@extends('layouts.admin.app')

@section('title', 'Edit Employee')

@section('content')

<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('layouts.admin.nav')
            <div class="container mt-5">
                <h2>Edit Employee</h2>
                <div id="error-messages" class="alert alert-danger" style="display: none;"></div>
                <form id="editEmployeeForm">
                    <input type="hidden" id="employeeId" name="id">
                    <div class="form-group">
                        <label for="employeName">Name</label>
                        <input type="text" class="form-control" id="employeeName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="employeeUsername">Username</label>
                        <input type="text" class="form-control" id="employeeUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="companySelect">Choose Company</label>
                        <select class="form-control" id="employeeCompany" name="companyId" required>
                            <option value="">Select Company</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="employeeRole" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employeePassword">Password</label>
                        <input type="password" class="form-control" id="employeePassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
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
    <script src="{{ asset('assets/js/admin/employee/editEmployee.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>
    <!-- Custom scripts for logout -->
    <script src="{{ asset('assets/js/logout.js') }}"></script>
</div>
@endsection