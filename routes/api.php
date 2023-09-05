<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyAuthController;
use App\Http\Controllers\KaziController;


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
// Routes for User Login and Registration
Route::post('/login', 'AuthController@login');       // User login
Route::post('/register', 'AuthController@register'); // User registration

Route::middleware('auth:api')->group(function(){
    Route::post('/logout', 'AuthController@logout');

    Route::post('/tasks', 'KaziController@store');
    Route::get('/tasks', 'KaziController@index');
    Route::put('/tasks/{id}', 'KaziController@update');
    Route::delete('/tasks/{id}', 'KaziController@delete');
});
