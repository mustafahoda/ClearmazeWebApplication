<html>

<?php
session_start();
?>

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

   <!-- BOOTSTRAP SELECT CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- BOOTSTRAP SELECT JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

   <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   <title> Welcome to Clearmaze Technologies </title>

   <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="../formHelper/bootstrap-formhelpers.min.css">

   <link rel="stylesheet" href="registerStyle.css">
   <script src = "../formHelper/bootstrap-formhelpers-phone.js"></script>
   <script src = "../formHelper/bootstrap-formhelpers.min.js"></script>

   <!-- FONT AWESOME INSTALL -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">




   <!-- CAPTCHA Integration -->
   <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<script>

// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response.authResponse.accessToken);
  // The response object is returned with a status field that lets the
  // app know the current login status of the person.
  // Full docs on the response object can be found in the documentation
  // for FB.getLoginStatus().
  if (response.status === 'connected') {
    createAccount(response.authResponse.accessToken);
  } else {

    createAccount(response.authResponse.accessToken);
    document.getElementById('status').innerHTML = 'Please log ' +
      'into this app.';
  }
}

</script>

<body>

  <div id="container">
      <!-- <div class="container-fluid">
          <nav class="navbar navbar-default navbar-fixed-top">
              <div class="container-fluid blacktext" id="navContainer">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.html">Clearmaze</a>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                      <ul class="nav navbar-nav navbar-right">
                        <li><a id="transferbtn" href="../transfer/transfer.php">
                          <div id="transfertext">transfer</div>
                        </a></li>
                        <li><a href="../contact/contact.php">contact</a></li>
                        <li><a href="../about/about.html">about</a></li>
                        <li><a href="http://www.clearmaze.tumblr.com" target="blank">blog</a></li>
                      </ul>
                  </div>
              </div>
          </nav>
      </div> -->


  <div class="container-fluid">
      <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid" id="navContainer">
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
                      <li><a href="../contact/contact.php">contact</a></li>
                      <li><a href="../about/about.html">about</a></li>
                      <li><a href="https://medium.com/@clearmaze" target="blank">blog</a></li>
                      <li><a id = "loginbtn" href="../login/login.php">
                        <div id = "logintext">login</div>
                      </a></li>
                  </ul>
              </div>
          </div>
      </nav>
  </div>

  <div class="jumbotron">
    <h1>Sign Up to get all your transfer information</h1>
    <h2>in seconds with 3 simple steps!</h2>
    <br>
    <h3>1. Choose your Community College</h3>
    <h3>2. Choose your University</h3>
    <h3>3. Choose your Major</h3>
  </div>

  <form method = "post" id = "registration" action="registerAction.php">

    <h2>Register</h2>

    <div class = "input-group">
      <div class="input-group-addon">First Name</div>
      <input type = "text" class = "form-control" name = "firstName" id = "firstName" placeholder="First Name" required>
    </div>

    <div class = "input-group">
      <div class="input-group-addon">Last Name</div>
      <input type = "text" class = "form-control"  name = "lastName" id = "lastName" placeholder="Last Name" required>
    </div>

    <div class = "input-group">
      <div class="input-group-addon"><i class="fas fa-envelope"></i></div>
      <input type = "text" class = "form-control" name = "email" id = "email" placeholder="eMail Address" required>
    </div>

    <!-- <div class = "input-group">
      <div class = "input-group-addon"><i class = "glyphicon glyphicon-gift"></i></div>

      <select class = "form-control" name = "month" id = "month" placeholder="month" required>
        <option value="" disabled>Month</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="04">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>

      <select class = "form-control" name = "date" id = "date" placeholder="date" required>
        <option value="" disabled>Date</option>
        <option value="01">1</option>
        <option value="02">2</option>
        <option value="03">3</option>
        <option value="04">4</option>
        <option value="05">5</option>
        <option value="06">6</option>
        <option value="07">7</option>
        <option value="08">8</option>
        <option value="09">9</option>


        <?php
        // for ($i=10; $i < 32 ; $i++) {
        //   # code...
        //   echo "<option value='$i'>$i</option>";
        // }
         ?>
       </select>

      <select class = "form-control" name = "year" id = "year" placeholder="year" required>
        <option value="" disabled>Year</option>

        <?php
        // for ($i = date("Y"); $i > 1950 ; $i--) {
        //   # code...
        //   echo "<option value='$i'>$i</option>";
        // }
         ?>
       </select>
    </div> -->

    <!-- <div class="input-group">
      <div class = "input-group-addon">Gender</div>
        <select class="form-control" name="gender" placeholder = "gender" required>
          <option value="" disabled>Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="prefer not to say">Prefer not to say</option>
        </select>
    </div> -->

    <div class = "input-group">
      <div class = "input-group-addon">Transfer Semester</div>
        <select class="form-control" name="intendedTransfer" placeholder = "when do you intend to transfer?" required>
          <option value="Spring 2018">Spring 2018</option>
          <option value="Fall 2018">Fall 2018</option>
          <option value="Spring 2019">Spring 2019</option>
          <option value="Fall 2019">Fall 2019</option>
          <option value="Spring 2020">Spring 2020</option>
          <option value="Fall 2020">Fall 2020</option>
          <option value="Spring 2021">Spring 2021</option>
          <option value="Fall 2021">Fall 2021</option>
          <option value="Not Transferring">Don't plan to transfer</option>
        </select>
    </div>

    <div class = "input-group">
      <div class = "input-group-addon">Occupation</div>
        <select class="form-control" name="occupation" placeholder = "I am a ..." required>
          <option value="student">Student</option>
          <option value="counselor">Counselor</option>
          <option value="parent">Parent</option>
        </select>
    </div>

    <!-- <div class="input-group">
      <div class = "input-group-addon"><i class = "glyphicon glyphicon-pencil"></i></div>
        <select class="form-control" name="gpa" placeholder = "GPA" required>
          <option value="" disabled>GPA</option>
          <option value="4.0">4.0</option>
          <option value="3.9">3.9</option>
          <option value="3.8">3.8</option>
          <option value="3.7">3.7</option>
          <option value="3.6">3.6</option>
          <option value="3.5">3.5</option>
          <option value="3.4">3.4</option>
          <option value="3.3">3.3</option>
          <option value="3.2">3.2</option>
          <option value="3.1">3.1</option>

          <option value="3.0">3.0</option>
          <option value="2.9">2.9</option>
          <option value="2.8">2.8</option>
          <option value="2.7">2.7</option>
          <option value="2.6">2.6</option>
          <option value="2.5">2.5</option>
          <option value="2.4">2.4</option>
          <option value="2.3">2.3</option>
          <option value="2.2">2.2</option>
          <option value="2.1">2.1</option>

          <option value="2.0">2.0</option>
          <option value="1.9">1.9</option>
          <option value="1.8">1.8</option>
          <option value="1.7">1.7</option>
          <option value="1.6">1.6</option>
          <option value="1.5">1.5</option>
          <option value="1.4">1.4</option>
          <option value="1.3">1.3</option>
          <option value="1.2">1.2</option>
          <option value="1.1">1.1</option>

          <option value="1.0">1.0</option>
          <option value="0.9">0.9</option>
          <option value="0.8">0.8</option>
          <option value="0.7">0.7</option>
          <option value="0.6">0.6</option>
          <option value="0.5">0.5</option>
          <option value="0.4">0.4</option>
          <option value="0.3">0.3</option>
          <option value="0.2">0.2</option>
          <option value="0.1">0.1</option>

        </select>
    </div> -->

    <!-- <div class = "input-group">
      <div class = "input-group-addon"><i class = "glyphicon glyphicon-globe"></i></div>
      <input type = "text" class = "form-control" name = "zipcode" id = "zipcode" maxlength="5" placeholder="Zip Code" required>
    </div> -->

    <div class = "input-group">
      <div class = "input-group-addon"><i class="fas fa-mobile-alt"></i></div>
      <input type="text" class="form-control input-medium bfh-phone" name = "phone" data-format="+1 (ddd) ddd-dddd" placeholder="Phone Number" required>
    </div>

    <?php

    // $file = fopen('schoolsList.csv', "r"); //open the .csv file
    // $data = array();
    //   # code...
    //   while (!feof($file)) {
    //     # code...
    //     $tempData = fgetcsv($file, 30, '\n');
    //     $data[] = array_values($tempData);
    //   }

         // for ($i=0; $i < count($data); $i++) {
         //   # code...
         //   echo "<option>'$data[$i][0]'</option>";
         // }
       ?>




      <!-- <div class = "input-group">
        <div class="input-group-addon"><i class = "glyphicon glyphicon-education"></i></div>
        <input type = "text" class = "form-control" name = "highSchool" id = "highSchool" placeholder="Which high school did you attend?">
      </div> -->

      <!-- <script type="text/javascript">
      $('.selectpicker').selectpicker({
        size: 4
        });

      </script> -->



    <!-- <div class = "input-group">
      <div class = "input-group-addon"><i class = "glyphicon glyphicon-education"></i></div>
      <select class = "form-control" name = "highSchoolGraduation" id = "highSchoolGraduation" required>
        <option value = "" selected disabled>Which year did you or will you graduate high school?</option>
        <option value="DropOut">Dropped Out</option>
        <?php
        // for ($i=date("Y") + 4; $i > 1970 ; $i--) {
        //   # code...
        //   echo "<option value='$i'>$i</option>";
        // }
         ?>
       </select>
     </div> -->

     <!-- <div class="input-group">
       <div class="input-group-addon"><i class = "glyphicon glyphicon-signal"></i></div>
       <select class = "form-control" name = "EducationLevel" id = "EducationLevel" required>
         <option value = "" selected disabled>What is your highest form of education that you've completed?</option>
         <option value="None">None</option>
         <option value="HighSchool">High School</option>
         <option value="GED">GED</option>
         <option value="Associate">Assocciate's Degree</option>
         <option value="Bachelor">Bachelor's Degree</option>
         <option value="Master">Master's Degree</option>
         <option value = "Doctorate">Doctorate Degree</option>
       </select>
     </div> -->

    <div class = "input-group">
      <div class = "input-group-addon"><i class="fas fa-key"></i></div>
      <input type = "password" class = "form-control" name = "password1" id = "password1" placeholder="Password" required>
    </div>

    <div class = "input-group">
      <div class = "input-group-addon"><i class="fas fa-key"></i></div>
      <input type = "password" class = "form-control" name = "password2" id = "password2" placeholder="Password confirm" required>
    </div>

    <div class = "input-group">
      <input type = "checkbox" name="checkbox" required>
      By continuing and creating an account on clearmaze.net, you agree with <a href="../terms/terms.html">Clearmaze Technologies’ Terms and Conditions</a> and opt in to be contacted by institutions.
    </div>
    <div class="g-recaptcha" data-sitekey="6LePTyIUAAAAAHYQ3hVJJEq7k1WwOpPbEK-n4pX0"></div>

    <h3> <small>Already have an account? <a href="login.php">Login Here!</a></small></h3>
    <button type="submit" class="btn btn-primary">Create my Account!</button>
    <br>
    <br>
    <br>

    <p id = "loadMSG"></p>

  </form>

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
            <a href="https://medium.com/@clearmaze" target="_blank">
                <img src="../assets/medium.png" alt="Medium Link" style="width:35px">
            </a>
        </div>
    </div>
    <p> built with &ltsweat, grit, &amp hustle&gt from Chicago, IL </p>
    <p> Copyright 2018 &copy Clearmaze Technologies Inc. |
      <a href="../terms/terms.html" style="color:#cccccc;text-decoration:none;">Terms and Conditions</a>
    </p>

</footer>


</html>
