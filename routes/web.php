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

Route::get('/', 'TaskController@index');
Route::get('/task', 'TaskController@index');

Route::get('/task/{id}', 'TaskController@index');

Route::get('/task/view/{id}', 'TaskController@view');

Route::get('/task/add', 'TaskController@add');
Route::post('/task/add', 'TaskController@addTask');

Route::get('/task/edit/{id}', 'TaskController@edit');
Route::post('/task/edit', 'TaskController@editTask');

Route::get('/task/delete/{id}', 'TaskController@delete');
Route::post('/task/delete', 'TaskController@deleteTask');


if(config('app.env') == 'local') {
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}
