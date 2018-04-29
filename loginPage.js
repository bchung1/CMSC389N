window.onsubmit = validate;

function toggleClick() {
    var buttonValue, headerValue;

    if (document.getElementById("toggle").value === "Sign In") {
        buttonValue = "Register";
        headerValue = "Sign In";
    }

    else {
        buttonValue = "Sign In";
        headerValue = "Register";
    }

    document.getElementById("header").innerHTML = headerValue;
    document.getElementById("toggle").value = buttonValue;
}

function validate() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var invalidMessage = "";

    if (username === "" || password === "") {
        invalidMessage += "Please enter username and password";
    }


    if (invalidMessage !== "") {
        alert(invalidMessage);
        return false;
    }

    else {
        return true;
    }
}