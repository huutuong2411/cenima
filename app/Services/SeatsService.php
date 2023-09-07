<?php

namespace App\Services;

use App\Repositories\SeatsInterface;

class SeatsService
{
    protected  $seatsRepository;

    /**
     * __construct
     */
    public function __construct(SeatsInterface $seatsRepository)
    {
        $this->seatsRepository = $seatsRepository;
    }

    public function getAll()
    {
        return $this->seatsRepository->all();
    }

    public function createSeat($data)
    {
        return $this->seatsRepository->create($data);
    }

    public function showSeat($id)
    {
        return $this->seatsRepository->show($id);
    }

    public function updateSeat($id, $attributes = [])
    {
        return $this->seatsRepository->update($id, $attributes);
    }

    public function deleteSeat($id)
    {
        return $this->seatsRepository->delete($id);
    }
}
