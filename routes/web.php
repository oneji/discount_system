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
    Route::get('/packages', 'DiscountPackageController@index')->name('packages');
    Route::get('/packages/create', 'DiscountPackageController@create')->name('packages.create');
    Route::get('/packages/{package}/edit', 'DiscountPackageController@edit')->name('packages.edit');

    Route::post('/packages', 'DiscountPackageController@store')->name('packages.store');
    Route::put('/packages/{package}', 'DiscountPackageController@update')->name('packages.update');
    // Employees
    Route::get('/employees', 'EmployeeController@index')->name('employees');
    Route::get('/employees/create', 'EmployeeController@create')->name('employees.create');

    Route::post('/employees', 'EmployeeController@store')->name('employees.store');
});

