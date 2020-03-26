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
    Route::get('questions/edit/{question}','QuestionController@edit')->name('questions.edit');
    Route::put('questions/update/{question}','QuestionController@update')->name('questions.update');
    Route::post('questions','QuestionController@store')->name('questions.store');
});
