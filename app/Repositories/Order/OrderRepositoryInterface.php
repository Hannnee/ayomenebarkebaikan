<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function getList();
    public function getById($id);
    public function create($attr);
    public function update($id, $attr);
    public function totalAmount();
}
