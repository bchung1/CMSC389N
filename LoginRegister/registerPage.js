$(document).ready(function() {
    $('#register').submit(function (e) {
        submitForm(e);
    });

});

function submitForm(e) {
    var password = document.getElementById("password").value;
    var verify = document.getElementById("verify").value;
    var file = $("#image")[0].files[0];
    var fileType = file["type"];
    var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
    var message = "";

    if ($.inArray(fileType, ValidImageTypes) < 0) {
        message += "<br>Wrong file type uploaded. Please upload image";
    }

    if (password !== verify) {
        message += "<br>Passwords don't match";
    }


    if (message !== "") {
        $('.message').html(message);
        e.preventDefault();
    }

    else {
        return true;
    }
}