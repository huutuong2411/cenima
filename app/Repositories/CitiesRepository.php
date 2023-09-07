<?php

namespace App\Repositories;

use App\Models\admin\City;

/**
 * Class ExampleRepository.
 */
class CitiesRepository extends BaseRepository implements CitiesInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return City::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
