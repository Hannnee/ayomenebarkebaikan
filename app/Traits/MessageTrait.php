<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait MessageTrait
{
    /**
     * @return
     */
    public static function booted()
    {
        parent::boot();

        static::created(function ($model) {
            alert('success', 'Successfully create data');
        });

        static::updated(function () {
            alert('success', 'Successfully update data');
        });

        static::deleted(function () {
            alert('success', 'Successfully delete data');
        });

    }
}
