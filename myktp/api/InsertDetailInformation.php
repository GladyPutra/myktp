<?php
	$response = array();
	$connect = mysqli_connect("localhost", "bismaope_kssc07", "kssc07", "bismaope_kssc07");

if(mysqli_connect_errno($connect))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$idCitizen = isset($_POST['idCitizen']) ? $_POST['idCitizen'] : '';
	$matrixLinearImage = isset($_POST['matrixLinearImage']) ? $_POST['matrixLinearImage'] : '';
	$eigenVector=isset($_POST['eigenVector']) ? $_POST['eigenVector'] : '';
	$meanFlatVector=isset($_POST['meanFlatVector']) ? $_POST['meanFlatVector']: '';

	$query = mysqli_query($connect, "INSERT INTO tbl_detail_citizens(id_citizen, matrix_linear_image, eigen_vector, mean_flat_vector)
	VALUES('$idCitizen','$matrixLinearImage','$eigenVector','$meanFlatVector') ");
	// check if row inserted or not
	if ($query) {
		// successfully inserted into database
		$response["success"] = 1;
		$response["message"] = "Detail Information successfully created.";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// failed to insert row
		$response["success"] = 0;
		$response["message"] = "Oops! An error occurred.";
		// echoing JSON response
		echo json_encode($response);
	}
}
mysqli_close($connect);

?>
