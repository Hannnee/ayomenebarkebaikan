<?php

namespace App\Models;

use App\Traits\MessageTrait;
use App\Traits\TimeTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, MessageTrait, TimeTrait, UuidTrait;

    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'item_id', 'id');
    }

}
