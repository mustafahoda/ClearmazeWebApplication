<?php
session_start();
require '../db_connect_students.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <?php
$id = $_GET["id"];
    $queryUserInfo = $db->query("SELECT first_name, last_name FROM users WHERE id = $id;");
    while($row = $queryUserInfo -> fetch()){
      $firstName = $row[0];
      $lastName = $row[1];
    }
    ?>
    <title><?php echo $firstName; ?>'s Detailed Profile</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  </head>
  <body>
    <?php  ?>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">

      <h1 class="display-3"><?php echo $firstName." ".$lastName ?></h1>
      <p class="lead">Find more information and data on <?php echo $firstName; ?></p>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <h1>Basic Student Information</h1>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>E-mail</th>
          <th>Phone Number</th>
          <th>Age</th>
          <th>GPA</th>
          <th>High School</th>
          <th>Date of Birth</th>
          <th>High School Graduation Year</th>
          <th>Education Level</th>

        </tr>
      </thead>
      <tbody>
      <?php
      $queryUserInfo = $db->query("SELECT * FROM users WHERE id = $id;");
      while($row = $queryUserInfo -> fetch()){
        $firstName =  $row[1];
        $lastName = $row[2];
        $zipCode =  $row[3];
        $email =  $row[5];
        $birthDate = $row[8];
        $gender = $row[12];
        $gpa = $row[13];
        $highSchool = $row[14];
        // $birthDate = explode("-", $birthDate);
        $gradYear = $row[10];
        $eduLevel = $row[11];

        $birthDateExplode = explode("-", $birthDate);

          $age = (date("md", date("U", mktime(0, 0, 0, $birthDateExplode[2], $birthDateExplode[1], $birthDateExplode[0]))) > date("md") ? ((date("Y")-$birthDateExplode[0])-1):(date("Y")-$birthDateExplode[0]));
        $phoneNumber = $row[9];

        // echo '<form action="student/studentActivity.php" method="get">';
            echo '<tr>';
              echo "<td>".$firstName."</td>";
              echo "<td>".$lastName."</td>";
              echo "<td>".$gender."</td>";
              echo "<td>".$email."</td>";
              echo "<td>".$phoneNumber."</td>";
              echo "<td>".$age."</td>";
              echo "<td>".$gpa."</td>";
              echo "<td>".$highSchool."</td>";
              echo "<td>".$birthDate."</td>";
              echo "<td>".$gradYear."</td>";
              echo "<td>".$eduLevel."</td>";




          echo "</tr>";

      }
      ?>
      </tbody>
    </table>
  </div>

    <div class="container">
      <div class="row">
        <div class="card-deck-wrapper">
          <div class="card-deck">
            <div class="card">
              <?php
              $queryCount = $db -> query("SELECT count(*) FROM combinations WHERE email = '$email';");
              while($row = $queryCount -> fetch()){
                $visits = $row[0];
              }
              ?>
              <div class="card-block">
                <h4 class="card-title"><?php echo $visits; ?></h4>
                <p class="card-text">number of times student has looked at a transfer guides.</p>
              </div>
            </div>
            <div class="card">
              <?php

              $queryLastVisit = $db -> query("SELECT time_access FROM combinations WHERE email = '$email' ORDER BY time_access DESC LIMIT 1 ;");
              while($row = $queryLastVisit -> fetch()){
                $lastVisitDate = $row[0];
              }

              $today = date("Y-m-d");
              $queryDaySinceLastVisit = $db -> query("SELECT DATEDIFF('$today', '$lastVisitDate');");
              while($row = $queryDaySinceLastVisit -> fetch()){
                $daysSinceLastVisit = $row[0];
              }
              if ($lastVisitDate == NULL) {
                $daysSinceLastVisit = "0";
              }

              ?>
              <div class="card-block">
                <h4 class="card-title"><?php
                  if ($daysSinceLastVisit == 1) {
                    echo $daysSinceLastVisit." day ago";
                  } else {
                    echo $daysSinceLastVisit." days ago";
                  }
                ?></h4>
                <p class="card-text">was the last time the student looked at a transfer guide.</p>
              </div>
            </div>
            <div class="card">
              <?php
              $queryCountUni = $db -> query("SELECT count(DISTINCT combo1_uni) FROM combinations WHERE email = '$email';");
              while($row = $queryCountUni -> fetch()){
                $uniCount = $row[0];
              }
              $uniCount;

              ?>
              <div class="card-block">
                <h4 class="card-title"><?php echo $uniCount ?></h4>
                <p class="card-text">is the number of receiving institutions the student has looked at.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <h1>Schools and Majors Researched</h1>
        <h6>below are schools and majors the student has researched</h6>

      </div>

      <table class="table">
        <thead>
          <tr>
            <th>Community College</th>
            <th>University</th>
            <th>Major</th>
            <th>Date Checked</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $queryCombinations = $db->query("SELECT combo1_cc, combo1_uni, combo1_major, time_access FROM combinations WHERE email = '$email' ORDER BY time_access DESC;");
          while($row = $queryCombinations -> fetch()){
            echo '<tr>';
              echo '<td>'.$row[0].'</td>';
              echo '<td>'.$row[1].'</td>';
              echo '<td>'.$row[2].'</td>';
              $d = str_split($row[3]);
              $date = $d[5].$d[6]."/".$d[8].$d[9]."/".$d[0].$d[1].$d[2].$d[3];
              echo '<td>'.$date.'</td>';
            echo '</tr>';

          } ?>
        </tbody>
      </table>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
