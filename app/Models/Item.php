<?php

namespace App\Models;

use App\Traits\TimeTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, TimeTrait, UuidTrait, SoftDeletes;

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
