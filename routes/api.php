<?php

use App\Http\Controllers\Api\CustomerApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Allow to extend to search by different columns and not get route conflict
Route::get('/customers/search/email', [CustomerApiController::class, 'searchEmail'])->name('countries.search-email');
Route::get('/customers/search/username/{username}', [CustomerApiController::class, 'searchUsername'])->name('customers.search-username');
Route::apiResource('customers', CustomerApiController::class);
