<html>
  <head>
    <script src="../../chartJS/Chart.min.js"></script>
    <style>
      #pie {
        position: center;
        max-height:29vh;
        max-width:29vw;
      }
      #myBar {
        position: center;
        max-height:90vh;
        max-width:90vw;
      }
      @media screen and (min-width: 2000px) {
        #pie {
          position: center;
          max-height:23vh;
          max-width:23vw;
        }
        #myBar {
          position: center;
          max-height:25vh;
          max-width:25vw;
        }
      }

      @media only screen and (max-width: 1000px)  {
        #pie {
          position: center;
          max-height:10vh;
          max-width:50vw;
        }
        #myBar {
          position: center;
          max-height:10vh;
          max-width:50vw;
        }
      }
    </style>

  </head>
<?php

require 'db_connect_clearmaze.php';
include 'queries.php';
//include 'chart.html';

// if (length($relatedMajor) == 1) {
  // code...

if (isset($relatedMajorCode) == 1) {
  // code...
?>

  <div class="container-fluid" style="background-color:#F5F9FC;">
    <h3>Trinity Christian College also offers this major ... would you be interested?</h3>
    <form class="" action="suggestion.php" method="post" target="_blank">
      <input type="hidden" name="suggestedMajorCode" value="<?php echo $relatedMajorCode; ?>">
      <button type="submit" class="btn btn-primary">Yes! Sounds interesting!</button>
    </form>
  </div>

<?php

 }

?>


 <!--######################################
          Chart JS Implementation
 ########################################-->

<div class="container-fluid">

</div>

<div style="font-weight: 300;">
 <div class = "container-fluid" id = "row1">
   <div class = "row" style="background-color:#F5F9FC;">
     <div class =  "col-xl-4 col-lg-4 col-md-4 well well-lg container-fluid" id = "completionChart">
       <h3>Degree Completion Percentage</h3>
       <!-- <p>This graph shows you how much of your degree you can finish from community college! Cool huh?</p> -->


       <?php
       $queryCreditHours = $db -> query("SELECT credit_hours FROM majors WHERE major = '$user_major' and university = '$user_uni';");

       while($temp = $queryCreditHours->fetch()){
         $credits = $temp[0];
       }

       $queryTransferCredits = $db -> query("SELECT creditsComplete FROM transferCredits WHERE uni = '$user_uni' and cc = '$user_cc' and major = '$user_major';");

       while ($temp = $queryTransferCredits -> fetch()) {
         $transferCredits = $temp[0];
       }

       $percentComplete = round(($transferCredits/$credits)*100);
        ?>
        <br>
        <h1><?php echo $percentComplete."%"; ?></h1> <h4>of your degree can be knocked out by attending community college!</h4>

       <div class="chart-container" id="pie">
         <canvas id="myChart" align = "center" width="500"></canvas>
       </div>

     </div>

    <?php
    // $total_credit_hours_query = $db -> query("
    // SELECT credit_hours FROM majors WHERE university = '$user_uni' AND major = '$user_major'; ");
    // while($row_credit = $total_credit_hours_query -> fetch()){
    //   $total_credit = $row_credit[0];
    // };
    ?>

  <div class = "col-xl-3 col-lg-3 col-md-3 well well-lg container-fluid" id = "contact">
       <h3>Contact Information</h3>
       <div id = "contactBody"> <?php include 'contactInfo.php'; ?> </div>
   </div>

   <div class =  "col-xl-4 col-lg-4 col-md-4 well well-lg container-fluid" id = "gpaBox">
     <h3>Recommended GPA</h3>
     <br>
     <!-- <h4>
       Transferring can be competitive ... so try to maintain a strong GPA to increase your chances of being accepted.
     </h4> -->

     <h4>
       Here is the recommended Transfer GPA for students pursuing a <?php echo $user_major ?> degree from <?php echo $user_uni ?>
     </h4>

     <?php
     $queryGPA = $db ->query("SELECT gpa FROM majors WHERE university = '$user_uni' and major = '$user_major';");
     //
     while($temp = $queryGPA->fetch()){
       $GPA = $temp[0];
     }
      ?>

     <!-- <div id = "GPA"> -->
       <?php
       if (strlen($GPA) == '') {
         # code...
         echo "<br>";
         echo "<h2>There is no GPA Information for this combination :(</h2>";
         echo "<br><br>";
       } else {
         # code...
         echo "<div id = 'GPA'>".$GPA."</div>";
       }

       ?>
       <div class="chart-container" id="bar">
         <canvas id="myBar" align = "center" width="40" height="28"></canvas>
       </div>
     <!-- </div> -->
   </div>
 </div>
 </div>


<br>

 <!-- <img src="../../assets/downArrow.png" alt="ScrollDown" id = "downArrow"> -->
<!-- <div class="glyphicon glyphicon-arrow-down" id = "downArrow"></div> -->

<br>
<br>
<br>

</div>


 <!-- <div class="jumbotron" id = "transferIntro">
   <p>That was some cool stuff ... but this is the most important! Below are the classes that you need to take at your community college that will help you fulfill your degree from your university!</p>
   <p><b>Always be sure to talk to your counselor when signing up for courses to ensure a smooth transfer.</b></p>
   <p>
     Happy Transferring!
   </p>
   <small>(yes ... that's a thing)</small>
 </div> -->



 <!--######################################
              GEN ED TABLE
 ########################################-->

 <?php if ($numGenEdHeaders) { ?>
<div id="TransferTables">
 <div id="GenEdTable" style="padding-top:5px;">
   <h3 align="center" class="header whitetext" style="margin-bottom:10px;">General Education Categories</h3>
   <table align="center" style="width:800px"  cellspacing="0" cellpadding="0"> <?php
       $idCntr = 0;

       for ($i=0; $i<$numGenEdHeaders; $i++) {
           $idCntr = $idCntr + 1; ?>

           <thead class="thead-inverse genEdCategoryHeaders toggle" id="GenEdCategory<?php echo $idCntr;?>">
             <tr class = "header">
               <th colspan="3" class="genEdCatHeaders" id="FirstCategory<?php echo $idCntr;?>"><?php echo $rowGenEdCategory[$i]; ?></th>
             </tr>
           </thead> <?php

           if ($numGenedCourses[$i]) { ?>
               <tbody id="GenEdCourses<?php echo $idCntr;?>" class="genedcat">
                   <tr>
                     <th class="genEdCategoryHeaders" width="300px"><?php echo $user_cc;?></th>
                     <th class="genEdCategoryHeaders" width="300px"><?php echo $user_uni;?></th>
                     <th class="genEdCategoryHeaders" width="150px">Credit Hours</th>
                   </tr> <?php
                   while($rowGenEdCourses = $queryGenedCourseByCategory[$i]->fetch()){ ?>
                       <tbody class = "hoverOnCourses">
                         <tr class="CourseNumber">
                           <td><?php echo $rowGenEdCourses[0]; ?></td>
                           <td><?php echo $rowGenEdCourses[2]; ?></td>
                           <td><?php echo $rowGenEdCourses[4]; ?></td>
                         </tr>
                         <tr class="CourseName">
                           <td><?php echo $rowGenEdCourses[1]; ?></td>
                           <td><?php echo $rowGenEdCourses[3]; ?></td>
                           <td><?php echo $rowGenEdCourses[4]; ?></td>
                         </tr>
                       </tbody> <?php
                   }; ?>
               </tbody> <?php
           } else { ?>
             <tr>
               <td colspan="3"> There are currently no course equivalencies for this General Education category. </td>
             </tr> <?php
           }
     }; ?>

   </table>
 </div>
 <?php } ?>
<br><br>
 <!--###########################
         MAJOR TABLE
 #############################-->

 <div id="MajorTable" style="padding-top:5px;">
 <h3 align="center" class="header whitetext" style="margin-bottom:10px;">Major Core (<?php echo $user_major;?>)</h3>
 <table style = "width:800px" align = "center"  cellspacing="0" cellpadding="0">

   <thead>
       <tr class="header">
         <th width="300px"> <?php echo $user_cc; ?> </th>
         <th width="300px"> <?php echo $user_uni; ?></th>
         <th width="150px">Credit Hours</th>
       </tr>
   </thead> <?php

   if($numMajorCoreCourses) { ?>
       <tbody> <?php
           while($rowMajorReq = $queryMajorCourses->fetch()){ ?>
               <tbody class = "hoverOnCourses">
                 <tr class="CourseNumber">
                   <td><?php echo $rowMajorReq[0];?></td>
                   <td><?php echo $rowMajorReq[2];?></td>
                   <td><?php echo $rowMajorReq[4];?></td>
                 </tr>
                 <tr class="CourseName">
                   <td><?php echo $rowMajorReq[1];?></td>
                   <td><?php echo $rowMajorReq[3];?></td>
                   <td><?php echo $rowMajorReq[4];?></td>
                 </tr>
               </tbody> <?php
           }; ?>
       </tbody> <?php
   } else { ?>
       <tr>
         <td colspan="3"> There are currently no course equivalencies for the major core courses. </td>
       </tr> <?php
   } ?>
 </table>
 </div>

<br><br>
 <!--###########################
       MAJOR ELECTIVES
 #############################-->

 <?php
 if ($numMajorCategories) { ?>

   <div id="GenEdTable" style="padding-top:5px;">
   <h3 align="center" class="header whitetext" style="margin-bottom:10px;">Major Electives (<?php echo $user_major;?>)</h3>
   <table align="center" style="width:800px"> <?php

     $idCntr = 0;
     for ($i=0; $i<$numMajorCategories; $i++) {
         $idCntr = $idCntr + 1; ?>

         <thead class="thead-inverse genEdCategoryHeaders toggle" id="GenEdCategory<?php echo $idCntr;?>">
           <tr class = "header">
             <th colspan="3" class="genEdCatHeaders" id="FirstCategory<?php echo $idCntr;?>"><?php echo $rowMajorCategory[$i];?></th>
           </tr>
         </thead> <?php

         if ($numMajorElectiveCourses[$i]) { ?>

             <tbody id="GenEdCourses<?php echo $idCntr;?>" class="genedcat">
               <tr>
                 <th class="genEdCategoryHeaders" width="300px"><?php echo $user_cc;?></th>
                 <th class="genEdCategoryHeaders" width="300px"><?php echo $user_uni;?></th>
                 <th class="genEdCategoryHeaders" width="150px">Credit Hours</th>
               </tr> <?php
               while($rowMajorCourses = $queryMajorCourseByCategory[$i]->fetch()){ ?>
                   <tbody class = "hoverOnCourses">
                     <tr class="CourseNumber">
                       <td><?php echo $rowMajorCourses[0];?></td>
                       <td><?php echo $rowMajorCourses[2];?></td>
                       <td><?php echo $rowMajorCourses[4];?></td>
                     </tr>
                     <tr class="CourseName">
                       <td><?php echo $rowMajorCourses[1];?></td>
                       <td><?php echo $rowMajorCourses[3];?></td>
                       <td><?php echo $rowMajorCourses[4];?></td>
                     </tr>
                   </tbody> <?php
               }; ?>
             </tbody> <?php
       } else { ?>
         <tr>
           <td colspan="3"> There are currently no course equivalencies for this Major Elective category. </td>
         </tr> <?php
       };
   }; ?>
 </table>
</div>
 </div>
</div>
 <?php
 }; ?>

<?php
include '../db_connect.php';

$queryUserEmail = $db ->query("SELECT email FROM users WHERE id = '$user';");//gets user email from ID

while($temp = $queryUserEmail -> fetch()){
  $user_email = $temp[0];
}
?>

<br><br><br>
 <button class = "btn btn-warning" style="color:black;font-weight:700;" onclick="updatePrintLog('<?php echo $user_email; ?>','<?php echo $user_cc;?>','<?php echo $user_uni;?>','<?php echo $user_major;?>')" id = "printBtn"><b>Print My Transfer Guide!</b></button>
 <br>
 <br>
 <p id = "printMsg">Take your transfer guide to your counselor to have a more productive meeting!</p>
 <p id = "printMsg">Be sure to click the General Education Categories before printing so they show on the page</p>

</html>
</div>

<script>
var ctx = document.getElementById("myChart");

var myChart = new Chart(ctx, {
type: 'doughnut',
data: {
  labels: ["Credit at Community College", "Credits at University"],
  datasets: [{
    backgroundColor: [
      "#2ecc71",
      "#3498db"
    ],
    data: [transferrableCredits, totalCredits - transferrableCredits,]
  }]
},
options: {
  animation: {
    duration: 3000,
    animateScale: true,
    cutoutPercentage: 75
  }
},
});
</script>
