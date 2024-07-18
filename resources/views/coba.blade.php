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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.0"></script>
    <style>
        .card {
            flex: 1;
            margin: 0 5px;
        }

        .font-custom {
            font-size: 11px;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="font-custom">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
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
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="d-flex text-center p-1 pt-0">
                    <div class="card mb-3">
                        <div style="position: relative;" class="chart-container">
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
                        <div class="col-12 mx-auto">
                            <canvas id="stackedChart" style="height: 700px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button onclick="scrollUp()">Scroll Up</button>
                    <button onclick="zoomIn()">Zoom In</button>
                    <button onclick="zoomOut()">Zoom Out</button>
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
                                        display: true,
                                        ticks: {
                                            stepSize: 10
                                        },
                                        min: 'auto',
                                        max: 'auto'
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false,
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
                                        pan: {
                                            enabled: true,
                                            mode: 'x',
                                        },
                                        zoom: {
                                            enabled: true,
                                            mode: 'x',
                                        }
                                    }
                                },
                            }
                        };

                        var myChart = new Chart(
                            document.getElementById('stackedChart'),
                            stackedConfig
                        );

                        window.setInterval(mycallback, 5000);

                        function scrollUp() {
                            var yAxis = myChart.options.scales.y;
                            yAxis.min -= 10; // Adjust the value as needed
                            yAxis.max -= 10; // Adjust the value as needed
                            myChart.update();
                        }

                        function zoomIn() {
                            myChart.zoom(1.1); // Adjust the value as needed
                        }

                        function zoomOut() {
                            myChart.zoom(0.9); // Adjust the value as needed
                        }

                        function mycallback() {
                            var now = new Date();
                            now = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
                            var mudValue = Math.floor(Math.random() * 10);
                            var gasValue = Math.floor(Math.random() * 10);
                            var torqValue = Math.floor(Math.random() * 10);
                            var blockPositionValue = Math.floor(Math.random() * 10);

                            stackedData.labels.push(now);
                            stackedData.datasets[0].data.push(mudValue);
                            stackedData.datasets[1].data.push(gasValue);
                            stackedData.datasets[2].data.push(torqValue);
                            stackedData.datasets[3].data.push(blockPositionValue);

                            var maxDataPoints = 20;
                            if (stackedData.labels.length > maxDataPoints) {
                                stackedConfig.options.scales.y.min = stackedData.labels[stackedData.labels.length - maxDataPoints];
                                stackedConfig.options.scales.y.max = stackedData.labels[stackedData.labels.length - 1];
                            }

                            myChart.update();
                        }
                    </script>
                </footer>
                <!-- /.container-fluid -->

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
        <script src="{{asset('assets/js/record.js')}}"></script>

</body>

</html>