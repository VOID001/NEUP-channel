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

Route::get('/', [
    "uses" => "ContentController@getIndex"
]);

Route::get('/cat/{cat_id}/subject/{sub_id}', [
    "uses" => "ContentController@getContentByCatIDAndSubID",
]);

Route::post('/cat/{cat_id}/subject/{sub_id}', [
    "uses" => "ContentController@postContent",
    "middleware" => "chancookie"
]);

Route::get('/cat/{cat_id}', [
    "uses" => "ContentController@getContentByCatID"
]);

Route::post('/cat/{cat_id}', [
    "uses" => "ContentController@postSubject",
    "middleware" => "chancookie"
]);

Route::get('/search', [
    "uses" => "ContentController@searchContent"
]);

Route::get('/admin', [
    "uses" => "AdminController@getAdminIndex"
]);

Route::get('/images/{image_hash}', [
    "uses" => "ContentController@getImage"
]);
