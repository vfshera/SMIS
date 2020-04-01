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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//users
Route::middleware('auth:api')->get('/allusers', 'API\UserResourceController@allUsers');
Route::middleware('auth:api')->get('/users', 'API\UserResourceController@root');

//students
Route::middleware('auth:api')->get('/loggedstudents', 'API\UserResourceController@students');
Route::middleware('auth:api')->get('/students', 'API\StudentsController@students');
Route::middleware('auth:api')->post('/add-student-info', 'API\StudentsController@store');
Route::middleware('auth:api')->delete('/delete-student/{id}', 'API\StudentsController@destroy');

//forms
Route::middleware('auth:api')->get('/forms', 'API\FormController@allforms');
Route::middleware('auth:api')->post('/add-form', 'API\FormController@store');

//streams
Route::middleware('auth:api')->get('/streams', 'API\StreamsController@allstreams');
Route::middleware('auth:api')->post('/add-stream', 'API\StreamsController@store');

//classrooms
Route::middleware('auth:api')->get('/classes', 'API\ClassroomsController@allclasses');
Route::middleware('auth:api')->get('/classes/{id}', 'API\ClassroomsController@getClass');
Route::middleware('auth:api')->post('/add-class', 'API\ClassroomsController@store');

//teachers
Route::middleware('auth:api')->get('/teachers', 'API\UserResourceController@teachers');


//subjects
Route::middleware('auth:api')->get('/subjects', 'API\SubjectsController@allsubjects');
Route::middleware('auth:api')->post('/add-subject', 'API\SubjectsController@store');
Route::middleware('auth:api')->post('/delete-sub/{id}', 'API\SubjectsController@destroy');

