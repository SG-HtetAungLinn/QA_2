$(document).ready(function () {
    let errorMsg = $("#errorMsg");
    errorMsg.hide().empty();
    $("#login_form").on("submit", function (e) {
        e.preventDefault();
        const username = $("#username").val().trim();
        const password = $("#password").val().trim();
        errorMsg.hide().empty();
        $("#username").removeClass('is-invalid');
        $("#password").removeClass('is-invalid');
        let hasError = false;
        if (username === "") {
            $("#username").addClass('is-invalid');
            errorMsg.append(`<strong>Please Enter Username</strong><br/>`);
            hasError = true;
        }
        if (password === "") {
            $("#password").addClass('is-invalid');
            errorMsg.append(`<strong>Please Enter Password</strong><br/>`);
            hasError = true;
        }
        if (hasError) {
            errorMsg.show();
            setTimeout(() => {
                errorMsg.hide();
            }, 3000);
        } else {
            $.ajax({
                url: 'app/login.php',
                method: 'POST',
                data: { username, password },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        window.location.href = "index.php";
                    } else {
                        errorMsg.append(`<strong>${response.message}</strong><br/>`);
                        errorMsg.show();
                        $("#username").addClass('is-invalid');
                        $("#password").addClass('is-invalid');
                    }
                },
            })
        }
    });
});
