<?php

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group prefixed with admin which
| contains the "web" middleware group and the permission middleware "can:access admin area".
|
*/

Route::get('devel/routes', ['uses' => 'DevelRoutesController@listRoutes'])
    ->middleware('permission:view routes')
    ->name('devel.admin.routes');
Route::get('devel/maintenance', ['uses' => 'DevelMaintenanceController@index'])
    ->middleware('permission:put site in maintenance mode')
    ->name('devel.admin.maintenance');
Route::post('devel/maintenance/on', ['uses' => 'DevelMaintenanceController@maintenanceModeOn'])
    ->middleware('permission:put site in maintenance mode')
    ->name('devel.admin.maintenance.on');
Route::post('devel/maintenance/off', ['uses' => 'DevelMaintenanceController@maintenanceModeOff'])
    ->middleware('permission:put site in maintenance mode')
    ->name('devel.admin.maintenance.off');