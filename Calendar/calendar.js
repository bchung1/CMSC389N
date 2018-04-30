function submitEvent() {
    var name = document.getElementById("name").value;
    var startTime = document.getElementById("startTime").value;
    var endTime = document.getElementById("endTime").value;
    var date = document.getElementById("date").value;

    if (name !== "" && startTime !== "" && endTime !== "" && date !== "") {
        if (startTime < endTime) {
            return true;
        }

        else {
            alert("Invalid times");
            return false;
        }
    }

    else {
        alert("Please fill out all fields");
        return false;
    }

    return false;
}
