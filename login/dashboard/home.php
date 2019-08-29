<html>

  <?php

  session_start();
  require '../db_connect.php';

  //If the user is not logged in, direct them to login.php
  if (!isset($_SESSION["user"])){
    header("Location: ../login.php");
    exit;
  }

  $user = $_SESSION["user"];

  $sessionLog_query = "INSERT INTO user_activity(email, time) VALUES ('$user', now())";
  $conn = $db -> exec($sessionLog_query);
  ?>

  <!-- Google Analytics -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75466786-1', 'auto');
  ga('send', 'pageview');
  </script>
  <!-- End Google Analytics -->

  <!-- Google AdWords  -->
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-2455241664097064",
      enable_page_level_ads: true
    });
  </script>
  <!-- End Google AdWords -->

  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="../../favicon.ico">

      <!-- jQuery must be called before anything else!!!! -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="../../bootstrap/js/bootstrap.min.js"></script>
      <script src="../../chartJS/Chart.min.js"></script>

      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

      <link href="https://fonts.googleapis.com/css?family=Roboto:300,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
      <title> Welcome to Clearmaze Technologies </title>

      <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="homeStyle.css">

  </head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid" id="navContainer">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../../index.html"><img src="../../assets/logoColorFull.svg" style="height:100%;"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../contact/contact.php">contact</a></li>
                        <li><a href="../../about/about.html">about</a></li>
                        <li><a href="https://medium.com/@clearmaze" target="blank">blog</a></li>
                        <li><a href="../logout.php">logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <script>

    // window.fbAsyncInit = function() {
    //   //FB JavaScript SDK configuration and setup
    //   FB.init({
    //     appId      : '166122374023411', // FB App ID
    //     status     : true, // check login status
    //     cookie     : true, // enable cookies to allow the server to access the session
    //     xfbml      : true,  // parse XFBML
    //     version    : 'v2.11' // use graph api version 2.8
    //   });
    // };
    //
    // function FBLogout() {
    //   var xhttp = new XMLHttpRequest();
    //   xhttp.onreadystatechange = function() {
    //     if (xhttp.readyState == 4 && xhttp.status == 200) {
    //       FB.logout(function(){document.location.reload();});
    //     }
    //   };
    //   xhttp.open("GET", "../FBLogin/FBLogout.php", true);
    //   xhttp.send();
    // }

    function loadUniDropdown(str) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById("uniDropdown").innerHTML = xhttp.responseText;
        }
      };
      xhttp.open("GET", "uni.php?cc="+str, true);
      xhttp.send();
    }

    function loadMajorDropdown(str2) {
      var xhttp2 = new XMLHttpRequest();
      xhttp2.onreadystatechange = function() {
        if (xhttp2.readyState == 4 && xhttp2.status == 200) {
          document.getElementById("majorDropdown").innerHTML = xhttp2.responseText;

          //SCROLL TO TRANSFER GUIDE ON click

          $("#major").change(function() {

            //$("#major").on('change',function() {
              $('html, body').animate({
              scrollTop: $("#scrollHere").offset().top
            }, 1000);
            });

        }
      };
      xhttp2.open("GET", "major.php?uni="+str2, true);
      xhttp2.send();
    }

    //<?php  include "queries.php"; ?>

    // function loadTransferGuide(){
    //   var xhttp4 = new XMLHttpRequest();
    //
    //   xhttp4.onreadystatechange = function() {
    //     if (xhttp4.readyState == 4 && xhttp4.status == 200) {
    //       var creditHours = xhttp4.responseText;
    //       document.getElementById("transferGuide").innerHTML = creditHours;
    //
    //     }
    //   };
    //   xhttp4.open("GET", "credits.php", true);
    //   xhttp4.send();
    //
    // }

    //--------------TOGGLE THE GENED COURSES----------------
    // touchstart added so it can work on mobile devices
    $(document).on("click touchcancel", ".toggle", function(){
      //$(this).next(".genedcat").toggle();
        $(this).nextUntil(".toggle").toggle();
      }
    );

    function loadTransferGuide(str3, str2, str1) {
      var xhttp3 = new XMLHttpRequest();

      function getCreditHours(){
        var xhttp4 = new XMLHttpRequest();

        xhttp4.onreadystatechange = function() {
          if (xhttp4.readyState == 4 && xhttp4.status == 200) {
          //  totalCredits = xhttp4.responseText;
            //document.getElementById("creditHours").innerHTML = xhttp4.responseText;
            dataForDashText = xhttp4.responseText;
            dataForDash = dataForDashText.split("/");

            totalCredits = dataForDash[0];
            transferrableCredits = dataForDash[1];
            minGPAreq = dataForDash[2];
            minGPArecc = dataForDash[3];
            maxGPArecc = dataForDash[4];

            maxGPArecc = maxGPArecc-minGPArecc;

            //transferrableCredits = totalCreditsGPA.slice(lastSlashIndex,lastSlashIndex+1);

            //return totalGPA;
            return totalCredits;//100
            return transferrableCredits;//60
            // return minGPAreq;//100
            // return minGPArecc;//60
            // return maxGPArecc;

          }
        };
        xhttp4.open("GET", "credits.php?major="+str3, true);
        xhttp4.send();
      };

      getCreditHours(str3);
      //var totalCredits = 128;




      xhttp3.onreadystatechange = function() {
        if (xhttp3.readyState == 4 && xhttp3.status == 200) {
          document.getElementById("transferGuide").innerHTML = xhttp3.responseText;

          $("#downArrow").one("mouseenter",function(){
            $('html, body').animate({
            scrollTop: $("#transferIntro").offset().top
          }, 1000);
          });


          // HIDES THE ALL THE GENED COURSES AND NOT THE GENED CATEGORIES BY DEFAULT ON PAGE LOAD
          $(document).ready(function(){
            //$("thead").next().hide();
            $(".genEdCategoryHeaders").nextUntil(".genEdCategoryHeaders").hide(); //hides everything so only the categories show
            $(".CourseName").hide();    //hides all the course names
          });



          //  ON HOVER OVER GENED COURSES DISPLAY COURSE NAME INSTEAD OF NUMBER
          $(".hoverOnCourses").mouseover(
            function(){
              $(this).children(".CourseNumber").hide();
              $(this).children(".CourseName").show();
              $(this).children(".CourseName").css("background-color","#343781");   //gives hover effect by changing the background color
              $(this).children(".CourseName").children().css("color", "white");
            }
          );

          $(".hoverOnCourses").mouseout(
            function(){
              $(this).children(".CourseName").hide();
              $(this).children(".CourseNumber").show();
            }
          );

          var ctx = document.getElementById("myChart");

          var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ["Credit at Community College", "Credits at University"],
            datasets: [{
              backgroundColor: [
                "#2ecc71",
                "#3498db"
              ],
              data: [transferrableCredits, totalCredits - transferrableCredits]
            }]
          },
          options: {
            animation: {
              duration: 4000,
              animateScale: true,
              cutoutPercentage: 75,
            },
            legend: {display: false}
          },
          });

          var barGraph = document.getElementById("myBar");
          var gpaData = {
            labels: ["Minimum GPA", "Recommended GPA"],
            datasets: [{
              label: "GPA",
              backgroundColor: "#3e51c9",
              borderColor: "#3e51c9",
              data: [0,minGPArecc]
            }, {
              label: "GPA",
              backgroundColor: "#fbb93a",
              borderColor: "#fbb93a",
              data: [minGPAreq,maxGPArecc]
            }]
          };

          var stackedBar = new Chart(barGraph, {
            type: 'bar',
            data: gpaData,
            options: {
              tooltips: {enabled: false},
              legend: { display: false },
              title: {
                display: false,
              },
              scales: {
                xAxes: [{
                  stacked: true
                }],
                yAxes: [{
                  stacked: true,
                  ticks: {
                    min: 0,
                    stepSize: 0.5,
                  }
                }]
              }
            }
          });

        }


      };
      xhttp3.open("GET", "guide.php?major="+str3, true);
      xhttp3.send();

    }

    function updatePrintLog(str4, str3, str2, str1) {
      var xhttp5 = new XMLHttpRequest();
      xhttp5.onreadystatechange = function() {
        if (xhttp5.readyState == 4 && xhttp5.status == 200) {
          var divToPrint=document.getElementById("TransferTables");
          newWin= window.open("");
          $(".genEdCategoryHeaders").nextUntil(".genEdCategoryHeaders").show();
          newWin.document.write(divToPrint.outerHTML);
          $(".genEdCategoryHeaders").nextUntil(".genEdCategoryHeaders").hide();
          newWin.print();
          newWin.close();
        }
      };
      xhttp5.open("GET", "updatePrintLog.php?major="+str1, true);
      xhttp5.send();
    }


    </script>

    <div class="jumbotron" id = "welcomeMsg">
      <h1>Hey <?php echo $_SESSION["firstName"]; ?>!</h1>
      <p> Here is your personalized transfer guide along with some other useful information we think you might like!</p>
      <h6>Don't see your schools? Fill out this <a  target="_blank" href="https://goo.gl/forms/eBbb5OsoESMuUqey2">form</a> and we might just put it up!</h6>
    </div>


    <div class = "container" id = "3stepDropdown">
      <form align="center">
        <!-- <h3 align="center" class="header whitetext">Choose Your Community College</h3> -->

        <select color="black" class="dropbtn" style="margin:25px;" onchange="loadUniDropdown(this.value)"> <!--DROPDOWN OPTIONS POPULATE -->
          <option value="">Choose your community college</option>
            <?php
            include 'db_connect_clearmaze.php';
            $query = $db -> query("SELECT * FROM community_colleges ORDER BY community_college"); //PROMPT
            while($row = $query -> fetch()){                            //LOADS VALUES FROM DB
              echo '<option value = "'.$row['community_college'].'">';
              echo $row['community_college'].'<br></option>';
            }
            //$query = null; // closing the connection to database - good practice
            ?>
        </select>

        <p id = "uniDropdown"></p>
        <p id = "majorDropdown"></p>
        <p id = "updatePrintLog"></p>

      </form>
    </div>


    <br id = "scrollHere">
    <br>
    <br>


<div class="mCustomScrollbar content fluid light" data-mcs-theme="rounded-dots">
    <!-- <p id = "creditHours"></p> -->
    <p id = "transferGuide"></p>
</div>


<script>
</script>

    <br>
    <br>

  </body>

  </html>
