$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    var selectedCompanyId = localStorage.getItem("selectedCompanyId");
    var selectedWellId = localStorage.getItem("selectedWellId");

    // Function to fetch wells by company ID
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
                var wellOptions =
                    `<option value="">` + wellData.name + `</option>`;
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

    if (selectedCompanyId) {
        fetchWellsByCompany(selectedCompanyId);
    } else {
        alert("Please select a company first.");
    }

    // Handle click on well details to select a well
    $(document).on("change", "#wellSelect", function () {
        var wellId = $(this).val();
        var wellName = $(this).find("option:selected").text();
        $("#wellDetails").text(wellName).attr("data-well-id", wellId);
        $("#wellDetails").attr("data-company-id", selectedCompanyId);
        localStorage.setItem("selectedWellId", wellId);
        $("#submitSelection").prop("disabled", false);
    });

    // Redirect to homepage if both selections are made
    $("#submitSelection").click(function () {
        var selectedWellId = localStorage.getItem("selectedWellId");

        if (selectedCompanyId && selectedWellId) {
            window.location.href = "/homepage-home";
        } else {
            alert("Please select both a company and a well.");
        }
    });
    fetchWellsByCompany(selectedCompanyId);
});
