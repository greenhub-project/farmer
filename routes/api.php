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
    Route::get('/user', 'Api\UsersController@login');
    Route::get('/count/{model}', 'Api\QueriesController@count');
    Route::get('/devices', 'Api\QueriesController@devices');
    Route::get('/samples', 'Api\QueriesController@samples');
    Route::get('/models', 'Api\QueriesController@models');

    // Guest
    Route::get('/public/count/{model}', 'Api\PublicController@count');
    Route::get('/status', function() {
        return ['status' => 'Online'];
    });

    // CLI only
    Route::post('/token/new', 'Api\UsersController@token');
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