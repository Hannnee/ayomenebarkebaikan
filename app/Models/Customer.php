<?php

namespace App\Models;

use App\Traits\TimeTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, TimeTrait, UuidTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}
