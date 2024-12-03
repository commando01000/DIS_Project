<?php

if (!function_exists('translate')) {
    function translate($key)
    {
        $setting = \Illuminate\Support\Facades\DB::table('settings')->where('key', $key)->first();
        if ($setting && $setting->value) {
            $translations = json_decode($setting->value, true);
            return $translations[app()->getLocale()] ?? $key;
        }
        return $key; // Fallback to the key if no translation is found
    }
}
