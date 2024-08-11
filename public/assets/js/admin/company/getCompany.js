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

        function fetchCompanies() {
            $("#companyTable").DataTable({
                ajax: {
                    url: "http://project-akhir.test/api/companies/",
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
                    {
                        data: null,
                        className: "action-column",
                        render: function (data, type, row) {
                            return `
                                <div class="action-btns">
                                    <a href="/admin/company/edit?id=${row.id}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                                </div>
                            `;
                        },
                    },
                ],
            });
        }

        fetchCompanies();

        $("#companyTable").on("click", ".delete-btn", function () {
            var companyId = $(this).data("id");

            if (confirm("Are you sure you want to delete this company?")) {
                $.ajax({
                    url: `http://project-akhir.test/api/company/${companyId}`,
                    type: "DELETE",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function () {
                        alert("Company deleted successfully.");
                        $("#companyTable").DataTable().ajax.reload(); // Reload the table data
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

        $("#companyTable tbody").on("click", ".edit-btn", function () {
            var id = $(this).data("id");
            window.location.href = `/admin/company/edit`;
        });
    }
});
