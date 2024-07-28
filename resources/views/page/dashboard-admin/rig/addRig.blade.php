@extends('layouts.admin.app')

@section('title', 'Register Well')

@section('content')

<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('layouts.admin.nav')
            <div class="container mt-5">
                <h2>Register Rig</h2>
                <div id="error-messages" class="alert alert-danger" style="display: none;"></div>
                <form id="rigForm" method="POST">
                    <div class="form-group">
                        <label for="rigName">Rig Name</label>
                        <input type="text" class="form-control" id="rigName" name="rigName" required>
                    </div>
                    <div class="form-group">
                        <label for="rigType">Rig Type</label>
                        <input type="text" class="form-control" id="rigType" name="rigType" required>
                    </div>
                    <div class="form-group">
                        <label for="rigPower">Rig Power</label>
                        <input type="text" class="form-control" id="rigPower" name="rigPower" required>
                    </div>
                    <div class="form-group">
                        <label for="rigActivity">Rig Activity</label>
                        <input type="text" class="form-control" id="rigActivity" name="rigActivity" required>
                    </div>
                    <div class="form-group">
                        <label for="wellSelect">Choose Well</label>
                        <select class="form-control" id="wellSelect" name="wellId" required>
                            <option value="">Select Well</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Add Rig to Well</button>
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
    <script src="{{ asset('assets/js/admin/rig/addRig.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>
    <!-- Custom scripts for logout -->
    <script src="{{ asset('assets/js/logout.js') }}"></script>
</div>
@endsection