<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';

    protected $fillable = [
        'name',
        'mail',
        'subject',
        'message',
    ];
    // Cast the 'name' attribute to an array or JSON
    protected $casts = [
        'name' => 'array',  // or 'json' if you're using a JSON column type in the database
    ];
}
