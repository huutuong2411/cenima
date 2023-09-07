<?php

namespace App\Repositories;

use App\Models\admin\Column;

/**
 * Class ExampleRepository.
 */
class ColumnRepository extends BaseRepository implements ColumnInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Column::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
