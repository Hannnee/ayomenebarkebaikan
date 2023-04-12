<?php

namespace App\Repositories\OrderItem;

use App\Models\Item;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderItemRepository implements OrderItemRepositoryInterface
{

    protected $model;

    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }

    /**
     * @param
     * @return
     */
    public function topOrderItems()
    {
        return Item::withCount(['orderItems as total_order' => function($query) {
            $query->select(DB::raw("COALESCE(SUM(qty), 0)"));
        }])->orderBy('total_order', 'desc')->get();
    }

}
