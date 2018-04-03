<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<link rel="stylesheet" href="calendar.css">
<body>
  <div class="calendar">

    <header>
      <button class="secondary" style="align-self: flex-start; flex: 0 0 1">Today</button>
      <div class="calendar__title" style="display: flex; justify-content: center; align-items: center">
        <div class="icon secondary chevron_left">‹</div>
        <h1 class="" style="flex: 1;"><span></span><strong>1 April – 7 April</strong> 2018</h1>
        <div class="icon secondary chevron_left">›</div>
      </div> 
      <div style="align-self: flex-start; flex: 0 0 1"></div>
    </header>

    <div class="outer">


      <table>
        <thead>
          <tr>
            <th class="headcol"></th>
            <th>April, 1</th>
            <th>April, 2</th>
            <th class="today">April, 3</th>
            <th>April, 4</th>
            <th>April, 5</th>
            <th class="secondary">April, 6</th>
            <th class="secondary">April, 7</th>
          </tr>
        </thead>
      </table>

      <div class="wrap"> 
        <table class="offset">

          <tbody>
           <?php
           require_once("util.php");
           $db = connectToSchedulerDB();
           $events = getEvents($db);
           $day = date('w');
           $week_start = date('m-d-Y', strtotime('-'.$day.' days'));
           $week_end = date('m-d-Y', strtotime('+'.(6-$day).' days'));

           $time = strtotime('6:00');

           for($i = 1; $i <= 36;$i++){
             $time_formatted = date("H:i", $time);
             $event_row = "<tr><td class='headcol'>".$time_formatted."</td>";
             for($j=1; $j<=7; $j++){
              $event_div = "<td></td>";
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
                  $event_div = "<td><div class='event'><input id='check' type='checkbox' class='checkbox' /><label for='check'></label>".$name."</div></td>";
                  
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