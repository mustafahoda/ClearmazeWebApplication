<!DOCTYPE html>

<html>

  <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <meta name="description" content="">
     <meta name="author" content="">
     <link rel="icon" href="../../favicon.ico">

     <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
     <title> Welcome to Clearmaze Technologies </title>

     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="loginStyle.css">

  </head>


	  <body>

  <div id="container">
        <div class="container-fluid">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid blacktext" id="navContainer">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="../index.html"><img src="../assets/logoColorFull.svg" style="height:100%;"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                          <li><a id="transferbtn" href="../transfer/transfer.php">
                            <div>transfer</div>
                          </a></li>
                          <li><a href="../contact/contact.php">contact</a></li>
                          <li><a href="../about/about.html">about</a></li>
                          <li><a href="http://www.clearmaze.tumblr.com" target="blank">blog</a></li>
                          <li><a id = "loginbtn" href="../login/login.php">
                            <div id = "logintext">login</div>
                          </a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>


	<div id="form-wrapper">

<?php

session_start();
$token=$_GET['token'];

require "db_connect.php";

$q="SELECT email FROM tokens WHERE token='".$token."'";
  $r=$db->query($q);

while($temp = $r->fetch())
   {
      $email=$temp[0];
   }

// if ($email!=''){
//           $_SESSION['email']=$email;
// }
// else die("Invalid link or Password already changed");}

// $pass=$_POST['password'];
// $email=$_SESSION['email'];
// if(!isset($pass)){

?>

<form method="post" class="form-signin">
  <h3><label> Enter New Password </label></h3>

  <input class="form-control" type="password" name="password1" placeholder="Enter Password">
  <input class="form-control" type="password" name="password2" placeholder="Password Confirm">
  <input class="btn btn-primary" type="submit" value="Change Password">
</form>

<?php
$pass = trim($_POST["password1"]);
$pass = strip_tags($pass);
$pass = htmlspecialchars($pass);

$pass2 = trim($_POST["password2"]);
$pass2 = strip_tags($pass2);
$pass2 = htmlspecialchars($pass2);


if (strlen($pass) < 6) {
  # code...
  $error = true;
  $passError1 = "Password must be at least 6 characters.";
} elseif ($pass != $pass2) {
  # code...
  $error = true;
  $passError2 = "Passwords do not match!";
}

if (!$error) {
  $hashedPass = hash('sha256', $pass);
  $q="UPDATE users set pass='".$hashedPass."' where email='".$email."'";
  $exec2=$db->exec($q);
  $q="DELETE FROM tokens where token='".$token."' and email='".$email."'";
  $exec3=$db->exec($q);
  echo "You have successfully changed your password!";
} else {
  echo $passError1;
  echo "<br>";
  echo $passError2;
}

?>

</div>
