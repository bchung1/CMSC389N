<?php
$servername = "localhost";
$username = "dbuser";
$password = "cmsc389n";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE scheduler";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

$dbname = "scheduler";


// Create connection to new database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE login (
Username VARCHAR(30) NOT NULL PRIMARY KEY,
Password VARCHAR(60) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table login created successfully\n";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE `events` (
  `Name` varchar(150) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Tag` varchar(20) NOT NULL,
  `Color` char(7) NOT NULL,
  `Time` int(11) NOT NULL,
  `DueDate` date NOT NULL,
  `StartDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


if ($conn->query($sql) === TRUE) {
    echo "Table events created successfully\n";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
