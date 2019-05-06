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
// Public Route
Route::post('/login', 'AuthenticationController@login')->name('login');
// Route::get('/check-session', function(Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function () {
    Route::get('/validate-token', function(Request $request) {
        return [
            'success' => true,
            'message' => 'Token is valid',
            'user'    => $request->user()
        ];
    });

    Route::get('/logout', 'AuthenticationController@logout')->name('logout');

    // Route::get('/user', function(Request $request) {
    //     return $request->user();
    // });

    Route::prefix('/user')->group(function () {

        Route::get('/', function(Request $request) {
            return $request->user();
        });

        Route::get('/boards', 'UserController@boards');
    });

    Route::prefix('/boards')->group(function () {
        Route::post('/create', 'BoardController@store');
        Route::get('/view/{hash}', 'BoardController@show');
    });

    Route::post('/user/save', 'UserController@save');
});
