<?php

namespace App\Models;

use App\Traits\MessageTrait;
use App\Traits\TimeTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, MessageTrait, TimeTrait, UuidTrait;

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
