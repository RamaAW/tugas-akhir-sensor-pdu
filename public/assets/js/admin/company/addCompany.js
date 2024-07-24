$(document).ready(function () {
    var authToken = localStorage.getItem("authToken");
    console.log("au:", authToken);
    if (!authToken) {
        window.location.href = "/login";
    } else {
        document
            .getElementById("companyForm")
            .addEventListener("submit", function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                fetch("http://project-akhir.test/api/company", {
                    method: "POST",
                    body: JSON.stringify(
                        Object.fromEntries(formData.entries())
                    ),
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + authToken,
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        window.location.href = "/admin/dashboard";
                        console.log("Company Registered:", data);
                        // Handle success
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        // Handle error
                    });
            });
    }
});
