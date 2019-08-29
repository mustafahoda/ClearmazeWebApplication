<?php
	session_start();
	require 'db_connect.php';
	include 'queries.php';

	$user_cc = $_SESSION['cc'];
	$user_uni = $_SESSION['uni'];
	$user_major = trim($_GET['major']);

?>

<body>
	<!--*******************************
					POWER INFO FOR STUDENT
	*********************************!-->

	<br>
	<br>

<div id="TailoredTransferGuide">



		<!--######################################
								 GEN ED TABLE
		########################################-->

		<?php if ($numGenEdHeaders) { ?>
		<div id="GenEdTable" style="padding-top:5px;">
			<h3 align="center" class="header whitetext" style="margin-bottom:10px;">General Education Categories</h3>
			<table align="center" class="table" style="width:800px"> <?php
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

	<!--###########################
					MAJOR TABLE
	#############################-->

	<div id="MajorTable" style="padding-top:5px;">
	<h3 align="center" class="header whitetext" style="margin-bottom:10px;">Major Core (<?php echo $user_major;?>)</h3>
	<table style = "width:800px" align = "center" class = "table-sm table-responsive table">

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


	<!--###########################
				MAJOR ELECTIVES
	#############################-->

	<?php
	if ($numMajorCategories) { ?>

		<div id="GenEdTable" style="padding-top:5px;">
		<h3 align="center" class="header whitetext" style="margin-bottom:10px;">Major Electives (<?php echo $user_major;?>)</h3>
		<table align="center" class="table" style="width:800px"> <?php

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
	</div> <?php
	}; ?>


</div>

<!-- Modal Implementation -->
<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title">Sign Up for a Free Account</h1>
      </div>

			<div class = "modal-body">
				<h3>Transfer Guides are neat and all ... but these additional features will <b>ease your transfer process significantly.</b> Sign up for a <b>free</b> account so you can benefit from these features.</h3>
				<div class="row" id = "modalRow">
					<div class="reasons container-fluid col-lg-3 col-md-3 col-sm-3" id="charts">
							<span class="glyphoicon glyphicon glyphicon-stats"></span>
							<p style="margin:15px">Cool charts to visualize your potential degree progress</p>
					</div>
					<div class="reasons container-fluid col-lg-3 col-md-3 col-sm-3" id="finance">
							<span class="glyphoicon glyphicon glyphicon-comment"></span>
							<p style="margin:15px">All your important contact information for your institutions in one centralized place including email, website, and phone number</p>
					</div>
					<div class="reasons container-fluid col-lg-3 col-md-3 col-sm-3" id="print">
							<span class="glyphicon glyphicon-print"></span>
							<p style="margin:15px">Print out a PDF to bring to your advisor so you can have a productive meeting</p>
					</div>
					<div class="reasons container-fluid col-lg-3 col-md-3 col-sm-3" id="save">
							<span class="glyphicon glyphicon-check"></span>
							<p style="margin:15px">Save and track degree progress</p>
							<p style="font-size: 10px">(coming soon!)</p>
					</div>

						<!-- <div class="reasons container-fluid col-lg-3 col-md-3 col-sm-3" id="finance">
								<span class="glyphoicon glyphicon glyphicon-usd"></span>
								<p style="margin:15px">Get a Financial Outlook on your degree and see what it pays</p>
						</div> -->

				</div>
				<p>
					What are you waiting for? Sign up!
				</p>
			</div>

      <div class="modal-footer">
        <button align = "center" type="button" class="btn btn-success btn-lg" data-dismiss="modal" onclick="location.href = '../login/register.php';">Sign Up Now!</button>

      </div>
    </div>

  </div>
</div>

<br>
<br>
<br>

</body>
