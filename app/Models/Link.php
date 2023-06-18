<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    /*--------- Const Variables ---------*/


    /*------------ Variables ------------*/
    protected $table = 'links';

    protected $fillable = [
        'main_link',
        'shorten_link',
        'user_id',
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];


    /*------------ Relations ------------*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /*-------------- Scopes -------------*/


    /*---------- Other Functions --------*/

    public function getRouteKeyName()
    {
        return 'shorten_link';
    }
}
