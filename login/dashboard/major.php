<?php
session_start();
require 'db_connect_clearmaze.php';
?>

<body>

<!-- <h3 align="center" class="header whitetext">Choose Your Major</h3> -->

<?php
  $uni = trim($_GET['uni']);
  $_SESSION['uni'] = $uni;
  $cc = $_SESSION['cc'];
?>


<form align="center">
	<select id = "major" class="dropbtn" onmouseover="DropListMajor()"
  onmouseout="this.size=1;" onchange="loadTransferGuide(this.value,'<?php echo $uni; ?>','<?php echo $cc; ?>')">
    <?php
    echo '<option value=""> Choose your major </option>';
		$query = $db -> query("SELECT major FROM majors WHERE university = '".$uni."' ORDER BY major;");
		while($row = $query -> fetch()){
            echo '<option value = "'.$row['major'].'">' ?>
			<?php echo $row['major'].'<br>' ?> <?php '</option>';
		}

	 ?>

	</select>

</form>

</body>
