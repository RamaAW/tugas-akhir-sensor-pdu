$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");

    if (!authToken) {
        window.location.href = "/login";
    } else {
        function fetchWells() {
            $.ajax({
                url: "http://project-akhir.test/api/wells/",
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    var options = '<option value="">Select Well</option>';
                    data.forEach(function (well) {
                        options +=
                            '<option value="' +
                            well.id +
                            '"' +
                            (well.id == $("#rigWell").data("current-well-id")
                                ? " selected"
                                : "") +
                            ">" +
                            well.name +
                            "</option>";
                    });
                    $("#rigWell").html(options);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching wells:", error);
                    alert("Failed to fetch wells. Please try again later.");
                },
            });
        }
        fetchWells();
        // Get the company ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const rigId = urlParams.get("id");

        if (rigId) {
            // Fetch company details and populate the form
            $.ajax({
                url: `http://project-akhir.test/api/rig/${rigId}`,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#rigId").val(data.id);
                    $("#rigName").val(data.rigName);
                    $("#rigType").val(data.rigType);
                    $("#rigPower").val(data.rigPower);
                    $("#rigActivity").val(data.rigActivity);
                    $("#isActive").val(data.isActive);
                    $("#rigWell").val(data.wellId);
                },
                error: function (error) {
                    console.error("Error fetching rig details:", error);
                },
            });

            // Handle form submission
            $("#editRigForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let updatedData = Object.fromEntries(formData.entries());

                $.ajax({
                    url: `http://project-akhir.test/api/rig/${updatedData.id}`,
                    type: "PUT",
                    data: JSON.stringify(updatedData),
                    contentType: "application/json",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function (data) {
                        console.log("Rig Updated:", data);
                        window.location.href = "/admin/rig";
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating rig:", error);
                        try {
                            const errorData = JSON.parse(xhr.responseText);
                            displayErrors(
                                errorData.errors || {
                                    general:
                                        "An error occurred. Please try again later.",
                                }
                            );
                        } catch (err) {
                            displayErrors({
                                general:
                                    "An unexpected error occurred. Please try again later.",
                            });
                        }
                    },
                });
            });
        } else {
            console.error("Company ID not found in URL.");
            window.location.href = "/admin/rig";
        }
        function displayErrors(errors) {
            var errorMessages = "";
            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    errorMessages += errors[key] + "<br>";
                }
            }
            $("#error-messages").html(errorMessages).show();
        }
    }
});
