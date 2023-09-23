<?php

use App\Http\Controllers\IssueTokenController;
use App\Http\Controllers\MeController;
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

Route::middleware('auth:sanctum')->get('/me', MeController::class);

Route::middleware(['throttle:login'])->group(function () {
    Route::post('/tokens', IssueTokenController::class)->name('login');
});
