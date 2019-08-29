<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>

  <!-- Include Date Range Picker -->
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css"> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

  <script src="assets/countUp.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Collin College Analytics Dashboard</title>

</head>

<body onload="myFunction()">
  <div class="jumbotron">
    <h1>Collin College Analytics Dashboard</h1>
    <h3 id="greeting"></h3>
    <script>
      function myFunction() {
        var greeting;
        var time = new Date().getHours();
        if (time < 10) {
          greeting = "Good morning Dr. Weasenforth";
        } else if (time < 20) {
          greeting = "Good day Dr. Weasenforth";
        } else {
          greeting = "Good evening Dr. Weasenforth";
        }
        document.getElementById("greeting").innerHTML = greeting;
      }
    </script>
  </div>

  <div class="row">
  <div class="container-fluid">
    <div class="input-group input-daterange col-sm-4 offset-sm-4" id="datepicker">
      <input type="text" class="form-control" name="daterange" onchange="loadDashboard(this.value)" name="start" value="Start Date">
      <span class="input-group-addon">to Today</span>
    </div>
  </div>
</div>

    <script>
      $(function() {
        // $('input[name="daterange"]').daterangepicker();
        $('.input-daterange').datepicker();
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
          pieChartNumLabels = dashboardData[8];

          majorLabels = new Array(pieChartNumLabels);
          numOfMajorLabel = new Array(pieChartNumLabels);
          totalPieData = pieChartNumLabels * 2;
          var index = 0;

          var i;

          for (i = 0; i < totalPieData; i = i + 2) {
            majorLabels[index] = dashboardData[9+i];
            numOfMajorLabel[index] = dashboardData[9+i+1];
            index++;
          }

           i = i + 9;
           age1 = dashboardData[i];
          //  var age2 = age1 + 1;
          i++;
          avgTimeVisited = dashboardData[i];

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
                 type: 'horizontalBar',

                 // The data for our dataset
                 data: {
                   labels: ["Male", "Female"],
                   datasets: [{
                     backgroundColor: 'rgb(255, 99, 132)',
                     borderColor: 'rgb(255, 99, 132)',
                     data: [numMale, numFemale],
                   }]
                 },

                 // Configuration options go here
                 options: {
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
                       ticks: {
                         beginAtZero: true
                       }
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
               var ctx = document.getElementById('barGraph2').getContext('2d');
               var chart = new Chart(ctx, {
                 // The type of chart we want to create
                 type: 'horizontalBar',

                 // The data for our dataset
                 data: {
                   labels: ["Wylie High School", "McKinney High School", "Allen High School"],
                   datasets: [{
                     backgroundColor: [
                       'rgb(255, 99, 132)',
                       'rgb(109, 99, 132)',
                       'rgb(303, 99, 239)',
                     ],
                     borderColor: 'rgb(255, 99, 132)',
                     data: [numHighSchool1, numHighSchool2, numHighSchool3],
                   }]
                 },

                 // Configuration options go here
                 options: {
                   title: {
                     display: true,
                     text: "Top High Schools",
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
                       ticks: {
                         beginAtZero: true
                       }
                     }]
                   }
                 }
               });

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


    </script>



  </body>
</html>
