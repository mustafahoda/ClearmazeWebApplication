<?php
session_start();
include 'db_connect.php';
$start = $_GET['startdate'];
$token = strtok($start, "/");
$month = $token;
$token = strtok("/");
$day = $token;
$token = strtok("/");
$year = $token;
$startDateForSQL = $year."-".$month."-".$day;

//---------------------------------------------------------------------------
$queryNumberOfStudentsAccessed = $db->query("SELECT count(DISTINCT email) FROM user_activity WHERE time >= '$startDateForSQL' AND time <= NOW();");
while($temp=$queryNumberOfStudentsAccessed->fetch()) {
  $numStudentsAccessed = $temp[0];
}
//---------------------------------------------------------------------------
$queryNumberMale = $db->query("SELECT count(gender) FROM users WHERE gender = 'male';");
while($temp=$queryNumberMale->fetch()) {
  $numMale = $temp[0];
}
$queryNumberFemale = $db->query("SELECT count(gender) FROM users WHERE gender = 'female';");
while($temp=$queryNumberFemale->fetch()) {
  $numFemale = $temp[0];
}
//---------------------------------------------------------------------------
$queryAVGGPA = $db->query("SELECT AVG(gpa) FROM users;");
while($temp=$queryAVGGPA->fetch()) {
  $avgGPA = $temp[0];
}
//---------------------------------------------------------------------------
$queryNumberPrint = $db->query("SELECT count(DISTINCT email) FROM combinations WHERE printed='Y' AND time_access >= '$startDateForSQL' AND time_access <= NOW();");
while($temp=$queryNumberPrint->fetch()) {
  $numPrint = $temp[0];
}
$queryNumLogIn = $db->query("SELECT count(DISTINCT email) FROM combinations WHERE time_access >= '$startDateForSQL' AND time_access <= NOW();");
while ($temp=$queryNumLogIn->fetch()) {
  $numTotalLogIn = $temp[0];
}
$percentPrint = round(($numPrint/$numTotalLogIn)*100);
//---------------------------------------------------------------------------
$queryNumFromSchool1 = $db->query("SELECT count(email) FROM users WHERE highSchool='Colton High School';");
while ($temp=$queryNumFromSchool1->fetch()) {
  $numHighSchool1 = $temp[0];
}
$queryNumFromSchool2 = $db->query("SELECT count(email) FROM users WHERE highSchool='San Bernadino Valley School';");
while ($temp=$queryNumFromSchool2->fetch()) {
  $numHighSchool2 = $temp[0];
}
$queryNumFromSchool3 = $db->query("SELECT count(email) FROM users WHERE highSchool='Riverside High School';");
while ($temp=$queryNumFromSchool3->fetch()) {
  $numHighSchool3 = $temp[0];
}
//---------------------------------------------------------------------------
 $i = 0;
 $total = 0;
 $queryNumMajorsSearched = $db->query("SELECT combo1_major,count(combo1_major) FROM combinations WHERE time_access >= '$startDateForSQL' AND time_access <= NOW() GROUP BY combo1_major ORDER BY count(combo1_major);");
 while($temp=$queryNumMajorsSearched->fetch()) {
   $majorLabels[$i] =$temp[0];
   $total = $total + $temp[1];
   $numOfMajorLabel[$i] = $temp[1];
   $i = $i + 1;
 }
 $i = 0;
 $count = count($majorLabels);
 while ($i < $count) {
   $numOfMajorLabel[$i] = ROUND(($numOfMajorLabel[$i]/$total)*100);
   $i = $i + 1;
 }
//---------------------------------------------------------------------------
$queryAvgAge = $db->query("SELECT FLOOR(AVG(TIMESTAMPDIFF(YEAR,dob,NOW()))) FROM users;");
while ($temp=$queryAvgAge->fetch()) {
  $avgAge = $temp[0];
}
//---------------------------------------------------------------------------
$queryAvgTimeVisited = $db->query("SELECT FLOOR(AVG(TIMESTAMPDIFF(MONTH,time_access,NOW()))) FROM combinations WHERE time_access >= '$startDateForSQL';");
while($temp=$queryAvgTimeVisited->fetch()) {
  $avgTimeVisited = $temp[0];
}
$avgTimeVisited += 2;
//---------------------------------------------------------------------------

echo $numStudentsAccessed."--".$numMale."--".$numFemale."--".$avgGPA."--".$percentPrint."--";
echo $numHighSchool1."--".$numHighSchool2."--".$numHighSchool3."--";

echo $count."--";
$i = 0;
while ($i < $count) {
  echo $majorLabels[$i]."--";
  echo $numOfMajorLabel[$i]."--";
  $i = $i+1;
}

echo $avgAge."--";
echo $avgTimeVisited."--";
echo $startDateForSQL."<-StartDate--";

 ?>
