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

Route::apiResources([
    'messages' => 'API\MessageController',
    'archived' => 'API\AchievedMessageController',
]);
Route::post('messages/{message}/read', 'API\ReadMessageController')->name('message.read');
Route::post('messages/{message}/archive', 'API\ArchiveMessageController')->name('message.archive');
