<?php

namespace App\Models;

use App\Traits\MessageTrait;
use App\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory, MessageTrait, TimeTrait;
}
