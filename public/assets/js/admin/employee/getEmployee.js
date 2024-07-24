$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/login";
    } else {
        function fetchEmployees() {
            $("#employeeTable").DataTable({
                ajax: {
                    url: "http://project-akhir.test/api/employees/",
                    type: "GET",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    dataSrc: "",
                },
                columns: [
                    { data: "id" },
                    { data: "name" },
                    { data: "email" },
                    { data: "companyId" },
                    { data: "role" },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <a href="/admin/editEmployee?id=${row.id}" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                            `;
                        },
                    },
                ],
            });
        }
        fetchEmployees();
        $("#employeeTable").on("click", ".delete-btn", function () {
            var employeeId = $(this).data("id");

            if (confirm("Are you sure you want to delete this employee?")) {
                fetch(`http://project-akhir.test/api/employee/${employeeId}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                })
                    .then((response) => {
                        if (response.ok) {
                            alert("Employee deleted successfully.");
                            $("#employeeTable").DataTable().ajax.reload(); // Reload the table data
                        } else {
                            return response.text().then((text) => {
                                throw new Error(text);
                            });
                        }
                    })
                    .catch((error) => {
                        console.error("Error deleting employee:", error);
                        alert("Error deleting employee. Please try again.");
                    });
            }
        });

        $("#employeeTable tbody").on("click", ".edit-btn", function () {
            var id = $(this).data("id");
            // Implement your edit logic here
            window.location.href = "/admin/editEmployee";
        });

        $("#employeeTable tbody").on("click", ".delete-btn", function () {
            var id = $(this).data("id");
        });
    }
});
