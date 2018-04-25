<?php

$servername = "localhost";
$username = "dbuser";
$password = "cmsc389n";
$dbname = "scheduler";


// Create connection to new database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "INSERT INTO `events` (`Name`, `Username`, `Tag`, `Color`, `Time`, `DueDate`, `StartDate`, `startTime`, `endTime`) VALUES
('414', 'brian', 'Exam', 'blue', 120, '2018-04-03', '2018-04-10', '09:00:00', '11:00:00'),
('414', 'collin', 'Exam', 'blue', 180, '2018-04-05', '2018-04-16', '15:00:00', '17:30:00'),
('CMSC389N Exam\r\n', 'jake', 'Exam', 'blue', 120, '2018-04-03', '2018-04-10', '09:00:00', '11:00:00'),
('CMSC414 Project Meeting', 'jake', 'Meeting', 'blue', 180, '2018-04-05', '2018-04-16', '15:00:00', '17:30:00'),
('CMSC422 Exam', 'jake', 'Exam', 'blue', 120, '2018-04-06', '2018-04-10', '18:00:00', '19:00:00')";


if ($conn->query($sql) === TRUE) {
    echo "Data Entered successfully\n";
} else {
    echo "Error adding events: " . $conn->error;
}
$password = sha1("password");
$sql = <<<EOLINE
INSERT INTO login (Username, Password) VALUES
('jake', '$password'), ('brian', '$password'), ('collin', '$password')
EOLINE;

if ($conn->query($sql) === TRUE) {
    echo "Data Entered successfully\n";
} else {
    echo "Error entering login info: " . $conn->error;
}

$conn->close();



 ?>
