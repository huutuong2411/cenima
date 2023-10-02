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

    public function findUserByEmail($email)
    {
        return $this->userRepository->findUserByEmail($email);
    }

    public function updateUser($id, $filter)
    {
        return $this->userRepository->update($id, $filter);
    }

    public function pluckNotNull($column)
    {
        return $this->userRepository->findOneByNotNull($column)->pluck($column);
    }

    // public function createToken($user, $name) hàm này để làm passport
    // {
    //     return $this->userRepository->createToken($user, $name);
    // }
}
