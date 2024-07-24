// edit-company.js
$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");

    if (!authToken) {
        window.location.href = "/login";
    } else {
        // Get the company ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const companyId = urlParams.get("id");

        if (companyId) {
            // Fetch company details and populate the form
            fetch(`http://project-akhir.test/api/company/${companyId}`, {
                method: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    $("#companyId").val(data.id);
                    $("#companyName").val(data.name);
                    $("#companyAddress").val(data.address);
                })
                .catch((error) => {
                    console.error("Error fetching company details:", error);
                });

            // Handle form submission
            $("#editCompanyForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let updatedData = Object.fromEntries(formData.entries());

                fetch(
                    `http://project-akhir.test/api/company/${updatedData.id}`,
                    {
                        method: "PUT",
                        body: JSON.stringify(updatedData),
                        headers: {
                            "Content-Type": "application/json",
                            Authorization: "Bearer " + authToken,
                        },
                    }
                )
                    .then((response) => response.json())
                    .then((data) => {
                        console.log("Company Updated:", data);
                        window.location.href = "/admin/dashboard";
                    })
                    .catch((error) => {
                        console.error("Error updating company:", error);
                    });
            });
        } else {
            console.error("Company ID not found in URL.");
            window.location.href = "/admin/dashboard";
        }
    }
});
