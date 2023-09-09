<?php

namespace App\Services;

use App\Repositories\MovieInterface;

class MovieService
{
    protected $movieRepository;

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

    public function createMovie($data)
    {
        return $this->movieRepository->create($data);
    }

    public function findMovie($id)
    {
        return $this->movieRepository->find($id);
    }

    public function updateMovie($id, $attributes = [])
    {
        return $this->movieRepository->update($id, $attributes);
    }

    public function deleteMovie($id)
    {
        return $this->movieRepository->delete($id);
    }

    public function movieTrash()
    {
        return $this->movieRepository->onlyTrashed();
    }

    public function restoreMovie($id)
    {
        return $this->movieRepository->restore($id);
    }

    public function whereDate($date)
    {
        return $this->movieRepository->whereDate($date);
    }
}
