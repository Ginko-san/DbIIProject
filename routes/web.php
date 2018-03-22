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

Route::get('/', function () {
    return view('auth.login');
});*/

Route::resource('/login', 'LoginController');
Route::resource('/dashboard', 'DashboardController');
Route::resource('/test', 'TestController');


Route::get('/testconn', function () {
    //$users = DB::connection('pgsql')->select('SELECT datname FROM pg_database');
    $users = DB::connection('sqlsrv')->select('SELECT size, maxsize, growth, name  FROM sysfiles;');
    var_dump($users);
});

Route::get('/testconn', 'DashboardController@screenMonitorDataReturn');

Route::get('/testconn2', function () {
    $users = DB::connection('pgsql')->select('SELECT datname FROM pg_database');
    var_dump($users);
});