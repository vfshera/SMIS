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


//terms
Route::middleware('auth:api')->post('/add-term', 'API\TermsController@store');
Route::middleware('auth:api')->get('/terms', 'API\TermsController@index');
Route::middleware('auth:api')->get('/delete-term/{id}', 'API\TermsController@destroy');


//teachers
Route::middleware('auth:api')->get('/teachers', 'API\TeachersController@getTeachers');
Route::middleware('auth:api')->get('/loggedteachers', 'API\UserResourceController@teachers');
Route::middleware('auth:api')->post('/add-teacher-info', 'API\TeachersController@store');
Route::middleware('auth:api')->delete('/delete-teacher/{id}', 'API\TeachersController@destroy');


//duties
Route::middleware('auth:api')->post('/add-duty', 'API\DutiesController@store');
Route::middleware('auth:api')->delete('/delete-duty/{id}', 'API\DutiesController@destroy');
Route::middleware('auth:api')->get('/reload-duty/{id}', 'API\DutiesController@getTeacherDuties');
Route::middleware('auth:api')->get('/duties', 'API\DutiesController@getDuties');


//timetable
Route::middleware('auth:api')->post('/add-timetable', 'API\TimetablesController@store');
Route::middleware('auth:api')->get('/timetables', 'API\TimetablesController@index');

//subjects
Route::middleware('auth:api')->get('/subjects', 'API\SubjectsController@allsubjects');
Route::middleware('auth:api')->post('/add-subject', 'API\SubjectsController@store');
Route::middleware('auth:api')->delete('/delete-sub/{id}', 'API\SubjectsController@destroy');

