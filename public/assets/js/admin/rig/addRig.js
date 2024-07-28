$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/login";
    } else {
        function fetchWells() {
            $.ajax({
                url: "http://project-akhir.test/api/wells/",
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    var options = '<option value="">Select Well</option>';
                    data.forEach(function (well) {
                        options +=
                            '<option value="' +
                            well.id +
                            '">' +
                            well.name +
                            "</option>";
                    });
                    $("#wellSelect").html(options);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching wells:", error);
                    alert("Failed to fetch wells. Please try again later.");
                },
            });
        }
        fetchWells();

        $(document).ready(function () {
            $("#rigForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let jsonData = Object.fromEntries(formData.entries());

                $.ajax({
                    url: "http://project-akhir.test/api/rig",
                    type: "POST",
                    data: JSON.stringify(jsonData),
                    contentType: "application/json",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function (data) {
                        window.location.href = "/admin/rig";
                        console.log("Rig Registered:", data);
                        // Handle success
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating rig:", error);
                        try {
                            const errorData = JSON.parse(xhr.responseText);
                            displayErrors(
                                errorData.errors || {
                                    general:
                                        "An error occurred. Please try again later.",
                                }
                            );
                        } catch (err) {
                            displayErrors({
                                general:
                                    "An unexpected error occurred. Please try again later.",
                            });
                        }
                    },
                });
            });

            function displayErrors(errors) {
                var errorMessages = "";
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages += errors[key] + "<br>";
                    }
                }
                $("#error-messages").html(errorMessages).show();
            }
        });
    }
});
