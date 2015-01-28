<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array('as' => '/', 'uses' => 'ArticleController@index'));
Route::get('/export-excel/{article_id}', array('as' => 'export-excel', 'uses' => 'ArticleController@export'));
Route::get('/import', array('as' => 'import','uses' =>'ArticleController@form_import'));
Route::post('/import-excel', array('as' => 'import-excel','uses' =>'ArticleController@import'));
Route::resource('articles', 'ArticleController');
Route::resource('comments', 'CommentController');
