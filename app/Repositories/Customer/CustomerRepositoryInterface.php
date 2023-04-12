<?php

namespace App\Repositories\Customer;

interface CustomerRepositoryInterface
{
    public function getList();
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
}
