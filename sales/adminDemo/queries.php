<?php
session_start();
include 'db_connect_students.php';
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
$queryNumberPrint = $db->query("SELECT count(DISTINCT email) FROM combinations WHERE printed='Y' AND time_access >= '$start' AND time_access <= NOW();");
while($temp=$queryNumberPrint->fetch()) {
  $numPrint = $temp[0];
}
$queryNumLogIn = $db->query("SELECT count(DISTINCT email) FROM combinations WHERE time_access >= '$start' AND time_access <= NOW();");
while ($temp=$queryNumLogIn->fetch()) {
  $numTotalLogIn = $temp[0];
}
$percentPrint = round(($numPrint/$numTotalLogIn)*100);
//---------------------------------------------------------------------------
$queryNumFromSchool = $db->query("SELECT COUNT(highSchool), highSchool FROM users GROUP BY highSchool ORDER BY count(highSchool) DESC");
$temp=$queryNumFromSchool->fetch();
$numHighSchool1 = $temp[0];
$nameHighSchool1 = $temp[1];

$temp=$queryNumFromSchool->fetch();
$numHighSchool2 = $temp[0];
$nameHighSchool2 = $temp[1];

$temp=$queryNumFromSchool->fetch();
$numHighSchool3 = $temp[0];
$nameHighSchool3 = $temp[1];
//---------------------------------------------------------------------------
 $i = 0;
 $total = 0;
 $queryNumMajorsSearched = $db->query("SELECT combo1_major,count(combo1_major) FROM combinations WHERE time_access >= '' AND time_access <= NOW() AND combo1_uni = 'Trinity Christian College' GROUP BY combo1_major ORDER BY count(combo1_major);");
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
$queryNumberOfLogIns = $db->query("SELECT count(id) FROM user_activity WHERE time >= '$startDateForSQL';");
while($temp=$queryNumberOfLogIns->fetch()) {
  $numberOfLogIns = $temp[0];
}
//---------------------------------------------------------------------------
$i = 0;
$queryCCResearched = $db->query("SELECT combo1_cc, count(*) FROM combinations GROUP BY combo1_cc ORDER BY count(*) DESC ;");
while($temp=$queryCCResearched->fetch()) {
  $nameCC[$i] = $temp[0];
  $numberOfCC[$i] = $temp[1];
  $i = $i + 1;
}

echo $numStudentsAccessed."--".$numMale."--".$numFemale."--".$avgGPA."--".$percentPrint."--";
echo $numHighSchool1."--".$numHighSchool2."--".$numHighSchool3."--";
echo $nameHighSchool1."--".$nameHighSchool2."--".$nameHighSchool3."--";

echo $count."--";
$i = 0;
while ($i < $count) {
  echo $majorLabels[$i]."--";
  echo $numOfMajorLabel[$i]."--";
  $i = $i+1;
}

echo $avgAge."--";
echo $avgTimeVisited."--";
echo $numberOfLogIns."--";

echo $nameCC[0]."--";
echo $numberOfCC[0]."--";
echo $nameCC[1]."--";
echo $numberOfCC[1]."--";
echo $nameCC[2]."--";
echo $numberOfCC[2]."--";

echo $startDateForSQL."<-StartDate--";

 ?>
