<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DOME STUDIO</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('import/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <!-- Chart.js Plugin for Zoom -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.0"></script>

    <!-- Custom styles for charts -->
    <link href="{{ asset('import/assets/css/chart-js.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@latest/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>

    <style>
        .card {
            flex: 1;
            margin: 0 5px;
            overflow: hidden;
        }

        .font-custom {
            font-size: 12px;
        }

        /* .parameter-name {
            flex: 1;
            padding-right: 10px;
        } */

        .value-unit-container {
            display: flex;
            align-items: center;
            width: 100px;
            justify-content: flex-end;
        }

        .value-box {
            width: 100px;
            background-color: #2b2b2b;
            color: white;
            border-radius: 5px;
            text-align: center;
            padding: 2px 2px;
            font-weight: bold;
        }

        .unit-text {
            width: 40px;
            margin-left: 5px;
            color: red;
            text-align: left;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="font-custom">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
            <li class="nav-item">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
                    <i class="fas fa-laugh-wink"></i>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/homepage">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                    </div>
                </a>
            </li>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="d-none d-sm-inline-block mr-auto my-2 my-md-0 mw-100">
                        <div class="d-flex">
                            <span style="font-size: 16px;">
                                <span>Company Name </span><strong id="companyDetails" style="color:red"></strong>
                            </span>
                            <div class="dropdown">
                                <span style="font-size: 16px; margin-left: 30px;">
                                    <span>Well Name </span>
                                    <a class="dropdown-toggle" id="wellName" style="color:red; font-weight:bold" data-toggle="dropdown" href="#">
                                        Select Well
                                    </a>
                                    <div class="dropdown-menu" id="wellDropdownMenu">
                                        <!-- Well options will be populated here -->
                                    </div>
                                </span>
                            </div>
                            <span style="font-size: 16px; margin-left: 30px;">
                                <span>Rig Name</span><strong id="rigName" style="color:red"></strong>
                            </span>
                            <span style="font-size: 16px; margin-left: 30px;">
                                <span>Rig Activity </span><strong id="rigActivity" style="color:red"></strong>
                            </span>
                            <span style="font-size: 16px; margin-left: 30px;">
                                <span>Date Time </span><strong id="dateTime" style="color:red"></strong>
                            </span>
                        </div>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="{{ asset('import/assets/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- Logout Modal -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to log out?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary logout-btn">Logout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="d-flex text-center p-1 pt-0">

                    <!-- Content-1 -->
                    <div class="col-2 p-0" style="width: 15%;">
                        <div class="card">
                            <div class="card-body ps-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Bit Depth</span>
                                    <div class="value-unit-container">
                                        <span id="bitDepth" class="value-box">0</span>
                                        <span class="unit-text">m</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Air Rate</span>
                                    <div class="value-unit-container">
                                        <span id="scfm" class="value-box">0</span>
                                        <span class="unit-text">scfm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">MudCondIn</span>
                                    <div class="value-unit-container">
                                        <span id="mudCondIn" class="value-box">0</span>
                                        <span class="unit-text">m</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">BlockPos</span>
                                    <div class="value-unit-container">
                                        <span id="blockPos" class="value-box">0</span>
                                        <span class="unit-text">m</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">WOB</span>
                                    <div class="value-unit-container">
                                        <span id="wob" class="value-box">0</span>
                                        <span class="unit-text">klb</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">ROP</span>
                                    <div class="value-unit-container">
                                        <span id="rop" class="value-box">0</span>
                                        <span class="unit-text">m/hr</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">BV Depth</span>
                                    <div class="value-unit-container">
                                        <span id="bvDepth" class="value-box">0</span>
                                        <span class="unit-text">m</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">MudCondOut</span>
                                    <div class="value-unit-container">
                                        <span id="mudCondOut" class="value-box">0</span>
                                        <span class="unit-text">mmho</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Torque</span>
                                    <div class="value-unit-container">
                                        <span id="torque" class="value-box">0</span>
                                        <span class="unit-text">klbft</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">RPM</span>
                                    <div class="value-unit-container">
                                        <span id="rpm" class="value-box">0</span>
                                        <span class="unit-text">rpm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Hookload</span>
                                    <div class="value-unit-container">
                                        <span id="hkld" class="value-box">0</span>
                                        <span class="unit-text">klb</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Log Depth</span>
                                    <div class="value-unit-container">
                                        <span id="logDepth" class="value-box">0</span>
                                        <span class="unit-text">m</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">H2S-1</span>
                                    <div class="value-unit-container">
                                        <span id="h2s1" class="value-box">0</span>
                                        <span class="unit-text">ppm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">MudFlowOut</span>
                                    <div class="value-unit-container">
                                        <span id="mudFlowOutp" class="value-box">0</span>
                                        <span class="unit-text">gpm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Total SPM</span>
                                    <div class="value-unit-container">
                                        <span id="totSPM" class="value-box">0</span>
                                        <span class="unit-text">spm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Standpipe Press</span>
                                    <div class="value-unit-container">
                                        <span id="spPress" class="value-box">0</span>
                                        <span class="unit-text">psi</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">MudFlowIn</span>
                                    <div class="value-unit-container">
                                        <span id="mudFlowIn" class="value-box">0</span>
                                        <span class="unit-text">spm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">CO2-1</span>
                                    <div class="value-unit-container">
                                        <span id="co21" class="value-box">0</span>
                                        <span class="unit-text">spm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Gas</span>
                                    <div class="value-unit-container">
                                        <span id="gas" class="value-box">0</span>
                                        <span class="unit-text">spm</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">MudTempIn</span>
                                    <div class="value-unit-container">
                                        <span id="mudTempIn" class="value-box">0</span>
                                        <span class="unit-text">℃</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">MudTempOut</span>
                                    <div class="value-unit-container">
                                        <span id="mudTempOut" class="value-box">0</span>
                                        <span class="unit-text">℃</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-start">Tank Vol.</span>
                                    <div class="value-unit-container">
                                        <span id="tankVolTot" class="value-box">0</span>
                                        <span class="unit-text">sbbl</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content-2 -->
                    <div class="col p-0">
                        <!-- Header -->
                        <div class="row g-0">
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div style="position: relative;" class="chart-container">
                                        <canvas id="myChart"></canvas>
                                        <div class="chart-header">
                                            <div class="header-item">
                                                Air Rate (sfcm)
                                                <span class="scfm header-number">0</span>
                                                <div class="header-line blue"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center"></span>
                                                    <span>2000</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Mud Conduct In
                                                <span class="mudCondIn header-number">0</span>
                                                <div class="header-line bright-green"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">m m h o</span>
                                                    <span>10000</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Block Position
                                                <span class="blockPos header-number">0</span>
                                                <div class="header-line pink"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">m</span>
                                                    <span>150</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                WOB
                                                <span class="wob header-number">0</span>
                                                <div class="header-line red"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">klb</span>
                                                    <span>50</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                ROP
                                                <span class="rop header-number">0</span>
                                                <div class="header-line bright-blue"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">m/hr</span>
                                                    <span>500</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div style="position: relative;" class="chart-container">
                                        <canvas id="myChart2"></canvas>
                                        <div class="chart-header">
                                            <div class="header-item">
                                                Mud Conduct. Out
                                                <span class="mudCondOut header-number">0</span>
                                                <div class="header-line blue"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">m m h o</span>
                                                    <span>40000</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Torque
                                                <span class="torque header-number">0</span>
                                                <div class="header-line bright-green"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">klb.ft</span>
                                                    <span>30</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                RPM (total)
                                                <span class="rpm header-number">0</span>
                                                <div class="header-line pink"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center"></span>
                                                    <span>200</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Hookload
                                                <span class="hkld header-number">0</span>
                                                <div class="header-line bright-blue"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">klb</span>
                                                    <span>300</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart2" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div style="position: relative;" class="chart-container">
                                        <canvas id="myChart3"></canvas>
                                        <div class="chart-header">
                                            <div class="header-item">
                                                H2S-1
                                                <span class="h2s1 header-number">0</span>
                                                <div class="header-line blue"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">ppm</span>
                                                    <span>50</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Mud Flow Out (%)
                                                <span class="mudFlowOutp header-number">0</span>
                                                <div class="header-line bright-green"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center"></span>
                                                    <span>100</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Total SPM
                                                <span class="totSPM header-number">0</span>
                                                <div class="header-line pink"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center"></span>
                                                    <span>300</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Standpipe Press.
                                                <span class="spPress header-number">0</span>
                                                <div class="header-line bright-blue"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">psi</span>
                                                    <span>3000</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Mud Flow In
                                                <span class="mudFlowIn header-number">0</span>
                                                <div class="header-line red"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">gpm</span>
                                                    <span>1500</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart3" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div style="position: relative;" class="chart-container">
                                        <canvas id="myChart4"></canvas>
                                        <div class="chart-header">
                                            <div class="header-item">
                                                CO2-1
                                                <span class="co21 header-number">0</span>
                                                <div class="header-line bright-red"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">%</span>
                                                    <span>100</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Gas
                                                <span class="gas header-number">0</span>
                                                <div class="header-line bright-green"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">%</span>
                                                    <span>100</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Mud Temperature In
                                                <span class="mudTempIn header-number">0</span>
                                                <div class="header-line pink"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">°C</span>
                                                    <span>200</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Mud Temperature Out
                                                <span class="mudTempOut header-number">0</span>
                                                <div class="header-line bright-blue"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">°C</span>
                                                    <span>200</span>
                                                </div>
                                            </div>
                                            <div class="header-item">
                                                Tank Vol.(total)
                                                <span class="tankVolTot header-number">0</span>
                                                <div class="header-line red"></div>
                                                <div class="header-scale">
                                                    <span>0</span>
                                                    <span class="header-center">b b l</span>
                                                    <span>2000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart4" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons mt-3">
                            <button onclick="scrollUp()">Scroll Up</button>
                            <button onclick="scrollDown()">Scroll Down</button>
                            <button onclick="zoomIn()">Zoom In</button>
                            <button onclick="zoomOut()">Zoom Out</button>
                        </div>
                        <footer>
                            <script>
                                function updateDateTime() {
                                    var dateTimeElement = document.getElementById('dateTime');
                                    var now = new Date();
                                    var options = {
                                        year: 'numeric',
                                        month: '2-digit',
                                        day: '2-digit',
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit',
                                        hour12: false
                                    }
                                    var formattedDateTime = now.toLocaleString('en-GB', options); // Adjust format as needed
                                    dateTimeElement.textContent = formattedDateTime;
                                }
                                // Update the date and time every second
                                setInterval(updateDateTime, 1000);
                                // Initial call to display the date and time immediately when the page loads
                                updateDateTime();

                                // Data untuk myChart (stackedChart)
                                var stackedData = {
                                    labels: [],
                                    datasets: [{
                                            label: 'Air Rate',
                                            data: [],
                                            borderColor: 'rgb(0, 0, 255)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Mud Conduct In',
                                            data: [],
                                            borderColor: 'rgb(50, 205, 50)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Block Position',
                                            data: [],
                                            borderColor: 'rgb(255, 0, 140)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'WOB',
                                            data: [],
                                            borderColor: 'rgb(164, 0, 0)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'ROP',
                                            data: [],
                                            borderColor: 'rgb(0, 191, 255)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        }
                                    ]
                                };

                                // Data untuk myChart2 (stackedChart2)
                                var stackedData2 = {
                                    labels: [],
                                    datasets: [{
                                            label: 'Mud Conduct Out',
                                            data: [],
                                            borderColor: 'rgb(0, 0, 255)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Torque',
                                            data: [],
                                            borderColor: 'rgb(50, 205, 50)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'RPM Total',
                                            data: [],
                                            borderColor: 'rgb(255, 0, 140)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Hookload',
                                            data: [],
                                            borderColor: 'rgb(0, 191, 255)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        }
                                    ]
                                };

                                // Data untuk myChart3 (stackedChart3)
                                var stackedData3 = {
                                    labels: [],
                                    datasets: [{
                                            label: 'H2S-1',
                                            data: [],
                                            borderColor: 'rgb(0, 0, 255)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Mud Flow Out(%)',
                                            data: [],
                                            borderColor: 'rgb(50, 205, 50)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Total SPM',
                                            data: [],
                                            borderColor: 'rgb(255, 0, 140)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Standpipe Press',
                                            data: [],
                                            borderColor: 'rgb(0, 191, 255)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Mud Flow In',
                                            data: [],
                                            borderColor: 'rgb(164, 0, 0)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        }
                                    ]
                                };

                                // Data untuk myChart4 (stackedChart4)
                                var stackedData4 = {
                                    labels: [],
                                    datasets: [{
                                            label: 'CO2-1',
                                            data: [],
                                            borderColor: 'rgb(255, 35, 35)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Gas',
                                            data: [],
                                            borderColor: 'rgb(50, 205, 50)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Mud Temp In',
                                            data: [],
                                            borderColor: 'rgb(255, 0, 140)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Mud Temp Out',
                                            data: [],
                                            borderColor: 'rgb(0, 191, 255)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        },
                                        {
                                            label: 'Tank Vol. (total)',
                                            data: [],
                                            borderColor: 'rgb(164, 0, 0)',
                                            lineTension: 0,
                                            borderWidth: 1.5,
                                            pointRadius: 2
                                        }
                                    ]
                                };


                                var stackedConfig = {
                                    type: 'line',
                                    data: stackedData,
                                    options: {
                                        indexAxis: 'y',
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true
                                            },
                                            y: {
                                                stacked: true,
                                                display: true,

                                                min: 0,
                                                max: 100
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                            },
                                            grid: {
                                                borderColor: 'rgba(0, 0, 0, 0.1)',
                                                borderWidth: 1,
                                            },
                                            tooltip: {
                                                mode: 'index',
                                                intersect: true,
                                            },
                                            zoom: {
                                                wheel: {
                                                    enabled: true,
                                                },
                                                drag: {
                                                    enabled: true,
                                                },
                                                pinch: {
                                                    enabled: true,
                                                },
                                                mode: 'x',
                                            }
                                        },
                                    }
                                };

                                var stackedConfig2 = {
                                    type: 'line',
                                    data: stackedData2,
                                    options: {
                                        indexAxis: 'y',
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true
                                            },
                                            y: {
                                                stacked: true,
                                                display: true,
                                                ticks: {
                                                    stepSize: 10
                                                },
                                                min: 0,
                                                max: 100
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                            },
                                            grid: {
                                                borderColor: 'rgba(0, 0, 0, 0.1)',
                                                borderWidth: 1,
                                            },
                                            tooltip: {
                                                mode: 'index',
                                                intersect: true,
                                            },
                                            zoom: {
                                                wheel: {
                                                    enabled: true,
                                                },
                                                drag: {
                                                    enabled: true,
                                                },
                                                pinch: {
                                                    enabled: true,
                                                },
                                                mode: 'x',
                                            }
                                        },
                                    }
                                };

                                var stackedConfig3 = {
                                    type: 'line',
                                    data: stackedData3,
                                    options: {
                                        indexAxis: 'y',
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true
                                            },
                                            y: {
                                                stacked: true,
                                                display: true,
                                                ticks: {
                                                    stepSize: 10
                                                },
                                                min: 0,
                                                max: 100
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                            },
                                            grid: {
                                                borderColor: 'rgba(0, 0, 0, 0.1)',
                                                borderWidth: 1,
                                            },
                                            tooltip: {
                                                mode: 'index',
                                                intersect: true,
                                            },
                                            zoom: {
                                                wheel: {
                                                    enabled: true,
                                                },
                                                drag: {
                                                    enabled: true,
                                                },
                                                pinch: {
                                                    enabled: true,
                                                },
                                                mode: 'x',
                                            }
                                        },
                                    }
                                };

                                var stackedConfig4 = {
                                    type: 'line',
                                    data: stackedData4,
                                    options: {
                                        indexAxis: 'y',
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true
                                            },
                                            y: {
                                                stacked: true,
                                                display: true,
                                                ticks: {
                                                    stepSize: 10
                                                },
                                                min: 0,
                                                max: 100
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                            },
                                            grid: {
                                                borderColor: 'rgba(0, 0, 0, 0.1)',
                                                borderWidth: 1,
                                            },
                                            tooltip: {
                                                mode: 'index',
                                                intersect: true,
                                            },
                                            zoom: {
                                                wheel: {
                                                    enabled: true,
                                                },
                                                drag: {
                                                    enabled: true,
                                                },
                                                pinch: {
                                                    enabled: true,
                                                },
                                                mode: 'x',
                                            }
                                        },
                                    }
                                };

                                var myChart = new Chart(
                                    document.getElementById('stackedChart'),
                                    stackedConfig
                                );

                                var myChart2 = new Chart(
                                    document.getElementById('stackedChart2'),
                                    stackedConfig2
                                );

                                var myChart3 = new Chart(
                                    document.getElementById('stackedChart3'),
                                    stackedConfig3
                                );

                                var myChart4 = new Chart(
                                    document.getElementById('stackedChart4'),
                                    stackedConfig4
                                );

                                allCharts = [myChart, myChart2, myChart3, myChart4];

                                function zoomIn() {
                                    allCharts.forEach(chart => {
                                        chart.zoom(1.1);
                                    })
                                }

                                function zoomOut() {
                                    allCharts.forEach(chart => {
                                        chart.zoom(0.9);
                                    })
                                }
                            </script>
                        </footer>
                    </div>
                </div>

                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
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
        <script type="module" src="{{asset('assets/js/record.js')}}"></script>
        <script src="{{asset('assets/js/chooseWell.js')}}"></script>
        <script src="{{asset('assets/js/logout.js')}}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>


<!-- INSIDE THE BOX -->
<!-- <div class="row border p-1 mb-1 align-items-center">
                                    <div class="col-6 text-start ps-0">Mud Cond In</div>
                                    <div class="col-6 d-flex justify-content-between align-items-center">
                                        <span class="value-box">2.5<span class="unit-text">scfm</span></span>
                                    </div>
                                </div>
                                <div class="row border p-1 mb-1 align-items-center">
                                    <div class="col-6 text-start ps-0">Block Pos</div>
                                    <div class="col-6 d-flex justify-content-between align-items-center">
                                        <span class="value-box">10<span class="unit-text">m</span></span>
                                    </div>
                                </div>
                                 -->

<!-- // window.setInterval(mycallback, 5000); -->

<!-- // function mycallback() {
// var now = new Date();
// now = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

// // Generate random data for myChart (stackedChart)
// var airRateValue = Math.floor(Math.random() * 10);
// var mudConductInValue = Math.floor(Math.random() * 10);
// var blockPositionValue = Math.floor(Math.random() * 10);
// var wobValue = Math.floor(Math.random() * 10);
// var ropValue = Math.floor(Math.random() * 10);

// // Update data and labels for myChart (stackedChart)
// stackedData.labels.push(now);
// stackedData.datasets[0].data.push(airRateValue);
// stackedData.datasets[1].data.push(mudConductInValue);
// stackedData.datasets[2].data.push(blockPositionValue);
// stackedData.datasets[3].data.push(wobValue);
// stackedData.datasets[4].data.push(ropValue);

// // Generate random data for myChart2 (stackedChart2)
// var mudConductOutValue = Math.floor(Math.random() * 10);
// var torqueValue = Math.floor(Math.random() * 10);
// var rpmTotalValue = Math.floor(Math.random() * 10);
// var hookloadValue = Math.floor(Math.random() * 10);

// // Update data and labels for myChart2 (stackedChart2)
// stackedData2.labels.push(now);
// stackedData2.datasets[0].data.push(mudConductOutValue);
// stackedData2.datasets[1].data.push(torqueValue);
// stackedData2.datasets[2].data.push(rpmTotalValue);
// stackedData2.datasets[3].data.push(hookloadValue);

// // Generate random data for myChart3 (stackedChart3)
// var h2s1Value = Math.floor(Math.random() * 10);
// var mudFlowOutValue = Math.floor(Math.random() * 10);
// var totalSPMValue = Math.floor(Math.random() * 10);
// var standpipePressValue = Math.floor(Math.random() * 10);
// var mudFlowInValue = Math.floor(Math.random() * 10);

// // Update data and labels for myChart3 (stackedChart3)
// stackedData3.labels.push(now);
// stackedData3.datasets[0].data.push(h2s1Value);
// stackedData3.datasets[1].data.push(mudFlowOutValue);
// stackedData3.datasets[2].data.push(totalSPMValue);
// stackedData3.datasets[3].data.push(standpipePressValue);
// stackedData3.datasets[4].data.push(mudFlowInValue);

// // Generate random data for myChart4 (stackedChart4)
// var co2_1Value = Math.floor(Math.random() * 10);
// var gasValue = Math.floor(Math.random() * 10);
// var mudTempInValue = Math.floor(Math.random() * 10);
// var mudTempOutValue = Math.floor(Math.random() * 10);
// var tankVolValue = Math.floor(Math.random() * 10);

// // Update data and labels for myChart4 (stackedChart4)
// stackedData4.labels.push(now);
// stackedData4.datasets[0].data.push(co2_1Value);
// stackedData4.datasets[1].data.push(gasValue);
// stackedData4.datasets[2].data.push(mudTempInValue);
// stackedData4.datasets[3].data.push(mudTempOutValue);
// stackedData4.datasets[4].data.push(tankVolValue);

// var maxDataPoints = 5;
// if (stackedData.labels.length > maxDataPoints) {
// stackedData.labels.shift();
// stackedData.datasets.forEach(dataset => {
// dataset.data.shift();
// });
// }
// if (stackedData2.labels.length > maxDataPoints) {
// stackedData2.labels.shift();
// stackedData2.datasets.forEach(dataset => {
// dataset.data.shift();
// });
// }
// if (stackedData3.labels.length > maxDataPoints) {
// stackedData3.labels.shift();
// stackedData3.datasets.forEach(dataset => {
// dataset.data.shift();
// });
// }
// if (stackedData4.labels.length > maxDataPoints) {
// stackedData4.labels.shift();
// stackedData4.datasets.forEach(dataset => {
// dataset.data.shift();
// });
// }

// // Update all charts
// myChart.update();
// myChart2.update();
// myChart3.update();
// myChart4.update();
// } -->