<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('/me', 'Api\UsersController@index');
    Route::get('/devices', 'Api\DevicesController@index');
    Route::get('/devices/{device}', 'Api\DevicesController@show');
    Route::get('/devices/{device}/samples', 'Api\DeviceSamplesController@index');
    Route::get('/samples', 'Api\SamplesController@index');
    Route::get('/samples/{sample}', 'Api\SamplesController@show');
    Route::get('/samples/{sample}/device', 'Api\SamplesDeviceController@index');
    Route::get('/battery-details', 'Api\BatteryDetailsController@index');
    Route::get('/battery-details/{batteryDetails}', 'Api\BatteryDetailsController@show');
    Route::get('/battery-details/{batteryDetails}/sample', 'Api\BatteryDetailsSampleController@index');
    Route::get('/network-details', 'Api\NetworkDetailsController@index');
    Route::get('/network-details/{networkDetails}', 'Api\NetworkDetailsController@show');
    Route::get('/network-details/{networkDetails}/sample', 'Api\NetworkDetailsSampleController@index');
    Route::get('/settings', 'Api\SettingsController@index');
    Route::get('/settings/{settings}', 'Api\SettingsController@show');
    Route::get('/settings/{settings}/sample', 'Api\SettingsSampleController@index');
    Route::put('/me/token', 'Api\UsersController@token');
    // Old ----------------------------------------------------------------
    Route::get('/count/{model}', 'Api\QueriesController@count');
    Route::get('/devices', 'Api\QueriesController@devices');
    Route::get('/models', 'Api\QueriesController@models');
    // Public
    Route::get('/public/count/{model}', 'Api\PublicController@count');
    Route::get('/public/status', 'Api\PublicController@status');
});
// Mobile dedicated endpoints
Route::group(['prefix' => 'mobile'], function () {
    Route::get('/messages', 'Mobile\ApiController@messages');
    // Duplicate endpoints for legacy support (Android app version <= 10)
    Route::post('/devices', 'Mobile\ApiController@register');
    Route::post('/samples', 'Mobile\ApiController@upload');
    // Better endpoints naming
    Route::post('/register', 'Mobile\ApiController@register');
    Route::post('/upload', 'Mobile\ApiController@upload');
});
