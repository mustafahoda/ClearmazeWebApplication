<?php
require "db_connect.php";
session_start();

$token = $_GET["token"];
echo("<script>console.log('PHP: Name: ".$token."');</script>");

// $fb = new Facebook\Facebook([
//   'app_id' => '166122374023411',
//   'app_secret' => '00061271b38768aaf1131b5d121884e2',
//   'default_graph_version' => 'v2.11',
//   ]);
//
// try {
//   // Returns a `Facebook\FacebookResponse` object
//   $response = $fb->get('/me?fields=id,name', $token);
// } catch(FacebookResponseException $e) {
//   echo 'Graph returned an error: ' . $e->getMessage();
//   exit;
// } catch(FacebookSDKException $e) {
//   echo 'Facebook SDK returned an error: ' . $e->getMessage();
//   exit;
// }

// $user = $response->getGraphUser();
//
// echo("<script>console.log('PHP: Name: ".$user['name']."');</script>");

// $query = "INSERT INTO users(first_name, email) VALUES ('sccd','sdcsd@gmail.com')";
// $conn = $db->exec($query);

 ?>
