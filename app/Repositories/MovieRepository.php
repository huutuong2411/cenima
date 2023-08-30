<?php

namespace App\Repositories;

use App\Models\admin\Movie;

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

    /**
     * getExamples
     *
     * @return mixed
     */
}
