<?php

namespace App\Repositories;

/**
 * Interface ExampleRepository.
 */
interface MovieInterface extends RepositoryInterface
{
    public function whereDate($date);
    public function getMovieAndSales();
}
