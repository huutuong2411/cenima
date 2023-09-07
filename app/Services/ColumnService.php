<?php

namespace App\Services;

use App\Repositories\ColumnInterface;

class ColumnService
{
    protected  $columnRepository;

    /**
     * __construct
     */
    public function __construct(ColumnInterface $columnRepository)
    {
        $this->columnRepository = $columnRepository;
    }

    public function getAll()
    {
        return $this->columnRepository->all();
    }

    public function createColumn($data)
    {
        return $this->columnRepository->create($data);
    }

    public function showColumn($id)
    {
        return $this->columnRepository->show($id);
    }

    public function updateColumn($id, $attributes = [])
    {
        return $this->columnRepository->update($id, $attributes);
    }

    public function deleteColumn($id)
    {
        return $this->columnRepository->delete($id);
    }
}
