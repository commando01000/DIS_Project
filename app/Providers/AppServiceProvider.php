<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    // In the middleware or AppServiceProvider
    public function handle($request, Closure $next)
    {
        $locale = session('locale', 'en'); // Default to 'en' if no session is set
        app()->setLocale($locale);

        return $next($request);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Set the language direction based on the current locale
        view()->composer('*', function ($view) {
            // Get current language (you might have a fallback to 'en')
            $locale = app()->getLocale();

            // Check if the language is Arabic, and add RTL direction accordingly
            if ($locale == 'ar') {
                $view->with('direction', 'rtl');
            } else {
                $view->with('direction', 'ltr');
            }
        });
    }
}
