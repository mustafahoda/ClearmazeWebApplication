<?php
session_start();
$start = $_GET['start'];
$_SESSION['startdate'] = $start;

echo $start;
echo "<--Start";
 ?>
