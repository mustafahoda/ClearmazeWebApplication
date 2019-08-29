<?php
session_start();

 // $userInfo = json_decode($_POST['userinfo']);
 // if(!empty($userInfo)) {

$obj = json_decode($_GET["info"], false);

	$host          = HOST
	$username      = USERNAME
	$password      = SECURE-PASSWORD;
	$database_name = "DB_NAME";
	$table         = 'TABLE';


	//Connect to the MySQL database
	$db = new mysqli($host, $username, $password, $database_name);
	if($db->connect_error){
		die("Failed to connect with MySQL database: " . $db->connect_error);
	}

		$db->query("INSERT INTO users (first_name, last_name, email, trn_date)
			VALUES ('".$obj->firstname."','".$obj->lastname."','".$obj->email."','".date("Y-m-d H:i:s")."');");
	// }

  $login_query = $db->query("SELECT id, first_name FROM users WHERE email = '$obj->email';");
  while ($row_login = $login_query->fetch_row()) {
    $loginReturn = $row_login[0];
    $name = $row_login[1];
  }

  if ($loginReturn != null) {
    $_SESSION["user"] = $loginReturn;
    $_SESSION["firstName"] = $name;
  }

?>
