<?php

session_start();
include '../db_connect.php';

$user_cc = $_SESSION['cc'];
$user_uni = $_SESSION['uni'];
$user_major = trim($_GET['major']);
$user = $_SESSION["user"];

$queryUserEmail = $db ->query("SELECT email FROM users WHERE id = '$user';");//gets user email from ID

while($temp = $queryUserEmail -> fetch()){
  $user_email = $temp[0];
}
//$queryUpdatePrintLog = "UPDATE combinations SET printed='Y' WHERE combo1_uni='University of Illinois at Chicago' AND combo1_cc='College of DuPage' AND combo1_major='Computer Science' AND email='vadrevu2@uic.edu';";


$queryUpdatePrintLog = "UPDATE combinations SET printed='Y' WHERE combo1_uni='$user_uni' AND combo1_cc='$user_cc' AND combo1_major='$user_major' AND email='$user_email';";

$conn = $db -> exec($queryUpdatePrintLog);

 ?>
