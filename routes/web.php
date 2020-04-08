<?php

use App\Exam;

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

Route::get('/','StudentController@student_home')->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth']],function(){
    
    // routes for levels
    Route::get('levels','LevelController@index')->name('levels.index');
    Route::get('levels/create','LevelController@create')->name('levels.create');
    Route::get('levels/edit/{level}','LevelController@edit')->name('levels.edit');
    Route::put('levels/update/{level}','LevelController@update')->name('levels.update');
    Route::post('levels','LevelController@store')->name('levels.store');

    //route for subjects
    Route::get('subjects','SubjectController@index')->name('subjects.index');
    Route::get('subjects/create','SubjectController@create')->name('subjects.create');
    Route::get('subjects/edit/{subject}','SubjectController@edit')->name('subjects.edit');
    Route::put('subjects/update/{subject}','SubjectController@update')->name('subjects.update');
    Route::post('subjects','SubjectController@store')->name('subjects.store');

    //route for sets 
    Route::get('sets','SetController@index')->name('sets.index');
    Route::get('sets/create','SetController@create')->name('sets.create');
    Route::get('sets/edit/{set}','SetController@edit')->name('sets.edit');
    Route::put('sets/update/{set}','SetController@update')->name('sets.update');
    Route::post('sets','SetController@store')->name('sets.store');

    //route for questions 
    Route::get('questions','QuestionController@index')->name('questions.index');
    Route::get('questions/create','QuestionController@create')->name('questions.create');
    Route::get('questions/show/{question}','QuestionController@show')->name('questions.show');
    Route::put('questions/update/{question}','QuestionController@update')->name('questions.update');
    Route::post('questions','QuestionController@store')->name('questions.store');
    Route::get('questions/delete/{question}','QuestionController@delete')->name('questions.delete');


    Route::put('answers/update/{id}','AnswerController@update')->name('answers.update');

    //route for questions 
    Route::get('exams','ExamController@index')->name('exams.index');
    Route::get('exams/create','ExamController@create')->name('exams.create');
    Route::get('exams/create/set/{exam}','ExamController@create_exam_set')->name('exams.create.set');
    Route::get('exams/edit/{exam}','ExamController@edit')->name('exams.edit');
    Route::get('exams/edit_exam_set/{id}/{exam_id}','ExamController@edit_exam_set')->name('exams.edit_exam_set');
    Route::get('exams/show/{exam}','ExamController@show')->name('exams.show');
    Route::put('exams/update/{exam}','ExamController@update')->name('exams.update');
    Route::put('exams/update_exam_set','ExamController@update_exam_set')->name('exams.update_exam_set');
    Route::post('exams','ExamController@store')->name('exams.store');
    Route::post('exams/add_exam_set/{id}','ExamController@add_exam_set')->name('add_exam_set.store');
    Route::get('exams/delete/{exam}','ExamController@delete')->name('exams.delete');


    // route for students in backend
    Route::get('students','StudentController@index')->name('students.index');
    Route::get('students/{student}','StudentController@show')->name('students.show');
    Route::get('student_exam_details/{result}','StudentController@student_exam_details')->name('students.student_exam_details');

    // route for exam start
    
});
// Route::group(['middleware'=>['student']],function(){
Route::post('student_register','StudentController@student_register')->name('student_register');
Route::get('student_logout','StudentController@student_logout')->name('student_logout');

Route::get('check_user_session','StudentController@check_user_session')->name('check_user_session');

Route::get('get_all_exams','StudentController@get_all_exams')->name('get_all_exams');
Route::get('exam_details/{exam_id}','StudentController@exam_details')->name('exam_details');

Route::get('start_exam/{exam_id}/{set_id}','StudentController@start_exam')->name('start_exam');
Route::post('result','StudentController@result')->name('result');
Route::get('after_exam/{result_id}','StudentController@after_exam')->name('after_exam');
// });
// Route::post('start_exam','ExamController@start_exam')->name('start_exam');
// Route::post('submit_exam/{exam}','ExamController@submit_exam')->name('submit_exam');
// Route::get('result_publish/{exam}','ExamController@result_publish')->name('result_publish');


// Route::get('/{path}',function(){
//     return redirect()->route('/');
// })->where('path','.*');