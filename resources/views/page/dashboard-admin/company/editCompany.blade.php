@extends('layouts.admin.app')

@section('title', 'Edit Company')

@section('content')

<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('layouts.admin.nav')
            <div class="container mt-5">
                <h2>Edit Company</h2>
                <form id="editCompanyForm">
                    <input type="hidden" id="companyId" name="id">
                    <div class="form-group">
                        <label for="companyName">Name</label>
                        <input type="text" class="form-control" id="companyName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="companyAddress">Address</label>
                        <input type="text" class="form-control" id="companyAddress" name="address" required>
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
    <!-- Custom JS for company management -->
    <script src="{{ asset('assets/js/admin/company/editCompany.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>
    <!-- Custom scripts for logout -->
    <script src="{{ asset('assets/js/logout.js') }}"></script>
</div>
@endsection