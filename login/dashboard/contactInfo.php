
<?php
include "db_connect_clearmaze.php";
//include "queries.php";
// $user_cc = "College of Dupage";
// $user_uni = "University of Illinois at Chicago";
?>

<!-- POINT OF CONTACT FOR THE COMMUNITY COLLEGE -->

<div id = "contact">
  <br>
  <!-- <h4>Here is some important point of contact information that we think will come in handy</h4> -->
  <h4>
    Be sure to talk to your advisor/counselor when planning your courses!
  </h4>
  <br>
  <div id = "ccInfo">
    <?php
      $cc_contact_query = $db -> query("
      SELECT phone, email, url FROM community_colleges WHERE community_college = '$user_cc';
      ");
      while($row_cc_contact = $cc_contact_query->fetch()){
        echo "<a href = '$row_cc_contact[2]' class = 'btn btn-lg btn-success' id='contactbtn' target='_blank' style='white-space: normal'>";
        echo $user_cc;
        echo "</a>";
        echo "<div class='blacktext'><h4>";
        echo $row_cc_contact[0];
        echo "<br>";
        echo $row_cc_contact[1];
        echo "<br></h4></div><hr>";
      };
     ?>
  </div>
  <!-- POINT OF CONTACT FOR THE UNI -->
  <div id = "uniInfo">
    <?php
      $uni_contact_query = $db -> query("
      SELECT phone, email, url FROM universities WHERE university = '$user_uni';");
      while($row_uni_contact = $uni_contact_query->fetch()){
        echo "<a href = '$row_uni_contact[2]' class = 'btn btn-lg btn-success' id='contactbtn' target='_blank' style='white-space: normal'>";
        echo $user_uni;
        echo "</a>";
        echo "<div class='blacktext'><h4>";
        echo $row_uni_contact[0];
        echo "<br>";
        echo $row_uni_contact[1];
        echo "<br></h4></div><br><br>";
      };
      ?>
  </div>

</div>
