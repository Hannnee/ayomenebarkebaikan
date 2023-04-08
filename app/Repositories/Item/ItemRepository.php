<?php

namespace App\Repositories\Item;

use App\Models\Item;

class ItemRepository implements ItemRepositoryInterface
{

    protected $model;

    public function __construct(Item $model)
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
            'price' => $attributes['price'],
            'description' => $attributes['description'],
        ]);

        return $data;
    }

    public function update($item, $attributes)
    {
        $item->update([
            'name' => $attributes['name'],
            'price' => $attributes['price'],
            'description' => $attributes['description'],
        ]);
        return $item;
    }
}
