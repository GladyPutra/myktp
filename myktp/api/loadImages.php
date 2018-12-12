<?php
	include 'koneksi.php';
	$id = $_GET["id"];
	$query = "SELECT matrix_linear_image FROM tbl_detail_citizens WHERE id = '" . $id . "'";
	$result = mysqli_query($link,$query);

	while($row = mysqli_fetch_array($result))
	{
		preg_match_all('/\d+|[a-z]+/i', $row['matrix_linear_image'], $matrixLinear);
		// Grab the dimensions of the pixel array
		$size =sqrt(count($matrixLinear[0]));
		$width = $size;
		$height = $size;
		$i=0;
		// Create the image resource
		$img = imagecreatetruecolor($width, $height);
		// Set each pixel to its corresponding color stored in $pixelArray
		for ($y = 0 ; $y < $width ; ++$y)
		{
			for ($x = 0; $x < $height; ++$x)
			{
				$colorImage = imagecolorallocate($img,$matrixLinear[0][$i], $matrixLinear[0][$i], $matrixLinear[0][$i]);
				imagesetpixel($img, $y, $x, $colorImage);
				$i++;
			}
		}
	// Save image to server
	// Dump the image to the browser
	header('Content-Type: image/png');
	imagepng($img);
	// Clean up after ourselves
	imagedestroy($img);
	}
?>
