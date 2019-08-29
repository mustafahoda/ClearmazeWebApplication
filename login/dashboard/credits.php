<?php
session_start();
include 'db_connect_clearmaze.php';

$user_cc = $_SESSION['cc'];
$user_uni = $_SESSION['uni'];
$user_major = trim($_GET['major']);
$user = $_SESSION["user"];

$queryCreditHours = $db -> query("SELECT credit_hours FROM majors WHERE major = '$user_major' and university = '$user_uni';");
while($temp = $queryCreditHours->fetch()){
  $credits = $temp[0];
}

// $queryGPA = $db ->query("SELECT gpa FROM majors WHERE university = '$user_uni' and major = '$user_major';");
// while($temp = $queryGPA->fetch()){
//   $GPA = $temp[0];
// }

$queryTransferCredits = $db -> query("SELECT creditsComplete FROM transferCredits WHERE uni = '$user_uni' and cc = '$user_cc' and major = '$user_major';");
while ($temp = $queryTransferCredits -> fetch()) {
  $transferCredits = $temp[0];
}

$queryMinGPAreq = $db->query("SELECT min_gpa FROM universities WHERE university = '$user_uni';");
while ($temp = $queryMinGPAreq-> fetch()) {
  $minGPAreq = $temp[0];
}

$queryMinGPArecc = $db->query("SELECT min_recc_gpa FROM majors WHERE university = '$user_uni' and major = '$user_major';");
while ($temp = $queryMinGPArecc-> fetch()) {
  $minGPArecc = $temp[0];
}

$queryMaxGPArecc = $db->query("SELECT max_recc_gpa FROM majors WHERE university = '$user_uni' and major = '$user_major';");
while ($temp = $queryMaxGPArecc-> fetch()) {
  $maxGPArecc = $temp[0];
}

echo $credits."/".$transferCredits."/";
echo $minGPAreq."/".$minGPArecc."/".$maxGPArecc."/";


$db = null; //close DB Connection

//------------------------Code to Keep Track of Combinations per User---------------------------------------
include '../db_connect.php'; //opens up user database connection

$queryUserEmail = $db ->query("SELECT email FROM users WHERE id = '$user';");//gets user email from ID

while($temp = $queryUserEmail -> fetch()){
  $user_email = $temp[0];
}
//echo $user_email;

$queryAddCombination = "INSERT INTO combinations(combo1_uni, combo1_cc, combo1_major, email, time_access, recommended) VALUES ('$user_uni', '$user_cc', '$user_major', '$user_email', now(), 'N');";
//
$conn = $db -> exec($queryAddCombination);


?>
