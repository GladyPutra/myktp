<?php
include 'koneksi.php';
$query = "SELECT id, matrix_linear_image FROM tbl_detail_citizens";
$sql = mysqli_query($link, $query);
$res = array();
$meanFlatVector = array();
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

if(mysqli_num_rows($sql) > 0){
	$counter = 0;
	while($row = mysqli_fetch_array($sql)){
		$kode = array();
		$kode['matrix_linear_image'] = $row['matrix_linear_image'];
		//Menghitung MeanFlatVector
		preg_match_all('/\d+|[a-z]+/i', $kode['matrix_linear_image'], $matrixLinear);
		for($j=0;$j<count($matrixLinear[0]);$j++){
			if ($counter ==0)
			{
				$meanFlatVector[$j] = $matrixLinear[0][$j];
			}
			if ($counter!=0){
				$meanFlatVector[$j] = $meanFlatVector[$j] + $matrixLinear[0][$j];
			}
		}
		$counter = $counter + 1;
	 }
	$teksMean = "";

	for($i=0;$i<count($matrixLinear[0]);$i++){
		$meanFlatVector[$i] = intval($meanFlatVector[$i] / mysqli_num_rows($sql));
		if ($i != (count($matrixLinear[0]) - 1)){
			$teksMean = $teksMean . $meanFlatVector[$i] . ",";
		}
		else{
			$teksMean = $teksMean . $meanFlatVector[$i];
		}
	}

	//Query Update meanFlatVector
	$queryMeanFlatVector = "UPDATE tbl_detail_citizens SET mean_flat_vector = '".$teksMean."'";
	$sqlqueryMeanFlatVector = mysqli_query($link, $queryMeanFlatVector);

	if (!mysqli_error($link)){
		//Menghitung Eigen Vector
		$sql = mysqli_query($link, $query);
		while($row = mysqli_fetch_array($sql)){
			$kode = array();
			$kode['matrix_linear_image'] = $row['matrix_linear_image'];
			$kode['id'] = $row['id'];
			$teksEigenVector = "";
			preg_match_all('/\d+|[a-z]+/i', $kode['matrix_linear_image'], $matrixLinear);
			//preg_match_all('/\d+|[a-z]+/i', $kode['MEAN_FLAT_VECTOR'], $meanFlatVector);
			$res = array();

			for($i=0;$i<count($matrixLinear[0]);$i++)
			{
				$res[$i] = Abs($matrixLinear[0][$i] - $meanFlatVector[$i] );
				if ($i != (count($matrixLinear[0]) - 1)){
					$teksEigenVector = $teksEigenVector . $res[$i] . ",";
				}
				else
				{
					$teksEigenVector = $teksEigenVector . $res[$i];
				}
			}
			//echo $teksEigenVector;
			//Query Update Eigen Vector
			$queryEigen = "UPDATE tbl_detail_citizens SET eigen_vector = '".$teksEigenVector."' WHERE id = '".$kode['id']."'";
			$sqlEigen = mysqli_query($link, $queryEigen);
		}

		if (!mysqli_error($link)){
			$url = "http://kssc07.bismaoperation.id/api/index.php?message=Training Success";
			header("Location: " . $url);
			die();
		}
		else{
			$url = "http://kssc07.bismaoperation.id/api/index.php?message=Training Failed";
			header("Location: " . $url);
			die();
		}
	}
	else{
		$url = "http://kssc07.bismaoperation.id/api/index.php?message=Training Failed";
		header("Location: " . $url);
		die();
	}
}
?>
