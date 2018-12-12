<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initialscale=1">
		<title>My-KTP | Indonesia </title>
    <!------------------------------------------ ICON-------------->
    <link rel="icon" href="logo.png" type="image" sizes="16x16">
	</head>

	<body style="background-image:url('bg_sub.png');background-size:1366px 768px;background-repeat: no-repeat;">
		<div>
			<div style="border: solid" align = "center"></div>
		</div>
		<div style="padding-top:50px">
		<div class="row">
		<div style="padding-bottom:10px"></div>
		<div>
			<?php include 'koneksi.php';
				$query = "SELECT DI.id, I.fullname, DI.matrix_linear_image FROM tbl_citizens I
						 JOIN tbl_detail_citizens DI ON(DI.id_citizen = I.id)
						 WHERE DI.id_citizen = ".trim($_GET["id"])."";
				$result = mysqli_query($link,$query);
				$resultName = mysqli_query($link,$query);
				$num_rows = mysqli_num_rows($result);
				$arr = mysqli_fetch_array($resultName);
				$maksColImage = 4;
				?>
				<table cellpadding="10">
				<tr>
				<td>
				<label>Face Name : [ <?php echo	$arr["fullname"]; ?> ]</label>
				</td>
				</tr>
				</table>
				<table cellpadding="10" border=1 align="left" width = "100%">
			<?php
				$counter = 1;
				$col = 1;
				while($row = mysqli_fetch_array($result))
				{
					preg_match_all('/\d+|[az]+/i', $row['matrix_linear_image'], $matrixLinear);
					//echo
					sqrt(count($matrixLinear[0]));
					$id = $row['id'];
					if ($col == 1)
					{
						echo "<tr>";
					}
					if ($col == $maksColImage+1)
					{
						echo "<tr>";
						$col = 1;
					}
					?>
					<td align="center">Image - <?php echo $counter; ?>
						<table align="center">
						<tr>
							<td><img border="1" src="loadImages.php?id= <?php echo $id ?>" alt="Error Load Images" width="<?php echo
									sqrt(count($matrixLinear[0])) * 2;?>" ></td>
						</tr>

						</table>
							</td>
							<?php
							if ($counter == $maksColImage)
							{
								echo "</tr>";
							}
							if ($counter == $num_rows)
							{
								echo "</tr>";
							}
							$counter++;
							$col++;
						}
						echo "</table>";
					?>
			</div>
		</div>
	</body>
</html>
