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
    <link href="{{asset('import/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('import/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link href="{{asset('import/assets/css/chart-js.css')}}" rel="stylesheet">
    <style>
        .container {
            display: flex;
        }

        .card {
            flex: 1;
            margin: 0 10px;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->

                        <!-- Dropdown - Messages -->

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->

                        <!-- Counter - Messages -->

                        <!-- Dropdown - Messages -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="{{asset('import/assets/img/undraw_profile.svg')}}">
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

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div style="position: relative;">
                                    <canvas id="myChart"></canvas>
                                    <div class="chart-header">
                                        <div class="header-item mud-label">Mud</div>
                                        <div class="header-line mud-label"></div>
                                        <div class="header-item gas-label">Gas</div>
                                        <div class="header-line gas-label"></div>
                                        <div class="header-item torq-label">TORQ</div>
                                        <div class="header-line torq-label"></div>
                                        <div class="header-item block-position-label">Block Position</div>
                                        <div class="header-line block-position-label"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div style="position: relative;">
                                    <canvas id="myChart2"></canvas>
                                    <div class="chart-header">
                                        <div class="header-item mud-label">Mud</div>
                                        <div class="header-line mud-label"></div>
                                        <div class="header-item gas-label">Gas</div>
                                        <div class="header-line gas-label"></div>
                                        <div class="header-item torq-label">TORQ</div>
                                        <div class="header-line torq-label"></div>
                                        <div class="header-item block-position-label">Block Position</div>
                                        <div class="header-line block-position-label"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart2" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div style="position: relative;">
                                    <canvas id="myChart3"></canvas>
                                    <div class="chart-header">
                                        <div class="header-item mud-label">Mud</div>
                                        <div class="header-line mud-label"></div>
                                        <div class="header-item gas-label">Gas</div>
                                        <div class="header-line gas-label"></div>
                                        <div class="header-item torq-label">TORQ</div>
                                        <div class="header-line torq-label"></div>
                                        <div class="header-item block-position-label">Block Position</div>
                                        <div class="header-line block-position-label"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart3" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div style="position: relative;">
                                    <canvas id="myChart4"></canvas>
                                    <div class="chart-header">
                                        <div class="header-item mud-label">Mud</div>
                                        <div class="header-line mud-label"></div>
                                        <div class="header-item gas-label">Gas</div>
                                        <div class="header-line gas-label"></div>
                                        <div class="header-item torq-label">TORQ</div>
                                        <div class="header-line torq-label"></div>
                                        <div class="header-item block-position-label">Block Position</div>
                                        <div class="header-line block-position-label"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mx-auto">
                                        <canvas id="stackedChart4" style="height: 700px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer>
                    <script>
                        var stackedData = {
                            labels: [],
                            datasets: [{
                                    label: 'Mud',
                                    data: [],
                                    borderColor: 'rgb(189, 195, 199)',
                                    lineTension: 0,
                                    borderWidth: 1.5,
                                    pointRadius: 2
                                },
                                {
                                    label: 'Gas',
                                    data: [],
                                    borderColor: 'rgb(75, 192, 192)',
                                    lineTension: 0,
                                    borderWidth: 1.5,
                                    pointRadius: 2
                                },
                                {
                                    label: 'TORQ',
                                    data: [],
                                    borderColor: 'rgb(54, 162, 235)',
                                    lineTension: 0,
                                    borderWidth: 1.5,
                                    pointRadius: 2
                                },
                                {
                                    label: 'Block Position',
                                    data: [],
                                    borderColor: 'rgb(153, 102, 255)',
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
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false,
                                        align: 'center', // Sejajarkan legenda ke kiri
                                        labels: {
                                            boxWidth: 10, // Lebar kotak warna
                                            padding: 10 // Jarak padding antara kotak warna dan label
                                        }
                                    },
                                    grid: {
                                        borderColor: 'rgba(0, 0, 0, 0.1)',
                                        borderWidth: 1,
                                    },
                                },
                            }
                        };

                        var myChart = new Chart(
                            document.getElementById('stackedChart'),
                            stackedConfig
                        );

                        var myChart2 = new Chart(
                            document.getElementById('stackedChart2'),
                            stackedConfig
                        );

                        var myChart3 = new Chart(
                            document.getElementById('stackedChart3'),
                            stackedConfig
                        );

                        var myChart4 = new Chart(
                            document.getElementById('stackedChart4'),
                            stackedConfig
                        );

                        window.setInterval(mycallback, 10000);

                        function mycallback() {
                            var now = new Date();
                            now = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
                            var mudValue = Math.floor(Math.random() * 1000);
                            var gasValue = Math.floor(Math.random() * 1000);
                            var torqValue = Math.floor(Math.random() * 1000);
                            var blockPositionValue = Math.floor(Math.random() * 1000);

                            stackedData.labels.push(now);
                            stackedData.datasets[0].data.push(mudValue);
                            stackedData.datasets[1].data.push(gasValue);
                            stackedData.datasets[2].data.push(torqValue);
                            stackedData.datasets[3].data.push(blockPositionValue);

                            myChart.update();
                            myChart2.update();
                            myChart3.update();
                            myChart4.update();
                        }
                    </script>
                </footer>
                <!-- /.container-fluid -->

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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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

</body>

</html>