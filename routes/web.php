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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getUserList', 'UserDetailsController@index')->middleware("cors");
Route::delete('/deleteUser/{id}', 'UserDetailsController@destroy')->middleware("cors");
Route::post('/storeUser', 'UserDetailsController@store')->middleware("cors");
Route::get('/getRoles', 'UserDetailsController@getRoles')->middleware("cors");

// // Route::resource('/', UserDetailsController::class);

// Route::resource('crud', 'CRUDController');
// Route::get('posttest', 'PostController@index');
// Route::get('post', 'PostController@show');
// Route::get('postdetails/{id}', 'PostController@postdetails');
// Route::get('add', 'PostController@add');
// Route::post('insertdata', 'PostController@insertdata');

