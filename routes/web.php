<?php

use App\Livewire;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/pricing', function () {
    return view('pricing');
});

Route::prefix('/app')->group(function () {
    Route::middleware('guest:web')->group(function () {
        Route::get('/login', Livewire\Login::class)->name('login');
        Route::get('/demo', Livewire\DemoImpersonate::class)->name('demo');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/', Livewire\Home::class)->name('home');
        Route::get('/logout', Livewire\Logout::class)->name('logout');

        Route::prefix('/texts')->group(function () {
            Route::get('/', Livewire\Texts\Dashboard::class)->name('texts.index');
            Route::get('/{text}/read', Livewire\Texts\TextReading::class)->name('texts.read');
        });
        Route::prefix('/cards')->group(function () {
            Route::get('/', Livewire\Cards\Dashboard::class)->name('cards.index');
        });
    });
});
