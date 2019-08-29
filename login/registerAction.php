<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php

session_start();
require 'db_connect.php';



//--------Stripping input from SQL Injection Attacks------------
$firstName = trim($_POST["firstName"]);
$firstName = strip_tags($firstName);
$firstName = htmlspecialchars($firstName);
$firstName = ucfirst($firstName);

$lastName = trim($_POST["lastName"]);
$lastName = strip_tags($lastName);
$lastName = htmlspecialchars($lastName);
$lastName = ucfirst($lastName);

$email = trim($_POST["email"]);
$email = strip_tags($email);
$email = htmlspecialchars($email);

// $month = trim($_POST["month"]);
// $month = strip_tags($month);
// $month = htmlspecialchars($month);
//
// $date = trim($_POST["date"]);
// $date = strip_tags($date);
// $date = htmlspecialchars($date);
//
// $year = trim($_POST["year"]);
// $year = strip_tags($year);
// $year = htmlspecialchars($year);

// $zipcode = trim($_POST["zipcode"]);
// $zipcode = strip_tags($zipcode);
// $zipcode = htmlspecialchars($zipcode);

$phone = trim($_POST["phone"]);
$phone = strip_tags($phone);
$phone = htmlspecialchars($phone);

// $highSchool = trim($_POST["highSchool"]);
// $highSchool = strip_tags($highSchool);
// $highSchool = htmlspecialchars($highSchool);
//
// $highSchoolGraduation = trim($_POST["highSchoolGraduation"]);
// $highSchoolGraduation = strip_tags($highSchoolGraduation);
// $highSchoolGraduation = htmlspecialchars($highSchoolGraduation);
//
// $educationLevel = trim($_POST["EducationLevel"]);
// $educationLevel = strip_tags($educationLevel);
// $educationLevel = htmlspecialchars($educationLevel);

// $gpa = $_POST["gpa"];
// $gpa = strip_tags($gpa);
// $gpa = htmlspecialchars($gpa);

// $gender = $_POST["gender"];
// $gender = strip_tags($gender);
// $gender = htmlspecialchars($gender);

$password1 = trim($_POST["password1"]);
$password1 = strip_tags($password1);
$password1 = htmlspecialchars($password1);

$password2 = trim($_POST["password2"]);
$password2 = strip_tags($password2);
$password2 = htmlspecialchars($password2);

$intendedTransfer = trim($_POST["intendedTransfer"]);
$intendedTransfer = strip_tags($intendedTransfer);
$intendedTransfer = htmlspecialchars($intendedTransfer);

$occupation = trim($_POST["occupation"]);
$occupation = strip_tags($occupation);
$occupation = htmlspecialchars($occupation);

$checkbox = $_POST["checkbox"];
$error = false;
//-------------------------------------------------------------


//First Name validation
if (empty($firstName)){
  $error = true;
  $firstNameError = "Please enter your full name";
} elseif (strlen($firstName) < 2){
  $error = true;
  $firstNameError = "firstName must have atleast 2 charecters";
} elseif (!preg_match("/^[a-zA-Z ]+$/",$firstName)) {
  $error = true;
  $firstNameError = "firstName must contain only alphabets";
}

//Last Name validation
if (empty($lastName)){
  $error = true;
  $lastNameError = "Please enter your full name";
} elseif (strlen($lastName) < 3){
  $error = true;
  $lastNameError = "lastName must have atleast 3 charecters";
} elseif (!preg_match("/^[a-zA-Z ]+$/",$lastName)) {
  $error = true;
  $lastNameError = "lastName must contain only alphabets";
}



//Email Validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $error = true;
  $emailError = "Please enter a valid email";

} else {
  // checks if email already in system

    $emailCheck_query = $db -> query("SELECT email FROM users WHERE email = '$email';");


    while ($row_email = $emailCheck_query -> fetch()) {
      $emailReturn = $row_email[0];
    }
    if ($emailReturn != null) {
      $error = true;
      $emailError = "The email you entered is already in use";
    }

}




//Date of Birth Validation
// if(empty($month) || empty($date) || empty($year)){
//   $error = true;
//   $dobError = "Please Enter a Valid Date of Birth";
// }

//ZipCode Validation
// if(empty($zipcode)){
//   $error = true;
//   $zipError = "Please enter a Zip Code";
//
// } elseif (strlen($zipcode) < 5) {
//   # code...
//   $error = true;
//   $zipError = "Please enter a valid Zip Code";
//
// } elseif (is_numeric($zipcode) != true) {
//   # code...
//   $error = true;
//   $zipError = "ZipCode must be all numbers";
// }




//Phone Number Validation
if (empty($phone)) {
  # code...
  $error = true;
  $phoneError = "Please enter a phone number";
} elseif (strlen($phone) < 17){
  # code...
  $error = true;
  $phoneError = "Please enter a valid phone number";
}
//Graduation Year Validation
//no PHP Validation Required because dropdown

//Highest Form of EducationLevel
//no PHP Validation required because dropdown


//Checkbox Validation
if (isset($checkbox) == false) {
  # code...
  $error = true;
  $checkboxError = "You can not create an account without agreeing to our Terms and Services";
}

//Password Validation
if (empty($password1)){
  $error = true;
  $passError = "Please enter a password";
} elseif (strlen($password1) < 6) {
  # code...
  $error = true;
  $passError = "Password must be at least 6 charecters.";
} elseif ($password1 != $password2) {
  # code...
  $error = true;
  $passError = "Passwords do not match!";
}

$hashedPass = hash('sha256', $password1);

if (!$error) {  // $error == 0
  # code...
  $dob = $year."-".$month."-".$date;
  $trn_date = date("Y-m-d H:i:s");

  // echo $error;
  // echo '<br>';
  // echo $firstNameError;
  // echo $lastNameError;
  // echo $emailError;
  // echo $passError;



  $signup_query = "INSERT INTO users(first_name, last_name, email, pass, phone, accountCreation, intendedTransfer, occupation) VALUES ('$firstName','$lastName','$email', '$hashedPass', '$phone', '$trn_date', '$intendedTransfer', '$occupation');";

  $conn = $db -> exec($signup_query);
  //echo "PHP1";


  $login_query = $db -> query("SELECT id, first_name FROM users WHERE email = '$email'");

  while ($row_login = $login_query -> fetch()) {
    $loginReturn = $row_login[0];
    $firstName = $row_login[1];
  }

  $loginMessage = "Your account has been created successfully! You are now going to your transfer guide!";
  echo $loginMessage;

  sleep(3);

  $_SESSION["firstName"] = $firstName;
  $_SESSION["user"] = $loginReturn;
  header("Location: dashboard/home.php");

} else {
  # code...

  $redirectMessage = "The following errors came from your form. <a href='register.php' onclick='goback()'> Click here</a> to try again. ";
  echo $redirectMessage;
  //echo $error;
  echo '<br>';
  echo '<br>';
  echo $firstNameError;
  echo '<br>';
  echo $lastNameError;
  echo '<br>';
  echo $emailError;
  echo '<br>';
  echo $phoneError;
  echo '<br>';
  echo $passError;
  echo '<br>';
  echo $zipError;
  echo '<br>';
  echo $dobError;
  echo '<br>';
  echo $checkboxError;
  echo '<br>';
  echo '<br>';
  echo "If you're having issues creating an account, please send us an email at accounts@clearmaze.net";

}

?>

<script>
  function goback(){
    window.history.back();
  }
</script>

  </body>
</html>
