$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");
    console.log("au:", authToken);

    if (!authToken) {
        window.location.href = "/login";
    } else {
        $("#companyForm").on("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let jsonData = Object.fromEntries(formData.entries());

            $.ajax({
                url: "http://project-akhir.test/api/company",
                type: "POST",
                data: JSON.stringify(jsonData),
                contentType: "application/json",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (data) {
                    window.location.href = "/admin/company";
                    console.log("Company Registered:", data);
                    // Handle success
                },
                error: function (xhr, status, error) {
                    console.error("Error registering company:", error);
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
    }
});
