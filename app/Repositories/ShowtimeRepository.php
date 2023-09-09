<?php

namespace App\Repositories;

use App\Models\admin\Showtime;

/**
 * Class ExampleRepository.
 */
class ShowtimeRepository extends BaseRepository implements ShowtimeInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Showtime::class;
    }

    public function existingShowtimes($newStartTime, $newEndTime)
    {
        $data = $this->model->where(function ($query) use ($newStartTime, $newEndTime) {
            $query->where(function ($subquery) use ($newStartTime) {
                $subquery->where('start_time', '<=', $newStartTime)
                    ->where('end_time', '>=', $newStartTime);
            })->orWhere(function ($subquery) use ($newEndTime) {
                $subquery->where('start_time', '<=', $newEndTime)
                    ->where('end_time', '>=', $newEndTime);
            });
        })->get();

        return $data;
    }

    public function ShowtimeByTheater()
    {
        return $this->model
            ->join('rooms', 'rooms.id', '=', 'showtime.id_room')
            ->join('theaters', 'theaters.id', '=', 'rooms.id_theater')
            ->join('city', 'city.id', '=', 'theaters.id_city')
            ->select('theaters.name as theater_name', 'theaters.id as theater_id', 'showtime.date', 'city.name as city_name')
            ->distinct()
            ->orderBy('showtime.date', 'asc')
            ->get();
    }
}
