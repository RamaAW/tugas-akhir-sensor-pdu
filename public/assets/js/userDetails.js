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
                if (response && response.name) {
                    $("#userName").text(response.name);
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
