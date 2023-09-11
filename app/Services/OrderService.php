<?php

namespace App\Services;

use App\Repositories\OrderInterface;

class OrderService
{
    protected $orderRepository;

    /**
     * __construct
     */
    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAll()
    {
        return $this->orderRepository->all();
    }

    public function createOrder($data)
    {
        return $this->orderRepository->create($data);
    }

    public function showOrder($id)
    {
        return $this->orderRepository->show($id);
    }

    public function updateOrder($id, $attributes = [])
    {
        return $this->orderRepository->update($id, $attributes);
    }

    public function deleteOrder($id)
    {
        return $this->orderRepository->delete($id);
    }

    public function orderByShowtimeID($showtimeID)
    {
        return $this->orderRepository->orderByShowtimeID($showtimeID);
    }
}
