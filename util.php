<?php
function getEvents($db, $username){
	$day = date('w');
	$week_start = date('m-d-Y', strtotime('-'.$day.' days'));
	$week_end = date('m-d-Y', strtotime('+'.(6-$day).' days'));

	$events_query = "select * from events where Username = \"".$username."\"";
	$events = mysqli_query($db, $events_query);
	return $events;
}

function deleteEvent($db, $username, $name){
	$events_query = "delete from events where Username = \"".$username."\" and Name = \"".$name."\"";
	$events = mysqli_query($db, $events_query);
	return $events_query;
}

function connectToDB($host, $user, $password, $database) {
	$db = new mysqli($host, $user, $password, $database);
	if ($db->connect_errno) {
		echo "Connect failed.\n".$db->connect_errno;
		exit();
	}
	return $db;
}

// function generatePage($body,$title) {
//     $page = <<<EOPAGE
//  <!DOCTYPE html>
//     <html lang="en">
//     <head>
//         <meta charset="UTF-8">
//         <title>$title</title>
//     </head>
//     <body>
//     	$body
//     </body>
//     </html>
// EOPAGE;

//     return $page;
// }

function convertDateToNum($date) {
	$unixTimestamp = strtotime($date);
	$dayOfWeek = date("l", $unixTimestamp);
	$day_num = date('N', strtotime($dayOfWeek));
	return $day_num;
}

function connectToSchedulerDB() {
	$host = "localhost";
	$user = "dbuser";
	$password = "cmsc389n";
	$database = "scheduler";
	$db = connectToDB($host, $user, $password, $database);
	return $db;
}

?>
