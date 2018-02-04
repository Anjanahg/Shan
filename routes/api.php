<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the
"api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','UserController@Register');

Route::post('/spinner','UserController@Spinner');

Route::post('/login','UserController@Login');
Route::post('/send','RequestController@sendRequest');

Route::post('/display','RequestController@displayRequest');

Route::post('/itemClick','RequestController@listItemClick');

Route::post('/collectorLogin','CollectorController@CollectorLogin');

Route::post('/getLplaces','CollectorController@Lplaces');

Route::post('/collectorLogin','CollectorController@Login');

Route::post('/getLocations','CollectorController@sendLocations');

Route::post('/collectorSend','CollectorController@collectorSend');







