<?php

namespace App\Repositories;

/**
 * Interface ExampleRepository.
 */
interface RoomsInterface extends RepositoryInterface
{
    public function getShowTimeByTheater($id_theater);
}
