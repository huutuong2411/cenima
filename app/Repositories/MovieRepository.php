<?php

namespace App\Repositories;

use App\Models\admin\Movie;
use Illuminate\Support\Facades\DB;

/**
 * Class ExampleRepository.
 */
class MovieRepository extends BaseRepository implements MovieInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Movie::class;
    }

    public function whereDate($date)
    {
        $data = $this->model->whereDate('start_date', '<=', $date)
            ->get();

        return $data;
    }

    public function getMovieAndSales()
    {
        return $this->model
            ->leftJoin('showtime', 'movie.id', '=', 'showtime.id_movie')
            ->leftJoin('order', 'showtime.id', '=', 'order.id_showtime')
            ->select('movie.*', DB::raw('SUM(order.quantity) as total_sales'))
            ->groupBy('movie.id')
            ->get();
    }
}
