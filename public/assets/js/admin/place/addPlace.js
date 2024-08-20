$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");

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

        $("#placeForm").on("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let jsonData = Object.fromEntries(formData.entries());

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
