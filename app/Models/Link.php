<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    /*--------- Const Variables ---------*/

    public const COLUMN_ID = 'id';
    public const COLUMN_USER_ID = 'user_id';

    /*------------ Variables ------------*/
    protected $table = 'links';

    protected $fillable = [
        'main_link',
        'shorten_link',
        'user_id',
    ];

    /*------------ Relations ------------*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COLUMN_USER_ID, self::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/


    /*---------- Other Functions --------*/

    public function getRouteKeyName(): string
    {
        return 'shorten_link';
    }
}
