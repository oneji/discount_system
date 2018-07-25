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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');


Route::group(['middleware' => ['role:superadministrator|administrator']], function() {
    // Projects
    Route::get('/projects', 'ProjectController@index')->name('projects');
    Route::post('/projects', 'ProjectController@store')->name('projects.store');
    // Packages
    Route::resource('/packages', 'DiscountPackageController', [
        'except' => [ 'show', 'destroy' ]
    ]);
    // Employees
    Route::get('/employees', 'EmployeeController@index')->name('employees.index');
    Route::get('/employees/create', 'EmployeeController@create')->name('employees.create');

    Route::post('/employees', 'EmployeeController@store')->name('employees.store');
});

Route::get('/sales', 'SaleController@index')->name('sales.index');
Route::get('/sales/create', 'SaleController@create')->name('sales.create');
Route::post('/sales/check-card', 'SaleController@checkCard')->name('sales.check');
Route::post('/sales', 'SaleController@store')->name('sales.store');

