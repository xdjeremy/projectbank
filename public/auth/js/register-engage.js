$('#register-form').submit(function (e) {
    e.preventDefault();

    var data = $("#register-form").serialize();

    $("#register").html(
        "<div class='spinner-grow text-info align-self-center loader-sm'>Loading...</div>"
    )

    $("#register").prop('disabled', true);

    //input validation
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function resetButton() {
        $('#register').html("Register Account");
        $('#register').prop('disabled', false);
    }

    if (
        first_name.value.length < 1 ||
        last_name.value.length < 1 ||
        address.value.length < 1 ||
        phonenumber.value.length < 1 ||
        email.value.length < 1
    ) {
        Snackbar.show({
            text: "Fill out all missing forms",
            actionTextColor: "#fff",
            backgroundColor: "#e7515a",
        });
        return resetButton();
    } else if (!validateEmail(email.value)) {
        Snackbar.show({
            text: "Email address is not allowed",
            actionTextColor: "#fff",
            backgroundColor: "#e7515a",
        });
        return resetButton();
    } else if (password.value.length <= 6) {
        Snackbar.show({
            text: "Password must be longer than 6 characters",
            actionTextColor: "#fff",
            backgroundColor: "#e7515a",
        });
        return resetButton();
    } else if (password.value != password_repeat.value) {
        Snackbar.show({
            text: "Password does not match",
            actionTextColor: "#fff",
            backgroundColor: "#e7515a",
        });
        return resetButton();
    } else if (phonenumber.value.length < 11 || phonenumber.value.length > 12) {
        Snackbar.show({
            text: "Invalid phone number",
            actionTextColor: "#fff",
            backgroundColor: "#e7515a",
        });
        return resetButton();
    } else {
        $.ajax({
            type: "POST",
            url: "ajax/register_process",
            dataType: "json",
            data: data,
            success: function (e) {
                if (e.success) {
                    Snackbar.show({
                        text: "Successfully registered!",
                        actionTextColor: "#fff",
                        backgroundColor: "#8dbf42",
                    });
                    window.location.replace("login");
                    exit();
                } else {
                    Snackbar.show({
                        text: e.msg,
                        actionTextColor: "#fff",
                        backgroundColor: "#e7515a",
                    });
                    return resetButton();
                }
            },
            error: function () {
                Snackbar.show({
                    text: "Something went wrong. Please try again",
                    actionTextColor: "#fff",
                    backgroundColor: "#e7515a",
                });
                return resetButton();
            },
        });
    }
});