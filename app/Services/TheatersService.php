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
        return $this->theatersRepository->all();
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
}
