<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BanksController;
use App\Http\Controllers\Backend\ChangeStatusController;
use App\Http\Controllers\Backend\ModulesController;
use App\Http\Controllers\Backend\ProjectsController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\TestimonialController;
use Illuminate\Support\Facades\Route;



// Start Backend Routes //
Route::prefix('admin')->group(function () {
    // Protected routes (only accessible to logged-in admins)
    // Show login form
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    // Handle login
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Route to show the change password and email form
        Route::get('/change-password', [AdminController::class, 'showPasswordForm'])->name('admin.password');
        Route::post('/password', [AdminController::class, 'updatePassword'])->name('admin.update.password');

        // Logout route
        Route::post('/dashboard/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        // update profile route
        Route::post('/dashboard/update-profile', [AdminAuthController::class, 'update_profile'])->name('admin.update-profile');
        // settings route
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
        
        // About
        Route::resource('/about-us', AboutController::class)->names([
            'index' => 'admin.about-us',
            'create' => 'admin.about-us.create',
            'store' => 'admin.about-us.store',
            'edit' => 'admin.about-us.edit',
            'update' => 'admin.about-us.update',
            'destroy' => 'admin.about-us.destroy',
        ]);

        // Banks    
        Route::resource('/clients', BanksController::class)->names([
            'index' => 'admin.client',
            'create' => 'admin.client.create',
            'store' => 'admin.client.store',
            'edit' => 'admin.client.edit',
            'update' => 'admin.client.update',
            'destroy' => 'admin.client.destroy',
        ]);

        Route::post('update_client_translation', [BanksController::class, 'update_translation'])->name('update.settings.clients');

        Route::resource('/modules', ModulesController::class)->names([
            'index' => 'admin.modules',
            'create' => 'admin.modules.create',
            'store' => 'admin.modules.store',
            'edit' => 'admin.modules.edit',
            'update' => 'admin.modules.update',
            'destroy' => 'admin.modules.destroy',
        ]);
        Route::resource('/projects', ProjectsController::class)->names([
            'index' => 'admin.projects',
            'create' => 'admin.projects.create',
            'store' => 'admin.projects.store',
            'edit' => 'admin.projects.edit',
            'update' => 'admin.projects.update',
            'destroy' => 'admin.projects.destroy',
        ]);

        Route::resource('/testimonials', TestimonialController::class)->names([
            'index' => 'admin.testimonials',
            'create' => 'admin.testimonials.create',
            'store' => 'admin.testimonials.store',
            'edit' => 'admin.testimonials.edit',
            'update' => 'admin.testimonials.update',
            'destroy' => 'admin.testimonials.destroy',
        ]);

        Route::post('update_our-team_translation', [TestimonialController::class, 'update_translation'])->name('update.settings.testimonials');


        Route::post('/update-status/{form}/{status}', [ChangeStatusController::class, 'UpdateStatus'])->name('update.form.status');
    });
});
// End Backend Routes//