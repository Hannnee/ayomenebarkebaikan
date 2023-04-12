<?php

namespace App\Traits;

use App\Models\User;

trait UserTrait
{
    /**
     * @return
     */
    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return
     */
    public function updated_user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

}
