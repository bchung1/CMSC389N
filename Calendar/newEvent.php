<?php

session_start();
require_once("../util.php");

$table = "events";
$db = connectToSchedulerDB();

$name = $_POST["name"];
$username = $_SESSION["username"];
$tag = $_POST["tag"];
$color = $_POST["color"];
$time = $_POST["time"];
$time = (int)$time;
$dueDate = $_POST["dueDate"];
$startDate = $_POST["startDate"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];


$sqlQuery = "insert into $table (name, username, tag, color, time, duedate, startdate, startTime, endTime) values ";
$sqlQuery .= "('$name', '$username', '$tag', '$color', $time, '$dueDate', '$startDate', '$startTime', '$endTime')";
$result = mysqli_query($db, $sqlQuery);
mysqli_free_result($result);
?>

