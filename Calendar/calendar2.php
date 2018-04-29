<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
    <script src="calendar.js"></script>
</head>
<body>
  <div class="calendar">
    <header>
      <button class="secondary" style="align-self: flex-start; flex: 0 0 1">Today</button>
      <div class="calendar__title" style="display: flex; justify-content: center; align-items: center">
        <div class="icon secondary chevron_left">‹</div>
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
