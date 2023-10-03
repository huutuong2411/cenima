<?php

namespace App\Services;

use App\Repositories\TheatersInterface;

class TheatersService
{
    protected $theatersRepository;

    /**
     * __construct
     */
    public function __construct(TheatersInterface $theatersRepository)
    {
        $this->theatersRepository = $theatersRepository;
    }

    public function getAll()
    {
        return $this->theatersRepository->all()->load('Cities');
    }

    public function createTheater($data)
    {
        return $this->theatersRepository->create($data);
    }

    public function showTheater($id)
    {
        return $this->theatersRepository->show($id);
    }

    public function updateTheater($id, $attributes = [])
    {
        return $this->theatersRepository->update($id, $attributes);
    }

    public function findTheater($id)
    {
        return $this->theatersRepository->find($id);
    }

    public function deleteTheater($id)
    {
        return $this->theatersRepository->delete($id);
    }

    public function theaterTrash()
    {
        return $this->theatersRepository->onlyTrashed();
    }

    public function restoreTheater($id)
    {
        return $this->theatersRepository->restore($id);
    }

    public function detailShowtime($idTheater, $date)
    {
        return $this->theatersRepository->detailShowtime($idTheater, $date);
    }
}
