<?php

namespace App\Repositories;

/**
 * Interface ExampleRepository.
 */
interface ShowtimeInterface extends RepositoryInterface
{
    public function existingShowtimes($newStartTime, $newEndTime);

    public function ShowtimeByTheater();

    public function showTimeByIdRoom(array $roomID, $date);

    public function dateByRoomAndIdMovie($roomID, $idMovie);

    public function showTimeByMovieDate($roomID, $date, $idMovie);

    public function nameMovieByMonthYear($month, $year);

    public function showtimeByDateTime($time, $date);

    public function userEmailFromShowtime();
}
