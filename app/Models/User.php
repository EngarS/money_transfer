<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'block_money'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function balance()
    {
        return $this->balance;
    }

    public function blocked()
    {
        return $this->block_money;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function availableMoney()
    {
        $availableMoney = $this->balance - $this->block_money;
        return $availableMoney;
    }
}
