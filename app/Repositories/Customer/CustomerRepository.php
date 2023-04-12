<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements CustomerRepositoryInterface
{

    protected $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    /**
     * @param
     * @return
     */
    public function getList()
    {
        return $this->model->all();
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
    public function create($attributes)
    {
        DB::beginTransaction();
        try {
            $this->model::create([
                'name' => $attributes['name'],
                'address' => $attributes['address'],
                'phone' => $attributes['phone'],
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

    /**
     * @param
     * @return
     */
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
