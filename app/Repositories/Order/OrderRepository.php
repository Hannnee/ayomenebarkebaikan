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

    /**
     * @param
     * @return
     */
    public function getList()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    /**
     * @param
     * @return
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param
     * @return
     */
    public function create($attr)
    {
        DB::beginTransaction();
        try {

            $order = $this->model::create([
                'customer_id' => $attr['customer']['id'],
                'address'     => $attr['customer']['address'],
                'code'        => $attr['order']['code'],
                'date'        => $attr['order']['date'],
                'discount'    => $attr['order']['discount'],
                'subtotal'    => $attr['order']['subtotal'],
                'total'       => $attr['order']['total'],
                'created_by'  => Auth::user()->id
            ]);

            foreach($attr['order']['items'] as $item) {
                $total  = to_number($item['price']) * $item['qty'];
                $mins   = $total * $item['disc'] / 100;
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id'  => str_replace('uid', '', $item['id']),
                    'qty'      => $item['qty'],
                    'discount' => $item['disc'],
                    'price'    => to_number($item['price']),
                    'total'    => $item['number'] - $mins,
                ]);
            }

            DB::commit();
            return [
                'status'  => 200,
                'message' => 'success'
            ];
        } catch (\Exception $e) {

            DB::rollBack();
            return [
                'status'  => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param
     * @return
     */
    public function update($order, $attr)
    {

    }

    /**
     * @param
     * @return
     */
    public function totalAmount()
    {
        return $this->model::withTrashed()->sum('total');
    }
}
