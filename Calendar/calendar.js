var colors = {Exam: "blue", Meeting: "purple", Homework: "green", Project: "red", Work: "pink"};

function submitEvent() {
    var name = document.getElementById("name").value;
    var startTime = document.getElementById("startTime").value + ":00";
    var endTime = document.getElementById("endTime").value + ":00";
    var date = document.getElementById("date").value;
    var tag = document.getElementById("tag").value;
    var color = colors[tag];

    if (name !== "" && startTime !== "" && endTime !== "" && date !== "") {
        if (startTime < endTime) {
            var start = new Date(date + " " + startTime);
            var end  = new Date(date + " " + endTime);
            var timediff = Math.round((end.getTime() - start.getTime())/60000);

            $.ajax({
                type: 'POST',
                url: "newEvent.php",
                data: {name: name,
                tag: tag,
                color: color,
                time: timediff,
                dueDate: date,
                startDate: date,
                startTime: startTime,
                endTime: endTime
                },
                dataType: "text",
                success: function(resultData) {
                    $('.message').html("Adding event...");
                    window.location.replace("calendar2.php");
                }
            });
        }

        else {
            $('.message').html("Invalid times");
            return false;
        }
    }

    else {
        $('.message').html("Please fill out all fields");
        return false;
    }

    return false;
}
