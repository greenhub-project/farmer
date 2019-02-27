<?php

use App\Notifications\DailyStatsSummary;

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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/account', 'AccountController@index')->name('account');
Route::match(['put', 'patch'], '/account', 'AccountController@update')->name('account.update');
Route::get('/stats', 'StatsController@index');
Route::match(['put', 'patch'], '/token', 'TokenController@update');

Route::resource('users', 'UserController');

Route::get('/slack', function () {
  $user = App\Farmer\Models\User::find(1);
  $user->notify(new DailyStatsSummary);
  return response('OK');
});

// Route::resource('devices', 'DevicesController')->only(['index', 'show', 'update', 'destroy']);
// Route::resource('samples', 'SamplesController')->only(['index', 'show', 'update', 'destroy']);
// Route::resource('messages', 'MobileMessagesController');
// Route::resource('members', 'Dashboard\MembersController')->only(['index', 'update']);

// Route::get('devices/fetch', 'DevicesController@fetch');
// Route::get('/settings', 'Settings\PagesController@redirect')->name('settings');
// Route::get('/settings/account', 'Settings\PagesController@account')->name('settings.account');
// Route::get('/settings/password', 'Settings\PagesController@password')->name('settings.password');
// Route::get('/settings/api', 'Settings\PagesController@api')->name('settings.api');

// Route::post('/settings/account', 'Settings\UpdateController@account');
// Route::post('/settings/password', 'Settings\UpdateController@password');
// Route::post('/settings/api', 'Settings\UpdateController@api');

// Route::get('/stats/count/{model}', 'StatsCounterController@count');
// Route::get('/stats/total/{model}', 'StatsCounterController@total');
// Route::get('/stats/weekly/{model}', 'StatsCounterController@weekly');
// Route::get('/stats/devices/active', 'StatsCounterController@active');
// Route::get('/stats/devices/group', 'StatsCounterController@countGroup');
