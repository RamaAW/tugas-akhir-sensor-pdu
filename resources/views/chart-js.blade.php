<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Chart JS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link href="{{asset('import/assets/css/chart-js.css')}}" rel="stylesheet">
</head>

<style>
    body {
        background-color: (241, 242, 246);
    }
</style>

<body>
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
                            <canvas id="stackedChart" style="height: 400px;"></canvas>
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
                            <canvas id="stackedChart2" style="height: 400px;"></canvas>
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
                            <canvas id="stackedChart3" style="height: 400px;"></canvas>
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
                            <canvas id="stackedChart4" style="height: 400px;"></canvas>
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
                    },
                    {
                        label: 'Gas',
                        data: [],
                        borderColor: 'rgb(75, 192, 192)',
                        lineTension: 0,
                    },
                    {
                        label: 'TORQ',
                        data: [],
                        borderColor: 'rgb(54, 162, 235)',
                        lineTension: 0,
                    },
                    {
                        label: 'Block Position',
                        data: [],
                        borderColor: 'rgb(153, 102, 255)',
                        lineTension: 0,
                    }
                ]
            };

            var stackedConfig = {
                type: 'line',
                data: stackedData,
                options: {
                    indexAxis: 'y',
                    maintainAspectRatio: false
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

            window.setInterval(mycallback, 2000);

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
</body>

</html>

<!-- 
            // Stacked Chart
        // function getRandomInt(min, max) {
        //     return Math.floor(Math.random() * (max - min + 1)) + min;
        // }

// const ctx = document.getElementById('myChart');

// new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         indexAxis: 'y',
//         scales: {
//             x: {
//                 beginAtZero: true
//             }
//         }
//     }
// }); -->
<!-- // var stackedChart = new Chart(document.getElementById('stackedChart'), stackedConfig); -->
<!--  -->