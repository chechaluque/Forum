<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
    'uses'=> 'PagesController@index',
    'as'=> 'home'
]);

Auth::routes();

Route::get('about/', [
    'uses'=> 'PagesController@about',
    'as'=> 'about'
]);

Route::get('contact/', [
    'uses'=> 'PagesController@contact',
    'as'=> 'contact'
]);
Route::get('question/', [
    'uses'=> 'ForumController@index',
    'as'=> 'question'
]);
Route::get('calendar/', [
    'uses'=> 'ForumController@calendar',
    'as'=> 'calendar'
]);

Route::post('store/', [
    'uses'=> 'ForumController@store',
    'as'=> 'store'
]);

Route::delete('post/', [
    'uses'=> 'ForumController@destroy',
    'as'=> 'delete_question'
]);

Route::get('{slug}', [
    'uses'=> 'ForumController@getpost',
    'as'=> 'view_post'
]);

Route::post('reply', [
    'uses'=> 'ForumController@storeReply',
    'as'=> 'store_reply'
]);
Route::delete('reply/', [
    'uses'=> 'ForumController@destroyreply',
    'as'=> 'delete_reply'
]);

Route::post('guardoEventos/', [

    'uses' => 'CalendarController@create',
    'as'=> 'storeEvent'
    ]);