<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-75466786-1', 'auto');
ga('send', 'pageview');

</script>

<?php
  session_start();
  require 'db_connect.php';
?>

<!-- Painfully placing all our scripts on top because otherwise it messes with the jquery for
  GenEd Category headers -->

<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <!-- jQuery must be called before anything else!!!! -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title> Welcome to Clearmaze Technologies </title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.11.0/css/bootstrap-tour.min.css" rel="stylesheet">
    <link rel="stylesheet" href="transfer_style.css">
</head>

<body>

<!--
**************************
      NAVBAR ON TOP
**************************
  -->
  <!-- ID's in div statements, container, and content were put in place for the sole
      purpose of implementing a sticky footer, check CSS to see implementation
  -->
  <div id="container">
    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid blacktext" id="navContainer">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="../index.html"><img src="../assets/logoColorFull.svg" style="height:100%;"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a id="transferbtn" href="transfer.php">
                        <div id="transfertext">transfer</div>
                      </a></li>
                      <li><a href="../contact/contact.php">contact</a></li>
                      <li><a href="../about/about.html">about</a></li>
                      <li><a href="http://www.clearmaze.tumblr.com" target="blank">blog</a></li>
                      <li><a id = "loginbtn" href="../login/login.php">
                        <div id = "logintext">login</div>
                      </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

<!--
**************************
  AJAX FOR DROP DOWN MENUS
**************************
-->
  <script>
  // 1. Create an XMLHTTPRequest Object (XHR)
  // 2. onreadystatechange is a property of the XHR Object, where we can store
  //		our function to execute once we send our XHR object, this is an
  //		event handler.
  // 3. Check if readyState (values 0 thru 4) and status (values 200 or 404)
  //		in which case response is ready, in responseText, so we can assign to
  //		inner part of HTML element with ID of uni or major or transfer_guide
  // 4. Open request with specified properties, with ?cc= as GET
  // 5. Send the request using the open() property

  function loadUniDropDown(str) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        document.getElementById("uni").innerHTML = xhttp.responseText;
      }
    };
    xhttp.open("GET", "uni.php?cc="+str, true);
    xhttp.send();
  }

  function loadMajorDropDown(str2) {
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
      if (xhttp2.readyState == 4 && xhttp2.status == 200) {
        document.getElementById("major").innerHTML = xhttp2.responseText;

      }
    };
    xhttp2.open("GET", "major.php?uni="+str2, true);
    xhttp2.send();
  }

  //--------------TOGGLE THE GENED COURSES----------------
  // touchstart added so it can work on mobile devices
  $(document).on("click touchstart", ".toggle", function(){
    //$(this).next(".genedcat").toggle();
      $(this).nextUntil(".toggle").toggle();
    }
  );

  function loadTransferGuide(str3, str2, str1) {
    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
          if (xhttp3.readyState == 4 && xhttp3.status == 200) {

              //----------------------------------------------
              // This part is needed for tracking guide combinations in google analytics
              var cc = str1;
              var uni = str2;
              var major = str3;
              var gaAction = uni.concat(major);
              gaAction = cc.concat(gaAction);
              ga('send', 'event', 'Transfer Guide', 'Load', gaAction);
              //-----------------------------------------------

              document.getElementById("transfer_guide").innerHTML = xhttp3.responseText;

              //SHOW MODAL ON LOAD
              $(document).ready(function(){
               $('#myModal').modal('show');
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
                  $(this).children(".CourseName").css("background-color","gray");   //gives hover effect by changing the background color
                  $(this).children(".CourseName").children().css("color", "white");
                }
              );

              $(".hoverOnCourses").mouseout(
                function(){
                  $(this).children(".CourseName").hide();
                  $(this).children(".CourseNumber").show();
                }
              );
          }

  //*************************************
  // TOUR STEPS FOR TRANSFER GUIDE TOUR
  //*************************************
  // We include our tour instance in AJAX function loadTransferGuide so it initializes
  // as soon as the personalized transfer guide appears.

        //  var tour = new Tour();
        //
        //  tour.addSteps([
        //    {
        //     element: "#TransferInfo",
        //     placement: "top",
        //     title: "Welcome!",
        //     content: "Hey there! Here’s your very own tailored transfer guide. To get things started, here is some basic degree information for your degree from your chosen university.",
        //     backdrop: true,
        //     backdropPadding: {
        //         left: -370,
        //         right: -370,
        //         bottom: 20
        //     },
        //   },
        //   {
        //     element: "#GenEdTable",
        //     placement: "top",
        //     title: "General Education Requirements",
        //     content: "This table will give you all the General Education Categories you must take at this community college and its equivalent courses at your chosen university.",
        //     backdrop: true,
        //     backdropPadding: {
        //         left: -300,
        //         right: -300,
        //         bottom: 40
        //     },
        //   },
        //   {
        //     element: "#FirstCategory1",
        //     placement: "top",
        //     title: "General Education Categories",
        //     content: "Clicking on each header will open up a list of course that fulfill that category. Hovering your cursor over each course will show you the full course name.",
        //     backdrop: true,
        //   },
        //   {
        //     element: "#MajorTable",
        //     placement: "top",
        //     title: "Major Requirements",
        //     content: "This table will show your Major Requirements -- or courses that are closely related to your major.",
        //     backdrop: true,
        //     backdropPadding: {
        //         left: -300,
        //         right: -300,
        //         bottom: 40
        //     },
        //   },
        //   {
        //     element: "#TransferInfo",
        //     placement: "top",
        //     title: "Happy Transferring! :D",
        //     content: "And that’s it! Who knew it could be so easy? Always be sure to talk to you advisor/counselor to make sure you will have a smooth transfer!",
        //   },
        // ]);
        //
        // tour.init();
        // tour.setCurrentStep(0);
        // tour.start();
    }

    xhttp3.open("GET", "display_guide.php?major="+str3, true);
    xhttp3.send();
  }

</script>


<!--
*************************************
OUR STARTING PHP CODE TO GET CC INFO
*************************************
-->
    <br>
    <br>
    <div>
    <h3 align="center" class="header whitetext">Choose Your Community College</h3>

    <form align="center">
      <select color="black" class="dropbtn" onchange="loadUniDropDown(this.value)"> <!--DROPDOWN OPTIONS POPULATE -->
          <?php
          echo '<option value=""> Select Your Community College </option>';
          $query = $db -> query("SELECT * FROM community_colleges"); //PROMPT
          while($row = $query -> fetch()){                            //LOADS VALUES FROM DB
            echo '<option value = "'.$row['community_college'].'">';
            echo $row['community_college'].'<br></option>';
          }
          //$query = null; // closing the connection to database - good practice
          ?>

      </select>
    </form>
    <!-- INSERTING OUR UNIVERSITY DROP DOWN MENU HERE  -->
    <p id="uni"></p>
    <!-- INSERTING OUR MAJOR DROP DOWN MENU HERE  -->
    <p id="major"></p>
    <!-- INSERTING OUR USER TRANSFER GUIDE HERE  -->
    <p id="transfer_guide"></p>
  </div>
</div>


</body>


<!--*****************************
  ENDING FOOTER OF OUR WEBPAGE
*******************************!-->
<footer>
    <div class="row" id="social">
        <div class="col-md-3 col-sm-3 col-xs-3" id="facebook">
            <a href="http://www.facebook.com/clearmazetech" target="_blank">
              <img src="../assets/facebook.png" alt="Facebook Link" style="width:35px">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3" id="twitter">
            <a href="http://www.twitter.com/clearmazetech" target="_blank">
              <img src="../assets/twitter.png" alt="Twitter Link" style="width:35px">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3" id="instagram">
            <a href="http://www.instagram.com/clearmaze"  target="_blank">
                <img src="../assets/instagram.png" alt="Instagram Link" style="width:35px">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3" id="tumblr">
            <a href="http://www.clearmaze.tumblr.com"  target="_blank">
                <img src="../assets/tumblr.png" alt="Tumblr Link" style="width:35px">
            </a>
        </div>
    </div>
    <p> built with &ltsweat, grit, &amp hustle&gt from Chicago, IL </p>
    <p> Copyright 2017 &copy Clearmaze Technologies Inc. |
      <a href="../terms/terms.html" style="color:#cccccc;text-decoration:none;">Terms and Conditions</a>
    </p>

</footer>

</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.11.0/js/bootstrap-tour.min.js"></script>

</html>
