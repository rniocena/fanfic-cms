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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard.dashboard');
});

Route::controller('dashboard', 'DashboardController');
Route::controller('projects', 'ProjectsController');
Route::controller('users', 'UserController');
Route::controller('sales', 'SalesController');
Route::controller('reports', 'ReportsController');