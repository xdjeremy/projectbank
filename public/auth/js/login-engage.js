$('#login-form').submit(function (e) {
    e.preventDefault();

    var data = $('#login-form').serialize();

    $("#login").html("<div class='spinner-grow text-info align-self-center loader-sm'>Loading...</div>")

    $("#login").prop('disabled', true);

    function resetButton() {
        $('#login').html("Login");
        $('#login').prop('disabled', false);
    }

    if ($('#email').val() == "" || $('#password').val() == "") {
        Snackbar.show({
            text: "Username or password cannot be blank",
            actionTextColor: "#fff",
            backgroundColor: "#e7515a",
        });
        resetButton();
    } else {
        $.ajax({
            type: "post",
            url: "ajax/login_process",
            dataType: 'json',
            data: data,
            success: function (e) {
                if (e.success) {
                    window.location.replace("../summary");
                    return;
                } else {
                    console.log(e)
                    Snackbar.show({
                        text: e.msg,
                        actionTextColor: "#fff",
                        backgroundColor: "#e7515a",
                    });
                    return resetButton();
                }
            },
            error: function (e) {
                console.log(e)
                Snackbar.show({
                    text: "Something went wrong. Please try again",
                    actionTextColor: "#fff",
                    backgroundColor: "#e7515a",
                });
                return resetButton();
            },
        })
    }
});