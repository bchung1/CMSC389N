<?php

session_start();
require_once("../util.php");

$table = "users";
$db = connectToSchedulerDB();
$sqlQuery = "";

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$username = $_SESSION["username"];
$password = sha1($_POST["password"]);


if ($password != "") {
    $sqlQuery = "update $table set FirstName='$firstname', LastName='$lastname', Password='$password' where Username='$username'";
}

else {
    $sqlQuery = "update $table set FirstName='$firstname', LastName='$lastname' where Username='$username'";
}

echo $sqlQuery;

$result = mysqli_query($db, $sqlQuery);
mysqli_free_result($result);
?>

