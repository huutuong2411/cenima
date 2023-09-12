<?php

namespace App\Repositories;

/**
 * Interface ExampleRepository.
 */
interface OrderInterface extends RepositoryInterface
{
    public function orderByShowtimeID($showtimeID);

    public function whereUserID($userID);

    public function monthRevenue($month, $year);
    public function weekRevenue();
    public function getListYears();
    public function dateRevenue($date);
}
