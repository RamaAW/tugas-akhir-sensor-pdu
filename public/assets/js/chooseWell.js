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
                var wellOptions = "";
                wellData.forEach(function (well) {
                    wellOptions +=
                        '<a class="dropdown-item" href="#" data-well-id="' +
                        well.id +
                        '" data-well-name="' +
                        well.name +
                        '">' +
                        well.name +
                        "</a>";
                });
                $("#wellDropdownMenu").html(wellOptions);
                if (selectedWellId) {
                    var selectedWellName = $(
                        "#wellDropdownMenu a[data-well-id='" +
                            selectedWellId +
                            "']"
                    ).data("well-name");
                    $("#wellName")
                        .text(selectedWellName)
                        .attr("data-well-id", selectedWellId);
                } else {
                    $("#wellName").text("Select Well").attr("data-well-id", "");
                }
                $("#wellName").dropdown("update");
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
    $(document).on("click", "#wellDropdownMenu .dropdown-item", function () {
        var wellId = $(this).data("well-id");
        var wellName = $(this).text();
        $("#wellName").text(wellName).attr("data-well-id", wellId);
        localStorage.setItem("selectedWellId", wellId);
        localStorage.setItem("selectedWellName", wellName);
        location.reload(); // Reload the page
    });
});
