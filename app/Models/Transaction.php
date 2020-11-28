<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'money',
        'date_start',
        'date_end',
        'done',
        'message',
        'recipient_user_id',
        'user_id'
    ];

    protected $dates = [
        'date_start',
        'date_end'
    ];

    public function getRecipientAttribute()
    {
        return $this->recipient();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipient()
    {
        return $this->hasOne(User::class,'id', 'recipient_user_id');
    }

}
