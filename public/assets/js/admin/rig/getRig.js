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
                        errorMessages += errors[key];
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
                    { data: "id", visible: false },
                    { data: "rigName" },
                    { data: "rigType" },
                    { data: "rigPower" },
                    { data: "rigActivity" },
                    {
                        data: "isActive",
                        render: function (data) {
                            return data
                                ? '<span class="font-weight-bold text-primary">Active</span>'
                                : '<span class="font-weight-bold text-danger">Inactive</span>';
                        },
                    },
                    { data: "wellName" },
                    { data: "placeName" },
                    { data: "companyName" },
                    {
                        data: null,
                        className: "action-records-column",
                        render: function (data, type, row) {
                            return `
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-warning delete-all-btn" data-id="${row.id}"><i class="fas fa-trash-alt"></i> Delete All Records</button>
                                    <input type="file" class="form-control-file csv-upload" data-id="${row.id}" />
                                </div>
                            `;
                        },
                    },
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

        $("#rigTable").on("click", ".delete-all-btn", function () {
            var rigId = $(this).data("id");

            if (
                confirm(
                    "Are you sure you want to delete all records associated with this rig?"
                )
            ) {
                $.ajax({
                    url: `http://project-akhir.test/api/records/rig/${rigId}`,
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                    success: function () {
                        alert("All records for this rig deleted successfully.");
                        $("#rigTable").DataTable().ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting records:", error);
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

        $("#rigTable").on("change", ".csv-upload", function () {
            var rigId = $(this).data("id");
            var fileInput = $(this)[0];
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append("csv_file", file);
            formData.append("rigId", rigId);

            $.ajax({
                url: `http://project-akhir.test/api/records/uploadCsv`,
                method: "POST",
                headers: {
                    Accept: "application/json",
                    Authorization: "Bearer " + authToken,
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(
                        "CSV file uploaded successfully. " +
                            response.records_created +
                            " records created."
                    );
                },
                error: function (xhr, status, error) {
                    console.error("Error uploading CSV:", error);
                    try {
                        const errorData = JSON.parse(xhr.responseText);
                        let errorMessage = "";

                        if (errorData.error) {
                            // If the response contains an 'error' key, handle it
                            if (typeof errorData.error === "object") {
                                for (const key in errorData.error) {
                                    if (Array.isArray(errorData.error[key])) {
                                        errorData.error[key].forEach(function (
                                            msg
                                        ) {
                                            errorMessage += msg + "\n";
                                        });
                                    } else {
                                        errorMessage +=
                                            errorData.error[key] + "\n";
                                    }
                                }
                            } else {
                                errorMessage = errorData.error;
                            }
                        } else if (errorData.errors) {
                            // If the response contains an 'errors' key, handle it
                            for (const field in errorData.errors) {
                                errorData.errors[field].forEach(function (
                                    message
                                ) {
                                    errorMessage += message + "\n";
                                });
                            }
                        } else {
                            errorMessage =
                                "An unexpected error occurred. Please try again later.";
                        }

                        displayErrors(errorMessage.trim());
                    } catch (err) {
                        displayErrors(
                            "An unexpected error occurred. Please try again later."
                        );
                    }
                },
            });
        });

        $("#rigTable tbody").on("click", ".edit-btn", function () {
            var id = $(this).data("id");
            window.location.href = "/admin/rig/edit";
        });
    }
});
