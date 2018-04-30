<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Order Confirmation</title>
</head>

<body>




<h1>Order Confirmation</h1>

<div class="container-fluid">
    <?php

    session_start();
    require_once("../util.php");
    $loginMessage = "";

    $table = "events";
    $db = connectToSchedulerDB();

    $sqlQuery = "insert into $table (username, tag, color, timediff, duedate, startdate, startime, endtime) values";
    $sqlQuery .= "('{$_SESSION['username']}', '{$_POST['tag']}'), '{$_POST['color']}, '{$_POST['startime']}'";
    $result = mysqli_query($db, $sqlQuery);
    $startTime = new DateTime($_POST['startTime']);
    $endTime = new DateTime($_POST['endTime']);


    echo $startTime->diff($endTime)->format('%i second(s)');

    echo $_POST['startTime'] - $_POST['endTime'];
    echo $_POST['endTime'];
    ?>

    <table class="table">
        <thead>
        <tr>
            <th>Software</th>
            <th>Cost</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>

</body>
</html>
