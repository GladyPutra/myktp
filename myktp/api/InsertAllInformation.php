<?php
	$response = array();
	$connect = mysqli_connect("localhost", "bismaope_kssc07", "kssc07", "bismaope_kssc07");


if(mysqli_connect_errno($connect))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$name = isset($_POST['name']) ? ucwords($_POST['name']) : '';
	$nik = isset($_POST['nik']) ? $_POST['nik'] : '';
	$gender = isset($_POST['gender']) ? ucwords($_POST['gender']) : '';
	$placeOfBirth = isset($_POST['placeOfBirth']) ? ucwords($_POST['placeOfBirth']) : '';
	$birthDate = isset($_POST['birthDate']) ? trim(date('Y-m-d',strtotime($_POST["birthDate"]))) : '';
	// $birthDate = trim(date('Y-m-d',strtotime($_POST["birthDate"])));
	$address=isset($_POST['address']) ? ucwords(trim($_POST['address'])) : '';
	$blood = isset($_POST['blood']) ? $_POST['blood'] : '';
	$job = isset($_POST['job']) ? ucwords($_POST['job']) : '';
	$status = isset($_POST['status']) ? ucwords($_POST['status']) : '';
	$state = isset($_POST['state']) ? $_POST['state'] : '';

	$query = mysqli_query($connect, "INSERT INTO tbl_citizens(fullname, nik, gender, place_of_birth, birth_date, type_blood, address, job, the_status, state)
	VALUES('$name','$nik', '$gender', '$placeOfBirth','$birthDate','$blood','$address','$job','$status','$state') ");
	// check if row inserted or not
	if ($query) {
		// successfully inserted into database
		$response["success"] = 1;
		$response["id"] = mysqli_insert_id($connect);
		// echoing JSON response
		echo json_encode($response);
	} else {
		// failed to insert row
		$response["success"] = 0;
		$response["id"] = 0;
		// echoing JSON response
		echo json_encode($response);
	}
}
mysqli_close($connect);

?>
