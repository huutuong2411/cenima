<?php

namespace App\Services;

use App\Repositories\CitiesInterface;

class CitiesService
{
    protected  $citiesRepository;

    /**
     * __construct
     */
    public function __construct(CitiesInterface $citiesRepository)
    {
        $this->citiesRepository = $citiesRepository;
    }

    public function getAll()
    {
        return $this->citiesRepository->all();
    }

    public function findCity($id)
    {
        return $this->citiesRepository->find($id);
    }

}
