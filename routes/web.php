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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
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
    Route::get('exams/edit/{exam}','ExamController@edit')->name('exams.edit');
    Route::get('exams/show/{exam}','ExamController@show')->name('exams.show');
    Route::put('exams/update/{exam}','ExamController@update')->name('exams.update');
    Route::post('exams','ExamController@store')->name('exams.store');
    Route::get('exams/delete/{exam}','ExamController@delete')->name('exams.delete');


    // route for results
    Route::get('results','ResultController@index')->name('results.index');
    Route::get('results/show/{exam}','ResultController@show')->name('results.show');
    // Route::get('results/edit/{exam_id}','ResultController@edit')->name('results.edit');
    Route::put('results/update/{exam}','ResultController@update')->name('results.update');
    
});

Route::post('start_exam','ExamController@start_exam')->name('start_exam');
Route::post('submit_exam/{exam}','ExamController@submit_exam')->name('submit_exam');
Route::get('result_publish/{exam}','ExamController@result_publish')->name('result_publish');

