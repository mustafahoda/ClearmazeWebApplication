<!doctype html>
<?php
// session_start();
// //if the session is already in place, redirect to home.php
// if (isset($_SESSION["user"])){
//   header("Location: dashboard/home.php");
//   exit;
// }

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">

    <title>Clearmaze Admin Portal</title>
  </head>
  <body>

    </div>


    <div class="container">
      <br>
      <h1>Clearmaze Admin Portal</h1>
      <br>
      <img src="../../assets/logoColorFull.svg" alt="" class="img-rounded center-block" width="150px">
      <br>
      <br>


      <form method="post" action="loginAction.php">
        <fieldset class="form-group">
          <label>E-Mail Address</label>
          <input type="email" class="form-control" id="formGroupExampleInput" placeholder="e-mail address" name="email">
        </fieldset>
        <fieldset class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="password" name="password">
        </fieldset>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>
        <br>
      </form>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
