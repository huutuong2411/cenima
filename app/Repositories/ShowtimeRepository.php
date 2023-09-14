<?php

namespace App\Repositories;

use App\Models\admin\Showtime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function showTimeByIdRoom(array $roomID, $date)
    {
        return $this->model->where(function ($query) use ($roomID, $date) {
            $query->whereIn('id_room', $roomID)
                ->orWhere('date', $date);
        })->get();
    }

    public function dateByRoomAndIdMovie($roomID, $idMovie)
    {
        $today = Carbon::today();
        $dayOfWeekMap = [
            '0' => 'Chủ Nhật',
            '1' => 'Thứ 2',
            '2' => 'Thứ 3',
            '3' => 'Thứ 4',
            '4' => 'Thứ 5',
            '5' => 'Thứ 6',
            '6' => 'Thứ 7',
        ];
        $dates = $this->model->select('date')->whereIn('id_room', $roomID)->where('id_movie', $idMovie)->whereDate('date', '>=', $today)->get()->groupBy('date');
        $formattedDates = [];
        foreach ($dates as $day => $value) {
            $dayOfWeek = $dayOfWeekMap[Carbon::parse($day)->dayOfWeek];
            $formattedDates[] = [
                'date' => $day,
                'day_of_week' => $dayOfWeek,
            ];
        }

        return $formattedDates;
    }

    public function showTimeByMovieDate($roomID, $date, $idMovie)
    {
        $tenMinutesAgo = Carbon::now()->addMinutes(10)->format('H:i:s');
        return $this->model->whereIn('id_room', $roomID)->where('id_movie', $idMovie)->where('date', $date)->whereTime('start_at', '>', $tenMinutesAgo)->get();
    }

    public function nameMovieByMonthYear($month, $year)
    {
        $month = date('m', strtotime($month));

        return $this->model
            ->select('movie.name', DB::raw('MAX(movie.id) as id'))
            ->whereMonth('showtime.updated_at', $month)
            ->whereYear('showtime.updated_at', $year)
            ->join('movie', 'showtime.id_movie', '=', 'movie.id')
            ->groupBy('movie.name')
            ->get();
    }

    public function showtimeByDateTime($time, $date)
    {
        return $this->model->where('start_at', $time)
            ->where('date', $date)
            ->get();
    }

    public function userEmailFromShowtime()
    {
        $currentTime = Carbon::now();
        $addtime = $currentTime->addMinutes(30);
        $addtimeHM = $addtime->format('H:i');

        return $this->model->select('users.email')
            ->join('order', 'showtime.id', '=', 'order.id_showtime')
            ->join('users', 'order.user_id', '=', 'users.id')
            ->whereRaw("DATE_FORMAT(showtime.start_at, '%H:%i') = ?", ["$addtimeHM"])
            ->whereDate('showtime.date', $currentTime->toDateString())
            ->pluck('users.email');
    }
}
