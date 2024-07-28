$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");

    if (!authToken) {
        window.location.href = "/login";
    } else {
        function fetchPlaces() {
            $.ajax({
                url: "http://project-akhir.test/api/places/",
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    var options = '<option value="">Select Place</option>';
                    data.forEach(function (place) {
                        options +=
                            '<option value="' +
                            place.id +
                            '"' +
                            (place.id ==
                            $("#wellPlace").data("current-place-id")
                                ? " selected"
                                : "") +
                            ">" +
                            place.name +
                            "</option>";
                    });
                    $("#wellPlace").html(options);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching places:", error);
                    alert("Failed to fetch places. Please try again later.");
                },
            });
        }
        fetchPlaces();
        // Get the company ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const wellId = urlParams.get("id");

        if (wellId) {
            // Fetch company details and populate the form
            $.ajax({
                url: `http://project-akhir.test/api/well/${wellId}`,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#wellId").val(data.id);
                    $("#wellName").val(data.name);
                    $("#wellAddress").val(data.address);
                    $("#wellPlace").data("current-place-id", data.placeId);
                    $("#wellLatitude").val(data.latitude);
                    $("#wellLongitude").val(data.longitude);
                },
                error: function (error) {
                    console.error("Error fetching well details:", error);
                },
            });

            // Handle form submission
            $("#editWellForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let updatedData = Object.fromEntries(formData.entries());

                $.ajax({
                    url: `http://project-akhir.test/api/well/${updatedData.id}`,
                    type: "PUT",
                    data: JSON.stringify(updatedData),
                    contentType: "application/json",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function (data) {
                        console.log("Well Updated:", data);
                        window.location.href = "/admin/well";
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating well:", error);
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
            window.location.href = "/admin/well";
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
