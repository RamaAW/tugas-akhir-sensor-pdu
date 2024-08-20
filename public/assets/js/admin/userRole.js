$(document).ready(function () {
    var userId = sessionStorage.getItem("userId");
    var token = sessionStorage.getItem("authToken");
    if (userId) {
        fetchUserDetails(userId);
    }

    function fetchUserDetails(id) {
        $.ajax({
            url: "http://project-akhir.test/api/employee/" + id,
            type: "GET",
            headers: {
                Authorization: "Bearer " + token,
            },
            success: function (response) {
                if (response && response.role) {
                    var responseRole = response.role;

                    if (responseRole !== "admin") {
                        alert(
                            "Access Denied. You will be redirected to the login page."
                        );
                        window.location.href = "/login";
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
