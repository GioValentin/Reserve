<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'reservation'],function(){

	Route::post('/','ReservationController@create');
	Route::put('/{company}/{entity}/{reservation}', 'ReservationController@update');
	Route::get('/{company}/{entity}/{reservation}','ReservationController@get');
	Route::delete('/{company}/{entity}/{reservation}','ReservationController@delete');

});

Route::group(['prefix' => 'company'], function(){

	// Manage Entites
	Route::group(['prefix' => 'entity'], function(){
		Route::post('/', 'EntityController@create');
		Route::put('/{id}', 'EntityController@update');

		Route::get('/{id}', 'EntityController@get');
		Route::delete('/{id}', 'EntityController@delete');
	});

	//Manage Company
	Route::post('/', 'CompanyController@create');
	Route::put('/{id}', 'CompanyController@update');
	Route::get('/{company_name}/{id}', 'CompanyController@get');
});

