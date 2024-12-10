<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'name',
        'role',
        'social_media',
        'website_link',
        'phone',
        'email',
        'address',
        'description',
        'image',
    ];

    protected $casts = [
        'name' => 'array',  // or 'json' if you're using a JSON column type in the database
        'description' => 'array',
        'address' => 'array',
        'role' => 'array',
        'social_media' => 'array',
    ];
}
