<?php

use Illuminate\Support\Facades\Route;

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
Route::get(
    '/',
    function () {
        return redirect()->route('projects.index');
    }
);

Route::resource('/projects', 'ProjectController')
    ->names('projects');

Route::resource('/tasks', 'TaskController')
    ->names('tasks');

Route::resource('/employees', 'EmployeeController')
    ->names('employees');

Route::resource('/positions', 'PositionController')
    ->names('positions');

Route::get('/statistics', 'StatisticController@index')
    ->name('statistics');

Route::post('/statistics/csv', 'StatisticController@csv')
    ->name('csv');
