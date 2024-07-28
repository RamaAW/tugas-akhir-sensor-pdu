$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/login";
    } else {
        function displayErrors(errors) {
            var errorMessages = "";
            if (Array.isArray(errors.messages)) {
                errors.messages.forEach(function (message) {
                    errorMessages += message + "<br>";
                });
            } else {
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages += errors[key] + "<br>";
                    }
                }
            }
            $("#error-messages").html(errorMessages).show();
        }

        function fetchRigs() {
            $("#rigTable").DataTable({
                ajax: {
                    url: "http://project-akhir.test/api/rigs/",
                    type: "GET",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    dataSrc: "",
                },
                columns: [
                    { data: "id" },
                    { data: "rigName" },
                    { data: "rigType" },
                    { data: "rigPower" },
                    { data: "rigActivity" },
                    { data: "wellId" },
                    { data: "wellName" },
                    { data: "placeId" },
                    { data: "placeName" },
                    { data: "companyId" },
                    { data: "companyName" },
                    {
                        data: null,
                        className: "action-column",
                        render: function (data, type, row) {
                            return `
                                <div class="action-btns">
                                    <a href="/admin/rig/edit?id=${row.id}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                                </div>
                            `;
                        },
                    },
                ],
            });
        }
        fetchRigs();
        $("#rigTable").on("click", ".delete-btn", function () {
            var rigId = $(this).data("id");

            if (confirm("Are you sure you want to delete this rig?")) {
                $.ajax({
                    url: `http://project-akhir.test/api/rig/${rigId}`,
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                    success: function () {
                        alert("Rig deleted successfully.");
                        $("#rigTable").DataTable().ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting company:", error);
                        try {
                            const errorData = JSON.parse(xhr.responseText);
                            displayErrors(errorData.errors || errorData);
                        } catch (err) {
                            displayErrors({
                                general:
                                    "An unexpected error occurred. Please try again later.",
                            });
                        }
                    },
                });
            }
        });

        $("#rigTable tbody").on("click", ".edit-btn", function () {
            var id = $(this).data("id");
            // Implement your edit logic here
            window.location.href = "/admin/rig/edit";
        });
    }
});
