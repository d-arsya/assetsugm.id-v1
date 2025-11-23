<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Voter extends Model
{
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($user) {
            do {
                $code = strtolower(Str::random(6));
            } while (self::where('code', $code)->exists());

            $user->code = $code;
        });
    }
}
