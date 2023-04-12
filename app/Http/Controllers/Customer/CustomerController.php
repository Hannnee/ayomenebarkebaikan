<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Repositories\Customer\CustomerRepositoryInterface;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $c)
    {
        $this->customerRepository = $c;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerRepository->getList();
        return view('feature.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feature.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerRepository->create($request->all());
        return $this->callback('customer.index', $customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('feature.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('feature.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer = $this->customerRepository->update($customer, $request->all());
        alert('success', 'Successfully update data');
        return to_route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        alert('success', 'Successfully delete data');
        return back();
    }

    public function getCustomer(Customer $id)
    {
        return response()->json([
            'id'      => $id->id,
            'address' => $id->address
        ]);
    }
}
