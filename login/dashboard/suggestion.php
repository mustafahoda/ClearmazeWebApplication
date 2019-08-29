<?php

session_start();
include '../db_connect.php';


$user_cc = $_SESSION['cc'];
$suggested_uni = "Trinity Christian College";
$suggested_majorCode = trim($_POST['suggestedMajorCode']);
$user = $_SESSION["user"];

$queryFindMajor = $db -> query("SELECT major FROM clearmaze_courses.majors WHERE abv = '$suggested_majorCode';");

while($temp = $queryFindMajor -> fetch()){
  $suggested_major = $temp[0];
}

$queryUserEmail = $db ->query("SELECT email FROM users WHERE id = '$user';");//gets user email from ID

while($temp = $queryUserEmail -> fetch()){
  $user_email = $temp[0];
}

$querySuggestion = "INSERT INTO clearmaze_users.combinations(combo1_uni, combo1_cc, combo1_major, email, time_access, recommended) VALUES ('$suggested_uni', '$user_cc', '$suggested_major', '$user_email', now(), 'Y');";

$conn = $db -> exec($querySuggestion);

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <h2>Thanks ... we have recorded that suggestion</h2>
    <h3>you may close this tab</h3>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
