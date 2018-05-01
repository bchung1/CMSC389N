var colors = {Exam: "#87CEFA", Meeting: "#FFE4E1", Homework: "#6A5ACD", Project: "#FFA07A", Work: "#FF7F50"};

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

            $('.message').html("Adding event...");

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


function getEvents(){ 
     $.ajax({
        type: 'get',
        url: 'getEvents.php',
        data: {},
        success: function(data) {
            populateTable(data);
        }
    });
}

function populateTable(data){
    let events = JSON.parse(data); 
    console.log(events);
    for(let row of events){
        let dateStr = row["StartDate"];
        let startTimeStr = row["startTime"];
        let endTimeStr = row["endTime"];
        let color = row['Color'];
        let name = row['Name'];
        let startTimeStrCut = startTimeStr.substring(0, startTimeStr.length - 3);
        let date = new Date(dateStr);
        let day = date.getUTCDay();
        let startTime = new Date('Jan 1, 2018' + ' ' + startTimeStr);
        let endTime = new Date('Jan 1, 2018' + ' ' + endTimeStr);
        let minutes = Math.floor((endTime.getTime() - startTime.getTime() ) / 60000);
        let numCells = minutes / 30; 
        console.log(numCells);

        let id = day + "_" + startTimeStrCut;
        let percent = 100 * numCells;
        let eventCell = document.getElementById(id); 
        eventCell.style.background = color;
        eventCell.innerHTML = name; 
        eventCell.style.color = '#FFFFFF';
        eventCell.style.borderColor = color;
        // var div = "<div class='event text-center' class='checkbox' style='background:" + color + ";width:100%;height:"+ percent + "%;'><input id='check' type='checkbox' class='checkbox'/><label for='check'></label>" + name + "</div>";
        // var div = "<div class='event text-center' class='checkbox'><input id='check' type='checkbox' class='checkbox'/><label for='check'></label>" + name + "</div>";
        let newDate = startTime;
        for(let i = 1; i < numCells; i++){
            newDate =  new Date(newDate.getTime() + 30*60000);
            newDateCut = newDate.toTimeString().substring(0,5);
            let currID = day + "_" + newDateCut;
            let eventCell = document.getElementById(currID);
            eventCell.style.background = color;
            eventCell.style.borderColor = color; 
        }
    }
}


