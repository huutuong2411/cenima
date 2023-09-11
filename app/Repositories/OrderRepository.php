<?php

namespace App\Repositories;

use App\Models\user\Order;

/**
 * Class ExampleRepository.
 */
class OrderRepository extends BaseRepository implements OrderInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Order::class;
    }

    public function orderByShowtimeID($showtimeID)
    {
        return $this->model->where('id_showtime', $showtimeID)->pluck('ticket');
    }

    public function whereUserID($userID)
    {
        return $this->model->where('user_id', $userID)->get();
    }
}
