<?php

session_start();
require 'db_connect_students.php';

//If the user is not logged in, direct them to login.php
if (!isset($_SESSION["user"])){
  header("Location: login.php");
  exit;
}

$user = $_SESSION["user"];

?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="style.css">

  <!-- ChartJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- DatePicker -->
  <script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

  <script src="assets/countUp.js"></script>

  <title>Clearmaze Admin Portal</title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="https://clearmaze.net">
    <img src="../../assets/logoColorFull.svg" width="120" height="30">
  </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"></ul>
    <div class="form-inline my-2 my-lg-0">
      <a href="logout.php" class="btn btn-primary btn-md active" role="button">logout</a>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <h1 class="display-3">Hello, <?php echo $_SESSION["firstName"]; ?>!</h1>

</div>

<script>
$(document).ready(function() {
   $('table').hide();
});
</script>

<div class="row">
  <div class="container-fluid">
    <div style="align:center" class="input-group input-daterange col-sm-4 offset-sm-4" id="datepicker">
      <input type="text" class="form-control" name="daterange" name="start" value="Select a start date" id = "dateValue">
      <span class="input-group-addon">to Today</span>
    </div>
  </div>
</div>
<br><br>
    <script>
    var count = 0;

      $(function() {
        // $('input[name="daterange"]').daterangepicker();
        $('.input-daterange').datepicker({
          endDate: '0d'
        });

        var count = 0;
        $('.input-daterange').on('change', function(){
        count++;
        // alert(count);
          if ((count % 5) == 0) {
            var startdate = document.getElementById("dateValue").value;
            loadDashboard(startdate);
            loadDashboard(startdate);
            $("table").show();
          }
        })

      });
    </script>

    <div id="dashboardSBVC"></div>

    </body>

    <script>

    // function sendStartDate(startDate) {
    //   var xhttp = new XMLHttpRequest;
    //   if (xhttp.readyState == 4 && xhttp.status == 200) {
    //     document.getElementById("testingStartDate").innerHTML = xhttp.responseText;
    //   }
    //   xhttp.open("GET", "firstDate.php?startDate="+startDate, true);
    //   xhttp.send();
    // }

    function loadDashboard(startdate) {
      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) {

          // document.getElementById("testingPurposes").innerHTML = xhttp.responseText;
          // -------------------------
          //  DASHBOARD DATA FROM DB
          //--------------------------
          values = xhttp.responseText;
          dashboardData = values.split("--");

          numStudents = dashboardData[0];
          numMale = dashboardData[1];
          numFemale = dashboardData[2];
          avgGPA = dashboardData[3];
          numPrinted = dashboardData[4];
          numHighSchool1 = dashboardData[5];
          numHighSchool2 = dashboardData[6];
          numHighSchool3 = dashboardData[7];
          nameHighSchool1 = dashboardData[8];
          nameHighSchool2 = dashboardData[9];
          nameHighSchool3 = dashboardData[10];
          pieChartNumLabels = dashboardData[11];

          majorLabels = new Array(pieChartNumLabels);
          numOfMajorLabel = new Array(pieChartNumLabels);
          totalPieData = pieChartNumLabels * 2;
          var index = 0;

          var i;

          for (i = 0; i < totalPieData; i = i + 2) {
            majorLabels[index] = dashboardData[12+i];
            numOfMajorLabel[index] = dashboardData[12+i+1];
            index++;
          }

           i = i + 12;
           age1 = dashboardData[i];
          //  var age2 = age1 + 1;
          i++;
          avgTimeVisited = dashboardData[i];
          i++;
          numberOfLogIns = dashboardData[i];
          i++;
          nameCC1 = dashboardData[i]; i++;
          numCC1 = dashboardData[i]; i++;
          nameCC2 = dashboardData[i]; i++;
          numCC2 = dashboardData[i]; i++;
          nameCC3 = dashboardData[i]; i++;
          numCC3 = dashboardData[i];

          }
        };

        xhttp.open("GET", "queries.php?startdate="+startdate, true);
        xhttp.send();

        var xhttp2 = new XMLHttpRequest();

        xhttp2.onreadystatechange = function() {
            if (xhttp2.readyState == 4 && xhttp2.status == 200) {
               document.getElementById("dashboardSBVC").innerHTML = xhttp2.responseText;
               // NUMBER OF STUDENTS WHO ACCESSED CLEARMAZE

               var users = new CountUp("users", 0, numStudents, 0, 2.5, optionsUsed);
               users.start();

               // NUMBER OF MALES AND FEMALE STUDENTS
               var ctx = document.getElementById('barGraph1').getContext('2d');
               var chart = new Chart(ctx, {
                 // The type of chart we want to create
                 type: 'bar',

                 // The data for our dataset
                 data: {
                   labels: ["Male", "Female"],
                   datasets: [{
                     backgroundColor: ['#0094C6', '#8F13F4'],
                     borderColor: 'rgb(255, 99, 132)',
                     data: [numMale, numFemale],
                   }]
                 },

                 // Configuration options go here
                 options: {
                   maintainAspectRatio: false,
                   title: {
                     display: true,
                     text: "Male vs Female Students",
                     fontSize: 19
                   },
                   animation: {
                     duration: 2000
                   },
                   legend: {
                     display: false
                   },
                   scales: {
                     xAxes: [{
                       barThickness: 50
                     }],
                     yAxes: [{
                       ticks: {
                         beginAtZero: true
                       }
                     }]
                   }
                 }
               });

               // NUMBER OF CC STUDENTS
               var ctx = document.getElementById('barGraph3').getContext('2d');
               var chart = new Chart(ctx, {
                 // The type of chart we want to create
                 type: 'bar',

                 // The data for our dataset
                 data: {
                   labels: [nameCC1, nameCC2, nameCC3],
                   datasets: [{
                     backgroundColor: [
                       'rgb(255, 99, 132)',
                       'rgb(109, 99, 132)',
                       'rgb(303, 99, 239)',
                     ],
                     borderColor: 'rgb(255, 99, 132)',
                     data: [numCC1, numCC2, numCC3],
                   }]
                 },

                 // Configuration options go here
                 options: {
                   maintainAspectRatio: false,
                   title: {
                     display: true,
                     text: "Top Community Colleges",
                     fontSize: 19
                   },
                   animation: {
                     duration: 2000
                   },
                   legend: {
                     display: false
                   },
                   scales: {
                     yAxes: [{
                       ticks: {
                         beginAtZero: true
                       }
                     }],
                     xAxes: [{
                       display: false
                     }]
                   }
                 }
               });

               // AVG Gpa of all the STUDENTS
               var gpa = new CountUp("gpa", 0, avgGPA, 2, 2.5, options);
               gpa.start();

               // Percent of Students who printed
               var print = new CountUp("print", 0, numPrinted, 0, 2.5, optionsPercent);
               print.start();

               // Number of Students from the Top High Schools
               // var ctx = document.getElementById('barGraph2').getContext('2d');
               // var chart = new Chart(ctx, {
               //   // The type of chart we want to create
               //   type: 'bar',
               //
               //   // The data for our dataset
               //   data: {
               //     labels: [nameHighSchool1, nameHighSchool2, nameHighSchool3],
               //     datasets: [{
               //       backgroundColor: [
               //         'rgb(255, 99, 132)',
               //         'rgb(109, 99, 132)',
               //         'rgb(303, 99, 239)',
               //       ],
               //       borderColor: 'rgb(255, 99, 132)',
               //       data: [numHighSchool1, numHighSchool2, numHighSchool3],
               //     }]
               //   },
               //
               //   // Configuration options go here
               //   options: {
               //     maintainAspectRatio: false,
               //     title: {
               //       display: true,
               //       text: "Top High Schools",
               //       fontSize: 19
               //     },
               //     animation: {
               //       duration: 2000
               //     },
               //     legend: {
               //       display: false
               //     },
               //     scales: {
               //       yAxes: [{
               //         ticks: {
               //           beginAtZero: true
               //         }
               //       }],
               //       xAxes: [{
               //         display: false
               //       }]
               //     }
               //   }
               // });

               // Avg Time Spent on Platform
               // var timeValue = 10;
               // var time = new CountUp("time", 0, timeValue, 0, 2.5, optionsMinutes);
               // time.start();

               // Percentage of Students who Believe Their Transfer Process is Clear
               var clearValue = 75;
               var clear = new CountUp("clear", 0, clearValue, 0, 2.5, optionsPercent);
               clear.start();

               // Avg age of Students
               var avgAge1 = new CountUp("age1", 0, age1, 0, 2.5, optionsAge);
               avgAge1.start();
               // var avgAge2 = new CountUp("age2", 0, age2, 0, 2.5, options);
               // avgAge2.start();

               // Number of Times a Student Logged On to our platform
               var numLogInsFxn = new CountUp("logins", 0, numberOfLogIns, 0, 2.5, optionsLogIns)
               numLogInsFxn.start();

               // Avg time User visited the platform
               var avgTimeVisitedFxn = new CountUp("avgVisited", 0, avgTimeVisited, 0, 2.5, optionsVisited);
               avgTimeVisitedFxn.start();

               // num of Majors Searched by Major label
               var ctx = document.getElementById('myChart').getContext('2d');
               var chart = new Chart(ctx, {
                 // The type of chart we want to create
                 type: 'pie',

                 // The data for our dataset
                 data: {
                   labels: majorLabels,
                   datasets: [{
                     data: numOfMajorLabel,
                     backgroundColor: [
                       "#2ecc71",
                       "#3498db",
                       "#95a5a6",
                       "#9b59b6",
                       "#f1c40f",
                       "#e74c3c",
                       "#34495e",
                       "#2ecc71",
                       "#3498db",
                       "#95a5a6",
                       "#9b59b6",
                       "#54428E",
                       "#8963BA",
                       "#90C290",
                       "#6C464F",
                       "#1F5673",
                       "#B9B8D3",
                       "#90C3C8",
                       "#E7EFC5",
                       "#AF5B5B",
                       "#F6F4F3",
                       "#183059",
                       "#FFBA08",
                       "#1C3144",
                       "#0C090D",
                       "#E01A4F",
                       "#934683",
                       "#D4B483",
                       "#48A9A6",
                       "#4281A4",
                       "#C1666B",
                       "#1F5673",
                       "#B9B8D3",
                       "#90C3C8",
                       "#E7EFC5",
                       "#AF5B5B",
                       "#F6F4F3",
                       "#183059",
                       "#FFB444",
                       "#3C3144",
                       "#0C590D",
                       "#E01A8F",
                       "#934693",
                       "#D4C353",
                       "#4833A6",
                       "#4282A4",

                     ]
                   }]
                 },

                 // Configuration options go here
                 options: {
                   animation: {
                     duration: 2000
                   },
                   title: {
                     display: true,
                     text: "Majors Researched by Percentage",
                     fontSize: 19
                   },
                   legend: {
                     display: false
                   }
                 }
               });

            }
          };

          xhttp2.open("GET", "dashboard.php", true);
          xhttp2.send();
      };

    var options = {  };

    var optionsPercent = {  
    useEasing: true,
      useGrouping: true,
      separator: ',',
      decimal: '.',
    suffix: '%',
    };

    var optionsMinutes = {  
    useEasing: true,
      useGrouping: true,
      separator: ',',
      decimal: '.',
    suffix: ' minutes',
    };

    var optionsVisited = {  
    useEasing: true,
      useGrouping: true,
      separator: ',',
      decimal: '.',
    suffix: ' times',
    };

    var optionsAge = {  
    useEasing: true,
      useGrouping: true,
      separator: ',',
      decimal: '.',
    suffix: ' years',
    };

    var optionsUsed = {  
    useEasing: true,
      useGrouping: true,
      separator: ',',
      decimal: '.',
    suffix: ' students',
    };

    var optionsLogIns= {  
    useEasing: true,
      useGrouping: true,
      separator: ',',
    suffix: ' sessions',
    };


    </script>



<body>
  <table style = "width:1000px" align = "center" cellspacing="0" cellpadding="0">
    <thead>
      <tr style="text-align:center;">
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Age</th>
        <th style="text-align:center;">GPA</th>
        <th style="text-align:center;width:300px;">High School</th>
        <th style="text-align:center;">Looked at your institution?</th>
        <th><th>
      </tr>
    </thead>
    <tbody>
<?php
  $queryUsers = $db->query("SELECT * FROM users WHERE email IN (SELECT email FROM combinations WHERE combo1_uni = 'University of Illinois at Chicago')");
  $student = 0;
  while($row = $queryUsers -> fetch()){
    $student = $student + 1;
    $_SESSION[$student] = $row[0];
    $firstName =  $row[1];
    $lastName = $row[2];
    $zipCode =  $row[3];
    $email = $row[5];
    $birthDate = $row[8];
    $gpa = $row[13];
    $highSchool = $row[14];
    $birthDate = explode("-", $birthDate);
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
    $phoneNumber = $row[9];

    $queryDOBExists = $db->query("SELECT dob FROM users WHERE email = '".$email."'");
    while($holder = $queryDOBExists -> fetch()){
      $dob = $holder[0];
    }

    if (($dob == NULL) || ($age == "")) {
      $age = "--";
    }

    if ($highSchool == NULL) {
      $highSchool = "--";
    }

    if ($gpa == NULL) {
      $gpa = "--";
    }

    // echo '<form action="student/studentActivity.php" method="get">';
        echo '<tr>';
          echo "<td>".$firstName."</td>";
          echo "<td>".$lastName."</td>";
          echo "<td>".$age."</td>";
          echo "<td>".$gpa."</td>";
          echo "<td>".$highSchool."</td>";
          echo "<td>".'Yes'."<td>";
          echo "<td> <form target='_blank' action = 'student/studentActivity.php' method = 'get'> <input type = 'hidden'  name = 'id' value = ".$row[0]."> <button type = 'submit' class = 'btn btn-primary'>View More</button> </form> </td>";
      echo "</tr>";

  }

  $queryRestOfUsers = $db->query("SELECT * FROM users WHERE email NOT IN (SELECT email FROM users WHERE email IN (SELECT DISTINCT(email) FROM combinations WHERE combo1_uni = 'Clearmaze University'))");
  while($row = $queryRestOfUsers -> fetch()){
    $student = $student + 1;
    $_SESSION[$student] = $row[0];
    $firstName =  $row[1];
    $lastName = $row[2];
    $zipCode =  $row[3];
    $email = $row[5];
    $birthDate = $row[8];
    $gpa = $row[13];
    $highSchool = $row[14];
    $birthDate = explode("-", $birthDate);
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
    $phoneNumber = $row[9];

    $queryDOBExists = $db->query("SELECT dob FROM users WHERE email = '".$email."'");
    while($holder = $queryDOBExists -> fetch()){
      $dob = $holder[0];
    }

    if (($dob == NULL) || ($age == "")) {
      $age = "--";
    }

    if ($highSchool == NULL) {
      $highSchool = "--";
    }

    if ($gpa == NULL) {
      $gpa = "--";
    }

    // echo '<form action="student/studentActivity.php" method="get">';
        echo '<tr>';
          echo "<td>".$firstName."</td>";
          echo "<td>".$lastName."</td>";
          echo "<td>".$age."</td>";
          echo "<td>".$gpa."</td>";
          echo "<td>".$highSchool."</td>";
          echo "<td>".'No'."<td>";
          echo "<td> <form target='_blank' action = 'student/studentActivity.php' method = 'get'> <input type = 'hidden'  name = 'id' value = ".$row[0]."> <button type = 'submit' class = 'btn btn-primary'>View More</button> </form> </td>";
      echo "</tr>";

  }
?>

</tbody>
</table>


</body>
