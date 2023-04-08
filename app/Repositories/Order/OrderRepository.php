<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{

    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getList()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($attr)
    {
        DB::beginTransaction();
        try {
            $order = $this->model::create([
                'customer_id' => $attr['customer']['id'],
                'address' => $attr['customer']['address'],
                'code' => $attr['order']['code'],
                'date' => $attr['order']['date'],
                'discount' => $attr['order']['discount'],
                'subtotal' => $attr['order']['subtotal'],
                'total' => $attr['order']['total'],
                'created_by' => Auth::user()->id
            ]);
            foreach($attr['order']['items'] as $item) {
                $total = to_number($item['price']) * $item['qty']; // 150.000
                $mins = $total * $item['disc'] / 100;
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => str_replace('uid', '', $item['id']),
                    'qty' => $item['qty'],
                    'discount' => $item['disc'],
                    'price' => to_number($item['price']),
                    'total' => $item['number'] - $mins,
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function update($order, $attr)
    {

    }
}
