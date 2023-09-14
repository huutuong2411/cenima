<?php

namespace App\Services;

use App\Repositories\CategoriesInterface;

class CategoriesService
{
    protected $categoriesRepository;

    /**
     * __construct
     */
    public function __construct(CategoriesInterface $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getAll()
    {
        return $this->categoriesRepository->all();
    }

    public function createCategory($data)
    {
        return $this->categoriesRepository->create($data);
    }

    public function showCategory($id)
    {
        return $this->categoriesRepository->show($id);
    }

    public function updateCategory($id, $attributes = [])
    {
        return $this->categoriesRepository->update($id, $attributes);
    }

    public function deleteCategory($id)
    {
        return $this->categoriesRepository->delete($id);
    }

    public function CategoryTrash()
    {
        return $this->categoriesRepository->onlyTrashed();
    }

    public function restoreCategory($id)
    {
        return $this->categoriesRepository->restore($id);
    }
}
