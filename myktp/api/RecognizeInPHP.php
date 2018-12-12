<?php
  $connect = mysqli_connect("localhost", "bismaope_kssc07", "kssc07", "bismaope_kssc07");

  if(mysqli_connect_error($connect))
  {
    echo "Failed to connect to MySQL : " . mysqli_connect_error();
  }
  else {
    $matrixLinearImage = isset($_POST['matrixLinearImage']) ? $_POST['matrixLinearImage'] : '';
    $query = "SELECT id_citizen, id, mean_flat_vector, eigen_vector FROM tbl_detail_citizens ORDER BY id_citizen ASC";

    $sql = mysqli_query($connect, $query);
    $eigenValue = array();
    $distance = array();
    $countDistance = 0;
    $idShortDistance = 0;
    $shortDistanceDistance = 0;

    if(mysqli_num_rows($sql) > 0 ){
      $counter = 0;
      while($row = mysqli_fetch_array($sql)){
        $countDistance = 0;
        $kode = array();
        $kode['id_citizen'] = $row['id_citizen'];
        $kode['id'] = $row['id'];
        $kode['mean_flat_vector'] = $row['mean_flat_vector'];
        $kode['eigen_vector'] = $row['eigen_vector'];

        preg_match_all('/\d+|[a-z]+/i', $matrixLinearImage, $matrixLinear);
        preg_match_all('/\d+|[a-z]+/i', $kode['mean_flat_vector'], $meanFlatVector);
        preg_match_all('/\d+|[a-z]+/i', $kode['eigen_vector'], $eigenVector);

        if($counter == 0){
          for($i =0;$i<count($matrixLinear[0]); $i++){
            $eigenValue[$i] = Abs($matrixLinear[0][$i] - $meanFlatVector[0][$i]);
          }
        }

        for($i=0;$i<count($eigenVector[0]);$i++){
          $distance[$i] = Abs($eigenVector[0][$i] - $eigenValue[$i]);
          $countDistance = $countDistance + $distance[$i];
        }

        if($counter == 0){
          $shortDistanceDistance = $countDistance;
          $idShortDistance = $kode['id'];
        }
        else{
          if($countDistance < $shortDistanceDistance){
            $shortDistanceDistance = $countDistance;
            $idShortDistance = $kode['id'];
          }
        }
        $counter = $counter + 1;
      }
    }


    $queryInformation = "SELECT I.fullname, I.nik, I.gender, I.place_of_birth, DATE_FORMAT(I.birth_date, '%d-%M-%Y') AS birth_date,
     I.type_blood, I.address, I.job, I.the_status, I.state, DI.matrix_linear_image
     FROM tbl_detail_citizens DI JOIN tbl_citizens I ON (I.id = DI.id_citizen) WHERE DI.id = ".$idShortDistance."";

    $sqlInformation = mysqli_query($connect, $queryInformation);
    $response = array();

    if(mysqli_num_rows($sqlInformation) > 0){
      $response['Recognize'] = array();
      while($row = mysqli_fetch_array($sqlInformation)){
        $kode = array();
        $kode['fullname'] = $row['fullname'];
        $kode['nik'] = $row['nik'];
        $kode['gender'] = $row['gender'];
        $kode['place_of_birth'] = $row['place_of_birth'];
        $kode['birth_date'] = $row['birth_date'];
        $kode['type_blood'] = $row['type_blood'];
        $kode['address'] = $row['address'];
        $kode['job'] = $row['job'];
        $kode['status'] = $row['the_status'];
        $kode['state'] = $row['state'];
        $kode['matrix_linear_image'] = $row['matrix_linear_image'];
        $kode['distance'] = $shortDistanceDistance;
        $name = $row['fullname'];

        array_push($response['Recognize'], $kode);
      }
      echo json_encode($response);
    }
  }

 ?>
