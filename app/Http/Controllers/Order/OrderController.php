<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $customerRepository;
    protected $itemRepository;

    public function __construct( OrderRepositoryInterface $o, CustomerRepositoryInterface $c, ItemRepositoryInterface $i)
    {
        $this->orderRepository = $o;
        $this->customerRepository = $c;
        $this->itemRepository = $i;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderRepository->getList();
        return view('feature.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = $this->customerRepository->getList();
        $items     = $this->itemRepository->getList();
        return view('feature.order.create', compact('customers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderRepository->create($request->all());
        if ($order == true) {
            return response()->json(['message' => 'Data has been saved.'])->setStatusCode(200);
        } else {
            return response()->json(['error' => 'Failed to save data.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('feature.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('feature.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, order $order)
    {
        $order = $this->orderRepository->update($order, $request->all());
        return to_route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
