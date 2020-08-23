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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Social Login goes here
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', 'NotificationController@edit');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::get('add-role/{user}', 'UserController@roleForm')->name('add-role');
    Route::post('assign-role/{user}', 'UserController@assignRole')->name('assign-role');
    Route::resource('permissions', 'PermissionController');
    Route::get('add-permission/{role}', 'RoleController@permissionForm')->name('add-permission');
    Route::post('assign-permission/{role}', 'RoleController@assignPermission')->name('assign-permission');
});
