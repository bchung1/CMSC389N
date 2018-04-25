<?php
  session_start();
  require_once("util.php");
  $loginMessage="";

  $host = "localhost";
  $user = "dbuser";
  $password = "cmsc389n";
  $database = "scheduler";
  $table = "login";
  $db = connectToDB($host, $user, $password, $database);

  if(isset($_POST['event'])){
    if($_POST['event'] == "New User"){
      header("Location: addNewUser.php");
    }
  }

  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = trim($_POST['username']);
    $password = sha1(trim($_POST['password']));
    $sqlQuery = "select * from $table where Username = '$username' AND Password = '$password'";
    $result = mysqli_query($db, $sqlQuery);
    if ($result) {
      $numberOfRows = mysqli_num_rows($result);
      if ($numberOfRows == 0) {
        $loginMessage="<strong>No entry exists in the database for the specified username and password</strong>";
      } else {
        $_SESSION['username'] = $username;
        mysqli_free_result($result);
        header("Location: calendar2.php");
      }
    }

      else {
        $loginMessage = "Retrieving records failed.".mysqli_error($db);
      }

  }

$self = $_SERVER["PHP_SELF"];
    $form = <<<EOPAGE
<!doctype html>
<html>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <head>
    <title>Login</title>
    <meta charset="utf-8" />
  </head>
  <body>
    <form action = '$self' method = 'post'>
      <p>
        <b>Username:</b><input type='text' name='username' class ="form-control"/></br></br>
        <b>Password:</b><input type='password' name='password' class ="form-control"/></br></br>
        <input type='submit' name = 'event' value='Login' class ="form-control" />
        <input type='submit' name = 'event' value='New User' class ="form-control" />
      </p>
   </form>
 </body>
<html>
EOPAGE;

echo $form;
echo $loginMessage;
?>
