$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    var selectedCompanyId = localStorage.getItem("selectedCompanyId");
    var selectedWellId = localStorage.getItem("selectedWellId");
    let updateInterval;
    console.log("au:", authToken);
    console.log("comp:", selectedCompanyId);
    console.log("well:", selectedWellId);
    if (!selectedCompanyId || !selectedWellId) {
        window.location.href = "/chooseCompany-Well";
    } else {
        // Function to fetch companies
        function fetchCompaniesDetails(companyId) {
            $.ajax({
                url: "http://project-akhir.test/api/company/" + companyId,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#companyDetails").html(data.name);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }

        function fetchWellDetails(wellId) {
            $.ajax({
                url: "http://project-akhir.test/api/well/" + wellId,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#wellDetails").html(data.name);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }

        function updateUI(data) {
            if (Array.isArray(data) && data.length > 0) {
                const latestData = data[data.length - 1];
                $("#bitDepth, .bitDepth").text(latestData.BitDepth);
                $("#scfm, .scfm").text(latestData.Scfm);
                $("#mudCondIn, .mudCondIn").text(latestData.MudCondIn);
                $("#blockPos, .blockPos").text(latestData.BlockPos);
                $("#wob, .wob").text(latestData.WOB);
                $("#rop, .rop").text(latestData.ROPi);
                $("#bvDepth, .bvDepth").text(latestData.BVDepth);
                $("#mudCondOut, .mudCondOut").text(latestData.MudCondOut);
                $("#torque, .torque").text(latestData.Torque);
                $("#rpm, .rpm").text(latestData.RPM);
                $("#hkld, .hkld").text(latestData.Hkld);
                $("#logDepth, .logDepth").text(latestData.LogDepth);
                $("#h2s1, .h2s1").text(latestData.H2S_1);
                $("#mudFlowOutp, .mudFlowOutp").text(latestData.MudFlowOutp);
                $("#totSPM, .totSPM").text(latestData.TotSPM);
                $("#spPress, .spPress").text(latestData.SpPress);
                $("#mudFlowIn, .mudFlowIn").text(latestData.MudFlowIn);
                $("#co21, .co21").text(latestData.CO2_1);
                $("#gas, .gas").text(latestData.Gas);
                $("#mudTempIn, .mudTempIn").text(latestData.MudTempIn);
                $("#mudTempOut, .mudTempOut").text(latestData.MudTempOut);
                $("#tankVolTot, .tankVolTot").text(latestData.TankVolTot);

                $("#wellDetails").text(latestData.WellId);

                updateCharts(data);
            }
        }

        function updateCharts(data) {
            var maxDataPoints = 30;
            var times = data.map((item) => {
                var parts = item["Date-Time"].split(" ");
                var timePart = parts[1];
                return timePart;
            });

            // Update untuk myChart (stackedChart)
            stackedData.labels = times;
            stackedData.datasets[0].data = data.map((item) =>
                parseFloat(item.Scfm)
            );
            stackedData.datasets[1].data = data.map((item) =>
                parseFloat(item.MudCondIn)
            );
            stackedData.datasets[2].data = data.map((item) =>
                parseFloat(item.BlockPos)
            );
            stackedData.datasets[3].data = data.map((item) =>
                parseFloat(item.WOB)
            );
            stackedData.datasets[4].data = data.map((item) =>
                parseFloat(item.ROPi)
            );
            if (stackedData.labels.length > maxDataPoints) {
                stackedData.labels = stackedData.labels.slice(-maxDataPoints);
                stackedData.datasets.forEach((dataset) => {
                    dataset.data = dataset.data.slice(-maxDataPoints);
                });
            }
            myChart.update();

            // Update untuk myChart2 (stackedChart2)
            stackedData2.labels = times;
            stackedData2.datasets[0].data = data.map((item) =>
                parseFloat(item.MudCondOut)
            );
            stackedData2.datasets[1].data = data.map((item) =>
                parseFloat(item.Torque)
            );
            stackedData2.datasets[2].data = data.map((item) =>
                parseFloat(item.RPM)
            );
            stackedData2.datasets[3].data = data.map((item) =>
                parseFloat(item.Hkld)
            );
            if (stackedData2.labels.length > maxDataPoints) {
                stackedData2.labels = stackedData2.labels.slice(-maxDataPoints);
                stackedData2.datasets.forEach((dataset) => {
                    dataset.data = dataset.data.slice(-maxDataPoints);
                });
            }
            myChart2.update();

            // Update untuk myChart3 (stackedChart3)
            stackedData3.labels = times;
            stackedData3.datasets[0].data = data.map((item) =>
                parseFloat(item.H2S_1)
            );
            stackedData3.datasets[1].data = data.map((item) =>
                parseFloat(item.MudFlowOutp)
            );
            stackedData3.datasets[2].data = data.map((item) =>
                parseFloat(item.TotSPM)
            );
            stackedData3.datasets[3].data = data.map((item) =>
                parseFloat(item.SpPress)
            );
            stackedData3.datasets[4].data = data.map((item) =>
                parseFloat(item.MudFlowIn)
            );
            if (stackedData3.labels.length > maxDataPoints) {
                stackedData3.labels = stackedData3.labels.slice(-maxDataPoints);
                stackedData3.datasets.forEach((dataset) => {
                    dataset.data = dataset.data.slice(-maxDataPoints);
                });
            }
            myChart3.update();

            // Update untuk myChart4 (stackedChart4)
            stackedData4.labels = times;
            stackedData4.datasets[0].data = data.map((item) =>
                parseFloat(item.CO2_1)
            );
            stackedData4.datasets[1].data = data.map((item) =>
                parseFloat(item.Gas)
            );
            stackedData4.datasets[2].data = data.map((item) =>
                parseFloat(item.MudTempIn)
            );
            stackedData4.datasets[3].data = data.map((item) =>
                parseFloat(item.MudTempOut)
            );
            stackedData4.datasets[4].data = data.map((item) =>
                parseFloat(item.TankVolTot)
            );
            if (stackedData4.labels.length > maxDataPoints) {
                stackedData4.labels = stackedData4.labels.slice(-maxDataPoints);
                stackedData4.datasets.forEach((dataset) => {
                    dataset.data = dataset.data.slice(-maxDataPoints);
                });
            }
            myChart4.update();
        }

        function fetchInitialData(wellId) {
            $.ajax({
                url: `http://project-akhir.test/api/records/well/${wellId}`,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    updateUI(data);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching initial data:", error);
                    alert(
                        "Failed to fetch initial data. Please try again later."
                    );
                },
            });
        }
        fetchCompaniesDetails(selectedCompanyId);
        fetchWellDetails(selectedWellId);
        fetchInitialData(selectedWellId);

        const socket = new WebSocket(
            `ws://project-akhir.test:6001/app/61d055de2a7a9f7b1f0d`
        );

        socket.onopen = function (e) {
            console.log("WebSocket connection established");
            socket.send(
                JSON.stringify({
                    event: "pusher:subscribe",
                    data: { channel: `well.${selectedWellId}` },
                })
            );
        };

        socket.onmessage = function (event) {
            const response = JSON.parse(event.data);
            if (response.event === "WellDataUpdated") {
                const wellData = JSON.parse(response.data);
                updateUI(wellData);
            }
        };

        socket.onerror = function (error) {
            console.error(`WebSocket Error: ${error}`);
        };

        socket.onclose = function (event) {
            if (event.wasClean) {
                console.log(
                    `WebSocket connection closed cleanly, code=${event.code}, reason=${event.reason}`
                );
            } else {
                console.error("WebSocket connection died");
            }
        };
    }
});
