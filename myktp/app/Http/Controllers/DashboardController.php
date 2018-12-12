<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use DB;
use App\Citizen;
use App\DetailCitizen;
use Alert;

class DashboardController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      $citizen = Citizen::orderBy('fullname')->where('deleted_at', NULL)->paginate(25);
      return view('admin.index', compact('citizen'));
  }

  public function detail($id)
  {
      $citizen = Citizen::FindOrFail($id);
      $detailCitizen = DetailCitizen::where('id_citizen', $citizen['id']);

      return view('admin.detail', compact('citizen','detailCitizen'));
  }

  public function loadImage($id)
  {
      $data = DetailCitizen::select('matrix_linear_image')->where('id',$id)->get();

    	foreach($data as $row)
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
  }

  public function edit($id)
  {
      $citizen = Citizen::FindOrFail($id);

      return view('admin.update', compact('citizen'));
  }

  public function update(Request $request, $id)
  {
    try{
      $citizen = Citizen::FindOrFail($id);
      $citizen['fullname'] = $request['fullname'];
      $citizen['nik'] = $request['nik'];
      $citizen['gender'] = $request['gender'];
      $citizen['place_of_birth'] = $request['place_of_birth'];
      $citizen['birth_date'] = $request['birth_date'];
      $citizen['type_blood'] = $request['type_blood'];
      $citizen['address'] = $request['address'];
      $citizen['job'] = $request['job'];
      $citizen['the_status'] = $request['the_status'];
      $citizen['state'] = $request['state'];
      if($citizen->save())
      {
        Alert::success('Update Data Success', 'Success')->persistent('Close');
        return redirect()->route('dashboard');
      }

    }catch (Exception $ex) {
        Alert::error('Update Data Failed', 'Error...!')->persistent('Close');
        return redirect()->route('dashboard');
    }

  }

  public function destroy($id)
  {
    try{
      $citizen = Citizen::FindOrFail($id);
      $citizen->delete();

      Alert::success('Delete Data Success', 'Success')->persistent('Close');
      return redirect()->route('dashboard');

    }catch (Exception $ex) {
        Alert::error('Delete Data Failed', 'Error...!')->persistent('Close');
        return redirect()->route('dashboard');
    }
  }

  public function trainfromweb()
  {
    try {
      $data = DetailCitizen::select('id','matrix_linear_image')->get();
      if(count($data) != NULL)
      {
        	$counter = 0;
        	foreach($data as $row)
          {
        		$kode = array();
        		$kode['matrix_linear_image'] = $row['matrix_linear_image'];
        		//Menghitung MeanFlatVector
        		preg_match_all('/\d+|[a-z]+/i', $kode['matrix_linear_image'], $matrixLinear);
        		for($j=0; $j < count($matrixLinear[0]); $j++)
            {
        			if ($counter ==0){
        				$meanFlatVector[$j] = $matrixLinear[0][$j];
        			}

        			if ($counter!=0){
        				$meanFlatVector[$j] = $meanFlatVector[$j] + $matrixLinear[0][$j];
        			}
        		}
        		$counter = $counter + 1;
        	 }
        	$teksMean = "";

        	for($i=0;$i<count($matrixLinear[0]);$i++)
          {
        		$meanFlatVector[$i] = intval($meanFlatVector[$i] / count($data));
        		if ($i != (count($matrixLinear[0]) - 1)){
        			$teksMean = $teksMean . $meanFlatVector[$i] . ",";
        		}
        		else{
        			$teksMean = $teksMean . $meanFlatVector[$i];
        		}
        	}

        	//Query Update meanFlatVector
          DB::beginTransaction();
          DetailCitizen::where('id','!=',null)->update(['mean_flat_vector' => $teksMean]);
          DB::commit();

      		foreach($data as $row)
          {
      			$kode = array();
      			$kode['matrix_linear_image'] = $row['matrix_linear_image'];
      			$kode['id'] = $row['id'];
      			$teksEigenVector = "";
      			preg_match_all('/\d+|[a-z]+/i', $kode['matrix_linear_image'], $matrixLinear);
      			//preg_match_all('/\d+|[a-z]+/i', $kode['MEAN_FLAT_VECTOR'], $meanFlatVector);
      			$res = array();

      			for($i=0; $i<count($matrixLinear[0]); $i++)
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
            DB::beginTransaction();
            DetailCitizen::where('id', $kode['id'])->update(['eigen_vector' => $teksEigenVector]);
            DB::commit();
      		}
          Alert::error('Training Success', 'Success...!')->persistent('Close');
          return redirect()->route('dashboard');
        }
      } catch (Exception $ex) {
        DB::rollback();
        Alert::error('Training Failed', 'Error...!')->persistent('Close');
        return redirect()->route('dashboard');
      }
  }
}
