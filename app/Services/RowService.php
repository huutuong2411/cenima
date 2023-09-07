<?php

namespace App\Services;

use App\Repositories\RowInterface;

class RowService
{
    protected  $rowRepository;

    /**
     * __construct
     */
    public function __construct(RowInterface $rowRepository)
    {
        $this->rowRepository = $rowRepository;
    }

    public function getAll()
    {
        return $this->rowRepository->all();
    }

    public function createRow($data)
    {
        return $this->rowRepository->create($data);
    }

    public function showRow($id)
    {
        return $this->rowRepository->show($id);
    }

    public function updateRow($id, $attributes = [])
    {
        return $this->rowRepository->update($id, $attributes);
    }


    public function deleteRow($id)
    {
        return $this->rowRepository->delete($id);
    }
}
