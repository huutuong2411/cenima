<?php

namespace App\Repositories;

/**
 * Interface ExampleRepository.
 */
interface RoomsInterface extends RepositoryInterface
{
    public function findShowTimeByTheater($id_theater);
}
