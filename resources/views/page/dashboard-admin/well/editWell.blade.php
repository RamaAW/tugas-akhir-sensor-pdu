@extends('layouts.admin.app')

@section('title', 'Edit Well')

@section('content')

<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('layouts.admin.nav')
            <div class="container mt-5">
                <h2>Edit Well</h2>
                <div id="error-messages" class="alert alert-danger" style="display: none;"></div>
                <form id="editWellForm">
                    <input type="hidden" id="wellId" name="id">
                    <div class="form-group">
                        <label for="wellName">Name</label>
                        <input type="text" class="form-control" id="wellName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Well Address</label>
                        <input type="text" class="form-control" id="wellAddress" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="placeSelect">Choose Place</label>
                        <select class="form-control" id="wellPlace" name="placeId" required>
                            <option value="">Select Place</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wellLatitude">Well Latitude</label>
                        <input type="text" class="form-control" id="wellLatitude" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="wellLongitude">Well Longitude</label>
                        <input type="text" class="form-control" id="wellLongitude" name="longitude" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Well</button>
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
    <!-- Custom JS for well management -->
    <script src="{{ asset('assets/js/admin/well/editWell.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>
    <!-- Custom scripts for logout -->
    <script src="{{ asset('assets/js/logout.js') }}"></script>
</div>
@endsection