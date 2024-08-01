$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/login";
    } else {
        // Function to fetch companies
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
                    console.log("comp:", options);
                    $("#companySelect").html(options);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }

        function fetchWellsByCompany(companyId) {
            console.log("Fetching wells for company ID:", companyId); // Debugging line
            $.ajax({
                url:
                    "http://project-akhir.test/api/companies/" +
                    companyId +
                    "/wells",
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (wellData) {
                    console.log("Well Data Response:", wellData); // Debugging line
                    var wellOptions = '<option value="">Select Well</option>';
                    wellData.forEach(function (well) {
                        wellOptions +=
                            '<option value="' +
                            well.id +
                            '">' +
                            well.name +
                            "</option>";
                    });
                    $("#wellSelect").html(wellOptions).prop("disabled", false);
                    $("#wellForm").show();
                },
                error: function (xhr, status, error) {
                    console.log("Wells Options:", wellOptions); // Debugging line
                    console.error("Error fetching wells:", error);
                    alert("Failed to fetch wells. Please try again later.");
                },
            });
        }

        function fetchRigsByWell(wellId) {
            console.log("Fetching rigs for well ID:", wellId); // Debugging line
            $.ajax({
                url: "http://project-akhir.test/api/rig/well/" + wellId,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (rigData) {
                    console.log("Rig Data Response:", rigData); // Debugging line
                    if (rigData.length > 0) {
                        // Save the first rig to localStorage
                        localStorage.setItem("selectedRigId", rigData[0].id);
                        console.log("Selected Rig ID saved:", rigData[0].id);
                    } else {
                        localStorage.removeItem("selectedRigId");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching rigs:", error);
                    alert("Failed to fetch rigs. Please try again later.");
                },
            });
        }

        // Handle company form submission
        $("#companyForm").change(function (event) {
            event.preventDefault();
            var companyId = $("#companySelect").val();
            console.log("Selected Company ID:", companyId);
            if (companyId) {
                fetchWellsByCompany(companyId);
                localStorage.setItem("selectedCompanyId", companyId);
            }
        });

        // Handle well selection and potential form submission (adapt based on your logic)
        $("#wellSelect").change(function () {
            var wellId = $(this).val();
            if (wellId) {
                localStorage.setItem("selectedWellId", wellId);
                $("#submitSelection").prop("disabled", false);
                fetchRigsByWell(wellId);
            }
        });

        // Redirect to homepage if both selections are made
        $("#submitSelection").click(function () {
            var selectedCompanyId = localStorage.getItem("selectedCompanyId");
            var selectedWellId = localStorage.getItem("selectedWellId");
            var selectedRigId = localStorage.getItem("selectedRigId");

            if (selectedCompanyId && selectedWellId && selectedRigId) {
                window.location.href = "/dashboard";
            } else {
                alert("Please select a company, a well, and a rig.");
            }
        });

        fetchCompanies();
    }
});
