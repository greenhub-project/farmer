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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/register/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/dashboard', 'Dashboard\PagesController@dashboard')->name('dashboard');

Route::resource('devices', 'DevicesController')->only(['index', 'show', 'update', 'destroy']);
Route::get('devices/fetch', 'DevicesController@fetch');

Route::resource('samples', 'SamplesController')->only(['index', 'show', 'update', 'destroy']);

Route::resource('messages', 'MobileMessagesController');

Route::get('/settings', 'Settings\PagesController@redirect')->name('settings');
Route::get('/settings/account', 'Settings\PagesController@account')->name('settings.account');
Route::get('/settings/password', 'Settings\PagesController@password')->name('settings.password');
Route::get('/settings/api', 'Settings\PagesController@api')->name('settings.api');

Route::post('/settings/account', 'Settings\UpdateController@account');
Route::post('/settings/password', 'Settings\UpdateController@password');
Route::post('/settings/api', 'Settings\UpdateController@api');

Route::get('/stats/count/{model}', 'StatsCounterController@count');
Route::get('/stats/total/{model}', 'StatsCounterController@total');
Route::get('/stats/weekly/{model}', 'StatsCounterController@weekly');

