$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/login";
    } else {
        function fetchPlaces() {
            $.ajax({
                url: "http://project-akhir.test/api/places/",
                type: "GET",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    var options = '<option value="">Select Place</option>';
                    data.forEach(function (place) {
                        options +=
                            '<option value="' +
                            place.id +
                            '">' +
                            place.name +
                            "</option>";
                    });
                    $("#placeSelect").html(options);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching places:", error);
                    alert("Failed to fetch places. Please try again later.");
                },
            });
        }
        fetchPlaces();

        $(document).ready(function () {
            $("#wellForm").on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let jsonData = Object.fromEntries(formData.entries());

                $.ajax({
                    url: "http://project-akhir.test/api/wells",
                    type: "POST",
                    data: JSON.stringify(jsonData),
                    contentType: "application/json",
                    headers: {
                        Authorization: "Bearer " + authToken,
                    },
                    success: function (data) {
                        window.location.href = "/admin/well";
                        console.log("Well Registered:", data);
                        // Handle success
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating well:", error);
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
