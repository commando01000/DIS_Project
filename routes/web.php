<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactController;


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

use App\Http\Controllers\LanguageController;

Route::get('/lang/{locale}', [LanguageController::class, 'switchLocale'])->name('lang.switch');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.update.settings');
});
Route::middleware('auth')->get('admin/settings', [AdminController::class, 'showSettingsForm'])->name('admin.settings');
// Route::middleware('auth')->group(function () {
//     Route::get('admin/settings', [AdminController::class, 'showSettingsForm'])->name('admin.settings');
//     Route::post('admin/settings', [AdminController::class, 'updateSettings'])->name('admin.update.settings');

// });



Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('contact-us', [ContactController::class, 'index'])->name('contact-us');
    // Lang routes
    Route::get('lang/{locale}', [LanguageController::class, 'switchLocale'])->name('lang');
});
