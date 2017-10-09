<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'v1'], function() {
    // Guest
    Route::get('/public/count/{model}', 'Api\PublicController@count');
    Route::get('/status', function() {
        return ['status' => 'Online'];
    });
});

// Mobile dedicated endpoints
Route::group(['prefix' => 'mobile'], function() {
    Route::get('/messages', 'Mobile\ApiController@messages');

    // Duplicate endpoints for legacy support (Android app version <= 10)
    Route::post('/devices', 'Mobile\ApiController@register');
    Route::post('/samples', 'Mobile\ApiController@upload');
    // Better endpoints naming
    Route::post('/register', 'Mobile\ApiController@register');
    Route::post('/upload', 'Mobile\ApiController@upload');
});