<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use File;
use Alert;
use App\User;
use App\Berkas;

class LoginController extends Controller
{
    public function home()
    {
      return view('login');
    }

    public function index()
    {
      $pedoman = Berkas::orderBy('id')->where('kategori', 4)->first();
      return view('login', 'pedoman');
    }

    public function login()
    {
      if(Auth::check()) {
        return redirect()->route('dashboard');
        // echo "Anda Telah Login";
      }
      else {
        return view('login');
      }
    }

    public function dologin(Request $request)
    {
      $user_data = $request->except('_token');

      if(Auth::attempt($user_data))
      {
        return redirect()->route('dashboard');
        // echo "Anda Telah Login";
      }
      else
      {
        Auth::logout();
        Alert::error('Username or Password is Wrong', 'Warning!')->persistent('Close');
        return redirect()->route('login.index');
      }
    }

    public function Logout()
    {
      if(Auth::check()) {
        Auth::logout();
        Alert::success('Thank You...')->persistent('Close');
        return redirect()->route('login.home');
      }
      else {
        return view('login');
      }
    }

    public function download_pedoman()
    {
        $pedoman = Berkas::orderBy('id')->where('kategori', 4)->first();
        if(!empty($pedoman))
        {
            $path = $pedoman->lokasi;
            if(File::exists($path))  // mengecek folder
            {
              return response()->file($path);
            }
            else {
              return response()->view('exception.filenotfound', [], 404);
            }
        }
        else {
          return response()->view('exception.filenotfound', [], 404);
        }

    }
}
