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

     <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
     <title> Forgot Password </title>

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
	                        <li><a href="../contact/contact.php">contact</a></li>
	                        <li><a href="../about/about.html">about</a></li>
                          <li><a href="https://medium.com/@clearmaze" target="blank">blog</a></li>
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
require 'db_connect.php';

function getRandomString($length) {
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";

    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
	return $result;
}


if(!isset($_GET['email'])){ ?>

	  <form action="forgotpassword.php" class="form-signin">
        <h3><label for="enterEmail">Enter Email Address</label></h3>
        <input id="enterEmail" class="form-control" aria-describedby="emailHelp" type="text" name="email" placeholder="Enter Email">
	      <input class="btn btn-primary" type="submit" value="Reset My Password" >
	  </form>

    <?php exit();
}

$email=$_GET['email'];


$q="SELECT email from users where email='".$email."'";
$r=$db->query($q);
$n=$r->rowcount();

if($n==0){echo "Email id is not registered.";die();}
$token=getRandomString(10);

$q="INSERT into tokens (token,email) values ('".$token."','".$email."')";

$exec1 = $db->exec($q);

function mailresetlink($to,$token){
$subject = "Forgot Password on Clearmaze.net";
$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
$message = '
<html>
<head>
<title>Forgot Password For Clearmaze</title>
</head>
<body>
<p>Click on the given link to reset your password <a href="'.$uri.'/login/reset.php?token='.$token.'">Reset Password</a></p>

</body>
</html>
';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: Clearmaze Technologies<admin@clearmaze.net>' . "\r\n";

if(mail($to,$subject,$message,$headers)){
	echo "<h4>We have sent the password reset link to your  email id at <b>".$to."</b></h4>";
}}

if(isset($_GET['email']))mailresetlink($email,$token);

?>

</div>
