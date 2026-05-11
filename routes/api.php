<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ==========================================
// Chat API Routes
// ==========================================
Route::middleware('auth:sanctum')->prefix('chat')->group(function () {
    Route::get('/conversations', 'App\Http\Controllers\Api\ChatApiController@conversations');
    Route::get('/conversation/{id}', 'App\Http\Controllers\Api\ChatApiController@conversation');
    Route::post('/message', 'App\Http\Controllers\Api\ChatApiController@sendMessage');
    Route::post('/read', 'App\Http\Controllers\Api\ChatApiController@markAsRead');
    Route::delete('/message/{id}', 'App\Http\Controllers\Api\ChatApiController@deleteMessage');
    Route::post('/typing', 'App\Http\Controllers\Api\ChatApiController@typingStatus');
    Route::get('/unread-count', 'App\Http\Controllers\Api\ChatApiController@unreadCount');
    Route::post('/start', 'App\Http\Controllers\Api\ChatApiController@startConversation');
    Route::post('/block', 'App\Http\Controllers\Api\ChatApiController@blockUser');
    Route::get('/search', 'App\Http\Controllers\Api\ChatApiController@search');
});