<?php

namespace App\Repositories\OrderItem;

use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderItemRepository implements OrderItemRepositoryInterface
{

    protected $model;

    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }
}
