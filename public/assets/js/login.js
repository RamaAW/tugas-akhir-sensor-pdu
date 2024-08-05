$(document).ready(function () {
    // Check if a token exists in local storage when the page loads
    var token = localStorage.getItem("authToken");
    if (token) {
        window.location.href = "/dashboard";
        return; // Exit the function if token exists
    }
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();

        const username = $("#username").val();
        const password = $("#password").val();

        // Validate input fields
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
                console.log(response);
                var authToken = response.token;
                var userId = response.id;
                localStorage.setCookie("authToken", authToken);
                localStorage.setCookie("userId", userId);
                window.location.href = "/chooseCompany-Well";
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
