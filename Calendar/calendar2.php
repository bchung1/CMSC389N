<?php
session_start();

$errorMessage = "";

if (isset($_POST["submit"])) {
//
//    if ($_POST["name"] == "" || $_POST["startTime"] == "" || $_POST["endTime"] == "" || ($_POST["date"]) == "" || $_POST["tag"] == "") {
//        $errorMessage = "Please fill out all fields";
//    }
//
//    else {
//        session_start();
//        require_once("../util.php");
//        $loginMessage = "";
//
//        $startTime = new DateTime($_POST['startTime']);
//        $endTime = new DateTime($_POST['endTime']);
//        $timediff = ($endTime->getTimestamp() - $startTime->getTimestamp()) / 60;
//
//        $table = "events";
//        $db = connectToSchedulerDB();
//
//        $sqlQuery = "insert into $table (username, tag, color, timediff, duedate, startdate, startime, endtime) values";
//        $sqlQuery .= "('{$_SESSION['username']}', '{$_POST['tag']}'), '{$_POST['color']}, '{$timediff}, '{$_POST['date']}', '{$_POST['date']}, '{$_POST['startTime']}, '{$_POST['endTime']}";
//        $result = mysqli_query($db, $sqlQuery);
//
//    }

//    header("Location: newEvent.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="calendar.js"></script>
</head>
<body>
  <div class="calendar">
    <header>
<!--      <button class="secondary" style="align-self: flex-start; flex: 0 0 1">Today</button>-->
            <!-- Button to Open the Modal -->
            <button type="button" class="secondary" style="align-self: flex-start; flex: 0 0 1" onclick="$('#myModal').modal({'backdrop': 'static'});">
                New Event
            </button>

            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form action="calendar2.php" method="post">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Event</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <label for="name">Event name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <br>

                            <label for="startTime">Start time</label>
                            <input type="time" class="form-control col-4" id="startTime" name="startTime"">
                            <br>

                            <label for="endTime">End time</label>
                            <input type="time" class="form-control col-4" id="endTime" name="endTime"">
                            <br>

                            <label for="date">Date</label>
                            <input type="date" class="form-control col-5" id="date" name="date"">
                            <script>
                                document.getElementById('date').valueAsDate = new Date();
                            </script>
                            <br>

                            <label for="tag">Tag</label>
                            <select class="form-control col-4" id="tag" name="tag">
                                <option value="Exam">Exam</option>
                                <option value="Meeting">Meeting</option>
                            </select>
                            <br>

                            <label for"color>Color</label>
                            <input type="text" class="form-control col-4" id="color" name="color">
                            <br>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit" onclick="submitEvent()";>Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <?php
                            echo $errorMessage;
                            ?>
                        </div>
                        </form>

                    </div>
                </div>
            </div>



        <div class="calendar__title" style="display: flex; justify-content: center; align-items:
       center">
        <div class="icon secondary chevron_right">‹</div>
        <h1 class="" style="flex: 1;"><span></span>
                <?php
                $dateArray = getdate(date("U"));
                $startDate = "";
                $endDate = "";

                if ($dateArray[weekday] == "Sunday") {
                    $startDate = strtotime("this sunday");
                    $startDate = date('M d', $startDate);
                    $endDate = strtotime("this saturday");
                    $endDate = date('M d', $endDate);
                }

                else {
                    $startDate = strtotime("last sunday");
                    $startDate = date('M d', $startDate);
                    $endDate = strtotime("this saturday");
                    $endDate = date('M d', $endDate);
                }
                echo "<strong>$startDate - $endDate</strong>";
                echo "</strong> $dateArray[year]";
                ?>
            </h1>
        <div class="icon secondary chevron_left">›</div>
      </div>
      <div style="align-self: flex-start; flex: 0 0 1"></div>
    </header>

    <div class="outer" style='background: white;'>


      <table>
        <thead>
          <tr>
              <?php
              $dateArray = getdate(date("U"));
              $startDate;
              $endDate;

              if ($dateArray[weekday] == "Sunday") {
                  $startDate = strtotime("this sunday");
              }

              else {
                  $startDate = strtotime("last sunday");
              }

              echo "<th class=\"headcol\"></th>";

              for ($i = 0; $i < 7; $i++) {
                $date = strtotime("+$i day", $startDate);
                $date = date('M d', $date);
                $today = "";

                if ($date == date('M d', strtotime("today"))) {
                    $today = "class=\"today\"";
                }
                echo "<th $today>$date</th>";
              }
              ?>
          </tr>
        </thead>
      </table>

      <div class="wrap">
        <table class="offset">

          <tbody>
           <?php
           session_start();
           require_once("../util.php");
           $db = connectToSchedulerDB();
           $events = getEvents($db, $_SESSION['username']);
           $day = date('w');

           $time = strtotime('6:00');

           for($i = 1; $i <= 36;$i++){
             $time_formatted = date("H:i", $time);
             $event_row = "<tr><td class='headcol'><p style='margin-top: 6px;'>".$time_formatted."</p></td>";
             for($j=1; $j<=7; $j++){
              $event_div = "<td class='cell' onclick='a()'; style='background: white;'></td>";
              // echo $event_div;
              mysqli_data_seek($events, 0);
              while($row = $events->fetch_row()){
                $name = $row[0];
                $dueDate = $row[5];
                $startTime = $row[7];
                $endTime = $row[8];
                $dueDateNum = convertDateToNum($dueDate);
                // echo $dueDate;
                // echo " ";
                // echo $dueDateNum;
                // echo " ";


                // echo "Time: ".strtotime($time_formatted)." StartTime: ".strtotime($startTime)." "."EndTime: ".strtotime$endTime);

                if($dueDateNum == $j && strtotime($time_formatted) >= strtotime($startTime) && strtotime($time_formatted) <= strtotime($endTime)){
                  $event_div = "<td><div class='event'><input id='check' type='checkbox' class='checkbox'/><label for='check'></label>".$name."</div></td>";

                }
              }
              $event_row = $event_row.$event_div;
            }
            $event_row = $event_row."</tr>";
            echo $event_row;
            $time = strtotime('+30 minutes', $time);
          }


          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>

