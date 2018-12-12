<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'LoginController@login')->name('login.home');
Route::post('/auth', 'LoginController@dologin')->name('login.auth');
Route::get('/logout', 'LoginController@Logout')->name('logout');

// =============== Register ====================== //
// Route::get('/register', 'RegisterController@index')->name('register.index');
// Route::post('/register/store', 'RegisterController@store')->name('register.store');

// ======== DASHBOARD ============= //
Route::get('beranda', 'DashboardController@index')->name('dashboard'); // Dashboard
Route::get('beranda/detail/{id}', 'DashboardController@detail')->name('detail'); // Detail
Route::get('beranda/edit/{id}', 'DashboardController@edit')->name('edit'); // Edit
Route::patch('beranda/update/{id}', 'DashboardController@update')->name('update'); // Edit
Route::delete('beranda/destroy/{id}', 'DashboardController@destroy')->name('destroy'); // Delete
Route::get('beranda/train', 'DashboardController@trainfromweb')->name('trainweb'); // Dashboard
Route::get('beranda/load', 'DashboardController@loadImage')->name('loadImage'); // Dashboard


// Route::patch('/pengguna-kkm/update/{id}', 'RegisterController@update_pengguna')->name('pengguna.update');
// Route::delete('/pengguna-kkm/reset-password/{id}', 'RegisterController@reset_password_pengguna')->name('pengguna.reset_password');
