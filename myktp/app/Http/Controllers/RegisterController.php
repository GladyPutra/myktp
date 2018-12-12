<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\StoreRequest;
use Alert;
use DB;
use Carbon\Carbon;
use App\User;
use App\Pkm;
use App\Prodi;
use App\Role;

class RegisterController extends Controller
{

    public function index()
    {
        return view('register.index');
    }

    public function store(StoreRequest $request)
    {
      try
      {
        $user = new User();
        $user['name'] = $request['name'];
        $user['nik'] = $request['nik'];
        $user['username'] = $request['nik'];
        $user['password'] = bcrypt($request['password']);
        if($user->save())
        {
          Alert::success('Thank You for Register', 'Success')->persistent('Close');
          return redirect()->route('login.index');
        }

      } catch (Exception $ex) {
          Alert::error('Register Failed', 'Error...!')->persistent('Close');
          return redirect()->route('login.index');
      }
    }
}
