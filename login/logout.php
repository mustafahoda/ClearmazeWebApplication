<?php
 session_start();

 if (!isset($_SESSION["user"])) { //if session is not set, redirect to login.php
  header("Location: ../index.html");
} else if(isset($_SESSION['user'])!="") { // if session is not equal to blank then redirect ot home.php
  unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: ../index.html");
 }

 //if logout is set, then destroy the session and redirect to login.php
 if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: ../index.html");
  exit;
 }

 ?>
