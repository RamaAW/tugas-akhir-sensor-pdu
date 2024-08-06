@extends('layouts.admin.app')

@section('title', 'Register Place')

@section('content')

<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('layouts.admin.nav')
            <div class="container mt-5">
                <h2>Register Place</h2>
                <div id="error-messages" class="alert alert-danger" style="display: none;"></div>
                <form id="placeForm" method="POST">
                    <div class="form-group">
                        <label for="placeName">Place Name</label>
                        <input type="text" class="form-control" id="placeName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="placeAddress" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="companySelect">Choose Company</label>
                        <select class="form-control" id="companySelect" name="companyId" required>
                            <option value="">Select Company</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="placeLatitude">Latitude</label>
                        <input type="text" class="form-control" id="placeLatitude" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="placeLongitude">Longitude</label>
                        <input type="text" class="form-control" id="placeLongitude" name="longitude" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Add Place to Company</button>
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
    <script src="{{ asset('assets/js/admin/place/addPlace.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>
    <!-- Custom scripts for logout -->
    <script src="{{ asset('assets/js/logout.js') }}"></script>
</div>
@endsection