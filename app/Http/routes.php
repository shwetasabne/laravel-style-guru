<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'IndexController@index');

Route::auth();

Route::resource('item', 'ItemController');
Route::resource('comments', 'CommentsController');

Route::post('/image/upload', 'CropController@postUpload');
Route::post('/image/crop', 'CropController@postCrop');