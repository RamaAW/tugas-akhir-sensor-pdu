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
                            $("#employeeCompany").data("current-company-id")
                                ? " selected"
                                : "") +
                            ">" +
                            company.name +
                            "</option>";
                    });
                    $("#employeeCompany").html(options);
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
        const employeeId = urlParams.get("id");

        if (employeeId) {
            // Fetch company details and populate the form
            $.ajax({
                url: `http://project-akhir.test/api/employee/${employeeId}`,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#employeeId").val(data.id);
                    $("#employeeName").val(data.name);
                    $("#employeeEmail").val(data.email);
                    $("#employeeRole").val(data.role);
                    $("#employeePassword").val(data.password);
                    $("#employeeCompany").data(
                        "current-company-id",
                        data.companyId
                    );
                },
                error: function (error) {
                    console.error("Error fetching employee details:", error);
                },
            });

            // Handle form submission
            $("#editEmployeeForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let updatedData = Object.fromEntries(formData.entries());

                $.ajax({
                    url: `http://project-akhir.test/api/employee/${updatedData.id}`,
                    type: "PUT",
                    data: JSON.stringify(updatedData),
                    contentType: "application/json",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function (data) {
                        console.log("Employee Updated:", data);
                        window.location.href = "/admin/employee";
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating employee:", error);
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
            window.location.href = "/admin/employee";
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
