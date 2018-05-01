<?php 
require_once("../util.php");
$db = connectToSchedulerDB();
session_start();
$events = getEvents($db, $_SESSION['username']);
// print $events;
// while($row = $events->fetch_row()){
// 	$name = $row[0];
// 	$dueDate = $row[5];
// 	$startTime = $row[7];
// 	$endTime = $row[8];
// 	$color = $row[3];
// 	$dueDateNum = convertDateToNum($dueDate);
// }

$rows = array();
while($r = mysqli_fetch_assoc($events)) {
    $rows[] = $r;
}

print json_encode($rows);

?>