<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    use HasFactory;
    
    protected $table = 'clients';

    protected $fillable = [
        'key',
        'value',
        'contract_date',
        'module_type',
        'selected_module',
        'logo',
    ];
}
