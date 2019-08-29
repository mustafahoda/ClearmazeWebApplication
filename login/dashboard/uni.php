<?php
session_start();
require 'db_connect_clearmaze.php';
?>

<!-- <h3 align="center" class="header whitetext">Choose Your University</h3> -->

<?php
  $cc = trim($_GET['cc']);
  $_SESSION['cc'] = $cc;
 ?>

 <form align="center">
  <select id="uni" class="dropbtn" style="margin-bottom:20px;" onmouseover="DropListUni()"
  onmouseout="this.size=1;" onchange="loadMajorDropdown(this.value)">

     <?php
     echo '<option value=""> Choose your university </option>';   //PROMPTS USER
    $query = $db -> query("SELECT university FROM universities WHERE abv IN
                (SELECT uni_abv FROM guide_combos WHERE cc_abv IN
                (SELECT abv FROM community_colleges WHERE community_college = '".$cc."')) ORDER BY university;"); //narrows down user cc.
    while($row = $query -> fetch()){
      echo '<option value = " '.$row['university'].'">';
      echo $row['university'].'<br></option>';                //POPULATE DROPDOWN WITH UNIVERSITY
    }

  //	$query = null; // closing the connection to database - good practice
  //

   ?>

  </select>
 </form>
