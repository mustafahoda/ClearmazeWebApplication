<!DOCTYPE html>

<?php
session_start();
if (isset($_SESSION["user"])){
  header("Location: dashboard/home.php");
  exit;
}

?>

<html>

  <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="FBLogin/FBConfig.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script type="text/javascript" src="GoogleLogin/signin.js"></script>

    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="962501356206-hkh06kt9d8moqi9et6e0kgq8846rv41l.apps.googleusercontent.com">

     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <meta name="description" content="">
     <meta name="author" content="">
     <link rel="icon" href="../../favicon.ico">

     <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
     <title> Welcome to Clearmaze Technologies </title>

     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="loginStyle.css">

  </head>

  <body>

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
                        <li><a href="../contact/contact.php">contact</a></li>
                        <li><a href="../about/about.html">about</a></li>
                        <li><a href="https://medium.com/@clearmaze" target="blank">blog</a></li>
                      </ul>
                  </div>
              </div>
          </nav>
      </div>


<div id="form-wrapper">
  <form class="form-signin" method = "post" action="loginAction.php">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" name = "email">
        <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name = "password">

        <h3 ><small style="color: white;">Don't have an account? <a href="register.php">Click here</a> to make one!</small></h3>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name = 'btn-login'>Sign in</button>
        <!-- <button id="status" class="btn btn-lg btn-primary btn-block" onClick="FBLogin();" name = 'btn-login'>Log In with Facebook</button> -->
        <!-- <div class="g-signin2" data-onsuccess="onSignIn" style"align:center;"> Sign in with Google </div> -->
        <a href="forgotpassword.php" class="btn btn-info btn-block"> Forgot Password? </a>
  </form>

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
