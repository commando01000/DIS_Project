<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'banks';

    protected $fillable = [
        'name',
        'image',
        'contract_date'
    ];
    // Cast the 'name' attribute to an array or JSON
    protected $casts = [
        'name' => 'array',  // or 'json' if you're using a JSON column type in the database
    ];
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'bank_module')
            ->withTimestamps();
    }
}
