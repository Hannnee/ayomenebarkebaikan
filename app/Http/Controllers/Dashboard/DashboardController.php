<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $orderRepository;
    protected $orderItemRepository;

    public function __construct(OrderRepositoryInterface $o, OrderItemRepositoryInterface $i)
    {
        $this->orderRepository      = $o;
        $this->orderItemRepository  = $i;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newOrders    = $this->orderRepository->getList()->take(5);
        $topItems     = $this->orderItemRepository->topOrderItems()->take(5);
        $totalAmount  = $this->orderRepository->totalAmount();

        $orders       = Order::withTrashed()->count();
        $customers    = Customer::count();
        $items        = Item::count();
        return view('feature.dashboard.index', compact('newOrders', 'topItems', 'orders', 'customers', 'items', 'totalAmount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
