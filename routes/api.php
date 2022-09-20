<?php

use Illuminate\Http\Request;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group(['middleware' => ['api','checkPassword','checkApiLanguage'], 'namespace' => 'App\Http\Controllers\Api'],function(){
	
	Route::post('get_main_categories','CategoriesController@index');
	
	Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
		
		Route::post('login','AuthController@login');	
	});
}); 

Route::group(['prefix' => 'admin' , 'middleware' => ['api','checkPassword','checkApiLanguage','auth_guard:admin_api'], 'namespace' => 'App\Http\Controllers\Api\Admin'],function(){
	
	Route::post('/','AdminController@index');
	Route::post('logout','AuthController@logout');
	
}); 


Route::group(['prefix' => 'user', 'namespace' => 'App\Http\Controllers\Api' ],function(){
	
	Route::post('login', 'UserController@login');
	
	Route::group(['middleware' => 'auth_guard:api'],function(){
		Route::post('/','UserController@index');
		Route::post('logout','UserController@logout');
	});	
	
});
