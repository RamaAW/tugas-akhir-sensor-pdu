$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");
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

        function fetchPlaces() {
            $("#placeTable").DataTable({
                ajax: {
                    url: "http://project-akhir.test/api/places/",
                    type: "GET",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    dataSrc: "",
                },
                columns: [
                    { data: "id", visible: false },
                    { data: "name" },
                    { data: "address" },
                    { data: "latitude" },
                    { data: "longitude" },
                    { data: "companyName" },
                    {
                        data: null,
                        className: "action-column",
                        render: function (data, type, row) {
                            return `
                                <div class="action-btns">
                                    <a href="/admin/place/edit?id=${row.id}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                                </div>
                            `;
                        },
                    },
                ],
            });
        }
        fetchPlaces();
        $("#placeTable").on("click", ".delete-btn", function () {
            var placeId = $(this).data("id");

            if (confirm("Are you sure you want to delete this place?")) {
                $.ajax({
                    url: `http://project-akhir.test/api/place/${placeId}`,
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                    success: function () {
                        alert("Place deleted successfully.");
                        $("#placeTable").DataTable().ajax.reload();
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

        $("#placeTable tbody").on("click", ".edit-btn", function () {
            var id = $(this).data("id");
            window.location.href = "/admin/place/edit";
        });
    }
});
