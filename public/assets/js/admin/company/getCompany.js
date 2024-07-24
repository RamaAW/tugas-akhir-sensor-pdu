$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/login";
    } else {
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
                    { data: "id" },
                    { data: "name" },
                    { data: "address" },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <a href="/admin/editCompany?id=${row.id}" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
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
                fetch(`http://project-akhir.test/api/company/${companyId}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                })
                    .then((response) => {
                        if (response.ok) {
                            alert("Company deleted successfully.");
                            $("#companyTable").DataTable().ajax.reload(); // Reload the table data
                        } else {
                            return response.text().then((text) => {
                                throw new Error(text);
                            });
                        }
                    })
                    .catch((error) => {
                        console.error("Error deleting company:", error);
                        alert("Error deleting company. Please try again.");
                    });
            }
        });

        $("#companyTable tbody").on("click", ".edit-btn", function () {
            var id = $(this).data("id");
            // Implement your edit logic here
            window.location.href = "/admin/editCompany";
        });

        $("#companyTable tbody").on("click", ".delete-btn", function () {
            var id = $(this).data("id");
        });
    }
});
