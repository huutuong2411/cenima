<?php

namespace App\Repositories;

use App\Models\user\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function monthRevenue($month, $year)
    {
        return $this->model->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('total');
    }

    public function movieMonthRevenue($movieId, $month, $year)
    {
        return $this->model
            ->join('showtime', 'order.id_showtime', '=', 'showtime.id')
            ->whereMonth('showtime.updated_at', $month)
            ->whereYear('showtime.updated_at', $year)
            ->where('showtime.id_movie', $movieId)
            ->sum('order.total');
    }

    public function weekRevenue()
    {
        $today = Carbon::now();
        $startOfWeek = Carbon::now()->startOfWeek()->startOfDay();

        return $this->model
            ->whereBetween('created_at', [$startOfWeek, $today])
            ->sum('total');
    }

    public function dateRevenue($date)
    {
        return $this->model
            ->whereDate('created_at', $date)
            ->sum('total');
    }

    public function movieDateRevenue($movieId, $date)
    {
        return $this->model
            ->join('showtime', 'order.id_showtime', '=', 'showtime.id')
            ->whereDate('showtime.updated_at', $date)
            ->where('showtime.id_movie', $movieId)
            ->sum('order.total');
    }

    public function getListYears()
    {
        return $this->model
            ->select(DB::raw('YEAR(created_at) as year'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'DESC')
            ->get();
    }
}
