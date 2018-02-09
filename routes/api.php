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

Route::post('/getUserName','UserController@GetUsername');

Route::post('/viewProfile','UserController@ViewProfile');

Route::post('/viewPoints','UserController@ViewPoints');





Route::post('/send','RequestController@sendRequest');

Route::post('/display','RequestController@displayRequest');

Route::post('/displayDogFoodRequest','RequestController@displayDogFoodRequest');

Route::post('/itemClick','RequestController@listItemClick');

Route::post('/dogFooditemClick','RequestController@DogFoodlistItemClick');

Route::post('/sendDogFood','RequestController@sendDogFoodRequest');





Route::post('/collectorLogin','CollectorController@CollectorLogin');

Route::post('/collectorLogin','CollectorController@Login');

Route::post('/getLocations','CollectorController@sendLocations');

Route::post('/getDogFoodLocations','CollectorController@sendDogFoodLocations');

Route::post('/collectorSend','CollectorController@collectorSend');

Route::post('/collectorDogFoodSend','CollectorController@collectorDogFoodSend');

Route::post('/pointsRedeem','CollectorController@PointsRedeem');











