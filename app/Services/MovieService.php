<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;
use App\Repositories\MovieInterface;

class MovieService
{
    protected  $movieRepository;

    /**
     * __construct
     */
    public function __construct(MovieInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAll()
    {
        return $this->movieRepository->all();
    }

}
