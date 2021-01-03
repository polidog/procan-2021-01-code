<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function (): void {
    Route::get('/gacha', [\App\Http\Controllers\GachaController::class, 'index']);
    Route::get('/gacha/{id}', [\App\Http\Controllers\GachaController::class, 'exec']);
    Route::get('/itemBox', [\App\Http\Controllers\ItemBoxController::class, 'index'])->name('itemBox');
    Route::get('/itemBox/{id}/remove', [\App\Http\Controllers\ItemBoxController::class, 'remove'])->name('itemBoxRemove');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
