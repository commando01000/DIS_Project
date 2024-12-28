<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'subject',
        'body',
        'status',
        'date',
        'attachment',
        'user_id',
    ];
    
    protected $casts = [
        'date' => 'datetime',
    ];

    // Relationship with recipients (Emails sent to recipients)
    public function recipients()
    {
        return $this->belongsToMany(User::class, 'email_recipients', 'email_id', 'user_id');
    }

    // Relationship with sender
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
