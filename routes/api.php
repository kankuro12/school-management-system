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

Route::middleware('auth:api')->group(function(){
    Route::post('test', "Setup\SchoolController@test");
    //XXX Get and verify user
    Route::get('user', 'Auth\LoginController@user');
    //XXX Manage list of schools
    Route::match(['get', 'post'], 'schools', "Setup\SchoolController@index");
    Route::post( 'schools/updateInfo', "Setup\SchoolController@updateInfo");
    Route::post( 'schools/updateEmail', "Setup\SchoolController@updateEmail");
    Route::post( 'schools/updatePassword', "Setup\SchoolController@updatePassword");

    //XXX manage levels and sections
    Route::match(['get', 'post'], 'levels/list/{school_id}', "Setup\LevelController@index");
    Route::match(['get', 'post'], 'levels/add', "Setup\LevelController@add");
    Route::post( 'levels/update', "Setup\LevelController@update");
    Route::post( 'levels/delete', "Setup\LevelController@delete");

    Route::post('section/add', "Setup\LevelController@addSection");
    Route::post( 'section/update', "Setup\LevelController@updateSection");
    Route::post( 'section/delete', "Setup\LevelController@deleteSection");
});

Route::post('login', 'Auth\LoginController@emaillogin');




