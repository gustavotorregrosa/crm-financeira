<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


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
    // return view('welcome');
    return view('login.index');
});

Route::get('/esqueci', function () {
    // return view('welcome');
    return view('login.esqueci');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mensagens', 'HomeController@mensagens');

Route::get('/logout', 'Auth\LoginController@logout');

// Route::get('/analista', 'AnalistaController@index');

Route::get('/administrador', 'AdministradorController@index');
