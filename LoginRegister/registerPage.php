<?php
session_start();
require_once("../util.php");
$loginMessage = "";

$table = "users";
$db = connectToSchedulerDB();

if (isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = sha1(trim($_POST['password']));
    $verify = sha1(trim($_POST['verify']));
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    if ($password == $verify) {
        $sqlQuery = "insert into $table (firstname, lastname, username, password, image) values";
        $sqlQuery .= "('{$firstname}', '{$lastname}', '{$username}', '{$password}', '{$image}')";
        $result = mysqli_query($db, $sqlQuery);
        mysqli_free_result($result);
        header("Location: loginPage.php");
    }

    else {
        $loginMessage = "<br>Passwords don't match";
    }
}

$form = <<<EOPAGE
<!doctype html>
<html>
  <head>
    <title>Register</title>
    <meta charset="utf-8" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="registerPage.js"></script>
  </head>
  <body>
    <div class="container" style="margin-top:30px">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title" id="header">Register</h3></div>
            <div class="panel-body">
                <form action="registerPage.php" method="post" id="register" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="verify">Verify password</label>
                        <input type="password" class="form-control" id="verify" name="verify" placeholder="Verify password" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Select profile picture</label>
                        <input type="file" id="image" name="image" style="line-height: 10px;" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-sm btn-default"> &nbsp;
                    Already a member? <a href="loginPage.php">Login</a> now
                    
                </form>
                <div class="message"></div>
            </div>
        </div>
    </div>
</div>
 </body>
<html>
EOPAGE;

echo $form;
echo $end;
?>
