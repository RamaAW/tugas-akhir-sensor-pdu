$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
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

        document
            .getElementById("employeeForm")
            .addEventListener("submit", function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let jsonData = Object.fromEntries(formData.entries());
                fetch("http://project-akhir.test/api/employee", {
                    method: "POST",
                    body: JSON.stringify(jsonData),
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        window.location.href = "/admin/employee";
                        console.log("Employee Registered:", data);
                        // Handle success
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        // Handle error
                    });
            });
    }
});
