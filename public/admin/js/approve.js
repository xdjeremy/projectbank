$('.approve').click(function (e){
    var id = e.target.id;
    $.ajax({
        type: "post",
        url: "ajax/approval_process",
        data: {
            id: id
        },
        success: function () {
            window.location.replace("approval");
            return;
        },
        error: function (e) {
            console.log(e);
        }
    })
});
