<?php

namespace App\Models;

use App\Traits\TimeTrait;
use App\Traits\UserTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, TimeTrait, UuidTrait, UserTrait, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'address',
        'code',
        'date',
        'discount',
        'subtotal',
        'total',
        'created_by'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
