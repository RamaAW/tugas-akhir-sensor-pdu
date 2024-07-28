$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");

    if (!authToken) {
        window.location.href = "/login";
    } else {
        function fetchCompanies() {
            $.ajax({
                url: "http://project-akhir.test/api/companies/",
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    var options = '<option value="">Select Company</option>';
                    data.forEach(function (company) {
                        options +=
                            '<option value="' +
                            company.id +
                            '"' +
                            (company.id ==
                            $("#placeCompany").data("current-company-id")
                                ? " selected"
                                : "") +
                            ">" +
                            company.name +
                            "</option>";
                    });
                    $("#placeCompany").html(options);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }
        fetchCompanies();
        // Get the company ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const placeId = urlParams.get("id");

        if (placeId) {
            // Fetch company details and populate the form
            $.ajax({
                url: `http://project-akhir.test/api/place/${placeId}`,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#placeId").val(data.id);
                    $("#placeName").val(data.name);
                    $("#placeAddress").val(data.address);
                    $("#placeCompany").data(
                        "current-company-id",
                        data.companyId
                    );
                    $("#placeLatitude").val(data.latitude);
                    $("#placeLongitude").val(data.longitude);
                },
                error: function (error) {
                    console.error("Error fetching place details:", error);
                },
            });

            // Handle form submission
            $("#editPlaceForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let updatedData = Object.fromEntries(formData.entries());

                $.ajax({
                    url: `http://project-akhir.test/api/place/${updatedData.id}`,
                    type: "PUT",
                    data: JSON.stringify(updatedData),
                    contentType: "application/json",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function (data) {
                        console.log("Place Updated:", data);
                        window.location.href = "/admin/place";
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating place:", error);
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
            window.location.href = "/admin/place";
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
