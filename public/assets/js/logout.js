$(document).ready(function () {
    var authToken = sessionStorage.getItem("authToken");
    if (!authToken) {
        window.location.href = "/chooseCompany-Well";
    } else {
        function logout() {
            $.ajax({
                url: "http://project-akhir.test/api/logout",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                headers: {
                    Authorization: "Bearer " + authToken,
                },
                success: function (response) {
                    sessionStorage.removeItem("authToken");
                    window.location.href = "/login";
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching companies:", error);
                    alert("Failed to fetch companies. Please try again later.");
                },
            });
        }
    }
    $("#logoutModal").on("click", ".logout-btn", function () {
        logout();
    });
});
