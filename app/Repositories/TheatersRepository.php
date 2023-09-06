<?php

namespace App\Repositories;

use App\Models\admin\Theaters;

/**
 * Class ExampleRepository.
 */
class TheatersRepository extends BaseRepository implements TheatersInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Theaters::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
