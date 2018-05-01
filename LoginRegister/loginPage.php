<?php
session_start();
require_once("../util.php");
$loginMessage = "";

$table = "login";
$db = connectToSchedulerDB();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = sha1(trim($_POST['password']));

    if ($username == "" || $password == "") {
        $loginMessage = "<br>No username or password entered";
    }

    else {
        $sqlQuery = "select * from $table where Username = '{$username}' AND Password = '{$password}'";
        $result = mysqli_query($db, $sqlQuery);
        if ($result) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows == 0) {
                $loginMessage = "<strong>No entry exists in the database for the specified username and password</strong>";
            } else {
                $_SESSION['username'] = $username;
                mysqli_free_result($result);
                header("Location: ../Calendar/calendar2.php");
            }
        } else {
            $loginMessage = "Retrieving records failed." . mysqli_error($db);
        }
        $loginMessage = "<br>Incorrect username or password";
    }
}

$form = <<<EOPAGE
<!doctype html>
<html>
  <head>
    <title>Login</title>
    <meta charset="utf-8" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container" style="margin-top:30px">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title" id="header">Sign In</h3></div>
                <div class="panel-body">
                    <form action="{$_SESSION["PHP_SELF"]}" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" style="border-radius:0px" id="username" name="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" style="border-radius:0px" id="password" name="password" placeholder="Enter password">
                        </div>
                        <input type="submit" name="submit" class="btn btn-sm btn-default"> &nbsp;
                        Not a member yet? <a href="registerPage.php">Register</a> now
                    </form>


EOPAGE;

$end = <<<EOPAGE
                </div>
            </div>
        </div>
    </div>
 </body>
<html>
EOPAGE;


echo $form;
echo $loginMessage;
echo $end;
?>
