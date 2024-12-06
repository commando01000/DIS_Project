<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $fillable = [
        'name',
    ];

    public function banks()
    {
        return $this->belongsToMany(Bank::class, 'bank_module')
            ->withPivot('contract_date')
            ->withTimestamps();
    }
}
