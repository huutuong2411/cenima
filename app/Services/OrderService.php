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

    public function findOrder($id)
    {
        return $this->orderRepository->find($id);
    }

    public function whereUserID($userID)
    {
        return $this->orderRepository->whereUserID($userID);
    }

    public function monthRevenue($month, $year)
    {
        return $this->orderRepository->Monthrevenue($month, $year);
    }

    public function movieMonthRevenue($movieId, $month, $year)
    {
        return $this->orderRepository->movieRevenue($movieId, $month, $year);
    }

    public function weekRevenue()
    {
        return $this->orderRepository->Weekrevenue();
    }

    public function getListYears()
    {
        return $this->orderRepository->getListYears();
    }

    public function dateRevenue($date)
    {
        return $this->orderRepository->dateRevenue($date);
    }

    public function movieDateRevenue($movieId, $date)
    {
        return $this->orderRepository->movieDateRevenue($movieId, $date);
    }
}
