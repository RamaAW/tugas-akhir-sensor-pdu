$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");
    var selectedCompanyId = sessionStorage.getItem("selectedCompanyId");
    var selectedWellId = sessionStorage.getItem("selectedWellId");
    var selectedRigId = sessionStorage.getItem("selectedRigId");

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

                if (
                    selectedWellId &&
                    wellData.some((well) => well.id == selectedWellId)
                ) {
                    var selectedWellName = $(
                        "#wellDropdownMenu a[data-well-id='" +
                            selectedWellId +
                            "']"
                    ).data("well-name");
                    $("#wellName")
                        .text(selectedWellName)
                        .attr("data-well-id", selectedWellId);
                    fetchRigsByWell(selectedWellId);
                } else if (wellData.length > 0) {
                    // If no well is selected or the selected well is not in the new list, select the first one
                    var firstWell = wellData[0];
                    $("#wellName")
                        .text(firstWell.name)
                        .attr("data-well-id", firstWell.id);
                    sessionStorage.setItem("selectedWellId", firstWell.id);
                    sessionStorage.setItem("selectedWellName", firstWell.name);
                    fetchRigsByWell(firstWell.id);
                } else {
                    $("#wellName").text("Select Well").attr("data-well-id", "");
                    $("#rigName").text("Select Rig").attr("data-rig-id", "");
                    $("#rigDropdownMenu").empty();
                    sessionStorage.removeItem("selectedWellId");
                    sessionStorage.removeItem("selectedWellName");
                    sessionStorage.removeItem("selectedRigId");
                    sessionStorage.removeItem("selectedRigName");
                }
                $("#wellName").dropdown("update");
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
                var rigOptions = "";
                rigData.forEach(function (rig) {
                    rigOptions +=
                        '<a class="dropdown-item" href="#" data-rig-id="' +
                        rig.id +
                        '" data-rig-name="' +
                        rig.rigName +
                        '">' +
                        rig.rigName +
                        "</a>";
                });
                $("#rigDropdownMenu").html(rigOptions);

                if (
                    selectedRigId &&
                    rigData.some((rig) => rig.id == selectedRigId)
                ) {
                    var selectedRigName = $(
                        "#rigDropdownMenu a[data-rig-id='" +
                            selectedRigId +
                            "']"
                    ).data("rig-name");
                    $("#rigName")
                        .text(selectedRigName)
                        .attr("data-rig-id", selectedRigId);
                } else if (rigData.length > 0) {
                    // If no rig is selected or the selected rig is not in the new list, select the first one
                    var firstRig = rigData[0];
                    $("#rigName")
                        .text(firstRig.rigName)
                        .attr("data-rig-id", firstRig.id);
                    updateSelectedRig(firstRig.id, firstRig.rigName);
                } else {
                    $("#rigName").text("Select Rig").attr("data-rig-id", "");
                    updateSelectedRig(null, null);
                }
                $("#rigName").dropdown("update");
            },
            error: function (xhr, status, error) {
                console.error("Error fetching rigs:", error);
                alert("Failed to fetch rigs. Please try again later.");
            },
        });
    }

    function updateSelectedRig(rigId, rigName) {
        if (rigId && rigName) {
            sessionStorage.setItem("selectedRigId", rigId);
            sessionStorage.setItem("selectedRigName", rigName);
            selectedRigId = rigId;
        } else {
            sessionStorage.removeItem("selectedRigId");
            sessionStorage.removeItem("selectedRigName");
            selectedRigId = null;
        }
        location.reload();
    }

    if (selectedCompanyId) {
        fetchWellsByCompany(selectedCompanyId);
    } else {
        alert("Please select a company first.");
    }

    $(document).on("click", "#wellDropdownMenu .dropdown-item", function () {
        var wellId = $(this).data("well-id");
        var wellName = $(this).text();
        $("#wellName").text(wellName).attr("data-well-id", wellId);
        sessionStorage.setItem("selectedWellId", wellId);
        sessionStorage.setItem("selectedWellName", wellName);
        selectedWellId = wellId;
        fetchRigsByWell(wellId);
    });

    $(document).on("click", "#rigDropdownMenu .dropdown-item", function () {
        var rigId = $(this).data("rig-id");
        var rigName = $(this).text();
        $("#rigName").text(rigName).attr("data-rig-id", rigId);
        updateSelectedRig(rigId, rigName);
    });
});
