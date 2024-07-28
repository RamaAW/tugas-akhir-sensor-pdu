$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);

    if (!authToken) {
        window.location.href = "/login";
    } else {
        // Fetch companies for the dropdown
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
                            '">' +
                            company.name +
                            "</option>";
                    });
                    $("#companySelect").html(options);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }
        fetchCompanies();

        // Handle form submission
        $("#placeForm").on("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let jsonData = Object.fromEntries(formData.entries());

            // Assuming the company ID is obtained from the selected company in the dropdown
            let companyId = $("#companySelect").val();
            if (!companyId) {
                displayErrors({ general: "Please select a company." });
                return;
            }

            $.ajax({
                url: `http://project-akhir.test/api/company/${companyId}/place`,
                type: "POST",
                data: JSON.stringify(jsonData),
                contentType: "application/json",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    window.location.href = "/admin/place";
                    console.log("Place Registered:", data);
                    // Handle success
                },
                error: function (xhr, status, error) {
                    console.error("Error registering place:", error);
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

        // Function to display errors
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
