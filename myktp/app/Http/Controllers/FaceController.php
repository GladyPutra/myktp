<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Citizen;
use App\DetailCitizen;
use Carbon\Carbon;

class FaceController extends Controller
{

    public function insert()
    {
      // $this->validate($request, [
      //       'name' => 'required',
      //       'nik' => 'required|numeric',
      //       'place_of_birth' => 'required',
      //       'birth_date' => 'required',
      //       'type_blood' => 'required',
      //       'address' => 'required',
      //       'job' => 'required',
      //       'status' => 'required',
      //   ]);

      try
      {
        $citizen = new Citizen;
        $citizen['name'] = Input::get('name');
        $citizen['nik'] = Input::get('nik');

        if($citizen->save())
        {
          $result = [
            'status' => 'true',
            'status_code' => 200,
            'message' => 'Insert Citizen Success',
            'info' => $data
          ];
        }
        else
        {
          $result = [
            'status' => 'failed',
            'status_code' => 201,
            'message' => 'Insert Citizen Failed'
          ];
        }
        return response()->json($result);

      } catch (Exception $ex) {
        DB::rollback();
        $result = [
          'status' => 'false',
          'status_code' => 500,
          'message' =>'Insert Citizen Failed',
          'info' => $ex
        ];
        return response()->json($result);
      }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
