<?php

namespace App\Repositories;

use App\Models\admin\Row;

/**
 * Class ExampleRepository.
 */
class RowRepository extends BaseRepository implements RowInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Row::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
