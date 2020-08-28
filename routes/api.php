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
Route::middleware('auth:api')->get('/dashStat', 'API\UserResourceController@dashCount');
Route::middleware('auth:api')->get('/users', 'API\UserResourceController@root');


//UPLOADS
Route::middleware('auth:api')->post('/myuploads', 'API\UploadsController@store');
Route::middleware('auth:api')->get('/uploads', 'API\UploadsController@uploads');
Route::middleware('auth:api')->get('/papers', 'API\UploadsController@papers');
Route::middleware('auth:api')->get('/notes', 'API\UploadsController@notes');
Route::middleware('auth:api')->delete('/delete-upload/{id}', 'API\UploadsController@destroy');
Route::middleware('auth:api')->get('/download-file/{id}', 'API\UploadsController@getFile');


//news
Route::middleware('auth:api')->get('/newsposts', 'API\NewsController@index');
Route::middleware('auth:api')->post('/newspost', 'API\NewsController@create');
Route::middleware('auth:api')->get('/news-post/{id}', 'API\NewsController@onePost');
Route::middleware('auth:api')->post('/update-news', 'API\NewsController@update');
Route::middleware('auth:api')->delete('/delete-news/{id}', 'API\NewsController@destroy');


//messages
Route::middleware('auth:api')->get('/messages', 'API\MessagesController@index');
Route::middleware('auth:api')->post('/message', 'API\MessagesController@sendMessage');
Route::middleware('auth:api')->get('/recievers', 'API\MessagesController@receivers');
Route::middleware('auth:api')->post('/read/{id}', 'API\MessagesController@read');
Route::middleware('auth:api')->delete('/delete-msg/{id}', 'API\MessagesController@destroy');

//students
Route::middleware('auth:api')->get('/loggedstudents', 'API\UserResourceController@students');
Route::middleware('auth:api')->get('/students', 'API\StudentsController@students');
Route::middleware('auth:api')->post('/add-student-info', 'API\StudentsController@store');
Route::middleware('auth:api')->delete('/delete-student/{id}', 'API\StudentsController@destroy');

Route::middleware('auth:api')->get('/myinfo', 'API\StudentsController@myInfo');
Route::middleware('auth:api')->get('/myresults', 'API\MarksController@results');
Route::middleware('auth:api')->post('/send-results', 'API\MarksController@sendResults');
Route::middleware('auth:api')->get('/mytimetable', 'API\StudentsController@myTimetable');

//Student Study
Route::middleware('auth:api')->get('/reload-study/{id}', 'API\StudiesController@getStudentStudy');
Route::middleware('auth:api')->post('/add-study', 'API\StudiesController@store');
Route::middleware('auth:api')->delete('/delete-study/{id}', 'API\StudiesController@destroy');

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
Route::middleware('auth:api')->get('/active-term', 'API\TermsController@active');
Route::middleware('auth:api')->delete('/delete-term/{id}', 'API\TermsController@destroy');


//teachers
Route::middleware('auth:api')->get('/teachers', 'API\TeachersController@getTeachers');
Route::middleware('auth:api')->get('/loggedteachers', 'API\UserResourceController@teachers');
Route::middleware('auth:api')->post('/add-teacher-info', 'API\TeachersController@store');
Route::middleware('auth:api')->get('/teacherinfo', 'API\TeachersController@info');
Route::middleware('auth:api')->delete('/delete-teacher/{id}', 'API\TeachersController@destroy');
Route::middleware('auth:api')->get('/myclasses', 'API\TeachersController@myClasses');
Route::middleware('auth:api')->get('/scoresheet/{classid}/{timetableid}', 'API\TeachersController@scoreSheet');
Route::middleware('auth:api')->post('/addmarks', 'API\MarksController@store');
Route::middleware('auth:api')->delete('/deletemarks/{id}', 'API\MarksController@destroy');


//duties
Route::middleware('auth:api')->post('/add-duty', 'API\DutiesController@store');
Route::middleware('auth:api')->delete('/delete-duty/{id}', 'API\DutiesController@destroy');
Route::middleware('auth:api')->get('/reload-duty/{id}', 'API\DutiesController@getTeacherDuties');
Route::middleware('auth:api')->get('/duties', 'API\DutiesController@getDuties');
Route::middleware('auth:api')->get('/duty/{id}', 'API\DutiesController@duty');


//timetable
Route::middleware('auth:api')->post('/add-timetable', 'API\TimetablesController@store');
Route::middleware('auth:api')->post('/change-duty/{id}', 'API\TimetablesController@update');
Route::middleware('auth:api')->get('/timetables', 'API\TimetablesController@index');
Route::middleware('auth:api')->get('/timetables/{cid}/{sid}', 'API\TimetablesController@classSubjects');

//subjects
Route::middleware('auth:api')->get('/subjects', 'API\SubjectsController@allsubjects');
Route::middleware('auth:api')->post('/add-subject', 'API\SubjectsController@store');
Route::middleware('auth:api')->delete('/delete-sub/{id}', 'API\SubjectsController@destroy');

