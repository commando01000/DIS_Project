<?php

use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ProjectsController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LanguageController;
use App\Models\Testimonial;

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

// include admin from routes/admin.php Edit by Youssef Mahmoud @ at Date 12/7/2024
include('admin.php');

// Start Front End //   
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');
    // Lang routes
    Route::get('lang/{locale}', [LanguageController::class, 'switchLocale'])->name('lang');
    Route::get('/projects/{id}', [ProjectsController::class, 'getProjectData'])->name('projects.data');
    Route::get('/profile/{id}', function ($id) {
        // Validate the ID
        if (!is_numeric($id) || $id <= 0) {
            abort(404, 'Invalid ID'); // Abort with 404 if invalid
        }

        // Fetch testimonial by ID
        $testimonial = Testimonial::find($id);

        // Check if testimonial exists
        if (!$testimonial) {
            abort(404, 'Testimonial not found');
        }

        return view('Frontend.profile.index', compact('testimonial'));
    })->name('profile');
});

Route::post('/contact-us', [HomeController::class, 'Contact_store'])->name('contacts.store');   


// End Frontend //
