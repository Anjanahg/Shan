<?php

/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
|
| Web Routes
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});
Route::post('reg','EmployeeController@regadmin');
Route::post('/log','EmployeeController@logadmin');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');



  //////////add a new employee//////
Route::get('/empcrud','EmployeeController@read');
Route::get('/addemp', function () {
   return view('addemp');
});
Route::post('add_emp','EmployeeController@add');

////////delete an employee/////
Route::get('/employee/delete/{id}','EmployeeController@delete');
////////update an employee////
Route::get('/employee/update/{id}','EmployeeController@update');
Route::post('update_data','EmployeeController@update_data');



//////////add a new area//////
Route::get('/addarea', function () {
    return view('addarea');
});

Route::post('add_area','AreaController@add');
Route::get('/areacrud','AreaController@read');

////////delete an area/////
Route::get('/area/delete/{id}','AreaController@delete');
////////update an area////
Route::get('/area/update/{id}','AreaController@update');
Route::post('update_data_area','AreaController@update_data_area');


/////graphs////////
Route::get('/stat','reportController@getnewUserRegister');
Route::get('/gRequest','gRequestController@getnewRequests');
Route::get('/totalGarbage','totalGarbageController@totalCollectedGaerbage');
Route::get('/areaTotalGarbage','totalAreaGarbageController@areaGarbage');




///////update point details///////
Route::get('/managePoints','PointsController@read');
Route::get('/points/update/{id}','PointsController@update');
Route::post('/update_data_points','PointsController@update_data_points');




////////////complains//////////////


Route::get('/viewcomp','complainsController@read');

Route::get('/complains/update/{id}','complainsController@update');
Route::post('/update_data_complains','complainsController@update_data_complains');

/////////view requests///////

Route::get('/requestcrud','RequestController@read');


/////////search points///////
Route::get('/searchpoints', function () {
    return view('searchpoints');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
