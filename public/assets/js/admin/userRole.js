$(document).ready(function () {
    // Check if a token exists in local storage when the page loads
    var userId = sessionStorage.getItem("userId");
    var token = sessionStorage.getItem("authToken");
    if (userId) {
        fetchUserDetails(userId);
    }

    function fetchUserDetails(id) {
        $.ajax({
            url: "http://project-akhir.test/api/employee/" + id, // Replace this with the correct endpoint
            type: "GET",
            headers: {
                Authorization: "Bearer " + token,
            },
            success: function (response) {
                if (response && response.role) {
                    var responseRole = response.role;
                    console.log(responseRole);

                    if (responseRole !== "admin") {
                        // Show an alert and redirect to the login page if the user is not an admin
                        alert(
                            "Access Denied. You will be redirected to the login page."
                        );
                        window.location.href = "/login"; // Redirect to the login page
                    }
                } else {
                    console.error("Invalid response format:", response);
                }
            },
            error: function (xhr, status, error) {
                console.error("Fetch user details error:", xhr.responseText);
            },
        });
    }
});
