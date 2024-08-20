$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");
    if (!authToken) {
        window.location.href = "/login";
    } else {
        function fetchCompanies() {
            $.ajax({
                url: "http://project-akhir.test/api/companies-for-employee/",
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

        function fetchWellsByCompany(companyId) {
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
                    console.error("Error fetching wells:", error);
                    alert("Failed to fetch wells. Please try again later.");
                },
            });
        }

        function fetchRigsByWell(wellId) {
            $.ajax({
                url: "http://project-akhir.test/api/rig/well/" + wellId,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (rigData) {
                    if (rigData.length > 0) {
                        sessionStorage.setItem("selectedRigId", rigData[0].id);
                    } else {
                        sessionStorage.removeItem("selectedRigId");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching rigs:", error);
                    alert("Failed to fetch rigs. Please try again later.");
                },
            });
        }

        $("#companyForm").change(function (event) {
            event.preventDefault();
            var companyId = $("#companySelect").val();
            if (companyId) {
                fetchWellsByCompany(companyId);
                sessionStorage.setItem("selectedCompanyId", companyId);
            }
        });

        $("#wellSelect").change(function () {
            var wellId = $(this).val();
            if (wellId) {
                sessionStorage.setItem("selectedWellId", wellId);
                $("#submitSelection").prop("disabled", false);
                fetchRigsByWell(wellId);
            }
        });

        $("#submitSelection").click(function () {
            var selectedCompanyId = sessionStorage.getItem("selectedCompanyId");
            var selectedWellId = sessionStorage.getItem("selectedWellId");
            var selectedRigId = sessionStorage.getItem("selectedRigId");

            if (!selectedCompanyId) {
                alert("Please select a company.");
            } else if (!selectedWellId) {
                alert("Please select a well.");
            } else if (!selectedRigId) {
                alert("There is No Rig In this Well");
            } else {
                window.location.href = "/dashboard";
            }
        });

        fetchCompanies();

        $("#backToLogin").click(function () {
            sessionStorage.removeItem("authToken");
            sessionStorage.removeItem("userId");
            sessionStorage.removeItem("selectedCompanyId");
            sessionStorage.removeItem("selectedWellId");
            sessionStorage.removeItem("selectedRigId");
            window.location.href = "/login";
        });
    }
});
