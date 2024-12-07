<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('translate')) {

    function translate($key)
    {
        $setting = DB::table('settings')->where('key', $key)->first(); // Eloquent Syntax

        if ($setting && $setting->value) {
            $translations = json_decode($setting->value, true);
            return $translations[app()->getLocale()] ?? [];
        }
        return $key; // Fallback to the key if no translation is found
    }
}
