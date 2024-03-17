<?php

use App\Http\Controllers\GetTextController;
use App\Http\Controllers\IssueTokenController;
use App\Http\Controllers\ListTextsController;
use App\Http\Controllers\MeController;
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

Route::get('/up', function () {
    return response()->json(['quote' => 'memento mori 💀']);
});

Route::post('/tokens', IssueTokenController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', MeController::class);

    Route::prefix('texts')->group(function () {
        Route::get('/', ListTextsController::class);
        Route::get('/{text}', GetTextController::class);
    });
});
