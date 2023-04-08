<?php

namespace App\Repositories\Customer;

use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{

    protected $model;

    public function __construct(Customer $model)
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

    public function create($attributes)
    {
        $data = $this->model::create([
            'name' => $attributes['name'],
            'address' => $attributes['address'],
            'phone' => $attributes['phone'],
        ]);

        return $data;
    }

    public function update($item, $attributes)
    {
        $item->update([
            'name' => $attributes['name'],
            'address' => $attributes['address'],
            'phone' => $attributes['phone'],
        ]);

        return $item;
    }
}
