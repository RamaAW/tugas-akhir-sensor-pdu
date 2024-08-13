$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");

    if (!authToken) {
        window.location.href = "/login";
    } else {
        // Get the company ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const companyId = urlParams.get("id");

        if (companyId) {
            // Fetch company details and populate the form
            $.ajax({
                url: `http://project-akhir.test/api/company/${companyId}`,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#companyId").val(data.id);
                    $("#companyName").val(data.name);
                    $("#companyAddress").val(data.address);
                },
                error: function (error) {
                    console.error("Error fetching company details:", error);
                },
            });

            // Handle form submission
            $("#editCompanyForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let updatedData = Object.fromEntries(formData.entries());

                $.ajax({
                    url: `http://project-akhir.test/api/company/${updatedData.id}`,
                    type: "PUT",
                    data: JSON.stringify(updatedData),
                    contentType: "application/json",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function (data) {
                        console.log("Company Updated:", data);
                        window.location.href = "/admin/company";
                    },
                    error: function (error) {
                        console.error("Error updating company:", error);
                    },
                });
            });
        } else {
            console.error("Company ID not found in URL.");
            window.location.href = "/admin/company";
        }
    }
});
