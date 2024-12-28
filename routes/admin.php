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
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\EmailsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\settings;
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

        Route::post('update_client_translation', [SettingsController::class, 'clients'])->name('update.settings.clients');

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
        Route::post('update_projects_translation', [SettingsController::class, 'projectSettingsStore'])->name('update.settings.projects');

        Route::resource('/testimonials', TestimonialController::class)->names([
            'index' => 'admin.testimonials',
            'create' => 'admin.testimonials.create',
            'store' => 'admin.testimonials.store',
            'edit' => 'admin.testimonials.edit',
            'update' => 'admin.testimonials.update',
            'destroy' => 'admin.testimonials.destroy',
        ]);
        Route::post('update_our-team_translation', [SettingsController::class, 'update_project_translation'])->name('update.settings.testimonials');


        Route::resource('/contact', ContactController::class)->names([
            'index' => 'admin.contacts',
            'create' => 'admin.contacts.create',
            'store' => 'admin.contacts.store',
            'edit' => 'admin.contacts.edit',
            'update' => 'admin.contacts.update',
            'destroy' => 'admin.contacts.destroy',
        ]);
        Route::post('update_contacts_translation', [SettingsController::class, 'contacts_store'])->name('update.settings.contacts');



        // Route::post('/update-status/{form}/{status}', [ChangeStatusController::class, 'UpdateStatus'])->name('update.form.status');
        Route::post('/update-status/{form}/{status}', [ChangeStatusController::class, 'UpdateStatus'])->name('update.form.status');

        Route::post('/footer-edit', [SettingsController::class, 'footer_store'])->name('update.settings.footer');

        // settings route
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');


        // Route::post('/footer-edit', [HomeController::class, 'footer_store'])->name('admin.footer.store');  
        Route::post('update_polices_translation', [SettingsController::class, 'police_store'])->name('update.settings.polices');
        Route::post('update_emials_translation', [SettingsController::class, 'email_store'])->name('update.settings.emails');

        Route::post('update_side-button', [SettingsController::class, 'side_button_store'])->name('update.settings.side-button');

        // Swiper Routes
        Route::prefix('swiper')->group(function () {

            // Display Swiper Management Page
            Route::get('/', function () {
                return view('Backend.Swiper.index');
            })->name('admin.swiper');

            // Update Top Slider
            Route::post('/create', [SettingsController::class, 'swiper'])->name('settings.swiper.create');
            Route::post('/update', [SettingsController::class, 'updateSwiperData'])->name('settings.swiper.update');
            Route::post('/delete', [SettingsController::class, 'updateSwiperData'])->name('settings.swiper.destroy');
        });

        Route::get('/emails', [EmailsController::class, 'index'])->name('admin.manage-emails');
        Route::get('/emails/create', [EmailsController::class, 'create'])->name('admin.emails.create');
        Route::post('/emails', [EmailsController::class, 'store'])->name('admin.emails.store');
        Route::get('/emails/{email}', [EmailsController::class, 'show'])->name('admin.emails.show');
        Route::delete('/emails/{id}', [EmailsController::class, 'destroy'])->name('admin.emails.destroy');
        Route::post('ckeditor/upload', [AdminController::class, 'upload'])->name('ckeditor.upload');
    });
});
// End Backend Routes//