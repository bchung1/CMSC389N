<?php
require_once("../util.php");
$db = connectToSchedulerDB();
session_start();
$name = $_GET["name"];
$events_query = deleteEvent($db, $_SESSION['username'],$name);
echo "done";
?>