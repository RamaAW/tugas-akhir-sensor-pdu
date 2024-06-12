$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/chooseCompany-Well";
    } else {
        // Function to fetch companies
        function fetchCompaniesDetails(companyId) {
            $.ajax({
                url: "http://project-akhir.test/api/company" + companyId,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#companyDetails").html(
                        <h2>Company Name = ${data.name}</h2>
                    );
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }

        function fetchWellDetails(wellId) {
            $.ajax({
                url: "http://project-akhir.test/api/well" + wellId,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    $("#wellDetails").html(
                        <h2>Company Name = ${data.name}</h2>
                    );
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }
    }
});
