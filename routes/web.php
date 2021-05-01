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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'IndexController@index');
});


Route::group(['prefix' => 'post','middleware' => 'auth'], function () {
    Route::get('/nuevo', 'UserPostController@nuevo');
    Route::post('/nuevo', 'UserPostController@postNuevo');
    Route::get('/ver/{post_id}', 'UserPostController@ver');
    Route::get('/editar/{post_id}', 'UserPostController@editar');
    Route::post('/editar/{post_id}', 'UserPostController@postEditar');
    Route::get('/eliminar/{post_id}', 'UserPostController@eliminarPost');
});

Route::group(['prefix' => 'wiki','middleware' => 'auth'], function () {
    Route::get('/index', 'WikiController@index');
    Route::get('/api/get', 'WikiController@apiGet');
});

Route::group(['prefix' => 'users','middleware' => 'auth'], function () {
    Route::get('/index', 'UsuariosController@index');
    Route::get('/nuevo', 'UsuariosController@nuevo');
    Route::post('/nuevo', 'UsuariosController@postNuevo');
    Route::get('/editar/{user_id}', 'UsuariosController@editar');
    Route::post('/editar/{user_id}', 'UsuariosController@postEditar');
    Route::get('/eliminar/{user_id}', 'UsuariosController@eliminar');
    Route::get('/api/get', 'UsuariosController@apiGet');
});


Auth::routes();
