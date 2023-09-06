<?php

namespace App\Repositories;

use App\Models\admin\Categories;

/**
 * Class ExampleRepository.
 */
class CategoriesRepository extends BaseRepository implements CategoriesInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return Categories::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
