<?php

use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
/*
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

Route::get('/users/{user}', function (User $user) {
    return new UserResource($user);
    // return new UserCollection(User::find(1));
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/handle-result', 'MpesaController@handle_result')->name('handle_result_api');
Route::any('/receive-reversal', 'MpesaController@receive_reversal')->name('receive_reversal');
Route::post('/queue-timeout', 'MpesaController@queue_timeout')->name('queue_timeout_api');