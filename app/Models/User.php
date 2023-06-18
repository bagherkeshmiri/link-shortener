<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /*--------- Const Variables ---------*/

    public const COLUMN_ID = 'id';

    /*------------ Variables ------------*/
    protected $table = 'users';

    protected $fillable = [
        'name',
        'family',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*------------ Relations ------------*/

    public function links(): HasMany
    {
        return $this->hasMany(Link::class, Link::COLUMN_USER_ID, self::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/


    /*---------- Other Functions --------*/

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
