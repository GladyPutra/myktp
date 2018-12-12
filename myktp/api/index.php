<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initialscale=1">
		<title>Remind Me</title>
	</head>

	<body style="background-image:url('bg_sub.png');background-size:1366px 768px;background-repeat: no-repeat;">
		<div width="100%">
			<div align = "center">`
				<label style="color: Black; fontsize:50px">REMIND ME</label>
			</div>
		<div style="border: solid" align = "center"></div>
			<div align="right" style="padding: 0px 20px 0px 0px;">Welcome<label> || </label>
				<a class="blog-nav-item active" href="Login.php">Logout</a>
			</div>
		</div>
		<div style="padding-top:50px" width="100%">
			<div class="row" width="100%">
				<a class="blog-nav-item active" href="http://kssc07.bismaoperation.id/api/TrainFromWeb.php">Training Data</a>
				<div style="padding-bottom:10px"></div>
			<div>
				<?php include 'koneksi.php';
				if(!empty($_GET['message'])) {
					$message = $_GET['message'];
					echo $message;
				}
				$query = "SELECT id, fullname, nik, gender, place_of_birth, DATE_FORMAT(birth_date,'%d-%M-%Y') AS birth_date, type_blood,
								address, job, the_status, state FROM tbl_citizens";
				$result = mysqli_query($link,$query);
				if(mysqli_num_rows($result) > 0){
					echo "<table border=1 align='center' cellpadding='10' width='100%'>";
					echo "<tr>";
					echo "<td align='center' sytle=''><label><b>Id Citizen</b></label></td>";
					echo "<td align='center'><label><b>Fullname</b></label></td>";
					echo "<td align='center'><label><b>NIK</b></label></td>";
					echo "<td align='center'><label><b>Gender</b></label></td>";
					echo "<td align='center'><label><b>Place of Birth</b></label></td>";
					echo "<td align='center'><label><b>Birth Date</b></label></td>";
					echo "<td align='center'><label><b>Type of Blood</b></label></td>";
					echo "<td align='center'><label><b>Address</b></label></td>";
					echo "<td align='center'><label><b>Job</b></label></td>";
					echo "<td align='center'><label><b>Status</b></label></td>";
					echo "<td align='center'><label><b>State</b></label></td>";
					echo "<td align='center'><label><b>Face Database</b></label></td>";
					echo "<td align='center'><label><b>Edit</b></label></td>";
					echo "<td align='center'><label><b>Delete</b></label></td>";
					echo "</tr>";
					while($row = mysqli_fetch_array($result)){
						$idInfo = $row['id'];
						$queryDetail = "SELECT COUNT(id) AS COUNT FROM tbl_detail_citizens WHERE id_citizen = '$idInfo'";
						$resultDetail =	mysqli_query($link, $queryDetail);
						while($rowDet =	mysqli_fetch_array($resultDetail)){
							$countImg =	$rowDet['COUNT'];
						}
						echo "<tr>";
						echo "<td align='center'><label>". $row['id'] ." </label></td>";
						echo "<td align='center'><label>" . $row['fullname'] . "</label></td>";
						echo "<td align='center'><label>" . $row['nik'] . " </label></td>";
						echo "<td align='center'><label>" . $row['gender'] . " </label></td>";
						echo "<td align='center'><label>" . $row['place_of_birth'] . " </label></td>";
						echo "<td align='center'><label>" . $row['birth_date'] . " </label></td>";
						echo "<td align='center'><label>" . $row['type_blood'] . " </label></td>";
						echo "<td align='center'><label>" . $row['address'] . " </label></td>";
						echo "<td align='center'><label>" . $row['job'] . " </label></td>";
						echo "<td align='center'><label>" . $row['the_status'] . " </label></td>";
						echo "<td align='center'><label>" . $row['state'] . " </label></td>";
						echo "<td align='center'><label>" . $countImg . " images </label><a class='blog-nav-item active' href='viewImages.php?id=".
							$row['id'] . "'>Click for details</a></td>";
						echo "<td align='center'><a class='blog-nav-item active' href='EditData.php?id= ".
							$row['id'] . "&name=". $row['fullname'] . "&bd=".
							$row['birth_date'] . "&address=". $row['address'] . "&ch=".
							$row['place_of_birth'] . "'>Edit</a><label></td>";
						echo "<td align='center'><a class='blog-nav-item active' href='deleteData.php?id= ".
							$row['id'] . "'>Delete</a><label></td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				?>
			</div>
		</div>
	</body>
</html>
