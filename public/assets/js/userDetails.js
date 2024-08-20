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
