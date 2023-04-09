<?php

namespace App\Repositories\Item;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $this->model::create([
                'name' => $attributes['name'],
                'price' => $attributes['price'],
                'description' => $attributes['description'],
            ]);
            DB::commit();

            return [
                'status' => 200,
                'message' => 'success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
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
