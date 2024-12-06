<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue($key)
    {
        $setting = DB::table('settings')->where('key', $key)->first(); // Eloquent Syntax

        if ($setting && $setting->value) {
            $setting = json_decode($setting->value, true);
            return $setting ?? $key;
        }
        return $key; // Fallback to the key if no translation is found
    }
}
