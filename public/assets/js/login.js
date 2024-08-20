$(document).ready(function () {
    var token = sessionStorage.getItem("authToken");
    if (token) {
        window.location.href = "/dashboard";
        return;
    }
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();

        const username = $("#username").val();
        const password = $("#password").val();

        if (!username || !password) {
            alert("Username and password must be filled out.");
            return;
        }

        $.ajax({
            url: "http://project-akhir.test/api/login",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify({
                username: username,
                password: password,
            }),
            success: function (response) {
                var authToken = response.token;
                var userId = response.id;
                var userRole = response.role;
                sessionStorage.setItem("authToken", authToken);
                sessionStorage.setItem("userId", userId);

                if (userRole === "admin") {
                    window.location.href = "/admin/company";
                } else {
                    window.location.href = "/chooseCompany-Well";
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert(
                    "Login failed. Please check your credentials and try again."
                );
            },
        });
    });
});
