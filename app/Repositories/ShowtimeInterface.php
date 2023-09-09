<?php

namespace App\Repositories;

/**
 * Interface ExampleRepository.
 */
interface ShowtimeInterface extends RepositoryInterface
{
    public function existingShowtimes($newStartTime, $newEndTime);

    public function ShowtimeByTheater();
}
