<?php

namespace App\Repositories;

use App\Models\admin\Seats;

/**
 * Class ExampleRepository.
 */
class SeatsRepository extends BaseRepository implements SeatsInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Seats::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
