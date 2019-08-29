<?php

session_start();
require 'db_connect_admin.php';

$error = false;

//if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST["email"]);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $password = trim($_POST["password"]);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);
  // prevent sql injections / clear user invalid inputs

  if(empty($email)){
   $error = true;
   $errMSG = "Please enter your email address.";
   echo $errMSG;
  } else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
   $error = true;
   $errMSG = "Please enter valid email address.";
   echo $errMSG;
  }

  if(empty($password)){
   $error = true;
   $errMSG = "Please enter your password.";
   echo $errMSG;
  }

  // if there's no error, continue to login
  if (!$error) {

   $password = hash('sha256', $password); // password hashing using SHA256

   $login_query = $db -> query("SELECT id, firstName FROM users WHERE email = '$email' and pass = '$password'");

   while ($row_login = $login_query -> fetch()) {
     $loginReturn = $row_login[0];
     $firstName = $row_login[1];
   }

   //gets user first name
   $_SESSION["firstName"] = $firstName;

   if ($loginReturn != null) {
     $_SESSION["user"] = $loginReturn;
     header("Location: home.php");
   } else {
     # code...
     $errMSG = "Incorrect Credentials ... Please Try Again!";
     echo $errMSG;
   }

  }

 //}

 ?>
