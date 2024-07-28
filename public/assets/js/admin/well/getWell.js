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

        function fetchWells() {
            $("#wellTable").DataTable({
                ajax: {
                    url: "http://project-akhir.test/api/wells/",
                    type: "GET",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    dataSrc: "",
                },
                columns: [
                    { data: "id" },
                    { data: "name" },
                    { data: "address" },
                    { data: "latitude" },
                    { data: "longitude" },
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
                                    <a href="/admin/well/edit?id=${row.id}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                                </div>
                            `;
                        },
                    },
                ],
            });
        }
        fetchWells();
        $("#wellTable").on("click", ".delete-btn", function () {
            var wellId = $(this).data("id");

            if (confirm("Are you sure you want to delete this well?")) {
                $.ajax({
                    url: `http://project-akhir.test/api/well/${wellId}`,
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                    success: function () {
                        alert("Well deleted successfully.");
                        $("#wellTable").DataTable().ajax.reload();
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

        $("#wellTable tbody").on("click", ".edit-btn", function () {
            var id = $(this).data("id");
            // Implement your edit logic here
            window.location.href = "/admin/well/edit";
        });
    }
});
