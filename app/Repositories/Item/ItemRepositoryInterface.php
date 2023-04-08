<?php

namespace App\Repositories\Item;

interface ItemRepositoryInterface
{
    public function getList();
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
}
