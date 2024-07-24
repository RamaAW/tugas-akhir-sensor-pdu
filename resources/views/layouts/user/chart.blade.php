<div class="col p-0">
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
                        borderWidth: 1,
                        pointRadius: 1
                    },
                    {
                        label: 'Mud Conduct In',
                        data: [],
                        borderColor: 'rgb(50, 205, 50)',
                        lineTension: 0,
                        borderWidth: 1,
                        pointRadius: 1
                    },
                    {
                        label: 'Block Position',
                        data: [],
                        borderColor: 'rgb(255, 0, 140)',
                        lineTension: 0,
                        borderWidth: 1,
                        pointRadius: 1
                    },
                    {
                        label: 'WOB',
                        data: [],
                        borderColor: 'rgb(164, 0, 0)',
                        lineTension: 0,
                        borderWidth: 1,
                        pointRadius: 1
                    },
                    {
                        label: 'ROP',
                        data: [],
                        borderColor: 'rgb(0, 191, 255)',
                        lineTension: 0,
                        borderWidth: 1,
                        pointRadius: 1
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