<?php

namespace App\Models;

use App\Traits\MessageTrait;
use App\Traits\TimeTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, TimeTrait, UuidTrait;

    protected $fillable = [
        'order_id',
        'item_id',
        'qty',
        'discount',
        'price',
        'total',
        'note'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
