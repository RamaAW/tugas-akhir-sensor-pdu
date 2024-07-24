$(document).ready(function () {
    // Check if a token exists in local storage when the page loads
    var token = localStorage.getItem("authToken");
    if (token) {
        window.location.href = "/dashboard";
        return; // Exit the function if token exists
    }
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();

        const email = $("#email").val();
        const password = $("#password").val();

        // Validate input fields
        if (!email || !password) {
            alert("Email and password must be filled out.");
            return;
        }

        $.ajax({
            url: "http://project-akhir.test/api/login",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify({
                email: email,
                password: password,
            }),
            success: function (response) {
                console.log(response);
                var authToken = response.token;
                localStorage.setItem("authToken", authToken);
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
