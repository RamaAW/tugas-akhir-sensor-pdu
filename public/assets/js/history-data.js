$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    var selectedCompanyId = localStorage.getItem("selectedCompanyId");
    var selectedWellId = localStorage.getItem("selectedWellId");
    var selectedRigId = localStorage.getItem("selectedRigId");
    console.log("au:", authToken);
    console.log("company:", selectedCompanyId);
    console.log("well:", selectedWellId);
    console.log("rig:", selectedRigId);
    if (!authToken || !selectedCompanyId || !selectedWellId || !selectedRigId) {
        window.location.href = "/chooseCompany-Well";
    } else {
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
                    $("#wellName").html(data.name);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }

        function fetchNotifications(rigId, startDateTime, endDateTime) {
            $.ajax({
                url: `http://project-akhir.test/api/notifications/?rigId=${rigId}`,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    const filteredNotifications = data.filter(
                        (notification) => {
                            const recordDateTime =
                                notification.records["Date-Time"];
                            return (
                                recordDateTime >= startDateTime &&
                                recordDateTime <= endDateTime
                            );
                        }
                    );
                    displayNotifications(filteredNotifications);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching notifications:", error);
                    alert(
                        "Failed to fetch notifications. Please try again later."
                    );
                },
            });
        }

        function displayNotifications(notifications) {
            const notificationsContainer = $("#notificationContainer");
            notificationsContainer.empty(); // Clear the notifications container

            if (notifications.length > 0) {
                notifications.forEach((notification) => {
                    const notificationHtml = `
                        <div class="text-start" style="font-weight: bold;">
                            <strong style="font-weight: bold; color:red;">${notification.title}</strong>
                            <div>${notification.message}</div>
                            <div style="font-weight: bold; color:red;">${notification.records["Date-Time"]}</div>
                            <hr class="item-divider">
                        </div>
                    `;
                    notificationsContainer.append(notificationHtml);
                });
            } else {
                notificationsContainer.html(
                    "<p>No notifications found for the selected time range.</p>"
                );
            }
        }

        function validateTimes() {
            // Ambil nilai input waktu dan tanggal
            const inputDate = document.getElementById("inputDate").value;
            const timeStart = document.getElementById("timeStart").value;
            const timeEnd = document.getElementById("timeEnd").value;

            // Periksa apakah input waktu dan tanggal diisi
            if (!inputDate || !timeStart || !timeEnd) {
                alert("Please select a date and both start time and end time.");
                return;
            }

            // Bandingkan waktu mulai dan waktu akhir
            if (timeEnd < timeStart) {
                alert("End time cannot be earlier than start time.");
            } else {
                fetchDataBetweenTimes(inputDate, timeStart, timeEnd);
                fetchNotifications(
                    selectedRigId,
                    `${inputDate} ${timeStart}`,
                    `${inputDate} ${timeEnd}`
                );
            }
        }

        // Function to display notifications

        function fetchDataBetweenTimes(date, startTime, endTime) {
            // Format datetime strings for comparison
            const startDateTime = `${date} ${startTime}`;
            const endDateTime = `${date} ${endTime}`;

            $.ajax({
                url:
                    "http://project-akhir.test/api/records/rig/" +
                    localStorage.getItem("selectedRigId"),
                method: "GET",
                dataType: "json",
                headers: {
                    Authorization:
                        "Bearer " + localStorage.getItem("authToken"),
                },
                success: function (data) {
                    const filteredData = data.filter((record) => {
                        const recordDateTime = record["Date-Time"];
                        return (
                            recordDateTime >= startDateTime &&
                            recordDateTime <= endDateTime
                        );
                    });

                    if (filteredData.length > 0) {
                        const latestData =
                            filteredData[filteredData.length - 1];
                        updateUI(latestData);
                        updateCharts(filteredData);
                    } else {
                        alert("No data found for the selected time range.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                    alert("Failed to fetch data. Please try again later.");
                },
            });
        }

        function updateUI(latestData) {
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

            $("#rigDetails").text(latestData.RigId);
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

        fetchCompaniesDetails(selectedCompanyId);
        fetchWellDetails(selectedWellId);
        $("#searchButton").click(validateTimes);
    }
});
