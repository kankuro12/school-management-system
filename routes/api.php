<?php

use App\ApiData as res;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('test', "Setup\SchoolController@test");
Route::middleware('auth:api')->group(function(){
    //XXX Get and verify user
    Route::get('user', 'Auth\LoginController@user');
    ///XXX Auth Routes
    Route::post( 'user/updateEmail', "Auth\AuthController@updateEmail");
    Route::post( 'user/updatePassword', "Auth\AuthController@updatePassword");
    //XXX Manage list of schools
    Route::match(['get', 'post'], 'schools', "Setup\SchoolController@index");
    Route::post( 'schools/updateInfo', "Setup\SchoolController@updateInfo");
    // Route::get('schools/get',"Setup\SchoolController@info")

    //XXX manage levels and sections
    Route::match(['get', 'post'], 'levels/list/{school_id}', "Setup\LevelController@index");
    Route::match(['get', 'post'], 'levels/add', "Setup\LevelController@add");
    Route::post( 'levels/update', "Setup\LevelController@update");
    Route::post( 'levels/delete', "Setup\LevelController@delete");
    Route::post('section/add', "Setup\LevelController@addSection");
    Route::post( 'section/update', "Setup\LevelController@updateSection");
    Route::post( 'section/delete', "Setup\LevelController@deleteSection");

    //XXX manage staff
    Route::get('staffs/list/{school_id}',"Setup\StaffController@index" );
    Route::post('staffs/add',"Setup\StaffController@add" );
    Route::post('staffs/update',"Setup\StaffController@update" );
    Route::post('staffs/delete',"Setup\StaffController@delete" );
    Route::post('staffs/archive',"Setup\StaffController@archive" );
    Route::get('staffs/listdoc/{staff_id}',"Setup\StaffController@listDoc" );
    Route::post('staffs/adddoc',"Setup\StaffController@addDoc" );
    Route::post('staffs/deldoc',"Setup\StaffController@delDoc" );

});

Route::post('login', 'Auth\LoginController@emaillogin');




