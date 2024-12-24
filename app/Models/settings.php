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

    public static function getSettingValue($key)
    {
        $setting = DB::table('settings')->where('key', $key)->first(); // Eloquent Syntax

        if ($setting && $setting->value) {
            $setting = json_decode($setting->value, true);
            return $setting ?? [];
        }

        if (!$setting) {
            // create it 
            settings::create([
                'key' => $key,
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        // Return an empty array if no setting is found or the value is not valid
        return [
            'status' => 'on',
        ];
    }
}
