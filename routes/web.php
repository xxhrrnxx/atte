<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\AttendanceController@index')
    ->middleware(
        ['auth']
    )->name(
        'home'
    );

Route::get(
    '/attendance/daily', function () {
        return view('attendance');
    }
);


require __DIR__ . '/auth.php';


//出退勤打刻
Route::post('/attendance/start', 'App\Http\Controllers\AttendanceController@timein');
Route::post('/attendance/end', 'App\Http\Controllers\AttendanceController@timeout');
//休憩打刻
Route::post('/break/start', 'App\Http\Controllers\RestController@breakin');
Route::post('/break/end', 'App\Http\Controllers\RestController@breakout');
//日次勤怠
Route::get('/attendance/{num}', 'App\Http\Controllers\AttendanceController@attendance');