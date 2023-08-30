<?php

namespace App\Services;

use App\Repositories\UserInterface;

class UserService
{
    protected UserInterface $userRepository;

    /**
     * __construct
     */
    public function __construct(
        UserInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * getList
     *
     * @return mixed
     */
    public function getList(object $filter)
    {
        return $this->userRepository->getUsers($filter);
    }

    /**
     * findExampleById
     *
     * @return mixed
     */
    public function findExampleById($id)
    {
        return $this->userRepository->find($id);
    }

    public function addUser($filter)
    {
        return $this->userRepository->createUser($filter);
    }

    public function findbyEmail($email)
    {
        return $this->userRepository->findOneBy($email);
    }
}
